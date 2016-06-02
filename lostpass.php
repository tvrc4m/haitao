<?php
include_once("includes/global.php");
include_once("includes/smarty_config.php");
include("config/nav_menu.php");
//=========================================

$page="lostpass.htm";
if(!empty($_GET['msg']))
{
	$page="reset_pass.htm";
}

if(!empty($_GET['md5'])&&!empty($_GET['userid']))
{
	//调出重设密码的模板
	$sql="select * from ".MEMBER." where userid='$_GET[userid]' and password='$_GET[md5]'";
	$db->query($sql);
	$uid=$db->fetchField('userid');
	if($uid)
		$page='reset_pass.htm';
}

//验证手机号
if(!empty($_POST['mobile'])&&$_POST['check_mobile']=='check'){
	if(Check_data($_POST['mobile'], 'mobile')){
        if(Check_only($_POST['mobile'], 'mobile', MEMBER)){
            $_SESSION['lost_yzm']['ph'] = 1;
            die(Return_data(array('status_code' => '200', 'message' => '该手机号已存在！', 'data' => null )));
        }else{
            die(Return_data(array('status_code' => '300', 'message' => '手机号不存在！', 'data' => null )));
        }
    }else{
        die(Return_data(array('status_code' => '300', 'message' => '请填正确的手机号！', 'data' => null )));
    }
}else if($_POST['check_mobile']=='check'){
	die(Return_data(array('status_code' => '300', 'message' => '请填写手机号！', 'data' => null )));
}

//发送验证码
if(!empty($_POST['m_send'])&&$_POST['m_send']=='m_send'&&$_SESSION['lost_yzm']['ph']==1){
    if(Check_data($_POST['mobile'], 'mobile')){
        if(empty($_SESSION['lost_yzm'])||$_SESSION['lost_yzm']['ltime']<time()) {
            if($_SESSION['lost_yzm']['lasttime']<=time()){
                $_SESSION['lost_yzm']['lnum'] = 1;
            }
            if(empty($_SESSION['lost_yzm']['lnum'])||$_SESSION['lost_yzm']['lnum']<=3) {
                $number = rand(100000,999999);
                if (Send_msg($_POST['mobile'], sprintf('您本次注册蚂蚁海淘的验证码是%s有效期为%s分钟', $number, 10)) == 1) {

                    if(date('i',time()-$_SESSION['lost_yzm']['ltime'])<5){
                        $vser['lnum'] =  $_SESSION['lost_yzm']['lnum']+1;
                    }
                    $vser['yzm'] = $number;
                    $vser['ytime'] = time() + 60 * 10;
                    $vser['ltime'] = time() + 60;
                    $vser['lasttime'] = time() + 60 * 60;
                    $_SESSION['lost_yzm'] = $vser;
                    die(Return_data(array('status_code' => '200', 'message' => '短信发送成功，请注意查收', 'data' => null )));
                }
            }else{
                die(Return_data(array('status_code' => '300', 'message' => sprintf('操作过于频繁，%s后再试！',date('i分s秒', $_SESSION['lost_yzm']['lasttime']-time())), 'data' => $_SESSION['lost_yzm']['ltime']-time() )));
            }
        }else{
            die(Return_data(array('status_code' => '300', 'message' => sprintf('请在%s秒后再次申请短信验证码',$_SESSION['lost_yzm']['ltime']-time()), 'data' => $_SESSION['lost_yzm']['ltime']-time() )));
        }
    }
}else if(!empty($_POST['m_send'])&&$_POST['m_send']=='m_send'&&$_SESSION['lost_yzm']['ph']!=1){
    die(Return_data(array('status_code' => '300', 'message' => '请先确认手机后在发短信', 'data' => null )));
}

//检测验证码
if(!empty($_POST['smsvode'])&&$_POST['check_sms']=='check'){
    Check_sms($_POST['smsvode']);
}

