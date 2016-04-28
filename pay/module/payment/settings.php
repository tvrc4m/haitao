<?php
if($_POST['act']=='act')
{
	if($_POST['pay_mobile']||$_POST['logo'])
	{
		$re = $pay -> edit_info($buid);
		if(isset($_GET['forword']) && !empty($_GET['forword'])){
			msg($_GET['forword'],'修改成功');
		}else if($re){
			echo json_encode(array(
				'status' => 1
			));
			//msg("index.php?m=payment&s=settings",'修改成功');
		}else{
			echo json_encode(array(
				'status' => 0
			));
		}

	}
}
$tpl->assign("config",$config);
$output=tplfetch("settings.htm");
?>