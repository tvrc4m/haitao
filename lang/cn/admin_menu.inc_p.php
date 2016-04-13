<?php
$menu=array(
	'main'=>array(
			'name'=>'首页',
			'action'=>'main',
			'sub'=>array(
				array(
						'name'=>'已买到的商品',
						'type'=>array(1,2),
						'action'=>"?m=product&s=admin_buyorder",
					 ),
                array(
						'name'=>'我的代金券',
						'type'=>array(1,2),
						'action'=>"?m=voucher&s=admin_buyvoucher",
					 ),
                array(
						'name'=>'我的会员卡',
						'type'=>array(1,2),
						'action'=>"?m=member&s=admin_buyer_card",
					 ),
				array(
						'name'=>'我的收藏',
						'type'=>array(1,2),
						'action'=>array(
							'?m=sns&s=admin_share_product'=>'收藏商品',
							'?m=sns&s=admin_share_shop'=>'收藏店铺',
                            '?m=product&s=admin_footprint'=>'我的足迹',
							'?m=sns&s=sns'=>'',
							'?m=product&s=admin_receipt'=>'',
							'?m=product&s=admin_orderdetail'=>'',
							'?m=product&s=admin_apply'=>'',
							'?m=product&s=admin_apply_detail'=>'',
							'?m=payment&s=admin_pay'=>'',
							'?m=product&s=admin_virtual_orderdetail' => '',
						)
					),
				array(
						'name'=>'我的积分',
						'type'=>array(1,2),
						'action'=>array(
							'?m=points&s=admin_points'=>'积分明细',
							'?m=points&s=admin_points_order'=>'已兑换的商品',
						)
					),
				array(
						'name'=>'评价管理',
						'type'=>array(1,2),
						'action'=>"?m=shop&s=admin_credit",
					),
				array(
						'name'=>'咨询与维权',
						'type'=>array(1,2),
						'action'=>array(
							'?m=product&s=admin_consult'=>'我的咨询',
							'msg'=>'',
						)
					)
			),
		),
	'personal'=>array(
			'name'=>'个人主页',
			'action'=>$config['weburl'].'/home.php?uid='.$buid,
	),
	
	'user'=>array(
			'name'=>'账户设置',
			'sub'=>array(
					array(
						'name'=>'个人信息',
						'type'=>array(1,2),
						'action'=>array(
							'?m=member&s=admin_member'=>'个人资料',
							'?m=member&s=admin_orderadder'=>'收货地址',
						),
					),
			),	
	),
	
	'friend'=>array(
			'name'=>'好友',
			'sub'=>array(
						array(
						'name'=>'好友',
						'type'=>array(1,2),
						'action'=>array(
							'?m=sns&s=admin_friends'=>"好友",
							'?m=sns&s=admin_friends_group'=>"",
							'?m=sns&s=ajax_friends_group'=>"",
							'?m=sns&s=admin_nick'=>"",

						),
					)
			)
	),
	
	'inquire'=>array(
			'name'=>'信息',
			'sub'=>array(
						array(
							'name'=>$lang['mes'],
							'type'=>array(1,2),
							'action'=>array(
								'?m=message&s=admin_message_list_inbox'=>$lang['inbox'],
								'?m=message&s=admin_message_list_outbox'=>$lang['outbox'],
								'?m=message&s=admin_message_det'=>'',
								'?m=message&s=admin_message_sed'=>'',
							)
					)
			)
	)

);

$PluginManager->trigger('admin_menu_p');

//----------------------
if($_GET['action']=='main' || $_GET['action']=='logout' || ($_GET['action']=='' and  $_GET['m']=='' and $_GET['s']==''))
	$flag='2';
else
	$flag='1';

foreach($menu as $key=>$v)
{
	if(isset($menu[$key]['sub']))
	{
		foreach($menu[$key]['sub'] as $sv)
		{
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
			if($_GET['action'])
				header("Location:main.php?cg_u_type=2&action=$_GET[action]");
			elseif($_GET['m'])
				header("Location:main.php?cg_u_type=2&m=$_GET[m]&s=$_GET[s]");
			else
				header("Location:main.php?cg_u_type=2");
		}
		else
		{
			header("Location:main.php?cg_u_type=2");
		}
	}
}
if(isset($tpl))
{
	$cmenu=!empty($cmenu)?$cmenu:'main';
	$smenu=!empty($cmenu)?($cmenu=='friend'||$cmenu=='inquire'?'main':$cmenu):'main';
    $menus = $menu[$smenu];
	foreach($menus['sub'] as $key => $val){
		if($val['name'] != '我的代金券' && $val['name'] != '我的会员卡' && $val['name'] != '我的积分') {
			if(is_string($val['action'])){
				if(strlen($val['action'])>5){
					$data = explode("&", $val['action']);
					foreach($data as $k => $val){
						$data[$k] = explode('=', $val);
					}
					//var_dump($data);
					foreach($data as $key => $val) {
						if (in_array('s', $val)) {
							$newdata[] = $val;
						}
					}
				}
			}else{
				foreach($val['action'] as $ke =>$va){
					if(!empty($va)){
						$adata = explode("&", $ke);
						foreach($adata as $k => $v){
							$adata[$k] = explode('=', $v);
						}

						foreach($adata as $kk => $vaa) {
							if (in_array('s', $vaa)) {
								$newadata[] = $vaa[1];
							}
						}
					}
				}
			}
		}else{
			unset($menus['sub'][$key]);
		}
	}

    $i = 0;
    $y = 0;
    foreach($menus['sub'] as $k => $v){
		if (is_string($v['action'])) {
			$menus['sub'][$k]['newaction'] = $newdata[$i][1];
			$i++;
		} else {
			foreach ($menus['sub'][$k]['action'] as $kk => $vaa) {
				if (!empty($vaa)) {
					$menus['sub'][$k]['action'][$kk] = array('name' => $vaa, 'url' => $newadata[$y], 'ke' => $kk);
					$y++;
				}
			}
		}
    }

	//var_dump($menus);

    foreach($menu as $key => $val){
        $bdata[$key] = explode("&", $val['action']);
        //$bdata

        foreach($bdata[$key] as $k => $v){
           $bdata[$key] = explode('=', $v);
        }
    }

    foreach($menu as $key => $val){
        if($key=='main') {
            $menu[$key]['newaction'] = 'main';
        }else{
            $menu[$key]['newaction'] = $bdata[$key][1];
        }
    }
    $tpl->assign("submenu",$menus);
	$tpl->assign("menu",$menu);
	$tpl->assign("cmenu",$cmenu);
}
?>