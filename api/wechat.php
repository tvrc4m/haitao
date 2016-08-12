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
		$postStr = $GLOBALS["HTTP_RAW_POST_DATA"];
		Yf_Log::log('$postStr : ' . $postStr, Yf_Log::INFO, 'wechat');
		global $db,$config;
		if (!empty($postStr)){
              	$postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
                $fromUsername = $postObj->FromUserName;
                $toUsername = $postObj->ToUserName;
                $keyword = trim($postObj->Content);
                $time = time();
				$RX_TYPE = trim($postObj->MsgType);
				$num=0;
				$str="";

				Yf_Log::log('$postObj : ' . json_encode($postObj), Yf_Log::INFO, 'wechat');
				switch ($RX_TYPE) {
					case 'text':
						# code...
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

							echo $this->sendTextImage($postObj,$msg_arr);
						}
						else
							echo "Input something...";
						break;
					case 'event':
						$Event = $postObj->Event;
						switch ($Event) {
							case 'subscribe':
								echo $this->sendText($postObj,"HELLO");
								break;
							default:
								# code...
								break;
						}
						break;
					case 'variable':
						# code...
						break;
					
					default:
						# code...
						break;

				}
			
        }else{
        	echo "";
        	exit;
        }
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

	private function sendText($postObj, $msg)
    {

        $returnStr = '<xml>
                            <ToUserName><![CDATA[' . $postObj->FromUserName . ']]></ToUserName>
                            <FromUserName><![CDATA[' . $postObj->ToUserName . ']]></FromUserName>
                            <CreateTime>' . time() . '</CreateTime>
                            <MsgType><![CDATA[text]]></MsgType>
                            <Content><![CDATA[' . $msg . ']]></Content>
                            </xml>';
        return $returnStr ? $returnStr : '';
    }
    private function sendTextImage($postObj, $msg)
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
        $header = sprintf($newsTplHead, $postObj->FromUserName, $postObj->ToUserName, time(), $bodyCount);
        foreach ($msg as $key => $value) {
            $body .= sprintf($newsTplBody, $value['title'], $value['description'], $value['picurl'], $value['url']);
        }

        $FuncFlag = 0;
        $footer = sprintf($newsTplFoot, $FuncFlag);
        return $header . $body . $footer;

    }
}
?>