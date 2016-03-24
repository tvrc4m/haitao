<?php
//aes加密
function encrypt ($encrypt,$key=''){
    $iv_size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_128, MCRYPT_MODE_CBC);
    $iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
    $encrypted = mcrypt_encrypt(MCRYPT_RIJNDAEL_128, $key,$encrypt,MCRYPT_MODE_CBC,$iv);
    return base64_encode($encrypted);
}
$time = "20160324120817";
$token = encrypt($time,'AiMeiHtBoyWholeSaler001');

$arr = array(
    "goods_order_count"=>"5",
    "msg"=>"test",
    "goods_order"=>array(
        "order_code"=>"12321321",
        "order_sum_money"=>"1111",
        "order_member_name"=>"123123",
        "order_member_id_number"=>"123123213213",
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
);
$order = json_encode($arr);

$ob = curl_init();
curl_setopt($ob, CURLOPT_URL, "http://121.40.31.77:8015/Service/Send_Goods_Order.aspx?time={$time}&token={$token}&order={$order}");
curl_setopt($ob, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ob, CURLOPT_HEADER, 0);
$con = curl_exec($ob);
curl_close($ob);

?>