<?php if (!defined('ROOT_PATH')) exit('No Permission');
/**
 * @author     Xinze <xinze@live.cn>
 */
class Delivery_AddressModel extends Delivery_Address
{

	public $_multiCondUserAddress = array('userid' => null);  //用户购物车

	/**
	 * 读取分页列表
	 *
	 * @param  int $id 主键值
	 * @return array $rows 返回的查询内容
	 * @access public
	 */
	public function getAddressList($user_id = null, $page=1, $rows=100, $isdefault=0, $sort='asc')
	{
		//需要分页如何高效，易扩展
		if($rows > 0)		//传负值返回该用户所有数据
		{
			$offset = $rows * ($page - 1);
			$this->sql->setLimit($offset, $rows);
		}
		
		//用户id约束where条件 user_id为空则查询ALL
		if(!empty($user_id))
		{
			//取出之前的默认地址
			if ($isdefault == 1) {
				$this->_shareShopUser['`default`'] = $isdefault;
			}

			$this->_shareShopUser['userid'] = $user_id;
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
			$data_rows = $this->getAddress($id_row);
		}

		$data = array();
		$data['page'] = $page;
		if($total == 0 || $rows == 0){
			$data['total'] = 0;
		}else {
			$data['total'] = ceil_r($total / $rows);  //total page
		}

		$data['totalsize'] = $data['total'];
		$data['records'] = count($data_rows);
		$data['items'] = array_values($data_rows);

		return $data;
	}

	/**
	 * 写入地址
	 *
	 * @param  array $id 主键值
	 * @return $rows 返回inset id
	 * @access public
	 */
	public function addUserAddress($field_row = null)
	{

		if (empty($field_row))
		{

			return false;
		}
		else
		{

			$rows = $this->addAddress($field_row, true);
		}

		return $rows;
	}

	/**
	 * 修改用户地址
	 *
	 * @param int $id
	 * @return bool $del_flag 是否成功
	 * @access public
	 */
	public function editUserAddress($id, $field_row, $user_id = null)
	{		
		$flag = false;		

		if ($user_id)
		{
			$this->_shareShopUser['userid'] = $user_id;
			$id_row = $this->getKeyByMultiCond($this->_shareShopUser);
			if (in_array($id, $id_row))
			{

				$flag = $this->editAddress($id, $field_row);
			}
		}

		return $flag;
	}

	/**
	 * 删除地址
	 * @param  int $addr_id 地址主键值
	 * @return array $del_flag ? 0 or 1
	 * @access public
	 */
	public function removeUserAddress($addr_id = null, $user_id = null)
	{

		$this->_shareShopUser['userid'] = $user_id;
		$id_row = $this->getKeyByMultiCond($this->_shareShopUser);

		if(in_array($addr_id,$id_row))
		{

			$del_flag = $this->removeAddress($addr_id);					
			return $del_flag;

		}
		else
		{
			return false;			
		}
		
	}

	/**
	 * 默认地址
	 *
	 * @param int $id
	 * @return bool $del_flag 是否成功
	 * @access public
	 */
	public function setdefaultAddr($id, $user_id = null)
	{		
		$flag = false;		

		if ($user_id)
		{
			$this->_shareShopUser['userid'] = $user_id;
			$id_row = $this->getKeyByMultiCond($this->_shareShopUser);

			if (in_array($id, $id_row))
			{

				$flag = $this->editAddress($id, $field_row);
			}
		}

		return $flag;
	}
	/**
	 * 修改前默认地址
	 *
	 * @param int $id
	 * @return bool $del_flag 是否成功
	 * @access public
	 */
	public function getAddressListDefault($user_id = null, $isdefault = 0)
	{
		//取出之前的默认地址
		if ($isdefault == 1) {
			$this->_shareShopUser['`default`'] = $isdefault;
		}

		$this->_shareShopUser['userid'] = $user_id;
		$id_row = $this->getKeyByMultiCond($this->_shareShopUser);			

		return $id_row;
	}



}
?>