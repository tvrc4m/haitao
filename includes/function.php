<?php
function ext_all($functionname,$array)
{
	global $config;
	$dir=$config['webroot'].'/module/';
	$handle = opendir($dir); 
	while ($filename = readdir($handle))
	{ 
		if($filename!="."&&$filename!="..")
		{
			if(file_exists($dir.$filename.'/api.php'))
			{	
				include_once($dir.$filename."/api.php");
				$className=$filename.'_api';
				$api=new $className();
				if(method_exists($api,$functionname))
				{
					$api->$functionname($array);
					$re[$filename]=$api->result;
				}
			} 
		}
	}
	return $re;
}
function get_member_field($id,$string)
{
	global $db;
	if(!empty($string) and !empty($id))
	{
		$sql = "select $string from ".MEMBER." where  userid='$id'";
		$db->query($sql);
		return $db->fetchField($string);
	}
}

/*分享佣金*/
function get_member_share($id,$string){
    
    global $db;
	if(!empty($string) and !empty($id))
	{
		$sql = "select $string from ".DISTRIBUTION_USER." where  user_id='$id'";
		$db->query($sql);
		return $db->fetchField($string);
	}
    
}

function translate($output, &$smarty)
{
	global $mlang;
	preg_match_all("/[\x{4e00}-\x{9fa5}]+/u", $output, $match);
	$ch=array_unique($match[0]);
	$keys="2F5BDF05493BA142E3666C51BF0C764B5B866318";
	if(count($ch))
	{
		foreach($ch as $key=>$v)
		{	$i++;
			//if($i>100)
				//unset($ch[$key]);
		}
		foreach($ch as $key=>$v)
		{
			if(isset($tch[strlen($v)]))
				$tch[strlen($v).'.'.$key]=$v;
			else
				$tch[strlen($v)]=$v;
		}
		unset($ch);
		krsort($tch);
		$en=implode("<br>",$tch);
		$en=urlencode($en);
		$url="http://api.microsofttranslator.com/v2/Http.svc/Translate?appId=$keys&text=$en&from=zh-cn&to=$mlang";
		$r=file_get_contents($url);
		$r=strip_tags($r);
		$en=explode("&lt;br&gt;",$r);
		return str_replace($tch,$en,$output);
	}
	else
		return $output;
}

function is_mobile()
{
	$user_agent = $_SERVER['HTTP_USER_AGENT'];

	$mobile_agents = Array("240x320","acer","acoon","acs-","abacho","ahong","airness","alcatel","amoi","android","anywhereyougo.com","applewebkit/525","applewebkit/532","asus","audio","au-mic","avantogo","becker","benq","bilbo","bird","blackberry","blazer","bleu","cdm-","compal","coolpad","danger","dbtel","dopod","elaine","eric","etouch","fly ","fly_","fly-","go.web","goodaccess","gradiente","grundig","haier","hedy","hitachi","htc","huawei","hutchison","inno","ipad","ipaq","ipod","jbrowser","kddi","kgt","kwc","lenovo","lg ","lg2","lg3","lg4","lg5","lg7","lg8","lg9","lg-","lge-","lge9","longcos","maemo","mercator","meridian","micromax","midp","mini","mitsu","mmm","mmp","mobi","mot-","moto","nec-","netfront","newgen","nexian","nf-browser","nintendo","nitro","nokia","nook","novarra","obigo","palm","panasonic","pantech","philips","phone","pg-","playstation","pocket","pt-","qc-","qtek","rover","sagem","sama","samu","sanyo","samsung","sch-","scooter","sec-","sendo","sgh-","sharp","siemens","sie-","softbank","sony","spice","sprint","spv","symbian","tablet","talkabout","tcl-","teleca","telit","tianyu","tim-","toshiba","tsm","up.browser","utec","utstar","verykool","virgin","vk-","voda","voxtel","vx","wap","wellco","wig browser","wii","windows ce","wireless","xda","xde","zte");
	$is_mobile = false;
	foreach ($mobile_agents as $device) {
		if (stristr($user_agent, $device)) {
			$is_mobile = true;
			break;
		}
	}
	return $is_mobile;
}

