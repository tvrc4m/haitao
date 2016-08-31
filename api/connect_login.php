<?php 
/**
 * User: wonder
 * Time: 2016/8/22
 * describe:
 * 		登录互联：绑定QQ、微信、微博快速登录
 * 		1、获取关联链接存入config
 * 		2、接受回调方法
 * 		3、判断回调id是否已绑定会员
 * 		4、绑定了直接登录
 * 		5、未绑定->登录或注册绑定会员
 * 		6、登录成功以后绑定或注册成功以后直接登录绑定会员
 */
$post = !empty($_REQUEST['action'])?$_REQUEST['action']:'';
if (!empty($post))
include_once("../includes/global.php");

include_once($config['webroot']."/config/connect_config.php");//connect

/**
* 关联登录
*/
class connect
{
	private $_db = '';
	private $_config = '';
	private $_account = '';
	private $_password = '';
	private $_sina_akey = '';
	private $_sina_skey = '';
	private $_sina_callback_url = '';
	private $_qq_akey = '';
	private $_qq_skey = '';
	private $_qq_callback_url = '';
	private $_wx_akey = '';
	private $_wx_skey = '';
	private $_wx_callback_url = '';
	private $_request = '';
	private $_obj = '';
	private $_code = '';
	
	public function __construct()
	{
		global $connect_config,$config,$db,$buid;
		$this->_db = $db;
		$this->_config  = $config;
		$this->_sina_akey = $connect_config['sina_app_id'];
		$this->_sina_skey = $connect_config['sina_key'];
		$this->_sina_callback_url = $this->_config['weburl']."/api/connect_login.php?action=sina_connect";

		$this->_qq_akey = $connect_config['qq_app_id'];
		$this->_qq_skey = $connect_config['qq_key'];
		$this->_qq_callback_url = urlencode($this->_config['weburl']."/login.php");

		$this->_wx_akey = $connect_config['weixin_app_id'];
    	$this->_wx_skey = $connect_config['weixin_key'];
    	$this->_wx_callback_url = $this->_config['weburl']."/api/connect_login.php?action=weixin_connect";
		$this->_code = (isset($_REQUEST['code'])&&!empty($_REQUEST['code']))?$_REQUEST['code']:'';
		
	}

	/**
	 * [sina_connect description]
	 * @param  [type] $type [description]
	 * @return [type]       [description]
	 */
	public function sina_connect($type = null){
		include_once( $this->_config['webroot'].'/includes/saetv2.ex.class.php' );
		$this->_obj = new SaeTOAuthV2( $this->_sina_akey , $this->_sina_skey );
		if($type == 'url')
		return $this->_obj->getAuthorizeURL( $this->_sina_callback_url );
		
		//绑定会员
	    if($this->_code)
	    {
	        $keys = array();
	        $keys['code'] = $this->_code;
	        $keys['redirect_uri'] = $this->_sina_callback_url;
	        $token = $this->_obj->getAccessToken( 'code', $keys ) ;
	        $c = new SaeTClientV2( $this->_sina_akey , $this->_sina_skey , $token['access_token'] );
	        $uid_get = $c->get_uid();
	        $uid = $uid_get['uid'];
	        $ar = $c->show_user_by_id( $uid);
	        //------------
	        $sql="select * from ".USERCOON." where type=2 and client_id='$ar[id]'";
	        $this->_db->query($sql);
	        $cre=$this->_db->fetchRow();
	        if(empty($cre['id']))
	        {
	            $sql="insert into ".USERCOON." (nickname,figureurl,gender,type,access_token,client_id) values ('$ar[name]','$ar[profile_image_url]','$ar[gender]',2,'$token[access_token]','$ar[id]')";
	            $this->_db->query($sql);
	            $cre['id']=$this->_db->lastid();
	        }
	        if($cre['userid'])
	        {
	            if($this->users($cre['userid']))$this->login_success();
	            $forward = $post['forward']?$post['forward']:$this->_config["weburl"]."/main.php?cg_u_type=1";
	            if(empty($forward) || $forward == $this->_config["weburl"]."/login.php")
	            {
	                $forward = $this->_config["weburl"]."/main.php?cg_u_type=1";
	            }
	            msg($forward);
	        }
	        else
	        {
	            msg($this->_config["weburl"]."/login.php?connect_id=$cre[id]");
	        }
	    }
	    //-------------------------------------------
	}


