<?php

include_once("$config[webroot]/module/product/includes/plugin_order_class.php");
include_once("$config[webroot]/includes/page_utf_class.php");
$order=new order();

if($_GET['order_id'])
{
	if($_GET['act']=='edit_price')
	{
		$tpl->assign("de",$de = $order->orderdetail($_GET['order_id']));
	}
	$output=tplfetch("admin_distribution_order_list.htm",$flag,true);
}
else
{
	if(isset($_GET['flag'])&&isset($_GET['id']))
	{
		if($_GET['flag']==0)
			$order->set_order_statu($_GET['id'],0);//取消定单
	}

	//===================================================
	$_GET['status'] = isset($_GET['status'])?$_GET['status']:"1";
	$status = $_GET['status'];
    if(!empty($_GET['is_ajax']) && $_GET['is_ajax'] == 'yes'){
        $re=$order->sellorder($status, 0, 0, $_GET['p']+10, 10);
        if($re['list']){
            echo json_encode(array(
                'status' => 2,
                'data' => $re['list'],
                'code' => 200
            ));
        }else{
            echo json_encode(array(
                'status' => 1,
                'data' => null,
                'code' => 300
            ));
        }

        die;
    }else{
        $re=$order->sellorder($status, 0);
    }
	$tpl->assign("slist",$re);

	//===================================================
	$tpl->assign("config",$config);
	$tpl->assign("lang",$lang);
	$output=tplfetch("admin_distribution_order_list.htm");
}

?>