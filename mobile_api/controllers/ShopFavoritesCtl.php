<?php
/**
 *
 * 店铺收藏相关api
 *
 * @category   Framework
 * @package    Controller
 * @author     Xinze <xinze@live.cn>
 * @copyright  Copyright (c) 2010, 黄新泽
 * @version    1.0
 * @todo
 */
class ShopFavoritesCtl extends Yf_AppController
{
	/**
	 * 收藏的店铺
	 * @param  shop_id_row  详情门店id
	 * @param  int 			user_id 登录用户id
	 * @param  string 		key 	登录用户key
	 * @return array 		$rows 	返回的查询内容
	 * @access public
	 */
	public function get()
	{
		$user_id = Perm::$userId;
		$page 	 = request_int('page');  
		$lenght_rows = request_int('lenght');

		$ShareshopModel = new Sns_ShareshopModel();
		$data = $ShareshopModel->getShareshops($user_id, $page, $lenght_rows);

		$shop_id_rows = array();
		$shopid = array();
		foreach ($data['items'] as $key => $val) 
		{
			$shop_id_rows[] = $val['shopid'];
			$shopid['shopid'] = $val['shopid'];
			$collect_count[$key] = $ShareshopModel->getShareNum($shopid);
		}

		//查询门店表详情
		$Shopmodel = new ShopModel();
		$shopData  = $Shopmodel->getShop($shop_id_rows);
		foreach ($shop_id_rows as $key => $val) //=>取出 门店图片、关注人数
		{

			$data['items'][$key]['picshop'] = $shopData[$val]['logo'];
			$data['items'][$key]['collect'] = $collect_count[$key];
		}

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

	/**
	 * 添加商铺
	 * @param  int 		user_id 登录用户id
	 * @param  int 		shop_id 店铺id
	 * @return array 	$rows 	返回结果1 or 0
	 * @access public
	 */
	public function add()
	{
		// $user_key = request_int('key');
		$user_id = Perm::$userId;
		$shop_id = request_int('shop_id');
		$user_name = request_string('user_name');

		//验证
		$Sns_Shareshop = new Sns_ShareshopModel();
		$isCollResul = $Sns_Shareshop->isCollect($shop_id, $user_id);
		
		$arr = array(); //这里不是数组会输出 250
		if ($isCollResul) {

			$arr['msg'] = 'Already collected!!!';
			$msg        = 'success';
			$status     = 222;
		}
		else
			{
			//获取商铺详情
			// $field_row = $_REQUEST['field_row'];
			$Shopmodel = new ShopModel();
			$shopData  = $Shopmodel->getShop($shop_id);

			$field_row = array();  //定义写入的门店array
			$field_row['shopid'] 	= $shop_id;
			$field_row['shopname'] 	= $shopData[$shop_id]['company'];
			$field_row['uid'] 		= $user_id;
			$field_row['uname'] 	= $user_name;
			$field_row['content']	= null;
			$field_row['addtime'] 	= time();
			$data = $Sns_Shareshop->addShareshops($field_row);			

			if ($data)
			{
				$arr['addshopid'] = $data;
				$msg              = 'success';
				$status           = 200;
			}
			else
			{
				$msg    = 'failure';
				$status = 250;
			}
		}

		$this->data->addBody(-140, $arr, $msg, $status);
		
	}

	/**
	 * 删除商铺
	 *
	 * @return array $rows 返回结果1 or 0
	 * @access public
	 */
	public function remove()
	{
		$user_id = Perm::$userId;
		$shop_id = request_int('id');

		$Sns_Shareshop = new Sns_ShareshopModel();
		$data          = $Sns_Shareshop->removeShareshops($shop_id, $user_id);

		$arr = array();

		if ($data)
		{
			$arr['remove_status'] = $data;
			$msg                  = 'success';
			$status               = 200;
		}
		else
		{
			$msg    = 'failure';
			$status = 250;
		}

		$this->data->addBody(-140, $arr, $msg, $status);
		
	}

	/**
	 * 店铺收藏总人数
	 *
	 * @return array $rows 返回结果1 or 0
	 * @access public
	 */
	public function getShareNum()
	{

		$shopid['shopid'] = request_int('shop_id');

		$ShareshopModel = new Sns_ShareshopModel();
		$data = $ShareshopModel->getShareNum($shopid);

		$arr = array();

		if ($data)
		{
			$arr['count'] = $data;
			$msg    = 'success';
			$status = 200;
		}
		else
		{
			$msg    = 'failure';
			$status = 250;
		}

		$this->data->addBody(-140, $arr, $msg, $status);

	}

	/**
	 * 是否收藏
	 *
	 * @return array $rows 返回结果1 or 0
	 * @access public
	 */
	public function isCollect()
	{

		$user_id = Perm::$userId;
		$shop_id = request_int('shop_id');

		$isCollectModel = new Sns_ShareshopModel();
		$data = $isCollectModel->isCollect($shop_id, $user_id);

		$arr = array();

		if ($data)
		{
			$arr['count'] = $data;
			$msg    = 'success';
			$status = 200;
		}
		else
		{
			$msg    = 'failure';
			$status = 250;
		}

		$this->data->addBody(-140, $arr, $msg, $status);

	}

	/**
	 * 用户关注数目
	 *
	 * @return array $rows 返回结果1 or 0
	 * @access public
	 */
	public function getUserShareNum()
	{

		$user_id['uid'] = Perm::$userId;

		$UserShareNumModel = new Sns_ShareshopModel();
		$data = $UserShareNumModel->getUserShareNum($user_id);

		$arr = array();

		if ($data)
		{
			$arr['count'] = $data;
			$msg    = 'success';
			$status = 200;
		}
		else
		{
			$msg    = 'failure';
			$status = 250;
		}

		$this->data->addBody(-140, $arr, $msg, $status);

	}


}

?>
