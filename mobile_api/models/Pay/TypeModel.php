<?php if (!defined('ROOT_PATH')) exit('No Permission');
/**
 * @author     Xinze <xinze@live.cn>
 */
class Pay_TypeModel extends Pay_Type
{
	public $_paymember = array();
	/**
	 * 读取分页列表
	 *
	 * @param  int $payment_id 主键值
	 * @return array $rows 返回的查询内容
	 * @access public
	 */
	public function getTypeList($page=1, $rows=100, $sort='asc')
	{
		
		//需要分页如何高效，易扩展
		if($rows > 0)		//传负值返回所有
		{
			$offset = $rows * ($page - 1);
			$this->sql->setLimit($offset, $rows);
		}

		$payment_id_row = array();
		$payment_id_row = $this->selectKeyLimit();

		//读取主键信息
		$total = $this->getFoundRows();

		$data_rows = array();

		if ($payment_id_row)
		{
			$data_rows = $this->getType($payment_id_row);
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
	 * 确认支付密码
	 *
	 * @param  int $payment_id 主键值
	 * @return array $rows 返回的查询内容
	 * @access public
	 */
/*	public function getPayPass($tmpPwd = null, $userid = null)
	{
		$this->_paymember['pay_pass'] = $tmpPwd;
		$this->_paymember['userid'] = $userid;
		$id_row = $this->getKeyByMultiCond($this->_paymember);

		return $id_row;
	}*/


}
?>