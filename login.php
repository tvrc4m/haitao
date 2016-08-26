<?php
include_once("includes/global.php");
include_once("includes/smarty_config.php");


if($buid)
{
    header("Location:main.php?cg_u_type=1");
    exit();
}
include_once("footer.php");
include_once($config['webroot']."/config/connect_config.php");//connect
include_once($config['webroot']."/api/connect_login.php");
$config = array_merge($config,$connect_config);
$tpl->assign('config',$config);


if(!empty($_GET['connect_id']))
    $tpl->display("user_connect.htm");
else
    $tpl->display("login.htm");
?>