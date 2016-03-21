<?php if (!defined('ROOT_PATH')) exit('No Permission');
/**
 * @author     Xinze <xinze@live.cn>
 */
class ShopModel extends Shop
{
	public $_multiCondShopsId=array('shop_statu' => null );

	/**
	 * 读取分页列表
	 *
	 * @param  int $userid 主键值
	 * @return array $rows 返回的查询内容
	 * @access public
	 */
	public function getShopList($userid = null, $page=1, $rows=100, $sort='asc')
	{
		//需要分页如何高效，易扩展
		$offset = $rows * ($page - 1);

		$this->sql->setLimit($offset, $rows);
		$this->sql->setwhere('shop_statu','1');

		$userid_row = array();
		$userid_row = $this->selectKeyLimit();

		//读取主键信息
		$total = $this->getFoundRows();

		$data_rows = array();

		if ($userid_row)
		{
			$data_rows = $this->getShop($userid_row);
		}

		$data = array();
		$data['page'] = $page;
		$data['total'] = $total;  //total page
		$data['totalsize'] = ceil_r($total / $rows);
		$data['records'] = count($data_rows);
		$data['items'] = array_values($data_rows);

		return $data;
	}

	/**
	 * 读取店铺状态
	 *
	 * @param  int $userid 主键值
	 * @return array $rows 返回的查询内容
	 * @access public
	 */
	public function getShopIdByStatu($statu = null)
	{
		$this->_multiCondUserCart['shop_statu'] = $statu;
		$shops_id_row                      = $this->getKeyByMultiCond($this->_multiCondUserCart);

		return $shops_id_row;
	}

	/**
	 * 读取推荐店铺
	 *
	 * @param  int $userid 主键值
	 * @return array $rows 返回的查询内容
	 * @access public
	 */
	public function getShopIdByStar()
	{
		$this->sql->setwhere('statu','0','>');
		$shops_id_row = $this->selectKeyLimit();

		return $shops_id_row;
	}

	/**
	 * 读取店铺名称
	 *
	 * @param  int $userid 主键值
	 * @return array $rows 返回的查询内容
	 * @access public
	 */
	public function getCompanyByUid($userid)
	{
		$this->sql->setwhere('userid',$userid);
		$list = $this->getShop('*');
		
		foreach ($list as $key) {
			$company = $key['company'];
		}
		fb($company);
		return $company;
	}



	/**
	 * 取的附近的店铺  单位米
	 *
	 * @param  float $lat
	 * @param  float $lng
	 * @param  int $distance 小于范围
	 * @return array $rows 返回的查询内容
	 * @access public
	 */
	public function getNearShop($lat, $lng, $distance=20000, $limit=10)
	{
		$voucher_temp = TABEL_PREFIX . 'voucher_temp';

		$sql = "
SELECT * FROM
	(SELECT  s.userid, s.lng, s.lat,  (round(6378.138*2*asin(sqrt(pow(sin( (s.lat*pi()/180-$lat*pi()/180)/2),2)+cos(s.lat*pi()/180)*cos($lat*pi()/180)* pow(sin( (s.lng*pi()/180-$lng*pi()/180)/2),2)))*1000)) as distance, vt.id as temp_id, vt.shop_id  FROM " . $this->_tableName . " s LEFT JOIN $voucher_temp vt ON s.userid=vt.shop_id   WHERE 1 and s.shop_statu=1 and vt.status=1 and vt.points=0 and (vt.total-vt.giveout)>0 ORDER BY distance ASC limit 100) as temp
WHERE
	distance < $distance
limit $limit
";


		$shop_rows = $this->sql->getAll($sql);

		return $shop_rows;
	}



	/**
	 * 取的附近的店铺  单位米
	 *
	 * @param  float $lat
	 * @param  float $lng
	 * @param  int $distance 小于范围
	 * @return array $rows 返回的查询内容
	 * @access public
	 */
	public function getNearShopVoucher($lat, $lng, $distance=20000, $limit=10)
	{
		$voucher_temp = TABEL_PREFIX . 'voucher_temp';

		$sql = "
			SELECT * FROM
				(SELECT  s.userid, s.lng, s.lat,  (round(6378.138*2*asin(sqrt(pow(sin( (s.lat*pi()/180-$lat*pi()/180)/2),2)+cos(s.lat*pi()/180)*cos($lat*pi()/180)* pow(sin( (s.lng*pi()/180-$lng*pi()/180)/2),2)))*1000)) as distance, vt.id as temp_id, vt.shop_id  FROM " . $this->_tableName . " s LEFT JOIN $voucher_temp vt ON s.userid=vt.shop_id   WHERE 1 and s.shop_statu=1 and vt.status=1 and vt.points=0 and (vt.total-vt.giveout)>0 ORDER BY distance ASC limit 100) as temp
			WHERE
				distance < $distance
			ORDER BY rand() limit $limit
			";


		$shop_rows = $this->sql->getAll($sql);

		return $shop_rows;
	}
}
?>