<?php
include_once("includes/global.php");
include_once("includes/smarty_config.php");

//身份证认证
if(!empty($buid)) {
    $sql = "select identity_verify from pay_member where userid = $buid";
    $db->query($sql);
    $num = $db->fetchRow();
    $num = $num['identity_verify'] == 'true' ? 1 : 0;
}else{
    $num = 0;
}

$tpl->assign('oldUlr',$_SERVER['PHP_SELF']);
$tpl->assign("verify",$num);
include_once("footer.php");
	$tpl->display('profile.htm');
?>