function isrobot() 
{
	if(!defined('IS_ROBOT'))
	{
		$kw_spiders = 'Bot|Crawl|Spider|slurp|sohu-search|lycos|robozilla';
		$kw_browsers = 'MSIE|Netscape|Opera|Konqueror|Mozilla';
		if(!strexists($_SERVER['HTTP_USER_AGENT'], 'http://') && preg_match("/($kw_browsers)/i", $_SERVER['HTTP_USER_AGENT'])) {
			define('IS_ROBOT', FALSE);
		} elseif(preg_match("/($kw_spiders)/i", $_SERVER['HTTP_USER_AGENT'])) {
			define('IS_ROBOT', TRUE);
		} else {
			define('IS_ROBOT', FALSE);
		}
	}
	return IS_ROBOT;
}

function pay_get_url($post,$return=NULL)
{
	global $config;
	$post['auth']=md5($config['authkey']);
	$str=http_build_query($post);
	if(empty($return))
		header("Location: $config[pay_url]/api/gateway.php?".$str);
	else
	{
		$url="$config[pay_url]/api/gateway.php?".$str;
		$re=file_get_contents($url);
		return $re;
	}
}
function member_get_url($post,$return=NULL)
{
	global $config;
	$post['auth']=md5($config['authkey']);
	$str=http_build_query($post);
	if(empty($return))
		header("Location: $config[pay_url]/api/member.php?".$str);
	else
	{
		$url="$config[pay_url]/api/member.php?".$str;
		$re=file_get_contents($url);
		return $re;
	}
}

function explode_mi($value,$array)
{
	$i=1;
	$max=pow(2,count($array)-1);
	while($i<=$max)
	{
		if($value & $i)
		{ 
			if(isset($array[$i]))
				$ar[]=$i;
		}
		$i++;
	}
	return $ar;
}

function geturl($uid,$user,$com=NULL)
{
	//smarty 调用方试为<{geturl uid='' user='' tid=''}>,如果是公司商铺首页调用type=NULL
	//$config['rewrite'] 备用判断,现在为空值，以后增加此变量可以实现无地址重写也可以使用网站.
	global $config;
	if($config['opensuburl'] && !empty($config['baseurl']))
		$url="http://shop-".$uid.".".$config['baseurl'];
	else
		$url=$config['weburl'].'/shop.php?uid='.$uid;
	return $url;
}

function make_html($file_name, $content) 
{     	 
	 if(!$fp = fopen($file_name, "w+")){ 
		 return false; 
	 } 
	 if(!fwrite($fp, $content)){ 
		 fclose($fp); 
		 return false; 
	 }
	 fclose($fp);
		 @chmod($file_name,0666);
 }
 
function convert($array)
{
	if(is_array($array))
	{
		 @array_walk($array, create_function('&$value, $key', '$value = $key ."=". $value;'));
	}
	return $array;
}
function msg($url,$str="")
{
	if($url&&!$str)
		echo "<script>window.location='$url';</script>";
	if($url&&$str)
		echo "<script>alert('$str');window.location='$url';</script>";
	die;
}
function dateformat($time)
{
	global $config;
	if(!empty($config['date_format']))
		$config['date_format']=str_replace("%",'',$config['date_format']);
	if(is_numeric($time))
		return date($config['date_format'],$time);
	else
		return date($config['date_format'],strtotime($time));
}
function get_userdir($uid)
{
	global $config,$db;
	
	if(is_numeric($uid))
		$sql="select regtime,userid from ".MEMBER." WHERE userid='$uid'";
	else
		$sql="select regtime,userid from ".MEMBER." WHERE user='$uid'";
	$db ->query($sql);
	$ut=$db->fetchRow();
	if(empty($ut['regtime']))
	{
		$ut['regtime']=date("Y-m-d H:i:s");
		$db->query("update ".MEMBER." SET regtime='".$ut['regtime']."' where userid='".$ut['userid']."'");
	}

	$ar=explode('-',$ut['regtime']);
	$rdir=$ar[0].'/'.$ar[1].'/'.$ut['userid'];
	$dir=$config['webroot'].'/cache/shop/'.$rdir; 
	mkdirs($dir);
	return $rdir;
}
function mkdirs($dir)
{    
	return is_dir($dir) or (mkdirs(dirname($dir)) and mkdir($dir, 0777));
}

