<?php
/**
 * Created by PhpStorm.
 * User: wonder
 * Date: 2016/5/25
 * Time: 13:26
 */

class voucher{

    private $_appid;

    private $_secret;

    private $_action;

    private $_ucServer;

    private $_timestamp;

    private $_startTime;

    private $_endTime;

    private $_signature;

    private $_response_code;

    private $_response_data;

    private $_serial;

    private $_name = '蚂蚁在线';

    private $_userinfo = array();

    private $_shopinfo = array();

    private $_params = array();

    const TIME=600;

    private $_error = array(
        '00000'=>'操作成功',
        '10001'=>'请求方法不存在',
        '10002'=>'签名已失效',
        '10003'=>'签名验证失败',
        '10004'=>'ip受限',
        '10005'=>'参数不完整',
        '10006'=>'优惠卷已发放完',
        '10007'=>'该用户已领取优惠卷'
    );

    private $_apps = array(
        1464427700=>array(
            'url'=>'https://www.mayihaitao.com/api/voucher.php',
            'shop'=>'',
            'secret'=>'10cf1fdf6ad958eeffa9853f6885cec9',
            'ips'=>array()
        )
    );
    public function __construct($config)
    {
        $this->_startTime = time();
        $this->_appid=$config['appid'];
        $this->_secret=$config['secret'];
        $this->_ucServer = $config['uc_server'];
        $this->_timestamp = $_POST['timestamp'];
        $this->_action = $_POST['action'];
        $this->_signature = $_POST['signature'];

        // 验证ip访问
        //if ($this->checkIp($user_ip)) {
            $params=$_POST['params'];
            $str=$this->authcode($params,'DECODE',$this->_secret);
            parse_str($str,$this->_params);
            if (method_exists($this,$this->_action)) {
                call_user_func(array($this,$this->_action));
            }else{
                // 请求的方法不存在
                $this->_response_code='10001';
            }
       // }

        $this->response();
    }

    private function response(){
        // 响应json
        exit(json_encode(array('status'=>$this->_response_code,'errmsg'=>$this->_error[$this->_response_code],'data'=>$this->_response_data)));
    }

    /*
     * 获取店铺
     * @return json*/
    public function shop($shop_id=''){
        global $db;
        if(empty($shop_id)){
            //$sql = "select userid,company from mallbuilder_shop WHERE userid in(49,44,48,91)";
            $sql = "select userid,company from mallbuilder_shop WHERE userid in(15,44,40,91)";
            $db->query($sql);
            $list = $db->getRows();
            $this->_response_data = $list;
            $this->_response_code = '00000';
        }else{
            $sql = "select userid,company from mallbuilder_shop where userid=".$shop_id;
            $db->query($sql);
            $this->_shopinfo = $db->fetchRow();
        }
    }

    /*
     * 获取用户信息
     * $param phone 手机号
     * $return array */
    public function userInfo($mobile){
        global $db;
        $sql = "SELECT userid,user FROM mallbuilder_member WHERE mobile=".$mobile;
        $db->query($sql);
        $this->_userinfo = $db->fetchRow();
    }
    /*
     * 发放代金卷
     * */
    public function generate(){

        //生成代金卷
        for($i=0;$i<count($this->_params);$i++){
            $this->userInfo($this->_params[$i]['mobile']);
            if($this->_userinfo)
                $this->shopRule($this->_params[$i]);
            else
                echo '该用户不存在需要创建创建用户';
        }
    }

    /*
     * 店铺代金卷规则
     * */
    public function shopRule($list){
        global $db;
        $this->_endTime = $this->_startTime+1000000;
        $sql = "select id,total,giveout from mallbuilder_voucher_temp where shop_id=".$list['shop_id'];
        $db->query($sql);
        $data = $db->fetchRow();
        if($data){
            if($data['total']>$data['giveout'])
                $this->voucher($list,$data['id']);
            else
                $this->_response_code='10006';
        }else{
            $sql = "insert into mallbuilder_voucher_temp (`name`,`desc`,`start_time`,`end_time`,`price`,`limit`,`shop_id`,`shop_name`,`total`,`eachlimit`,`logo`,`status`,`points`,`TYPE`) values ('$this->_name','消费{$list['limit']}可用',".$this->_startTime.",'$this->_endTime','{$list['price']}','{$list['limit']}','{$this->_userinfo['userid']}','{$this->_shopinfo['company']}','{$list['shop_number']}','0','','1','','2')";
            $db->query($sql);
            $id = $db->lastid();
            $this->voucher($list,$id);
        }
    }

