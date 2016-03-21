<?php

/**
 *
 * 店铺相关api
 *
 * @category   Framework
 * @package    Controller
 * @author     Xinze <xinze@live.cn>
 * @copyright  Copyright (c) 2010, 黄新泽
 * @version    1.0
 * @todo
 */
class ShopCtl extends Yf_AppController
{
	/**
	 * 收藏的店铺
	 *
	 * @return array $rows 返回的查询内容
	 * @access public
	 */
	public function get()
	{
		$data = array();

		$shop_id = request_int('shop_id');
		$Shop_Model = new ShopModel();

		$data = $Shop_Model->getShop($shop_id);
		
		$User_CommentModel = new User_CommentModel();
		$score = $User_CommentModel->getScore($shop_id);

		$MemberModel = new MemberModel();
		foreach ($data as $key => $value) 
		{
			$mem = $MemberModel->getMember($value['userid']);
			fb($mem);
			$data[$key]['sellerpoints'] = $mem[$value['userid']]['sellerpoints'];

			$data[$key]['score'] = $score;
		}

		
		fb($score);
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


		$this->data->addBody(-140, $data, $msg, $status);
	}


	/**
	 * 获取店铺列表
	 *
	 * @return array $rows 返回的查询内容
	 * @access public
	 */
	public function getShopList()
	{
		$page 	= request_int('page',1);
		$rows 	= request_int('rows',20);

		$Shop_Model = new ShopModel();

		$data = $Shop_Model->getShopList('',$page,$rows);

		//fb($data);
		$ProductModel = new ProductModel();
		$MemberModel = new MemberModel();
		
		foreach ($data['items'] as $key => $value) 
		{

			//获取好评率
			$pro_row = $ProductModel->getGoodsByUid($value['userid']);
			$data['items'][$key]['newgoods'] = $pro_row['total_new'];
			$total_num = 0;
			$total_good = 0;
			$total_sales = 0;
			foreach ($pro_row['items'] as $prokey => $provalue) 
			{
				fb($provalue);
				$Product_CommentModel = new Product_CommentModel();
				//获取商品的总评论
				$tnum = $Product_CommentModel->getCommentNum($provalue['id'],$value['userid']);
				$total_num += $tnum;

				//获取商品的好评数
				$gnum = $Product_CommentModel->getCommentNum($provalue['id'],$value['userid'],'1');
				$total_good += $gnum;

				//获取商品销量
				$total_sales += $provalue['sales'];
			}
			$data['items'][$key]['goods_sales'] = $total_sales;
			if($total_num != 0)
			{
				$data['items'][$key]['favorablerate'] = ($total_good/$total_num)*100;
			}
			else
			{
				$data['items'][$key]['favorablerate'] = 100;
			}

			//获取店铺信用度
			$mem = $MemberModel->getMember($value['userid']);
			$data['items'][$key]['sellerpoints'] = $mem[$value['userid']]['sellerpoints'];

			//获取推荐商品
			$goods_rows   = $ProductModel->getGoodsByRec($value['userid'], '1', '3');
			$data['items'][$key]['pro'] = $goods_rows;
		}

	

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


		$this->data->addBody(-140, $data, $msg, $status);
	}


	/**
	 * 店铺商品列表
	 *
	 * @return array $rows 返回的查询内容
	 * @access public
	 */
	public function getGoodsListByStatus()
	{
		$uid    = request_int('uid');		//开店用户id
		$status = request_int('status');	//商品状态 1(新上架) 2(热销)
		$page 	= request_int('page',1);
		$rows 	= request_int('rows',20);

		$ProductModel = new ProductModel();
		$goods_rows   = $ProductModel->getGoodsByUid($uid, $status, $page, $rows);	//所有商品信息

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
	 * 店铺推荐商品列表
	 *
	 * @return array $rows 返回的查询内容
	 * @access public
	 */
	public function getGoodsListByRec()
	{
		$uid    = request_int('uid');		//开店用户id
		$page 	= request_int('page',1);
		$rows 	= request_int('rows',20);

		$ProductModel = new ProductModel();
		$goods_rows   = $ProductModel->getGoodsByRec($uid, $page, $rows);	

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
	 * 获取推荐店铺列表
	 *
	 * @return array $rows 返回的查询内容
	 * @access public
	 */
	public function getListByConfig()
	{
		$page = request_int('page',1);
		$rows = request_int('rows',20);
		
		$ShopModel = new ShopModel();
		//获取开启店铺id
		$shops_id_row = $ShopModel->getShopIdByStatu(1);

		//获取推荐店铺id
		$shoptid_row = $ShopModel->getShopIdByStar();
		fb($shoptid_row);

		//求开启店铺id与推荐店铺id的交集
		$shop_id_row = array_intersect($shoptid_row,$shops_id_row);
		$shop_rows = $ShopModel->getShop($shop_id_row);

		if ($shop_rows)
		{
			$msg    = 'success';
			$status = 200;
		}
		else
		{
			$msg    = 'failure';
			$status = 250;
		}
		$this->data->addBody(-140, $shop_rows, $msg, $status);
	}

	public function getCompany()
	{
		$uid    = request_int('member_id');
		$ShopModel = new ShopModel();
		$company=$ShopModel->getCompanyByUid($uid);
		$comp[]=$company;
		if ($company)
		{
			$msg    = 'success';
			$status = 200;
		}
		else
		{
			$msg    = 'failure';
			$status = 250;
		}
		$this->data->addBody(-140, $comp, $msg, $status);

	}


}

?>