function authcode($string, $operation = 'DECODE', $expiry = 0)
{
	global $config;
	$ckey_length = 4;
	$key = md5(md5($config['authkey'].$_SERVER['HTTP_USER_AGENT']));
	$keya = md5(substr($key, 0, 16));
	$keyb = md5(substr($key, 16, 16));
	$keyc = $ckey_length ? ($operation == 'DECODE' ? substr($string, 0, $ckey_length): substr(md5(microtime()), -$ckey_length)) : '';

	$cryptkey = $keya.md5($keya.$keyc);
	$key_length = strlen($cryptkey);

	$string = $operation == 'DECODE' ? base64_decode(substr($string, $ckey_length)) : sprintf('%010d', $expiry ? $expiry + time() : 0).substr(md5($string.$keyb), 0, 16).$string;
	$string_length = strlen($string);

	$result = '';
	$box = range(0, 255);

	$rndkey = array();
	for($i = 0; $i <= 255; $i++) {
		$rndkey[$i] = ord($cryptkey[$i % $key_length]);
	}

	for($j = $i = 0; $i < 256; $i++) {
		$j = ($j + $box[$i] + $rndkey[$i]) % 256;
		$tmp = $box[$i];
		$box[$i] = $box[$j];
		$box[$j] = $tmp;
	}

	for($a = $j = $i = 0; $i < $string_length; $i++) {
		$a = ($a + 1) % 256;
		$j = ($j + $box[$a]) % 256;
		$tmp = $box[$a];
		$box[$a] = $box[$j];
		$box[$j] = $tmp;
		$result .= chr(ord($string[$i]) ^ ($box[($box[$a] + $box[$j]) % 256]));
	}

	if($operation == 'DECODE') {
		if((substr($result, 0, 10) == 0 || substr($result, 0, 10) - time() > 0) && substr($result, 10, 16) == substr(md5(substr($result, 26).$keyb), 0, 16)) {
			return substr($result, 26);
		} else {
			return '';
		}
	} else {
		return $keyc.str_replace('=', '', base64_encode($result));
	}

}
function bsetcookie($var,$value,$time=NULL,$path=NULL,$dommain)
{
	global $config;
	$value=authcode($value,'ENDODE');
	setcookie($config['language'].$var,$value,$time,$path,$dommain);
}
function bgetcookie($var)
{
	global $config;
	$nvar=$config['language'].$var;
	if(isset($_COOKIE[$nvar]))
		return explode("\t", authcode($_COOKIE[$nvar], 'DECODE')) ;
	elseif(isset($_COOKIE['cn'.$var]))
		return explode("\t", authcode($_COOKIE['cn'.$var], 'DECODE')) ;
	elseif(isset($_COOKIE['en'.$var]))
		return explode("\t", authcode($_COOKIE['en'.$var], 'DECODE')) ;
}
function lang_show ($langKey, $argument = null)
{
	global $lang;
	$showContent = $lang[$langKey];
	if(empty($lang[$langKey]))
	    return false;
	
	if($argument)
	{
	    while(list($key,$item) = @each($argument))
	    {
			$showContent = str_replace('#'.$key, $item, $showContent);
	    }
	}
	return $showContent;
}
function inject_check($sql)
{ 
	return preg_match("/^select|insert|delete|\.\.\/|\.\/|union|into|load_file|outfile/", $sql);// 进行过滤   
}
function magic()
{
	if(!get_magic_quotes_gpc()&&isset($_POST))
	{
		foreach($_POST as $key=>$v)
		{
			if(!is_array($v))
				$_POST[$key]=addslashes($v);
			else
			{
				foreach($v as $skey=>$sv)
				{
					if(!is_array($sv))
						$_POST[$key][$skey]=addslashes($sv);
					else
					{
						if($sssv)
						{
							foreach($sv as $sskey=>$ssv)
							{
								if(!is_array($ssv))
									$_POST[$key][$skey][$sskey]=addslashes($ssv);
								else	
								{
									if($sssv)
									{
										foreach($ssv as $ssskey=>$sssv)
										{
											if(!is_array($sssv))
												$_POST[$key][$skey][$sskey][$ssskey]=addslashes($sssv);
											else	
											{
												if($sssv)
												{
													foreach($sssv as $sssskey=>$ssssv)
													{
														$_POST[$key][$skey][$sskey][$ssskey][$sssskey]=addslashes($ssssv);
													}
												}
											}
										}
									}
								}
							}
						}
					}
				}
			}
		}
	}
	//===========GET
	if(inject_check(implode('',$_GET)))
	{
		die('Invalid URL !');
	}
	//===========POST
	if(isset($_POST))
	{
		foreach($_POST as $key=>$v)
		{
			if(!is_array($v))
			{
				if(strpos($v,'eval(')or(strpos($v,'$_POST[')))
					die('Invalid POST');
			}
		}
	}
}

