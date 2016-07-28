<?php
include_once("includes/global.php");
include_once("includes/smarty_config.php");
//*******************************************************/

if($config['bw'] == "weixin" && (!isset($_SESSION['openid_f']) || $_SESSION['openid_f']==""))
{
	/**
	 * 成功调起支付第一步骤：
	 * 步骤1：网页授权获取用户openid
	*/
	include_once("module/payment/lib/WxPayPubHelper/WxPayPubHelper.php");
	//使用jsapi接口
	$jsApi = new JsApi_pub();
	//通过code获得openid
	if (!isset($_GET['code']) && (!isset($_SESSION['openid_f']) || $_SESSION['openid_f']=="")) // && $_GET['m']!="product"
	{
		//$url_temp = WxPayConf_pub::JS_API_CALL_URL;
		/**
		* roc 2016.07.27 start---
		$url_temp = "https://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
		*/
		$url_temp = $_SERVER['HTTP_REFERER'];
        if(empty($url_temp))
        {
               $url_temp= $config['weburl'].'/main.php?cg_u_type=1';
        }
        else
        {
        	if(!preg_match("/^".str_replace("/", "\/", $config['weburl'])."*/",$url_temp))
        	{
        		$url_temp = "http://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
        	}
        }
        $url_temp = "http://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
		/**
		* roc 2016.07.27 end---
		$url_temp = "http://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
		*/
		$url_temp = urlencode($url_temp);
		//触发微信返回code码
		$url = $jsApi->createOauthUrlForCode($url_temp);

		header("Location: $url");
	}
	else if(isset($_GET['code']))
	{
		//获取code码，以获取openid
	    $code = $_GET['code'];
		$jsApi->setCode($code);
		$openid = $jsApi->getOpenId();

		$_SESSION['openid_f'] = $openid;

		//自动根据openid登录操作
	}
}

//==========================================
include_once("module/payment/includes/plugin_pay_class.php");
$act=$_GET['act']?$_GET['act']:NULL;
$op=$_GET['op']?$_GET['op']:NULL;
$pay=new pay();
$de=$pay->get_member_info($buid);
$_SESSION['pay_id'] = $buid;
$tpl->assign("de",$de);
$sql="select con_group,con_title,con_id from ".WEBCON." where type=1 limit 0,4";
$db->query($sql);
$help=$db->getRows();
$tpl->assign("help",$help);

switch($act)
{
	case "logout":
	{
		bsetcookie("USERID",NULL,NULL,"/",$config['baseurl']);
		header("Location: $config[web_url]/login.php");
		break;	
	}
	case "edit":
	{
		switch($op)
		{
			case "name":
			{
				/*if($_POST['act']=='name')
				{
					include_once("../api/real.php");
					//var_dump($config['webroot']);die;
					$pay->edit_name($buid);
					msg("index.php?act=edit&op=name",'修改成功');	
				}*/
				$output=tplfetch("edit_name.htm");
				break;
			}
			default:break;
		}
		$page="edit.htm";
		break;	
	}
	default:
	{
		$re=$pay->get_trade_record($buid,5);
		$tpl->assign("re",$re);
		if(!empty($_GET['m']))
		{
			include("module/".$_GET['m']."/".$_GET['s'].".php");
			break;
		}
		else
		{
			$tpl->assign("config",$config);
			$output=tplfetch("main.htm");
		}
		break;
	}
}

//身份证认证
$sql = "select identity_verify from pay_member where pay_id = $buid";
$db -> query($sql);
$num = $db -> fetchRow();
$num = $num['identity_verify'] == 'true' ? 1 : 0 ;

//支付密码
$sql = "select pay_pass from ".MEMBER." where pay_id=". $de['pay_id'];
$db -> query($sql);
$pp = $db -> fetchRow('pay_pass');
/*if(!empty($pp)){
    $tpl->assign("verify_pay", 'yes');
}else{
    $tpl->assign("verify_pay", 'no');
}*/

$tpl->assign("verify",$num);
$tpl->assign("output",$output);
include_once("footer.php");
$tpl->display("index.htm");
?>