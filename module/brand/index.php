<?php
/*
	$sql="select * from ".BRANDCAT." where parent_id ='0' order by displayorder";
	$db->query($sql);
	$re=$db->getRows();
	foreach($re as $k=>$v)
	{
		$sql="SELECT * FROM ".BRAND." WHERE  catid = $v[id] and `status` > 0   ORDER BY displayorder asc";
		$db->query($sql);
		$re[$k]['brand']=$db->getRows();
	}
	*/
$sql="SELECT br.name,br.logo,brc.catname,br.catid FROM ".BRAND." br JOIN ".BRANDCAT." brc ON brc.id=br.catid where brc.parent_id ='0' AND br.`status` > 0 order by brc.displayorder,br.displayorder asc";
$db->query($sql);
$res=$db->getRows();
$re = array();
foreach($res as $key=>$val)
{
    $re[$val["catid"]]["catname"] = $val["catname"];
    $re[$val["catid"]]['brand'][] = array("name"=>$val["name"],"logo"=>$val["logo"]);
}


$tpl->assign("bcat",$re);

$tpl->assign("current","brand");
include("footer.php");
$out=tplfetch("brand_index.htm");
?>