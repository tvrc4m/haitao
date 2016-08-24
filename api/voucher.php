<?php
/**
 * Created by PhpStorm.
 * User: wonder
 * Date: 2016/5/25
 * Time: 13:26
 */
include_once("../includes/global.php");
include_once("../includes/uc_server.php");

class voucher extends Uc_server{

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

    private $_db = '';

    private $_name = '蚂蚁在线';

    private $_userinfo = array();

    private $_shopinfo = array();

    private $_params = array();

    private $_serials = array();

    private $_url = 'https://www.mayihaitao.com';

    const TIME=600;

    const EXT = '.txt';

    private $_error = array(
        '00000'=>'操作成功',
        '10001'=>'请求方法不存在',
        '10002'=>'签名已失效',
        '10003'=>'签名验证失败',
        '10004'=>'ip受限',
        '10005'=>'参数不完整',
        '10006'=>'优惠卷已发放完',
        '10007'=>'该用户已领取优惠卷',
        '10008'=>'用户不存在',
        '10009'=>'请求数据为空'
    );

    private $_apps = array(
        1464427700=>array(
            'url'=>'https://www.mayihaitao.com/api/voucher.php',
            'shop'=>'',
            'secret'=>'1a2e939f4c52360c3c774d5e68786aa5',
            'ips'=>array()
        )
    );
    public function __construct($config)
    {
        global $db;
        $this->_db = $db;
        $data['uc_appid']='201605270933';
        $data['uc_secret']='jindsf83nsdvi3n0ejj91jnlnapfnas92nvb';
        $data['uc_server']='https://m.mayizaixian.cn/apis/uc';
        //$data['uc_server']='http://t.mayionline.cn/apis/uc';
        parent::__construct($data);
        $this->_startTime = time();
        $this->_appid=$config['appid'];
        $this->_secret=$config['secret'];
        $this->_ucServer = $config['uc_server'];

        $this->_timestamp = $_POST['timestamp'];
        $this->_action = $_POST['action'];
        $this->_signature = $_POST['signature'];
        if(empty($_POST)){
            $this->_response_code='10009';
            $this->_response_data='null';
        }
	if(!empty($_REQUEST)){
            $this->cacheLog('voucher_list',$_REQUEST,'cache');
        }
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

        $json_str = json_encode(array('status'=>$this->_response_code,'errmsg'=>$this->_error[$this->_response_code],'data'=>$this->_response_data));
        if(empty($json_str)){
            $this->cacheLog('voucher',array('status'=>$this->_response_code,'errmsg'=>$this->_error[$this->_response_code],'data'=>$this->_response_data),'cache');

        }
	
        exit($json_str);
    }

    /*
     * 获取店铺
     * @return json*/
    public function shop($shop_id=''){
        if(empty($shop_id)){
            $sql = "select userid,company from mallbuilder_shop WHERE userid in(49,44,48,91)";
            //$sql = "select userid,company from mallbuilder_shop WHERE userid in(15,44,40,91)";
            $this->_db->query($sql);
            $list = $this->_db->getRows();
            $this->_response_data = $list;
            $this->_response_code = '00000';
        }else{
            $sql = "select userid,company from mallbuilder_shop where userid=".$shop_id;
            $this->_db->query($sql);
            $this->_shopinfo = $this->_db->fetchRow();
        }
    }

    /*
     * 获取用户信息
     * $param phone 手机号
     * $return array */
    public function userInfo($mobile){
        $sql = "SELECT userid,user FROM mallbuilder_member WHERE mobile=".$mobile;
        $this->_db->query($sql);
        $this->_userinfo = $this->_db->fetchRow();
    }
    /*
     * 发放代金卷
     * */
    public function generate(){

        //生成代金卷
        for($i=0;$i<count($this->_params);$i++){
            $this->userInfo($this->_params[$i]['mobile']);
            if($this->_userinfo){
                $this->shopRule($this->_params[$i]);
            }else{
                $user =parent::userinfo(array('phone'=>$this->_params[$i]['mobile']));
                if($user['status']=='1100'){
                    $this->doreg($user['phone'],$user['password'],$user['salt']);
                    $this->userInfo($this->_params[$i]['mobile']);
                    $this->shopRule($this->_params[$i]);
                }else{
                    $this->_response_code='10008';
                    $this->_response_data=json_encode(array('phone'=>$this->_params[$i]['mobile']));
                    return false;
                }

            }

        }
        $this->_response_data = json_encode((array)$this->_serials);
    }

    /*
     * 店铺代金卷规则
     * */
    public function shopRule($list){
        $this->shop($list['shop_id']);
        $sql = "select id,total,giveout from mallbuilder_voucher_temp where `shop_id`='".$list['shop_id']."' and `price`='".$list['price']."' and `limit`='".$list['limit']."'";
        $this->_db->query($sql);
        $data = $this->_db->fetchRow();
        if($data){
            if($data['total']>$data['giveout'])
                $this->voucher($list,$data['id']);
            else
                $this->_response_code='10006';
        }else{
            $logo=$this->_url."/image/red/".(int)$list['price'].".png";
            $sql = "insert into mallbuilder_voucher_temp (`name`,`desc`,`start_time`,`end_time`,`price`,`limit`,`shop_id`,`shop_name`,`total`,`eachlimit`,`logo`,`status`,`points`,`TYPE`) values ('{$this->_name}','消费{$list['limit']}可用','{$this->_startTime}','6898435688','{$list['price']}','{$list['limit']}','{$list['shop_id']}','{$this->_shopinfo['company']}','999999999','0','{$logo}','1','','2')";
            $this->_db->query($sql);
            $id = $this->_db->lastid();
            $this->voucher($list,$id);
        }
    }

