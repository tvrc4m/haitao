<?php
error_reporting(E_ERROR|E_WARNING|E_PARSE|E_USER_ERROR|E_USER_WARNING);//6143
header('Content-Type: text/html; charset=utf-8');
if(@function_exists('date_default_timezone_set')){@date_default_timezone_set('Asia/Shanghai');}
$config['version']='MallBuilder_v7.3.4';
$config['http_type'] = "http://";
$config['webroot']=substr(dirname(__FILE__), 0, -9);
ini_set('include_path',$config['webroot'].'/');

include_once($config['webroot']."/config/config.inc.php");
include_once($config['webroot']."/config/web_config.php");
include_once($config['webroot']."/config/table_config.php");
include_once($config['webroot']."/includes/convertip.php");
include_once($config['webroot']."/includes/function.php");
include_once($config['webroot']."/includes/db_class.php");


if (!get_magic_quotes_gpc())
{
	$_POST    = quotes($_POST);
	$_GET     = quotes($_GET);
	$_REQUEST = quotes($_REQUEST);
}


$db=new dba($config['dbhost'],$config['dbuser'],$config['dbpass'],$config['dbname'],$config['dbport']);
include_once($config['webroot']."/includes/session.php");
//=================================================
//$ie6=strpos($_SERVER["HTTP_USER_AGENT"],"MSIE 6.0");
//if($ie6)
//{
//	$script_tmp = explode('/', $_SERVER['SCRIPT_NAME']);
//	$sctiptName = array_pop($script_tmp);
//	if($sctiptName!="ie6.php")
//	{
//		header("Location: ie6.php");
//	}
//}
//=================================================
if (strpos($_SERVER['HTTP_USER_AGENT'], 'MicroMessenger') !== false ) //判断是否在微信中打开
{
	$config['bw']="weixin";
}

if($config['bw'] == "weixin" && (!isset($_SESSION['openid_f']) || $_SESSION['openid_f']==""))
{
	/**
	 * 成功调起支付第一步骤：
	 * 步骤1：网页授权获取用户openid
	*/

	include_once($config['webroot']."/module/payment/lib/WxPayPubHelper/WxPayPubHelper.php");
	//使用jsapi接口
	$jsApi = new JsApi_pub();
	//通过code获得openid
	if (!isset($_GET['code']) && (!isset($_SESSION['openid_f']) || $_SESSION['openid_f']=="")) // && $_GET['m']!="product"
	{
		//$url_temp = WxPayConf_pub::JS_API_CALL_URL;

        $url_temp = $config['http_type'] . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];

		$url_temp = urlencode($url_temp);
		//触发微信返回code码
		$url = $jsApi->createOauthUrlForCode($url_temp);

		header("Location: $url");
	}
	else if(isset($_GET['code']))
	{
		//获取code码，以获取openid
	    $code = $_GET['code'];
		$jsApi->setCode($code);
		$openid = $jsApi->getOpenId();

		$_SESSION['openid_f'] = $openid;

		//自动根据openid登录操作
	}
}
//====================================================
if(is_mobile())
{
	if(!empty($_GET["temp"]))
	{
		$_SESSION['temp']=$_GET['temp'];
		$config['temp']=$_SESSION['temp'];
	}
	if(!empty($_SESSION['temp']))
	{
		$config['temp']=$_SESSION['temp'];
	}
	else
	{
		$config['temp']="wap";
	}
}
else
{
	if(!empty($_GET["temp"]))
	{
		$_SESSION['temp']=$_GET['temp'];
		$config['temp']=$_SESSION['temp'];
	}
	if(!empty($_SESSION['temp']))
		$config['temp']=$_SESSION['temp'];
}
magic();//魔术调用
?>