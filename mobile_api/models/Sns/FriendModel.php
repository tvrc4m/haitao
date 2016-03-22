<?php if (!defined('ROOT_PATH')) exit('No Permission');
/**
 * @author     Xinze <xinze@live.cn>
 */
class Sns_FriendModel extends Sns_Friend
{

	/**
	 * 读取分页列表
	 *
	 * @param  int $id 主键值
	 * @return array $rows 返回的查询内容
	 * @access public
	 */
	public function getFriendList($id = null, $page=1, $rows=100, $sort='asc')
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
			$data_rows = $this->getFriend($id_row);
		}

		$data = array();
		$data['page'] = $page;
		$data['total'] = ceil_r($total / $rows);  //total page
		$data['totalsize'] = $data['total'];
		$data['records'] = count($data_rows);
		$data['items'] = array_values($data_rows);

		return $data;
	}

	public function getFriends($user_id = null)
	{
		$this->sql->setwhere('uid',$user_id);
		$this->sql->setOrder('funame', 'asc');
		$data = $this->getFriend("*");
		foreach ($data as $key => $value) 
		{
			$datas[] = $value;
		}
		
		return $datas;
	}

	public function checkFriends($user_id = null, $fuser_id = null)
	{
		$this->sql->setwhere('uid',$user_id)->setwhere('fuid',$fuser_id);
		$data = $this->getFriend("*");
		foreach ($data as $key => $value) 
		{
			$k = $key;
		}
		if($data)  
		{
			return $k;    //已关注
		}else
		{
			return 0;	     //未关注
		}
	}

	//修改关注状态
	public function editStatus($user_id=null, $fuser_id=null, $status=null)
	{
		$this->sql->setwhere('uid',$user_id)->setwhere('fuid',$fuser_id);
		$id = $this->selectKeyLimit();

		$filed = array('state' => $status, );
		$this->editFriend($id,$filed);
	}
}
?>