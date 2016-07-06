<?php
var_dump($_GET);
include_once("footer.php");
if($config['temp']=='wap'||$config['temp']=='wap_app')
{
	$out=tplfetch("confirm_payment.htm",$flag);
}
else
{
	if($_GET['ajax']=='ajax')
	{
		$url = $_SERVER['HTTP_REFERER']?base64_encode($_SERVER['HTTP_REFERER']):1;
		$tpl -> assign("url",$url);
		echo $out=tplfetch("order_ajax.htm",$flag,true);die;
	}
	else
		$out=tplfetch("confirm_payment.htm",$flag,true);
}
?>