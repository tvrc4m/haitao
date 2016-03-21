<?php if (!defined('ROOT_PATH')) exit('No Permission');
/**
 * @author     Xinze <xinze@live.cn>
 */
class Product_OrderModel extends Product_Order
{
	public $_multiCondUserOrder = array();  //用户购物车

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
	public function getUserOrderList($user_id = null, $page = 1, $rows = 100, $sort = 'asc')
	{
		//需要分页如何高效，易扩展
		$offset = $rows * ($page - 1);

		$this->sql->setLimit($offset, $rows);

		$this->_multiCondUserOrder['buyer_id'] = $user_id;
		$id_row                               = $this->getKeyByMultiCond($this->_multiCondUserOrder);

		//$id_row = array();
		//$id_row = $this->selectKeyLimit();

		//读取主键信息
		$total = $this->getFoundRows();

		$data_rows = array();

		if ($id_row)
		{
			$data_rows = $this->getOrder($id_row);
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
	public function editUserOrder($id, $field_row, $user_id = null)
	{
		$flag = false;

		if ($user_id)
		{
			$cart_rows = $this->getOrder($id);

			if (array_key_exists($id, $cart_rows))
			{
				$flag = $this->editOrder($id, $field_row);
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
	public function removeUserOrder($id, $user_id = null)
	{
		$del_flag = false;

		if ($user_id)
		{
			$cart_rows = $this->getOrder($id);

			if (array_key_exists($id, $cart_rows))
			{
				$del_flag = $this->removeOrder($id);
			}
		}

		return $del_flag;
	}

	/**
	 * 根据订单状态获取订单列表操作
	 * @param int $id
	 * @return bool $del_flag 是否成功
	 * @access public
	 */
	public function getOrdersList($user_id = null, $status = null, $page = 1, $rows = 20, $rate = null, $name = null)
	{
		
		//分页
		$offset = $rows * ($page - 1);
		$this->sql->setLimit($offset,$rows);
		$list = array();

		//根据条件查找订单
		if($status == '21')
		{
			$this->sql->setwhere('status','0','>=');
		}
		elseif ($status == '10')   //待评价
		{
			if($rate)
			{
				if($rate == '1')
				{
					$this->sql->setwhere('status','4')->setwhere('buyer_comment','0')->setwhere('seller_comment','0');
				}
				if($rate == '2')		
				{
					$this->sql->setwhere('buyer_comment','1')->setwhere('seller_comment','0');
				}
				if($rate == '3')
				{
					$this->sql->setwhere('buyer_comment','0')->setwhere('seller_comment','1');
				}
				if($rate == '4')
				{
					$this->sql->setwhere('buyer_comment','1')->setwhere('seller_comment','1');
				}
				
			}
		}
		elseif ($status == '4') 
		{
			$this->sql->setLimit(0,1000);
			$this->sql->setwhere('status',$status);
		}
		else
		{
			$this->sql->setwhere('status',$status);
		}

		$this->sql->setwhere('userid',$user_id)->setwhere('seller_id','','!=');

		if($name)
		{
			$Product_OrderProModel = new Product_OrderProModel();
			$ord_rows  = $Product_OrderProModel->getOrderProByName($name,$user_id);
			fb($ord_rows);
			$this->sql->setwhere('order_id',$ord_rows,'IN');
		}


		$this->sql->setOrder('create_time', 'desc');
		//$this->sql->setOrder(field('status','1','3','2','4','5','6','0'),'desc');
		$this->sql->setOrder('buyer_comment','desc')->setOrder('seller_comment','desc')->setOrder('id','desc');


		//$this->sql->setLimit('0','20');
		$orders_rows = $this->getOrder('*');

		//取得影响行数
		$total = $this->getFoundRows();

		foreach ($orders_rows as $k) {
				if($k['status'] == '3')
				{
					$time = $k['deliver_time'] + $k['time_expand']*86400-1 - time();
					$d = floor($time / 86400);   
					$h = floor(($time % 86400) / 3600);
					$k['time_expand']= $d."天".$h."时";  //目前时间距买家最晚收货时间还剩时间
				}
			$list[] = $k;
		}

		$data              = array();
		$data['page']      = $page;
		$data['total']     = $total;  //total page
		$data['totalsize'] = ceil_r($total / $rows);
		$data['records']   = count($list);
		$data['items']     = array_values($list);

		return $data;
	}

	/**
	 * 根据订单状态获取订单数量
	 * @param int $id
	 * @return bool $del_flag 是否成功
	 * @access public
	 */
	public function getOrdersNum($user_id = null, $status = null, $rate = null)
	{
		if ($status == '10')   //待评价
		{
			if($rate)
			{
				if($rate == '1')
				{
					$this->sql->setwhere('status','4')->setwhere('buyer_comment','0')->setwhere('seller_comment','0');
				}
				if($rate == '2')		
				{
					$this->sql->setwhere('status','4')->setwhere('buyer_comment','1')->setwhere('seller_comment','0');
				}
				if($rate == '3')
				{
					$this->sql->setwhere('status','4')->setwhere('buyer_comment','0')->setwhere('seller_comment','1');
				}
				if($rate == '4')
				{
					$this->sql->setwhere('status','4')->setwhere('buyer_comment','1')->setwhere('seller_comment','1');
				}
				
			}
		}
		else
		{
			$this->sql->setwhere('status',$status);
		}

		$this->sql->setwhere('userid',$user_id)->setwhere('seller_id','','!=');
		$orders_rows = $this->getOrder('*');

		//取得影响行数
		$total = $this->getFoundRows();

		$data['total']     = $total; 
		return $data;
	}

	/**
	 * 修改订单状态操作
	 *-1删除的订单
	 * 0取消的订单
	 * 1新订单，等待买家付款
	 * 2买家已付款，等待卖家发货
	 * 3卖家已发货，等待买家确认收货
	 * 4订单完成
	 * 5退货中的订单
	 * 6退货成功;
	 * @param int $id
	 * @return bool $del_flag 是否成功
	 * @access public
	 */
	public function editOrderStatus($order_id = null, $status = null, $member_id = null, $payment_name = null)
	{
		$flag = 0;
		if($status == '-1') //删除订单
		{
			$this->_multiCondUserOrder['order_id'] = $order_id;
			//$this->_multiCondUserOrder['userid'] = $member_id;
			$ids_row = $this->getKeyByMultiCond($this->_multiCondUserOrder);

			fb($ids_row);
			$field = array('status' => $status , 'uptime' => time());
			fb($field);
			foreach ($ids_row as $key => $value) 
			{
				$flag = $this->editOrder($value,$field);
			}
		}

		if($status == '2') //卖家付款
		{
			$this->_multiCondUserOrder['order_id'] = $order_id;
			$ids_row = $this->getKeyByMultiCond($this->_multiCondUserOrder);
		}


		if($status == '0')  //取消订单
		{
			$this->_multiCondUserOrder['order_id'] = $order_id;
			$ids_row = $this->getKeyByMultiCond($this->_multiCondUserOrder);

			$this->_multiCondUserOrder['userid'] = $member_id;
			$id_row = $this->getKeyByMultiCond($this->_multiCondUserOrder);

			$orders_rows = $this->getOrder($id_row);

			foreach ($orders_rows as $key) {
				$post['action']='update';
				$post['seller_email']=$key['seller_id'];
				$post['buyer_email']=$member_id;//卖家账号
				$post['order_id']=$order_id;//外部订单号
				$post['statu']=0;//取消的订单

				$res=PayHelper::getPayUrl($post);
			}
			
		}
		if($status == '3') //发货
		{
			
		}
		if($status == '4') //成功，返回结果给支付中心
		{
			//判断虚拟产品
			$is_virtual = null;

			$this->_multiCondUserOrder['order_id'] = $order_id;
			$ids_row = $this->getKeyByMultiCond($this->_multiCondUserOrder);
			if($is_virtual)
			{
				$this->_multiCondUserOrder['seller_id'] = $member_id;
			}
			else
			{
				$this->_multiCondUserOrder['userid'] = $member_id;
				$ids_row = $this->getKeyByMultiCond($this->_multiCondUserOrder);
			}
			

			$pay_member = $this->getOrder($ids_row);
			
			foreach ($pay_member as $de) 
			{
				$post['action']='update';
				$post['seller_email']=$de['seller_id'];
				$post['buyer_email']=$member_id;
				$post['order_id']=$order_id;//外部订单号
				$post['statu']=4;
				$post['is_virtual']=$de['is_virtual'];

				$res=PayHelper::getPayUrl($post);//跳转至订单生成页面
			}
		}
		if($status == '5')  //提交退货申请
		{
			
		}
		if($status == '6')  //退款，由买家发起，管理员进行退款操作 
		{
			
		}
		
		if(!empty($res))
		{
			fb($res);
			$res=json_decode($res);
			fb($res);

			//获取$config['authkey']
			$config = Yf_Registry::get('config');

			$auth = md5($config['authkey']);
			fb($auth);
			if($res->statu=='true'&&$res->auth == $auth)
			{
				//------------如果结果正常就对订单进行取消操作。
				$field = array('status' => $status , 'uptime' => time());
				fb($field);
					foreach ($ids_row as $key => $value) {
						$flag = $this->editOrder($value,$field);
					}
			}
		}

		if($status == '4')
		{
			$data = array();
			$data['pay_member'] = $pay_member;
			$data['flag'] = $flag;
			return $data;
		}

		return $flag;
	}

	/**
	 * 修改订单评价状态操作
	 * @param int $id
	 * @return bool $del_flag 是否成功
	 * @access public
	 */
	public function editOrderComment($order_id = null)
	{
		$this->_multiCondUserOrder['order_id'] = $order_id;
		$id_row = $this->getKeyByMultiCond($this->_multiCondUserOrder);
		//fb($id_row);
		//$pay_member = $this->getOrder($id_row);
		foreach ($id_row as $key => $value) 
		{
			//fb($value);
			$field['buyer_comment'] = '1';
			$this->editOrder($value,$field);
		}
	}

}
?>