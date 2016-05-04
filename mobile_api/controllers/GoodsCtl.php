<?php

/**
 *
 * 商品相关
 *
 * @category   Framework
 * @package    Controller
 * @author     Xinze <xinze@live.cn>
 * @copyright  Copyright (c) 2010, 黄新泽
 * @version    1.0
 * @todo
 */
class GoodsCtl extends Yf_AppController
{
	/**
	 * 商品详情
	 *
	 * @return array $rows 返回的查询内容
	 * @access public
	 */
	public function get()
	{
		$pid          =request_int('pid');

		$ProductModel = new ProductModel();
		//所有商品信息
		$goods_rows   = $ProductModel->getProduct($pid);

		fb($goods_rows);
		//商品的id数组,一维数组
		$goods_id_row = array_keys($goods_rows);    
		//fb($goods_id_row);

		$html_header = '<!DOCTYPE html><html lang="zh-cn"><head><meta charset="utf-8"><meta name="viewport" content="initial-scale=1.0,user-scalable=no,maximum-scale=1,width=device-width"><style>*,html,body{margin:0;padding:0;} html {width:100%;overflow:hidden;} img,table{max-width:100%;}</style></head><body>';
		$html_footer = '</body></html>';
		//商品图文内容
		foreach ($goods_id_row as $key => $value) {
			fb($value);
			$goods_rows[$value]['district'] = explode(' ', $goods_rows[$value]['area']);
			//商品图文内容
			$Product_DetailModel = new Product_DetailModel();
			$detail_rows     = $Product_DetailModel->getDetails($value);
			fb($detail_rows);

			if($detail_rows[$value]['detail'])
			{
				$goods_rows[$value]['detail']   =  $html_header . $detail_rows[$value]['detail'] . $html_footer;
			}
			else
			{
				$goods_rows[$value]['detail']   =  $detail_rows[$value]['detail'];
			}

			//商品规格信息
			$Product_SetmealModel = new Product_SetmealModel();
			$porperty = $Product_SetmealModel->getSetmealByPid($value);

			$keys = array();$kvs = array();$pro = array();
			foreach ($porperty as $ke => $val) 
			{
				$spec_name = explode(',',$val['spec_name']);
				$setmeal = explode(',', $val['setmeal']);
				$ks = array_combine($spec_name, $setmeal);
				$pkey = str_replace(',','',$val['setmeal']);
				$pro[$pkey] = $ks;
				$keys = array_merge($keys,$spec_name);
				$pro[$pkey]['sid'] = $val['id'];
				$pro[$pkey]['price'] = $val['price'];
				$pro[$pkey]['stock'] = $val['stock'];	
			}fb($pro);fb($keys);
			$keys = array_unique($keys);
			$kv = array();
			foreach ($keys as $k => $v)
			{
				foreach ($pro as $ks => $vs) 
				{
					$kv[$v][] = $vs[$v];
				}

			}
			if(is_array($kv)){
				foreach ($kv as $k => $v) {
					$kv[$k] = array_values(array_unique($v));
					array_unshift($kv[$k], $k);
				}
				foreach ($kv as $k => $v)
				{
					$kvs[] = $v;
				}
			}
			$goods_rows[$value]['spec_name']  = $kvs;
			$goods_rows[$value]['porperty']   = $pro;			
			
			$good_row[] = $goods_rows[$value]; 
		}
		fb($goods_rows);
		foreach ($good_row as $key => $value) 
		{
			//店铺信息
			$Shop_Model = new ShopModel();
			$shop_row = $Shop_Model->getShop($value['member_id']);
			fb($shop_row);

			$good_row[$key]['shop']['userid'] = $shop_row[$value['member_id']]['userid'];
			$good_row[$key]['shop']['company'] = $shop_row[$value['member_id']]['company'];
			$good_row[$key]['shop']['logo'] = $shop_row[$value['member_id']]['logo'];
			$good_row[$key]['shop']['tel'] = $shop_row[$value['member_id']]['tel'];
 		}

		foreach ($good_row as $key => $value) 
		{
			fb($value);
			$validTime = 0;
			if($value['valid_time'] == 0)
			{
				$validTime = 7;
			}elseif($value['valid_time'] == 1)
			{
				$validTime = 30;
			}	

			$time = $value['start_time_type'] == 2?$value['start_time']:$value['uptime'];
			if(($time + $validTime*24*3600 - time()<0 )&& $value['valid_time']!=2)
			{
				$fi=array('is_shelves'=>'0');
				$ProductModel->editProduct($value['id'],$fi);
				$good_row[$key]['down']=1;
			}else{
				$good_row[$key]['rest'] = '0';
				if($value['start_time_type'] == 2 && $time>time())
				{
					$good_row[$key]['rest'] = $time - time();
				}
			}
		}

		if ($goods_rows)
		{
			$msg    = 'success';
			$status = 200;
		}
		else
		{
			$msg    = 'failure';
			$status = 250;
		}
		fb($good_row);
		$good_row[0]['detail'] = str_replace('/lib/kindeditor/php/../../..','http://'.$_SERVER['HTTP_HOST'], $good_row[0]['detail']);
		$this->data->addBody(-140, $good_row, $msg, $status);
	}

