<?php
/**
 * Created by PhpStorm.
 * User: wonder
 * Date: 2016/8/1
 * Time: 16:15
 */

$tpl->assign("is_wechat",false);
//微信分享
if ($config['bw'] == "weixin")
{
    include_once("pay/module/payment/lib/WxPayPubHelper/WxPay.pub.config.php");

    include_once("includes/jssdk.php");
    $jssdk = new JSSDK(WxPayConf_pub::APPID,WxPayConf_pub::APPSECRET);
    $wechat_share_data = $jssdk->getSignPackage();
    $tpl->assign("wechat_share",$wechat_share_data);
    $tpl->assign("is_wechat",true);

}
$tpl->assign('config',$config);
if(isset($_GET['hd'])&&!empty($_GET['hd'])){
    switch($_GET['hd']){
        case '77':
            if($config['temp'] == 'default'){
                $out = tplfetch('./qixi77/act.htm');
            }elseif($config['temp'] == 'wap'){
                $out = tplfetch('./qixi77/act_wap.htm');
            }
        break;
        default:
            echo '没有该活动！';
    }
}


?>