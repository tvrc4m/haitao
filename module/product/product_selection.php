<?php
    //查询店铺所有商品
    $sql = "select id,member_id,member_name,catid,`name`,subhead,brand,market_price,price,stock,pic,national,ptype,pid from mallbuilder_product where member_id = 44 and ptype = 1 ";
    $db -> query($sql);
    $list = $db->getRows();
    $tpl -> assign('products', $list);
    $output=tplfetch("product_selection.htm");
?>