	/**
	 * 商品搜索
	 *
	 * @return array $rows 返回的查询内容
	 * @access public
	 */

	public function getListByKey()
	{
		$key  = request_string('keyword');
		$page = request_int('page',1);
		$rows = request_int('rows',20);
		$order = request_string('order','price');
		$shop_id = request_int('shop_id');   //店铺id

		//获取开启店铺的ID
		$ShopModel    = new ShopModel();
		$shops_id_row = $ShopModel->getShopIdByStatu(1);
		
		//根据搜索关键字获取商品信息
		$ProductModel = new ProductModel();
		$goods_rows = $ProductModel->getGoodsByKey($key, $shops_id_row,$order, $page, $rows, $shop_id);

		//搜索词入库
		$Search_WordModel = new  Search_WordModel();
		$Search_WordModel->setWord($key);

		

		if ($goods_rows)
		{
			$msg    = 'success';
			$status = 200;
		}
		else
		{
			$msg    = 'failure';
			$status = 250;
		}

		$this->data->addBody(-140, $goods_rows, $msg, $status);
	}


	/**
	 * 商品搜索
	 *
	 * @return array $rows 返回的查询内容
	 * @access public
	 */

	public function getSearchWords()
	{
		$page = request_int('page');
		$rows = request_int('rows');
		$sort = request_string('sort', 'DESC');

		//搜索词入库
		$Search_WordModel = new  Search_WordModel();
		$search_words_rows = $Search_WordModel->getWordList(null, $page, $rows, $sort);

		if ($search_words_rows)
		{
			$msg    = 'success';
			$status = 200;
		}
		else
		{
			$msg    = 'failure';
			$status = 250;
		}

		$this->data->addBody(-140, $search_words_rows, $msg, $status);
	}

	/**
	 * 疯狂抢购(newpro)，热卖产品(hotpro)，新品上架商品列表
	 *
	 * @return array $rows 返回的查询内容
	 * @access public
	 */
	public function getListByProid()
	{
		$proid =request_string('proid');  //查找条件
		$page  = request_int('page',1);
		$rows  = request_int('rows',20);


		//获取开启店铺的ID
		$ShopModel    = new ShopModel();
		$shops_id_row = $ShopModel->getShopIdByStatu(1);

		if($proid != '')
		{
			$Web_Config = new Web_ConfigModel();
			$data       = $Web_Config->getProConfig($proid);
			$proid_row  = explode(',', $data);
			
		}
		else
		{
			$proid_row = $proid;
		}
		fb($proid_row);
		$ProductModel = new ProductModel();
		$goods_rows   = $ProductModel->getGoodsByProid($proid_row,$shops_id_row,$page,$rows);

		$goods_row = array_keys($goods_rows);

		if ($goods_rows)
		{
			$msg    = 'success';
			$status = 200;
		}
		else
		{
			$msg    = 'failure';
			$status = 250;
		}

		$this->data->addBody(-140, $goods_rows, $msg, $status);
	}

	/**
	 * 分类商品列表
	 *
	 * @return array $rows 返回的查询内容
	 * @access public
	 */
	public function getListByCatid()
	{
		$catid = request_int('catid');
		$order = request_string('order','price');
		$page  = request_int('page',1);
		$rows  = request_int('rows',20);

		//获取开启店铺的ID
		$ShopModel    = new ShopModel();
		$shops_id_row = $ShopModel->getShopIdByStatu(1);
		fb($shops_id_row);

		$ProductModel = new ProductModel();
		$goods_rows   = $ProductModel->getGoodsByCatid($catid, $shops_id_row, $order, $page, $rows);

		if ($goods_rows)
		{
			$msg    = 'success';
			$status = 200;
		}
		else
		{
			$msg    = 'failure';
			$status = 250;
		}

		$this->data->addBody(-140, $goods_rows, $msg, $status);
	}


