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
if(!empty($buid)) {
    $sql = "select mobile from mallbuilder_member where userid = $buid";
    $db->query($sql);
    $mobile = $db->fetchField('mobile');
    if (strpos($_SERVER['HTTP_USER_AGENT'], 'MicroMessenger') !== false ) //判断是否在微信中打开
	{
	    $sql = "select status from mallbuilder_user_connected where userid = $buid";
	    $db->query($sql);
	    $status = $db->fetchField('status');
	}else
		$status = '';
}
$tpl->assign('oldUlr','https://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
$tpl->assign("verify",$num);
$tpl->assign("mobile",$mobile);
$tpl->assign("status",$status);
include_once("footer.php");
$tpl->display('profile.htm');

?>