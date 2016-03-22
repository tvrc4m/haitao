<?php if (!defined('ROOT_PATH')) exit('No Permission');
/**
 * @author     Xinze <xinze@live.cn>
 */
class DistrictModel extends District
{

	/**
	 *
	 * @param  int $pid 主键值
	 * @return array $rows 返回的查询内容
	 * @access public
	 */
	public function getDistrictList($pid=null, $page=1, $rows=100, $sort='asc')
	{
		
		$this->sql->setwhere('pid', $pid);
		$data_rows = $this->getDistrict('*');
		$data_rows = array_values($data_rows);

		
		return $data_rows;
	}

	/**
	 * 获取地区名称
	 * 
	 * @param  int $pid 主键值
	 * @return array $rows 返回的查询内容
	 * @access public
	 */
	public function getdistrictname($id = null)
	{
		$this->sql->setwhere('id', $id);
		$data_rows = $this->getDistrict('*');
		$name = $data_rows[$id]['name'];
		return $name;
	}

}
?>