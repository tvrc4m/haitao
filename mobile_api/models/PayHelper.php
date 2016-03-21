<?php

class PayHelper
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
			$re  = file_get_contents($url);
			return $re;
		}
	}

	public static function getMemberUrl($post, $return = true)
	{
		$config = Yf_Registry::get('config');

		$post['auth'] = md5($config['authkey']);
		$str          = http_build_query($post);

		if (empty($return))
		{
			header("Location: {$config['pay_url']}/api/member.php?" . $str);
		}
		else
		{
			$url = "{$config['pay_url']}/api/member.php?" . $str;

			fb($url);
			$re  = file_get_contents($url);
			return $re;
		}
	}


	public static function updatePayMemberLogo($post)
	{
		$config = Yf_Registry::get('config');

		$post['auth'] = md5($config['authkey']);
		$str          = http_build_query($post);

		$url = "{$config['pay_url']}/api/update_logo.php?" . $str;
		fb($url);
		$re  = file_get_contents($url);

		return $re;
	}
}

?>