<?php
/**
 * Created by PhpStorm.
 * User: wonder
 * Date: 2016/5/20
 * Time: 14:13
 */

function aes($url='',$post_data=''){
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
    $list = curl_exec($ch);
    curl_close($ch);
    return json_decode($list,true);
}
$order_id = '160314030842001';
$logistics_name = '111';
$logistics_id = '22222222';
$time = '33333333';
//$sign = 'aaaaaaaaaaaa';
$sign = '373b63998f93eefb69d54fce26e8c806';
$list = array ("order_id" => $order_id,"logistics_name" => $logistics_name,"logistics_id" => $logistics_id,"time" => $time,"sign" => $sign);
var_dump($list);
$tokens = aes("https://www.mayihaitao.com/api/orderLogistic.php",$list);
var_dump($tokens);
?>