	/**
	 * 商品列表（价格，销量，人气，信誉）
	 *
	 * @return array $rows 返回的查询内容
	 * @access public
	 */
	public function getListByOrder()
	{
		$order = request_string('order','price');
		$page  = request_int('page',1);
		$rows  = request_int('rows',20);

		//获取开启店铺的ID
		$ShopModel    = new ShopModel();
		$shops_id_row = $ShopModel->getShopIdByStatu(1);
		fb($shops_id_row);

		$ProductModel = new ProductModel();
		$goods_rows   = $ProductModel->getGoodsByOrder($order, $shops_id_row, $page, $rows);

		if ($goods_rows)
		{
			$msg    = 'success';
			$status = 200;
		}
		else
		{
			$msg    = 'failure';
			$status = 250;
		}

		$this->data->addBody(-140, $goods_rows, $msg, $status);

	}

	/**
	 * 获取商品评价信息
	 *
	 * @return array $rows 返回的查询内容
	 * @access public
	 */
	public function getCommentList()
	{
		$pid     = request_int('pid');    //商品id
		$goodbad = request_int('goodbad');    //1好评 0中评 -1差评

		$page = request_int('page',1);
		$rows = request_int('rows',20);

		$Product_CommentModel = new Product_CommentModel();
		$comment_rows   = $Product_CommentModel->getCommentByPid($pid,$goodbad, $page, $rows);
		if ($comment_rows)
		{
			$msg    = 'success';
			$status = 200;
		}
		else
		{
			$msg    = 'failure';
			$status = 250;
		}

		$this->data->addBody(-140, $comment_rows, $msg, $status);

	}


	/**
	 * 商品评价
	 *
	 * @return array $rows 返回的查询内容
	 * @access public
	 */
	public function addComment()
	{
		$uid  = Perm::$userId;
		$order_id = request_int('order_id');

		$MemberModel = new MemberModel();
		$de = $MemberModel->getMember($uid);

		$Product_OrderProModel = new Product_OrderProModel();
		$order_row = $Product_OrderProModel->getOrderProByOid($order_id);  //获取订单中的商品

		fb($order_row);
		
		foreach ($order_row as $key => $value) 
		{
			$ProductModel = new ProductModel();
			$product_row = $ProductModel->getProduct($value['pid']);
			
			$order_row[$key]['userid'] = $product_row[$value['pid']]['member_id'];  //卖家id
			$order_row[$key]['user'] = $product_row[$value['pid']]['member_name'];
			$order_row[$key]['bprice'] = $product_row[$value['pid']]['price'];
		}
		foreach ($order_row as $key => $value) 
		{
			$re[] = $value;
		}
		//fb($re);
		foreach ($re as $k => $v) 
		{
			fb($v);
			if($v['userid'])
			{
				//更新member表
				$MemberModel->editMemberPoints(request_int('g'.$k,'1'),$v['userid']);

				$pro = $ProductModel->getProduct($v['pid']);
				if($pro)
				{
					//更新product表
					$ProductModel->editProductGoodbad(request_int('g'.$k,'1'),$v['pid']);
				}

				$word=new Text_Filter();
				$comment_text = htmlspecialchars(request_string("comment_text".$k));
				$flag = $word->wordsFilter($comment_text, $matche_row);

				if($flag)
				{
					$comment_text = $comment_text;
				}
				else
				{
					//非法字符 
					//$comment_text 
					$comment_text = '';
				}
				//插入评价表
				$filed = array( 'userid' => $de[$uid]['userid'], 
								'user'	 => $de[$uid]['user'],
								'fromid' => $v['userid'],
								'pid'	 => $v['pid'],
								'puid'	 => $v['userid'],
								'pname'	 => $v['name'],
								'price'	 => $v['price'],
								'con'	 => $comment_text,
								'uptime' => time(),
								'goodbad'=> request_int('g'.$k));
				$Product_CommentModel = new Product_CommentModel();
				$Product_CommentModel->addComment($filed); 
			}
		}

		if(request_int('snuma') && request_int('snumb') && request_int('snumc') && request_int('snumd'))
		{
			$fileds = array( 'userid' => $de[$uid]['userid'],
							 'user'	  => $de[$uid]['user'],
							 'byid'	  => $re['0']['userid'],
							 'item1'  => request_int('snuma'),
							 'item2'  => request_int('snumb'),
							 'item3'  => request_int('snumc'),
							 'item4'  => request_int('snumd'),
							 'uptime' => time());
			$User_CommentModel = new User_CommentModel();
			$User_CommentModel->addComment($fileds);
		}

		//更新订单表
		$Product_OrderModel = new Product_OrderModel();
		$Product_OrderModel->editOrderComment($order_id);

		if (true)
		{
			$msg    = 'success';
			$status = 200;
		}
		else
		{
			$msg    = 'failure';
			$status = 250;
		}

		$this->data->addBody(-140, array(), $msg, $status);

	}


	/**
	 * 商品浏览记录
	 *
	 * @return array $rows 返回的查询内容
	 * @access public
	 */

