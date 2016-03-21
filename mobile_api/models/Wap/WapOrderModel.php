<?php if (!defined('ROOT_PATH')) exit('No Permission');
/**
 * @author   
 */
class Wap_WapOrderModel extends Wap_WapOrder
{

	/**
	 * 读取user
	 *
	 * @param  int $id 主键值
	 * @return array $rows 返回的查询内容
	 * @access public
	 */
	public function getmininfo($category = null, $member_id = null)
	{
		$where = array();

		if (empty($member_id))
		{
			return false;
		}
		else if(empty($category))
		{
			$where['member_id'] = $member_id;
			$id_row = $this->getKeyByMultiCond($where);

		}
		else
		{

			$where['category'] = $category;
			$where['member_id'] = $member_id;

			$id_row = $this->getKeyByMultiCond($where);
		}

		//读取主键信息
		$total = $this->getFoundRows();
		$data_rows = array();

		if ($id_row)
		{
			$data_rows = $this->getSuser($id_row);
		}

		$data = array();			//去掉键
		$data = array_values($data_rows);
		
		return $data[0];
	}

	/**
	 * add订单
	 *
	 * @param  array $id 主键值
	 * @return $rows 返回inset id
	 * @access public
	 */
	public function addOrders($field_row = null)
	{

		if (empty($field_row))
		{
			return false;

		}
		else
		{

			$rows = $this->addOrder($field_row, false);
		}
		return $rows;
	}


	/**
	 * get订单
	 *
	 * @param  array $id 主键值
	 * @return $rows 返回inset id
	 * @access public
	 */
	public function getOrders($flag = null, $member_id = null)
	{
	
		$data = $this->getOrdersList($flag, $member_id);

		return $data;
	}

	/**
	 * 读取分页列表
	 *
	 * @param  int $id 主键值
	 * @return array $rows 返回的查询内容
	 * @access public
	 */
	public function getOrdersList($flag = null, $member_id = null, $page = 1, $rows = 100, $sort = 'desc')
	{
		//需要分页如何高效，易扩展
		$offset = $rows * ($page - 1); 
		$this->sql->setLimit($offset, $rows);

		$this->sql->setwhere($flag,$member_id);
		$this->sql->setOrder('uptime','desc');

		$id_row = $this->selectKeyLimit();

		//读取主键信息
		$total = $this->getFoundRows();
		$data_rows = array();

		if ($id_row)
		{
			$data_rows = $this->getOrder($id_row);
		}

		$data = array();
		$data['page']      	= $page;
		$data['total']     	= ceil($total / $rows);  //total page
		$data['totalsize'] 	= $data['total'];
		$data['records']   	= count($data_rows);
		$data['items']     	= array_values($data_rows);

		return $data;
	}

}
?>