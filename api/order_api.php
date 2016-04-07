<?php
//写入日志
function file_log($url='',$con='')
{
    if (file_exists($url)) {
        $str = file_get_contents($url);
        $of = fopen("{$url}", 'w');
        $con = $str . ',' . $con;
        if($of) fwrite($of, $con);
        fclose($of);
    } else {
        $of = fopen("{$url}", 'w');
        if ($of) fwrite($of, $con);
        fclose($of);
    }
}
/*curl调用方式
 * post
 * */
function ses_curl($url='',$post_data=''){
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
    $list = curl_exec($ch);
    curl_close($ch);
    return json_decode($list,true);
}

/*订单提交
 * @param $id
 */
function sub_order($id){
    global $db,$config;
    $pass = "AiMeiHtBoyWholeSaler100";
    $sql = "select order_id,create_time,consignee_address,consignee_mobile,logistics_price,product_price,consignee,logistics_type,logistics_price,product_price from ".ORDER." where order_id='$id'";
    $db->query($sql);
    $orlist['order'] = $db->fetchRow();
    $sqlpro = "select order_id,skuid,price,num from ".ORPRO." where order_id='$id'";
    $db->query($sqlpro);
    $orlist['orpro'] = $db->getRows();
    $orpro = array();
    $time = date("YmdHis",$orlist['order']['create_time']);
    $addr = explode(' ',$orlist['order']['consignee_address']);

    $list = array();
    $list['goods_order_count']=1;
    $list['msg'] = '';
    $list['goods_order'][0]['order_code']=$orlist['order']['order_id'];
    $list['goods_order'][0]['order_sum_money']=(string)($orlist['order']['product_price']+20);//$orlist['order']['logistics_price']);
    $list['goods_order'][0]['order_m ember_name']=$orlist['order']['consignee'];
    $list['goods_order'][0]['order_member_id_number']='130429198603041233';
    $list['goods_order'][0]['order_member_phone']=$orlist['order']['consignee_mobile'];
    $list['goods_order'][0]['order_member_sheng']=$addr[0];
    $list['goods_order'][0]['order_member_shi']=$addr[1];
    $list['goods_order'][0]['order_member_xian']=$addr[2];
    $list['goods_order'][0]['order_member_address']=$addr[3];
    $list['goods_order'][0]['order_logistics_id']='1';//$orlist['order']['logistics_type'];
    $list['goods_order'][0]['order_logistics_money']='20';//$orlist['order']['logistics_price'];
    $list['goods_order'][0]['order_goods_money']=$orlist['order']['product_price'];
    for($i=0;$i<count($orlist['orpro']);$i++){
        $list['goods_order'][0]['goods_attributes_list'][$i]['id']=$orlist['orpro'][$i]['id'];
        $list['goods_order'][0]['goods_attributes_list'][$i]['sku_id']=$orlist['orpro'][$i]['skuid'];
        $list['goods_order'][0]['goods_attributes_list'][$i]['price']=$orlist['orpro'][$i]['price'];
        $list['goods_order'][0]['goods_attributes_list'][$i]['num']=$orlist['orpro'][$i]['num'];
    }
    $order = json_encode($list);file_log($config['webroot']."/api/list.log",$order);
    $tokens = ses_curl("http://121.40.31.77:8015/Service/Get_Aes.aspx",array ("time" => $time,"pass" => $pass));//获取验证token
    if(is_array($tokens)){
        if($tokens['status']==0){
            $token = $tokens['aes'];
        }
    }
    $type = ses_curl("http://121.40.31.77:8015/Service/Send_Goods_Order.aspx",array ("time" => $time,"pass" => $pass,"token" => $token,"order" => $order));
    unset($list);
    unset($order);
    if($type['status']==0){
        file_log($config['webroot']."/api/success.log",$id);
    }else{
        file_log($config['webroot']."/api/fail.log",$id.'/status:'.$type['status'].'/msg:'.$type['msg']);
    }
}
//取消订单
function remove_order(){
    global $db,$config;
}
?>