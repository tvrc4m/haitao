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

    private $_response_code;

    private $_error = array(
        '00000'=>'操作成功',
        '10001'=>'请求方法不存在',
        '10002'=>'签名已失效',
        '10003'=>'签名验证失败',
        '10004'=>'ip受限',
    );

    public function __construct($data='')
    {
        $this->_mobile = $data['mobile'];
        $this->_pwd = $data['pwd'];
        $config['uc_appid']='201605270933';
        $config['uc_secret']='g23fa33gbsd1gdd03152ed213c52ed6d1';
        $config['uc_server']='http://t.mayionline.cn/apis/uc';
        parent:: __construct($config);
        $this->_action = !empty($_GET['action'])?$_GET['action']:'';

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
        global $db;
        $aa = parent::login(array('phone'=>'15011426118','password'=>'123456'));
        var_dump($aa);die;
        //验证手机号登录
        if(preg_match('/^1(3[0-9]|4[57]|5[0-35-9]|8[0-9]|7[07])\d{8}$/', $post['user']))
            $sql="select * from ".MEMBER." where mobile='$post[user]'";
        else
            $sql="select * from ".MEMBER." where  user='$post[user]'";
        $db->query($sql);
        $re=$db->fetchRow();

        if($re["userid"])
        {
            if($re['statu']=='-2'){
                msg("login.php?erry=-5&connect_id=$post[connect_id]");
            }
            if(substr($re['password'],0,4)=='lock')
                msg("login.php?erry=-4&connect_id=$post[connect_id]");
            if($re['password']!=md5($post['password']))
                msg("login.php?erry=-2&connect_id=$post[connect_id]");

            if($re["password"]==md5($post['password']))
            {
                if($re['pid'])
                    login($re['pid'],$re['user'],$re['userid']);
                else
                    login($re['userid'],$re['user']);
                if(!empty($post['forward'])){
                    $forward = $post['forward']?$post['forward']:$config["weburl"]."/main.php?cg_u_type=1";
                    msg($forward);
                }else{
                    msg($_COOKIE['old_url']);
                }
                setcookie("old_url");
                setcookie("userid",$re['userid']);
            }
        }
    }

    /*
     * 注册
     * */
    public function uc_register(){
       $arr =  $this->userinfo(array('phone'=>'15011426118 '));
        var_dump($arr);
    }

    /*
     * 退出
     * */
    public function uc_logout(){

    }

    public function login($uid,$username,$pid=NULL,$type=NULL)
    {
        global $db,$post,$config;

        if($uid)
            $sql="select pay_id,userid,user,statu from ".MEMBER." a where a.userid='$uid'";
        else
            $sql="select pay_id,userid,user,statu from ".MEMBER." where user='$username'";
        $db->query($sql);
        $re=$db->fetchRow();
        if($type)
            $time=time()+3600*24*7;
        else
            $time=NULL;

        bsetcookie("USERID","$uid\t$re[user]\t$pid",$time,"/",$config['baseurl']);
        setcookie("USER",$re['user'],$time,"/",$config['baseurl']);
        setcookie("userid",$re['userid']);

        $_SESSION["STATU"]=$re['statu'];
        $str = "" ;
        if(!$re['pay_id'])
        {
            $post['userid'] = $re['userid'];
            $post['email'] = $re['user'];
            $pay_id = member_get_url($post,true);
            if($pay_id)
            {
                $str = " , pay_id='$pay_id'" ;
            }
        }
        $sql="update ".MEMBER." set lastLoginTime='".time()."' $str WHERE userid='$uid'";
        $db->query($sql);

        //--------------------------------------qq
        if(!empty($post['connect_id']))
        {
            $sql="update ".USERCOON." set userid='$uid' where id='$post[connect_id]'";
            $db->query($sql);
        }


        //自动根据openid登录操作
        if ($uid && $_SESSION['openid_f'])
        {
            $sql = "update " . MEMBER . " SET `open_id`='" . $_SESSION['openid_f'] . "' WHERE `userid`='$uid' AND open_id = ''";
            $re = $db -> query($sql);
        }
    }



}

$obj = new passport();