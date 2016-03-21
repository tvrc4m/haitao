<?php

/**
 *
 * 商品相关
 *
 * @category   Framework
 * @package    Controller
 * @author     Xinze <xinze@live.cn>
 * @copyright  Copyright (c) 2010, 黄新泽
 * @version    1.0
 * @todo
 */
class NoticePriceCtl extends Yf_AppController
{
	/**
	 * 降价通知
	 * @param int $select_data 查询返回的主键
	 * @return array $rows 返回的查询内容
	 * @access public
	 */
	public function add()
	{
		$user_id  = Perm::$userId;
		$user_id = request_int('member_id');
		$product_id = request_int('product_id');
		$notice_price = request_int('notice_price');
		$notice_price_time = date('Y-m-d H:i:s',time());
		// 先查询数据库中是否有信息(再判断)
		$NoticePriceModel = new NoticePriceModel();
		$select_data = $NoticePriceModel->getNoticePrice($user_id,$product_id);
		//写入表内的信息
		$field_row = array();
		$field_row['member_id'] = $user_id;
		$field_row['product_id'] = $product_id;
		$field_row['notice_price'] = $notice_price;
		$field_row['notice_price_time'] =  $notice_price_time;
		if (!$select_data)
		{
			//写入降价通知表
			$NoticePrice = new NoticePrice;		
			$data = $NoticePrice->addNoticePrice($field_row);
			if ($data == 1)
			{
				$msg		= 'success';
				$status	= 200;
			}
			else
			{
				$msg    = 'failure';
				$status = 250;
			}
			$arr = array();
			$this->data->addBody(-140, $arr, $msg, $status);
		}
		else
		{
			// 更新降价通知信息
			$NoticePrice = new NoticePrice;
			$data = $NoticePrice->editNoticePrice($select_data,$field_row);
			if ($data == 1)
			{
				$msg		= 'success';
				$status	= 200;
			}
			else
			{
				$msg    = 'failure';
				$status = 250;
			}
			$arr = array();
			$this->data->addBody(-140, $arr, $msg, $status);
		}
	
	}
}

?>
