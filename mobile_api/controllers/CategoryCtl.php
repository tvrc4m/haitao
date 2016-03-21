<?php

/**
 * 商品分类信息
 *
 * @category   Framework
 * @package    Controller
 * @author     Xinze <xinze@live.cn>
 * @copyright  Copyright (c) 2015, 黄新泽
 * @version    1.0
 * @todo
 */
class CategoryCtl extends Yf_AppController
{
	public function hot()
	{
		$Web_Config = new Web_ConfigModel();

		$data = $Web_Config->getIndexCatIdConfig();

		//$data = array();

		if (true)
		{
			$msg    = 'success';
			$status = 200;
		}
		else
		{
			$msg    = 'failure';
			$status = 250;
		}


		$this->data->addBody(-140, $data, $msg, $status);
	}


	public function getItem()
	{
		$parent_id = request_int('pid');
		$flag = request_int('flag', 0);

		$Product_CatModel = new Product_CatModel();
		$cat_rows         = $Product_CatModel->getCatDetailRows($parent_id, $flag);


		$data = $cat_rows;

		if (true)
		{
			$msg    = 'success';
			$status = 200;
		}
		else
		{
			$msg    = 'failure';
			$status = 250;
		}


		$this->data->addBody(-140, $data, $msg, $status);
	}
}

?>
