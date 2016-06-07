<?php
global $buid;
$act = $_REQUEST['act'];
if(!empty($act) && $act == 'insert'){
    $id = implode($_POST['id'], ',');
    $nums = $_POST['nums'];
    $sql = "select member_id,member_name,catid,type,`name`,subhead,keywords,brand,market_price,price,stock,sales,`code`,pic,pic_more,start_time_type,start_time,valid_time,weight,cubage,province_id,city_id,area_id,street_id,area,freight_id,freight_type,post_price,express_price,ems_price,clicks,rank,uptime,`status`,is_shelves,custom_cat_id,promotion_id,goodbad,shop_rec,is_invoice,is_tg,con,is_virtual,national,is_dist,down_reason,ship_free_id,skuid,trade,pid,ptype from mallbuilder_product where id in($id)";
    $db->query($sql);
    $pro = $db->getRows();
    foreach($pro as $key => $val){
        $in_sql ="insert into mallbuilder_product(member_id,member_name,catid,type,`name`,subhead,keywords,brand,market_price,price,stock,sales,`code`,pic,pic_more,start_time_type,start_time,valid_time,weight,cubage,province_id,city_id,area_id,street_id,area,freight_id,freight_type,post_price,express_price,ems_price,clicks,rank,uptime,`status`,is_shelves,custom_cat_id,promotion_id,goodbad,shop_rec,is_invoice,is_tg,con,is_virtual,national,is_dist,down_reason,ship_free_id,skuid,trade,pid,ptype) VALUE (";
        $str = '';
        foreach($val as $k => $v){
            if($k=='pid'){
                $str .= "'".$val['member_id']."',";
            }elseif($k=='ptype'){
                $str .= "2,";
            }elseif($k=='member_id'){
                $str .= "$buid,";
            }elseif(is_string($v)){
                $str .= "'".$v."',";
            }elseif(is_null($v)){
                $str .= null.',';
            }else{
                $str .= $v.',';
            }
        }
        $str = trim($str,',');
        $in_sql = $in_sql.$str.")" ;
        $db->query($in_sql);
    }
    die;
    var_dump($pro);
}else {
    //var_dump($_POST);
    //查询店铺所有商品
    $sql = "select id,member_id,member_name,catid,`name`,subhead,brand,market_price,price,stock,pic,national,ptype,pid from mallbuilder_product where member_id = 44 and ptype = 1 ";
    $db->query($sql);
    $list = $db->getRows();
    $tpl->assign('products', $list);
    $output = tplfetch("product_selection.htm");
}
?>
