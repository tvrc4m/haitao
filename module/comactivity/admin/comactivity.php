<?php

$option = $_POST['act'];

if($option == 'add'){

        $sql = "select id FROM mallbuilder_product WHERE skuid in (".$_POST['sku'].")";
        $db->query($sql);
        $pid = $db->getRows();
        if(!empty($pid)) {
            foreach($pid as $key => $val){
                $newid[] = $val['id'];
            }
            $newid = implode(',',$newid);

            $begintime = strtotime($_POST['begintime']);
            $endtime = strtotime($_POST['endtime']);

            $sql = "INSERT INTO mallbuilder_commodity_activity(cid,pid,sku,begintime,endtime,platform,position,`status`) VALUE (0,'" . $newid . "','" . $_POST['sku'] . '\',' . $begintime . ',' . $endtime . ',' . $_POST['platform'] . ',' . $_POST['position'] . ',' . $_POST['status'] . ")";
            $res = $db->query($sql);
            if($res){
                msg('?m=comactivity&s=comactivity.php&operation=add_ads');
            }
        }

}elseif($option == 'list' || empty($option)){
    $sql = "SELECT * FROM mallbuilder_commodity_activity ORDER BY begintime";
    $db->query($sql);
    $res = $db->getRows();

    $tpl->assign('de',$res);
    /*foreach($res as $key => $val){
        $sql = "select name,price,pic FROM mallbuilder_product WHERE id in(".$val['pid'].")";
        $db->query($sql);
        $res[$key]['product'] = $db->getRows();

   }*/

}
$tpl->display("comactivity.htm");