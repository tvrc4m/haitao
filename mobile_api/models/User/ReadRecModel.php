<?php if (!defined('ROOT_PATH')) exit('No Permission');
/**
 * @author     Xinze <xinze@live.cn>
 */
class User_ReadRecModel extends User_ReadRec
{

	public $_multiCondRec=array();
	/**
	 * 读取分页列表
	 *
	 * @param  int $id 主键值
	 * @return array $rows 返回的查询内容
	 * @access public
	 */
	public function getReadRecList($id = null, $page=1, $rows=100, $sort='asc')
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
			$data_rows = $this->getReadRec($id_row);
		}

		$data = array();
		$data['page'] = $page;
		$data['total'] = ceil_r($total / $rows);  //total page
		$data['totalsize'] = $data['total'];
		$data['records'] = count($data_rows);
		$data['items'] = array_values($data_rows);

		return $data;
	}


	public function getReadRecByUid($userid = null, $page = 1, $rows= 20)
	{
		//分页
		$offset = $rows * ($page - 1);
		$this->sql->setLimit($offset,$rows);

		$this->sql->setwhere('userid',$userid)->setwhere('type','1');
		$this->sql->setOrder('time','desc');
		$result =	$this->getReadRec("*");

		//取得影响行数
		$total = $this->getFoundRows();

		$data  = array();
		$data['page']      = $page;	  	//当前页			
		$data['total']	   = $total;	//总记录数
		$data['totalsize'] = ceil_r($total / $rows);		//总页数
		$data['records']   = count($result);	//本页记录数
		$data['items']     = $result;  //内容

		return $data;
	}


	//获取浏览记录数量
	public function getReadRecNum($userid = null)
	{
		$this->sql->setwhere('userid',$userid)->setwhere('type','1');
		$this->sql->setOrder('time','desc');
		$result =	$this->getReadRec("*");

		//取得影响行数
		$total = $this->getFoundRows();

		$data['total'] = $total;

		return $data;
	}

	//获取浏览记录
	public function getReadRecByOrder($userid = null, $tid = null, $type = null)
	{
		$date = date('Y-m-d');
		fb($date);
		$time = time();
		fb($time);
		$timem = strtotime($date);
		$timen = $timem + 86400;
		fb($timem);
		fb($timen);
		$this->sql->setwhere('userid',$userid)->setwhere('tid',$tid)->setwhere('type',$type);
		$this->sql->setwhere('time',$timem,'>=')->setwhere('time',$timen,'<=');
		//$this->sql->setOrder('time','desc');
		//$result =	$this->getReadRec("*");

		$id_row = array();
		$id_row = $this->selectKeyLimit();
		fb($id_row);
		$total = 0;
		if($id_row)
		{
			$file = array('time' => $time );
			$this->editReadRec($id_row,$file);

			//取得影响行数
			$total = $this->getFoundRows();
		}
		

		return $total;
	}

	//删除浏览记录
	public function delReadRecByUser($userid = null)
	{
		$this->_multiCondRec['userid'] = $userid;
		$ids_row = $this->getKeyByMultiCond($this->_multiCondRec);

		//删除
		$res = $this->removeReadRec($ids_row);
		return $res;
	}

	//获取ip
	public function getip()
	{
		if (isset($_SERVER))
		{
		if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
		   $realip = $_SERVER['HTTP_X_FORWARDED_FOR'];
		} elseif (isset($_SERVER['HTTP_CLIENT_IP'])) {
		   $realip = $_SERVER['HTTP_CLIENT_IP'];
		} else {
		   $realip = $_SERVER['REMOTE_ADDR'];
		}
		} else {
		if (getenv("HTTP_X_FORWARDED_FOR")) {
		   $realip = getenv( "HTTP_X_FORWARDED_FOR");
		} elseif (getenv("HTTP_CLIENT_IP")) {
		   $realip = getenv("HTTP_CLIENT_IP");
		} else {
		   $realip = getenv("REMOTE_ADDR");
		}
		}
		return $realip;
	}

}
?>