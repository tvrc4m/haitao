<?php 
/**
 * User: wonder
 * Time: 2016/8/18
 * describe:
 * 		用户中心：注册、登录、找回密码、修改密码
 */
include_once("../includes/global.php");
include("./verification.php");

class uc_login extends verification
{
	
	function __construct(argument)
	{
		if(!empty($this->_account)){
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
		//var_dump(array('status'=>$this->_response_code,'errmsg'=>$this->_error[$this->_response_code],'data'=>$this->_response_data));die;
		echo json_encode(array('status'=>$this->_response_code,'errmsg'=>$this->_error[$this->_response_code],'data'=>$this->_response_data));die;

	}
}

 ?>