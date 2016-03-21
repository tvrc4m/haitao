<?php if (!defined('ROOT_PATH')) exit('No Permission');
/**
 * @author     Xinze <xinze@live.cn>
 */
class Member_InfoModel extends Member_Info
{
	public $_memberinfo = array();  

	/**
	 * 读取分页列表
	 *
	 * @param  int $member_id 主键值
	 * @return array $rows 返回的查询内容
	 * @access public
	 */
	public function getInfoList($member_id = null, $page=1, $rows=100, $sort='asc')
	{
		//需要分页如何高效，易扩展
		$offset = $rows * ($page - 1);

		$this->sql->setLimit($offset, $rows);

		$member_id_row = array();
		$member_id_row = $this->selectKeyLimit();

		//读取主键信息
		$total = $this->getFoundRows();

		$data_rows = array();

		if ($member_id_row)
		{
			$data_rows = $this->getInfo($member_id_row);
		}

		$data = array();
		$data['page'] = $page;
		$data['total'] = ceil_r($total / $rows);  //total page
		$data['totalsize'] = $data['total'];
		$data['records'] = count($data_rows);
		$data['items'] = array_values($data_rows);

		return $data;
	}

	/**
	 * 获取用户积分
	 *
	 * @param  int $member_id 主键值
	 * @return array $rows 返回的查询内容
	 * @access public
	 */
	public function getPoints($uid = null)
	{
		$this->sql->setwhere('member_id',$uid);
		$data = $this->getInfo("*");
		foreach ($data as $key) {
			$points = $key['points'];
		}

		return $points;
	}

	/**
	 * 添加积分
	 *
	 * @param  int $member_id 主键值
	 * @return array $rows 返回的查询内容
	 * @access public
	 */
	public function addPoints($sum = null, $type = null, $order_id = null, $uid = null)
	{
		$sum = $sum?round($sum):0;
		$num = $sum<0?$sum*(-1):$sum;

		//获取用户积分
		$points = $this->getPoints($uid);
		if($num > $points and $sum < 0)
		{
			return '1';
		}
		$statu = 1;

		$spoint = $points + $sum;
		$filed = array('points' => $spoint);
		$this->editInfo($uid,$filed);

		if($type==5)
		{
			$desc="注册会员赠送";	
		}
		elseif($type==2)
		{
			$desc="兑换礼品".$order_id."消耗积分";	
		}
		elseif($type==3)
		{
			$desc="取消购物订单".$order_id;	
		}
		elseif($type==4)
		{
			$desc="每日签到";	
		}
		elseif($type==6)
		{
			$desc="系统操作";	
		}
                elseif($type==7)
		{
			$desc="兑换购物券消费积分";	
		}
		else
		{
			$desc="订单".$order_id."购物消费";	
		}
		
		return $desc;
	}

	//朋友数增加
	public function addFriends($uid = null,$statu = null)
	{
		$this->sql->setwhere('member_id',$uid);
		$data = $this->getInfo("*");
		if($statu == '1')
		{
			$friend_num = $data[$uid]['friend'] - 1;
		}
		else
		{
			$friend_num = $data[$uid]['friend'] + 1;
		}
		$filed = array('friend' => $friend_num, );
		$res = $this->editInfo($uid,$filed);
		return $res;
	}

	//粉丝数增加
	public function addFans($uid = null,$statu = null)
	{
		$this->sql->setwhere('member_id',$uid);
		$data = $this->getInfo("*");
		if($statu == '1')
		{
			$fan_num = $data[$uid]['fan'] - 1;
		}
		else
		{
			$fan_num = $data[$uid]['fan'] + 1;
		}
		$filed = array('fan' => $fan_num, );
		$res = $this->editInfo($uid,$filed);
		return $res;
	}
}
?>