    /*
     * 分发代金卷
     * $param list 代金卷数组信息   id 代金卷模板id
     * */
    public function voucher($list,$id=''){
        global $db;
        $this->_serial = time().rand(100000,999999);
        $this->_endTime = $this->_startTime+$list['time'];
        $this->shop($list['shop_id']);
        $sql = "insert into  mallbuilder_voucher (`serial`,`temp_id`,`name`,`desc`,`start_time`,`end_time`,`price`,`limit`,`shop_id`,`status`,`create_time`,`member_id`,`member_name`,`logo`,`shop_name`) values ('$this->_serial','{$id}','$this->_name','消费{$list['limit']}可用','$this->_startTime','$this->_endTime','{$list['price']}','{$list['limit']}','{$list['shop_id']}',1,'".time()."','{$this->_userinfo['userid']}','{$this->_userinfo['user']}','','{$this->_shopinfo['company']}') ";
        $db->query($sql);
        $sql = "update mallbuilder_voucher_temp set `giveout` = giveout+1 where id=".$id;
        $db -> query($sql);
        $this->order($list['mobile'],$list['order_id'],$this->_serial);
    }

    /*
     * 记录代金卷领取
     * $param serial  代金卷序列号  mobile  手机号  order   投资流水单号
     * */
    public function order($mobile='',$order_id='',$serial=''){
        global $db;
        $sql = "select serial,mobile from mallbuilder_voucher_order where mobile=".$mobile;
        $db->query($sql);
        $order = $db->fetchRow();
        if($order['serial']){
            $orders = json_decode($order['serial']);
            if(in_array($serial,$orders))
                $this->_response_code='10007';
            else{
                array_push($orders,$serial);
                $serialJson = json_encode($orders);
                $sql="update mallbuilder_voucher_order set serial='$serialJson' where mobile='$mobile'";
                $db->query($sql);
                $this->_response_code='00000';
            }
        }else{
            $serials = array($serial);
            $serialJson = json_encode($serials);
            if($order['mobile']!=$mobile){
                $sql = "insert into mallbuilder_voucher_order(`order`,`mobile`,`serial`)values ('$order_id','$mobile','$serialJson')";
                $db->query($sql);
            }else{
                $sql="update mallbuilder_voucher_order set serial='$serialJson' where mobile='$mobile'";
                $db->query($sql);
            }

        }
    }

    /**
     * 检测签名是否正确和时间有效期
     * @param  array $data 需要签名的数据
     * @return boolean  true: 验证成功  false: 失败
     */
    private function checkSignature($data){

        if ($this->_timestamp+TIME>time()) {
            // 在有效期内
            if($this->signature($data)===$this->_signature){

                return true;
            }else{
                // 签名验证失败
                $this->_response_code='10003';
                return false;
            }
        }else{
            // 签名已失效
            $this->_response_code='10002';
            return false;
        }
    }

    /**
     * 生成签名字符串
     * @param  array $data 需要签名的数据
     * @return string      签名字符串
     */
    private function signature($data){

        $data['secret']=$this->_secret;
        $data['appid']=$this->_appid;
        $data['action']= $this->_action;
        $data['timestamp']= $this->_timestamp;

        ksort($data);

        $str=http_build_query($data);

        return sha1($str);
    }

    //加密
    private function authcode($string, $operation = 'DECODE', $key = '', $expiry = 0) {

        $ckey_length = 4;

        $key = md5($key ? $key : $this->_secret);
        $keya = md5(substr($key, 0, 16));
        $keyb = md5(substr($key, 16, 16));
        $keyc = $ckey_length ? ($operation == 'DECODE' ? substr($string, 0, $ckey_length): substr(md5(microtime()), -$ckey_length)) : '';

        $cryptkey = $keya.md5($keya.$keyc);
        $key_length = strlen($cryptkey);

        $string = $operation == 'DECODE' ? base64_decode(substr($string, $ckey_length)) : sprintf('%010d', $expiry ? $expiry + time() : 0).substr(md5($string.$keyb), 0, 16).$string;
        $string_length = strlen($string);

        $result = '';
        $box = range(0, 255);

        $rndkey = array();
        for($i = 0; $i <= 255; $i++) {
            $rndkey[$i] = ord($cryptkey[$i % $key_length]);
        }

        for($j = $i = 0; $i < 256; $i++) {
            $j = ($j + $box[$i] + $rndkey[$i]) % 256;
            $tmp = $box[$i];
            $box[$i] = $box[$j];
            $box[$j] = $tmp;
        }

        for($a = $j = $i = 0; $i < $string_length; $i++) {
            $a = ($a + 1) % 256;
            $j = ($j + $box[$a]) % 256;
            $tmp = $box[$a];
            $box[$a] = $box[$j];
            $box[$j] = $tmp;
            $result .= chr(ord($string[$i]) ^ ($box[($box[$a] + $box[$j]) % 256]));
        }

        if($operation == 'DECODE') {
            if((substr($result, 0, 10) == 0 || substr($result, 0, 10) - time() > 0) && substr($result, 10, 16) == substr(md5(substr($result, 26).$keyb), 0, 16)) {
                return substr($result, 26);
            } else {
                return '';
            }
        } else {
            return $keyc.str_replace('=', '', base64_encode($result));
        }
    }

}

include_once("../includes/global.php");
$config['appid']='1464427700';
$config['secret']='10cf1fdf6ad958eeffa9853f6885cec9';
$config['uc_server']='http://www.haitao.com/';
$obj = new voucher($config);

