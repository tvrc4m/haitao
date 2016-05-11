<?php
include_once("includes/waf.php");
include_once("includes/global.php");
include_once("includes/admin_global.php");
include_once("includes/admin_class.php");
include_once("includes/insert_function.php");
include_once($config["webroot"]."/config/nav_menu.php");
//===============================================
//================未读消息验证===================
$sql="select iflook from ".FEEDBACK." where touserid=$buid and iflook=0";
$numRows = mysql_num_rows(mysql_query($sql));
$tpl->assign("numRows",$numRows);
//===============================================
$action=isset($_GET['action'])?$_GET['action']:"main";
$submit=isset($_POST['submit'])?$_POST['submit']:NULL;
$deid=isset($_GET['deid'])?$_GET['deid']:NULL;
$admin = new admin();
//---------------------清缓存

if(!empty($_POST)||!empty($_GET['deid'])||!empty($_GET['rec']))
	$admin->clear_user_shop_cache();
//---------------------登录检查,个人或企业会员
$admin->is_login($action);
$is_company=$admin->check_myshop();

/*--邮箱验证--*/
include_once("module/member/includes/plugin_member_class.php");
$member = new member();
$flag_vemial=$member->email_reg();
$tpl->assign("flag_vemial",$flag_vemial);

/*$flag=$member->email_reg();
if($flag=='false'){
	header("Location:index.php?m=member&s=new_email_reg_two");
}*/

if(empty($_SESSION['USER_TYPE']))
	$_SESSION['USER_TYPE'] = $is_company;
if($_GET['cg_u_type'])
	$_SESSION['USER_TYPE'] = $_GET['cg_u_type'] * 1;

$tpl->assign("cg_u_type",$_SESSION['USER_TYPE']);

//-------店铺信息不存在，但是却进入的是卖家的后台，需要申请开店

if ($_GET['action']!='logout')
{
	if($is_company==1&&$_SESSION['USER_TYPE']==2&&$_GET['s']!='admin_step'&&$_GET['action']!='msg')
	{
		//分佣店铺还是其它的
		if ('admin_distribution' == $_GET['s'])
		{
			$_SESSION['shop_type'] = 1;

			//header("Location:main.php?m=shop&s=admin_step&shop_type=1");die();
			header("Location:main.php?m=shop&s=admin_step&grade=1");die();
		}
		else
		{
			$_SESSION['shop_type'] = 2;
		}

        $url="Location:main.php?m=shop&s=admin_step";
        if($_GET['noheader']){        //app头部控制
            $url.="&noheader=1";
        }
        header($url);die();
	}
}
$point=get_member_field($buid,"sellerpoints");
$tpl->assign("point",$point);

//--------------------更换语言包
include("lang/cn/user_admin.php");
//-----------------------用户菜单加载
//店铺是否开启
include_once("module/shop/includes/plugin_shop_class.php");
$shop=new shop();	
$shop_statu=$shop->GetShopStatus($buid);

$cominfo=$shop->get_shop_info($buid);
$admin->tpl->assign("cominfo",$cominfo);
$admin->tpl->assign("userlogo",get_member_field($buid,'logo'));
$admin->tpl->assign("distribution_open_flag", $distribution_open_flag);
$admin->tpl->assign("distribution_visit_flag", $distribution_visit_flag);

if ($distribution_open_flag)
{
	//我的佣金总额
	$dist_user_row = $distribution->getDistributionUser($buid);
	//var_dump($dist_user_row['distribution_user_amount']);die;
	/*$dist_user_row['distribution_user_amount'] =  $dist_user_row['distribution_shop_amount_0'] +  $dist_user_row['distribution_shop_amount_1'] +  $dist_user_row['distribution_shop_amount_2']
		+ $dist_user_row['distribution_click_amount_0'] +  $dist_user_row['distribution_click_amount_1'] +  $dist_user_row['distribution_click_amount_2']
		+ $dist_user_row['distribution_reg_amount_0'] +  $dist_user_row['distribution_reg_amount_1'] +  $dist_user_row['distribution_reg_amount_2'];*/


	$dist_user_row['distribution_user_unsettlement_amount'] =  $dist_user_row['distribution_user_amount'] - $dist_user_row['distribution_user_settlement_amount'];

	$admin->tpl->assign("dist_user_row", $dist_user_row);//要全局变量，商铺中全部要用
	$admin->tpl->assign("distribution_config", $distribution_config);//要全局变量，商铺中全部要用

	//今日访问
	$date_str = date("Y-m-d");

	$sql = 'SELECT sum(distribution_analyse_shop_num) num FROM ' . DISTRIBUTION_ANALYSE_SHOP . ' WHERE user_id=' . $buid . ' AND distribution_analyse_shop_date="' . $date_str . '" GROUP BY user_id';

	$db->query($sql);
	$click_num = intval($db->fetchField('num'));
	$admin->tpl->assign("click_num", $click_num);

	//7日订单

	//$time = time() - 3600 * 24 * 7;
	//$time = time() - 3600 * 24 * 1;
	$time = strtotime(date("Y-m-d"));//当天时间0点

	$order_num = $distribution->getDistributionOrderNum($buid, $time);
	$admin->tpl->assign("order_num", $order_num);
	//7日营业额
	$order_amout = $distribution->getDistributionOrderAmount($buid, $time);

	$admin->tpl->assign("order_amout", $order_amout);
}

