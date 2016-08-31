<?php
include_once("includes/global.php");
include_once("includes/smarty_config.php");


if($buid)
{
    header("Location:main.php?cg_u_type=1");
    exit();
}
include_once("footer.php");
if(weixin_status() || $config['bw'] != "weixin")
include_once($config['webroot']."/api/connect_login.php");

$tpl->assign('config',$config);
if($config['bw'] != "weixin"){
//qq互联登录
$config = array_merge($config,$connect_config);
if(isset($_GET['code'])&&!empty($_GET['code'])&&$config['_CONNCET']['_QQ_STATU']=='1'){
    $config['return']=urlencode($config['weburl'].'/login.php');
    $url="https://graph.qq.com/oauth2.0/token?grant_type=authorization_code&"
        ."client_id=".$config['qq_app_id']
        ."&client_secret=".$config['qq_key']
        ."&code=".$_GET['code']
        ."&state=".$config['company']
        ."&redirect_uri=".$config['return'];
    $takenid = file_get_contents($url);
    //----------------
    $url2="https://graph.qq.com/oauth2.0/me?$takenid";
    $con = file_get_contents($url2);
    $lpos = strpos($con, "(");
    $rpos = strrpos($con, ")");
    $con  = substr($con, $lpos + 1, $rpos - $lpos -1);
    $ar2=json_decode($con,true);
    //----------------
    $url3 = "https://graph.qq.com/user/get_user_info?"
        . $takenid
        . "&oauth_consumer_key=" . $config['qq_app_id']
        . "&openid=" . $ar2["openid"]
        . "&format=json";

    $con = file_get_contents($url3);
    $ar=json_decode($con,true);
    //--------------------------

    $sql="select * from ".USERCOON." where type=1 and openid='$ar2[openid]'";
    $db->query($sql);
    $cre=$db->fetchRow();
    if(empty($cre['id']))
    {
        $sql="insert into ".USERCOON."
        (nickname,figureurl,gender,vip,level,type,access_token,client_id,openid) 
        values 
        ('$ar[nickname]','$ar[figureurl]','$ar[gender]','$ar[vip]','$ar[level]',1,'$takenid','$ar2[client_id]','$ar2[openid]')";
        $db->query($sql);
        $cre['id']=$db->lastid();
    }
    if($cre['userid'])
    {
        if($obj->users($cre['userid']))$obj->login_success();
        $forward = $config["weburl"]."/main.php?cg_u_type=1";
        msg($forward);
    }
    else
    {
        msg("login.php?connect_id=$cre[id]&connect_nickname=" . urlencode($ar['nickname']));
    }
}

}
/**
 * 是否使用微信登录
 */
function weixin_status(){
    global $db;
    if(empty($_SESSION['openid_connect']))return true;
    $sql = "select status from ".USERCOON." where type=3 and openid='".$_SESSION['openid_connect']."'";
        $db->query($sql);
        $status = $db->fetchField('status');
        if($status==1)
            return true;
        else
            return false;
        //msg($this->_config["weburl"]."/login.php?temp=wap");

}

if(!empty($_GET['connect_id'])){
    $tpl->assign('connect_id',$_GET['connect_id']);
    $tpl->display("user_connect.htm");
}else
    $tpl->display("login.htm");
?>