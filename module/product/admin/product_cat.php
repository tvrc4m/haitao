<?php

	if($_GET['operation']=="add" or $_GET['operation']=="edit")
	{
		if($_POST['act'])
		{	
			unset($_GET['operation']);
			unset($_GET['s']);
			unset($_GET['m']);
			$_POST['isindex']=isset($_POST['isindex'])?1:0;
			$_POST['isvirtual']=isset($_POST['isvirtual'])?1:0;
			$_POST['brand']=empty($_POST['brand'])?NULL:implode(",",$_POST['brand']);
			$_POST['ext_field_cat']*=1;
			$_POST['isbuy']=isset($_POST['isbuy'])?1:0;
			$_POST['is_setmeal']=isset($_POST['is_setmeal'])?1:0;;
			$_POST['commission']*=1;
			
			if(!empty($_POST['ext_field_cat']))
				$ext_table=$config['table_pre'].'defind_'.$_POST['ext_field_cat'];
			else
				$ext_table=0;

			//添加
			if($_POST["act"]=='save')
			{	
				if($_POST["pid"]==0)
				{
					$sql="select max(catid) as catid from ".PCAT." where catid<9999";
					$db->query($sql);
					$id=$db->fetchField("catid");
					if(!$id)
						$id=1000;
					else
						$id=substr($id*1000,0,4)+1;
				}
				else
				{
					$s=$_POST["pid"]."00";
					$b=$_POST["pid"]."99";
					$sql="select max(catid) as catid from ".PCAT." where catid>$s and catid<$b";
					$db->query($sql);
					$id=$db->fetchField("catid");
					if(!$id)
						$id=$_POST["pid"]."01";
					else
						$id=$id+1;
				}
				foreach(explode("\r\n",$_POST['cat']) as $catv)
				{
					if(!empty($catv))
					{
					//	$sql="insert into ".PCAT." (`catid`,`cat`,`nums`,`isindex`,`pic`,`wpic`,`brand`,ext_table,ext_field_cat,commission,is_setmeal,isbuy,current,templates,`isvirtual`) values  ('$id','$catv','255','$_POST[isindex]','$_POST[pic]','$_POST[wpic]','$_POST[brand]','$ext_table','$_POST[ext_field_cat]','$_POST[commission]','$_POST[is_setmeal]','$_POST[isbuy]','$_POST[current]','$_POST[templates]','$_POST[isvirtual]')";
                        $sql="insert into ".PCAT." (`catid`,`cat`,`nums`,`isindex`,`pic`,`wpic`,`brand`,ext_table,ext_field_cat,commission,is_setmeal,isbuy,current,templates,`isvirtual`)values('$id','$catv','255','$_POST[isindex]','$_POST[pic]','$_POST[wpic]','$_POST[brand]','$ext_table','$_POST[ext_field_cat]','$_POST[commission]','$_POST[is_setmeal]','$_POST[isbuy]','$_POST[current]','$_POST[templates]','$_POST[isvirtual]')";
						$db->query($sql);
						$id+=1;
					}
				}
			}
			//修改
			if($_POST["act"]=='edit' and is_numeric($_POST['id']))
			{
				
				if($_POST["pid"]!=substr($_POST['id'],0,strlen($_POST['id'])-2) and strlen($_POST['id'])>4 )
				{
					if($_POST["pid"]==0)
					{
						$sql="select max(catid) as catid from ".PCAT." where catid<9999";
						$db->query($sql);
						$id=$db->fetchField("catid");
						if(!$id)
							$id=1000;
						else
							$id=substr($id*1000,0,4)+1;
					}
					else
					{
						$s=$_POST["pid"]."00";
						$b=$_POST["pid"]."99";
						$sql="select max(catid) as catid from ".PCAT." where catid>$s and catid<$b";
						$db->query($sql);
						$id=$db->fetchField("catid");
						if(!$id)
							$id=$_POST["pid"]."01";
						else
							$id=$id+1;
					}
				}
				else
					$id=$_POST['id'];
				
				//$sql="update ".PCAT." set catid='$id',`isvirtual` = '$_POST[isvirtual]', cat='$_POST[cat]',isindex='$_POST[isindex]' ,pic='',isbuy='$_POST[isbuy]',brand='$_POST[brand]',pic='$_POST[pic]',wpic='$_POST[wpic]',ext_table='$ext_table',ext_field_cat='$_POST[ext_field_cat]',commission='$_POST[commission]',is_setmeal='$_POST[is_setmeal]',current='$_POST[current]',templates='$_POST[templates]',nums='$_POST[displayorder]' where catid='".$_POST['id']."'";
                $sql="update ".PCAT." set catid='$id',`isvirtual` = '$_POST[isvirtual]', cat='$_POST[cat]',isindex='$_POST[isindex]' ,pic='',isbuy='$_POST[isbuy]',brand='$_POST[brand]',pic='$_POST[pic]',wpic='$_POST[wpic]',ext_table='$ext_table',ext_field_cat='$_POST[ext_field_cat]',commission='$_POST[commission]',is_setmeal='$_POST[is_setmeal]',current='$_POST[current]',templates='$_POST[templates]',nums='$_POST[displayorder]' where catid='".$_POST['id']."'";
                $db->query($sql);
				
				if($_POST["pid"]!=substr($_POST['id'],0,strlen($_POST['id'])-2))
				{
					//如果当前类别下面带有子类别把子类别一起移过去
					$s=$_POST['id']."00";
					$b=$_POST['id']."99";
					$sql="update ".PCAT." set catid=replace(catid,$_POST[id],$id),`isvirtual` = '$_POST[isvirtual]' where catid like '$_POST[id]%'";
					$re=$db->query($sql);
				}
				unset($_GET['editid']);
			}
			$getstr=implode('&',convert($_GET));
			msg("?m=product&s=product_cat.php&$getstr");
		}
		if($_GET['editid'] and is_numeric($_GET['editid']))
		{
			$sql="select * from ".PCAT." where catid='$_GET[editid]'";
			$db->query($sql);
			$re=$db->fetchRow();
			$re['cid']=substr($re['catid'],0,-2);
			$re['brands']=explode(',',$re['brand']);
			$tpl->assign("re",$re);
		}
		
		$sql="select * from ".BRANDCAT." where parent_id=0 order by displayorder ";
		$db->query($sql);
		$brand=$db->getRows();
		foreach($brand as $k=>$v)
		{
			$sql="select * from ".BRAND." where catid=$v[id] and status!=0  order by displayorder ";
			$db->query($sql);
			$brand[$k]['brand']=$db->getRows();
		}
		
		$tpl->assign("brand",$brand);
		$tpl->assign("config",$config);
		
		$sql="select * from ".TYPE;
		$db->query($sql);
		$property=$db->getRows();
		$tpl->assign("property",$property);
		
		
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
		$sql = 'SELECT catid,cat,pic,wpic,brand FROM mallbuilder_product_cat ORDER BY catid ASC';
		$db->query($sql);
		$cacheList = $db->getRows();
		foreach($cacheList as $v){
			$cacheLists[$v['catid']]=$v;
			$cacheLists[$v['catid']]['url']=$config['weburl'].'/product-list-'.$v['catid'].'.html';
		}
		file_put_contents($config['webroot'].'/cache/configure/cat.cache', "<?php\nreturn " . var_export($cacheLists, true) . ";");

	}
	else if($_GET['operation']=="search"&&$_GET['cat'])
	{		
		$sql="select * from ".PCAT." where cat like '%$_GET[cat]%' order by nums,catid";
		$db->query($sql);
		$de=$db->getRows();
		foreach($de as $k=>$v)
		{
			$sql="select name from ".TYPE." where id='$v[ext_field_cat]'";
			$db->query($sql);
			$de[$k]['property']=$db->fetchField('name');
					
			$de[$k]["cat"]= str_replace($_GET['cat'],'<font color="#FF0000">'.$_GET['cat']."</font>",$v['cat']);
			$length = strlen($v['catid']);
			$de[$k]["level"] = $length == 6 ? "board" : ($length == 8 ? "childboard":($length == 10 ? "childsboard":""));
		}
	}
	else
	{
		if($_GET['delid'])
		{
			$sql="delete from ".PCAT."  where catid like '$_GET[delid]%' ";
			$db->query($sql);
			msg("?m=product&s=product_cat.php");
		}
		
		if($_GET['id'])
		{
			$id=$_GET['id']*1;
		}
		$sql="select * from ".PCAT." where 1 and catid<9999 order by nums,catid";
		$db->query($sql);
		$de=$db->getRows();
		foreach($de as $k=>$v)
		{
			$sql="select name from ".TYPE." where id='$v[ext_field_cat]'";
			$db->query($sql);
			$de[$k]['property']=$db->fetchField('name');
			
			$tsql=" and catid < '".$v['catid']."99' and catid >'".$v['catid']."00' ";
			$sql="select * from ".PCAT." where 1 $tsql order by nums,catid";
			$db->query($sql);
			$a=$db->getRows();
			foreach($a as $ks=>$vs)
			{
				$sql="select name from ".TYPE." where id='$vs[ext_field_cat]'";
				$db->query($sql);
				$a[$ks]['property']=$db->fetchField('name');
				
				
				$tsql=" and catid < '".$vs['catid']."99' and catid >'".$vs['catid']."00' ";
				$sql="select * from ".PCAT." where 1 $tsql order by nums,catid";
				$db->query($sql);
				$b=$db->getRows();
				foreach($b as $kss=>$vss)
				{
					$sql="select name from ".TYPE." where id='$vss[ext_field_cat]'";
					$db->query($sql);
					$b[$kss]['property']=$db->fetchField('name');

					$tsql=" and catid < '".$vss['catid']."99' and catid >'".$vss['catid']."00' ";
					$sql="select * from ".PCAT." where 1 $tsql order by nums,catid";
					$db->query($sql);
					$c=$db->getRows();
					
					foreach($c as $ksss=>$vsss)
					{
						$sql="select name from ".TYPE." where id='$vsss[ext_field_cat]'";
						$db->query($sql);
						$c[$ksss]['property']=$db->fetchField('name');
					}
					$b[$kss]['scat']=$c;
				}
				$a[$ks]['scat']=$b;
			}
			$de[$k]['scat']=$a;
		}
	}
	$tpl->assign("de",$de);
	$tpl->display("product_cat.htm");
?>