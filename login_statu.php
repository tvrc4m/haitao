<?php
include_once("includes/global.php");
var_dump($_SERVER,$config);die;
//=================================
function showUser()
{
	global $config,$db,$buid;
	if(!empty($config['_COOKIE']['1']))
	{
		if($config['temp']=='wap')
		{
			$new='<a href=\'main.php?cg_u_type=1\' class=\'footer_denglu_user\'>'.$config['_COOKIE']['1']."</a> &nbsp;&nbsp;<a href='$config[weburl]/main.php?action=logout' class='footer_denglu'>退出</a>";
		}
		else if($_GET['m'] == 'index')
		{
			
			$sql="select b.pic from ".MEMBER." a left join ".MEMBERGRADE." b on a.grade_id = b.id where user = '{$config['_COOKIE']['1']}' ";
			$db->query($sql);
			$pic = $db->fetchField('pic');
			if($_GET['p'] == 'pay'){
				$new = "<li class='drop-down'><a href='".$config['weburl']."/main.php?cg_u_type=1'>".$config['_COOKIE']['1']."</a><div><a href='".$config['weburl']."/main.php?m=member&s=admin_member'>账号管理</a><a href='".$config['weburl']."/main.php?action=logout'>退出</a><div></li>";

				$new.= "<li><div><a href='".$config['weburl']."/main.php?m=message&s=admin_message_list_inbox&cg_u_type=1'>消息</a></div></li>";
			}else{
				// $new = "<div class='nav-fore1'><a class='name' href='main.php?cg_u_type=1'>".$config['_COOKIE']['1']."</a><img align='absmiddle' src='$pic'><i><em></em></i></div><div class='nav-fore2'><ul><li><a href='main.php?m=member&s=admin_member'>账号管理</a></li><li><a href='main.php?action=logout'>退出</a></li></ul><div>";
				$new = "<li class='drop-down'><a class='name' href='main.php?cg_u_type=1'>".$config['_COOKIE']['1']."</a><div><a href='main.php?m=member&s=admin_member'>账号管理</a><a href='main.php?action=logout'>退出</a><div></li>";
				$new.= "<li class='nav msg'><div class='nav-fore1'><a class='name' href='main.php?m=message&s=admin_message_list_inbox&cg_u_type=1'><span>消息</span></a></div></li>";
			}

			
		}
		else
		{
			$new="欢迎来".$config['company'].'！<a class=\'name\' href=\'main.php\'>'.$config['_COOKIE']['1']."</a> &nbsp;<a href='$config[weburl]/main.php?action=logout'>退出</a>";
		}
	
	}
	else
	{	
		if($config['temp']=='wap')
		{
			$new="<a href='".$config["weburl"]."/login.php?forward=".$_SERVER['HTTP_REFERER']."' class='footer_denglu'>登录</a> &nbsp;&nbsp;<a href='".$config["weburl"]."/$config[regname]' class='footer_denglu'>注册</a>";
		}
		else
		{
			// $new="<a class='login' href='".$config["weburl"]."/login.php'>亲，请登录</a><a class='reg' href='".$config["weburl"]."/$config[regname]'>注册</a>";
			$new="<li><a href='".$config["weburl"]."/login.php?forward=".$_SERVER['HTTP_REFERER']."'>亲，请登录</a></li><li><a href='".$config["weburl"]."/$config[regname]'>注册</a></li>";
		}
		if($_GET['m'] == 'index'&&$config['temp']=='wap')
		{
			$new="<div class='nav-fore1'>".$new."</div>";
		}
	}
	return $new;
}
echo "document.write(\"".showUser()."\");";
?>