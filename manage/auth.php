<?php
if(empty($_SESSION["ADMIN_USER"])||empty($_SESSION["ADMIN_PASSWORD"]))
{
	echo '<SCRIPT   LANGUAGE="JavaScript">
	top.location.href="index.php";
	</SCRIPT>';
	die;
}

if(empty($sctiptName))
{
	msg("noright.php");
	exit();
}
if(!isset($_SESSION["ADMIN_USER"]))
	$_SESSION["ADMIN_USER"]=NULL;
//=================================

//===============================

if(!empty($sctiptName))
{

}
else
{
	if($_SESSION["ADMIN_TYPE"]!="1"&&$sctiptName!="main.php")
	{
		msg("noright.php");
		exit();
	}
}
//===========================================
$delimg='<img src="../image/admin/delete.png">';
$editimg='<img src="../image/admin/edit.png">';
$addimg='<img src="../image/admin/add.gif">';
$onimg='<img src="../image/default/on.gif">';
$offimg='<img src="../image/default/off.gif">';
$startimg='<img src="../image/admin/start.png">';
$stopimg='<img src="../image/admin/stop.png">';
$setimg='<img src="../image/admin/set.png">';
$mailimg='<img src="../image/admin/icon_mail.gif">';

$langs = isset($_SESSION["ADMIN_LANG"])?$_SESSION["ADMIN_LANG"]:$config['language'];
include_once($config['webroot']."/lang/".$langs."/admin.php");
?>