<?php
include_once("includes/global.php");
include_once("includes/smarty_config.php");
die('111');

if($buid)
{
    header("Location:main.php?cg_u_type=1");
    exit();
}
include_once("footer.php");
include_once($config['webroot']."/config/connect_config.php");//connect
$config = array_merge($config,$connect_config);
$tpl->assign('config',$config);
if($config['sina_connect']==1)//sina
{
    define( "WB_AKEY" , $config['sina_app_id'] );
    define( "WB_SKEY" , $config['sina_key'] );
    define( "WB_CALLBACK_URL" , "$config[weburl]/login.php?type=sina" );
    include_once( 'includes/saetv2.ex.class.php' );
    $o = new SaeTOAuthV2( WB_AKEY , WB_SKEY );
    //------------------------------------------
    if($_GET['type']=='sina'&&isset($_REQUEST['code']))
    {
        $keys = array();
        $keys['code'] = $_REQUEST['code'];
        $keys['redirect_uri'] = WB_CALLBACK_URL;
        $token = $o->getAccessToken( 'code', $keys ) ;
        $c = new SaeTClientV2( WB_AKEY , WB_SKEY , $token['access_token'] );
        $uid_get = $c->get_uid();
        $uid = $uid_get['uid'];
        $ar = $c->show_user_by_id( $uid);
        //------------
        $sql="select * from ".USERCOON." where type=2 and client_id='$ar[id]'";
        $db->query($sql);
        $cre=$db->fetchRow();
        if(empty($cre['id']))
        {
            $sql="insert into ".USERCOON."
            (nickname,figureurl,gender,type,access_token,client_id) 
            values 
            ('$ar[name]','$ar[profile_image_url]','$ar[gender]',2,'$token[access_token]','$ar[id]')";
            $db->query($sql);
            $cre['id']=$db->lastid();
        }
        if($cre['userid'])
        {
            login($cre['userid'],NULL);
            $forward = $post['forward']?$post['forward']:$config["weburl"]."/main.php?cg_u_type=1";
            if(empty($forward) || $forward == $config["weburl"]."/login.php")
            {
                $forward = $config["weburl"]."/main.php?cg_u_type=1";
            }
            msg($forward);
        }
        else
        {
            msg("login.php?connect_id=$cre[id]");
        }
    }
    //-------------------------------------------
    $code_url = $o->getAuthorizeURL( WB_CALLBACK_URL );
    $tpl->assign("sina_login_url",$code_url);
}
if(!empty($_GET['code'])&&$config['qq_connect']==1&&$_GET['type']!='sina'&&$_GET['connect_type']!='weixin' && $config['bw']!="weixin")//QQ
{
    //-----------------
    $config['return']=urlencode($config['weburl'].'/login.php');
    $url="https://graph.qq.com/oauth2.0/token?grant_type=authorization_code&"
        ."client_id=$config[qq_app_id]"
        ."&client_secret=$config[qq_key]"
        ."&code=$_GET[code]"
        ."&state=$config[company]"
        ."&redirect_uri=$config[return]";
    $takenid=@get_url_contents($url);
    //----------------
    $url2="https://graph.qq.com/oauth2.0/me?$takenid";
    $con=get_url_contents($url2);
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

    $con=get_url_contents($url3);
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
        login($cre['userid'],NULL);
        $forward = $post['forward']?$post['forward']:$config["weburl"]."/main.php?cg_u_type=1";
        msg($forward);
    }
    else
    {
        msg("login.php?connect_id=$cre[id]&connect_nickname=" . urlencode($ar['nickname']));
    }
}


//微信登录
// @include_once("config/connect_config.php");

function is_repeat($str)
{
    global $db;
    $sql = "select * from ".MEMBER." where user = '$str'";
    $db -> query($sql);
    $num = $db->num_rows();
    if($num <= 0)
    {
        return $str;
    }
    else
    {
        $str = $str ."_". substr(md5(time()),0,2);
        return is_repeat($str);
    }
}

