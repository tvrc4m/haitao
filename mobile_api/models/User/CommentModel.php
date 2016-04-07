<?php if (!defined('ROOT_PATH')) exit('No Permission');
/**
 * @author     Xinze <xinze@live.cn>
 */
class User_CommentModel extends User_Comment
{

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


	public function getScore($shop_id = null)
	{
		$datas = $this->getComment("*");
		fb($datas);
		$totals = $total = $this->getFoundRows();
		$as = $bs = $cs = $ds = 0;
		foreach ($datas as $key => $value) 
		{
			$as +=$value['item1'];
			$bs +=$value['item2'];
			$cs +=$value['item3'];
			$ds +=$value['item4'];
		}
		$as = round(($totals==0?0:$as/$totals),2);
		$bs = round(($totals==0?0:$bs/$totals),2);
		$cs = round(($totals==0?0:$cs/$totals),2);
		$ds = round(($totals==0?0:$ds/$totals),2);
		fb($as);
		fb($bs);
		fb($cs);
		fb($ds);

		$this->sql->setwhere('byid',$shop_id);
		$data = $this->getComment("*");

		$total = $this->getFoundRows();
		fb($data);
		$a = $b = $c = $d = 0;
		foreach ($data as $key => $value) 
		{
			$a +=$value['item1'];
			$b +=$value['item2'];
			$c +=$value['item3'];
			$d +=$value['item4'];
		}
		$a = round(($total==0?0:$a/$total),2);
		$b = round(($total==0?0:$b/$total),2);
		$c = round(($total==0?0:$c/$total),2);
		$d = round(($total==0?0:$d/$total),2);




		$score['a'] = $a > 0 ? $a : 5;
		$score['b'] = $b > 0 ? $b : 5;
		$score['c'] = $c > 0 ? $c : 5;
		$score['d'] = $d > 0 ? $d : 5;

		$score['aw'] = round(($as==0?0:($score['a']-$as)/$as)*100,2);
		$score['bw'] = round(($bs==0?0:($score['b']-$bs)/$bs)*100,2);
		$score['cw'] = round(($cs==0?0:($score['c']-$cs)/$cs)*100,2);
		$score['dw'] = round(($ds==0?0:($score['d']-$ds)/$ds)*100,2);

		return $score;
	}
}
?>