	public function getListByFooterNum()
	{
		$user_id = Perm::$userId;  //用户id

		$User_ReadRecModel =new User_ReadRecModel();
		$res = $User_ReadRecModel->getReadRecNum($user_id);

		if ($res)
		{
			$msg    = 'success';
			$status = 200;
		}
		else
		{
			$msg    = 'failure';
			$status = 250;
		}

		$this->data->addBody(-140, $res, $msg, $status);	
	}

	/**
	 * 商品浏览记录
	 *
	 * @return array $rows 返回的查询内容
	 * @access public
	 */
	public function getListByFooter()
	{
		$user_id = Perm::$userId;  //用户id

		$page = request_int('page');
		$rows = request_int('rows');

		$User_ReadRecModel =new User_ReadRecModel();
		$res = $User_ReadRecModel->getReadRecByUid($user_id, $page, $rows);
		fb($res);

		$de = array();
		$ProductModel = new ProductModel();
		if($res['items'])
		{
			$de['total'] = $res['total'];
		}
		foreach ($res['items'] as $key => $value) 
		{
			$data_row = $ProductModel->getProduct($value['tid']);

			$res['items'][$key]['name'] = $data_row[$value['tid']]['name'];
			$res['items'][$key]['pic'] = $data_row[$value['tid']]['pic'];
			$res['items'][$key]['price'] = $data_row[$value['tid']]['price'];

			$times = date('Y-m-d',$value['time']);
			$de[$times]['count'] = 0;
		}

		foreach ($res['items'] as $key => $val) 
		{
			
			if($val['name'])
			{
				$time = date('Y-m-d',$val['time']);
				switch($time)
	            {
	                case date("Y-m-d",strtotime("-2 day")):
	                {
	                    $date = "前天";
	                    break;
	                }
	                case date("Y-m-d",strtotime("-1 day")):
	                {
	                    $date = "昨天";
	                    break;
	                }
	                case date("Y-m-d"):
	                {
	                    $date = "今天";
	                    break;
	                }
	                default:
	                {
	                    $date = date("d",strtotime($time))."日";
	                    break;
	                }
	            }

	            $de[$time]['date'] = $date;
	            $de[$time]['count'] +=1;
            	$de[$time]['product'][] = $val;
			}
		}

		if ($de)
		{
			$msg    = 'success';
			$status = 200;
		}
		else
		{
			$msg    = 'failure';
			$status = 250;
		}

		$this->data->addBody(-140, $de, $msg, $status);
	}


	/**
	 * 添加商品浏览记录
	 *
	 * @return array $rows 返回的查询内容
	 * @access public
	 */
	public function addFooter()
	{
		$user_id = Perm::$userId;  //用户id
		//$uid,表示会员ＩＤ，
		//$tid表示某个内容的主ＩＤ，例如，产品，产品，会员，新闻等与后面的type共同起作用．
		//type值：产品1,产品2,会员商铺4,新闻5
		$tid  = request_int('id');
		$type = request_int('type'); 

		$res = 0;
		$User_ReadRecModel =new User_ReadRecModel();
		if(!empty($user_id)&&!empty($tid)&&!empty($type)&&$user_id!=$tid)
		{
			$ip = $User_ReadRecModel->getip();
			//fb($ip);
			$time = time();
			//查找是否存在当天的浏览记录
		    $res = $User_ReadRecModel->getReadRecByOrder($user_id, $tid,$type);
		    if(!$res)
			{
				$field = array( 'userid'  =>$user_id,
								'tid'  => $tid,
								'type' => $type,
								'time' => time(),
								'ip'   => $ip);
				$res = $User_ReadRecModel->addReadRec($field);
			}
			
		}

		if ($res)
		{
			$msg    = 'success';
			$status = 200;
			$data['massage'] = '成功加入浏览记录';
		}
		else
		{
			$msg    = 'failure';
			$status = 250;
			$data['massage'] = '未成功加入浏览记录';
		}

		$this->data->addBody(-140, $data, $msg, $status);
	}


	/**
	 * 清空商品浏览记录
	 *
	 * @return array $rows 返回的查询内容
	 * @access public
	 */
	public function delFooter()
	{
		$user_id = Perm::$userId;

		$User_ReadRecModel =new User_ReadRecModel();
		$res = $User_ReadRecModel->delReadRecByUser($user_id);

		if ($res)
		{
			$msg    = 'success';
			$status = 200;
			$data['massage'] = '浏览记录清空成功';
		}
		else
		{
			$msg    = 'failure';
			$status = 250;
			$data['massage'] = '浏览记录清空失败';
		}

		$this->data->addBody(-140, $data, $msg, $status);
	}

}

?>
