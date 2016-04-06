<?php
include_once("includes/global.php");
include_once("includes/smarty_config.php");
include_once("config/reg_config.php");

if($reg_config)
{
	$config = array_merge($config,$reg_config);
}

include_once("config/connect_config.php");//connect
if ($connect_config['ucenter_connect'])
{
	if ('ucenter' != $_GET['type'])
	{
		$login_url   = $connect_config['ucenter_url'] . '?ctl=Login&met=regist&typ=e';

		$callback = $config['weburl'] . '/login.php?redirect=' . urlencode($config['weburl']) . '&type=ucenter';

		$login_url = $login_url . '&from=mall&callback=' . urlencode($callback);
		header('location:' . $login_url);
	}
}


if(!empty($_POST['mobile'])&&$_POST['check_mobile']=='check'){
    if(preg_match('/^13[0-9]{1}[0-9]{8}$|14[57]{1}[0-9]{8}$|15[0-9]{1}[0-9]{8}$|18[0-9]{1}[0-9]{8}$/', $_POST['mobile'])){
        $db=new dba($config['dbhost'],$config['dbuser'],$config['dbpass'],$config['dbname'],$config['dbport']);
        //验证用户名唯一
        $sql="select * from ".MEMBER." where mobile = '".$_POST['mobile']."'";
        $db->query($sql);
        if($db->num_rows()){
            echo Return_data(array(
                'status_code' => '300',
                'message' => '该手机号已存在！',
                'data' => null
            ));die;
        }else{
			$_SESSION['mon_yzm']['ph'] = 1;
            echo Return_data(array(
                'status_code' => '200',
                'message' => '手机号可用！',
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

//发送验证码

if(!empty($_POST['m_send'])&&$_POST['m_send']=='m_send'&&$_SESSION['mon_yzm']['ph']==1){
	if(!empty($_POST['mobile'])&&preg_match('/^13[0-9]{1}[0-9]{8}$|14[57]{1}[0-9]{8}$|15[0-9]{1}[0-9]{8}$|18[0-9]{1}[0-9]{8}$/', $_POST['mobile'])){
		$number = rand(100000,999999);
		if(empty($_SESSION['mon_yzm'])||$_SESSION['mon_yzm']['ltime']<time()) {
                    if($_SESSION['mon_yzm']['lasttime']<=time()){
                        $_SESSION['mon_yzm']['lnum'] = 1;
                    }
			if(empty($_SESSION['mon_yzm']['lnum'])||$_SESSION['mon_yzm']['lnum']<=3) {
				if (Send_msg($_POST['mobile'], sprintf('您本次注册蚂蚁海淘的验证码是%s有效期为%s分钟', $number, 10)) == 1) {
					$vser['yzm'] = $number;
                    if(date('i',time()-$_SESSION['mon_yzm']['ltime'])<5){
                        $vser['lnum'] =  $_SESSION['mon_yzm']['lnum']+1;
                    }
					$vser['ytime'] = time() + 60 * 10;
					$vser['ltime'] = time() + 60;
					$vser['lasttime'] = time() + 60 * 60;
					$_SESSION['mon_yzm'] = $vser;
					echo Return_data(array(
						'status_code' => '200',
						'message' => '短信发送成功，请注意查收',
						'data' => null
					));
				}
			}else{
				echo Return_data(array(
					'status_code' => '300',
					'message' => sprintf('由于您获取验证码过于频繁，请在%s后再次申请短信验证码，谢谢配合！',date('i分s秒', $_SESSION['mon_yzm']['lasttime']-time())),
					'data' => $_SESSION['mon_yzm']['ltime']-time()
				));
                die;
			}

		}else{
			echo Return_data(array(
				'status_code' => '300',
				'message' => sprintf('请在%s秒后再次申请短信验证码',$_SESSION['mon_yzm']['ltime']-time()),
				'data' => $_SESSION['mon_yzm']['ltime']-time()
			));
		}
		die;
	}
}else if(!empty($_POST['m_send'])&&$_POST['m_send']=='m_send'&&$_SESSION['mon_yzm']['ph']!=1){
    echo $_SESSION['mon_yzm']['lnum'];die;
}

//检测验证码
if(!empty($_POST['smsvode'])&&$_POST['check_sms']=='check'){
    if(!empty($_POST['smsvode'])&&$_POST['smsvode']==$_SESSION['mon_yzm']['yzm']){
        if($_SESSION['mon_yzm']['ytime']<time()){
            echo Return_data(array(
                'status_code' => '300',
                'message' => "验证码已失效!",
                'data' => null
            ));
        }else{
            session_unset($_SESSION['mon_yzm']);
            echo Return_data(array(
                'status_code' => '200',
                'message' => "验证码正确!",
                'data' => null
            ));
        }
    }else{
        echo Return_data(array(
            'status_code' => '200',
            'message' => "请填写正确的验证码!",
            'data' => null
        ));
    }
    die;
}

if($buid)
{	//已经登录
	msg('main.php');
}
if(is_array($stop_reg))
{
	stop_ip($stop_reg);
	unset($stop_reg);
}
//----------------------------------------------------
//if(!empty($_POST['user'])&&strtolower($_POST['yzm'])==strtolower($_SESSION['auth']))
if(!empty($_POST['user']))
{

	if($config['closetype']==2)
	{	//关闭注册
		die('access dined!');
	}
	//暂不使用本地验证码
	/*if($config['user_reg_verf'])
	{	//验证码不对
		if(trim($_POST['ckyzwt'])!=trim($_SESSION['YZWT']))
			 die("Verification question error...");
	}*/

	//蚂蚁海淘注册协议
	if(!isset($_POST['agreement'])&&$_POST['agreement']!='yes'){
		die('<script>alert("请阅读并勾选蚂蚁海淘注册协议!");history.go(-1);</script>;');
	}

	//手机验证码
	if(!empty($_POST['smsvode'])&&$_POST['smsvode']==$_SESSION['mon_yzm']['yzm']){
		if($_SESSION['mon_yzm']['ytime']<time()){
			die('<script>alert("验证码已失效!");history.go(-1);</script>;');
		}else{
            session_unset($_SESSION['mon_yzm']);
        }
	}else{
		die('<script>alert("请填写正确的验证码!");history.go(-1);</script>;');
	}

	$ip = getip();
	if($config['regctrl']>0)
	{
		$sql = "select * from ".MEMBER." where ip='$ip' and DATE_ADD( NOW() ,INTERVAL -".$config['regctrl']." HOUR ) - regtime < 0";
		$db -> query($sql);
		$num = $db -> num_rows();
		if($num > 0)
		{
			die('<script>alert("您的IP已注册！");history.go(-1);</script>;');
		}
	}

	if($config['regfloodctrl'] > 0)
	{
		$sql = "select * from ".MEMBER." where ip='$ip' and to_days(regtime) = to_days(now()) ";
		$db -> query($sql);
		$num = $db -> num_rows();
		if($num >= $config['regfloodctrl'])
		{
			die('<script>alert("您的IP已注册！");history.go(-1);</script>;');
		}	
	}
	
	if($config['ipregctrltime']>0&&$config['ipregctrl'])
	{
		$ipregctrl = explode("\r\n",$config['ipregctrl']);
		$ipregctrl = implode("','",$ipregctrl);
		$sql = "select * from ".MEMBER." where ip in ('$ipregctrl') and DATE_ADD( NOW() ,INTERVAL -".$config['ipregctrltime']." HOUR ) - regtime < 0";
		$db -> query($sql);
		$num = $db -> num_rows();
		if($num > 0)
		{
			die('<script>alert("您的IP已注册！");history.go(-1);</script>;');
		}
	}
	$user = trim($_POST['user']);
	$pass = trim($_POST['password']);
	$time = time();

	//暂时不用确认密码
	/*if (isset($_POST['re_password']))
	{
		$re_pass = trim($_POST['re_password']);

		if ($pass != $re_pass)
		{
			die('<script>alert("两次输入密码不一致!");history.go(-1);</script>;');
		}
	}*/

	if(valid_mobile($user))
	{
		$_POST["mobile"] = $mobile = $user;
		$_POST["user"] = $user = "M".$mobile;
		if(!is_repeat($user))
		{
			$_POST["user"] = $user = $user.substr(md5($time),-5);
		}
	}

	//定义所有正则
	$str_check = [
		'user' => '/^[A-Za-z0-9\x{4e00}-\x{9fa5}]{4,16}$/u',
		'mobile' => '/^13[0-9]{1}[0-9]{8}$|14[57]{1}[0-9]{8}$|15[0-9]{1}[0-9]{8}$|18[0-9]{1}[0-9]{8}$/',
		'smsvode' => '/^[0-9]{6}$/',
		'password' => '/^[A-Za-z0-9]{6,10}$/',
	];
	foreach($str_check as $key => $val){
		if(empty($_POST[$key])||!preg_match($val, $_POST[$key])){
			die('<script>alert("请填写正确格式的数据");history.go(-1);</script>;');
		}
	}

	//暂时不用邮箱
	/*if(valid_email($user))
	{
		$_POST["email"] = $email = $user;
		$user = explode("@",$email);
		$_POST["user"] = $user = $user[0];
		if(!is_repeat($user))
		{
			$_POST["user"] = $user = $user.substr(md5($time),-5);
		}
	}*/
	if($config['openbbs']==2)
	{	//关联UCHENTER
		include_once('uc_client/client.php');
		$uid = uc_user_register($user, $pass, $email);
		if($uid>0)
		{
			doreg($uid);
		}
	}
	else
		doreg();
}
else
{
	if (!empty($_POST['user']))
	{
		die('<script>alert("请填写正确的注册数据!");history.go(-1);</script>;');
	}
}

//用户名唯一
function is_repeat($str)
{
	global $db;
	$sql = "select * from ".MEMBER." where user = '$str'";
	$db -> query($sql);
	$num = $db->num_rows();
	return $num > 0 ? false : true;
}

//手机号码正则表达试
function valid_mobile($str)
{                 
 	return ( ! preg_match("/^13[0-9]{1}[0-9]{8}$|14[57]{1}[0-9]{8}$|15[0-9]{1}[0-9]{8}$|18[0-9]{1}[0-9]{8}$/",$str))?FALSE:TRUE;
}

//邮箱正则表达式	暂不使用
/*function valid_email($str)
{
	return ( ! preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", $str)) ? FALSE : TRUE;
}*/

function doreg($guid=NULL)
{
	global $db,$config,$ip;
//	$user = addslashes($_POST['user']);
    $user = 'mayi'.$_POST['password'];
	$pass = $_POST['password'];
//	$email = $_POST['email'];
	$mobile = $_POST['mobile'];
//	$email_verify = $email&&$config['user_reg']==2 ? "1":"0";
	$mobile_verify = $mobile&&$config['user_reg']==3 ? "1":"0";
	
	$ip = getip();
	$ip = empty($ip)?NULL:$ip;
	$lastLoginTime = time();
	$regtime = date("Y-m-d H:i:s");
	$user_reg = "2";
	
	$db=new dba($config['dbhost'],$config['dbuser'],$config['dbpass'],$config['dbname'],$config['dbport']);

	/*//验证用户名唯一
	$sql="select * from ".MEMBER." where user = '$user'";
    $db->query($sql);
    if($db->num_rows())
		die('<script>alert("该用户名已经存在！");history.go(-1);</script>;');*/

	//验证手机号唯一
	$sql="select * from ".MEMBER." where mobile = '$mobile'";
    $db->query($sql);
    if($db->num_rows())
		die('<script>alert("该手机号已经存在！");history.go(-1);</script>;');

	$sql="insert into ".MEMBER." (user,password,ip,lastLoginTime,email,mobile,regtime,statu,email_verify,mobile_verify) values ('$user','".md5($pass)."','$ip','$lastLoginTime','$email','$mobile','$regtime','$user_reg','$email_verify','$mobile_verify')";
	$re=$db->query($sql);
	$userid=$db->lastid();
	
	if($userid)
	{	
		$sql="INSERT INTO ".MEMBERINFO." (member_id) VALUES ('$userid')";
		$re=$db->query($sql);
		
		if($re)
		{
			$post['userid'] = $userid;
			$post['email'] = $user;
			$pay_id = member_get_url($post,true);	
			if($pay_id)
			{
				$sql="update ".MEMBER." set pay_id='$pay_id' where userid='$userid'";
				$re=$db->query($sql);	
			}
			//-------------绑定一键连接
			if(!empty($_REQUEST['connect_id']))
			{
				$sql="update ".USERCOON." set userid='$userid' where id='$_REQUEST[connect_id]'";
				$db->query($sql);
			}
			//---------------设置加密的cookie
			bsetcookie("USERID","$userid\t$user",NULL,"/",$config['baseurl']);
			setcookie("USER",$user,NULL,"/",$config['baseurl']);

			//
			$PluginManager = Yf_Plugin_Manager::getInstance();
			$PluginManager->trigger('reg_done', $userid, $user);

			if($config['temp'] == 'wap')
				header("Location: main.php?cg_u_type=1");
			else
				header("Location: main.php?m=member&s=admin_member&cg_u_type=1&from_register=1");
		}
	 }
	 else
		 die('<script>alert("系统繁忙，请稍后注册!");history.go(-1);</script>;');
}

//短信发送
function Send_msg($mob = null, $con = null)
{
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
		return json_encode($data, JSON_UNESCAPED_UNICODE);
	}
}
include_once("footer.php");
$tpl->display("register.htm");
?>