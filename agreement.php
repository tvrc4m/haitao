<?php
include_once("includes/global.php");
include_once("includes/smarty_config.php");
include_once("footer.php");
$tpl->assign("is_wechat",false);
//微信分享
if ($config['bw'] == "weixin")
{
	include_once("pay/module/payment/lib/WxPayPubHelper/WxPay.pub.config.php");
	/**
	if(!isset($_SESSION['access_token']) || (time()-$_SESSION['tmpTime'])>7200)
	{
		//获取微信票据
		$date = file_get_contents("https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=" . WxPayConf_pub::APPID . "&secret=" . WxPayConf_pub::APPSECRET);
		$wobj = json_decode($date);
		$_SESSION['access_token'] = $wobj -> access_token;

		if(isset($wobj -> access_token))
		{
			$tmp = file_get_contents("https://api.weixin.qq.com/cgi-bin/ticket/getticket?access_token=".$wobj -> access_token."&type=jsapi");
			$tobj = json_decode($tmp);
			$_SESSION['ticket'] = $tobj->ticket;
		}

		$_SESSION['tmpTime'] = time();
	}
	{
		$_SESSION['noncestr'] = randomkeys(12);

		$strTmp = "https://".$_SERVER['HTTP_HOST'];
		if(!empty($_SERVER['REQUEST_URI']))
		{
			$strTmp .= $_SERVER['REQUEST_URI'];
		}
		$_SESSION['appid'] = WxPayConf_pub::APPID;
		$str_tmp = "jsapi_ticket=".$_SESSION['ticket']."&noncestr=".$_SESSION['noncestr']."&timestamp=".$_SESSION['tmpTime']."&url=".$strTmp;
		$_SESSION['signature'] = sha1($str_tmp);
	}
	*/
	include_once("includes/jssdk.php");
	$jssdk = new JSSDK(WxPayConf_pub::APPID,WxPayConf_pub::APPSECRET);
	$wechat_share_data = $jssdk->getSignPackage();
	$tpl->assign("wechat_share",$wechat_share_data);
	$tpl->assign("is_wechat",true);

}
$tpl->display('agreement.htm');
?>