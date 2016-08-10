<?php
$option = $_REQUEST;

//新增商品活动
if($option['operation'] == 'add_ads'){
    if(!empty($_POST)) {
        $num = count(explode(',',$_POST['sku']));

        $sql = "select id FROM mallbuilder_product WHERE skuid in (" . $_POST['sku'] . ")";
        $db->query($sql);
        $pid = $db->getRows();
        if($num != count($pid)){
            msg('?m=comactivity&s=comactivity.php&operation=add_ads&err=-1&sku='.$_POST['sku']);
        }
        if (!empty($pid)) {
            foreach ($pid as $key => $val) {
                $newid[] = $val['id'];
            }
            $newid = implode(',', $newid);

            $begintime = strtotime($_POST['begintime']);
            $endtime = strtotime($_POST['endtime']);

            $sql = "INSERT INTO mallbuilder_commodity_activity(cid,pid,sku,begintime,endtime,platform,position,`status`) VALUE (0,'" . $newid . "','" . $_POST['sku'] . '\',' . $begintime . ',' . $endtime . ',' . $_POST['platform'] . ',' . $_POST['position'] . ',' . $_POST['status'] . ")";
            $res = $db->query($sql);
            if ($res) {
                msg('?m=comactivity&s=comactivity.php&operation=add_ads');
            }
        }
    }
    $tpl->assign('des',getCat());
//商品信息修改
}elseif($option['operation'] == 'edit_ads') {
    if (empty($_POST)) {
        $sql = "SELECT * FROM mallbuilder_commodity_activity WHERE cid = " . $option['editid'];
        $db->query($sql);
        $res = $db->fetchRow();
        $tpl->assign('de', $res);
        $tpl->assign('des', getCat());

    } else {
        $sql = "select id FROM mallbuilder_product WHERE skuid in (" . $_POST['sku'] . ")";
        $db->query($sql);
        $pid = $db->getRows();
        if (!empty($pid)) {
            foreach ($pid as $key => $val) {
                $newid[] = $val['id'];
            }
            $newid = implode(',', $newid);
            $sql = "UPDATE mallbuilder_commodity_activity SET pid = '{$newid}', sku = '{$_POST[sku]}', begintime = " . strtotime($_POST[begintime]) . ", endtime = " . strtotime($_POST[endtime]) . ", platform = {$_POST[platform]}, position = {$_POST[position]}, `status` = {$_POST[status]} WHERE cid = " . $option['editid'];
            if ($db->query($sql)) {
                msg('?m=comactivity&s=comactivity.php');
            }
        }
    }
}elseif($option['operation'] == 'del_ads'){
    $cid = is_array($option['chk']) ? implode(',',$option['chk']) : $option['chk'];
    $sql = "DELETE from mallbuilder_commodity_activity WHERE cid in ($cid)";
    if($db->query($sql)){
        msg('?m=comactivity&s=comactivity.php');
    }
//活动商品展示
}elseif($option['act'] == 'list' || empty($option['act'])){

    $where = !empty($option['name']) ? "WHERE LOCATE($option[name],sku)" : null ;
    include_once("$config[webroot]/includes/page_utf_class.php");
    $sql = "SELECT * FROM mallbuilder_commodity_activity $where ORDER BY begintime DESC ";

    $page = new Page;
    $page->listRows=20;
    //分页
    if (!$page->__get('totalRows'))
    {
        $db->query($sql);
        $page->totalRows = $db->num_rows();
    }
    $sql .= "  limit ".$page->firstRow.",".$page->listRows;

    $db->query($sql);
    $res = $db->getRows();
    $tpl->assign('page',$page->prompt());
    $tpl->assign('de',$res);
    $tpl->assign('des', getCat());
    /*foreach($res as $key => $val){
        $sql = "select name,price,pic FROM mallbuilder_product WHERE id in(".$val['pid'].")";
        $db->query($sql);
        $res[$key]['product'] = $db->getRows();

   }*/
}

//获取分类
function getCat(){
    global $db;
    $sql="select * from ".PCAT." where catid<9999 order by nums,catid";
    $db->query($sql);
    $de=$db->getRows();

    foreach($de as $key=>$val)
    {
        $sql="select * from ".PCAT." where catid < '".$val['catid']."99' and catid > '".$val['catid']."00' order by nums,catid";
        $db->query($sql);
        $a=$db->getRows();
        foreach($a as $ke=>$va)
        {
            $sql="select * from ".PCAT." where catid < '".$va['catid']."99' and catid > '".$va['catid']."00' order by nums,catid";
            $db->query($sql);
            $a[$ke]['scat']=$db->getRows();
        }
        $de[$key]['scat']=$a;

    }
    return $de;
}
$tpl->display("comactivity.htm");