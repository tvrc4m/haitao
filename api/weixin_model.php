<?php

include_once("../includes/global.php");
if (!defined('TOKEN')) exit('No direct script access allowed');
class Weixin_model
{

    const REPLY_TYPE_TEXT_MSG = 1;
    const REPLY_TYPE_IMG_MSG = 2;
    const REPLY_TYPE_VOICE_MSG = 3;
    const REPLY_TYPE_VIDEO_MSG = 4;
    const REPLY_TYPE_TUWEN_MSG = 5;
    const REPLY_TYPE_KEFU_MSG = 6;
    var $apiurl = 'https://api.weixin.qq.com/cgi-bin/';
    public $template_send_url = "https://api.weixin.qq.com/cgi-bin/message/template/send?access_token=%s";
    public $sene_get_ticket_url = "https://api.weixin.qq.com/cgi-bin/qrcode/create?access_token=%s";
    public $sene_get_url_by_ticket = "https://mp.weixin.qq.com/cgi-bin/showqrcode?ticket=%s";
    public $get_user_info_url = "https://api.weixin.qq.com/cgi-bin/user/info?access_token=%s&openid=%s&lang=zh_CN";
    public $get_open_id_by_oauth2_url = "https://api.weixin.qq.com/sns/oauth2/access_token";
    public $message_custom_send_url = "https://api.weixin.qq.com/cgi-bin/message/custom/send?access_token=%s";
    public $fetch_file_url="http://file.api.weixin.qq.com/cgi-bin/media/get?access_token=%s&media_id=%s";

    function __construct()
    {
        parent::__construct();
    }

    /**
     * 获取access_token
     * @param $appid
     * @param $appsecret
     * @return mixed
     * @internal param $arr 菜单二维数组
     */
    public function getToken($appid, $appsecret)
    {
        $url = $this->apiurl . 'token?grant_type=client_credential&appid=' . $appid . '&secret=' . $appsecret;
        $access_token = json_decode($this->httpGET($url), true);
        return $access_token;
    }

    /**
     * 生成自定义菜单
     *
     * @param $access_token 微信TOKEN
     * @param $menuarr 菜单数组
     * @return bool|mixed
     */
    public function createMenu($access_token, $menuarr)
    {
        $url = $this->apiurl . 'menu/create?access_token=' . $access_token;
        $return = $this->httpPOST($url, $this->json_encode($menuarr));
        return $return;
    }

    /**
     * 撤销自定义菜单
     *
     * @param $access_token 微信TOKEN
     * @internal param $menuarr 菜单数组
     * @return bool|mixed
     */
    public function removeMenu($access_token)
    {
        $url = $this->apiurl . 'menu/delete?access_token=' . $access_token;
        $return = $this->httpGET($url);
        return $return;
    }

