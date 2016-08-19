<?php

/**
 * Created by PhpStorm.
 * User: wonder
 * Date: 2016/8/15
 * Time: 12:01
 * describe:
 * 			1、功能：注册、登录、找回密码、修改密码
 */
include_once("../includes/global.php");
include_once($config['webroot']."/includes/verification.php");
class login extends verification
{

	protected $_account = '';//用户
	private $_password = '';//密码
	private $_password_old = '';//旧密码
	private $_yzm = '';
	protected $_yzm_mobile = '';
	private $_users = '';
	private $_type = '';
	protected $_config = '';
	private $_db = '';
	private $_userinfo = '';//存储用户信息
	protected $_action = '';//请求方法名
	protected $_response_code = '';//回调状态
	protected $_response_data = null;//回调数据
	protected $_old_url = '';
	protected $_error = array(
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
        '10014'=>'密码修改成功！',
        '10015'=>'密码修改失败！',
        '10016'=>'密码不对！',
        '10017'=>'短信发送成功，请注意查收!',
        '10018'=>'操作过于频繁!',
        '10019'=>'请再次申请短信验证码',
        '10020'=>'请填写正确的验证码!',
        '10021'=>'验证码已失效!'
    );

	public function __construct(){
		
        global $config,$db;
		$post = !empty($_REQUEST)?$_REQUEST:$this->_response_code='10001';
		$this->_action = $post['action'];

		if (empty($post['username'])) $this->_response_code='10004'; else $this->_account = $post['username'];
		if (empty($post['password'])) $this->_response_code='10005'; else $this->_password = md5(addslashes($post['password']));
		if (!empty($post['password_old'])&&$post['action']=='updatepass')$this->_password_old = md5(addslashes($post['password_old']));
		if(!empty($post['type']))$this->_type = $post['type'];
		if(empty($post['smsvode']))$this->_response_code = '10020'; else $this->_yzm = $post['smsvode'];
		if(!empty($post['url']))$this->_old_url = $post['url'];

		$this->_yzm_mobile = 'mon_yzm_'.$this->_account;
		
		$this->_config = $config;
   		$this->_db = $db;
   		if(parent::checkData($this->_account,'mobile')){
   			$this->users();
			if(!empty($this->_account)){
				if (method_exists($this,$this->_action)) {
	                call_user_func(array($this,$this->_action));
	            }else{
	                // 请求的方法不存在
	                $this->_response_code='10002';
	            }
			} 
		}else $this->_response_code = '10010';

        $this->response();
	}

	private function response(){
		//var_dump(array('status'=>$this->_response_code,'errmsg'=>$this->_error[$this->_response_code],'data'=>$this->_response_data));die;
		echo json_encode(array('status'=>$this->_response_code,'errmsg'=>$this->_error[$this->_response_code],'url'=>$this->_response_data));die;

	}
	/*
	 *登录
	 *param array('account'=>'','password'=>'') 数组
	 *
	 *return 状态 
	 **/
	private function login(){
		if(empty($this->_users['mobile'])){$this->_response_code = '10013';return false;}
	    if(substr($this->_users['password'],0,4)=='lock'){$this->_response_code = '10007';return false;}
	    if ($this->_password==$this->_users['password']) {
	    	$this->login_success();
	    	$this->_response_code = '00000';
	    	$this->_response_data = $this->_old_url;
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
		if(!empty($this->_users['mobile'])){$this->_response_code = '10009';return false;}
        if($this->_yzm==$_SESSION[$this->_yzm_mobile]['yzm']){
			if($_SESSION[$this->_yzm_mobile]['ytime']<time()){
				$this->_response_code = '10021';
			}else{
				$type = $this->doreg();
				if($type){
					$this->login_success();
					$this->_response_code = '10011';
					$this->_response_data = $this->_old_url;
					session_unset($_SESSION[$this->_yzm_mobile]);
				}else
					$this->_response_code = '10012';
				
	        }
		}else{
			$this->_response_code = '10020';
		}
		return false;
	}

	/*
	*找回密码
	* 
	*/
	private function lostpass(){
		if(empty($this->_users['mobile'])){$this->_response_code = '10013';return false;}
        if($this->_yzm==$_SESSION[$this->_yzm_mobile]['yzm']){
			if($_SESSION[$this->_yzm_mobile]['ytime']<time()){
				$this->_response_code = '10021';
			}else{
				$status = $this->update_pwd();
				if ($status){
					$this->_response_code = '10014';
					$this->_response_data = $this->_config['weburl'].'/login.php';
					session_unset($_SESSION[$this->_yzm_mobile]);
				}else
					$this->_response_code = '10015';
	        }
		}else{
			$this->_response_code = '10020';
		}

		return false;
	}

	/*
	*修改密码
	* 
	*/
	private function updatepass(){
		if(empty($this->_users['mobile'])){$this->_response_code = '10013';return false;}
		if($this->_users['password']!=$this->_password_old)
			$this->_response_code = '10016';
		else{
			$status = $this->update_pwd();
			if ($status){
				$this->_response_data = $this->_config['weburl'].'/login.php';
				$this->_response_code = '10014';
			}else
				$this->_response_code = '10015';
		}

		return false;
	}

	/**
	 * 验证码
	 */
	private function yzCode(){
		if($this->_type=='register'){
			if(!empty($this->_users['mobile'])){$this->_response_code = '10009';return false;}
		}
		if($this->_type=='lostpass'){
			if(empty($this->_users['mobile'])){$this->_response_code = '10013';return false;}
		}
		parent::yzm();

		return false;
	}
	

	/**
	 * [users description]
	 * @return [type] [description]
	 */
	private function users(){
		$sql = "select userid,user,statu,pid,password,mobile from ".MEMBER." where mobile={$this->_account}";
		$this->_db->query($sql);
		$this->_users = $this->_db->fetchRow();

		return empty($this->_users)?false:true;
		
	}

	/**
	 * 修改密码
	 */
	private function update_pwd(){
		$sql = "update ".MEMBER." set password='{$this->_password}' where userid='{$this->_users['userid']}'";
		$status = $this->_db->query($sql);

		return empty($status)?false:true;
	}

	/**
	 * 登录成功
	 */
	private function login_success(){
		bsetcookie("USERID",$this->_users['userid']."\t".$this->_users['user']."\t".$this->_users['pid'],NULL,"/",$this->_config['baseurl']);

		$sql="update ".MEMBER." set lastLoginTime='".time()."' WHERE userid='{$this->_users['userid']}'";
		$this->_db->query($sql);

		return false;
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
		$ip = getip();
		$ip = empty($ip)?NULL:$ip;

	    $sql="insert into " . MEMBER . " (user,password,ip,lastLoginTime,email,mobile,regtime,statu,email_verify,mobile_verify) values ('$user','{$this->_password}','{$ip}','{$lastLoginTime}','','{$this->_account}','{$regtime}','{$user_reg}','0','1')";
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

$obj = new login();