if ($config['weixin_connect'] && !isset($_GET['connect_id']))
{
    $appid = $config['weixin_app_id'];
    $appsecret = $config['weixin_key'];

    $redirect_uri = urlencode("$config[weburl]/login.php?connect_type=weixin");
    if($config['bw'] == "weixin")
    {
        $wechat_url = "https://open.weixin.qq.com/connect/oauth2/authorize?appid=$appid&redirect_uri=$redirect_uri&response_type=code&scope=snsapi_login&state=123&connect_redirect=1#wechat_redirect";
    }
    else
    {
        $wechat_url = "https://open.weixin.qq.com/connect/qrconnect?appid=$appid&redirect_uri=$redirect_uri&response_type=code&scope=snsapi_login&state=STATE#wechat_redirect";
    }

    $_SESSION['connect_name'] = '微信';
    $tpl -> assign("wechat_url",$wechat_url);
    if(empty($_SESSION['accessToken'])){
    if ($config['bw'] == "weixin")
    {
        if (!isset($_GET['code']))
        {
            if (true || $wechat_login_flag == true)
            {
                header('location:' . $wechat_url);
                die();
            }
        }
    }

    $code = $_GET['code'];
    $state = $_GET['state'];
    $token_url = 'https://api.weixin.qq.com/sns/oauth2/access_token?appid='.$appid.'&secret='.$appsecret.'&code='.$code.'&grant_type=authorization_code';
    $token = json_decode(file_get_contents($token_url));

    $_SESSION['accessToken']=$token;
    }

    if(!empty($_SESSION['accessToken']))
    {
        $access_token_url = 'https://api.weixin.qq.com/sns/oauth2/refresh_token?appid='.$appid.'&grant_type=refresh_token&refresh_token='.$_SESSION['accessToken']->refresh_token;
        $access_token = json_decode(file_get_contents($access_token_url));
        if(!empty($access_token) && isset($access_token->openid) && !empty($access_token->openid))
        {
            $_SESSION['openid_f'] = $access_token->openid;
        }
        $user_info_url = 'https://api.weixin.qq.com/sns/userinfo?access_token='.$access_token->access_token.'&openid='.$access_token->openid.'&lang=zh_CN';
        $user_info = json_decode(@file_get_contents($user_info_url));

        $openid = $user_info -> openid;
        $nickname = $user_info -> nickname;

       
        if($openid)
        {
            //--------------------------
            $sql="select * from ".USERCOON." where type=3 and openid='$openid'";
            $db->query($sql);
            $cre=$db->fetchRow();

            if(empty($cre['id']))
            {
                $sql="insert into ".USERCOON."(nickname,figureurl,gender,vip,level,type,access_token,client_id,openid)
                        values('$nickname','$ar[figureurl]','$ar[gender]','$ar[vip]','$ar[level]',3,'$takenid','$ar2[client_id]','$openid')";
                $db->query($sql);
                $cre['id']=$db->lastid();
            }

            //判断userid ， bind
            if(!$cre['userid'])
            {
                //-------------绑定一键连接
                if(!empty($cre['id']))
                {
                    $sql="update ".USERCOON." set userid='$buid' where id='$cre[id]'";
                    $db->query($sql);
                }
            }

            if($cre['userid'])
            {
                login($cre['userid'],NULL);
                if(!empty($_COOKIE['old_url']))
                $forward=$_COOKIE['old_url'];
                    else
                $forward = $post['forward']?$post['forward']:$config["weburl"]."/main.php?cg_u_type=1";

                msg($forward);
            }
            else
            {
                $_SESSION['connect_name'] = '微信';
                msg("login.php?connect_id=$cre[id]");
            }
        }
    }
}

if(!empty($_GET['connect_id']))
    $tpl->display("user_connect.htm");
else
    $tpl->display("login.htm");
?>