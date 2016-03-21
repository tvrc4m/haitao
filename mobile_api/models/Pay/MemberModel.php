<?php if (!defined('ROOT_PATH')) exit('No Permission');
/**
 * @author     Xinze <xinze@live.cn>
 */
class Pay_MemberModel extends Pay_Member
{
	public $_paymember = array();
	/**
	 * 读取分页列表
	 *
	 * @param  int $pay_id 主键值
	 * @return array $rows 返回的查询内容
	 * @access public
	 */
	public function getMemberList($pay_id = null, $page=1, $rows=100, $sort='asc')
	{
		//需要分页如何高效，易扩展
		$offset = $rows * ($page - 1);

		$this->sql->setLimit($offset, $rows);

		$pay_id_row = array();
		$pay_id_row = $this->selectKeyLimit();

		//读取主键信息
		$total = $this->getFoundRows();

		$data_rows = array();

		if ($pay_id_row)
		{
			$data_rows = $this->getMember($pay_id_row);
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
	 * 确认支付密码
	 *
	 * @param  int $pay_id 主键值
	 * @return array $rows 返回的查询内容
	 * @access public
	 */
	public function getPayPass($tmpPwd = null, $userid = null)
	{
		$this->_paymember['pay_pass'] = $tmpPwd;
		$this->_paymember['userid'] = $userid;
		$id_row = $this->getKeyByMultiCond($this->_paymember);

		return $id_row;
	}

	/**
	 * 修改支付密码
	 *
	 * @param  int $pay_id 主键值
	 * @return array $rows 返回的查询内容
	 * @access public
	 */
	public function editMemberPayPass($userid = null, $pay_pass = null)
	{
		$reset_passwd_row['pay_pass'] = $pay_pass;

		$this->_paymember['userid'] = $userid;
		$id_row = $this->getKeyByMultiCond($this->_paymember);

		$flag = $this->editMember($id_row,$reset_passwd_row);

		return $flag;
	}

	/**
	 * 获取账户余额
	 *
	 * @param  int $pay_id 主键值
	 * @return array $rows 返回的查询内容
	 * @access public
	 */
	public function getCash($userid = null)
	{
		//$this->_paymember['userid'] = $userid;
		//$id_row = $this->getKeyByMultiCond($this->_paymember);
		$this->sql->setwhere('userid',$userid);
		$data = $this->getMember("*");
		foreach ($data as $key => $value) {
			$cash[$key] = $value['cash'];
		}

		return $cash;
	}
}
?>