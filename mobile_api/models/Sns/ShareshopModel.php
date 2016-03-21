<?php if (!defined('ROOT_PATH')){exit('No Permission');}
/**
 * @author     Xinze <xinze@live.cn>
 */
class Sns_ShareshopModel extends Sns_Shareshop
{
	public $_shareShopUser = array('uid' => null);  //用户购物车

	/**
	 * 读取分页列表
	 *
	 * @param  int $id 主键值
	 * @return array $rows 返回的查询内容
	 * @access public
	 */
	public function getShareshopList($user_id = null, $page = 1, $rows = 100, $sort = 'desc')
	{
		//需要分页如何高效，易扩展
		$offset = $rows * ($page - 1); 
		$this->sql->setLimit($offset, $rows);

		//用户id约束where条件 user_id为空则查询ALL
		if (!empty($user_id))
		{
			$this->sql->setOrder('addtime', $sort);
			$this->_shareShopUser['uid'] = $user_id;
			$id_row = $this->getKeyByMultiCond($this->_shareShopUser);

		}
		else
		{

			$id_row = $this->selectKeyLimit();
		}

		//读取主键信息
		$total = $this->getFoundRows();
		$data_rows = array();

		if ($id_row)
		{
			$data_rows = $this->getShareshop($id_row);
		}

		$data              	= array();
		$data['page']      	= $page;
		$data['total']     	= ceil($total / $rows);  //total page
		$data['totalsize'] 	= $data['total'];
		$data['records']   	= count($data_rows);
		$data['items']     	= array_values($data_rows);

		return $data;
	}

	/**
	 * 查询店铺wjt
	 *
	 * @param  int $id 主键值
	 * @return array $rows 返回的查询内容
	 * @access public
	 */
	public function getShareshops($user_id = null, $page = 1, $rows = 100 )
	{
		
		//根据用户id=>uid 查询分页店铺列表
		$data = $this->getShareshopList($user_id, $page, $rows);

		return $data;
	}

	/**
	 * 添加店铺wjt
	 *
	 * @param  array $id 主键值
	 * @return $rows 返回inset id
	 * @access public
	 */
	public function addShareshops($field_row = null)
	{

		if (empty($field_row))
		{
			return false;

		}
		else
		{

			$rows = $this->addShareshop($field_row, true);
		}
		return $rows;
	}

	/**
	 * 删除店铺wjt
	 *
	 * @param  int $id 主键值
	 * @return array $del_flag ? 0 or 1
	 * @access public
	 */
	public function removeShareshops($shop_id = null, $user_id = null)
	{
		//==>这里$shop_id为前端传入的 店铺主键id 而非表中的shopid字段

		$this->_shareShopUser['uid'] = $user_id;
		$this->_shareShopUser['shopid'] = $shop_id;
		$id_row = $this->getKeyByMultiCond($this->_shareShopUser); //取到店铺表主键

		if ($id_row)
		{
			$del_flag = $this->removeShareshop($id_row);
			return $del_flag;

		}
		else
		{

			return false;
			
		}

		/*if (in_array($shop_id, $id_row))
		{
			$del_flag = $this->removeShareshop($shop_id);
			return $del_flag;

		}
		else
		{

			return false;
			
		}
		*/
		
	}

	/**
	 * 收藏人数查询
	 *
	 * @param  int $id 主键值
	 * @return array $del_flag ? 0 or 1
	 * @access public
	 */
	public function getShareNum($shopid)
	{
		
		if(!$shopid['shopid'])
		{
			return false;
		}
		else
		{

			$id_row = $this->getKeyByMultiCond($shopid);

			return count($id_row);
		}

	}


	/**
	 * 店铺是否收藏
	 *
	 * @param  int $id 主键值
	 * @return array $del_flag ? 0 or 1
	 * @access public
	 */
	public function isCollect($shopid = null, $user_id)
	{

		$this->_shareShopUser['uid'] 	= $user_id;
		$this->_shareShopUser['shopid'] = $shopid;
		$id_row = $this->getKeyByMultiCond($this->_shareShopUser);
		
		if ($id_row)
		{
			
			return true;

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
	public function getUserShareNum($user_id)
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