function stop_ip($ip)
{
	foreach($ip as $v)
	{	
		if($uip=getip())
		{	
			$pos = strpos($uip,str_replace(".*","",$v));
			if($pos===false)
				;
			else
				die("您的IP被禁止访问");
		}
		else
			die;
	}
}

function GetDistrict($on=NULL)
{
	global $db;
	$sql="select id,name from ".DISTRICT." where pid=0 order by sorting asc";
	$db->query($sql);
	$re=$db->getRows();
	$str=NULL;
	foreach($re as $v)
	{
		if($on==$v['id'] or $on==$v['name'])
			$sl='selected="selected"';
		else
			$sl='';
		$str.='<option value="'.$v['id'].'|1" '.$sl.'>'.$v['name'].'</option>';
	}
	return $str;
}
function GetDistrict1()
{
	global $db;
	$sql="select id,name from ".DISTRICT." where pid=0 order by sorting asc";
	$db->query($sql);
	$re=$db->getRows();
	return $re;
}
function getdistrictid($name)
{
	global $db;
	$sql="select id from ".DISTRICT." where name='$name' ";
	$db->query($sql);
	return $db->fetchField('id');
}
function getdistrictname($id)
{
	global $db;
	if(is_numeric($id))
	{
		$sql="select name from ".DISTRICT." where id='$id' ";
		$db->query($sql);
		return $db->fetchField('name');
	}
}
function strexists($haystack, $needle)
{
	return !(strpos($haystack, $needle) === FALSE);
}

