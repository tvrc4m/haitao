<?php
//接口方法
function aes($url='',$post_data=''){
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
    $list = curl_exec($ch);
    curl_close($ch);
    return json_decode($list,true);
}
$pass = "AiMeiHtBoyWholeSaler100";
//$time = "20160324120817";
$time = "20160329135132";

$arr = array(
    "goods_order_count"=>"1",
    "msg"=>"test",
    "goods_order"=>array(
        array(
        "order_code"=>"12321321",
        "order_sum_money"=>"1111",
        "order_member_name"=>"123123",
        "order_member_id_number"=>"130429198702155219",
        "order_member_phone"=>"111112323",
        "order_member_sheng"=>"北京",
        "order_member_shi"=>"北京",
        "order_member_xian"=>"朝阳",
        "order_member_address"=>"东大街",
        "order_logistics_id"=>"12321321",
        "order_logistics_money"=>"133",
        "order_goods_money"=>"123213",
        "goods_attributes_list"=>array(
            array(
                "id"=>"1111111111111111",
                "sku_id"=>"2222222222",
                "attributes_price"=>"3333333",
                "attributes_num"=>"444444444",
            ),array(
                "id"=>"5555555555",
                "sku_id"=>"66666666",
                "attributes_price"=>"7777777777",
                "attributes_num"=>"888888888",
            )
        )
    )
    )
);
$order = json_encode($arr);
$tokens = aes("http://121.40.31.77:8015/Service/Get_Aes.aspx",array ("time" => $time,"pass" => $pass));
if(is_array($tokens)){
    if($tokens['status']==0){
        $token = $tokens['aes'];
    }
}

$type = aes("http://121.40.31.77:8015/Service/Send_Goods_Order.aspx",array ("time" => $time,"pass" => $pass,"token" => $token,"order" => $order));
var_dump($type);

?>