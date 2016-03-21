<?php if (!defined('ROOT_PATH')) exit('No Permission');
/**
 * @author     Xinze <xinze@live.cn>
 */
class Product_DetailModel extends Product_Detail
{
	/**
	 * 读取商品详情
	 *
	 * @param  int $proid  产品id
	 * @return array $rows 返回的查询内容
	 * @access public
	 */
	public function getDetails($proid = null)
	{
		$this->sql->setwhere('proid', $proid, 'IN');
		$detail_rows = $this->getDetail('*');

		$rows = array();

		foreach ($detail_rows as $key => $value) {
			$rows[$value['proid']] = $value;
		}
		 
		return $rows;
	}
}
?>