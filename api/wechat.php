<?php
include_once("../includes/global.php");
@include_once("../config/wechat_config.php");
$wechat = $wechat_config['wechat']?$wechat_config['wechat']:"";
$wechat = $_GET['uid'] ? "WeiXin" : $wechat ;  
define("TOKEN", $wechat);

Yf_Log::log('Request : ' . json_encode($_REQUEST), Yf_Log::INFO, 'wechat');

$wechatObj = new wechatCallbackapiTest();


if($_GET["echostr"]&&$_GET["signature"]&&$_GET["timestamp"]&&$_GET["nonce"])
{
	$wechatObj->valid();	
}
else
{
	$wechatObj->responseMsg();
}

class wechatCallbackapiTest
{
	public $postObj;
	public function valid()
    {
        $echoStr = $_GET["echostr"];
        if($this->checkSignature()){
			Yf_Log::log('checkSignature : ' . $echoStr, Yf_Log::INFO, 'wechat');
			echo $echoStr;
        	exit;
        }
    }


    public function responseMsg()
    {
    	$postStr = file_get_contents("php://input");
        if (!empty($postStr)) {
            // 解析微信传过来的 XML 内容
            $this->postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
            //      file_put_contents("./1.txt",var_export($this -> postObj,true));
            $fromUser = $this->postObj->FromUserName; //发送方帐号（一个OpenID）
            // $toUser = $this->postObj->ToUserName;//开发者微信号
            $msgType = $this->postObj->MsgType; //消息类型
            switch ($msgType) {
                case 'text':

                    $keyword = trim($this->postObj->Content); //用户发送的消息
                    $this->textMsg($keyword, $fromUser);
                    break;
                case 'image':

                    $this->imageMsg();
                    break;
                case 'voice':
                    $this->voiceMsg();
                    break;
                case 'video':
                    $this->videoMsg();
                    break;
                case 'location':
                    $this->locationMsg();
                    break;
                case 'link':
                    $this->linkMsg();
                    break;
                case 'event':

                    $this->eventMsg();
                    break;
                default:

                    echo 'Error!';
                    exit;
                    break;
            }
            // $keyword = trim($postObj->Content); // $keyword 就是用户输入的内容
        } else {
            echo 'Error!';
            exit;
        }
    }
	private function textMsg($keyword, $fromUser)
	{

		$postStr = $GLOBALS["HTTP_RAW_POST_DATA"];
		Yf_Log::log('$postStr : ' . $postStr, Yf_Log::INFO, 'wechat');
		global $db,$config;

		if(!empty($keyword))
		{
			$uid = $_GET['uid'];
			if($uid)
			{
				$str = " and member_id ='$uid' ";	
			}								
			$sql="select name as pname,id,pic from ".PRODUCT." where name like '%$keyword%' $str order by id desc limit 0,4";
			$db->query($sql);
			$re=$db->getRows();
			$msg_arr = array();
			foreach($re as $val)
			{
				$msg_arr[] = array("title"=>$val['pname'],"description"=>"","picurl"=>$val['pic'],"url"=>$config['weburl']."?m=product&s=detail&id=".$val['id']);
			}
			include_once("weixin_model.php");

			$msg["type"] = Weixin_model :: REPLY_TYPE_TUWEN_MSG;
            $msg["content"] = $msg_arr;
			$this->returnMsg($msg);
		}
	}

	private function imageMsg(){}
	private function voiceMsg(){}
	private function videoMsg(){}
	private function locationMsg(){}
	private function linkMsg(){}

	private function eventMsg(){
		include_once("weixin_model.php");
		global $config;
		$Event = $this->postObj->Event;
        $fromUser = trim($this->postObj->FromUserName); //发送方帐号（一个OpenID）
        switch ($Event) {
            case 'CLICK':// 用户点击菜单
                $keyword = trim($this->postObj->EventKey);
                $this->textMsg($keyword, $fromUser);
                break;
            case 'LOCATION':// 上报地理位置
                $this->locationMsg();
                break;
            case 'subscribe':// 关注后消息
            	$msg["type"] = Weixin_model :: REPLY_TYPE_TEXT_MSG;
            	$msg["description"] = 
"欢迎有品位会生活的你关注蚂蚁海淘，在这您可以：全球商品自由购，在家享受出国扫货般乐趣！\r\r1.全世界最有趣的新商品推荐，真正好用的口碑商品盘点\r2.我们只提供最受当地人欢迎的尖货商品\r3.海外直邮，正品保证\r4.会员可加入分销，边买边赚\r5.定期发送独家福利\r\r点击【海淘】浏览商品，点击【赚钱】加入分销\r客服电话：400-010-1977
";
				$this->returnMsg($msg);
                break;
            case 'unsubscribe':

                break;
            case 'SCAN':// 用户本来已经关注过，扫描其他二维码进入时，回复的消息
                break;
            default:
                break;
        }
	}
    private function returnMsg($msg)
    {
        include_once("weixin_model.php");
        $weixin_model = new Weixin_model();
        switch ($msg['type']) {
            case Weixin_model :: REPLY_TYPE_TEXT_MSG:
                $returnStr = $weixin_model->sendText($this->postObj, $msg); //文本消息
                break;
            case Weixin_model :: REPLY_TYPE_IMG_MSG:
                $returnStr = $weixin_model->sendImage($this->postObj, $msg); //图片消息
                break;
            case Weixin_model :: REPLY_TYPE_VOICE_MSG:
                $returnStr = $weixin_model->sendVoice($this->postObj, $msg); //语音消息
                break;
            case Weixin_model :: REPLY_TYPE_VIDEO_MSG:
                $returnStr = $weixin_model->sendVideo($this->postObj, $msg); //视频消息
                break;
            case Weixin_model :: REPLY_TYPE_TUWEN_MSG:
                $returnStr = $weixin_model->sendTextImage($this->postObj, $msg['content']); //图文消息
                break;
            case Weixin_model :: REPLY_TYPE_KEFU_MSG:
                $returnStr = $weixin_model->transmitService($this->postObj); //客服消息
                break;
            default:
                $returnStr = $weixin_model->sendText($this->postObj, $msg);
        }

        echo $returnStr;
    }

    private function checkSignature()
	{
        $signature = $_GET["signature"];
        $timestamp = $_GET["timestamp"];
        $nonce = $_GET["nonce"];	
        		
		$token = TOKEN;
		$tmpArr = array($token, $timestamp, $nonce);
		sort($tmpArr);
		$tmpStr = implode( $tmpArr );
		$tmpStr = sha1( $tmpStr );
		
		if( $tmpStr == $signature ){
			return true;
		}else{
			return false;
		}
	}
}
?>