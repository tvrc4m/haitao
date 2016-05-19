<?php
if($_POST['act']=='act')
{
	if($_POST['pass']||$_POST['pass1'])
	{
		$re = $pay -> edit($buid);
		if(isset($_GET['forword']) && !empty($_GET['forword']))
			msg($_GET['forword'],'修改成功');
		else
			msg("index.php",'修改成功');
	}
}
$tpl->assign("config",$config);
$output=tplfetch("setpass.htm");
?>