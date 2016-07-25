<?php
if(empty($_GET['m'])||empty($_GET['s']))
	die('forbiden;');

$catCache = include_once($config['webroot'].'/cache/configure/cat.cache');
//------------------------------
if(!empty($config['index_catid']))
	$cat_pro=unserialize($config['index_catid']);
else
	$cat_pro=array();

//--------广告位------
$guang = array(array(15,16,17),array(18,19,20),array(21,22,23),array(24,25,26));
if($cat_pro)
{
	$i=0;
	foreach($cat_pro as $key=>$v)
	{
		$cat_pros[$key]['catid'] =$catCache[$v['catid']]['catid'];
		$cat_pros[$key]['name'] =$catCache[$v['catid']]['cat'];
		$cat_pros[$key]['url'] =$catCache[$v['catid']]['url'];
		if(!empty($v['tab'])){
			for($i=0;$i<count($v['tab']);$i++){
				$cat_pros[$key]['sub_cat'][$i]['catid']=$catCache[$v['tab'][$i]]['catid'];
				$cat_pros[$key]['sub_cat'][$i]['name']=$catCache[$v['tab'][$i]]['cat'];
				$cat_pros[$key]['sub_cat'][$i]['url']=$catCache[$v['tab'][$i]]['url'];
			}
		}else{
			$cat_pros[$key]['sub_cat']='';
		}
		$cat_pros[$key]['guanggao'] = $guang[$i];
		$i++;
	}

	$tpl->assign("categorys",$cat_pros);
}


if($config['temp'] != "wap")
{
	$sql="select user,logo,b.pic from ".MEMBER." a left join ".MEMBERGRADE." b on a.grade_id = b.id where userid = '$buid' ";
	$db->query($sql);
	$member = $db->fetchRow();
	$tpl->assign("member",$member);
	
	$sqls[] = "select 1 from ".ORDER." where buyer_id = '$buid' and status = '1' ";
	$sqls[] = "select 1 from ".ORDER." where buyer_id = '$buid' and status = '3' ";
	$sqls[] = "select 1 from ".ORDER." where buyer_id = '$buid' and status = '4' and buyer_comment='0' and seller_comment = '0' ";
	foreach($sqls as $val)
	{
		$db->query($val);
		$count[] = $db->num_rows();	
	}

	$tpl->assign("count",$count);

}

    //调用公告
    $sql = "select id,title,content,url from mallbuilder_announcement where status = 1 order by displayorder desc limit 5";
    $db->query($sql);
    $annoub = $db->getRows();
    $tpl->assign("annoub",$annoub);
//----------------------------
include_once("config/connect_config.php");//connect
$config = array_merge($config,$connect_config);
if($config['sina_connect']==1)//sina
{
	define( "WB_AKEY" , $config['sina_app_id'] );
	define( "WB_SKEY" , $config['sina_key'] );
	define( "WB_CALLBACK_URL" , "$config[weburl]/login.php?type=sina" );
	include_once( 'includes/saetv2.ex.class.php' );
	$o = new SaeTOAuthV2( WB_AKEY , WB_SKEY );
	$code_url = $o->getAuthorizeURL( WB_CALLBACK_URL );
	$tpl->assign("sina_login_url",$code_url);
}
//------------------------------
//修正连接地址信息
include_once("module/shop/includes/plugin_shop_class.php");
$shop=new shop();
$cominfo=$shop->get_shop_info($buid);
if(!empty($buid)){
	$sql = "select 1 from mallbuilder_voucher where temp_id=2 and member_id={$buid}";
	$db->query($sql);
	if($db->fetchRow()){
		$tpl->assign("buidAd",1);
		$tpl->assign("logoAd",$config['weburl']."/main.php?m=voucher&s=admin_buyvoucher");
	}else{
		$tpl->assign("buidAd",0);
		$tpl->assign("logoAd",$config['weburl']);
	}
}else{
	$tpl->assign("buidAd",1);
	$tpl->assign("logoAd",$config['weburl'].'/register.php');
}

$tpl->assign("cominfo",$cominfo);
$tpl->assign("cat_pro",$cat_pro);
$tpl->assign("current","index");
include_once("footer.php");

//=============================================
$out=tplfetch("product_index.htm",NULL);
?>