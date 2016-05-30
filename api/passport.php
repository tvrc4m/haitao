<?php
/**
 * Created by PhpStorm.
 * User: wonder
 * Date: 2016/5/30
 * Time: 15:35
 */
include_once("../includes/uc_server.php");

class passport extends Uc_server{

    private $_mobile;

    public function __construct()
    {
        $config['uc_appid']='201605270933';
        $config['uc_secret']='g23fa33gbsd1gdd03152ed213c52ed6d1';
        $config['uc_server']='http://t.mayionline.cn/apis/uc';
        parent:: __construct($config);
        var_dump($this->login(array('phone'=>'15011426118','password'=>'111111')));

    }
    /*
     * 登陆
     * */
    public function uc_login(){

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