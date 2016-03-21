<?php if (!defined('ROOT_PATH')) exit('No Permission');
/**
 * @author     Xinze <xinze@live.cn>
 */
class Product_SetmealModel extends Product_Setmeal
{

	/**
	 * 读取分页列表
	 *
	 * @param  int $id 主键值
	 * @return array $rows 返回的查询内容
	 * @access public
	 */
	public function getSetmealList($id = null, $page=1, $rows=100, $sort='asc')
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
			$data_rows = $this->getSetmeal($id_row);
		}

		$data = array();
		$data['page'] = $page;
		$data['total'] = ceil_r($total / $rows);  //total page
		$data['totalsize'] = $data['total'];
		$data['records'] = count($data_rows);
		$data['items'] = array_values($data_rows);

		return $data;
	}

	public function getSetmealByPid($pid = null)
	{
		$this->sql->setWhere('pid',$pid)->setWhere('property_value_id','','!=');
		$data = $this->getSetmeal("*");
		fb($data);
		return $data;
	}

	/**
	 * 修改规格库存
	 *
	 * @param  int $id 主键值
	 * @return array $rows 返回的查询内容
	 * @access public
	 */
	public function editSetmealStock($id = null, $stock = null)
	{
		$data = $this->getSetmeal($id);
		$field['stock'] = $data[$id]['stock'] - $stock;
		$this->editSetmeal($id,$field);
	}
}
?>