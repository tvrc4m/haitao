<?php if (!defined('ROOT_PATH')) exit('No Permission');
/**
 * @author     Xinze <xinze@live.cn>
 */
class VoucherModel extends Voucher
{
	public $getVoucherUser = array();  //用户代金券
	
	/**
	 * 读取分页列表
	 *
	 * @param  int $member_id 主键值
	 * @return array $rows 返回的查询内容
	 * @access public
	 */
	public function getVoucherList($member_id = null, $status = null, $shop_id=0, $page = 1, $rows = 100, $sort = 'asc')
	{
		//需要分页如何高效，易扩展
		$offset = $rows * ($page - 1);

		$this->sql->setLimit($offset, $rows);

		//用户id约束where条件 status为空则默认查询status<4
		if (!empty($status))
		{
			$this->getVoucherUser['member_id'] = $member_id;
			$this->getVoucherUser['status']    = $status;

			if ($shop_id)
			{
				$this->getVoucherUser['shop_id']    = $shop_id;
			}

			//得到用户id约束条件 member_id 和 status
			$member_id_row = $this->getKeyByMultiCond($this->getVoucherUser);
			$this->sql->setOrder('create_time', 'desc');

			$data_rows = array();

			if ($member_id_row)
			{
				$data_rows = $this->getVoucher($member_id_row);
			}
		}
		else
		{
			$this->sql->setwhere('member_id', $member_id);
			$this->sql->setwhere('status', '4' , '<');
			$this->sql->setOrder('create_time', 'desc');

			if ($shop_id)
			{
				$this->sql->setwhere('shop_id', $shop_id);
			}


			$data_rows = $this->getVoucher('*');
		}
		
		foreach ($data_rows as $key => $val)
		{

			if ($val['status'] == 1)
			{
				$arr1_rows[] = $val;
				$arr_rows['nouse'] = $arr1_rows;
			}
			if ($val['status'] == 2)
			{
				$arr2_rows[] = $val;
				$arr_rows['used'] = $arr2_rows;
			}
			if ($val['status'] == 3)
			{
				$arr3_rows[] = $val;
				$arr_rows['overdue'] = $arr3_rows;
			}
		}
		
		
		//读取受影响行数
		$total = $this->getFoundRows();

		

		$data = array();
		$data['page'] = $page;
		$data['total'] = $total;
		$data['totalsize'] = ceil_r($total / $rows);
		$data['records'] = count($arr_rows);
		$data['items'] = $arr_rows;
		
		return $data;
	}


	public function getVoucherByMid($member_id = null, $shop_id = null, $v_price = null, $id = null)
	{
		if($id)
		{
			$this->sql->setwhere('id',$id);
		}
		$this->sql->setwhere('member_id',$member_id)->setwhere('shop_id',$shop_id)->setwhere('status','1');
		$this->sql->setwhere('end_time',time(),'>');
		$this->sql->setwhere('`limit`',$v_price,'<=');
		$data = $this->getVoucher("*");
		return $data;
	}


	public function getVoucherByShopId($shop_id, $status = null, $page = 1, $rows = 100, $sort = 'asc')
	{
		//需要分页如何高效，易扩展
		$offset = $rows * ($page - 1);

		if ($status)
		{
			$this->sql->setwhere('status', $status);
		}

		$this->sql->setwhere('shop_id', $shop_id);
		$this->sql->setLimit($offset, $rows);


		$this->sql->setwhere('end_time', time(), '>');
		//$this->sql->setwhere('`limit`',$v_price,'<=');
		$data_rows = $this->getVoucher("*");

		$temp_id_row = array();
		$temp_id_row = array_filter_key('temp_id', $data_rows);

		if ($temp_id_row)
		{
			$Voucher_TempModel = new Voucher_TempModel();
			$temp_rows = $Voucher_TempModel->getTemp($temp_id_row);

			foreach ($data_rows as $k=>$data_row)
			{
				$data_rows[$k]['points'] = $temp_rows[$data_row['temp_id']]['points'];
			}
		}

		//读取受影响行数
		$total = $this->getFoundRows();

		$data = array();
		$data['page'] = $page;
		$data['total'] = ceil_r($total / $rows);  //total page
		$data['totalsize'] = $data['total'];
		$data['items'] = array_values($data_rows);

		return $data;
	}


	public function getUserVoucherByTempId($user_id, $temp_id)
	{
		$this->sql->setwhere('member_id', $user_id);
		$this->sql->setwhere('temp_id', $temp_id);


		//$this->sql->setwhere('end_time', time(), '>');


		$data_rows = $this->getVoucher("*");

		return $data_rows;
	}

	public function editVoucherStatus($order_id = null,$id = null)
	{
		$filed = array('status' => '2', 'order_id'=>$order_id );
		$this->editVoucher($id,$filed);
	}


	//获取代金券的数量
	public function getVoucherNum($member_id = null)
	{
		$this->sql->setwhere('member_id', $member_id);
		$this->sql->setwhere('status', '4' , '<');

		$data_rows = $this->getVoucher('*');

		$total = $this->getFoundRows();

		$data['total'] = $total;
		return $data;
	}
}
?>