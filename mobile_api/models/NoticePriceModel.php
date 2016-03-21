<?php if (!defined('ROOT_PATH')) exit('No Permission');
/**
 * @author     Xinze <xinze@live.cn>
 */
class NoticePriceModel extends NoticePrice
{	
	/**
	 * 写入降价通知
	 *
	 * @param  int $id 主键值
	 * @return $field_rows 返回添加商品的信息
	 * @access public
	 */
	public function addNoticePrice($field_row)
	{
		if (!empty($field_row))
		{

			$data_rows = $this->addNoticePrice($field_row, true);    //调用父类Shareproduct中addShareproduct方法
		}
		return $data_rows;
	}

	/**
	 * 查询降价通知
	 * @param int $member_id 用户id
	 * @param int $product_id 商品id
	 * @param float $notice_price 降价价格
	 * @return $data_rows 返回的查询内容
	 * @access public
	*/
	public function getNoticePrice($user_id,$product_id)
	{
		$this->sql->setwhere('member_id',$user_id)->setwhere('product_id',$product_id);
				
		$data_row = $this->getNoticePrices('*', false);
		$data_rows = (key(($data_row))); //获取主键
		return $data_rows;
	}

	/**
	 * 更新降价通知(暂时不用此方法)
	 * @param int $member_id 用户id
	 * @param int $product_id 商品id
	 * @param float $notice_price 降价价格
	 * @return $data_rows 返回的查询内容
	 * @access public
	*/
	public function editNoticePrice($user_id=null,$product_id=null)
	{
		$this->sql->setwhere('member_id',$user_id)->setwhere('product_id',$product_id);
		$data_row = $this->editNoticePriceSingleField('*',false);	
		return $data_row; 
	}
}
?>