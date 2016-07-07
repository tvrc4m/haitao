<?php
include_once("module/member/includes/plugin_orderadder_class.php");
include_once("module/product/includes/plugin_cart_class.php");
include_once ("$config[webroot]/api/logisticsCost.php");
$cart = new cart();

if(!empty($_POST['id'])&&!empty($_POST['nums']))
{
	if(isset($_POST['is_virtual']) && $_POST['is_virtual'] == 1)
	{
		$_SESSION['pid'] = $_POST['id'] * 1;
		$_SESSION['sid'] = $_POST['sid'] * 1;
		$_SESSION['is_virtual'] = 1;
	}
	else
	{
		$flag = $cart->add_cart($_POST['id'],$_POST['nums'],$_POST['sid'], null, $_REQUEST['dist_user_id']);
		$_SESSION['product_id'] = $flag;
		$_SESSION['dist_user_id'] = $_REQUEST['dist_user_id'];
		header("Location: ?m=product&s=confirm_order");
	}
}

$orderadder = new orderadder();
if($config['temp']=='wap'||$config['temp']=='wap_app')
{
	$addr = $orderadder -> get_default_orderadder();
}
else
{
	$addr = $orderadder -> get_orderadderlist();
}
include_once("footer.php");
if($config['temp']=='wap'||$config['temp']=='wap_app')
{
	$out=tplfetch("confirm_payment.htm",$flag);
}
else
{
	if($_GET['ajax']=='ajax')
	{
		$url = $_SERVER['HTTP_REFERER']?base64_encode($_SERVER['HTTP_REFERER']):1;
		$tpl -> assign("url",$url);
		echo $out=tplfetch("order_ajax.htm",$flag,true);die;
	}
	else
		$out=tplfetch("confirm_payment.htm",$flag,true);
}
?>