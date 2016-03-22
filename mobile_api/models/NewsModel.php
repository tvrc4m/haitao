<?php if (!defined('ROOT_PATH')) exit('No Permission');
/**
 * @author   
 */
class NewsModel extends News
{

	/**
	 * get订单
	 *
	 * @param  array $id 主键值
	 * @return $rows 返回inset id
	 * @access public
	 */
	public function getNewslists()
	{
	
		$data = $this->getNewsList();

		return $data;
	}

	/**
	 * 读取分页列表
	 *
	 * @param  int $id 主键值
	 * @return array $rows 返回的查询内容
	 * @access public
	 */
	public function getNewsList($page = 1, $rows = 100, $sort = 'desc')
	{
		//需要分页如何高效，易扩展
		$offset = $rows * ($page - 1); 
		$this->sql->setLimit($offset, $rows);
		$this->sql->setOrder('uptime','desc');

		$id_row = $this->selectKeyLimit();

		//读取主键信息
		$total = $this->getFoundRows();
		$data_rows = array();
		if ($id_row)
		{
			$data_rows = $this->getNews($id_row);
		}

		$data = array();
		$data['page']      	= $page;
		$data['total']     	= ceil($total / $rows);  //total page
		$data['totalsize'] 	= $data['total'];
		$data['records']   	= count($data_rows);
		$data['items']     	= array_values($data_rows);

		return $data;
	}

}
?>