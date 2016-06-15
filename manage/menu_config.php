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

$dir=$config['webroot'].'/module/';
$handle = opendir($dir); 
while ($filename = readdir($handle))
{ 
	if($filename!="."&&$filename!="..")
	{
	  if(file_exists($dir.$filename.'/manage/config.php'))
	  {
		include("$dir/$filename/manage/config.php");
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