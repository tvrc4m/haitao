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

if(!empty($_GET['connect_id']))
    $tpl->display("user_connect.htm");
else
    $tpl->display("login.htm");
?>