<?php
include_once("includes/global.php");
include_once("includes/smarty_config.php");

//已经登录
if($buid)
{
	msg('main.php');
}
if(!empty($_GET['connect_id']))$tpl->assign('connect_id',$_GET['connect_id']);

$tpl->assign('config',$config);
$tpl->display("register.htm");
?>