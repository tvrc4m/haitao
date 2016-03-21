<?php

/** 
 * 微信app支付
 * @author 
 * @copyright 
 */
class WxPaynotifyCtl extends Yf_AppController
{
	public function setWxNotify()
	{

		$WxPaynotifyModel = new notify();		
		$data = $WxPaynotifyModel->Handle(false);
	}
}
?>
