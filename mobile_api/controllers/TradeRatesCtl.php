<?php
/**
 *
 * 交易评价相关api
 *
 * @category   Framework
 * @package    Controller
 * @author     Xinze <xinze@live.cn>
 * @copyright  Copyright (c) 2010, 黄新泽
 * @version    1.0
 * @todo
 */
class TradeRatesCtl extends Yf_AppController
{
	public function index()
	{
		$data = array();

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


		$this->data->addBody(-140, $data, $msg, $status);
	}
}
?>
