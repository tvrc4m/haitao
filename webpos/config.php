<?php
include_once("../includes/global.php");
$script_tmp = explode('/', $_SERVER['SCRIPT_NAME']);
$sctiptName = array_pop($script_tmp);
include_once("auth.php");
include_once($config["webroot"]."/lib/smarty/Smarty.class.php");


$tpl =  new Smarty();
$tpl -> left_delimiter  = "<{";
$tpl -> right_delimiter = "}>";
$tpl -> template_dir    = $config["webroot"] . "/webpos/templates/".$config['temp'].'/';
$tpl -> compile_dir     = $config["webroot"] . "/templates_c/webpos/";
$tpl->assign("delimg",$delimg);
$tpl->assign("editimg",$editimg);

?>