//找回密码页
if(!empty($_POST["action"])&&$_POST["action"]=="submit")
{//根据用户名和密码确定是哪一个公司在找回密码

	//定义所有正则
    $str_check = array( 'mobile', 'smsvode', 'password');
    foreach($str_check as $key => $val){
        if(empty($_POST[$val])||!Check_data($_POST[$val], $val)){
            die('<script>alert("请填写正确格式的数据");history.go(-1);</script>;');
        }
    }

	//手机验证码
	if(!empty($_POST['smsvode'])&&$_POST['smsvode']==$_SESSION['lost_yzm']['yzm']){
		if($_SESSION['lost_yzm']['ytime']<time()){
			die('<script>alert("验证码已失效!");history.go(-1);</script>;');
		}else{
            session_unset($_SESSION['lost_yzm']);
        }
	}else{
		die('<script>alert("请填写正确的验证码!");history.go(-1);</script>;');
	}

	$sql="select * from ".MEMBER." where mobile='$_POST[mobile]'";
	$db->query($sql);
	$re=$db->fetchRow();

	if(!$re)
	{
		msg("lostpass.php","会员不存在！");
	}
	else
	{
		$userid = $re['userid'];
		$re = $db->query("update ".MEMBER." set password='".md5(addslashes($_POST['password']))."' where userid='$userid'");

		if($re){
			msg('login.php','密码修改成功！');
		}else{
			msg('lostpass.php','系统繁忙，请稍后修改！');
		}
	}
	$page="lostpass_steptwo.htm";
}

/* =================================================自定义方法======================================================== */

/**
 * 检测验证码
 */
function Check_sms($data = null){

    if(!empty($data)&&$data==$_SESSION['mon_yzm']['yzm']){
        if($_SESSION['mon_yzm']['ytime']<time()){
            die(Return_data(array('status_code' => '300', 'message' => "验证码已失效!", 'data' => null )));
        }else{
            die(Return_data(array('status_code' => '200', 'message' => "验证码正确!", 'data' => null )));
        }
    }else{
        die(Return_data(array('status_code' => '300', 'message' => "请填写正确的验证码!", 'data' => null )));
    }
}

/**
 * 验证唯一
 */
function Check_only($data = null, $key = null, $table = null){
	global $db;
	$sql="select * from ".$table." where $key = '$data'";
	$db->query($sql);
	return $db->num_rows();
}

/**
 * 数据格式验证
 */
function Check_data($data = null, $keyval = null){
	$res = null;
	switch($keyval){
		case 'user' : $res = preg_match('/^[A-Za-z0-9\x{4e00}-\x{9fa5}]{4,16}$/u', $data);  break;
		case 'mobile' : $res = preg_match('/^1(3[0-9]|4[57]|5[0-35-9]|8[0-9]|7[07])\d{8}$/', $data);  break;
		case 'smsvode' : $res = preg_match('/^[0-9]{6}$/', $data);  break;
		case 'password' : $res = preg_match('/^[\s\S]{6,10}$/', $data);  break;
		//case 'password' : $res = preg_match('/^[A-Za-z0-9]{6,10}$/', $data);  break;
	}
	return $res;
}

//短信发送
function Send_msg($mob = null, $con = null)
{
    global $config;
	include_once("{$config[webroot]}/module/sms/includes/plugin_sms_class.php");
	$sms = new sms();
	$str = $sms->send($mob, $con);
	$res = json_decode(iconv("gb2312", "utf-8//IGNORE", urldecode($str)),true);
	if($res['error']==0&&$res['msg']=='ok'){
		return 1;
	}else{
		return 2;
	}
	die;
}

//格式数据返回
function Return_data($data = null, $type = 'json'){
	if($type == 'json'){
		return json_encode($data);
	}
}

//===========页面底部===============

include_once("footer.php");
if($config['language']=='en')
{
	$tpl->assign("output",$tpl -> fetch($page));
	$tpl->display("register_inc.htm");
}
else
	$tpl->display($page);
?>