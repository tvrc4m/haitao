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

    public function __construct()
    {
        $this->_mobile = '';
        $this->_pwd = '';
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
        echo 111;die;
    }

    /*
     * 注册
     * */
    public function uc_register(){

    }

    /*
     * 退出
     * */
    public function uc_logout(){

    }



}

$obj = new passport();