<?php
$distribution_flag = true;

$mem = array(
	"shop"=>array
	(
		'店铺',
		array
		(
			
		)
	)
	,
	"business"=>array
	(
		'交易',
		array
		(
			
		)
	)
	,
	"relation"=>array(
		'添加分店',
		array(

		)
	)

);
$distribution_open_flag = $distribution_config['distribution_open_flag'];
if (!$distribution_open_flag)
{
	//unset($mem['distribution']);
}

$sql="select name,url from ".ADMINMENU." where uid='$_SESSION[ADMIN_USER_ID]' order by displayorder,id ";
$db->query($sql);
$de=$db->getRows();
foreach($de as $key=>$val)
{
	$mem['index'][1][0][1][$key+2]="$val[url],1,,$val[name]";	
}
$dir=$config['webroot'].'/module/';
$handle = opendir($dir); 
while ($filename = readdir($handle))
{ 
	if($filename!="."&&$filename!="..")
	{
	  if(file_exists($dir.$filename.'/shop/config.php'))
	  {
		include("$dir/$filename/shop/config.php");
	  }
   }
}
foreach($mem as $key=>$v)
{
	if(isset($mem[$key][1]))
		ksort($mem[$key][1]);
}

if (!$distribution_flag)
{
	unset($mem['distribution']);
}
?>