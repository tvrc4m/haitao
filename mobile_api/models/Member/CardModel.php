<?php if (!defined('ROOT_PATH')) exit('No Permission');
/**
 * @author     Xinze <xinze@live.cn>
 */
class Member_CardModel extends Member_Card
{

	public $getBlindMemberId = array();  //会员卡相关信息

	/**
	 * 读取分页列表
	 *
	 * @param  int $id 主键值
	 * @return array $rows 返回的查询内容
	 * @access public
	 */
	public function getCardList($blind_member_id, $status=null, $page=1, $rows=100, $sort='asc', $serial=null)
	{
		//需要分页如何高效，易扩展
		$offset = $rows * ($page - 1);

		if (!empty($serial))
		{
			$this->sql->setwhere('serial', $serial);
		}

		if (!empty($status))
		{
			$this->sql->setwhere('status', $status);
		}

		$this->sql->setwhere('blind_member_id', $blind_member_id);
		$this->sql->setLimit($offset, $rows);

		$this->sql->setOrder('used_time', $sort);

		$data_rows = array();
		$data_rows = $this->getCard('*');

		//读取受影响行数
		$total = $this->getFoundRows();

		$data = array();
		$data['page'] = $page;
		$data['total'] = ceil_r($total / $rows);  //total page
		$data['totalsize'] = $data['total'];
		$data['items'] = array_values($data_rows);

		return $data;
	}

	/**
	 * 根据店铺读取会员卡分页列表
	 *
	 * @param  int $id 主键值
	 * @return array $rows 返回的查询内容
	 * @access public
	 */
	public function getShopCardList($shop_id, $status=null, $page=1, $rows=100, $sort='asc')
	{
		//需要分页如何高效，易扩展
		$offset = $rows * ($page - 1);

		if (!empty($status))
		{
			$this->sql->setwhere('status', $status);
		}

		$this->sql->setwhere('shop_id', $shop_id);
		$this->sql->setLimit($offset, $rows);

		$this->sql->setOrder('used_time', $sort);

		$data_rows = array();
		$data_rows = $this->getCard('*');

		//读取受影响行数
		$total = $this->getFoundRows();

		$data = array();
		$data['page'] = $page;
		$data['total'] = ceil_r($total / $rows);  //total page
		$data['totalsize'] = $data['total'];
		$data['items'] = array_values($data_rows);

		return $data;
	}

	//编辑已经存在的会员卡 插入会员ID
	public function bindCard($serial = null, $blind_member_id = null)
	{
		$this->sql->setwhere('serial', $serial);
		$data_rows = $this->getCard('*');

		/*
		$sql = "update ".MECART." set  blind_member_id=$id,blind_member_name='$name',used_time='".time()."' where id = ".$re['id'];
		$this -> db -> query($sql);

		$sql = "update ".MECARTTEM." set used = used + 1 where id = ".$card_temp; //更新已经发放数量
		$this -> db -> query($sql);
		*/


		if ($data_rows)
		{
			$data_row = array_pop($data_rows);

			//已经绑定
			if ($data_row['blind_member_id'])
			{
				$flag = false;
			}
			else
			{
				$field_row = array('blind_member_id' => $blind_member_id);
				$field_row = array('used_time' => time());
				//$field_row = array('blind_member_name' => $blind_member_id);

				//第一个参数为需要插入数据的主键  第二个参数为插入数据的键及值
				$flag = $this->editCard($data_row['id'], $field_row);

				if ($flag)
				{
					$temp_id = $data_row['temp_id'];
					$Member_CardTempModel = new Member_CardTempModel();
					$temp_rows = $Member_CardTempModel->getCardTemp($temp_id);
					$temp_row = $temp_rows[$temp_id];

					$card_row = array();
					$card_row['used'] = $temp_row['used'] + 1;

					$Member_CardTempModel->editCardTemp($temp_id, $card_row);
				}
			}
		}
		else
		{
			$flag = false;
		}

		
		return $flag;
	}


	//插入新的会员卡以及会员ID
	public function addCardList($serial, $blind_member_id)
	{
		$this->sql->setwhere('serial',$serial);
		$data_rows = $this->getCard('*');

		if (empty($data_rows))
		{
			$field_row = array('blind_member_id' => $blind_member_id, 'serial' => $serial);
			$add_flag = $this->addCard($field_row);

			$this->sql->setwhere('serial',$serial);
			$data_rows = $this->getCard('*');

			return $data_rows;
		}
	}

	
	/**
	 * 
	 *
	 * @param  int $id 主键值
	 * @return array $rows 返回的查询内容
	 * @access public
	 */	
	public function getCardDiscount($shop_id = null, $blind_member_id = null)
	{
		$this->sql->setwhere('shop_id',$shop_id)->setwhere('blind_member_id',$blind_member_id);
		$this->sql->setOrder('discounts','desc');
		$this->sql->setLimit('0','1');
		$data = $this->getCard("*");
		$res = array();
		foreach ($data as $key => $value) {
			$res = $value;
		}

		return $res;
	}
}
?>