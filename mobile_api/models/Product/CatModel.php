<?php if (!defined('ROOT_PATH')) exit('No Permission');

/**
 * @author     Xinze <xinze@live.cn>
 */
class Product_CatModel extends Product_Cat
{

	/**
	 * 取得分类及子类信息
	 *
	 * @param  int $catid 主键值
	 * @param  bool $flag 是否返回子类
	 * @return array $rows 返回的查询内容
	 * @access public
	 */
	public function getCatDetailRows($catid = null, $flag = false, $cat_rows = null)
	{
		if (!$cat_rows)
		{
			$cat_rows = $this->getCatChild($catid);
		}

		//子分类
		if ($cat_rows && $flag)
		{
			foreach ($cat_rows as $k => $cat_row)
			{
				//类别下面的子分类
				$child_cat_rows = $this->getCatChild($cat_row['catid']);

				//$cat_rows[$k]['scat']    = $child_cat_rows;

				foreach ($child_cat_rows as $key => $child_cat_row)
				{
					$third_cat_rows                  = $this->getCatChild($child_cat_row['catid']);
					$child_cat_rows[$key]['sub_cat'] = $third_cat_rows;
				}

				$cat_rows[$k]['sub_cat'] = $child_cat_rows;
			}
		}

		return $cat_rows;
	}

	/**
	 * 取得子类信息
	 *
	 * @param  int $catid 主键值
	 * @return array $rows 返回的查询内容
	 * @access public
	 */
	public function getCatChild($catid = null)
	{
		$child_cat_rows = array();

		// 第一级别
		if (0 === $catid || '0' === $catid)
		{
			$this->sql->setWhere('catid', 9999, '<');
		}
		else
		{
			//类别下面的子分类
			$s = $catid . "00";
			$b = $catid . "99";

			$this->sql->setWhere('catid', $s, '>');
			$this->sql->setWhere('catid', $b, '<');
		}


		$child_cat_rows = $this->getCat('*');

		return $child_cat_rows;
	}

	/**
	 * 读取分页列表
	 *
	 * @param  int $catid 主键值
	 * @return array $rows 返回的查询内容
	 * @access public
	 */
	public function getCatList($catid = null, $page = 1, $rows = 100, $sort = 'asc')
	{
		//需要分页如何高效，易扩展
		$offset = $rows * ($page - 1);

		$this->sql->setLimit($offset, $rows);

		$catid_row = array();
		$catid_row = $this->selectKeyLimit();

		//读取主键信息
		$total = $this->getFoundRows();

		$data_rows = array();

		if ($catid_row)
		{
			$data_rows = $this->getCat($catid_row);
		}

		$data              = array();
		$data['page']      = $page;
		$data['total']     = ceil_r($total / $rows);  //total page
		$data['totalsize'] = $data['total'];
		$data['records']   = count($data_rows);
		$data['items']     = array_values($data_rows);

		return $data;
	}
}

?>