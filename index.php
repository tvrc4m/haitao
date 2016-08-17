<?php
include_once("includes/global.php");
include_once("includes/smarty_config.php");

$dre=explode(".",$_SERVER['HTTP_HOST']);
$dir=trim(dirname($_SERVER['SCRIPT_NAME']), '\,/');//view: abc.**.com/a.php

$true_prefix=str_replace($config['baseurl'],'',$_SERVER['HTTP_HOST']);
$original_prefix=str_replace($config['http_type'],'',str_replace($config['baseurl'],'',$config['weburl']));

//view:abc.abc.com, baserurl:abc.abc.com, weburl:abc.abc.com ----- true_prefix='';original_prefix='';
//view:abc.ocm view, baseurl:abc.com, weburl:www.abc.com true_prefix='',original_prefix='www'

if(empty($true_prefix)&&!empty($original_prefix))
{
	header("Location: ".$config['weburl']);exit();
}
$sql = 'select * from '.MEMBER.' where userid=1';
$db->query($sql);
$aa = $db->fetch_row();
var_dump($aa);die;

if($true_prefix!=$original_prefix&&empty($dpid)&&empty($dcid)&&empty($dir)&&!empty($config['baseurl'])&&empty($mlang))
{

	if($config['opensuburl'])
	{
		//绑定顶级域名
		$sql="select userid from ".SHOP." where domin='".$config['http_type'].$_SERVER['HTTP_HOST']."'";
		$db->query($sql);
		$re=$db->fetchRow();
		if($re['userid'])
		{
			$_GET['uid']=$re['userid'];
			include_once("shop.php");
			exit();
		}
		//二级域名转发
		$sql="select userid from ".MEMBER." where userid='".str_replace('shop-','',$dre['0'])."'";
		$db->query($sql);
		$re=$db->fetchRow();
		if($_GET['uid']=$re["userid"])
		{
			include_once("shop.php");
			exit();
		}
		header("Location: ".$config['weburl']);
		exit();
	}
	else
	
	{
		header("Location: ".$config['weburl']);
		exit();
	}
}
else
{

	$file=$config['webroot'].'/cache/front/index.htm';
	if(file_exists($file) && (time() - filemtime($file)<$config['cacheTime']*1)&&empty($_GET['m']))
	{
		include($file);
	}
	else
	{
		unset($dre);unset($dir);
		$_GET['s']=!empty($_GET['s'])?$_GET['s']:'index';
		$_GET['m']=!empty($_GET['m'])?$_GET['m']:'product';
		$_GET['m'] = preg_replace('#[^a-z]#iuU', '',$_GET['m']);

		if(!empty($_GET['m']))
		{
			$s=$_GET['s'];
			$m=$_GET['m'];
			if(file_exists($config['webroot'].'/module/'.$m.'/'.$s.'.php'))
			{	$config['seo_title']=$config['title'];
				$config['seo_keyword']=$config['keyword'];
				$config['seo_description']=$config['description'];
			
				if(file_exists($config['webroot'].'/config/module_'.$m.'_config.php'))
				{
					@include($config['webroot'].'/config/module_'.$m.'_config.php');
					$mcon='module_'.$m.'_config';
					$$mcon = array_filter($$mcon);
					@$config = array_merge($config,$$mcon);
				}
				if($s=='index'&&$m=='product')
				{
					@include($config['webroot'].'/config/home_config.php');
					if($home_config)
					@$config = array_merge($config,$home_config);
				}

				@include('module/'.$m.'/lang/'.$config['language'].'.php');

				include('module/'.$m.'/'.$s.'.php');

			}
			elseif(file_exists($m.'.html'))
				include($m.'.html');
			else
				header("Location: 404.php");
			if(!empty($out))
			{	
				if(($_GET['s']=='index'|| empty($_GET['s'])) && $m=='product' && !file_exists($config['webroot']."/templates_c/".$config['temp']."/index.html")){
					$is_cahe_index = true;
					 ob_start();
					 
				}
				$tpl->assign("out",$out);unset($out);unset($tpl->statu);
				$tpl->template_dir = $config['webroot']."/templates/".$config['temp']."/";
				$tpl->caching = false; //设置缓存方式
				$tpl->display("m.htm");
				if($is_cahe_index)
				{
					$contents = ob_get_contents();
					file_put_contents($config['webroot']."/templates_c/".$config['temp']."/index.html",$contents);
					ob_flush();
				}
			}
		}
		else
			header("Location: 404.php");
	}
}
?>
