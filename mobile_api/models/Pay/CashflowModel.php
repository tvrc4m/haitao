<?php if (!defined('ROOT_PATH')) exit('No Permission');
/**
 * @author     Xinze <xinze@live.cn>
 */
class Pay_CashflowModel extends Pay_Cashflow
{

	/**
	 * 读取分页列表
	 *
	 * @param  int $id 主键值
	 * @return array $rows 返回的查询内容
	 * @access public
	 */
	public function getCashflowList($id = null, $page=1, $rows=100, $sort='asc')
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
			$data_rows = $this->getCashflow($id_row);
		}

		$data = array();
		$data['page'] = $page;
		$data['total'] = ceil_r($total / $rows);  //total page
		$data['totalsize'] = $data['total'];
		$data['records'] = count($data_rows);
		$data['items'] = array_values($data_rows);

		return $data;
	}

	public function editOrderStatus($order_id = null, $status)
	{
		if(substr($order_id, 0,1) == "U")//合并支付订单
		{
			$this->sql->setWhere('order_id',$order_id);
			$id = $this->selectKeyLimit();  //U id
			$fie = array('statu' => -1, 'display' => 0);
			foreach ($id as $key => $value) 
			{
				$a = $this->editCashflow($value,$fie);
			}
			
			$this->sql->setWhere('order_id',$order_id)->setWhere('buyer_email','','!=');
			$extra_param = $this->getCashflow("*");
			foreach ($extra_param as $key => $value) 
			{
				$extra_param = $value['extra_param'];
			}
			$extra_param = explode(',', $extra_param);  //oid

			$this->sql->setWhere('order_id',$extra_param,'IN');
			$id_row = $this->selectKeyLimit();
			//fb($id_row);
			$field = array('statu' => 2, );
			foreach ($id_row as $key => $value) 
			{
				$b = $this->editCashflow($value,$field);
			}

			$d = $a*$b;
			fb($d);
		}
		else
		{
			$this->sql->setWhere('order_id',$order_id);
			$id = $this->selectKeyLimit();  // oid
			$fie = array('statu' => 2);
			foreach ($id as $key => $value) 
			{
				$b = $this->editCashflow($value,$fie);
			}
		}

		return $b;
	}
}
?>