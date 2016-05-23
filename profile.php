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
$userid = $_COOKIE['userid'];
if(!empty($userid)) {
    $sql = "select mobile from mallbuilder_member where userid = $userid";
    $db->query($sql);
    $mobile = $db->fetchField('mobile');
}

$tpl->assign('oldUlr','https://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
$tpl->assign("verify",$num);
$tpl->assign("mobile",$mobile);
include_once("footer.php");
	$tpl->display('profile.htm');
?>