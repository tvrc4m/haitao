<?php
/**
 *
 * 商品收藏相关
 *
 * @category   Framework
 * @package    Controller
 * @author     Xinze <xinze@live.cn>
 * @copyright  Copyright (c) 2010, 黄新泽
 * @version    1.0
 * @todo
 */
class GoodsFavoritesCtl extends Yf_AppController
{
	/**
	 * 查询商品
	 *
	 * @return array $rows 返回的查询内容
	 * @access public
	 */
	public function get()
	{
		$user_id = Perm::$userId;
		$page 	 = request_int('page');  
		$lenght_rows = request_int('lenght');  

		$GoodsSharepModel = new Sns_ShareproductModel;
		$data = $GoodsSharepModel->getShareproductList($user_id, $page, $lenght_rows);

		$pid_rows = array();

		foreach ($data['items'] as $key => $val)
		{
			$pid_rows[] = $val['pid'];

		}

		//查询收藏商品详情
		$GoodsModel = new Sns_ShareproductInfo();
		$goodsData  	= $GoodsModel->getShareproductInfo($pid_rows);

		foreach ($pid_rows as $key => $val)
		{

			$data['items'][$key]['pname'] = $goodsData[$val]['pname'];
			$data['items'][$key]['image'] = $goodsData[$val]['image'];
			$data['items'][$key]['price'] = $goodsData[$val]['price'];
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
	 * 收藏商品
	 *
	 * @return status 是否成功
	 * @access public
	 */
	public function add()
	{
		$user_id  = Perm::$userId;
		$goods_id = request_int('goods_id');
		$user_name= request_string('user_name');

		//获取商品详情 
		$ProductModel = new Product();
		$productData  = $ProductModel->getProduct($goods_id);
		//定义商品info列表:$field_row_info
		$field_row_info = array();  
		$field_row_info['pid'] 		 = $goods_id;
		$field_row_info['pname'] 	 = $productData[$goods_id]['name'];
		$field_row_info['image'] 	 = $productData[$goods_id]['pic'];
		$field_row_info['price'] 	 = $productData[$goods_id]['price'];
		$field_row_info['shopid'] 	 = $productData[$goods_id]['member_id'];
		$field_row_info['uname'] 	 = $user_name;
		$field_row_info['addtime'] 	 = time();
		$field_row_info['likenum'] 	 = 1;			//喜欢人数暂缺
		$field_row_info['likemember']= $user_id;	//喜欢过的用户id 暂缺
		$field_row_info['collectnum']= 1;			//收藏人数暂缺 product表没查到
		//定义商品列表 $field_row
		$field_row = array();  
		$field_row['pid'] 			= $goods_id;
		$field_row['uid'] 			= $user_id;
		$field_row['uname'] 		= $user_name;
		$field_row['content'] 		= null;		//内容暂缺 
		$field_row['addtime'] 		= time();
		$field_row['likeaddtime']	= null;		//喜欢时间暂缺
		$field_row['privacy']		= null;		//隐私可见度 0所有人可见 1好友可见 2仅自己可见 暂缺
		$field_row['commentcount']	= null;		//评论数暂缺
		$field_row['isshare']		= null;		//是否分享 0为未分享 1为分享', 暂缺
		$field_row['islike']		= null;		//是否喜欢 0为未喜欢 1为喜欢', 暂缺

		/*
		$this->sql->startTransaction();		//事务开始
		$this->sql->commit();				//事物提交
		$this->sql->rollBack();				//事物回滚
		$this->sql->rollBack();				//事物关闭
		*/

		//查询商品info表 如果已有该商品被收藏过 则只添加用户-商品表 且info表收藏数+1
		$ProductInfoModel = new Sns_ShareproductInfo();
		$selectGoods  = $ProductInfoModel->getShareproductInfo($goods_id);

		//写入商品详情表
		if(!$selectGoods){

			$resul = $ProductInfoModel->addShareproductInfo($field_row_info);

		}
		else
		{
			//获取关注人数 $collectnum_old
			$field_name = 'collectnum';
			$ShareshopModel = new Sns_ShareproductInfoModel();
			$collectnum_old = $ShareshopModel->getShareNum($goods_id);

			//关注人数+1
			$collectnum_new = $collectnum_old+1;
			$collectResul = $ProductInfoModel->editShareproductInfoSingleField($goods_id, $field_name, $collectnum_new, $collectnum_old);
			
			if(!$collectResul)
			{
				$msg    = 'failure';
				$status = 250;
				$this->data->addBody(-140, $arr, $msg, $status);
			}
		}

		//写入商品表
		$Sns_Shareproduct = new Sns_ShareproductModel;		
		$data = $Sns_Shareproduct->addShareproducts($field_row);


		$arr = array();

		if ($data == true )
		{
			$msg	= 'success';
			$status	= 200;
		}
		else
		{
			$msg    = 'failure';
			$status = 250;
		}

		$this->data->addBody(-140, $arr, $msg, $status);
		
	}
	
	/**
	 * 删除商品
	 *
	 * @return removegoods 返回所删除商品id
	 * @access public
	 */
	public function remove()
	{
		$user_id = Perm::$userId;
		$id = request_int('id');

		$Sns_Shareproduct = new Sns_ShareproductModel;
		$data             = $Sns_Shareproduct->removeShareproducts($id, $user_id);
		
		$arr = array();

		if ($data == true)
		{
			$arr['removegoods'] = $id;
			$msg                = 'success';
			$status             = 200;
		}
		else
		{
			$msg    = 'failure';
			$status = 250;
		}

		$this->data->addBody(-140, $arr, $msg, $status);
		
	}

	/**
	 * 收藏商品总人数
	 *
	 * @return 
	 * @access public
	 */
	public function getShareNum()
	{

		$user_id = Perm::$userId;
		$id = request_int('id');

		$Sns_Shareproduct = new Sns_ShareproductModel;
		$data = $Sns_Shareproduct->removeShareproducts($id, $user_id);

		$arr = array();

		if ($data)
		{
			$arr['count'] = $data;
			$msg    = 'success';
			$status = 200;
		}
		else
		{
			$arr['count'] = 0;
			$msg    = 'failure';
			$status = 250;
		}

		$this->data->addBody(-140, $arr, $msg, $status);

	}

	/**
	 * 是否已经关注
	 *
	 * @return 
	 * @access public
	 */
	public function isCollect()
	{

		$id = request_int('id');	//主键id
		$user_id = Perm::$userId;

		$ShareshopModel = new Sns_ShareproductModel();
		$data = $ShareshopModel->isCollect($id, $user_id);

		$arr = array();

		if ($data)
		{
			$arr['collect_id'] = $data;
			$msg    = 'success';
			$status = 200;
		}
		else
		{
			$arr['collect_status'] = 0;
			$msg    = 'failure';
			$status = 250;
		}

		$this->data->addBody(-140, $arr, $msg, $status);

	}

	/**
	 * 用户关注数目
	 *
	 * @return array $rows 返回结果1 or 0
	 * @access public
	 */
	public function getUserShareNum()
	{

		$user_id['uid'] = Perm::$userId;

		$UserShareNumModel = new Sns_ShareproductModel();
		$data = $UserShareNumModel->getUserShareNums($user_id);

		$arr = array();

		if ($data)
		{
			$arr['count'] = $data;
			$msg    = 'success';
			$status = 200;
		}
		else
		{
			$msg    = 'failure';
			$status = 250;
		}

		$this->data->addBody(-140, $arr, $msg, $status);

	}

}

?>
