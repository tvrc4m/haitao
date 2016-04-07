<?php if (!defined('ROOT_PATH')) exit('No Permission');
/**
 * @author     Xinze <xinze@live.cn>
 */
class ProductModel extends Product
{
	public $_multiCondGoodsId=array('name' => null,
									 'keywords' => null,
									 'is_shelves' => null,
									 'status' => null, );
	/**
	 * 读取分页列表
	 *
	 * @param  int $id 主键值
	 * @return array $rows 返回的查询内容
	 * @access public
	 */
	public function getProductList($id = null, $page=1, $rows=100, $sort='asc')
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
			$data_rows = $this->getProduct($id_row);
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
	 * 店铺商品
	 *
	 * @param  int $id 主键值
	 * @return array $row 返回的查询内容的ID
	 * @access public
	 */
	public function getGoodsByUid($uid = null,$status = null, $page = 1, $rows = 20)
	{
		//分页
		$offset = $rows * ($page - 1);
		$this->sql->setLimit($offset,$rows);

		//添加查询条件获取商品信息
		$this->sql->setwhere('member_id',$uid)->setwhere('is_shelves','1')->setwhere('status','0','>');
		$this->sql->setOrder('uptime','desc');
		//$this->sql->setOrder('sales','desc');

		$total_all = '0';$total_new = '0';$total_hot = '0';
		//一周（7天）
		$time = time()-604800;

		//所有商品
		$goods_all_rows = $this->getProduct('*');
		//取得影响行数
		$total_all = $this->getFoundRows();
		fb($goods_all_rows);

		//新上架
		$this->sql->setwhere('member_id',$uid)->setwhere('is_shelves','1')->setwhere('status','0','>');
		$this->sql->setwhere('uptime',$time,'>');
		$this->sql->setOrder('uptime','desc');
		$this->sql->setLimit($offset,$rows);
		$goods_new_rows = $this->getProduct('*');
		//取得影响行数
		$total_new = $this->getFoundRows();
		fb($goods_new_rows);


		//热销
		$this->sql->setwhere('member_id',$uid)->setwhere('is_shelves','1')->setwhere('status','0','>');
		$this->sql->setwhere('sales','0','>');
		$this->sql->setOrder('sales','desc');
		$this->sql->setLimit($offset,$rows);
		$goods_hot_rows = $this->getProduct('*');
		//取得影响行数
		$total_hot = $this->getFoundRows();
		fb($goods_hot_rows);


		if($status == '')
		{
			$total = $total_all;
		    $goods_rows = $goods_all_rows;
		}
		if($status == 1)
		{
			$total = $total_new;
		    $goods_rows = $goods_new_rows;
		}
		if($status == 2)
		{
			$total = $total_hot;
		    $goods_rows = $goods_hot_rows;
		}

		$data  = array();
		$data['page']      = $page;
		$data['total_all']     = $total_all;
		$data['total_new']     = $total_new;
		$data['total_hot']     = $total_hot;
		$data['totalsize'] = ceil_r($total / $rows);
		$data['records']   = count($goods_rows);
		$data['items']     = array_values($goods_rows);
		return $data;
	}


	/**
	 * 店铺推荐商品
	 *
	 * @param  int $id 主键值
	 * @return array $row 返回的查询内容的ID
	 * @access public
	 */
	public function getGoodsByRec($uid = null, $page = 1, $rows = 20)
	{
		//分页
		$offset = $rows * ($page - 1);
		$this->sql->setLimit($offset,$rows);

		//添加查询条件获取商品信息
		$this->sql->setwhere('member_id',$uid)->setwhere('is_shelves','1')->setwhere('status','0','>')->setwhere('shop_rec','0','>');
		$this->sql->setOrder('uptime','desc');

		$goods_rows = $this->getProduct('*'); 

		$total = $this->getFoundRows();

		$data  = array();
		$data['page']      = $page;
		$data['total']     = $total;
		$data['totalsize'] = ceil_r($total / $rows);
		$data['records']   = count($goods_rows);
		$data['items']     = array_values($goods_rows);
		return $data;
	}

