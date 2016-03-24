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

if(!empty($_POST['resetpass'])&&!empty($_POST['newpass'])&&!empty($_GET['md5']))
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
}
if(!empty($_GET['md5'])&&!empty($_GET['userid']))
{
	echo 2;
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
		if(empty($_SESSION['mon_yzm'])||$_SESSION['mon_yzm']['ltime']<time()) {
			if ($a=Send_msg($mob, sprintf('您本次注册蚂蚁海淘的验证码是%s有效期为%s分钟', $num, 10)) == 1) {
				$vser['yzm'] = $num;
				$vser['ytime'] = time()+60*10;
				$vser['ltime'] = time()+60;
				$_SESSION['mon_yzm'] = $vser;
			}
			echo Return_data([
					'status_code' => '200',
					'message' => '短信发送成功，请注意查收',
					'data' => null
			]);
		}else{
			echo Return_data([
					'status_code' => '300',
					'message' => sprintf('请在%s秒后再次申请短信验证码',$_SESSION['mon_yzm']['ltime']-time()),
					'data' => $_SESSION['mon_yzm']['ltime']-time()
			]);
		}
		die;
	}
}

//找回密码页
if(!empty($_POST["action"])&&$_POST["action"]=="com"&&!empty($_POST['user']))
{//根据用户名和密码确定是哪一个公司在找回密码
	echo 3;
	$sql="select * from ".MEMBER." where user='$_POST[user]' and email='$_POST[email]'";
	$db->query($sql);
	$re=$db->fetchRow();
	if(!$re)
	{
		msg("lostpass.php","会员不存在！");
	}
	else
	{
		$md5=md5(time().rand(0,100));
		$md5='lock'.substr($md5,5,strlen($md5));
		$db->query("update ".MEMBER." SET password='$md5' where userid='$re[userid]'");
		
		$mail_temp=get_mail_template('find_pwd');

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
		$tpl->assign("email",$re["email"]);
	}
	$tpl->assign('p_email',$re["email"]);
	$page="lostpass_steptwo.htm";
}

//短信发送
function Send_msg($mob = null, $con = null)
{
	include_once("$config[webroot]/module/sms/includes/plugin_sms_class.php");
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