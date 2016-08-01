<?php
include_once("includes/global.php");
include_once("includes/smarty_config.php");
if($config['temp']=='wap'){

/*if($_GET['id'] and is_numeric($_GET['id']))
{
	$max=$_GET['id']."99";
	$min=$_GET['id']."00";
	$s="catid<=$max and catid>=$min ";
}
else
{
	$s="catid<9999";
}
echo $sql="select catid,cat from ".PCAT." WHERE  $s order by nums asc,char_index asc";

$db->query($sql);
$re=$db->getRows();
foreach($re as $k=>$val)
{

	$maxs=$val['catid']."99";
	$mins=$val['catid']."00";
	$ss="catid<=$maxs and catid>=$mins ";
	$sql="select count(*) as c from ".PCAT." WHERE  $ss order by nums asc,char_index asc";
	$db->query($sql);
	$re[$k]['count']=$db->fetchField('c');	
}
$tpl->assign("cat",$re);*/

$re=array();
$month=date("m");
$month=substr($month,0,1)?$month:trim($month,'0');
$sql="select catid,cat,pic from ".PCAT." $sql WHERE catid < 9999 and (`month` not like '%,".$month.",%' || `month` is NULL) and `isindex` = 1 order by nums asc , catid limit 0,13";
$db->query($sql);
$re=$db->getRows();

foreach($re as $key=>$v)
{
	$s=$v['catid']."00";
	$b=$v['catid']."99";
	//$sql="select catid,cat,brand,month from ".PCAT." where `isindex` = 1 and  catid>$s and catid<$b and (`month` not like '%,".$month.",%' || `month` is NULL) $ssql order by nums asc limit 0,6";
	$sql="select catid,cat,brand,month from ".PCAT." where `isindex` = 1 and  catid>$s and catid<$b and (`month` not like '%,".$month.",%' || `month` is NULL) $ssql order by nums asc ";
	$db->query($sql);
	$sre=$db->getRows();
	foreach($sre as $skey=>$sv)
	{
		$s=$sv["catid"]."00";
		$b=$sv["catid"]."99";
		//$sql="select catid,cat,wpic from ".PCAT." where `isindex` = 1 and catid>$s and catid<$b and (`month` not like '%,".$month.",%' || `month` is NULL) $ssql order by nums asc limit 0,12";
		$sql="select catid,cat,wpic from ".PCAT." where `isindex` = 1 and catid>$s and catid<$b and (`month` not like '%,".$month.",%' || `month` is NULL) $ssql order by nums asc ";
		$db->query($sql);
		$sre[$skey]["scat"]=$db->getRows();
		if($sv['brand'])
		{
			$sql="select name,id,logo from ".BRAND." where status>0 and id in ($sv[brand]) order by id asc ";
			//$sql="select name,id,logo from ".BRAND." where status>0 and id in ($sv[brand]) order by id asc limit 0,12";
			$db->query($sql);
			$sre[$skey]["brand"]=$db->getRows();
		}
        $sre[$skey]['pid'] = $v['catid'];
	}
	$re[$key]["scat"]=$sre;
}
$tpl->assign("config",$config);
$tpl->assign("cat",$re);

/*echo "<pre>";
var_export($re);die;*/

$config['title']=$de['title'];
$config['keyword']=$de['keywords'];
$config['description']=$de['description'];

//======================================================================
include_once("footer.php");
$tpl->display("cat.htm");

}else{
	msg($config['weburl']);
}
?>