<?php
include_once("includes/global.php");
include_once("includes/smarty_config.php");


if($buid)
{
    header("Location:main.php?cg_u_type=1");
    exit();
}
include_once("footer.php");
$tpl->assign('config',$config);

if(!empty($_GET['connect_id']))
    $tpl->display("user_connect.htm");
else
    $tpl->display("login.htm");
?>