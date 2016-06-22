<?php
/**
 * Created by PhpStorm.
 * User: wonder
 * Date: 2016/5/30
 * Time: 15:35
 */
include_once("../includes/uc_server.php");
include_once ("../includes/global.php");

class passport extends Uc_server{

    private $_mobile;

    private $_pwd;

    private $_action;

    private $_secret;

    private $_response_code;

    private $_error = array(
        '00000'=>'操作成功',
        '10001'=>'请求方法不存在',
        '10002'=>'签名已失效',
        '10003'=>'签名验证失败',
        '10004'=>'ip受限',
    );

    public function __construct()
    {
        $config['uc_appid']='201605270933';
        $this->_secret =  $config['uc_secret'] = 'jindsf83nsdvi3n0ejj91jnlnapfnas92nvb';
        $config['uc_server']='http://t.mayionline.cn/apis/uc';
        parent:: __construct($config);
        $this->_action = !empty($_REQUEST['action'])?$_REQUEST['action']:'';

        if (method_exists($this,$this->_action)) {
            call_user_func(array($this,$this->_action));
        }else{
            // 请求的方法不存在
            $this->_response_code='10001';
        }
    }

    /*
     * 登陆
     * */
    public function uc_login(){
        file_put_contents("/web/uploadfile/login.txt",var_export($_REQUEST,true),FILE_APPEND);
        global $db;
        $time = $_REQUEST['time'];
        $code = $_REQUEST['code'];
        $str = $this->authcode($code, DECODE, $this->_secret);
        parse_str($str, $arr);
        if($time===$arr['time']&&!empty($arr['phone'])){
            $this->login($arr['phone']);
        }
    }

    /*
     * 注册
     * */
    public function uc_register()
    {
		//file_put_contents("/web/uploadfile/register.txt",var_export($_REQUEST,true),FILE_APPEND);
        global $db;
        $code = $_REQUEST['code'];
        $timestamp = $_REQUEST['time'];
        $str = $this->authcode($code, DECODE, $this->_secret);
        parse_str($str, $arr);

        $sql = "select userid from ".MEMBER." where mobile=".$arr['phone'];
        $db->query($sql);
        $list = $db->fetchRow();

        if($list)return false;

        if ($arr['time'] === $timestamp && !empty($arr['phone']) && !empty($arr['password']) && !empty($arr['salt'])) {
            $user = parent::userinfo(array('phone' => $arr['phone']));
            if ($user['status'] == '1100') {
                $this->doreg($arr['phone'], $arr['password']);
            }
        }
    }

    /*
     * 退出
     * */
    public function uc_logout(){
        global $config;
        include_once("$config[webroot]/config/reg_config.php");
        $config = array_merge($config,$reg_config);
        bsetcookie("USERID",NULL,time(),"/",$config['baseurl']);
        setcookie("USER",NULL,time(),"/",$config['baseurl']);
        //=====================
        if($config['openbbs']==2)
        {
            include_once("$config[webroot]/uc_client/client.php");
            echo uc_user_synlogout();
        }
        $_SESSION['USER_TYPE']=NULL;
        header("Location: ".$config['weburl']);
        die;
    }

    /*
     * 找回密码
     * */
    public function lostpass(){

    }

    public function login($mobile)
    {
        global $db,$config;

        if($mobile)
            $sql="select userid,pay_id,userid,user,statu from ".MEMBER." a where a.mobile='$mobile'";
        $db->query($sql);
        $re=$db->fetchRow();
        if(false)
            $time=time()+3600*24*7;
        else
            $time=NULL;

        bsetcookie("USERID","$re[userid]\t$re[user]\t$re[pid]",$time,"/",$config['baseurl']);
        setcookie("USER",$re['user'],$time,"/",$config['baseurl']);
        setcookie("userid",$re['userid']);

        $_SESSION["STATU"]=$re['statu'];
        $str = "" ;
        /*if(!$re['pay_id'])
        {
            $post['userid'] = $re['userid'];
            $post['email'] = $re['user'];
            $pay_id = member_get_url($post,true);
            if($pay_id)
            {
                $str = " , pay_id='$pay_id'" ;
            }
        }*/
        $sql="update ".MEMBER." set lastLoginTime='".time()."' $str WHERE userid='$re[userid]'";
        $db->query($sql);

        /*if(!empty($post['connect_id']))
        {
            $sql="update ".USERCOON." set userid='$re[userid]' where id='$post[connect_id]'";
            $db->query($sql);
        }*/

        //自动根据openid登录操作
        if ($re[userid] && $_SESSION['openid_f'])
        {
            $sql = "update " . MEMBER . " SET `open_id`='" . $_SESSION['openid_f'] . "' WHERE `userid`='$re[userid]' AND open_id = ''";
			
            $re = $db -> query($sql);
        }
    }

    //数据入库
    public function doreg($mobile=null,$password=null)
    {
        global $db;
        $user = 'mayi'.$mobile;
        $pass = addslashes($password);
        $mobile = $mobile;
        $lastLoginTime = time();
        $regtime = date("Y-m-d H:i:s");
        $user_reg = "2";

        $sql="insert into ".MEMBER." (user,password,ip,lastLoginTime,email,mobile,regtime,statu,email_verify,mobile_verify) values ('$user','".$pass."','NULL','$lastLoginTime','','$mobile','$regtime','$user_reg','0','1')";
        $re=$db->query($sql);
        $userid=$db->lastid();

        if($userid)
        {
            $sql="INSERT INTO ".MEMBERINFO." (member_id) VALUES ('$userid')";
            $re=$db->query($sql);
            if($re)
            {
                $post['userid'] = $userid;
                $post['email'] = $user;
                $pay_id = member_get_url($post,true);
                if($pay_id)
                {
                    $sql="update ".MEMBER." set pay_id='$pay_id' where userid='$userid'";
                    $re=$db->query($sql);
                }
                //-------------绑定一键连接

                if(!empty($_REQUEST['connect_id']))
                {
                    $sql="update ".USERCOON." set userid='$userid' where id='$_REQUEST[connect_id]'";
                    $db->query($sql);
                }

                $sql="update pay_member set mobile_verify=true, pay_mobile = '$mobile' where userid=".$userid;
                $db->query($sql);
                $sql="update ". MEMBER ." set mobile_verify = 1 where userid=".$userid;
                $db->query($sql);
            }
        }
    }

    private function authcode($string, $operation = 'DECODE', $key = '', $expiry = 0) {

        $ckey_length = 4;

        $key = md5($key ? $key : $this->secret);
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

$obj = new passport();