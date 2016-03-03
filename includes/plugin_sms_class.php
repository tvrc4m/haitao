<?php
class sms
{
	var $db;
	var $tpl;
	var $page;
	function sms()
	{
		global $db;
		global $config;
		global $tpl;		
		$this -> db     = & $db;
		$this -> tpl    = & $tpl;
	}
	
	function send($mob,$content)
	{
		global $config;
		include_once($config['webroot']."/config/sms_config.php");
		
		$name=$sms_config['sms_account'];
		$password=$sms_config['sms_pass'];
		$sigin=$sms_config['sms_sigin'];
		$mob=$_POST['mob']?$_POST['mob']:$mob;
		/**$content=urlencode($_POST['con']?$_POST['con']:$content);
		$content = iconv("utf-8","gb2312//IGNORE",$content);
		*/
		$content=$_POST['con']?$_POST['con']:$content;
		$url="http://sms-api.luosimao.com/v1/send.json";
		return $this->curl_post($url,$password,array('mobile' => $mob, 'message' =>$content.$sigin));
		/**
		$url="http://sms.b2b-builder.com/sms.php?name=".$name."&password=".$password."&mob=".$mob."&content=".$content;
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
		curl_setopt($ch, CURLOPT_URL, $url);
		$result =  curl_exec($ch);
		curl_close($ch);
		return $result;
		*/
	}
	private function curl_post($url,$api_key,$parameter){
		$ch = curl_init(); 
		// 设置传输选项
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_HEADER, false);

		curl_setopt($ch, CURLOPT_HTTPAUTH , CURLAUTH_BASIC);
		curl_setopt($ch, CURLOPT_USERPWD , 'api:key-' . $api_key);

		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $parameter); 
		// 执行一个curl会话
		$res = curl_exec($ch); 
		// 关闭curl会话
		curl_close($ch);
		if (empty($res)) {
			return '发送失败';
		} 
        else
        {
            
            return $res;
            
        }
    }
}
?>
