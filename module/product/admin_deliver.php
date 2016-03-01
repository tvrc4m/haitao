<?php
include_once("$config[webroot]/module/product/includes/plugin_order_class.php");
$order=new order();
//=====================================================================
$id = is_numeric($_GET['order_id'])?$_GET['order_id']:"0";
$de = $order -> orderdetail($id);
if(!$de['id'] || $de['status'] != '2' )
{
	header("Location: 404.php");
}
if($_POST['status']=='send')
{
	$order->send_product();
	msg("main.php?m=product&s=admin_sellorder&status=3");
}	
$tpl->assign("fastmail",$order->get_fastmail());

//=====================================================================
$tpl->assign("config",$config);
$tpl->assign("lang",$lang);
$output=tplfetch("admin_deliver.htm");
?>