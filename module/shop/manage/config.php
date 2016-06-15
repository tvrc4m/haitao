<?php
	
	$shopconfig['menu'][1]=array(
		'menu_show'=>'1','menu_name'=>$lang['home'],'menu_link'=>''
	);
	$shopconfig['menu'][9]=array(
		'menu_show'=>'1','menu_name'=>$lang['company'],'menu_link'=>'profile','module'=>'shop'
	);
	$shopconfig['menu'][10]=array(
		'menu_show'=>'1','menu_name'=>$lang['credit'],'menu_link'=>'credit','module'=>'shop'
	);
	
	//=====================管理员后台==================
	
	$mem['shop'][1][0]=array(
		'',
		array(
			'shop.php,1,shop,店铺管理',
			'shop_application.php,1,shop,开店申请',
		)
	);
	$mem['business'][1][0]=array(
		'',
		array(
			'user_order.php,1,product,交易记录',
		)
	);
	$mem['relation'][1][0]=array(
		'',
		array(
			'branch.php,1,product,添加分店',
		)
	);
?>