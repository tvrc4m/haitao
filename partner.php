<?php
include_once("includes/global.php");
include_once("includes/smarty_config.php");
include_once("footer.php");
$button = isset($_GET['yq'])?1:0;
$tpl->assign('button',$button);
$tpl->display('partner.htm');
?>