<?php
//wjt
require_once "wxlib/WxPay.Api.php";
require_once 'wxlib/log.php';

class WxpayModel extends Member
{
	function __construct()
	{
		//初始化日志 
		// $logHandler= new CLogFileHandler('paylogs/wxlog/'.date('Y-m-d').'.log');
		$logHandler= new CLogFileHandler('paylogs/wxlog.log');
		$log = wxLog::Init($logHandler, 15);
	}
	
	function sendUnifiedOrder($out_trade_no, $total_fee, $orderBody)
	{

		$input = new WxPayUnifiedOrder();
		$input->SetBody($orderBody);
		$input->SetOut_trade_no($out_trade_no);
		$input->SetTotal_fee($total_fee);
		$input->SetNotify_url(WxPayConfig::NOTIFY_URL);
		$input->SetTrade_type("APP");
		$result = WxPayApi::unifiedOrder($input);
		wxLog::DEBUG("unifiedorder:" . json_encode($result));

		if(!array_key_exists("appid", $result) ||
			 !array_key_exists("mch_id", $result) ||
			 !array_key_exists("prepay_id", $result))
		{
			$result['msg'] = "统一下单失败";
		 	return $result;
		}

		//二次签名返回给app
		$data['appid'] = WxPayConfig::APPID;
		$data['partnerid'] = WxPayConfig::MCHID;
		$data['prepayid'] = $result['prepay_id'];
		$data['package'] = "Sign=WXPay";
		$data['noncestr'] = $result['nonce_str'];
		$data['timestamp'] = ''.time();
		$data['sign'] = $this->getSign($data);
		return $data;

	}

	public function getSign($Obj)
	{
		foreach ($Obj as $k => $v)
		{
			$Parameters[$k] = $v;
		}
		//签名步骤一：按字典序排序参数
		ksort($Parameters);
		$String = $this->formatBizQueryParaMap($Parameters, false);
		//echo '【string1】'.$String.'</br>';
		//签名步骤二：在string后加入KEY
		$String = $String."&key=".WxPayConfig::KEY;
		//echo "【string2】".$String."</br>";
		//签名步骤三：MD5加密
		$String = md5($String);
		//echo "【string3】 ".$String."</br>";
		//签名步骤四：所有字符转为大写
		$result_ = strtoupper($String);
		//echo "【result】 ".$result_."</br>";
		return $result_;
	}

	/**
	 * 	作用：格式化参数，签名过程需要使用
	 */
	function formatBizQueryParaMap($paraMap, $urlencode)
	{
		$buff = "";
		ksort($paraMap);
		foreach ($paraMap as $k => $v)
		{
		    if($urlencode)
		    {
			   $v = urlencode($v);
			}
			//$buff .= strtolower($k) . "=" . $v . "&";
			$buff .= $k . "=" . $v . "&";
		}
		$reqPar;
		if (strlen($buff) > 0) 
		{
			$reqPar = substr($buff, 0, strlen($buff)-1);
		}
		return $reqPar;
	}
}


?>