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
             die('<script>alert("格式不正确");history.go(-1);</script>;');
        }
    }else{
        die('<script>alert("格式不正确");history.go(-1);</script>;');
    }
}elseif(isset($_POST['user_qq']) && $_POST['user_qq'] != null){
    if(preg_match('/^[1-9][0-9]{4,9}$/', $_POST['user_qq'])){
        $sql = "update mallbuilder_member set qq = '".$_POST['user_qq']."' where userid = ".$buid;
        if($db->query($sql)){
            msg('main.php?m=member&s=admin_member&cg_u_type');
        }else{
            die('<script>alert("格式不正确");history.go(-1);</script>;');
        }
    }else{
        die('<script>alert("格式不正确");history.go(-1);</script>;');
    }
}elseif(isset($_POST['user_id']) && $_POST['user_id'] != null){
    if(preg_match('/^[12]{1}$/', $_POST['user_id'])){
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
}elseif(isset($_POST['user_img']) && $_POST['user_img'] != null){
        $user_img = $_POST['user_img'];
        $user_img = substr($user_img, strripos($user_img,'base64')+7);
        $img = base64_decode(str_pad(strtr($user_img, '-_', '+/'), strlen($user_img) % 4, '=', STR_PAD_RIGHT));
        $path = './uploadfile/member/'.date('Ymd').'/';
        if(!file_exists($path)){
            mkdir($path);
        }
        $img_path = $path.time().'.jpg';
        $a = file_put_contents($img_path, $img);
        if($a) {
            $sql = "update mallbuilder_member set logo = '" . $img_path . "' where userid = " . $buid;
            if ($db->query($sql)) {
                msg('main.php?m=member&s=admin_member&cg_u_type');
            } else {
                die('<script>alert("格式不正确");history.go(-1);</script>;');
            }
        }else {
            die('<script>alert("请重新上传图片");history.go(-1);</script>;');
        }
}
include_once("footer.php");
	$tpl->display('install.htm');
?>