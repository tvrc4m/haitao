<?php
//aes加密
function encrypt ($encrypt,$key=''){
    $iv_size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_128, MCRYPT_MODE_CBC);
    $iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
    $encrypted = mcrypt_encrypt(MCRYPT_RIJNDAEL_128, $key,$encrypt,MCRYPT_MODE_CBC,$iv);
    return base64_encode($encrypted);
}
$pass = "AiMeiHtBoyWholeSaler001";
$time = "20160324120817";
$token = encrypt($time,$pass);
$arr = array(
    "logistics_id"=>"",
    "logistics_sheng"=>"",
    "logistics_shi"=>"",
    "logistics_xian"=>"",
    "logistics_address"=>"",
    "goods_attributes_list"=>array(
        array(
            "id"=>"",
            "sku_id"=>"",
            "attributes_price"=>"",
            "attributes_num"=>"",

        )
    )
);
$ob = curl_init();
curl_setopt($ob, CURLOPT_URL, "http://121.40.31.77:8015/Service/Get_Logistics_Money.aspx");
curl_setopt($ob, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ob, CURLOPT_HEADER, 0);
$con = curl_exec($ob);
curl_close($ob);
print_r($con);
?>