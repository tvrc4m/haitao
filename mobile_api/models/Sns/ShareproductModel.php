<?php if (!defined('ROOT_PATH')){exit('No Permission');}
/**
 * @author     Xinze <xinze@live.cn>
 */
class Sns_ShareproductModel extends Sns_Shareproduct
{
	public $_goodsUser = array('uid' => null);  //用户购物车

	/**
	 * 读取分页列表
	 *
	 * @param  int $id 主键值
	 * @return array $rows 返回的查询内容
	 * @access public
	 */
	public function getShareproductList($user_id = null, $page = 1, $rows = 100, $sort = 'asc')
	{
		//需要分页如何高效，易扩展
		$offset = $rows * ($page - 1);

		$this->sql->setLimit($offset, $rows);

		$this->_goodsUser['uid'] = $user_id;
		$id_row = $this->getKeyByMultiCond($this->_goodsUser);

		//读取主键信息
		$total = $this->getFoundRows();

		$data_rows = array();

		if ($id_row)
		{
			$data_rows = $this->getShareproduct($id_row);
		}

		$data              = array();
		$data['page']      = $page;
		$data['total']     = ceil_r($total / $rows);  //total page
		$data['totalsize'] = $data['total'];
		$data['records']   = count($data_rows);
		$data['items']     = array_values($data_rows);

		return $data;
	}
	
	/**
	 * 添加商品
	 *
	 * @param  int $id 主键值
	 * @return $field_rows 返回添加商品的信息
	 * @access public
	 */
	public function addShareproducts($field_row)   //定义添加商品函数addShareproducts
	{
		
		if (!empty($field_row))
		{

			$data_rows = $this->addShareproduct($field_row, true);    //调用父类Shareproduct中addShareproduct方法
		}
		//print_r ($field_row);
		return $data_rows;
	}
	
	/**
	 * 删除商品
	 *
	 * @param  int $id 主键值
	 * @return
	 * @access public
	 */
	public function removeShareproducts($id = null, $user_id)
	{
		$this->_goodsUser['uid'] = $user_id;
		$id_row                  = $this->getKeyByMultiCond($this->_goodsUser);

		if (is_array($id))
		{
			//批量删除
			$flag = 0;
			$len  = count($id);
			for ($i = 0; $i < $len; $i++)
			{
				if (in_array($id[$i], $id_row))
				{
					$flag++;
				}
			}

			if ($flag == $len)
			{
				
				$data_rows = $this->removeShareproduct($id);
				return $data_rows;
			}
			else
			{
				return false;
			}
			
		}
		else
		{
			//单个删除
			if (in_array($id, $id_row))
			{
				$data_rows = $this->removeShareproduct($id);
				return $data_rows;

			}
			else
			{
				return false;
			}
		}
		
	}

	/**
	 * 是否关注按钮
	 *
	 * @param  int $id 主键值
	 * @return
	 * @access public
	 */
	public function isCollect($id = null, $user_id)
	{
		$this->_goodsUser['uid'] = $user_id;
		$this->_goodsUser['pid'] = $id;
		$id_row = $this->getKeyByMultiCond($this->_goodsUser);

		if (!empty($id_row))
		{
			
			return $id_row;

		}
		else
		{
			return false;
		}


	}

	/**
	 * 用户关注数目
	 *
	 * @param  int $id 主键值
	 * @return array $del_flag ? 0 or 1
	 * @access public
	 */
	public function getUserShareNums($user_id)
	{
		
		if(!$user_id['uid'])
		{
			return false;
		}
		else
		{

			$id_row = $this->getKeyByMultiCond($user_id);
			return count($id_row);
		}

	}


}

?>