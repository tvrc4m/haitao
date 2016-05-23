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
    $list = curl_exec($ch);
    var_dump($list);die;
    curl_close($ch);
    return json_decode($list,true);
}
$order_id = '160314030842001';
$logistics_name = '111';
$logistics_id = '22222222';
$time = '33333333';
$sign = 'aaaaaaaaaaaa';
//$sign = '373b63998f93eefb69d54fce26e8c806';
$aaa = array ("order_id" => $order_id);
$tokens = aes("http://haitao.com/api/gaofei.php",$aaa);
var_dump($tokens);
?>