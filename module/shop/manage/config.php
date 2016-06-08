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
	)
?>