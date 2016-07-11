<?php
	include_once("config.php");
	include_once("includes/public.php");

	
	$common = new Common;
	
	//初始化会员列表
	if($_GET['op']=='index')
	{	
		if($_GET['skey']){
			//会员卡号/手机号/身份证号/昵称
			$scl=" and a.`card_num` like '$_GET[skey]%' or a.`mobile` like '$_GET[skey]%' or a.`identification` like '$_GET[skey]%' or a.`user` like '$_GET[skey]%'";
		}else{
			$scl=" and a.`statu`=2";
		}
		
		$_GET['rows'] = $_GET['rows']?$_GET['rows']:50;
		
		if($_GET['rows']){
			//分页
			$rows = $_GET['rows'];//记录数
			$page = $_GET['page'];//页数
			$begin = ($page-1)*$rows;//开始
			$end = $page*$rows;//结束
			$limit = " limit $begin,$end";//语句
		}
		
		if($_SESSION['IDENTITY']!=1){
			//判断是否是管理员身份
			$operator = $_SESSION['ADMIN_USER'];
			$id = $_SESSION['ADMIN_USER_ID'];
			//$sql = "";
			//$db->query($sql);
			//$array = $db->getRows();
			$scl.=" and (a.operator='$operator' or a.userid IN ( SELECT DISTINCT buyer_id FROM  `mallbuilder_product_order` WHERE  buyer_id > 0 AND userid = $id))";
		}

		$sql="
			SELECT
				a.userid AS member_id,
				a.userid AS id,
				a.`user` AS member_name,
				a.sex AS member_sex,
				a.birth AS member_birth,
				a.mobile AS member_mobile,
				a.identification,
				a.qq AS member_qq,
				a.ww As member_ww,
				IFNULL(a.`real_name`,a.`user`) AS member_realname,
				IFNULL(a.card_num,'线上注册') AS member_cardnum,
				a.email AS member_email,
				a.operator,
				b.points AS member_points
			FROM
				mallbuilder_member a
			LEFT JOIN mallbuilder_member_info b ON a.userid = b.member_id
			WHERE
				1  $scl
			ORDER BY
				a.lastLoginTime  
		";
		$db->query($sql);		
		$total = $db->num_rows();//总记录数
		
		$sql = $sql.$limit;
		$db->query($sql);
		$res = $db->getRows();
		
		$body_data_rows = array();
        $body_data_rows['status'] = 200;//状态
		$body_data_rows['msg']    = 'success';//状态
		$body_data_rows['data']['rows']   = $res;//数据记录
		$body_data_rows['data']['total'] = ceil($total/$_GET['rows']);//页数
		$body_data_rows['data']['records'] =$total;//总的记录数
        $pro_data_rows = array('cmd_id'=>1) + $body_data_rows;
		header('Content-type: application/json');
		echo json_encode($pro_data_rows);		
		die;
	}
	
	//会员操作
	if($_GET['op']=='manage')
	{
		$tpl->display('member_manage.htm');
		die;
	}
	
	
	//获取当前会员的信息
	if($_GET['met']=='get')
	{	
		$member_id = $_REQUEST['member_id'];
		$data = $common->getMember($member_id);
		echo $data;
		die;
	}
 
	//修改当前会员的信息
	if($_GET['met']=='edit')
	{	
		$member_id = $_REQUEST['member_id'];
		$member_name = $_REQUEST['member_name'];
		$member_realname = $_REQUEST['member_realname'];
		$member_sex = $_REQUEST['member_sex'];
		$member_points = $_REQUEST['member_points']; 
		$member_email = $_REQUEST['member_email'];
		$member_mobile = $_REQUEST['member_mobile'];
		$member_qq = $_REQUEST['member_qq'];
		$member_ww = $_REQUEST['member_ww'];
		$identification = $_REQUEST['identification'];
		$member_birth = $_REQUEST['member_birth'];
		$operator = $_SESSION['ADMIN_USER'];
		$operate_id = $_SESSION['ADMIN_USER_ID'];
		$member_cardnum = addslashes(trim($_REQUEST['member_cardnum']));
		$time = time();
		
		if(!empty($member_mobile)&&!empty($identification)&&!empty($member_realname)){
			//如果填写手机号和身份证号和真实姓名，会员卡激活
			$scl = ',`statu`=2';
		}else{
			$scl='';
		}
		
		$sql = "
				UPDATE 
					mallbuilder_member
				SET 
					`real_name` = '$member_realname',
					`card_num` = '$member_cardnum',
					`sex` = '$member_sex',
					`email` = '$member_email',
					`mobile` = '$member_mobile',
					`qq` = '$member_qq',
					`ww` = '$member_ww',
					`birth` = '$member_birth',
					`identification` = '$identification',
					`operator` = '$operator',
					`operate_id` = '$operate_id',
					`update_time` = '$time'
					$scl
				WHERE
					userid = $member_id
		";
		$db->query($sql);
		
		$data = $common->getMember($member_id);
		echo $data;
		die;
	}

	if($_GET['met']=='add')
	{	

		$member_name = $_REQUEST['member_name'];
		$member_realname = $_REQUEST['member_realname'];
		$member_sex = $_REQUEST['member_sex'];
		$member_points = $_REQUEST['member_points']; 
		$email = $member_email = $_REQUEST['member_email'];
		$mobile = $member_mobile = $_REQUEST['member_mobile'];
		$member_qq = $_REQUEST['member_qq'];
		$member_ww = $_REQUEST['member_ww'];
		$member_cardnum = addslashes(trim($_REQUEST['member_cardnum']));
		$identification = $_REQUEST['identification'];

		$member_birth = $_REQUEST['member_birth'];
		$operator = $_SESSION['ADMIN_USER'];
		$operate_id = $_SESSION['ADMIN_USER_ID'];
		$time = time();

	$user = 'mayi'.$mobile;
	$pass = rand(100000,9999999);
	$email_verify = 0;
	$mobile_verify = "1";
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

	$sql="insert into ".MEMBER." (user,password,ip,lastLoginTime,email,mobile,regtime,statu,email_verify,mobile_verify,card_num,real_name,identification,sex,qq,ww,birth,open_id) values ('$user','".md5($pass)."','$ip','$lastLoginTime','$email','$mobile','$regtime','$user_reg','$email_verify','$mobile_verify','$member_cardnum','$member_realname','$identification','$member_sex','$member_qq','$member_ww','$member_birth','')";
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
			if($_SESSION['IDENTITY']==2)
			{
  			}
			$PluginManager = Yf_Plugin_Manager::getInstance();
			$PluginManager->trigger('reg_done', $userid, $user);

            $sql="update pay_member set mobile_verify=true, pay_mobile = '$mobile' where userid=".$userid;
            $db->query($sql);
            $sql="update ". MEMBER ." set mobile_verify = 1 where userid=".$userid;
            $db->query($sql);
			Send_msg($mobile,"尊敬的用户您的蚂蚁海淘账户密码为:{$pass}");

		}
	 }

		$data = $common->getMember($userid);
		echo $data;
		die;
	}

	function Check_only($data = null, $key = null, $table = null){
		global $db;
		$sql="select * from ".$table." where $key = '$data'";
		$db->query($sql);
		return $db->num_rows();
	}

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

	$tpl->display('member.htm');
?>