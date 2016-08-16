<?php

/**
 * Created by PhpStorm.
 * User: wonder
 * Date: 2016/8/15
 * Time: 12:01
 * describe:
 * 			1、功能：注册、登录、找回密码、修改密码、用户中心关联、登录互联
 * 			2、
 */

class login
{

	private $_account = '';
	private $_password = '';
	private $_config = '';
	private $_db = '';
	private $_userinfo = '';//存储用户信息
	private $_action = '';//请求方法名
	private $_response_code = '';//回调状态
	private $_response_data = '';//回调数据
	private $_error = array(
        '00000'=>'登录成功！',
        '10001'=>'亲！玩我呢！',
        '10002'=>'请求的方法不存在！',
        '10003'=>'请输入帐号和密码',
        '10004'=>'请输入帐号',
        '10005'=>'帐号与密码不匹配'
    );

	public function __construct(){
        global $config,$db;
        
		$post = !empty($_POST)?$_POST:$this->_response_code='10001';
		if (empty($post['username'])) $this->_response_code='10004'; else $this->_account = $post['username'];
		if (empty($post['password'])) $this->_response_code='10005'; else $this->_password = $post['password'];
		
		if(!empty($this->_account) && !empty($this->_password)){
			
			$this->_config = $config;
       		$this->db = $db;
			if (method_exists($this,$this->_action)) {
                call_user_func(array($this,$this->_action));
            }else{
                // 请求的方法不存在
                $this->_response_code='10001';
            }
		}
		
        $this->response();
	}

	private function response(){
		echo json_decode(array('status'=>$this->_response_code,'errmsg'=>$this->_error[$this->_response_code],'data'=>$this->_response_data));die;

	}
	/*
	 *登录
	 *param array('account'=>'','password'=>'') 数组
	 *
	 *return 状态 
	 **/
	private function login($users=''){
		

	}

	/*
	*注册
	* 
	*/
	private function register(){

	}

	/*
	*找回密码
	* 
	*/
	private function lostpass(){

	}

	/*
	*修改密码
	* 
	*/
	private function updatepass(){

	}

}
include_once("../includes/global.php");
$obj = new login();