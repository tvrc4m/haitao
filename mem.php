<?php
include_once ("includes/global.php");
include_once ("includes/uc_server.php");
$obj = new Uc_server($_SESSION['ucenter_data']);
var_dump($obj);die;
$aa = $this->register(array('phone'=>'15011426119','password'=>md5(md5(123456).'abcabc'),'salt'=>'abcabc'));
      var_dump($aa);die;
?>