<?php
include_once("module/product/includes/plugin_product_class.php");
$product=new product();
//====================================================================
//是否启用Sphinx搜索
if ($sphinx_search_flag && $key=$_GET['keyword'] && extension_loaded("sphinx") && extension_loaded("scws"))
{
	$re=$product->shop_pro_list_by_sphinx();
}
else
{
	$re=$product->shop_pro_list($_GET['page'],10);
}



if($re['list']){
	echo json_encode(array(
		'code' => 200,
		'data' => $re['list'],
		'status' => 2
	));
}else{
	echo json_encode(array(
		'code' => 300,
		'data' => null,
		'status' => 1
	));
}
die;
?>