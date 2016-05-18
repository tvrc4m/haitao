<?php
    include("../../includes/global.php");
    include("../../includes/smarty_config.php");
	global $cache,$cachetime,$dpid,$dcid,$daid,$config,$db,$tpl;
    $ar = $_POST['ar'];
    $num = $_POST['num'];
    $flag=md5(implode(",",$ar));
    $tmpdir=$config['webroot']."/templates/".$config['temp']."/label/".$ar['temp'].".htm";

    if(file_exists($tmpdir))
        $tpl->template_dir = $config['webroot']."/templates/".$config['temp']."/label/";
    else
        $tpl->template_dir = $config['webroot']."/templates/default/label/";

    $ar['temp']=empty($ar['temp'])?'pro_default':$ar['temp'];

    $limit=$ar['limit'];
    $begin = ($limit+20)*$num;
    $rec=$ar['rec'];
    $noid=$ar['noid'];
    $comp=$ar['comid'];
    $catid=$ar['catid'];
    $ptype=$ar['ptype'];
    $proid=$ar['proid'];
    $o=$ar['o'];
    $userid=$ar['uid'];
    $tg=$ar['tg']?$ar['tg']:"false";

    if($tg)
        $scl.=" and a.is_tg='$tg'";

    /*---分站---*/
/*    if($dpid)
        $scl.=" and b.provinceid='".getdistrictid($dpid)."'";
    if($dcid)
        $scl.=" and b.cityid='".getdistrictid($dcid)."'";
    if($daid)
        $scl.=" and b.areaid='".getdistrictid($daid)."'";
    if($dsid)
        $scl.=" and b.streetid='".getdistrictid($dsid)."'";*/


    // -- 手机端屏蔽虚拟商品 bruce 2015-1-22
    if($config['temp'] == "wap")
    {
        $scl .= " and a.`is_virtual` = 0";
    }

    if(is_numeric($rec))
        $scl.=" and a.status='$rec'";
    else
        $scl.=" and a.status>0";

    if(!empty($comp))
        $scl.=" and a.member_id=$comp ";
    if(!empty($catid))
        $scl.=" and LOCATE($catid,a.catid)=1";

    if(!empty($ptype))
        $scl.=" and a.type=$ptype ";
    if(!empty($proid))
        $scl.=" and a.id in($proid)";

    if(!empty($noid))
        $scl.=" and a.id != '$noid' ";

    if(!empty($userid))
        $scl.=" and a.member_id = '$userid' ";

    if($o=='1')
        $or.=" order by sales DESC ,id desc ";
    elseif($o=='2')
        $or.=" order by price asc,id desc";
    elseif($o==3)
        $or.=" order by price desc,id desc";
    elseif($o=='4')
        $or.=" order by clicks desc,id desc";
    elseif($o=='5')
        $or.=" order by goodbad desc,id desc";
    elseif($o=='6')
        $or.=" order by a.status desc,a.uptime desc,id desc";
    else
        $scl.=" order by a.rank desc,a.uptime desc";

    $sql="select a.id,a.name as pname,a.price,a.market_price,a.national,a.member_id as userid,a.pic,b.user,b.company FROM ".PRODUCT." a left join ".SHOP." b on a.member_id=b.userid WHERE b.shop_statu=1 and is_shelves=1 $scl $or limit $begin,$limit";
    $db->query($sql);
    $re=$db->getRows();
    //==================================================
    if(!empty($re)) {
        foreach ($re as $key => $val) {
            $sql = "select title,img from mallbuilder_national_pavilions where id = " . $val['national'];
            $db->query($sql);
            $re[$key]['nationalurl'] = $db->fetch_row();
        }
        $tpl->assign("config", $config);
        $tpl->assign("pro", $re);
        echo $tpl->fetch($ar['temp'] . '.htm', $flag);
    }
?>