<?php

class Sms
{
	public static function getPayUrl($post, $return = true)
	{
		$config = Yf_Registry::get('config');

		$post['auth'] = md5($config['authkey']);
		$str          = http_build_query($post);

		if (empty($return))
		{
			header("Location: {$config['pay_url']}/api/gateway.php?" . $str);
		}
		else
		{
			$url = "{$config['pay_url']}/api/gateway.php?" . $str;
			fb($url);
			$re = file_get_contents($url);
			return $re;
		}
	}
    public static function send($mob = null,$content = null)
    {

<<<<<<< HEAD
=======
    public static function send($mob = null,$content = null)
    {

>>>>>>> 3434106cc0fd910bc375158586e3234c4fd2ff1c
        global $config;
        include_once($config['webroot']."/config/sms_config.php");

        $name=$sms_config['sms_account'];
        $password=$sms_config['sms_pass'];
        $sigin=$sms_config['sms_sigin'];
        $mob=isset($_POST['mob'])?$_POST['mob']:$mob;

        $content=isset($_POST['con'])?$_POST['con']:$content;
        $url="http://sms-api.luosimao.com/v1/send.json";
<<<<<<< HEAD
        return self::curl_post($url,$password,array('mobile' => $mob, 'message' =>$content.$sigin));

    }
    public static function curl_post($url,$api_key,$parameter){
        $ch = curl_init();
        // ÉèÖÃ´«ÊäÑ¡Ïî
=======
        return Self::curl_post($url,$password,array('mobile' => $mob, 'message' =>$content.$sigin));

    }
    private static function curl_post($url,$api_key,$parameter){
        $ch = curl_init();
        // è®¾ç½®ä¼ è¾“é€‰é¡¹
>>>>>>> 3434106cc0fd910bc375158586e3234c4fd2ff1c
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HEADER, false);

        curl_setopt($ch, CURLOPT_HTTPAUTH , CURLAUTH_BASIC);
        curl_setopt($ch, CURLOPT_USERPWD , 'api:key-' . $api_key);

        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $parameter);
<<<<<<< HEAD
        // Ö´ÐÐÒ»¸öcurl»á»°
        $res = curl_exec($ch);
        // ¹Ø±Õcurl»á»°
        curl_close($ch);
        if (empty($res)) {
            return '·¢ËÍÊ§°Ü';
        }
        else
        {

            return $res;

        }
    }
=======
        // æ‰§è¡Œä¸€ä¸ªcurlä¼šè¯
        $res = curl_exec($ch);
        // å…³é—­curlä¼šè¯
        curl_close($ch);
        if (empty($res)) {
            return 'å‘é€å¤±è´¥';
        }
        else
        {
            return $res;
        }
    }

>>>>>>> 3434106cc0fd910bc375158586e3234c4fd2ff1c
	/*public static function send($mob, $content)
	{
		$sms_config = Yf_Registry::get('sms_config');

		$name     = $sms_config['sms_account'];
		$password = md5($sms_config['sms_pass']);

		$mob      = $mob;
		$content  = urlencode($content);
		$content  = iconv("utf-8", "gb2312//IGNORE", $content);

		$url = "http://sms.b2b-builder.com/sms.php?name=" . $name . "&password=" . $password . "&mob=" . $mob . "&content=" . $content;
		$ch  = curl_init();
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
		curl_setopt($ch, CURLOPT_URL, $url);
		$result = curl_exec($ch);
		curl_close($ch);

		return $result;
	}*/

}

?>