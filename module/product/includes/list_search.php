<?php

$sql = "SELECT cat,catid FROM mallbuilder_product_cat WHERE cat ='$key'";
$db->query($sql);
$cats = $db->fetchRow();
$strs="";
if(!empty($cats)){
    $strs = "OR catid=".$cats['catid'];
}

$sql = "SELECT catid,brand FROM mallbuilder_product WHERE `name` LIKE '%{$key}%' OR brand ='{$key}' OR keywords LIKE '%{$key}%' $strs";

$db->query($sql);
$ress = $db->getRows();
var_dump($ress);
if(!empty($ress)) {
    foreach ($ress as $val) {
        $cats[] = $val['catid'];
        $brands[] = $val['brand'];
    }

    $brands = array_unique($brands);
    foreach ($brands as $key => $val) {
        $new_brands[]['name'] = $val;
    }

    $tpl->assign("brand", $new_brands);
    var_dump($new_brands);
    $cats = array_unique($cats);
    $cats = implode($cats, ',');
    $sql = "select cat,catid from " . PCAT . " where catid in ($cats) order by nums asc ";
    $db->query($sql);
    $de = $db->getRows();
    $tpl->assign("cat", $de);
}