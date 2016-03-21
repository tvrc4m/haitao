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

	public static function send($mob, $content)
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
	}

}

?>