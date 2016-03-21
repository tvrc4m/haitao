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
class DistrictCtl extends Yf_AppController
{
	public function get()
	{
		$pid = request_int('pid');
		
		$DistrictModel = new DistrictModel();
		//$data = array();
		$data = $DistrictModel->getDistrictList($pid);
		
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
