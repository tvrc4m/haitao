<?php
/**
* 	配置账号信息
*/
global $db;

$web_u = "http://".$_SERVER['HTTP_HOST'];
//获取access_token过程中的跳转uri，通过跳转将code传入jsapi支付页面
defined("JS_API_CALL_URL_A") or define(JS_API_CALL_URL_A , urlencode($web_u."/index.php"));

//证书路径,注意应该填写绝对路径
defined("SSLCERT_PATH_A") or define(SSLCERT_PATH_A , dirname(__FILE__)."/cacert/apiclient_cert.pem");
defined("SSLKEY_PATH_A") or define(SSLKEY_PATH_A , dirname(__FILE__)."/cacert/apiclient_key.pem");

//异步通知url，商户根据实际开发过程设定
defined("NOTIFY_URL_A") or define(NOTIFY_URL_A , $web_u."/pay/api/wx_notify_url.php");


defined("PAYMENT") or define(PAYMENT , "pay_type");


// 这里 PAYMENT 直接写固定啦
$sql = "select `payment_config` from ".PAYMENT." where `payment_type` = 'wx_pay' ";
$db->query($sql);
$re_wx_config = $db->fetchField("payment_config");
$re_wx_config = unserialize($re_wx_config);

foreach ($re_wx_config as $key => $val)
{
	if($val['name'] == 'APPID')
	{
		defined($val['name']."_A") or define($val['name']."_A" , $val['value']);
	}
	else
	{
		defined($val['name']."_A") or define($val['name']."_A" , $val['value']);
	}
}


class WxPayConf_pub
{
	//=======【基本信息设置】=====================================
	//微信公众号身份的唯一标识。审核通过后，在微信发送的邮件中查看
	const APPID = APPID_A;
	//受理商ID，身份标识
	const MCHID = MCHID_A;
	//商户支付密钥Key。审核通过后，在微信发送的邮件中查看
	const KEY = KEY_A;
	//JSAPI接口中获取openid，审核后在公众平台开启开发模式后可查看
	const APPSECRET = APPSECRET_A;
	
	//=======【JSAPI路径设置】===================================
	//获取access_token过程中的跳转uri，通过跳转将code传入jsapi支付页面
	const JS_API_CALL_URL = JS_API_CALL_URL_A;
	//const JS_API_CALL_URL = urlencode('http://dsh.vdiy.cn/pay/?m=payment&s=pay');
	
	//=======【证书路径设置】=====================================
	//证书路径,注意应该填写绝对路径
	const SSLCERT_PATH = SSLCERT_PATH_A;
	const SSLKEY_PATH = SSLKEY_PATH_A;
	
	//=======【异步通知url设置】===================================
	//异步通知url，商户根据实际开发过程设定
	const NOTIFY_URL = NOTIFY_URL_A;

	//=======【curl超时设置】===================================
	//本例程通过curl使用HTTP POST方法，此处可修改其超时时间，默认为30秒
	const CURL_TIMEOUT = 30;
}
?>