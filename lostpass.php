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

/*if(!empty($_POST['resetpass'])&&!empty($_POST['newpass'])&&!empty($_GET['md5']))
{
	echo 1;
	//重设密码
	if($_POST['newpass']!=$_POST['newpass1'])
		msg("lostpass.php?msg=1&userid=$_GET[userid]&md5=$_GET[md5]");
	else
	{
		$db->query("update ".MEMBER." set password='".md5($_POST['newpass'])."'
		           where userid='$_GET[userid]' and password='$_GET[md5]'");
		msg("lostpass.php?msg=2");
	}
}*/
if(!empty($_GET['md5'])&&!empty($_GET['userid']))
{
	//调出重设密码的模板
	$sql="select * from ".MEMBER." where userid='$_GET[userid]' and password='$_GET[md5]'";
	$db->query($sql);
	$uid=$db->fetchField('userid');
	if($uid)
		$page='reset_pass.htm';
}

//发送验证码
if(!empty($_POST['m_send'])&&$_POST['m_send']=='m_send'){
	if(!empty($mob=$_POST['mobile'])&&preg_match('/^13[0-9]{1}[0-9]{8}$|14[57]{1}[0-9]{8}$|15[0-9]{1}[0-9]{8}$|18[0-9]{1}[0-9]{8}$/', $_POST['mobile'])){
		$number = range(1,6);
		shuffle($number);
		foreach($number as $value){
			$num .= $value;
		}
		if(empty($_SESSION['lost_yzm'])||$_SESSION['lost_yzm']['ltime']<time()) {
			if ($a=Send_msg($mob, sprintf('您本次注册蚂蚁海淘的验证码是%s有效期为%s分钟', $num, 10)) == 1) {
				$vser['yzm'] = $num;
				$vser['ytime'] = time()+60*10;
				$vser['ltime'] = time()+60;
				$_SESSION['lost_yzm'] = $vser;
			}
			echo Return_data([
					'status_code' => '200',
					'message' => '短信发送成功，请注意查收',
					'data' => null
			]);
		}else{
			echo Return_data([
					'status_code' => '300',
					'message' => sprintf('请在%s秒后再次申请短信验证码',$_SESSION['lost_yzm']['ltime']-time()),
					'data' => $_SESSION['lost_yzm']['ltime']-time()
			]);
		}
		die;
	}
}

if(!empty($_POST['mobile'])&&$_POST['check_mobile']=='check'){

    //$str = '/^1(3[0-9]|4[57]|5[0-35-9]|8[0-9]|7[07])\d{8}$/';
    if(preg_match('/^13[0-9]{1}[0-9]{8}$|14[57]{1}[0-9]{8}$|15[0-9]{1}[0-9]{8}$|18[0-9]{1}[0-9]{8}$/', $_POST['mobile'])){
        //验证用户名唯一
        $sql="select * from ".MEMBER." where mobile = '".$_POST['mobile']."'";
        $db->query($sql);
        if($db->num_rows()){
            echo Return_data(array(
                'status_code' => '200',
                'message' => '该手机号已存在！',
                'data' => null
            ));die;
        }else{
            echo Return_data(array(
                'status_code' => '300',
                'message' => '手机号不存在！',
                'data' => null
            ));die;
        }
    }else{
        echo Return_data(array(
            'status_code' => '300',
            'message' => '请填正确的手机号！',
            'data' => null
        ));die;
    }
    die;
}else if($_POST['check_mobile']=='check'){
    echo Return_data(array(
        'status_code' => '300',
        'message' => '请填写手机号！',
        'data' => null
    ));
    die;
}
//var_dump($_POST); die;
//找回密码页
if(!empty($_POST["action"])&&$_POST["action"]=="com")
{//根据用户名和密码确定是哪一个公司在找回密码

	//定义所有正则
	$str_check = [
			//'user' => '/^[A-Za-z0-9\x{4e00}-\x{9fa5}]{4,16}$/u',
			'mobile' => '/^13[0-9]{1}[0-9]{8}$|14[57]{1}[0-9]{8}$|15[0-9]{1}[0-9]{8}$|18[0-9]{1}[0-9]{8}$/',
			'smsvode' => '/^[0-9]{6}$/',
			'password' => '/^[A-Za-z0-9]{6,10}$/',
	];
	foreach($str_check as $key => $val){
		if(empty($_POST[$key])||!preg_match($val, $_POST[$key])){
			die('<script>alert("请填写正确格式的数据!");history.go(-1);</script>;');
		}
	}

	//手机验证码
	if(!empty($_POST['smsvode'])&&$_POST['smsvode']===$_SESSION['lost_yzm']['yzm']){
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
		/*$md5=md5(time().rand(0,100));
		$md5='lock'.substr($md5,5,strlen($md5));
		$db->query("update ".MEMBER." SET password='$md5' where userid='$re[userid]'");*/
		//var_dump($re); die;
		$userid = $re['userid'];
		$re = $db->query("update ".MEMBER." set password='".md5($_POST['password'])."'
		           where userid='$userid'");

		if($re){
			msg('login.php','密码修改成功！');
		}else{
			msg('lostpass.php','系统繁忙，请稍后修改！');
		}
		/*$mail_temp=get_mail_template('find_pwd');

		$link=$config['weburl']."/lostpass.php?md5=$md5&userid=$re[userid]";
		$link="<a target='_blank' href='".$link."'>".$link."</a>";
		
		$con=$mail_temp['message'];
		$title=$mail_temp['title'];
		$user=$re['user'];
		$time=date("Y-m-d H:i:s");
		
		$logo='<img height="24" src="'.$config['weburl'].'/image/logo.gif"  style="border:none;margin:0;">';
	
		$ar1=array('[time]','[logo]','[member_name]','[weburl_name]','[link]','[weburl_email]','[weburl_tel]','[weburl_url]','[weburl_desc]','[weburl_desc]');
		$ar2=array($time,$logo,$user,$config['company'],$link,$config['email'],$config['owntel'],$config['weburl'],$config['description']);
		$con=str_replace($ar1,$ar2,$con);
	
		$ar3=array('[member_name]','[weburl_name]');
		$ar4=array($user,$config['company']);
		$title=str_replace($ar3,$ar4,$title);
		send_mail($re["email"],$re["user"], $title,$con);
		$tpl->assign("email",$re["email"]);*/
	}
	//$tpl->assign('p_email',$re["email"]);
	$page="lostpass_steptwo.htm";
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