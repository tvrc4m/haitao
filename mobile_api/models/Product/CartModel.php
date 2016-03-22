<?php if (!defined('ROOT_PATH')) exit('No Permission');

/**
 * @author     Xinze <xinze@live.cn>
 */
class Product_CartModel extends Product_Cart
{
	public $_multiCondUserCart = array('buyer_id' => null);  //用户购物车

	/**
	 * 读取用户购物车列表
	 *
	 * @param  int $id 主键值
	 * @param  int $page 第几页
	 * @param  int $rows 每页记录数
	 * @param  string asc 排序条件
	 * @return array $rows 返回的查询内容
	 * @access public
	 */
	public function getUserCartList($user_id = null, $page = 1, $rows = 100, $sort = 'asc')
	{
		//需要分页如何高效，易扩展
		$offset = $rows * ($page - 1);

		$this->sql->setLimit($offset, $rows);

		$this->_multiCondUserCart['buyer_id'] = $user_id;
		$id_row                               = $this->getKeyByMultiCond($this->_multiCondUserCart);

		//$id_row = array();
		//$id_row = $this->selectKeyLimit();

		//读取主键信息
		$total = $this->getFoundRows();

		$data_rows = array();

		if ($id_row)
		{
			$data_rows = $this->getCart($id_row);
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
	 * 修改用户购物车商品数量
	 *
	 * @param int $id
	 * @return bool $del_flag 是否成功
	 * @access public
	 */
	public function editUserCart($id, $field_row, $user_id = null, $act = null)
	{
		$flag = false;

		if ($user_id)
		{
			//查找购物购物车中的商品数量
			$cart_rows = $this->getCart($id);
			$quantity  = $cart_rows[$id]['quantity'];

			if($act == '1')  //+
			{
				$field_row['quantity'] = $field_row['quantity'] + $quantity;
			}
			elseif($act == '2')  //-
			{
				$field_row['quantity'] = $quantity - $field_row['quantity'];
			}

			if($field_row['quantity'] <= '0')
			{
				$field_row['quantity'] = '1';
			}

			$cart_rows = $this->getCart($id);

			if (array_key_exists($id, $cart_rows))
			{
				$flag = $this->editCart($id, $field_row);
			}
		}

		return $flag;
	}

	/**
	 * 删除用户购物车商品操作
	 * @param int $id
	 * @return bool $del_flag 是否成功
	 * @access public
	 */
	public function removeUserCart($id, $user_id = null)
	{
		$del_flag = false;

		if ($user_id)
		{
			$this->sql->setwhere('buyer_id', $user_id);
			$cart_rows = $this->getCart($id);

			foreach ($id as $index)
			{
				if (array_key_exists($index, $cart_rows))
				{
					$del_flag = $this->removeCart($index);
				}
			}
		}

		return $del_flag;
	}

	/**
	 * 删除购物车商品操作
	 * @param int $id
	 * @return bool $del_flag 是否成功
	 * @access public
	 */
	public function removeCartPro($user_id = null, $pid)
	{
		$del_flag = false;

		if ($pid)
		{
			$this->sql->setwhere('buyer_id', $user_id);
			$cart_rows = $this->getCart($id);

			foreach ($id as $index)
			{
				if (array_key_exists($index, $cart_rows))
				{
					$del_flag = $this->removeCart($index);
				}
			}
		}

		return $del_flag;
	}

	/**
	 * 获取用户购物车列表按店铺数组返回操作
	 * @param int $id
	 * @return bool $del_flag 是否成功
	 * @access public
	 */
	public function getCartClist($user_id = null)
	{
		//判断是否为分销
		$this->sql->setwhere('buyer_id',$user_id)->setwhere('dist_user_id','0');
		$this->sql->setGroup('seller_id');
		$cart_rows = $this->getCart('*');

		$carts = array();
		foreach ($cart_rows as $key => $value) {
			$flag = 0;
			$value['cartid'] = $value['id'];
			if(empty($carts))
			{
				$carts[] = $value;
			}else
			{
				foreach ($carts as $k => $val) 
				{
					if($value['seller_id'] == $val['seller_id'])
					{
						$carts[$k]['cartid'] = $carts[$k]['cartid'].','.$value['id'];
						$flag = 1;
					}
				}
				if($flag == 0)
				{
					$carts[] = $value;
				}
			}
		}

		return $carts;
	}

	/**
	 * 获取用户购物车列操作
	 * @param int $id
	 * @return bool $del_flag 是否成功
	 * @access public
	 */
	public function getCartList($user_id = null, $seller_id = null, $product_id = null)
	{
		if($product_id)
		{
			$this->sql->setwhere('id',$product_id,'IN');
		}
		if($seller_id)
		{
			$this->sql->setwhere('seller_id',$seller_id);
		}
		$this->sql->setwhere('buyer_id',$user_id);
		$this->sql->setorder('create_time','desc');
		$data = $this->getCart("*");
		
		return $data;
	}
}

?>