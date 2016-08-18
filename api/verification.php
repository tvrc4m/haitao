<?php
/**
 * User: wonder
 * describe:
 * 		功能：发送验证码
 */
class verification
{
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
        '10014'=>'密码修改成功！',
        '10015'=>'密码修改失败！',
        '10016'=>'密码不对！',
        '10017'=>'短信发送成功！'
    );

	public function __construct(){
		
			

        $this->response();

	}

	private function response(){
		var_dump(array('status'=>$this->_response_code,'errmsg'=>$this->_error[$this->_response_code],'data'=>$this->_response_data));die;
		//echo json_decode();die;

	}

	/**
	 * [yzm description]
	 * @return [type] [description]
	 */
	public function yzm(){
		 $this->_response_code='10002';
		return '111';
		 if(checkData($_POST['mobile'], 'mobile')){
         if(empty($_SESSION['mon_yzm'])||$_SESSION['mon_yzm']['ltime']<time()) {
            if($_SESSION['mon_yzm']['lasttime']<=time()){
                $_SESSION['mon_yzm']['lnum'] = 1;
            }
            if(empty($_SESSION['mon_yzm']['lnum'])||$_SESSION['mon_yzm']['lnum']<=3) {
                $number = rand(100000,999999);
                if (Send_msg($_POST['mobile'], sprintf('您本次注册蚂蚁海淘的验证码是%s有效期为%s分钟', $number, 10)) == 1) {

                    if(date('i',time()-$_SESSION['mon_yzm']['ltime'])<5){
                        $vser['lnum'] =  $_SESSION['mon_yzm']['lnum']+1;
                    }
                    $vser['yzm'] = $number;
                    $vser['ytime'] = time() + 60 * 10;
                    $vser['ltime'] = time() + 60;
                    $vser['lasttime'] = time() + 60 * 60;
                    $_SESSION['mon_yzm'] = $vser;
                    die(Return_data(array('status_code' => '200', 'message' => '短信发送成功，请注意查收', 'data' => null )));
                }
            }else{
               die(Return_data(array('status_code' => '300', 'message' => sprintf('操作过于频繁，%s后再试！',date('i分s秒', $_SESSION['mon_yzm']['lasttime']-time())), 'data' => $_SESSION['mon_yzm']['ltime']-time() )));
            }
        }else{
            die(Return_data(array('status_code' => '300', 'message' => sprintf('请在%s秒后再次申请短信验证码',$_SESSION['mon_yzm']['ltime']-time()), 'data' => $_SESSION['mon_yzm']['ltime']-time() )));
        }
    	}
	}

}

?>