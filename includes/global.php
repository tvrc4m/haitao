<?php


error_reporting(E_ERROR|E_WARNING|E_PARSE|E_USER_ERROR|E_USER_WARNING);//6143
if (function_exists('session_cache_limiter'))
{
	session_cache_limiter('private, must-revalidate');
}

header('Content-type: text/html; charset=UTF-8');

//强制过期，ajax请求不需要要加随机字符串
header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
header('Cache-Control: no-cache, must-revalidate'); // HTTP/1.1
header('Pragma: no-cache'); // HTTP/1.0

header('P3P: CP=CAO PSA OUR');  //ie iframe cookie

if(@function_exists('date_default_timezone_set'))
	@date_default_timezone_set('Asia/Shanghai');
	
$config['version']='MallBuilder_v7.3.4';
$config['webroot']=substr(dirname(__FILE__), 0, -9);
ini_set('include_path',$config['webroot'].'/');
include_once($config['webroot']."/includes/waf.php");
include_once($config['webroot']."/config/config.inc.php");
include_once($config['webroot']."/config/web_config.php");
include_once($config['webroot']."/config/table_config.php");
include_once($config['webroot']."/includes/convertip.php");
include_once($config['webroot']."/includes/function.php");

if (!get_magic_quotes_gpc())
{
    $a= array();
    //2016-04-05 与下面的魔术方法重叠
	//$_POST    = quotes($_POST);
	$_GET     = quotes($_GET);
	$_REQUEST = quotes($_REQUEST);

}
/*$str = 'https://www.mayihaitao.com/uploadfile/product/44/2016/05/14/1463210011.jpg';
$aa = strpos($str,'haitao.com');
if($aa)
	echo 111;
else
	echo 222;


die;*/

include_once($config['webroot']."/config/uc_config.php");
include_once($config['webroot']."/includes/function.php");
include_once($config['webroot']."/includes/db_class.php");

$db=new dba($config['dbhost'],$config['dbuser'],$config['dbpass'],$config['dbname'],$config['dbport']);
include_once($config['webroot']."/includes/session.php");

if (file_exists($config['webroot']."/config/app_push_config.php"))
{
	include_once($config['webroot']."/config/app_push_config.php");
}
//print_r($_SERVER["HTTP_USER_AGENT"]);die;

//=================================================
$ie6=strpos($_SERVER["HTTP_USER_AGENT"],"MSIE 6.0");
if($ie6)
{
	$script_tmp = explode('/', $_SERVER['SCRIPT_NAME']);
	$sctiptName = array_pop($script_tmp);
	if($sctiptName!="ie6.php")
	{
		//header("Location: ie6.php");
	}
}

//=================================================
if (strpos($_SERVER['HTTP_USER_AGENT'], 'MicroMessenger') !== false ) //判断是否在微信中打开
{
	$config['bw']="weixin";

	/*
	include_once("pay/module/payment/lib/WxPayPubHelper/WxPay.pub.config.php");

	//if(!isset($_SESSION['signature']) || (time()-$_SESSION['tmpTime'])>7200)
	//{
	// 获取微信票据
		$date = file_get_contents("https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=" . WxPayConf_pub::APPID . "&secret=" . WxPayConf_pub::APPSECRET);
		$wobj = json_decode($date);
		$_SESSION['access_token'] = $wobj -> access_token;

		if(isset($wobj -> access_token))
		{
			$tmp = file_get_contents("https://api.weixin.qq.com/cgi-bin/ticket/getticket?access_token=".$wobj -> access_token."&type=jsapi");
			$tobj = json_decode($tmp);
			$_SESSION['ticket'] = $tobj -> ticket;
		}

		$_SESSION['tmpTime'] = time();
		$_SESSION['noncestr'] = randomkeys(12);

		$strTmp = "http://".$_SERVER['HTTP_HOST'];
		if(!empty($_SERVER['REQUEST_URI']))
		{
			$strTmp .= $_SERVER['REQUEST_URI'];
		}


		$_SESSION['appid'] = WxPayConf_pub::APPID;


		$str_tmp = "jsapi_ticket=".$_SESSION['ticket']."&noncestr=".$_SESSION['noncestr']."&timestamp=".$_SESSION['tmpTime']."&url=".$strTmp;
		$_SESSION['signature'] = sha1($str_tmp);
	//}
	*/
}

