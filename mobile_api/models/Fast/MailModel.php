<?php if (!defined('ROOT_PATH')) exit('No Permission');
/**
 * @author     Xinze <xinze@live.cn>
 */
class Fast_MailModel extends Fast_Mail
{
	public $_multiCondCompany = array('company' => null);  //更具物流公司获取信息

	/**
	 * 物流公司获取信息
	 * @param string $company
	 * @return array $data_rows 物流公司数据
	 * @access public
	 */
	public function getMailByCompany($company)
	{
		//获取主键
		$this->_multiCondCompany['company'] = $company;
		$id_row = $this->getKeyByMultiCond($this->_multiCondCompany);

		$data_rows = array();

		if ($id_row)
		{
			$data_rows = $this->getMail($id_row);
		}

		return $data_rows;
	}

	/**
	 * 读取分页列表
	 *
	 * @param  int $id 主键值
	 * @return array $rows 返回的查询内容
	 * @access public
	 */
	public function getMailList($id = null, $page=1, $rows=100, $sort='asc')
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
			$data_rows = $this->getMail($id_row);
		}

		$data = array();
		$data['page'] = $page;
		$data['total'] = ceil_r($total / $rows);  //total page
		$data['totalsize'] = $data['total'];
		$data['records'] = count($data_rows);
		$data['items'] = array_values($data_rows);

		return $data;
	}
}
?>