	/**
	 * QQ关联登录
	 */
	public function qq_connect($type = null){

		//$this->_qq_callback_url=urlencode($this->_config['weburl'].'/login.php');

		if($type == 'url')
		return "https://graph.qq.com/oauth2.0/authorize?response_type=code&client_id=".$this->_qq_akey."&redirect_uri=".$this->_qq_callback_url."&state=".$this->_config['company']."&client_secret=".$this->_qq_skey;

		
	    /*$url="https://graph.qq.com/oauth2.0/token?grant_type=authorization_code&"
	        ."client_id=".$this->_qq_akey.""
	        ."&client_secret=".$this->_qq_skey.""
	        ."&code=".$this->_code.""
	        ."&state=".$this->_config[company].""
	        ."&redirect_uri=".$this->_qq_callback_url."";
	    $takenid=$this->get_url_contents($url);

	    //----------------
	    $url2="https://graph.qq.com/oauth2.0/me?$takenid";
	    $con=$this->get_url_contents($url2);
	    $lpos = strpos($con, "(");
	    $rpos = strrpos($con, ")");
	    $con  = substr($con, $lpos + 1, $rpos - $lpos -1);
	    $ar2=json_decode($con,true);
	    //----------------
	    $url3 = "https://graph.qq.com/user/get_user_info?"
	        . $takenid 
	        . "&oauth_consumer_key=" . $this->_qq_akey
	        . "&openid=" . $ar2["openid"]  
	        . "&format=json";

	    $con=$this->get_url_contents($url3);
	    $ar=json_decode($con,true);
	    //--------------------------

	    $sql="select * from ".USERCOON." where type=1 and openid='$ar2[openid]'";
	    $db->query($sql);
	    $cre=$db->fetchRow();
	    if(empty($cre['id']))
	    {
	        $sql="insert into ".USERCOON."
	        (nickname,figureurl,gender,vip,level,type,access_token,client_id,openid) 
	        values 
	        ('$ar[nickname]','$ar[figureurl]','$ar[gender]','$ar[vip]','$ar[level]',1,'$takenid','$ar2[client_id]','$ar2[openid]')";
	        $db->query($sql);
	        $cre['id']=$db->lastid();
	    }
	    if($cre['userid'])
	    {
	        if($this->users($cre['userid']))$this->login_success();
	        $forward = $post['forward']?$post['forward']:$this->_config["weburl"]."/main.php?cg_u_type=1";
	        msg($forward);
	    }
	    else
	    {
	        msg("login.php?connect_id=$cre[id]&connect_nickname=" . urlencode($ar['nickname']));
	    }*/


	}

	/**
	 * 微信关联登录
	 */
	public function weixin_connect($type = null){
			if($type == 'url'){
				return $this->weixin_code();
			}
			
			if(!isset($_SESSION['openid_connect']) || $_SESSION['openid_connect']==""){
				//获取code
				if(empty($this->_code))$this->weixin_code();
			    $token_url = 'https://api.weixin.qq.com/sns/oauth2/access_token?appid='.$this->_wx_akey.'&secret='.$this->_wx_skey.'&code='.$this->_code.'&grant_type=authorization_code';
			    $token = json_decode(file_get_contents($token_url));

			    $access_token_url = 'https://api.weixin.qq.com/sns/oauth2/refresh_token?appid='.$this->_wx_akey.'&grant_type=refresh_token&refresh_token='.$token->refresh_token;
		        $access_token = json_decode(file_get_contents($access_token_url));

		        $user_info_url = 'https://api.weixin.qq.com/sns/userinfo?access_token='.$access_token->access_token.'&openid='.$access_token->openid.'&lang=zh_CN';
		        $user_info = json_decode(@file_get_contents($user_info_url));

		        $_SESSION['openid_connect'] = $openid = $user_info -> openid;
		        $nickname = $user_info -> nickname;
			}
			if(!empty($_SESSION['openid_connect'])){
				$sql = "select * from ".USERCOON." where type=3 and openid='".$_SESSION['openid_connect']."'";
				$this->_db->query($sql);
				$cre = $this->_db->fetchRow();
				if($cre['status']==2)msg($this->_config["weburl"]."/login.php?temp=wap");
				if(empty($cre['id']))
	            {
	                $sql="insert into ".USERCOON."(nickname,figureurl,gender,vip,level,type,access_token,client_id,openid,status)
	                        values('$nickname','$ar[figureurl]','$ar[gender]','$ar[vip]','$ar[level]',3,'$takenid','$ar2[client_id]','$openid',1)";
	                $db->query($sql);
	                $cre['id']=$db->lastid();
	                msg("login.php?connect_id=$cre[id]");
	            }
	            if(!empty($cre['userid']))
	            {
	                if($this->users($cre['userid']))$this->login_success();
	                $forward = $this->_config["weburl"]."/main.php?cg_u_type=1";
	                msg($forward);
	            }
	            else
	            {
	                $_SESSION['connect_name'] = '微信';
	                msg("login.php?connect_id=$cre[id]");
	            }
			}
	}

