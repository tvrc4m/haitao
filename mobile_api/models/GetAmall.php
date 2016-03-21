<?php
//艾猫商城接口对接wjt
class GetAmall
{	
	
	public function sendAmallUrl($str, $flag, $key)
	{
		if ($flag == 'O') //订单接口时 $str为userid
		{
			$url = 'http://www.amall360.com/app_info/apprequestorder'.$str.'.html?key='.$key;
		}
		else if($flag == 'L') //登录接口：userinfo的值；格式：'j_username=666666,j_password=123456' DES加密之后的str;
		{
			$url = 'http://www.amall360.com/app_info/apprequestinfo.html?userinfo='.$str.'&key='.$key;
		}
		else if($flag == 'R') 
		{
			$url = 'http://www.amall360.com/app_info/allArticles.html';
		}
		else if($flag == 'X') 
		{
			$url = 'http://www.amall360.com/app_info/smallCommonSense'.$str.'.html';
			
		}

		$result = $this->getAmallCurl($url);
		return $result;
	}

	/**
	 * 	作用：以GET方式提交到对应的接口url
	 */
	function getAmallCurl($url)
    {
        //初始化curl
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		$data = curl_exec($ch);
        //返回结果
        if($data)
        {
            curl_close($ch);
            return $data;
        }
        else 
        { 
            $error = curl_errno($ch);
            echo "curl出错，错误码:$error"."<br>";
            echo "<a href='http://curl.haxx.se/libcurl/c/libcurl-errors.html'>错误原因查询</a></br>";
            curl_close($ch);
            return false;
        }
    }

    
}

	// $AmallModel = new GetAmall();
	// $result = $AmallModel->sendAmallUrl("1582", "X", "");
	// var_dump($result);