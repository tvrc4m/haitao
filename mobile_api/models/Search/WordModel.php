<?php if (!defined('ROOT_PATH')) exit('No Permission');
/**
 * @author     Xinze <xinze@live.cn>
 */
class Search_WordModel extends Search_Word
{
	public $_multiCondKeyword = array('keyword' => null);  //

	/**
	 * 读取分页列表
	 *
	 * @param  int $id 主键值
	 * @return array $rows 返回的查询内容
	 * @access public
	 */
	public function getWordList($id = null, $page=1, $rows=100, $sort='DESC')
	{
		//需要分页如何高效，易扩展
		$offset = $rows * ($page - 1);

		$this->sql->setOrder('nums', $sort);
		$this->sql->setLimit($offset, $rows);

		$id_row = array();
		$id_row = $this->selectKeyLimit();

		//读取主键信息
		$total = $this->getFoundRows();

		$data_rows = array();

		if ($id_row)
		{
			$this->sql->setOrder('nums', $sort);
			$data_rows = $this->getWord($id_row);
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
	 * 插入或者更新搜索次数
	 * @param string $keyword 插入数据
	 * @return bool  是否成功
	 * @access public
	 */
	public function setWord($keyword)
	{
		//获取主键
		$this->_multiCondKeyword['keyword'] = $keyword;
		$id_row = $this->getKeyByMultiCond($this->_multiCondKeyword);

		if ($id_row)
		{
			$id = $id_row[0];

			$data_rows = $this->getWord($id);
			$data_row = $data_rows[$id];


			$search_row = array();
			$search_row['nums'] = $data_row['nums'] + 1;

			$flag = $this->editWord($id, $search_row);

		}
		else
		{
			//添加
			$search_row = array();
			$search_row['keyword'] = $keyword;
			$search_row['char_index'] = Text_Pinyin::pinyin($keyword, '');
			$search_row['nums'] = 1;


			$flag = $this->addWord($search_row);
		}

		return $flag;
	}
}
?>