	/**
	 * 微信互联登录获取code
	 */
	private function weixin_code(){
		if($this->_config['bw'] == "weixin"){
		    $weixin_url = "https://open.weixin.qq.com/connect/oauth2/authorize?appid=".$this->_wx_akey."&redirect_uri=".$this->_wx_callback_url."&response_type=code&scope=snsapi_login&state=123&connect_redirect=1#wechat_redirect";
		    if(empty($this->_code))header('location:' . $weixin_url);
		}else
	        return "https://open.weixin.qq.com/connect/qrconnect?appid=".$this->_wx_akey."&redirect_uri=".$this->_wx_callback_url."&response_type=code&scope=snsapi_login&state=STATE#wechat_redirect";
	}

	/**
	 * 是否使用微信登录
	 */
	public function weixin_status(){
		if(empty($_SESSION['openid_connect']))return false;
		$sql = "select status from ".USERCOON." where type=3 and openid='".$_SESSION['openid_connect']."'";
			$this->_db->query($sql);
			$status = $this->_db->fetchField('status');
			if($status==1)
				return true;
			else
				return false;
			//msg($this->_config["weburl"]."/login.php?temp=wap");

	}

	/**
	 * [users description]
	 * @return [type] [description]
	 */
	public function users($userid = ''){
		$sql = "select userid,user,statu,pid,mobile from ".MEMBER." where userid={$userid}";
		$this->_db->query($sql);
		$this->_users = $this->_db->fetchRow();

		return empty($this->_users)?false:true;
		
	}
	/**
	 * 登录成功
	 */
	public function login_success(){
		bsetcookie("USERID",$this->_users['userid']."\t".$this->_users['user']."\t".$this->_users['pid'],NULL,"/",$this->_config['baseurl']);
		$sql="update ".MEMBER." set lastLoginTime='".time()."' WHERE userid='{$this->_users['userid']}'";
		$this->_db->query($sql);

		return false;
	}

	/**
	 * curl
	 */
	private function get_url_contents($url)
	{

	    $ch = curl_init();
	    curl_setopt($ch, CURLOPT_URL, $url);
	    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
	    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	    $result =  curl_exec($ch);

	    if (curl_errno($ch))
	    {
	        echo "Error Occured in Curl\n";
	        echo "Error number: " . curl_errno($ch) . "\n";
	        echo "Error message: " . curl_error($ch) . "\n";
	    }

	    curl_close($ch);
	    return $result;
	}


}

$obj = new connect();
$config['_CONNCET']['_SINA_URL']= $obj->sina_connect('url');
$config['_CONNCET']['_SINA_STATU'] =  $connect_config['qq_connect'];
$config['_CONNCET']['_QQ_URL'] = $obj->qq_connect('url');
$config['_CONNCET']['_QQ_STATU'] =  $connect_config['sina_connect'];
$config['_CONNCET']['_WX_URL'] = $obj->weixin_connect('url');
$config['_CONNCET']['_WX_STATU'] =  $connect_config['weixin_connect'];
if(!empty($post)){
	switch ($post) {
	case 'sina_connect':
		$obj->sina_connect();
		break;
	case 'qq_connect':
		$obj->qq_connect();
		break;
	case 'weixin_connect':
		$obj->weixin_connect();
		break;
		
	default:
		echo '未找到';
		break;
	}
}



?>