function makethumb($srcFile,$dstFile,$dstW,$dstH,$watermark=true)
{ 
	global $config;
	include_once("$config[webroot]/includes/image_class.php");
	$t=new cls_image();
	$t-> watermark=$watermark;
	$t-> make_thumb($srcFile, $dstFile,$dstW,$dstH);
	unset($t);
}
function csubstr($string, $start, $length, $dot = ' ...')
{   
	if(strlen($string) <= $length) {
		return $string;
	}
	$string = str_replace(array('&nbsp;','&amp;', '&quot;', '&lt;', '&gt;'), array(' ','&', '"', '<', '>'), $string);
	$strcut = '';
		$n = $tn = $noc = 0;
		while($n < strlen($string)) {
			$t = ord($string[$n]);
			if($t == 9 || $t == 10 || (32 <= $t && $t <= 126)) {
				$tn = 1; $n++; $noc++;
			} elseif(194 <= $t && $t <= 223) {
				$tn = 2; $n += 2; $noc += 2;
			} elseif(224 <= $t && $t <= 239) {
				$tn = 3; $n += 3; $noc += 2;
			} elseif(240 <= $t && $t <= 247) {
				$tn = 4; $n += 4; $noc += 2;
			} elseif(248 <= $t && $t <= 251) {
				$tn = 5; $n += 5; $noc += 2;
			} elseif($t == 252 || $t == 253) {
				$tn = 6; $n += 6; $noc += 2;
			} else {
				$n++;
			}
			if($noc >= $length) {
				break;
			}
		}
		if($noc > $length) {
			$n -= $tn;
		}
		$strcut = substr($string, 0, $n);
	return $strcut;
}
##########################################
function useCahe($cachPath=NULL,$lifetime=NULL)
{
	global $tpl,$config;
	if(!empty($config['cacheTime']))
	{
		if(!empty($_GET['m']))
		{
			//如果是 module下面调用，需要事先更改模板路径。
			$dir=$config['webroot'].'/module/'.$_GET['m'].'/templates/'.$config['temp'].'/';
			if(file_exists($dir.$file))
				$tpl->template_dir=$dir;
			else
				$tpl->template_dir=$config['webroot'].'/module/'.$_GET['m'].'/templates/default/';
		}
		
		$tpl->caching = true; //设置缓存方式 
		
		if(!empty($cachPath))
			$tpl->cache_dir = $config['webroot'].'/cache/'.$cachPath;
		else
			$tpl->cache_dir = $config['webroot'].'/cache/front/';
		
		if($lifetime==true)
			$tpl->cache_lifetime = -1 ; //永久有效
		elseif(!is_null($lifetime))
			$tpl->cache_lifetime = $lifetime ; //设置缓存时间
		else
			$tpl->cache_lifetime = $config['cacheTime'] ; //设置缓存时间
	}
}
//----------------------------------------
function readsubcat($id,$cattype=NULL,$isall=NULL)
{	
	global $db;
	if(empty($isall))
		$ssql=" and isindex='1' ";
	else
		$ssql=NULL;
	if(empty($cattype))
	{
		$s=$id."00";
		$b=$id."99";
		$sql="select * from ".PCAT." 
		where 1 $ssql and catid>$s and catid<$b order by nums asc,char_index asc";
	}
	$db->query($sql);
	$re=$db->getRows();
	return $re;
}
function readCat($id,$cattype=NULL)
{
	if($id) 
	{
		global $db;
		$db->query("select * from ".PCAT." where catid=$id order by nums asc,char_index asc");
		$re=$db->fetchRow();
		if($id>9999)
		{
			$catid=substr($id,0,strlen($id)-2);
			$sql="select * from ".PCAT." where catid=$catid order by nums asc,char_index asc";
			$db->query($sql);
			$re['pcat']=$db->fetchRow();
		}
		return $re;
	}
}
function send_sms($mob,$content)
{	
	global $config;
	include_once("$config[webroot]/module/sms/includes/plugin_sms_class.php");
	$sms=new sms();
	$str=$sms->send($_POST['mob'],$_POST['con']);
	$str = iconv("gb2312","utf-8//IGNORE",urldecode($str));
	return $str;	
}
function send_mail($email,$name,$title,$con,$reply=NULL)
{	
	global $config;
	include($config['webroot'].'/config/mail_config.php');
	if($mail_config['mail_statu']==0)
		return NULL;//邮件功能关闭
	else
	{
		if(empty($reply))
		{
			if(!empty($config['email']))
				$reply=$config['email'];
			else
				$reply=$email;
		}
		if(!empty($mail_config["sent_type"])==2)
		{	
			include_once($config['webroot']."/lib/phpmailer/class.phpmailer.php");
			for($i=1;$i<=6;$i++)
			{	
				$index='smtp'.$i;
				if($mail_config[$index]!='')
				{
					$t++;
					$s[$t]['smtp']=$mail_config['smtp'.$i];
					$s[$t]['email']=$mail_config['email'.$i];
					$s[$t]['emailPass']=$mail_config['emailPass'.$i];
				}
			}
			$get_index=rand(1,$t);
			$m_smtp=$s[$get_index]['smtp'];
			$m_email=$s[$get_index]['email'];
			$m_emailPass=$s[$get_index]['emailPass'];
			
			$mail = new PHPMailer();
			$mail->IsSMTP();                        
			$mail->Host = $m_smtp;  	
			$sm=explode(":",$m_smtp);
			if(count($sm)>=2)
			{
				$mail->Host = $sm[0];
				$mail->Port = $sm[1];
			}  
			$mail->SMTPAuth = true;                
			$mail->Username = $m_email;               
			$mail->Password = $m_emailPass;          
			$mail->From = !empty($from)?$from:$m_email;
			$mail->FromName=$config['company']; 
			$mail->FromEmail=$reply;
			$mail->AddReplyTo($reply,$config['company']);//回复地址
			$mail->WordWrap = 50;           
			$mail->AddAddress($email,$name);
			$mail->IsHTML(true);                
			$mail->CharSet="utf-8";
			$mail->Subject =$title; 
			$mail->Body =$con;
			$re=$mail->send();
			return $re;
		}
		else
		{
			$headers = "MIME-Version: 1.0" . "\r\n";
			$headers .= "Content-type:text/html;charset=utf-8" . "\r\n";
			$headers .= 'From: '.$reply.'<'.$config['company'].'>' . "\r\n";
			return mail($email,$title,$con,$headers);
		}
	}
}

