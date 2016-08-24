<?php
include_once("includes/global.php");
include_once("includes/smarty_config.php");
include("config/nav_menu.php");
include_once ("includes/uc_server.php");
//=========================================

$page="lostpass.htm";
if(!empty($_GET['msg']))
{
	$page="reset_pass.htm";
}



//===========页面底部===============

include_once("footer.php");
if($config['language']=='en')
{
	$tpl->assign("output",$tpl -> fetch($page));
	$tpl->display("register_inc.htm");
}
else
	$tpl->display($page);
?>