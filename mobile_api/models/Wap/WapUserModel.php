<?php if (!defined('ROOT_PATH')) exit('No Permission');
/**
 * @author   
 */
class Wap_WapUserModel extends Wap_WapUser
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