    /**
     * 验证签名
     * @$token 公众号在本系统的TOKEN
     */
    public function checkSignature($token, $signature, $timestamp, $nonce)
    {
        $tmpArr = array($token, $timestamp, $nonce);
        sort($tmpArr);
        $tmpStr = implode($tmpArr);
        $tmpStr = sha1($tmpStr);
        if ($tmpStr == $signature) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * 发送文本消息
     * @param object $postObj
     * @param array $msg
     * @return string
     */
    public function sendText($postObj, $msg)
    {

        $returnStr = '<xml>
                            <ToUserName><![CDATA[' . $postObj->FromUserName . ']]></ToUserName>
                            <FromUserName><![CDATA[' . $postObj->ToUserName . ']]></FromUserName>
                            <CreateTime>' . time() . '</CreateTime>
                            <MsgType><![CDATA[text]]></MsgType>
                            <Content><![CDATA[' . $msg['description'] . ']]></Content>
                            </xml>';
        return $returnStr ? $returnStr : '';
    }

    /**
     * 发送图片消息
     * @param object $postObj
     * @param array $msg
     * @return string
     */
    public function sendImage($postObj, $msg)
    {
        $returnStr = '<xml>
                            <ToUserName><![CDATA[' . $postObj->FromUserName . ']]></ToUserName>
                            <FromUserName><![CDATA[' . $postObj->ToUserName . ']]></FromUserName>
                            <CreateTime>' . time() . '</CreateTime>
                            <MsgType><![CDATA[image]]></MsgType>
                            <Image>
                            <MediaId><![CDATA[' . $msg['mediaid'] . ']]></MediaId>
                            </Image>
                            </xml>';
        return $returnStr ? $returnStr : '';
    }

    /**
     * 发送图文消息
     * @param object $postObj
     * @param array $msg
     * @return string
     */
    public function sendTextImage($postObj, $msg)
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

    /**
     * 发送语音消息
     * @param object $postObj
     * @param array $msg
     * @return string
     */
    public function sendVoice($postObj, $msg)
    {
        $returnStr = '<xml>
                            <ToUserName><![CDATA[' . $postObj->FromUserName . ']]></ToUserName>
                            <FromUserName><![CDATA[' . $postObj->ToUserName . ']]></FromUserName>
                            <CreateTime>' . time() . '</CreateTime>
                            <MsgType><![CDATA[voice]]></MsgType>
                            <Voice>
                            <MediaId><![CDATA[' . $msg['mediaid'] . ']]></MediaId>
                            </Voice>
                            </xml>';
        return $returnStr ? $returnStr : '';
    }

    /**
     * 发送视频消息
     * @param object $postObj
     * @param array $msg
     * @return string
     */
    public function sendVideo($postObj, $msg)
    {
        $returnStr = '<xml>
                            <ToUserName><![CDATA[' . $postObj->FromUserName . ']]></ToUserName>
                            <FromUserName><![CDATA[' . $postObj->ToUserName . ']]></FromUserName>
                            <CreateTime>' . time() . '</CreateTime>
                            <MsgType><![CDATA[video]]></MsgType>
                            <Video>
                            <MediaId><![CDATA[' . $msg['mediaid'] . ']]></MediaId>
                            <Title><![CDATA[' . $msg['title'] . ']]></Title>
                            <Description><![CDATA[' . $msg['description'] . ']]></Description>
                            </Video>
                            </xml>';
        return $returnStr ? $returnStr : '';
    }

    /**
     * 客服消息
     * @param $object
     * @return string
     *
     */
    public function transmitService($object)
    {
        $returnStr = "<xml>
                        <ToUserName><![CDATA[" . $object->FromUserName . "]]></ToUserName>
                        <FromUserName><![CDATA[" . $object->ToUserName . "]]></FromUserName>
                        <CreateTime>" . time() . "</CreateTime>
                        <MsgType><![CDATA[transfer_customer_service]]></MsgType>
                      </xml>";
        return $returnStr ? $returnStr : '';
    }

    /**
     *发送客服消息
     *
     * @param $access_token
     * @param $message
     * @return bool|mixed
     *
     */
    public function send_message($message)
    {
        $url = sprintf($this->message_custom_send_url, $this->getWeixinAccessToken());
        $dataRes = $this->httpPOST($url, $this->json_encode($message));
        if ($dataRes === false)
            return false;
        $res = json_decode($dataRes);
        return (isset($res->errcode) && $res->errcode == 0) ? true : false;
    }


    /**
     * 发送get请求
     *
     * @param $url
     * @return bool|mixed
     *
     */
    private function httpGET($url)
    {
        $oCurl = curl_init();
        if (stripos($url, "https://") !== FALSE) {
            curl_setopt($oCurl, CURLOPT_SSL_VERIFYPEER, FALSE);
            curl_setopt($oCurl, CURLOPT_SSL_VERIFYHOST, FALSE);
        }
        curl_setopt($oCurl, CURLOPT_URL, $url);
        curl_setopt($oCurl, CURLOPT_RETURNTRANSFER, 1);
        $sContent = curl_exec($oCurl);
        $aStatus = curl_getinfo($oCurl);
        curl_close($oCurl);
        if (intval($aStatus["http_code"]) == 200) {
            return $sContent;
        } else {
            return false;
        }
    }

    /**
     * 发送post请求
     * @param $url
     * @param $param
     * @return bool|mixed
     *
     */
    private function httpPOST($url, $param)
    {
        $oCurl = curl_init();
        if (stripos($url, "https://") !== FALSE) {
            curl_setopt($oCurl, CURLOPT_SSL_VERIFYPEER, FALSE);
            curl_setopt($oCurl, CURLOPT_SSL_VERIFYHOST, FALSE);
        }
        if (is_string($param)) {
            $strPOST = $param;
        } else {
            $aPOST = array();
            foreach ($param as $key => $val) {
                $aPOST[] = $key . "=" . urlencode($val);
            }
            $strPOST = join("&", $aPOST);
        }
        curl_setopt($oCurl, CURLOPT_URL, $url);
        curl_setopt($oCurl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($oCurl, CURLOPT_POST, TRUE);
        curl_setopt($oCurl, CURLOPT_POSTFIELDS, $strPOST);
        $sContent = curl_exec($oCurl);
        $aStatus = curl_getinfo($oCurl);
        curl_close($oCurl);
        if (intval($aStatus["http_code"]) == 200) {
            return $sContent;
        } else {
            return false;
        }
    }


    /**
     * 微信api不支持中文转义的json结构
     * @param array $arr
     * @return string
     */
    static function json_encode($arr)
    {
        $parts = array();
        $is_list = false;
        $keys = array_keys($arr);
        $max_length = count($arr) - 1;
        if (($keys [0] === 0) && ($keys [$max_length] === $max_length)) {
            $is_list = true;
            for ($i = 0; $i < count($keys); $i++) {
                if ($i != $keys [$i]) {
                    $is_list = false;
                    break;
                }
            }
        }
        foreach ($arr as $key => $value) {
            if (is_array($value)) {
                if ($is_list)
                    $parts [] = self::json_encode($value);
                else
                    $parts [] = '"' . $key . '":' . self::json_encode($value);
            } else {
                $str = '';
                if (!$is_list)
                    $str = '"' . $key . '":';
                if (is_numeric($value) && $value < 2000000000)
                    $str .= $value;
                elseif ($value === false)
                    $str .= 'false';
                elseif ($value === true)
                    $str .= 'true';
                else
                    $str .= '"' . addslashes($value) . '"';
                $parts [] = $str;
            }
        }
        $json = implode(',', $parts);
        if ($is_list)
            return '[' . $json . ']';
        return '{' . $json . '}';
    }

    public function curl_http($url, $method = "GET", $data = "")
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (compatible; MSIE 5.01; Windows NT 5.0)');
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_AUTOREFERER, 1);
        ($method == "POST" || $method == "post") ? curl_setopt($ch, CURLOPT_POSTFIELDS, $data) : "";
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $tmpInfo = curl_exec($ch);
        if (curl_errno($ch)) {
            echo 'Errno' . curl_error($ch);
        }
        curl_close($ch);
        $arr = json_decode($tmpInfo, true);

        return $arr;
    }

