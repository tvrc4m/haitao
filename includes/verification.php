<?php
/**
 * User: wonder
 * describe:
 * 		功能：发送验证码、验证
 */
class verification
{

	/**
	 * 数据格式验证
	 */
	public function checkData($data = null, $keyval = null){
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

	/**
	 * [yzm description]
	 * @return [type] [description]
	 */
	public function yzm(){
	

		if(empty($_SESSION[$this->_yzm_mobile])||$_SESSION[$this->_yzm_mobile]['ltime']<time()) {
            if($_SESSION[$this->_yzm_mobile]['lasttime']<=time()){
                $_SESSION[$this->_yzm_mobile]['lnum'] = 1;
            }
            if(empty($_SESSION[$this->_yzm_mobile]['lnum'])||$_SESSION[$this->_yzm_mobile]['lnum']<=3){
                $number = rand(100000,999999);
                if ($this->Send_msg($this->_account, sprintf('您本次注册蚂蚁海淘的验证码是%s有效期为%s分钟', $number, 10)) == 1) {

                    $vser['lnum'] =  $_SESSION[$this->_yzm_mobile]['lnum']+1;
                    $vser['yzm'] = $number;
                    $vser['ytime'] = time() + 60 * 10;
                    $vser['ltime'] = time() + 60;
                    $vser['lasttime'] = time() + 60 * 60;
                    $_SESSION[$this->_yzm_mobile] = $vser;
                    $this->_response_code = '10017';
                    return true;
                }
            }else{
            	$this->_response_code = '10018';
            	$this->_error[$this->_response_code]= sprintf('操作过于频繁，%s后再试！',date('i分s秒', $_SESSION[$this->_yzm_mobile]['lasttime']-time()));
            	return false;
            }
        }else{
        	$this->_response_code = '10019';
        	$this->_error[$this->_response_code]= sprintf('请在%s秒后再次申请短信验证码',$_SESSION[$this->_yzm_mobile]['ltime']-time());
        	return false;
        }
	}

}

?>