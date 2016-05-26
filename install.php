<?php
include_once("includes/global.php");
include_once("includes/smarty_config.php");
global $buid;
if(isset($_POST['user_ni']) && $_POST['user_ni'] != null){
	if(preg_match('/^[A-Za-z0-9\x{4e00}-\x{9fa5}]{4,16}$/u', $_POST['user_ni'])){
        $sql = "update mallbuilder_member set user = '".$_POST['user_ni']."' where userid = ".$buid;
        if($db->query($sql)){
            msg('main.php?m=member&s=admin_member&cg_u_type');
        }else{
            msg('install.php?err=1');
        }
    }else{
        msg('install.php?err=2');
    }
}elseif(isset($_POST['user_qq']) && $_POST['user_qq'] != null){
    if(preg_match('/^[1-9][0-9]{4,9}$/', $_POST['user_qq'])){
        $sql = "update mallbuilder_member set qq = '".$_POST['user_qq']."' where userid = ".$buid;
        if($db->query($sql)){
            msg('main.php?m=member&s=admin_member&cg_u_type');
        }else{
            msg('install.php?err=1');
        }
    }else{
        msg('install.php?err=2');
    }
}elseif(isset($_POST['user_id']) && $_POST['user_id'] != null){
    if(preg_match('/^[12]$/', $_POST['user_id'])){
        $sql = "update mallbuilder_member set sex = '".$_POST['user_id']."' where userid = ".$buid;
        if($db->query($sql)){
            echo json_encode(array(
                'code' => '修改成功',
                'status' => 200
            ));
        }else{
            echo json_encode(array(
                'code' => '修改失败',
                'status' => 300
            ));
        }
    }else{
        echo json_encode(array(
            'code' => '格式错误',
            'status' => 300
        ));
    }

    die;
}
include_once("footer.php");
	$tpl->display('install.htm');
?>