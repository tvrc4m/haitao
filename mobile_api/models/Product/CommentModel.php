<?php if (!defined('ROOT_PATH')) exit('No Permission');
/**
 * @author     Xinze <xinze@live.cn>
 */
class Product_CommentModel extends Product_Comment
{
	public $_comment = array();
	/**
	 * 读取分页列表
	 *
	 * @param  int $id 主键值
	 * @return array $rows 返回的查询内容
	 * @access public
	 */
	public function getCommentList($id = null, $page=1, $rows=100, $sort='asc')
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
			$data_rows = $this->getComment($id_row);
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
	 * 获取商品评论数
	 *
	 * @param  int $id 主键值
	 * @return array $rows 返回的查询内容
	 * @access public
	 */
	public function getCommentNum($pid = null,$userid = null,$goodbad = null)
	{
		$this->sql->setWhere('pid',$pid);
		$this->sql->setWhere('userid',$userid,'!=');
		if($goodbad)
		{
			$this->sql->setWhere('goodbad');
		}
		$id_row = $this->selectKeyLimit();

		//读取主键信息
		$total = $this->getFoundRows();
		return $total;

		
	}


	/**
	 * 获取商品评论列表
	 *
	 * @param  int $id 主键值
	 * @return array $rows 返回的查询内容
	 * @access public
	 */
	public function getCommentByPid($pid = null,$goodbad = null, $page = 1, $rows= 20)
	{
		//分页
		$offset = $rows * ($page - 1);
		$this->sql->setLimit($offset,$rows);

		$this->_comment['pid'] = $pid;
		if($goodbad != '')
		{
			$this->_comment['goodbad'] = $goodbad;
		}
		$ids_row = $this->getKeyByMultiCond($this->_comment);
		if($ids_row)
		{
			$this->sql->setOrder('uptime', 'desc');
			$comment_rows = $this->getComment($ids_row);
			//取得影响行数
			$total = $this->getFoundRows();
			fb($total);
		
			$a = 0;$b = 0;$c = 0;
			
			//好评数
			$this->_comment['goodbad'] = 1;
			$idsa_row = $this->getKeyByMultiCond($this->_comment);
			$totala = $this->getFoundRows();
			fb($totala);

			//中评数
			$this->_comment['goodbad'] = 0;
			$idsb_row = $this->getKeyByMultiCond($this->_comment);
			$totalb = $this->getFoundRows();
			fb($totalb);

			//差评数
			$this->_comment['goodbad'] = -1;
			$idsc_row = $this->getKeyByMultiCond($this->_comment);
			$totalc = $this->getFoundRows();
			fb($totalc);


			
			$data              = array();
			$data['page']      = $page;
			$data['total']     = $total;  //total page
			$data['totalsize'] = ceil_r($total / $rows);
			$data['good']      = $totala;
			$data['middle']	   = $totalb;
			$data['bad']       = $totalc;
			$data['records']   = count($comment_rows);
			$data['items']     = array_values($comment_rows);
		}
		else
		{
			$data = array();
		}

		return $data;
		

	}
}
?>