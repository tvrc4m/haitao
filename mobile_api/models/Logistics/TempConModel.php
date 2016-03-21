<?php if (!defined('ROOT_PATH')) exit('No Permission');
/**
 * @author     Xinze <xinze@live.cn>
 */
class Logistics_TempConModel extends Logistics_TempCon
{

	/**
	 * 读取分页列表
	 *
	 * @param  int $id 主键值
	 * @return array $rows 返回的查询内容
	 * @access public
	 */
	public function getTempConList($id = null, $page=1, $rows=100, $sort='asc')
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
			$data_rows = $this->getTempCon($id_row);
		}

		$data = array();
		$data['page'] = $page;
		$data['total'] = ceil_r($total / $rows);  //total page
		$data['totalsize'] = $data['total'];
		$data['records'] = count($data_rows);
		$data['items'] = array_values($data_rows);

		return $data;
	}

	public function getTempConByType($lgid = null,$city = null,$type = null,$unit = null,$num = null)
	{
		$this->sql->setwhere('temp_id',$lgid)->setwhere('define_citys','%'.$city.'%','LIKE')->setwhere('logistics_type',$type);
		$data = $this->getTempCon("*");
		
		if(empty($data))
		{
			$this->sql->setwhere('temp_id',$lgid)->setwhere('define_citys','default')->setwhere('logistics_type',$type);
			$data = $this->getTempCon("*");
		}
		fb($data);
		$re = array();
		$price = '';
		foreach ($data as $key => $value) {
			$re = $value;
		}
		if ($re)
		{
			if ($unit == '件')
			{
				if ($num <= $re['default_num'])
				{
					$price = $re['default_price'];
				}
				else
				{
					$price = $re['default_price'] + ceil(($num - $re['default_num']) / $re['add_num']) * $re['add_price'];
				}
			}

			if ($unit == 'kg')
			{
				if ($weight <= $re['default_num'])
				{
					$price = $re['default_price'];
				}
				else
				{
					$price = $re['default_price'] + ceil(($weight - $re['default_num']) / $re['add_num']) * $re['add_price'];
				}
			}

			if ($unit == 'm³')
			{
				if ($cubage <= $re['default_num'])
				{
					$price = $re['default_price'];
				}
				else
				{
					$price = $re['default_price'] + ceil(($cubage - $re['default_num']) / $re['add_num']) * $re['add_price'];
				}
			}
			
		}
		fb($price);
		return $price ? $price : '0';
	}
}
?>