function tplfetch($file,$flag=NULL,$no_return=false)
{

	global $tpl,$config;
	
	if(file_exists($tpl->template_dir.$file))
		;//当前主模板下面有，先去主模板下面找，
	else
	{	//如果不存在就去模块目录下面找
		$tpl->template_dir=$config['webroot'].'/module/'.$_GET['m'].'/templates/';
	}
	$tpl->statu=$tpl->template_dir;
	if($no_return)
	{
		$tpl->display($file,$flag);die;
	}
	else
		return $tpl->fetch($file,$flag);
}

function get_mail_template($flag)
{
	global $db;
	$sql="select title,message from ".MAILMOD." where flag='$flag'";
	$db->query($sql);
 	$re = $db->fetchRow();
	$re['message'] = htmlspecialchars_decode($re['message']);
	return $re;
}
function  replace_outside_link($str)
{
   $str=preg_replace("/<a.*>|<\/a>/isU",'',$str);
   return $str;
}

function admin_msg($url,$str=NULL)
{
	msg('noright.php?str='.urlencode($str).'&url='.urlencode($url));
}

//记录已登录会员活动，例如，查看别的会员商铺，产品，产品，新闻等
//$uid,表示会员ＩＤ，$tid表示某个内容的主ＩＤ，例如，产品，产品，会员，新闻等与后面的type共同起作用．
//type值：产品1,产品2,会员商铺4,新闻5
function user_read_rec($uid,$tid,$type)
{
	if(!empty($uid)&&!empty($tid)&&!empty($type)&&$uid!=$tid)
	{
		global $db;
		$time = time();
		$date = date('Y-m-d');
		$ip = getip();
		$ip = empty($ip)?NULL:$ip;
		
		$sql="select id from ".READREC." where userid='$uid' and tid='$tid' and type='$type' and FROM_UNIXTIME(`time`, '%Y-%m-%d') >='$date' and FROM_UNIXTIME(`time`, '%Y-%m-%d') <= '$date'";
		$db->query($sql);
		$id = $db->fetchField('id');
		if($id)
		{
			$db->query("update ".READREC." set time='$time' where id = $id ");
		}
		else
		{
			$db->query("insert into ".READREC." (userid,tid,type,time,ip) values ('$uid','$tid','$type','$time','$ip')");
		}
        $two_month_ago = strtotime("-2 months", $time);
        $two_month_ago = date('Y-m-d',$two_month_ago);
        $sql="delete from ".READREC." where FROM_UNIXTIME(`time`, '%Y-%m-%d') <= '$two_month_ago'";
        $db->query($sql);
	}
}
function getName($prod)
{
	global $db;
	if(!empty($prod))
	{
		$sql = "select cat from ".PCAT." where catid ='$prod'";
		$db->query($sql);
		$v=$db->fetchRow();
		return $v['cat'];
	}
}