	/**
	 * 搜索商品
	 *
	 * @param  int $id 主键值
	 * @return array $rows 返回的查询内容
	 * @access public
	 */
	public function getGoodsByKey($key = null, $member_id = null,$order = null, $page = 1, $rows = 20, $shop_id = null)
	{

		//添加搜索条件获取商品信息
		$this->sql->setwhere('name','%'.$key.'%','LIKE')->setwhere('is_shelves','1')->setwhere('member_id',$member_id,'IN')->setwhere('status','0','>');
		if($shop_id)
		{
			$this->sql->setwhere('member_id',$shop_id);
		}
		$this->sql->setOrder('rank','desc')->setOrder('uptime','desc');
		$goods1_rows = $this->getProduct('*'); 
		$id_row1 = array_keys($goods1_rows);

		$this->sql->setwhere('keywords','%'.$key.'%','LIKE')->setwhere('is_shelves','1')->setwhere('member_id',$member_id,'IN')->setwhere('status','0','>');
		$this->sql->setOrder('rank','desc')->setOrder('uptime','desc');
		$goods2_rows = $this->getProduct('*'); 
		$id_row2 = array_keys($goods2_rows); 
		fb($goods1_rows);
		fb($goods2_rows);
		
		$goods_rows = array();
		if(!empty($id_row1) && !empty($id_row2) )
		{

			$array = array_merge($id_row1, $id_row2);      //并集

			$array1 = array_intersect($id_row1, $id_row2); //交集

			$array2 = array_diff( $array,$array1);         //差集  
			fb($array);fb($array1);fb($array2);
			
			$goods_id_row = array_merge($array1, $array2);
			$goods_rows = $this->getProduct($goods_id_row);
			
			
		}elseif(!empty($id_row1) && empty($id_row2))
		{
			$goods_rows = $goods1_rows;
		}elseif(empty($id_row1) && !empty($id_row2))
		{
			$goods_rows = $goods2_rows;
		}
		
		if($order == 'price')
		{
			foreach ($goods_rows as $key => $value) 
			{
				$price[$key] = $value['price'];
				$time[$key]  = $value['uptime'];	
			}
			array_multisort($price,SORT_ASC,$time,SORT_DESC,$goods_rows);
		}
		if($order == 'sales')
		{
			foreach ($goods_rows as $key => $value) 
			{
				$sales[$key] = $value['sales'];
				$time[$key]  = $value['uptime'];	
			}
			array_multisort($sales,SORT_DESC,$time,SORT_DESC,$goods_rows);
		}
		if($order == 'clicks')
		{
			foreach ($goods_rows as $key => $value) 
			{
				$clicks[$key] = $value['clicks'];
				$time[$key]  = $value['uptime'];	
			}
			array_multisort($clicks,SORT_DESC,$time,SORT_DESC,$goods_rows);
		}
		if($order == 'goodbad')
		{
			foreach ($goods_rows as $key => $value) 
			{
				$goodbad[$key] = $value['goodbad'];
				$time[$key]  = $value['uptime'];	
			}
			array_multisort($goodbad,SORT_DESC,$time,SORT_DESC,$goods_rows);
		}
		

		//取得影响行数
		$total = $this->getFoundRows();
		fb($total);

		//分页
		$offset = $rows * ($page - 1);
		$end    = $offset+($rows-1);
		fb($end);
		if($page && $rows)
		{
			foreach ($goods_rows as $key => $value) 
			{
				if($key >= $offset && $key <= $end)
				{
					$grows[] = $value;
				}
			}
		}
		else
		{
			$grows = $goods_rows;
		}
		
		$data  = array();
		$data['page']      = $page;
		$data['total']     = $total;
		$data['totalsize'] = ceil_r($total / $rows);
		$data['records']   = count($grows);
		$data['items']     = array_values($grows);
		return $data;
	}


	/**
	 * 首页推荐商品列表（疯狂抢购，热卖产品，新品上架）
	 *
	 * @param  int $id 主键值
	 * @return array $rows 返回的查询内容
	 * @access public
	 */
	public function getGoodsByProid($proid_row = null, $member_id = null, $page = 1, $rows= 1)
	{
		//分页
		$offset = $rows * ($page - 1);
		$this->sql->setLimit($offset,$rows);
		
			
		if(is_array($proid_row))
		{
			$this->sql->setwhere('id',$proid_row,'IN')->setwhere('member_id',$member_id,'IN');
			$goods_rows = $this->getProduct('*');
		}
		else
		{
			$this->sql->setwhere('is_shelves','1')->setwhere('status','0','>')->setwhere('member_id',$member_id,'IN');
			//$this->sql->setOrder('clicks','desc');
			//$this->sql->setOrder('rank','desc');
			$this->sql->setOrder('uptime','desc');
			$goods_rows = $this->getProduct('*');
		}	

		//取得影响行数
		$total = $this->getFoundRows();
        $Trows = $rows == 0 ? 0 :$total / $rows;
		$data  = array();
		$data['page']      = $page;	  	//当前页			
		$data['total']	   = $total;	//总记录数
		$data['totalsize'] = ceil_r($Trows);		//总页数
		$data['records']   = count($goods_rows);	//本页记录数
		$data['items']     = array_values($goods_rows);  //内容
		return $data;
	}

