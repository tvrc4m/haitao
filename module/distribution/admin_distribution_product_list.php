<?php
//微信分享
if ($config['bw'] == "weixin")
{
	include_once("pay/module/payment/lib/WxPayPubHelper/WxPay.pub.config.php");

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

		$strTmp = "http://".$_SERVER['HTTP_HOST'];
		if(!empty($_SERVER['REQUEST_URI']))
		{
			$strTmp .= $_SERVER['REQUEST_URI'];
		}
		$_SESSION['appid'] = WxPayConf_pub::APPID;
		$str_tmp = "jsapi_ticket=".$_SESSION['ticket']."&noncestr=".$_SESSION['noncestr']."&timestamp=".$_SESSION['tmpTime']."&url=".$strTmp;
		$_SESSION['signature'] = sha1($str_tmp);
	}
}
if(!empty($_GET['deid']))
{
	$product_id = intval($_GET['deid']);
	$user_id    = $buid;

	//未加product_lock_flag判断
	$distribution->removeDistributionProduct($user_id, $product_id);
}

//获取详细产品信息
$dist_rows = $distribution->getDistributionProduct($buid);

//根据商品Id获取商品详情
$produce_id_row = array_filter_key('product_id', $dist_rows);
$dist_pro = $distribution->getProductInfo($produce_id_row);

//获取国家馆
foreach($dist_pro as $key => $val){
	$dist_pro[$key]['p_national'] = $distribution->getProductNational($val['national']);
}

$dist_p_rows = array();

foreach ($dist_rows as $k => $row)
{
	$dist_p_rows[$row['product_id']] = $row;
}

$distribution_visit_price = $distribution_config['distribution_visit_price'];

foreach ($dist_pro as $k => $row)
{
	$row['product_lock_flag'] = $dist_p_rows[$row['product_id']]['product_lock_flag'];
	$dist_pro[$k] = $row;

	//判断卖家是否有广告费
	$sellder_row = $distribution->getDistributionUser($row['member_id']);

	if ($sellder_row && $sellder_row['distribution_adv_money'] >0)
	{
		$dist_pro[$k]['share_money'] = $distribution_visit_price;
	}
	else
	{
		$dist_pro[$k]['share_money'] = 0;
	}
}

//============================================
$nocheck=true;

$tpl->assign("taobao_config",$taobao_config);
$tpl->assign("dist_pro",$dist_pro);
$tpl->assign("config",$config);
$tpl->assign("lang",$lang);
$tpl->assign("shop_id",$buid);

$output=tplfetch("admin_distribution_product_list.htm");

