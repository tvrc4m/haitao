<?php
/**
 *
 * 支付方式
 *
 * @category   Framework
 * @package    Controller
 * @author     Xinze <xinze@live.cn>
 * @copyright  Copyright (c) 2010, 黄新泽
 * @version    1.0
 * @todo
 */
class PayMethodCtl extends Yf_AppController
{
	/**
	 * 获取支付方式
	 * @param  shop_id_row  详情门店id
	 * @param  int 			user_id 登录用户id
	 * @param  string 		key 	登录用户key
	 * @return array 		$rows 	返回的查询内容
	 * @access public
	 */
	public function getTypeList()
	{

		$page 	 = request_int('page');  
		$lenght_rows = request_int('lenght');  
		
		$PayTypeModel = new Pay_TypeModel();
		$data = $PayTypeModel->getTypeList($page, $lenght_rows);

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