	/**
	 * 根据分类读取商品列表
	 *
	 * @param  int $id 主键值
	 * @return array $rows 返回的查询内容
	 * @access public
	 */
	public function getGoodsByCatid($catid = null, $member_id = null,$order = null, $page = 1, $rows= 20)
	{
		//分页
		$offset = $rows * ($page - 1);
		$this->sql->setLimit($offset,$rows);

		//添加搜索条件获取商品信息
		$this->sql->setwhere('is_shelves','1')->setwhere('status','0','>')->setwhere('catid',$catid.'%','LIKE')->setwhere('member_id',$member_id,'IN');
		//$this->sql->setOrder('rank','desc')->setOrder('uptime','desc');
		if($order == 'price')
		{
			$this->sql->setOrder('price','asc');
		}
		if($order == 'sales')
		{
			$this->sql->setOrder('sales','desc');
		}
		if($order == 'clicks')
		{
			$this->sql->setOrder('clicks','desc');
		}
		if($order == 'goodbad')
		{
			$this->sql->setOrder('goodbad','desc');
		}
		$goods_rows = $this->getProduct('*');

		//取得影响行数
		$total = $this->getFoundRows();

		$data  = array();
		$data['page']      = $page;
		$data['total']     = $total;
		$data['totalsize'] = ceil_r($total / $rows);
		$data['records']   = count($goods_rows);
		$data['items']     = array_values($goods_rows);
		return $data;

	}

	/**
	 * 商品列表
	 *
	 * @param  int $id 主键值
	 * @return array $rows 返回的查询内容
	 * @access public
	 */
	public function getGoodsByOrder($order = null, $member_id = null, $page = 1, $rows= 20)
	{
		//分页
		$offset = $rows * ($page - 1);
		$this->sql->setLimit($offset,$rows);

		//添加搜索条件获取商品信息
		$this->sql->setwhere('is_shelves','1')->setwhere('status','0','>')->setwhere('member_id',$member_id,'IN');
		if($order == 'price')
		{
			$this->sql->setOrder('price','asc');
		}
		if($order == 'sales')
		{
			$this->sql->setOrder('sales','desc');
		}
		if($order == 'clicks')
		{
			$this->sql->setOrder('clicks','desc');
		}
		if($order == 'goodbad')
		{
			$this->sql->setOrder('goodbad','desc');
		}
		//$this->sql->setOrder('rank','desc')->setOrder('uptime','desc');
		$goods_rows = $this->getProduct('*');
fb($goods_rows);
		//取得影响行数
		$total = $this->getFoundRows();
		fb($total);
		$data  = array();
		$data['page']      = $page;
		$data['total']     = $total;
		$data['totalsize'] = ceil_r($total / $rows);
		$data['records']   = count($goods_rows);
		$data['items']     = array_values($goods_rows);
		return $data;

	}

	/**
	 * 根据商品id获取商品信息
	 *
	 * @param  int $id 主键值
	 * @return array $rows 返回的查询内容
	 * @access public
	 */
	public function getGoodsByPid($id = null)
	{
		$this->sql->setwhere('id',$id)->setwhere('is_shelves','1');
		$this->sql->setwhere('status','0','>');
		$data = $this->getProduct("*");
		return $data;
	}

	/**
	 * 修改商品评价
	 *
	 * @param  int $id 主键值
	 * @return array $rows 返回的查询内容
	 * @access public
	 */
	public function editProductGoodbad($goodbad = null, $id = null)
	{
		$data = $this->getProduct($id);
		$field['goodbad'] = $data[$id]['goodbad'] + $goodbad;

		$this->editProduct($id,$field);
	}

	/**
	 * 修改商品销售数量
	 *
	 * @param  int $id 主键值
	 * @return array $rows 返回的查询内容
	 * @access public
	 */
	public function editProuductSales($id = null, $num = null)
	{
		$data = $this->getProduct($id);

		$field['sales'] = $data[$id]['sales'] + $num;

		$this->editProduct($id,$field);
	}

	/**
	 * 修改商品库存数量
	 *
	 * @param  int $id 主键值
	 * @return array $rows 返回的查询内容
	 * @access public
	 */
	public function editProuductStock($id = null, $num = null)
	{
		$data = $this->getProduct($id);

		$field['stock'] = $data[$id]['stock'] - $num;

		if($field['stock'] < 0)
		{
			$field['stock'] = 0;
		}

		$this->editProduct($id,$field);
	}

}
?>