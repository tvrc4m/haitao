<?php
    /*
	$sql="select name,id from ".DISTRICT." where pid=0 order by sorting,id";
	$db->query($sql);
	$de=$db->getRows();
	foreach($de as $k=>$v)
	{
		$sql="select name,id from ".DISTRICT." where pid=$v[id] order by sorting,id ";
		$db->query($sql);
		$de[$k]['city']=$db->getRows();	
	}
*/
    $sql = "select c.name,c.id,p.name AS pname,p.id AS pid from ".DISTRICT." c LEFT ".DISTRICT." p ON p.id=c.pid  where p.pid=0 order by p.sorting,p.id,c.sorting,c.id ";
    $db->query($sql);
    $de=$db->getRows();
    $new_arr = array();
    foreach($de as $key=>$val)
    {
        $new_arr[$val["pid"]]["name"] = $val["pname"];
        $new_arr[$val["pid"]]["city"][] = array("name"=> $val["name"]);

    }
	$tpl->assign("pv",$new_arr);
		
	$out=tplfetch("district.htm",$flag,true);
?>