<?php if (!defined('ROOT_PATH')) exit('No Permission');
/**
 * @author     Xinze <xinze@live.cn>
 */
class Sub_DomainModel extends Sub_Domain
{

	/**
	 * 读取分页列表
	 *
	 * @param  varchar $domain 主键值
	 * @return array $rows 返回的查询内容
	 * @access public
	 */
	public function getTopDomainList($top_domain=null, $domain=null, $page=1, $rows=10, $sort='asc')
	{
		//需要分页如何高效，易扩展
		$offset = $rows * ($page - 1);

		$this->sql->setLimit($offset, $rows);

		//$domain_row = array();
		//$domain_row = $this->selectKeyLimit();
		if(empty($domain))
		{
			if(!empty($top_domain))
			{
				$this->sql->setwhere('top_domain', $top_domain);
			}

			$data_rows = array();
			$data_rows = $this->getDomain('*');
			
			//获取到记录的行数
			$total = $this->getFoundRows();
		}
		else
		{
			$this->sql->setwhere('domain', $domain);

			$data_rows = array();
			$data_rows = $this->getDomain('*');

			//获取到记录的行数
			$total = $this->getFoundRows();
		}
		$data = array();
		$data['page'] = $page; //当前页
		$data['total'] = $total; //当前页获取的记录数 
		$data['totalsize'] = ceil_r($total / $rows); //总页数
		$data['records'] = count($data_rows); //总查询记录数
		$data['items'] = array_values($data_rows); //获取的数据

		return $data;
	}
}
?>