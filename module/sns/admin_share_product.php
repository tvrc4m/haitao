<?php
include_once("$config[webroot]/module/sns/includes/plugin_share_class.php");
$share=new share();
//=======================================

if(isset($_GET['ptype']) && $_GET['ptype'] == 'ajax'){
	$res = $share->GetShareGoodsList($_GET['page'],10);
	if($res['list']){
		echo json_encode(array(
			'code' => 200,
			'data' => $res['list'],
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

$tpl->assign("re",$share->GetShareGoodsList(0,10));
/*echo '<pre>';
var_export($share->GetShareGoodsList(0,10));die;*/
//删除
/*if($_GET['type']=='del' and is_numeric($_GET['id']))
{
	$share->DelShareProduct($_GET['id']);
	$admin->msg("main.php?m=sns&s=admin_share_product");
}*/
if($_GET['type']=='del' and is_numeric($_GET['id']))
{
	if($share->DelShareProduct($_GET['id'])){
        return json_encode(array(
            'data' => 'OK',
            'status' => 200
        ));
    }else{
        return json_encode(array(
            'data' => 'NO',
            'status' => 300
        ));
    }
}
//批量删除
if($_GET['pid'])
{
	$pid=explode(',',$_GET['pid']);
	foreach($pid as $val)
	{
		$share->DelShareProduct($val);
	}
	die;
}
//==================================
$tpl->assign("config",$config);
$tpl->assign("lang",$lang);
$output=tplfetch("admin_share_product.htm");
?>