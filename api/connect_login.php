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
	private $_wx_akey = '';
	private $_wx_skey = '';
	private $_wx_callback_url = '';
	private $_request = '';
	private $_obj = '';
	protected $_response_code = '';//回调状态
	protected $_response_data = null;//回调数据
	protected $_error = array(
        '00000'=>'操作成功！',
        '10001'=>'亲！玩我呢！',
        '10002'=>'请求的方法不存在！'
    );
	
	public function __construct()
	{
		global $connect_config,$config,$db,$buid;
		$post = !empty($_REQUEST)?$_REQUEST:$this->_response_code='10001';



		var_dump($buid);die;
		$this->_config  = $config;
		$this->_wx_akey = $connect_config['sina_app_id'];
		$this->_wx_skey = $connect_config['sina_key'];
		$this->_wx_callback_url = $config['weburl']."/api/connect_login.php?type=sina_connect";
		
		if(!empty($post['type'])){
			$this->_action  = $post['type'];

			if (method_exists($this,$this->_action)) {
                call_user_func(array($this,$this->_action));
            }else{
                // 请求的方法不存在
                $this->_response_code='10002';
            }
		}

		$this->response(); 
	}

	private function response(){
		var_dump(array('status'=>$this->_response_code,'errmsg'=>$this->_error[$this->_response_code],'data'=>$this->_response_data));die;
		// echo json_encode(array('status'=>$this->_response_code,'errmsg'=>$this->_error[$this->_response_code],'url'=>$this->_response_data));die;

	}


	public function sina_connect(){
		include_once( $this->_config['webroot'].'/includes/saetv2.ex.class.php' );
		$this->_obj = new SaeTOAuthV2( $this->_wx_akey , $this->_wx_skey );
		if(empty($this->_action))
		return $this->_obj->getAuthorizeURL( $this->_wx_callback_url );
		//绑定会员
	    if(!empty($this->_action)&&isset($_REQUEST['code']))
	    {
	        $keys = array();
	        $keys['code'] = $_REQUEST['code'];
	        $keys['redirect_uri'] = $this->_wx_callback_url;
	        $token = $this->_obj->getAccessToken( 'code', $keys ) ;
	        $c = new SaeTClientV2( $this->_wx_akey , $this->_wx_skey , $token['access_token'] );
	        $uid_get = $c->get_uid();
	        $uid = $uid_get['uid'];
	        $ar = $c->show_user_by_id( $uid);
	        //------------
	        $sql="select * from mallbuilder_user_connected where type=2 and client_id='$ar[id]'";
	        $this->_db->query($sql);
	        $cre=$this->_db->fetchRow();
	        if(empty($cre['id']))
	        {
	            $sql="insert into mallbuilder_user_connected (nickname,figureurl,gender,type,access_token,client_id) values ('$ar[name]','$ar[profile_image_url]','$ar[gender]',2,'$token[access_token]','$ar[id]')";
	            $this->_db->query($sql);
	            $cre['id']=$this->_db->lastid();
	        }
	        if($cre['userid'])
	        {
	            login($cre['userid'],NULL);
	            $forward = $post['forward']?$post['forward']:$config["weburl"]."/main.php?cg_u_type=1";
	            if(empty($forward) || $forward == $config["weburl"]."/login.php")
	            {
	                $forward = $config["weburl"]."/main.php?cg_u_type=1";
	            }
	            msg($forward);
	        }
	        else
	        {
	            msg("login.php?connect_id=$cre[id]");
	        }
	    }
	    //-------------------------------------------
	}

	private function users(){
		$sql = "select userid,user,statu,pid,password,mobile,rand_pwd from ".MEMBER." where mobile={$this->_account}";
		$this->_db->query($sql);
		$this->_users = $this->_db->fetchRow();

		return empty($this->_users)?false:true;
		
	}
	/**
	 * 登录成功
	 */
	private function login_success(){
		bsetcookie("USERID",$this->_users['userid']."\t".$this->_users['user']."\t".$this->_users['pid'],NULL,"/",$this->_config['baseurl']);

		$sql="update mallbuilder_user_connected set userid='$uid' where id='$post[connect_id]'";
        $this->_db->query($sql);
		$sql="update ".MEMBER." set lastLoginTime='".time()."' WHERE userid='{$this->_users['userid']}'";
		$this->_db->query($sql);

		return false;
	}


}

$obj = new connect();

?>