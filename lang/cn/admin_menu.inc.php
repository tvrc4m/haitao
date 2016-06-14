<?php
$menu=array( 
	'main'=>array(
			'name'=>'我是卖家',
			'action'=>'main',
			'sub'=>array(
						array(
							'name'=>'商品管理',
							'type'=>array(2),
							'action'=>array(
								'?m=product&s=admin_product'=>'商品发布',
                                '?m=product&s=product_selection'=>'点选商品',
								'?m=product&s=admin_product_list'=>'出售中的商品',
								'?m=product&s=admin_product_storage'=>'仓库中的商品',
								'?m=product&s=admin_product_batch'=>'淘宝导入',
								'?m=product&s=admin_product_cat'=>'分类管理',
                                '?m=product&s=admin_product_count'=>'',
                                '?m=product&s=admin_product_note'=>'',

							)
						 ),
						 array(
							'name'=>'交易管理',
							'type'=>array(2),
							'action'=>array(
								'?m=product&s=admin_sellorder'=>'已售商品',
								'?m=product&s=admin_virtual_sellorder'=>'',
								'?m=logistics&s=admin_start_addr'=>'发货地址',
								'?m=logistics&s=admin_logistics_temp'=>'物流工具',
								'?m=shop&s=admin_credit'=>'我的评论',
								'?m=product&s=admin_deliver'=>'',
								'?m=product&s=admin_orderdetail'=>'',
								'?m=product&s=admin_apply_detail'=>'',
								'?m=product&s=admin_virtual_orderdetail' => '',
								'?m=product&s=admin_orderprint' => '',
							)
						 ),
						 array(
							'name'=>$lang['shop_setting'],
							'type'=>array(2),
							'action'=>array(
								$config['weburl'].'/shop.php?uid='.$buid=>'',
								'?m=shop&s=myshop'=>'店铺设置',
								'?m=shop&s=admin_template'=>'主题设置',
								'?m=shop&s=admin_shop_navigation'=>'导航管理',
								'?m=shop&s=admin_link'=>'合作伙伴管理',
								'?m=shop&s=admin_step'=>'',
								'?m=shop&s=admin_certification'=>'',
								'?m=shop&s=admin_custom_service'=>'',
								'?m=shop&s=admin_shop_set'=>'',
								'?m=shop&s=admin_wechat'=>'',
								'?m=shop&s=admin_wapset'=>'',

							)
						),
						array(
							'name'=>'营销中心',
							'type'=>array(2),
							'action'=>array(
								'?m=tg&s=admin_tg'=>'',
								'?m=tg&s=admin_tg_list'=>'团购管理',
								'?m=activity&s=admin_activity'=>'促销活动',
                                '?m=activity&s=admin_activity_product_list'=>'',
								'?m=voucher&s=admin_voucher'=>'代金券管理',
                                '?m=member&s=admin_member_card'=>'会员卡管理',
                                '?m=member&s=admin_customer' => '顾客管理',
                                '?m=member&s=admin_sent_card' => ''

							)
						 ),
						array(
							'name'=>'其他设置',
							'type'=>array(2),
							'action'=>array(
								'?m=product&s=admin_shop_consult'=>'我的咨询',
								'msg'=>'',
								'?m=message&s=admin_message_list_inbox'=>'',
								'?m=message&s=admin_message_list_outbox'=>''
							)
						),
					),
		)
);

$menu['inquire']= array(
	'name'=>'消息中心',
	'action'=>'?m=message&s=admin_message_list_inbox',
);

$rs = $PluginManager->trigger('admin_menu');

//----------------------
if($_GET['action']=='main' || $_GET['action']=='logout' || ($_GET['action']=='' and  $_GET['m']=='' and $_GET['s']=='') || (2==$_REQUEST['cg_u_type'] && 'distribution'==$_GET['m']))
	$flag='2';
else
	$flag='1';

foreach($menu as $key=>$v)
{
	if(isset($menu[$key]['sub']))
	{
		foreach($menu[$key]['sub'] as $sk=>$sv)
		{

            if($sv['name'] == '商品管理'){
                //var_dump($sv);
                $sql = "SELECT userid,ptype,pid FROM mallbuilder_shop WHERE userid = ".$buid;
                $db->query($sql);
                $res = $db->fetchRow();
                if(($res['ptype']!=2)){
                    unset($menu[$key]['sub'][$sk]['action']['?m=product&s=product_selection']);
                }elseif($res['ptype']==2){
                    unset($menu[$key]['sub'][$sk]['action']['?m=product&s=admin_product']);
                }
            }

			if(is_array($sv['action']))
			{
				foreach($sv['action'] as $sskey=>$ssv)
				{
					if($sskey==$_GET['action']||$sskey=='?m='.$_GET['m'].'&s='.$_GET['s'])
					{
						$cmenu=$key;
						$flag='2';
					}	
				}
			}
			else
			{
				if($sv['action']==$_GET['action']||$sv['action']=='?m='.$_GET['m'].'&s='.$_GET['s'])
				{
					$cmenu=$key;
					$flag='2';
				}
			}
		}
		ksort($menu[$key]['sub']);
	}
	if(isset($admin))
	{	
		if($key!='main'&&is_array($menu[$key]['sub']))
		{
			$act=each($menu[$key]['sub']);$subkey=$act['key'];//取出第一个下标
			$act=@each($menu[$key]['sub'][$subkey]['action']);
			$menu[$key]['action']=$act['key'];
		}
	}
}
//----------------------------------------
if($flag=='1')
{
	if($is_company==1)	
	{
		header("Location:main.php?m=shop&s=admin_step");
	}
	else
	{
		if($_GET['cg_u_type'])
		{
			$getstr=implode('&',convert($_GET));
			header("Location:main.php?cg_u_type=1&$getstr");
		}
		else
		{
			header("Location:main.php?cg_u_type=1");
		}
	}
}

if(isset($tpl))
{

	$cmenu=!empty($cmenu)?$cmenu:'main';
	$tpl->assign("submenu",$menu[$cmenu]);
	$tpl->assign("menu",$menu);
	$tpl->assign("cmenu",$cmenu);
}

?>
