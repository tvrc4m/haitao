<?php
//===============================================

$shopconfig['menu'][3]=array(
	'menu_show'=>'1','menu_name'=>$lang['pro_list'],'menu_link'=>'product_list','module'=>'product',
);

$PluginManager = Yf_Plugin_Manager::getInstance();
$PluginManager->trigger('shop_menu_show');

//=====================管理员后台==================
$mem['product'][1][0]=array(
	'产品管理',
	array(
		'product.php,1,product,产品列表',
		'cpmod.php,0,product,编辑产品信息',
		'product_consult.php,1,product,产品咨询',
		'product_comment.php,1,product,产品评价',
	),
);
$mem['product'][1][1]=array(
	'产品配置',
	array(
		'module_config.php,1,product,模块设置',
		'product_cat.php,1,product,分类管理',
		'brand.php,1,brand,品牌管理',
		'brand_cat.php,0,brand,品牌分类管理',
		'property.php,1,product,类型管理',
		'spec.php,1,product,规格管理',
	),	
);
$mem['business'][1][0]=array(
	'',
	array(
		'user_order.php,1,product,订单管理',
	)
);
?>