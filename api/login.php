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
	private $_response_data = null;//回调数据
	private $_error = array(
        '00000'=>'登录成功！',
        '10001'=>'亲！玩我呢！',
        '10002'=>'请求的方法不存在！',
        '10003'=>'请输入帐号和密码',
        '10004'=>'请输入帐号',
        '10005'=>'请输入密码',
        '10006'=>'帐号与密码不匹配',
        '10007'=>'帐号已锁！',
        '10008'=>'短信发送成功！',
        '10009'=>'该手机号已存在！',
        '10010'=>'请填正确的手机号！',
        '10011'=>'注册成功！',
        '10012'=>'注册失败！',
        '10013'=>'用户不存在！',
    );

	public function __construct(){
        global $config,$db;

		$post = !empty($_REQUEST)?$_REQUEST:$this->_response_code='10001';
		$this->_action = $post['action'];
		if (empty($post['username'])) $this->_response_code='10004'; else $this->_account = $post['username'];

		if($this->_action == 'login' || $this->_action == 'register' || $this->_action == 'lostpass'){
			if (empty($post['password'])) $this->_response_code='10005'; else $this->_password = md5(addslashes($post['password']));
		}
		if(!empty($this->_account) && !empty($this->_password)){
			
			$this->_config = $config;
       		$this->_db = $db;
       		
			if (method_exists($this,$this->_action)) {
                call_user_func(array($this,$this->_action));
            }else{
                // 请求的方法不存在
                $this->_response_code='10002';
            }
		}

        $this->response();
	}

	private function response(){
		var_dump(array('status'=>$this->_response_code,'errmsg'=>$this->_error[$this->_response_code],'data'=>$this->_response_data));die;
		//echo json_decode();die;

	}
	/*
	 *登录
	 *param array('account'=>'','password'=>'') 数组
	 *
	 *return 状态 
	 **/
	private function login(){

		global $post,$config;

	    $sql="select userid,user,statu,pid,password from ".MEMBER." where mobile = {$this->_account}";
	    $this->_db->query($sql);
	    $re=$this->_db->fetchRow();
	    if(substr($re['password'],0,4)=='lock'){$this->_response_code = '10007';return false;}
	    if ($this->_password==$re['password']) {
	    	bsetcookie("USERID",$re['userid']."\t".$re['user']."\t".$re['pid'],NULL,"/",$this->_config['baseurl']);

			$sql="update ".MEMBER." set lastLoginTime='".time()."' WHERE userid='{$re['userid']}'";
			$this->_db->query($sql);
	    	$this->_response_code = '00000';
	    	return false;
	    }else{
			$this->_response_code = '10006';
			return false;
	    }
	    
	}

	/**
	 * [register description]
	 * 注册
	 * @return [type] [description]
	 */
	private function register(){
		if(!$this->checkData($this->_account,'mobile')){$this->_response_code = '10010';return false;}
		if($this->users()){$this->_response_code = '10009';return false;}
		$type = $this->doreg();
		if($type)
			$this->_response_code = '10011';
		else
			$this->_response_code = '10012';
	}

	/*
	*找回密码
	* 
	*/
	private function lostpass(){
		if(!$this->checkData($this->_account,'mobile')){$this->_response_code = '10010';return false;}
		if(!$this->users()){$this->_response_code = '10013';return false;}
		echo 111;die;

	}

	/*
	*修改密码
	* 
	*/
	private function updatepass(){

	}

	/**
	 * [mobile description]
	 * @return [type] [description]
	 */
	// public function mobile(){
	// 	//验证手机号
	// 	if(!empty($_POST['mobile'])&&$_POST['check_mobile']=='check'){
	// 	    if(checkData($_POST['mobile'], 'mobile')){
	// 	        if(Check_only($_POST['mobile'], 'mobile', MEMBER)){
	// 	            die(Return_data(array('status_code' => '300', 'message' => '该手机号已存在！', 'data' => null )));
	// 	        }else{
	// 	            $_SESSION['mon_yzm']['ph'] = 1;
	// 	            die(Return_data(array('status_code' => '200', 'message' => '手机号可用！', 'data' => null )));
	// 	        }
	// 	    }else{
	// 	        die(Return_data(array('status_code' => '300', 'message' => '请填正确的手机号！', 'data' => null )));
	// 	    }
	// 	}
	// }

	/**
	 * 数据格式验证
	 */
	private function checkData($data = null, $keyval = null){
	    $res = null;
	    switch($keyval){
	        case 'user' : $res = preg_match('/^[A-Za-z0-9\x{4e00}-\x{9fa5}]{4,16}$/u', $data);  break;
	        case 'mobile' : $res = preg_match('/^1(3[0-9]|4[57]|5[0-35-9]|8[0-9]|7[07])\d{8}$/', $data);  break;
	        case 'smsvode' : $res = preg_match('/^[0-9]{6}$/', $data);  break;
	        case 'password' : $res = preg_match('/^[\s\S]{6,16}$/', $data);  break;
	    }
	    return $res;
	}

	/**
	 * [rand_pwd description]
	 * @return [type] [description]
	 */
	public function rand_pwd(){
		$str = null;
		$strPol = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789abcdefghijklmnopqrstuvwxyz";
		$max = strlen($strPol)-1;

		for($i=0;$i<6;$i++){
			$str.=$strPol[rand(0,$max)];
		}

		return $str;
	}

	//短信发送
	public function Send_msg($mob = null, $con = null)
	{
		global $config;
		include_once("{$this->_config['webroot']}/module/sms/includes/plugin_sms_class.php");
		$sms = new sms();
		$str = $sms->send($mob, $con);
		$res = json_decode(iconv("gb2312", "utf-8//IGNORE", urldecode($str)),true);
		if($res['error']==0&&$res['msg']=='ok'){
			return 1;
		}else{
			return 2;
		}
	}

	private function users(){
		$sql = "select userid from ".MEMBER." where mobile={$this->_account}";
		$this->_db->query($sql);
		$type = $this->_db->fetchField('userid');
		return empty($type)?false:true;
	}
	/**
	 * [doreg description]
	 * @return [type] [description]
	 */
	private function doreg(){

	    $user = 'mayi'.$this->_account;
	    $lastLoginTime = time();
	    $regtime = date("Y-m-d H:i:s");
	    $user_reg = "2";

	    $sql="insert into ".MEMBER." (user,password,ip,lastLoginTime,email,mobile,regtime,statu,email_verify,mobile_verify) values ('$user','{$this->_password}','NULL','{$lastLoginTime}','','{$this->_account}','{$regtime}','{$user_reg}','0','1')";
	    $re=$this->_db->query($sql);
	    $userid=$this->_db->lastid();

	    if($userid)
	    {
	        $sql="INSERT INTO ".MEMBERINFO." (member_id) VALUES ('{$userid}')";
	        $re=$this->_db->query($sql);
	        if($re)
	        {
	            $post['userid'] = $userid;
	            $post['email'] = $user;
	            $post['pay_mobile'] = $this->_account;
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

}
include_once("../includes/global.php");
$obj = new login();