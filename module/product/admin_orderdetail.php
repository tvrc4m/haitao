<?php

@include_once("$config[webroot]//config/logistics_config.php");
include_once("$config[webroot]/module/product/includes/plugin_order_class.php");
$order=new order();
//----------------------------------------------------
if(!empty($_GET['id'])&&is_numeric($_GET['id']))
{
	$tpl->assign("de",$de = $order->orderdetail($_GET['id']));
    if($de["invoice_no"]){
        $tpl->assign("logistics_sigin",md5($logistics_config['logistic_api_sceret']."|~".$de["invoice_no"]));
    }
}

//==================================
$tpl->assign("config",$config);
$tpl->assign("logistics_config",$logistics_config);
$tpl->assign("lang",$lang);
$output=tplfetch("admin_orderdetail.htm");
?>