    /*
     * 分发代金卷
     * $param list 代金卷数组信息   id 代金卷模板id
     * */
    public function voucher($list,$id=''){
        $sql = "select id from mallbuilder_voucher_order where `mobile`=".$list['mobile']." and `order`='".$list['order_id']."'";
        $this->_db->query($sql);
        if($this->_db->num_rows()){
            $this->_response_code='10007';
        }else{
            for($i=0;$i<$list['user_number'];$i++){
                $this->_serial = time().rand(100000,999999);
                $this->_serials[$list['voucher_id']]=(string)$this->_serial;
                //array_push($this->_serials,array($list['voucher_id']=>$this->_serial));
                $this->_endTime = $list['time'];
                $logo=$this->_url."/image/red/".(int)$list['price'].".png";
                $sql = "insert into  mallbuilder_voucher (`serial`,`temp_id`,`name`,`desc`,`start_time`,`end_time`,`price`,`limit`,`shop_id`,`status`,`create_time`,`member_id`,`member_name`,`logo`,`shop_name`) values ('{$this->_serial}','{$id}','{$this->_name}','消费{$list['limit']}可用','{$this->_startTime}','{$this->_endTime}','{$list['price']}','{$list['limit']}','{$list['shop_id']}',1,'".time()."','{$this->_userinfo['userid']}','{$this->_userinfo['user']}','{$logo}','{$this->_shopinfo['company']}') ";
                $this->_db->query($sql);
                $sql = "update mallbuilder_voucher_temp set `giveout` = giveout+1 where id=".$id;
                $this->_db -> query($sql);
                $this->order($list['mobile'],$list['order_id'],$this->_serial);
            }
        }

    }

    /*
     * 记录代金卷领取
     * $param serial  代金卷序列号  mobile  手机号  order   投资流水单号
     * */
    public function order($mobile='',$order_id='',$serial=''){
        $sql = "select `serial`,`mobile` from mallbuilder_voucher_order where `order`='".$order_id."'";
        $this->_db->query($sql);
        $order = $this->_db->fetchRow();
        if($order['serial']){
            $orders = json_decode($order['serial']);
            if(in_array($serial,$orders))
                $this->_response_code='10007';
            else{
                array_push($orders,$serial);
                $serialJson = json_encode($orders);
                $sql="update mallbuilder_voucher_order set serial='$serialJson' where mobile='$mobile'";
                $this->_db->query($sql);
                $this->_response_code='00000';
            }
        }else{
            $serials = array($serial);
            $serialJson = json_encode($serials);
            if($order['mobile']!=$mobile){
                $sql = "insert into mallbuilder_voucher_order(`order`,`mobile`,`serial`)values ('$order_id','$mobile','$serialJson')";
                $this->_db->query($sql);
            }else{
                $sql="update mallbuilder_voucher_order set serial='$serialJson' where mobile='$mobile'";
                $this->_db->query($sql);
            }
            $this->_response_code='00000';
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

    //数据入库
    public function doreg($mobile=null,$password=null,$rand_pwd=null)
    {
        $user = 'mayi'.$mobile;
        $pass = addslashes($password);
        $mobile = $mobile;
        $lastLoginTime = time();
        $regtime = date("Y-m-d H:i:s");
        $user_reg = "2";

        $sql="insert into ".MEMBER." (user,password,ip,lastLoginTime,email,mobile,regtime,statu,email_verify,mobile_verify,rand_pwd) values ('$user','".$pass."','NULL','$lastLoginTime','','$mobile','$regtime','$user_reg','0','1','{$rand_pwd}')";
        $re=$this->_db->query($sql);
        $userid=$this->_db->lastid();

        if($userid)
        {
            //代金卷发放
            $_serial=time().rand(100000,999999);
            $_endTime = time()+3600*24*7;
            $_startTime = time();
            $logo=$this->_url."/image/red/20.png";
            $sql = "insert into  mallbuilder_voucher (`serial`,`temp_id`,`name`,`desc`,`start_time`,`end_time`,`price`,`limit`,`shop_id`,`status`,`create_time`,`member_id`,`member_name`,`logo`,`shop_name`) values ('{$_serial}','2','新用户代金卷','消费300可用','{$_startTime}','{$_endTime}','20','300','','1','".time()."','{$userid}','mayi{$mobile}','{$logo}','') ";
            $this->_db->query($sql);
            $sql = "update mallbuilder_voucher_temp set `giveout` = giveout+1 where id=2";
            $this->_db -> query($sql);
            $sql="INSERT INTO ".MEMBERINFO." (member_id) VALUES ('$userid')";
            $re=$this->_db->query($sql);

            if($re)
            {
                $post['userid'] = $userid;
                $post['email'] = $user;
                $post['pay_mobile'] = $mobile;
                $pay_id = member_get_url($post,true);
                if($pay_id)
                {
                    $sql="update ".MEMBER." set pay_id='{$pay_id}' where userid='{$userid}'";
                    $re=$this->_db->query($sql);
                    return true;
                }
            }
        }
    }

    /*
     * 缓存日志
     * $key 文件名
     * $value 存储数据
     * $path  存储文件路径
     * */
    public function cacheLog($key='',$value='',$path=''){
        global $config;
        $data = $this->time.'>>>'.json_encode($value)."\r\n";
        $filename = $config['webroot'].'/'.$path.'/'.$key.self::EXT;
        if($data !== ''){
            $dir = dirname($filename);
            if(!is_dir($dir)){
                mkdir($dir,0777);
            }
            return file_put_contents($filename,$data,FILE_APPEND);
        }

    }

}


$config['appid']='1464427700';
$config['secret']='1a2e939f4c52360c3c774d5e68786aa5';
$config['uc_server']='http://www.haitao.com/';
$obj = new voucher($config);

