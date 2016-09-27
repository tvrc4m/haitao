<?php

include_once("../../includes/global.php");

$product_id = intval($_REQUEST['pid']);

$p_rows = $distribution->getDistributionProduct($buid, $product_id);

if ($p_rows)
{
	echo 1;
}
else
{
	//判断商铺是否允许改用户分销
	$distribution_shop_limit = new distribution_shop_limit();
	include_once("$config[webroot]/module/distribution/includes/plugin_distribution_shop_limit_class.php");
	//需要判断产品是否为分销产品
	if($distribution_shop_limit->is_access_user($product_id,$buid))
	{
		$rs = $distribution->addDistributionProduct($buid, $product_id);

		if ($rs)
		{
			echo 2;
		}
		else
		{
			echo -1;
		}
	}
	else
	{
		echo -2;
	}

}



