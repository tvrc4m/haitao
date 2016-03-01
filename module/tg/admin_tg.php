<?php
if(!empty($_POST['freight_id']) && is_numeric($_POST['freight_id']))
{
	$langs=array('express'=>'快递','ems'=>'EMS','mail'=>'平邮');
	
	$sql="select * from ".LGSTEMP." where id='$_POST[freight_id]'";
	$db->query($sql);
	$de=$db->fetchRow($sql);
	$sql="select * from ".LGSTEMPCON." where temp_id='$de[id]' and define_citys='default' order by id asc";
	$db->query($sql);
	$k=$db->getRows();
	foreach($k as $n=>$v)
	{
		$current = $n==0 ? 'class="current"':'';
		$title.="<span ".$current.">".$langs[$v['logistics_type']]."<b></b></span>";
		$hidden = $n==0 ? '':'hidden';
		$con.="<div class='con $hidden'>	
		<div class='fore1'>默认运费：<em>$v[default_num]</em>$de[price_type]内<em>$v[default_price]</em>元，每增加<em>$v[add_num]</em>$de[price_type]，加<em>$v[add_price]</em>元</div>";
		$sql="select * from ".LGSTEMPCON." where temp_id='$de[id]' and define_citys!='default' and logistics_type='".$v['logistics_type']."'";
		$db->query($sql);
		$re=$db->getRows();
		if($re)
		{
			$con.="<div class='fore2'>指定区域运费</div>";
			foreach($re as $val)
			{
				$con.="<div class='fore3'>".csubstr($val['define_citys'],0,50)."……：<em>$val[default_num]</em>$de[price_type]内<em>$val[default_price]</em>元，每增加<em>$val[add_num]</em>$de[price_type]，加<em>$val[add_price]</em>元</div>";
			}
		}
		$con.="</div>";	
	}	
	$str = '<div class="freight-content"><div class="logis-switch clearfix">'.$title.'<a target="_blank" href="main.php?m=logistics&s=admin_logistics_temp&type=add&edit='.$de['id'].'">查看详情</a></div><div class="logis-content">'.$con.'</div></div><p>发货地：'.$de['area'].'</p><script>$(".logis-switch span").hover(function(){var index=$(this).index();	$(this).addClass("current").siblings().removeClass("current");$(".logis-content .con").eq(index).show().siblings(".con").hide();
});</script>';
	echo $str;
	die;	
}
//-------------------------------------------------------------------------------
@include($config['webroot'].'/config/module_product_config.php');
$mcon='module_product_config';
@$config = array_merge($config,$$mcon);
include_once("$config[webroot]/module/product/includes/plugin_product_class.php");
//================================================================
$product = new product();
if(empty($_GET['catid'])&&empty($_GET['edit']))
{	
	$re=$admin->getCatName(PCAT);
	$tpl->assign("cat",$re);
	$tpl->assign("get_user_common_cat",$admin->get_user_common_cat($buid));
	$tpl->assign("config",$config);
	$tpl->assign("lang",$lang);
	$tpl->assign("tg","tg");
	$output=tplfetch("admin_tg_step.htm");
}
else
{
	//-------------------------------------
	if($submit=="submit")
	{	
		$re=$product->operate_product('add',"true");
		if($re)
			$admin->msg("main.php?m=tg&s=admin_tg_list");
	}
	//-------------------------------------
	if($submit=="edit")
	{
		$re=$product->operate_product('edit');
		if($re)
			$admin->msg("main.php?m=tg&s=admin_tg_list");
	}
	//------------------------------------
	
	if(!empty($_GET['edit']))
	{	
		$de=$product->product_detail($_GET['edit']);
		$sql="select title from ".LGSTEMP." where id='$de[freight]'";
		$db->query($sql);
		$de['freight_name']=$db->fetchField('title');
		$tpl->assign("de",$de);
		
		$de['catid']=$de['catid']?$de['catid']:"1000";
		$pactidlist=$de['catid'];
	
		if(!empty($de['tcatid']))
			$pactidlist.=",".$de['tcatid'];
		if(!empty($de['scatid']))
			$pactidlist.=",".$de['scatid'];	
		if(!empty($de['sscatid']))
			$pactidlist.=",".$de['sscatid'];
			
		if(!empty($_GET['catid']))
		{
			$pactidlist=!empty($_GET['catid'])?$_GET['catid']:NULL;
			if(!empty($_GET['tcatid']))
				$pactidlist.= ",".$_GET['tcatid'];
			if(!empty($_GET['scatid']))
				$pactidlist.=",".$_GET['scatid'];
			if(!empty($_GET['sscatid']))
				$pactidlist.=",".$_GET['sscatid'];
		}		
	}
	//--------------------------------
	if(empty($_GET['edit']))
	{
		$pactidlist=!empty($_GET['catid'])?$_GET['catid']:NULL;
		if(!empty($_GET['tcatid']))
			$pactidlist.= ",".$_GET['tcatid'];
		if(!empty($_GET['scatid']))
			$pactidlist.=",".$_GET['scatid'];
		if(!empty($_GET['sscatid']))
			$pactidlist.=",".$_GET['sscatid'];
	}
	
	$product->add_user_common_cat($pactidlist);
	$tpl->assign("typenames",$product->getProTypeName($pactidlist));
	$tpl->assign("brand",$product->get_brand($pactidlist,$de['brand']));

	$tpl->assign("ptype",explode('|',$config['ptype']));
	$tpl->assign("validTime",explode('|',$config['validTime']));
	$tpl->assign("custom_cat",$admin->get_custom_cat_list(1,0));
	
	$tpl->assign("prov",GetDistrict());
	
	//--------------------------自定义字段
	$nc=explode(",",$pactidlist);
	$now_catid=$nc[count($nc)-1];
	
	$sql="select ext_table from ".PCAT." where catid='$now_catid'";
	$db->query($sql);
	$re=$db->fetchRow();
	$ext_table=$re['ext_table'];

	include_once("$config[webroot]/module/product/includes/plugin_add_field_class.php");
	$addfield = new AddField('product');
	$extfiled = $addfield->addfieldinput($_GET['edit'],$ext_table);//

	$abc=$addfield->echoforeach('0',count($extfiled['d']));//
	$tpl->assign("firstvalue",$extfiled);
	$tpl->assign("abc",$abc);
	
	//-----------物流模板---------
	$sql="select * from ".LGSTEMP." where userid='$buid'";
	$db->query($sql);
	$re=$db->getRows();
	$tpl->assign("lgs",$re);
	//==================================
	$nocheck=true;
	include_once("footer.php");
	$tpl->assign("config",$config);
	$tpl->assign("lang",$lang);
	$output=tplfetch("admin_tg.htm");
}
?>