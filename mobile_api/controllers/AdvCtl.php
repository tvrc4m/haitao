<?php
/**
 *
 * 广告相关
 *
 * @category   Framework
 * @package    Controller
 * @author     Xinze <xinze@live.cn>
 * @copyright  Copyright (c) 2010, 黄新泽
 * @version    1.0
 * @todo
 */
class AdvCtl extends Yf_AppController
{
	public function slide()
	{	
		//广告表信息
		//$group_id           = request_int('group_id');
		$Advs_ContentsModel = new Advs_ContentsModel();
		$data               = $Advs_ContentsModel->getSlideAdv($group_id = 13);

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
