<?php

/**
 * UC server
 */
class Uc_server
{

	protected $appid;

    protected $secret;

    protected $timestamp;

    /**
     * 请求的方法名
     * @var string
     */
    protected $action;

    protected $server;

    protected $params=array();

    public function __construct($config)
    {
        $this->secret=$config['uc_secret'];
    	$this->appid=$config['uc_appid'];
        $this->server=$config['uc_server'];
    	$this->timestamp=time();

    }
    /**
     * 向用户中心进行注册
     * @param  array $params=array('phone'=>$phone,'password'=>$password,'salt'=>$salt) 
     * @return array | boolean    
     * 验证成功返回 array('status'=>1100,'data'=>'')
     * 验证失败返回 array('status'=>int,'errmsg'=>string,'data'=>'')  
     */
    public function register($params){
        $this->action='register';
    	$result=$this->http_post($this->server,$params);
    	if($result===false){
            return false;
    	}
        return $result;
    }
    /**
     * 向用户中心验证登录和通知其他应用
     * @param  array $params=array('phone'=>$phone,'password'=>$password) 
     * @return array | boolean     
     * 验证成功返回 array('status'=>1100,'data'=>js script)
     * 验证失败返回 array('status'=>int,'errmsg'=>string,'data'=>'')
     */
    public function login($params){
        $this->action='login';
    	$result=$this->http_post($this->server,$params);
    	if($result===false){

    	}
        return $result;
    }
    /**
     * 向用户中心验证登录和通知其他应用
     * @param  array $params=array('phone'=>$phone) 
     * @return array     
     * 验证成功返回 array('status'=>1100,'data'=>js script)
     * 验证失败返回 array('status'=>int,'errmsg'=>string,'data'=>'')     
     */
    public function logout($params){
        $this->action='logout';
    	$result=$this->http_post($this->server,$params);

    	if($result===false){

    		
    	}
        return $result;
    }
    /**
     * 找回密码
     * @param  string $phone    
     * @param  string $password 
     * @return array           
     */
    public function findpwd($phone,$password){
        $this->action='findpwd';
        $result=$this->http_post($this->server,array('phone'=>$phone,'password'=>$password));

        if($result===false){
            
            
        }
        return $result;
    }
    /**
     * 更改密码
     * @param  string $phone   
     * @param  string $old_pwd 
     * @param  string $new_pwd 
     * @return array
     */
    public function changepwd($phone,$old_pwd,$new_pwd){
        $this->action='changepwd';
        $result=$this->http_post($this->server,array('phone'=>$phone,'old_pwd'=>$old_pwd,'new_pwd'=>$new_pwd));

        if($result===false){
            
            
        }
        return $result;
    }
    /**
     * 向用户中心验证登录和通知其他应用
     * @param  array $params=array('phone'=>$phone) 
     * @return array 
     * 失败 array('status'=>int,'errmsg'=>string);      
     * 成功 array('status'=>1100,'phone'=>$phone,'password'=>$password,'salt'=>$salt);      
     */
    public function userinfo($params){
        $this->action='userinfo';
        $result=$this->http_post($this->server,$params);
        if($result->status==1100){
            $timestamp=$result->data->timestamp;
            $str=$this->authcode($result->data->params,'DECODE',$this->secret);
            parse_str($str,$arr);
            if($arr['timestamp']==$timestamp && !empty($arr['phone']) && !empty($arr['password']) && !empty($arr['salt'])){
                return array_merge(array('status'=>$result->status),$arr);
            }
        }

        return array('status'=>$result->status,'errmsg'=>$result->errmsg);
    }

   	/**
     * 生成签名字符串
     * @param  array $data 需要签名的数据 
     * @return string      签名字符串
     */
    private function signature($data){

        $data['secret']=$this->secret;
        $data['appid']=$this->appid;
        $data['action']= $this->action;
        $data['timestamp']= $this->timestamp;
        
        ksort($data);
        
        $str=http_build_query($data);

        return sha1($str);
    }

    public function http_post($url, $data)
    {
        $str=http_build_query($data);
        $params=array('params'=>$this->authcode($str,'ENCODE',$this->secret));
        $params['signature']=$this->signature($data);
        $params['action']=$this->action;
        $params['appid']=$this->appid;
        $params['timestamp']=$this->timestamp;

        $curl = curl_init();
        if (stripos($url, "https://") !== FALSE) {
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
        }
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_POST, TRUE);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $params);
        $result = curl_exec($curl);
        $header = curl_getinfo($curl);
        // print_r($result);exit;
        curl_close($curl);
        if (intval($header["http_code"]) == 200) {
            return json_decode($result);
        } else {
            return false;
        }
    }

    private function authcode($string, $operation = 'DECODE', $key = '', $expiry = 0) {

        $ckey_length = 4;

        $key = md5($key ? $key : $this->secret);
        $keya = md5(substr($key, 0, 16));
        $keyb = md5(substr($key, 16, 16));
        $keyc = $ckey_length ? ($operation == 'DECODE' ? substr($string, 0, $ckey_length): substr(md5(microtime()), -$ckey_length)) : '';

        $cryptkey = $keya.md5($keya.$keyc);
        $key_length = strlen($cryptkey);

        $string = $operation == 'DECODE' ? base64_decode(substr($string, $ckey_length)) : sprintf('%010d', $expiry ? $expiry + time() : 0).substr(md5($string.$keyb), 0, 16).$string;
        $string_length = strlen($string);

        $result = '';
        $box = range(0, 255);

        $rndkey = array();
        for($i = 0; $i <= 255; $i++) {
            $rndkey[$i] = ord($cryptkey[$i % $key_length]);
        }

        for($j = $i = 0; $i < 256; $i++) {
            $j = ($j + $box[$i] + $rndkey[$i]) % 256;
            $tmp = $box[$i];
            $box[$i] = $box[$j];
            $box[$j] = $tmp;
        }

        for($a = $j = $i = 0; $i < $string_length; $i++) {
            $a = ($a + 1) % 256;
            $j = ($j + $box[$a]) % 256;
            $tmp = $box[$a];
            $box[$a] = $box[$j];
            $box[$j] = $tmp;
            $result .= chr(ord($string[$i]) ^ ($box[($box[$a] + $box[$j]) % 256]));
        }

        if($operation == 'DECODE') {
            if((substr($result, 0, 10) == 0 || substr($result, 0, 10) - time() > 0) && substr($result, 10, 16) == substr(md5(substr($result, 26).$keyb), 0, 16)) {
                return substr($result, 26);
            } else {
                return '';
            }
        } else {
            return $keyc.str_replace('=', '', base64_encode($result));
        }
    }
}