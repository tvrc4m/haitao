<?php
include_once("$config[webroot]/module/distribution/includes/plugin_distribution_class.php");

$distribution = new distribution();

$level = null;

if (isset($_REQUEST['level']))
{
	$level = intval($_REQUEST['level']);
}
else
{
	$level = array(1, 2);
}

$page_str = true;

if(isset($_GET['ptype']) && $_GET['ptype'] == 'ajax'){
	$res =  $distribution->getDistributionChildUser($buid, $level, $page_str, $_GET['page'], 10);
	if($res){
		echo json_encode(array(
			'code' => 200,
			'data' => $res,
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
}

$child_user_rows = $distribution->getDistributionChildUser($buid, $level, $page_str);

$type = 'inbox';
$tpl->assign("re", $child_user_rows);
//============================================
$tpl->assign("config", $config);
$tpl->assign("lang", $lang);
$tpl->assign("page", $page_str);

$output = tplfetch("admin_distribution_user.htm");