function get_url_content($url)
{
	if(function_exists('file_get_contents'))
	{
		$file_contents = file_get_contents($url);
		echo $file_contents;die;
	}
	else
	{
		$ch = curl_init();
		$timeout = 5;
		curl_setopt ($ch, CURLOPT_URL, $url);
		curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
		$file_contents = curl_exec($ch);
		curl_close($ch);
	}
	return $file_contents;
}

function curl_post($strUrl, $arrData=array(), $boolUseCookie=false)
{
	$strData = array();
	foreach ($arrData as $k => $v) {
		$strData[] = "$k=$v";
	}
	$strData = $strData ? implode('&', $strData) : '';
	$ch = curl_init($strUrl);
	curl_setopt($ch, CURLOPT_HEADER, 0);
	curl_setopt($ch, CURLOPT_TIMEOUT, 5);
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_POST, true);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $strData);
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
	curl_setopt($ch, CURLOPT_MAXREDIRS, 3);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
	if ($boolUseCookie && is_array($_COOKIE) && count($_COOKIE) > 0) {
		$cookie_str = '';
		foreach($_COOKIE as $key => $value) {
			$cookie_str .= "$key=$value; ";
		}
		curl_setopt($ch, CURLOPT_COOKIE, $cookie_str);
	}
	$response = curl_exec($ch);
	if (curl_errno($ch) != 0) {
		//echo curl_error($ch);
		return false;
	}
	curl_close($ch);
	return $response;
}

function create_password($_length = '6')   
{  
	$randpwd = substr(md5(md5(time())), 0, $_length); 
    return $randpwd;
} 

/**
*生成随机字母数字组合
*
* @param $length int 生成长度，默认为6位
* 
* @return str
*/

function randomkeys($length = 6) {
    $returnStr='';
    $pattern = '1234567890abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLOMNOPQRSTUVWXYZ';
    for($i = 0; $i < $length; $i ++)
    {
        $returnStr .= $pattern {mt_rand ( 0, 61 )}; //生成php随机数
    }
    return $returnStr;
}


//如果使用zend, 则关掉此处
function __autoload(&$class_name)
{
	if (!class_exists($class_name, false) && !interface_exists($class_name, false))
	{
		if (false !== strpos($class_name, '_'))
		{
			$class_file_suffix = '/' . str_replace('_', '/', $class_name) . '.php';
		}
		else if (false !== strpos($class_name, '\\'))
		{
			$class_file_suffix = '/' . str_replace('\\', '/', $class_name) . '.php';
		}
		else
		{
			$class_file_suffix = '/' . $class_name . '.php';
		}

		global $config;
		$class_file_path = $config['webroot'].'/lib/' . $class_file_suffix;

		if (is_file($class_file_path))
		{
			include_once $class_file_path;
		}
		else
		{
			$class_file_path = $config['webroot'].'/module/' . $class_file_suffix;

			if (is_file($class_file_path))
			{
				include_once $class_file_path;
			}
		}

		if (!class_exists($class_name, false) && !interface_exists($class_name, false))
		{
			throw new Exception('Class ' . $class_name . ' does not exists : ' . $class_file_suffix);
		}
	}
}
function fb()
{
	if (!isset($_SERVER['HTTP_USER_AGENT']))
	{
		return;
	}

	if (!preg_match_all('/\sFirePHP\/([\.|\d]*)\s?/si', $_SERVER['HTTP_USER_AGENT'], $m) || !version_compare($m[1][0], '0.0.6', '>='))
	{
	}
	else
	{
		$FirePHP = new FirePHP();
		if ($FirePHP)
		{
			$instance = $FirePHP->getInstance(true);
			$args     = func_get_args();
			return call_user_func_array(array($instance, 'fb'), $args);
		}
	}

	return true;
}

function array_filter_key($key, $data_rows)
{
	$data_rows_new = array();

	foreach ($data_rows as $row)
	{
		if (isset($row[$key]))
		{
			$data_rows_new[] = $row[$key];
		}
	}


	return $data_rows_new;
}

