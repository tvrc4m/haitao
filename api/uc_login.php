<?php 
/**
 * User: wonder
 * Time: 2016/8/18
 * describe:
 * 		用户中心：注册、登录、找回密码、修改密码
 */
include_once("../includes/global.php");
include_once($config['webroot']."/includes/verification.php");
include_once($config['webroot']."/includes/uc_server.php");

class uc_login extends verification
{
	protected $_account = '';//用户
	private $_password = '';//密码
	private $_password_old = '';//旧密码
	private $_yzm = '';
	protected $_yzm_mobile = '';
	private $_users = '';
	private $_uc_users = '';//用户中心用户
	private $_uc_obj = '';//对象（用户中心）
	private $_type = '';
	protected $_config = '';
	private $_db = '';
	private $_userinfo = '';//存储用户信息
	protected $_action = '';//请求方法名
	protected $_response_code = '';//回调状态
	protected $_response_data = null;//回调数据
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
	
	function __construct()
	{
		global $config,$db;
		$post = !empty($_REQUEST)?$_REQUEST:$this->_response_code='10001';
		$this->_action = $post['action'];

		$this->_uc_obj = new Uc_server();
		if (empty($post['username'])) $this->_response_code='10004'; else $this->_account = $post['username'];
		if (empty($post['password'])) $this->_response_code='10005'; else $this->_password = md5(addslashes($post['password']));
		if (!empty($post['password_old'])&&$post['action']=='updatepass')$this->_password_old = md5(addslashes($post['password_old']));
		if(!empty($post['type']))$this->_type = $post['type'];
		if(empty($post['smsvode']))$this->_response_code = '10020'; else $this->_yzm = $post['smsvode'];

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
		var_dump(array('status'=>$this->_response_code,'errmsg'=>$this->_error[$this->_response_code],'data'=>$this->_response_data));die;
		// echo json_encode(array('status'=>$this->_response_code,'errmsg'=>$this->_error[$this->_response_code],'data'=>$this->_response_data));die;

	}

	/**
	 * [login description]
	 * @return [type] [description]
	 */
	private function login(){
		if(empty($this->_users['mobile'])){$this->_response_code = '10013';return false;}
	    if(substr($this->_users['password'],0,4)=='lock'){$this->_response_code = '10007';return false;}
		var_dump(111);die;
	}

	/**
	 * uc_users
	 * 用户中心用户
	 */
	private function uc_users(){


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
}
$obj = new uc_login();

 ?>