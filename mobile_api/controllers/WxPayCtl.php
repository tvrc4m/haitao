<?php

/** 
 * 微信app支付
 * @author 
 * @copyright 
 */
class WxPayCtl extends Yf_AppController
{
	public function sendOrder()
	{

		$out_trade_no  	= request_string('out_trade_no');	//商品描述
		$total_fee  	= request_int('total_fee');		//总金额
		$orderBody		= request_string('orderBody');	//商品描述
		if (empty($orderBody))	 {
			$orderBody = '支付测试';
		}
		$wxPaymodel = new WxpayModel();
		$result = $wxPaymodel->sendUnifiedOrder($out_trade_no, $total_fee, $orderBody);

		$data = array();
		if (!empty($result['msg']))
		{

			$msg = $result['msg'];
			$status = 250;
			$this->data->addBody(-140, $data, $msg, $status);
		}
	
		if (true)
		{
			$msg = 'success';
			$status = 200;
		}
		else
		{
			$msg = 'failure';
			$status = 250;
		}


		$this->data->addBody(-140, $result, $msg, $status);
	}
}
?>