    public function curl_http_info($url,$method='GET',$data='')
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (compatible; MSIE 5.01; Windows NT 5.0)');
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_AUTOREFERER, 1);
        ($method == "POST" || $method == "post") ? curl_setopt($ch, CURLOPT_POSTFIELDS, $data) : "";
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $data = curl_exec($ch);
        if (curl_errno($ch)) {
            echo 'Errno' . curl_error($ch);
        }
        $httpinfo=curl_getinfo($ch);
        curl_close($ch);
        return array_merge($httpinfo,array('bodyData'=>$data));
    }

    private function  getWeixinAccessToken()
    {
        $this->load->library('Jssdk');
        $jssdk = new Jssdk();
        return $jssdk->selfGetAccessToken();

    }

    /**
     * 发送自定义的模板消息
     *
     * @param  $touser
     * @param  $template_id
     * @param  $url
     * @param  $data
     * @param string $topcolor
     * @return bool
     */
    public function send_template_msg( $touser, $template_id, $url, $data, $topcolor = '#7B68EE')
    {
        $access_token = $this->getWeixinAccessToken();
        $template = array('touser' => $touser,
            'template_id' => $template_id,
            'url' => $url,
            'topcolor' => $topcolor,
            'data' => $data
        );
        $json_template = json_encode($template);
        $url = sprintf($this->template_send_url, $access_token);
        $dataRes = $this->httpPOST($url, urldecode($json_template));
        if ($dataRes === false)
            return false;

        $res = json_decode($dataRes);
        return (isset($res->errcode) && $res->errcode == 0) ? true : false;
    }

    // 获得二维码url
    public function get_sene_by_ticket_qrcode($scene_id, $expire_seconds = 0)
    {
        $ticket = $this->get_info_by_scene($scene_id, $expire_seconds, false);
        if ($ticket == "") {
            return "";
        } else {
            return sprintf($this->sene_get_url_by_ticket, $ticket);
        }
    }

    // 获得二维码url
    public function get_sene_qrcode_url_by_ticket($ticket)
    {
        if ($ticket == "") {
            return "";
        } else {
            return sprintf($this->sene_get_url_by_ticket, $ticket);
        }
    }

    // 获得ticket
    public function get_ticket_by_scene($scene_id, $expire_seconds = 0)
    {
        return $this->get_info_by_scene($scene_id, $expire_seconds, false);
    }

    public function fetch_wx_file($access_token,$media_id)
    {
        $url=sprintf($this->fetch_file_url,$access_token,$media_id);
        return $this->curl_http_info($url);
    }

    // 高级接口创建二维码ticket
    private function get_info_by_scene($scene_id, $expire_seconds = 0, $is_get_url = false)
    {
        if (empty($scene_id))
            return "";
        $data = $expire_seconds ? array("action_name" => "QR_SCENE", array("action_info" => array("scene" => array("scene_id" => $scene_id)))) : array("action_name" => "QR_LIMIT_SCENE", "action_info" => array("scene" => array("scene_id" => $scene_id)));
        $url = sprintf($this->sene_get_ticket_url, $this->getWeixinAccessToken());
        $res = $this->curl_http($url, "POST", json_encode($data));
        if (isset($res['ticket']) && $res['ticket']) {
            return $is_get_url ? $res['url'] : $res['ticket'];
        } else {
            return "";
        }
    }

    //根据open_id获取用户信息
    public function curl_user_info($openid)
    {
        $access_token = $this->getWeixinAccessToken();
        return $this->curl_http(sprintf($this->get_user_info_url, $access_token, $openid));
    }

    //根据code获取用户open_id
    public function get_open_id_by_oauth2($access_token_params)
    {
        $url = $this->get_open_id_by_oauth2_url . "?" . http_build_query($access_token_params);
        return $this->curl_http($url);
    }

    //判断是否微信浏览器
    public function is_weixin()
    {
        if (strpos($_SERVER['HTTP_USER_AGENT'], 'MicroMessenger') !== false) {
            return true;
        } else {
            return false;
        }
    }

}