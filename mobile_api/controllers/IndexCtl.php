<?php
/**
 * jsonp
 *
 * 其它服务器回调
 *
 * @category   Framework
 * @package    Controller
 * @author     Xinze <xinze@live.cn>
 * @copyright  Copyright (c) 2010, 黄新泽
 * @version    1.0
 * @todo
 */
class IndexCtl extends Yf_AppController
{
	public function index()
	{
		$Web_Config = new Web_ConfigModel();

		$data = $Web_Config->getConfig('*');

		//$data = array();

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

	public function test()
	{
		$data = array();
		$data['status'] = 200;
		$data['msg'] = "success";
		$data['data'] = array();
		echo encode_json($data);
	}
}
?>