/**
 * Determines if the current version of PHP is greater then the supplied value
 *
 * Since there are a few places where we conditionally test for PHP > 5
 * we'll set a static variable.
 *
 * @access  public
 * @param   string
 * @return  bool
 */
function is_php($version = '5.0.0')
{
	static $_is_php;
	$version = (string)$version;

	if (!isset($_is_php[$version]))
	{
		$_is_php[$version] = (version_compare(PHP_VERSION, $version) < 0) ? FALSE : TRUE;
	}

	return $_is_php[$version];
}

if (is_php('5'))
{
	function make_dir_path($path)
	{
		if (!file_exists($path))
		{
			mkdir($path, 0777, true);
		}
	}
}
else
{
	function make_dir_path($path)
	{
		if (!file_exists($path))
		{
			make_dir_path(dirname($path));
			mkdir($path, 0777);
		}
	}
}
function get_num($num){
    global $db,$buid;
    $sql ="SELECT * FROM " . FRIEND . " WHERE group_id='$num' and uid ='$buid'";
    $db ->query($sql);
    $rss = $db->getRows();
    $nus = count($rss);
    echo $nus;
}


/**
 * url地址加上推广信息
 *
 * @return mixed
 */
function add_dist_user_id()
{
	//微信分享，内部重构造URL
	global $buid;

	if ($buid)
	{
		global $config;
		global $tpl;

		global $search_dist_id_row;
		global $replace_dist_id_row;

		//$search_dist_id_row[] = '/href="main\.php?(.*)".?/';
		$search_dist_id_row[] = "/src=\"api\/share_qrcode\.php\?(.*?)\"/";
		$search_dist_id_row[] = "/href=\"main\.php\?(.*?)\"/";
		$search_dist_id_row[] = "/shop\.php\?(.*?)\"/";
		$search_dist_id_row[] = "/href=\"" . str_replace('/', '\/', $config['weburl']). "\?(.*?)\"/";
		$search_dist_id_row[] = "/href=\"" . str_replace('/', '\/', $config['weburl']). "\/\?(.*?)\"/";

		$search_dist_id_row[] = "/&dist_id=" . $buid . "&dist_id=" . $buid . "/";

		$replace_dist_id_row[] = 'src="api/share_qrcode.php?\\1&dist_id=' . $buid . '"';
		$replace_dist_id_row[] = 'href="main.php?\\1&dist_id=' . $buid . '"';
		$replace_dist_id_row[] = 'shop.php?\\1&dist_id=' . $buid . '"';
		$replace_dist_id_row[] = 'href="' . $config['weburl'] . '?\\1&dist_id=' . $buid . '"';
		$replace_dist_id_row[] = 'href="' . $config['weburl'] . '/?\\1&dist_id=' . $buid . '"';

		$replace_dist_id_row[] = '&dist_id=' . $buid;

		function add_dist_id($output, &$smarty)
		{
			global $search_dist_id_row,$replace_dist_id_row;
			return preg_replace($search_dist_id_row, $replace_dist_id_row, $output, -1);
		}

		$tpl->register_outputfilter("add_dist_id");
	}
}

/**
 * 转义字符函数
 *
 * @param mixed $content contents should be addslashes
 *
 * @return mixed  $content
 *
 */
function quotes(&$content)
{
	if (is_array($content))
	{
		foreach ($content as $key => $value)
		{
			$content[$key] = quotes($value);
		}
	}
	else
	{
		$content = addslashes($content);
	}

	return $content;
}

function get_url($url, $formvars=array(), $typ='string', $method='POST')
{
	$snoopy = new Snoopy();

	//$formvars["username"] = "admin";
	//$formvars["pwd"] = "admin";

	$action = $url;
	$snoopy->submit($action, $formvars);

	$rs = $snoopy->results; //获取表单提交后的 返回的结果

	fb($rs);
	if ('JSON' == $typ)
	{
		$rs = json_decode($rs, true);
	}

	//"status":250,"msg":"\u7528\u6237\u4fe1\u606f\u4fee\u6539\u5931\u8d25","data":

	return $rs;
}

?>