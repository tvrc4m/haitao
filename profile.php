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
$status_wx = '';
if(!empty($buid)) {
    $sql = "select mobile from mallbuilder_member where userid = $buid";
    $db->query($sql);
    $mobile = $db->fetchField('mobile');
    if ($config['bw'] == "weixin") //判断是否在微信中打开
	{
	    $sql = "select status from mallbuilder_user_connected where type=3 and userid = $buid";
	    $db->query($sql);
	    $status_wx = $db->fetchField('status');
	}

}
$tpl->assign('oldUlr','https://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
$tpl->assign("verify",$num);
$tpl->assign("mobile",$mobile);
$tpl->assign("status",$status_wx);
include_once("footer.php");
$tpl->display('profile.htm');

?>