//=====================end weixin============================


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
		require_once $config['webroot'].'/cs.php';
		//echo '<img src="'._cnzzTrackPageView(1259417015).'" width="0" height="0"/>';
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

$_SESSION['temp'] = $config['temp'];
$data['uc_appid']='201605270933';
$data['uc_secret']='g23fa33gbsd1gdd03152ed213c52ed6d1';
$data['uc_server']='https://m.mayizaixian.cn/apis/uc';
$_SESSION['ucenter_data'] = $data;
//ucenter 0 平台登录 1 用户中心uc登陆
$_SESSION['ucenter']=0;
magic();//魔术调用

//是否启用聊天
$chat_open_flag = false;
/*$_serial=time().rand(100000,999999);
$_endTime = time()+3600*24*7;
$_startTime = time();
$logo=$config['weburl']."/image/red/20.png";
$sql = "insert into  mallbuilder_voucher (`serial`,`temp_id`,`name`,`desc`,`start_time`,`end_time`,`price`,`limit`,`shop_id`,`status`,`create_time`,`member_id`,`member_name`,`logo`,`shop_name`) values ('{$_serial}','2','新用户代金卷','消费300可用','{$_startTime}','{$_endTime}','20','300','','1','".time()."','{$userid}','{$user}','{$logo}','') ";
echo $sql;
var_dump($config);die;*/
Yf_Registry::getInstance();
$b2bbuilder_auth = bgetcookie("USERID");

$buid  = $b2bbuilder_auth['0'];
$buser = $b2bbuilder_auth['1'];

Yf_Registry::set('buid', $buid);

//插件启动
$plugin_rows = array(
);

if (is_file("$config[webroot]/config/distribution_config.php"))
{
	include_once("$config[webroot]/config/distribution_config.php");
}


if (is_file("$config[webroot]/config/sphinx_config.php"))
{
	include_once("$config[webroot]/config/sphinx_config.php");

	$sphinx_search_flag = $sphinx_config['sphinx_statu'];
	$sphinx_search_host = $sphinx_config['sphinx_search_host'];
	$sphinx_search_port = $sphinx_config['sphinx_search_port'];
}
else
{
	$sphinx_search_flag = false;
}

//drp PC访问禁止
/*
if ($distribution_config['distribution_open_flag'] && ($_SESSION['temp']=='default' || $_SESSION['temp']==''))
{
	$path_info = pathinfo($_SERVER['SCRIPT_FILENAME']);

	$pos = strpos($_SERVER['SCRIPT_FILENAME'], 'admin');

	if (('index.php' == $path_info['basename'] || 'login.php' == $path_info['basename']) && $pos===false && $_REQUEST['action'] != 'ajax')
	{
		header('location:./wap_only.php');
		die();
	}
	if ($path_info['filename'] != 'wap_only' && $pos===false)
	{
		//header('location:./wap_only.php');
		//die();
	}
}
*/

$distribution_open_flag = $distribution_config['distribution_open_flag'];
$distribution_visit_flag = $distribution_config['distribution_visit_flag'];
$distribution_reg_flag = $distribution_config['distribution_reg_flag'];
$distribution_buy_flag = $distribution_config['distribution_buy_flag'];
$distribution_commission_min = $distribution_config['distribution_commission_min'];

$distribution_commission_type = $distribution_config['distribution_commission_type'];

if ($distribution_open_flag)
{
	array_push($plugin_rows, array('name'=>'Distribution'));

	if ($distribution_visit_flag)
	{
		array_push($plugin_rows, array('name'=>'Analyse'));
	}
}

if (true)
{
	array_push($plugin_rows, array('name'=>'Point'));
}

$PluginManager = Yf_Plugin_Manager::getInstance($plugin_rows);
$rs = $PluginManager->trigger('init');
?>