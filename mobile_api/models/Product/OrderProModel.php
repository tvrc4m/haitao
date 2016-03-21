<?php if (!defined('ROOT_PATH')) exit('No Permission');
/**
 * @author     Xinze <xinze@live.cn>
 */
class Product_OrderProModel extends Product_OrderPro
{

	//$order_status=array('-1'=>'已删除','1'=>'等待买家付款','2'=>'买家已付款','3'=>'卖家已发货','4'=>'交易成功','5'=>'退款中','6'=>'退款成功','0'=>'交易关闭');
	//$order_product_status=array('-1'=>'交易关闭','0'=>'未付款','1'=>'未发货','2'=>'已发货','3'=>'已确认收货','4'=>'退款中','5'=>'退款成功');
	public $_prorder = array();
	/**
	 * 读取分页列表
	 *
	 * @param  int $id 主键值
	 * @return array $rows 返回的查询内容
	 * @access public
	 */
	public function getOrderProList($id = null, $page=1, $rows=100, $sort='asc')
	{
		//需要分页如何高效，易扩展
		$offset = $rows * ($page - 1);

		$this->sql->setLimit($offset, $rows);

		$id_row = array();
		$id_row = $this->selectKeyLimit();

		//读取主键信息
		$total = $this->getFoundRows();

		$data_rows = array();

		if ($id_row)
		{
			$data_rows = $this->getOrderPro($id_row);
		}

		$data = array();
		$data['page'] = $page;
		$data['total'] = ceil_r($total / $rows);  //total page
		$data['totalsize'] = $data['total'];
		$data['records'] = count($data_rows);
		$data['items'] = array_values($data_rows);

		return $data;
	}

	/**
	 * 获取订单商品列表操作
	 * @param int $id
	 * @return bool $del_flag 是否成功
	 * @access public
	 */
	public function getOrderProByOid($order_id = null, $status = null, $page = 1, $rows = 20)
	{
		//分销问题
		if(null != $status)
		{
		}else{
			$this->sql->setwhere('order_id',$order_id);
			$goods_rows = $this->getOrderPro("*");

			foreach ($goods_rows as $key => $val) {
				$spec_value = $val['spec_value'] ? explode(',',$val['spec_value']) : "";
				$spec_name = $val['spec_name'] ? explode(',',$val['spec_name']) : "";
				
				if($spec_name && $spec_value)
				{
					foreach($spec_value as $k => $v)
					{
						$goods_rows[$key]['spec'][] = $spec_name[$k].":".$v;	
					}	
			}

				return $goods_rows;
				
			}
		}
	}

	/**
	 * 按照商品名称获取订单商品列表操作
	 * @param int $id
	 * @return bool $del_flag 是否成功
	 * @access public
	 */
	public function getOrderProByName($name = null ,$userid = null)
	{
			$order_row = array();
			$this->sql->setwhere('name','%'.$name.'%','LIKE')->setwhere('buyer_id',$userid);
			$goods_rows = $this->getOrderPro("*");
			foreach ($goods_rows as $key => $value) 
			{
				$order_row[] = $value['order_id'];
			}

			return $order_row;
	}

	/**
	 * 修改订单商品退货理由列表操作
	 * @param int $id
	 * @return bool $del_flag 是否成功
	 * @access public
	 */
	public function editOrderReason($order_id = null, $reason = null)
	{
		//获取主键
		$this->_prorder['order_id'] = $order_id;
		$id_row = $this->getKeyByMultiCond($this->_prorder);

		fb($id_row);
		$fild['reason'] = $reason;
		
		foreach ($id_row as $key) {
			$this->editOrderPro($key,$fild);
		}
		
	}

	/**
	 * 修改订单商品状态操作
	 * @param int $id
	 * @return bool $del_flag 是否成功
	 * @access public
	 */
	public function editOrderProStatus($order_id = null, $status = null, $product_id = null)
	{
		$status = $status - 1;
		if($product_id)
		{
			$this->_prorder['id'] = $product_id;
		}
		//获取主键
		$this->_prorder['order_id'] = $order_id;
		$id_row = $this->getKeyByMultiCond($this->_prorder);

		
		$goods_rows=$this->getOrderPro($id_row);
		
		$filed = array('status' => $status , );
		fb($filed);
		foreach ($goods_rows as $val) {

			if($val['status'] != '5')
			{
				$res = $this->editOrderPro($val['id'],$filed);
			}
		

			switch ($val['status']) {
				case '3':
				{
					$close_reason = '因您确认收货，退款关闭。';
					break;
				}
				case "2":
				{
					$close_reason = '因卖家发货，导致退款关闭，如仍需退款，您可以重新发起申请。';
					break;
				}
				default:
				{	
					$close_reason = '';
					break;
				}
			}

			if($close_reason)
			{
				return $close_reason;
			}
		}

		return $res;
	}
}
?>