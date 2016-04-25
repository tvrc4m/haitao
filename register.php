<?php
include_once("includes/global.php");
include_once("includes/smarty_config.php");
include_once("config/reg_config.php");

if($reg_config)
{
	$config = array_merge($config,$reg_config);
}

if(isset($_GET['connect_id'])&&!empty($_GET['connect_id'])){
	$tpl->display("user_bind.htm");
	die;
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

//验证手机号
if(!empty($_POST['mobile'])&&$_POST['check_mobile']=='check'){
    if(Check_data($_POST['mobile'], 'mobile')){
        if(Check_only($_POST['mobile'], 'mobile', MEMBER)){
            die(Return_data(array('status_code' => '300', 'message' => '该手机号已存在！', 'data' => null )));
        }else{
            $_SESSION['mon_yzm']['ph'] = 1;
            die(Return_data(array('status_code' => '200', 'message' => '手机号可用！', 'data' => null )));
        }
    }else{
        die(Return_data(array('status_code' => '300', 'message' => '请填正确的手机号！', 'data' => null )));
    }
}

//发送验证码
if(!empty($_POST['m_send'])&&$_POST['m_send']=='m_send'&&$_SESSION['mon_yzm']['ph']==1){
    if(Check_data($_POST['mobile'], 'mobile')){
        if(empty($_SESSION['mon_yzm'])||$_SESSION['mon_yzm']['ltime']<time()) {
            if($_SESSION['mon_yzm']['lasttime']<=time()){
                $_SESSION['mon_yzm']['lnum'] = 1;
            }
            if(empty($_SESSION['mon_yzm']['lnum'])||$_SESSION['mon_yzm']['lnum']<=3) {
                $number = rand(100000,999999);
                if (Send_msg($_POST['mobile'], sprintf('您本次注册蚂蚁海淘的验证码是%s有效期为%s分钟', $number, 10)) == 1) {

                    if(date('i',time()-$_SESSION['mon_yzm']['ltime'])<5){
                        $vser['lnum'] =  $_SESSION['mon_yzm']['lnum']+1;
                    }
                    $vser['yzm'] = $number;
                    $vser['ytime'] = time() + 60 * 10;
                    $vser['ltime'] = time() + 60;
                    $vser['lasttime'] = time() + 60 * 60;
                    $_SESSION['mon_yzm'] = $vser;
                    die(Return_data(array('status_code' => '200', 'message' => '短信发送成功，请注意查收', 'data' => null )));
                }
            }else{
               die(Return_data(array('status_code' => '300', 'message' => sprintf('操作过于频繁，%s后再试！',date('i分s秒', $_SESSION['mon_yzm']['lasttime']-time())), 'data' => $_SESSION['mon_yzm']['ltime']-time() )));
            }
        }else{
            die(Return_data(array('status_code' => '300', 'message' => sprintf('请在%s秒后再次申请短信验证码',$_SESSION['mon_yzm']['ltime']-time()), 'data' => $_SESSION['mon_yzm']['ltime']-time() )));
        }
    }
}else if(!empty($_POST['m_send'])&&$_POST['m_send']=='m_send'&&$_SESSION['mon_yzm']['ph']!=1){
    die(Return_data(array('status_code' => '300', 'message' => '请先确认手机后在发短信', 'data' => null )));
}

//检测验证码
if(!empty($_POST['smsvode'])&&$_POST['check_sms']=='check'){
    Check_sms($_POST['smsvode']);
}

//已经登录
if($buid)
{
	msg('main.php');
}

if(is_array($stop_reg))
{
	stop_ip($stop_reg);
	unset($stop_reg);
}

if(!empty($_POST['mobile']))
{
	if($config['closetype']==2)
	{	//关闭注册
		die('access dined!');
	}

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

	$pass = trim($_POST['password']);
	$time = time();

	//定义所有正则
	$str_check = array( 'mobile', 'smsvode', 'password');
	foreach($str_check as $key => $val){
        if(empty($_POST[$val])||!Check_data($_POST[$val], $val)){
			die('<script>alert("请填写正确格式的数据");history.go(-1);</script>;');
		}
	}

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

//数据入库
function doreg($guid=NULL)
{
	global $db,$config,$ip;
    $user = 'mayi'.$_POST['mobile'];
	$pass = $_POST['password'];
	$mobile = $_POST['mobile'];
	$mobile_verify = $mobile&&$config['user_reg']==3 ? "1":"0";
	
	$ip = getip();
	$ip = empty($ip)?NULL:$ip;
	$lastLoginTime = time();
	$regtime = date("Y-m-d H:i:s");
	$user_reg = "2";
	
	$db=new dba($config['dbhost'],$config['dbuser'],$config['dbpass'],$config['dbname'],$config['dbport']);

	//验证手机号唯一
    if(Check_only($mobile, 'mobile', MEMBER)>0){
        die('<script>alert("该手机号已经存在！");history.go(-1);</script>;');
    }

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
        case 'password' : $res = preg_match('/^[A-Za-z0-9]{6,10}$/', $data);  break;
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
include_once("footer.php");
$tpl->display("register.htm");
?>