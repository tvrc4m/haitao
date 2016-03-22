<?php if (!defined('ROOT_PATH')) exit('No Permission');
/**
 * @author     Xinze <xinze@live.cn>
 */
class ReturnModel extends Returns
{
	public $_return = array();
	/**
	 * 读取分页列表
	 *
	 * @param  int $id 主键值
	 * @return array $rows 返回的查询内容
	 * @access public
	 */
	public function getReturnList($id = null, $page=1, $rows=100, $sort='asc')
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
			$data_rows = $this->getReturn($id_row);
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
	 * 修改退货关闭原因
	 *
	 * @param  int $id 主键值
	 * @return array $rows 返回的查询内容
	 * @access public
	 */
	public function editReturnCreason($order_id = null, $close_reason = null)
	{
		$this->_return['order_id'] = $order_id;
		$this->_return['status']   = '1';
		$this->_return['status']   = '4';

		$id_row = $this->getKeyByMultiCond($this->_return);

		$filed = array('close_reason' => $close_reason, 'status' => '0' );
		foreach ($id_row as $key) 
		{
			$this->editReturn($key,$filed);	
		}
	}
}
?>