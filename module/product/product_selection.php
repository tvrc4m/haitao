<?php
global $buid;
$act = $_REQUEST['act'];
if(!empty($act) && $act == 'insert'){
    $arr = $_POST['pro'];
    $id = "";
    $nums = array();
    foreach($arr as $key=>$val){
        if(isset($val['id'])){
            $id .= $val['id'].',';
            $nums[] = $val['num'];
        }
    }
    $id = trim($id,',');
    $sql = "select member_id,member_name,catid,type,`name`,subhead,keywords,brand,market_price,price,stock,sales,`code`,pic,pic_more,start_time_type,start_time,valid_time,weight,cubage,province_id,city_id,area_id,street_id,area,freight_id,freight_type,post_price,express_price,ems_price,clicks,rank,uptime,`status`,is_shelves,custom_cat_id,promotion_id,goodbad,shop_rec,is_invoice,is_tg,con,is_virtual,national,is_dist,down_reason,ship_free_id,skuid,trade,pid,ptype from mallbuilder_product where id in($id)";
    $db->query($sql);
    $pro = $db->getRows();
    foreach($pro as $key => $val){
        $in_sql ="insert into mallbuilder_product(member_id,member_name,catid,type,`name`,subhead,keywords,brand,market_price,price,stock,sales,`code`,pic,pic_more,start_time_type,start_time,valid_time,weight,cubage,province_id,city_id,area_id,street_id,area,freight_id,freight_type,post_price,express_price,ems_price,clicks,rank,uptime,`status`,is_shelves,custom_cat_id,promotion_id,goodbad,shop_rec,is_invoice,is_tg,con,is_virtual,national,is_dist,down_reason,ship_free_id,skuid,trade,pid,ptype) VALUE (";
        $str = '';
        foreach($val as $k => $v){
            if($k=='pid'){
                $str .= "'".$val['member_id']."',";
            }elseif($k=='stock'){
                $str .= $nums[$key].",";
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
        $in_sql = $in_sql.$str.")";
        $db->query($in_sql);
    }
    msg('main.php?m=product&s=product_selection');
}else {
    //var_dump($_POST);
    //查询店铺所有商品
    $sql = "select id,member_id,member_name,catid,`name`,subhead,brand,market_price,price,stock,pic,national,ptype,pid from mallbuilder_product where member_id = 44 and ptype = 1 ";
    include_once($config['webroot']."/includes/page_utf_class.php");
    $page = new Page;
    $page->url='main.php';
    $page->listRows = 10;
    if (!$page->__get('totalRows'))
    {
        $db->query($sql);
        $page->totalRows =$db->num_rows();
    }
    $sql .= "  limit ".$page->firstRow.",".$page->listRows;
    $list['page']=$page->prompt();
    $list['count']=$page->totalRows;
    //--------------------------------------------------
    $db->query($sql);
    $list['list'] = $db->getRows();
    //var_dump($list);
    $tpl->assign('products', $list);
    $output = tplfetch("product_selection.htm");
}
?>
