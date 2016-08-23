<?php 
/**
 * User: wonder
 * Time: 2016/8/22
 * describe:
 * 		登录互联：绑定QQ、微信、微博快速登录
 */


include_once("../includes/global.php");
include_once($config['webroot']."/config/connect_config.php");//connect

/**
* 关联登录
*/
class connect
{
	private $_config = '';
	private $_wx_akey = '';
	private $_wx_skey = '';
	private $_wx_callback_url = '';
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
		global $connect_config,$config,$db;
		$post = !empty($_REQUEST)?$_REQUEST:$this->_response_code='10001';

		$this->_config  = $config;
		
		if(!empty($post['type'])){
			$this->_action  = $post['type'];
			$this->_wx_akey = $connect_config['sina_app_id'];
			$this->_wx_skey = $connect_config['sina_key'];
			$this->_wx_callback_url = $config['weburl']."/api/connect_login.php?type=sina_fun";
			switch ($this->_action) {
				case 'sina':
				include_once( $this->_config['webroot'].'/includes/saetv2.ex.class.php' );
		    	$this->_obj = new SaeTOAuthV2( $this->_wx_akey , $this->_wx_skey );
					break;
				
				default:
					break;
			}
			
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

	public function sina_url(){
	    return $this->_obj->getAuthorizeURL( $this->_wx_callback_url );
	}

	public function sina_connect(){
		//------------------------------------------
	    if($_GET['type']=='sina'&&isset($_REQUEST['code']))
	    {
	        $keys = array();
	        $keys['code'] = $_REQUEST['code'];
	        $keys['redirect_uri'] = WB_CALLBACK_URL;
	        $token = $o->getAccessToken( 'code', $keys ) ;
	        $c = new SaeTClientV2( WB_AKEY , WB_SKEY , $token['access_token'] );
	        $uid_get = $c->get_uid();
	        $uid = $uid_get['uid'];
	        $ar = $c->show_user_by_id( $uid);
	        //------------
	        $sql="select * from ".USERCOON." where type=2 and client_id='$ar[id]'";
	        $db->query($sql);
	        $cre=$db->fetchRow();
	        if(empty($cre['id']))
	        {
	            $sql="insert into ".USERCOON."
	            (nickname,figureurl,gender,type,access_token,client_id) 
	            values 
	            ('$ar[name]','$ar[profile_image_url]','$ar[gender]',2,'$token[access_token]','$ar[id]')";
	            $db->query($sql);
	            $cre['id']=$db->lastid();
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


}

$obj = new connect();

?>