<?php
include_once("$config[webroot]/module/member/includes/plugin_orderadder_class.php");
$orderadder=new orderadder();
	
//--增加收货地址

if($_POST["submit"]=='add')
{
    if(!preg_match('/^1(3[0-9]|4[57]|5[0-35-9]|8[0-9]|7[07])\d{8}$/',$_POST['mobile']))
        die('<script>alert("请填写正确手机号！");history.go(-1);</script>;');
	$flag=$orderadder->add_orderadder();
	if(is_numeric($_POST['i']) and $_POST['ty']=='tg')
	{
		$admin->msg($config['weburl'].'/?m=tg&s=order&id='.$_POST['i']);  	
	}
	elseif($_POST['ty']=='pro')
	{
		$admin->msg($config['weburl'].'/?m=product&s=confirm_order');  	
	}
	else
	{
		$admin->msg($config['weburl'].'/main.php?m=member&s=admin_orderadder');  
	}
}
//--修改收货地址
if($_POST['submit']=='edit')
{
    if(!preg_match('/^1(3[0-9]|4[57]|5[0-35-9]|8[0-9]|7[07])\d{8}$/',$_POST['mobile']))
        die('<script>alert("请填写正确手机号！");history.go(-1);</script>;');
	$flag=$orderadder->edit_orderadder($_POST['edid']); 
	if(is_numeric($_POST['i']) and $_POST['ty']=='tg')
	{
		$admin->msg($config['weburl'].'/?m=tg&s=order&id='.$_POST['i']);  	
	}
	elseif($_POST['ty']=='pro')
	{
		$admin->msg($config['weburl'].'/?m=product&s=confirm_order');  	
	}
	else
	{
		$admin->msg($config['weburl'].'/main.php?m=member&s=admin_orderadder');  
	}
}
//--删除收货地址
if(!empty($_GET['edid'])&&is_numeric($_GET['edid']))
{
	$flag=$orderadder->del_orderadder($_GET['edid']);  
	$admin->msg($config['weburl'].'/main.php?m=member&s=admin_orderadder');
}
//--显示收货地址
if(!empty($_GET['id'])&&is_numeric($_GET['id']))
	$tpl->assign("de",$orderadder->get_orderadder($_GET['id']));
	
$tpl->assign("list",$orderadder->get_orderadderlist());

//根据来源，修改返回规则
$referer = $_SERVER['HTTP_REFERER'];
if ($referer)
{
	$referer_row = parse_url($referer);
	parse_str($referer_row['query'], $query_row);


	if ('msg' == $query_row['action'])
	{
		$tpl->assign("back_flag", true);
	}
}

//---------------------------------
$tpl->assign("config",$config);
$tpl->assign("prov",GetDistrict());
$tpl->assign("lang",$lang);
$output=tplfetch("admin_orderadder.htm");

?>