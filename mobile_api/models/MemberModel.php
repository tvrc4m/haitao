<?php if (!defined('ROOT_PATH')) exit('No Permission');
/**
 * @author     Xinze <xinze@live.cn>
 */
class MemberModel extends Member
{

	private $_multiCond = array('user'=>null);

	public function getUserIdByAccount($user_account)
	{
		$user_id_row = array();

		$this->_multiCond['user'] = $user_account;

		$user_id_row = $this->getKeyByMultiCond($this->_multiCond);

		return $user_id_row;
	}

	/**
	 * 读取分页列表
	 *
	 * @param  int $userid 主键值
	 * @return array $rows 返回的查询内容
	 * @access public
	 */
	public function getMemberList($userid = null, $page=1, $rows=100, $sort='asc')
	{
		//需要分页如何高效，易扩展
		$offset = $rows * ($page - 1);

		$this->sql->setLimit($offset, $rows);

		$userid_row = array();
		$userid_row = $this->selectKeyLimit();

		//读取主键信息
		$total = $this->getFoundRows();

		$data_rows = array();

		if ($userid_row)
		{
			$data_rows = $this->getMember($userid_row);
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
	 * 根据主键更新表内容
	 * @param mix   $userid  主键
	 * @param array $field_row   key=>value数组
	 * @return bool $update_flag 是否成功
	 * @access public
	 */
	public function editMemberPayId($user_id=null, $field_row)
	{
		$update_flag = $this->editMember($user_id, $field_row);

		return $update_flag;
	}

	public function editMemberPoints($sellerpoints = null, $userid = null)
	{
		$data = $this->getMember($userid);
		$field['sellerpoints'] = $data[$userid]['sellerpoints'] + $sellerpoints;

		$this->editMember($userid,$field);
	}

}
?>