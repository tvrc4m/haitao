<?php
include_once ("includes/global.php");
include_once ("includes/uc_server.php");
$obj = new Uc_server($_SESSION['ucenter_data']);

$aa = $obj->register(array('phone'=>'18717903083','password'=>md5('5d0e2f3ad0c9198b2955740371d26d24abcabc'),'salt'=>'abcabc'));
      var_dump($aa);die;
?>