<?php
include_once("includes/global.php");
include_once("includes/smarty_config.php");
//==========================================
include_once("module/payment/includes/plugin_pay_class.php");

//收支明细
if(!empty($_POST['type']) && $_POST['type'] == 'payments'){
	$pay=new pay();
    $page = $_POST['page'];
    $limit = 5;
    $begin = $page+$limit;
	$re=$pay->get_trade_record($buid,$limit,$begin);
    if($re){
        echo json_encode(array(
            'code' => '200',
            'data' => $re,
            'status' => 2
        ));
    }else{
        echo json_encode(array(
            'code' => '300',
            'data' => null,
            'status' => 1
        ));
    }
}

?>