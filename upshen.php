<?php
/*
 * 1、验证身份证是否存在
 * 2、身份证信息
 *      ①.身份证存在，直接提交订单信息
 *      ②.身份证不存在，上传身份证信息及正反面资料
 * 3、提交订单信息
 * */
include_once("api/curlUp.php");
include_once ("includes/global.php");
/*$is_num = "130429198702155219";
$is_name = "张高飞";
$realPositive = "zheng.jpg";
$realBack = "bei.jpg";*/
$buid=174;
$order_id = '160607111126001';
if(!empty($buid)){
    $sql ="select real_name,identity_card,real_img1,real_img2 from pay_member where identity_verify=true and userid=".$buid;
    $db->query($sql);
    $user = $db->fetchRow();
    //$upFile = new curlUp($is_num,$is_name,$realPositive,$realBack);
    //$user['identity_card'] = '130429198702155211';
    $upFile = new curlUp($user['real_name'],$user['identity_card'],$user['real_img1'],$user['real_img2']);
    //验证身份证是否存在
    $real = $upFile->real();
    if(!$real['is_exists']){
        $realUp = $upFile->curlUpload();
        if($realUp['goods_type_count'])
            echo '记录上传失败！';
    }else{
        $sql = "select od.order_id,od.create_time,od.consignee_address,od.consignee_mobile,od.logistics_price,od.product_price,od.consignee,od.logistics_name,od.logistics_price,od.product_price,op.order_id,op.skuid,op.price,op.num,op.trade from ".ORDER." od left join ".ORPRO." op on od.order_id=op.order_id where od.order_id={$order_id} group by od.order_id";
        $db->query($sql);
        $list = $db->fetchRow();
        $list['identity_card'] = $user['identity_card'];
        $aa = $upFile->orderUp($list);
        var_dump($aa);
    }
    var_dump($user);
    var_dump($real);
    die;
}

?>