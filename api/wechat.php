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
			echo $this->sendTextImage($msg_arr);
		}
	}
	private function imageMsg(){}
	private function voiceMsg(){}
	private function videoMsg(){}
	private function locationMsg(){}
	private function linkMsg(){}
	private function eventMsg(){
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
				echo $this->sendTextImage(array(array('title' =>"欢迎关注蚂蚁海淘" , "description"=>"很不错的平台","picurl"=>"https://www.mayihaitao.com/uploadfile/adv/2016/04/28/1461831474.jpg","url"=>$config['weburl']."?m=product&s=detail&id=1"))
					);
                break;
            case 'unsubscribe':

                break;
            case 'SCAN':// 用户本来已经关注过，扫描其他二维码进入时，回复的消息
                break;
            default:
                break;
        }


	}
	private function sendText($msg)
    {

        $returnStr = '<xml>
                            <ToUserName><![CDATA[' . $this->postObj->FromUserName . ']]></ToUserName>
                            <FromUserName><![CDATA[' . $this->postObj->ToUserName . ']]></FromUserName>
                            <CreateTime>' . time() . '</CreateTime>
                            <MsgType><![CDATA[text]]></MsgType>
                            <Content><![CDATA[' . $msg . ']]></Content>
                            </xml>';
        return $returnStr ? $returnStr : '';
    }
    private function sendTextImage($msg)
    {

        $newsTplHead = "<xml>
                        <ToUserName><![CDATA[%s]]></ToUserName>
                        <FromUserName><![CDATA[%s]]></FromUserName>
                        <CreateTime>%s</CreateTime>
                        <MsgType><![CDATA[news]]></MsgType>
                        <ArticleCount>%s</ArticleCount>
                        <Articles>";
        $newsTplBody = "<item>
                        <Title><![CDATA[%s]]></Title> 
                        <Description><![CDATA[%s]]></Description>
                        <PicUrl><![CDATA[%s]]></PicUrl>
                        <Url><![CDATA[%s]]></Url>
                        </item>";
        $newsTplFoot = "</Articles></xml>";
        $bodyCount = count($msg);
        $bodyCount = $bodyCount < 10 ? $bodyCount : 10;
        $header = sprintf($newsTplHead, $this->postObj->FromUserName, $this->postObj->ToUserName, time(), $bodyCount);
        foreach ($msg as $key => $value) {
            $body .= sprintf($newsTplBody, $value['title'], $value['description'], $value['picurl'], $value['url']);
        }

        $FuncFlag = 0;
        $footer = sprintf($newsTplFoot, $FuncFlag);
        return $header . $body . $footer;

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