if($_SESSION['USER_TYPE']==1)
	include("lang/cn/admin_menu.inc_p.php");
else
	include("lang/cn/admin_menu.inc.php");
switch ($action)
{
	case "logout":
	{
		global $config;
		include_once("$config[webroot]/config/reg_config.php");
		$config = array_merge($config,$reg_config);
		bsetcookie("USERID",NULL,time(),"/",$config['baseurl']);
		setcookie("USER",NULL,time(),"/",$config['baseurl']);
		//=====================
		if($config['openbbs']==2)
		{
			include_once("$config[webroot]/uc_client/client.php");
			echo uc_user_synlogout();
		}
		$_SESSION['USER_TYPE']=NULL;
		header("Location: ".$config['weburl']);
		//header("Location: "."$config[weburl]/login.php"	);
		break;
	}
	case "msg":
	{
		$tpl->assign("lang",$lang);
		$tpl->assign("config",$config);
		include_once("footer.php");
		$output=tplfetch("user_admin/admin_msg.htm",$flag,true);
		break;
	}
	default:
	{
		if ($config['bw'] == "weixin")
		{
			include_once("pay/module/payment/lib/WxPayPubHelper/WxPay.pub.config.php");

			if(!isset($_SESSION['access_token']) || (time()-$_SESSION['tmpTime'])>7200)
			{
				//获取微信票据
				$date = file_get_contents("https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=" . WxPayConf_pub::APPID . "&secret=" . WxPayConf_pub::APPSECRET);
				$wobj = json_decode($date);
				$_SESSION['access_token'] = $wobj -> access_token;

				if(isset($wobj -> access_token))
				{
					$tmp = file_get_contents("https://api.weixin.qq.com/cgi-bin/ticket/getticket?access_token=".$wobj -> access_token."&type=jsapi");
					$tobj = json_decode($tmp);
					$_SESSION['ticket'] = $tobj->ticket;
				}

				$_SESSION['tmpTime'] = time();
			}
			{
				$_SESSION['noncestr'] = randomkeys(12);

				$strTmp = "https://".$_SERVER['HTTP_HOST'];
				if(!empty($_SERVER['REQUEST_URI']))
				{
					$strTmp .= $_SERVER['REQUEST_URI'];
				}
				$_SESSION['appid'] = WxPayConf_pub::APPID;
				$str_tmp = "jsapi_ticket=".$_SESSION['ticket']."&noncestr=".$_SESSION['noncestr']."&timestamp=".$_SESSION['tmpTime']."&url=".$strTmp;
				$_SESSION['signature'] = sha1($str_tmp);
			}
		}
		if(!empty($_GET['m']))
		{
			$s=$_GET['s'];
            $_GET['m'] = preg_replace('#[^a-z]#iuU', '',$_GET['m']);
			if(($shop_statu=='0' || $shop_statu== '-1' || $shop_statu== '-2' || $shop_statu== '-3') and ($s=="admin_product" || $s=="admin_product_list" || $s=="admin_product_storage" || $s=="admin_product_batch"))
			{
				$admin->msg('main.php','shop_statu','failure&n='.$shop_statu);die;
			}
			else
			{
				if(file_exists($config['webroot'].'/config/module_'.$_GET['m'].'_config.php'))
				{
					@include($config['webroot'].'/config/module_'.$_GET['m'].'_config.php');
					$mcon='module_'.$_GET['m'].'_config';
					@$config = array_merge($config,$$mcon);
				}
				if(file_exists("$config[webroot]/module/".$_GET['m']."/lang/cn.php"))
				include("$config[webroot]/module/".$_GET['m']."/lang/cn.php");//#调用模块语言包
				$tpl->template_dir=$config['webroot']."/templates/".$config['temp']."/user_admin/";
				include("module/".$_GET['m']."/".$_GET['s'].".php");
			}
			break;
		}
		else
		{
			include_once("module/shop/includes/plugin_shop_class.php");
			$shop=new shop();
			//-------------------------------------------
			if($config['temp']=='wap')
			{		
				if($_SESSION['USER_TYPE']==1)
				{
					/*
					$count=$shop->get_all_count(ORDER,array('1','2','3','4'));
					$admin->tpl->assign("shop_count",$count);
					*/
					$sqls[] = "select * from ".ORDER." where buyer_id = '$buid' and status = '1' ";
					$sqls[] = "select * from ".ORDER." where buyer_id = '$buid' and status = '2' ";
					$sqls[] = "select * from ".ORDER." where buyer_id = '$buid' and status = '3' ";
					$sqls[] = "select * from ".ORDER." where buyer_id = '$buid' and status = '4' and buyer_comment='0' and seller_comment = '0' ";
					$sqls[] = "select * from ".ORDER." where buyer_id = '$buid' ";

					foreach($sqls as $val)
					{
						$db->query($val);
                        $count[] = $db->num_rows();
					}

					$admin->tpl->assign("shop_count",$count);

					$page="user_admin/admin_main_p.htm";
				}
				else
				{
					if ($distribution_open_flag)
					{
						$page="user_admin/admin_main.htm";
					}
					else
					{
						$page="user_admin/admin_main_seller.htm";
					}

					if ($cominfo['shop_type']>=2 && $_GET['st'])
					{
						$page="user_admin/admin_main_seller.htm";
					}
				}

			}
			else
			{
				if($_SESSION['USER_TYPE']==1)
				{	
					$flag=$member->is_qd($buid);
					$tpl->assign("is_qd",$flag);
					$tpl->assign("count",$member->get_count($buid));
					$page="user_admin/admin_main_p.htm";
				}
				else
				{
					$time=time();
					$date=array($time-24*60*60,$time-24*60*60*2,$time-24*60*60*3,$time-24*60*60*4,$time-24*60*60*5,$time-24*60*60*6,$time-24*60*60*7);
					$admin->tpl->assign("date",$date);
					$count=$shop->GetViews($date);
					$admin->tpl->assign("count",$count);
					
					//---------------------------------
					//获取当前用户店铺动态评分
                    $shop_comment = $shop->get_shop_comment();
                    foreach($shop_comment as $key => $val){
                        $shop_comment[$key] = empty($val) ? 0 : $val ;
                    }
					$admin->tpl->assign("shop_comment",$shop_comment);
					//获取当前用户产品 评论 订单 数量
					
					$count['consult']=$shop->GetConsultNumber();
					$count['prdouct']=$shop->get_all_count(PRODUCT,array('-1','-2','1','2'));
					$count['pro_comment']=$shop->get_all_count(PCOMMENT,'');
					$count['order']=$shop->get_all_count(ORDER,array('all','1','2','3','5','4'));
					$admin->tpl->assign("shop_count",$count);
					$page="user_admin/admin_main.htm";

					if ($cominfo['shop_type']>=2 && $_GET['st'])
					{
						//$page="user_admin/admin_main_seller.htm";
					}
				}
			}
			//------------------------------------------------
			break;
		}
	}
}

//身份证认证
$sql = "select identity_verify from pay_member where userid = $buid";
$db -> query($sql);
$num = $db -> fetchRow();
$num = $num['identity_verify'] == 'true' ? 1 : 0 ;

$tpl->assign("lang",$lang);
$tpl->assign("verify",$num);
$tpl -> assign("menus",$nav_menu);
$tpl->assign("geturl",$_SERVER['REQUEST_URI']);
include_once("footer.php");
if(!empty($nohead))
	$tpl->display($page);
else
{
	if(!empty($output))
		$tpl->assign("output",$output);
	else
		$tpl->assign("output",$admin->tpl->fetch($page));
	
	// if($config['temp']=='wap')
	// {
	// 	$page="admin_inc_p.htm";
	// }
	// else
	// {
		if($_SESSION['USER_TYPE']==1)
		{
			$page="admin_inc_p.htm";
		}
		else
		{
			$tpl->assign("shop_statu",$shop_statu);//要全局变量，商铺中全部要用
			$page="admin_inc.htm";

        }
	//}
	$tpl->template_dir=$config['webroot']."/templates/".$config['temp']."/user_admin/";
	$tpl->display($page);
}
?>
