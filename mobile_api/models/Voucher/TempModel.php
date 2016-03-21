<?php if (!defined('ROOT_PATH')) exit('No Permission');
/**
 * @author     Xinze <xinze@live.cn>
 */
class Voucher_TempModel extends Voucher_Temp
{

	/**
	 * 读取分页列表
	 *
	 * @param  int $id 主键值
	 * @return array $rows 返回的查询内容
	 * @access public
	 */
	public function getTempList($id = null, $page=1, $rows=100, $sort='asc')
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
			$data_rows = $this->getTemp($id_row);
		}

		$data = array();
		$data['page'] = $page;
		$data['total'] = ceil_r($total / $rows);  //total page
		$data['totalsize'] = $data['total'];
		$data['records'] = count($data_rows);
		$data['items'] = array_values($data_rows);

		return $data;
	}

	public function editVoucherTempUsed($id = null)
	{
		$data  = $this->getTemp($id);
		$used  = $data[$id]['used']*1 + 1;
		$field = array('used' => $used );

		$this->editTemp($id,$field);
	}



	/**
	 * 读取分页列表
	 *
	 * @param  int $id 主键值
	 * @return array $rows 返回的查询内容
	 * @access public
	 */
	public function getVoucherTempByShopId($shop_id, $status = null)
	{
		$data_rows = array();

		if ($status)
		{
			$this->sql->setwhere('status', $status);
		}

		$this->sql->setwhere('shop_id', $shop_id);

		$data_rows = $this->getTemp('*');

		return $data_rows;
	}


}
?>