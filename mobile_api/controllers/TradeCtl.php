<?php

/**
 *
 * 交易相关api
 *
 * @category   Framework
 * @package    Controller
 * @author     Xinze <xinze@live.cn>
 * @copyright  Copyright (c) 2010, 黄新泽
 * @version    1.0
 * @todo
 *
 * @see /module/product/includes/plugin_cart_class.php
 * @see /module/product/includes/plugin_order_class.php
 */
class TradeCtl extends Yf_AppController
{

	/**
	 * 读取用户购物车列表
	 *
	 * @access public
	 */
	public function cartList()
	{
		$user_id = Perm::$userId;
		//$sumprice = 0;
		$area = '';
		//判断是否是分销店
		//从购物车表按照店铺读取商品信息
		$Product_CartModel = new Product_CartModel();
		$data = $Product_CartModel->getCartClist($user_id);
		//fb($data);
        if(!empty($data))
        {
            $sumprice = 0;
            //获取店铺名称
			if(is_array($data)){
            foreach ($data as $key => $value)
            {
                $ShopModel = new ShopModel();
                $company = $ShopModel->getCompanyByUid($value['seller_id']);
                $seller_id[] = $value['seller_id'];

                $data[$key]['company'] = $company;

                //获取单个店铺商品及商品总价格、平邮、快递、EMS、总邮费
                $cart_list = $Product_CartModel->getCartList($user_id, $value['seller_id']);//cart表
                //fb($cart_list);
			if(is_array($cart_list)){
                foreach ($cart_list as $ke => $va) {
                    $cart_list[$ke]['sumprice'] = $cart_list[$ke]['price']*$cart_list[$ke]['quantity']*1;
                    $cart_list[$ke]['num'] = $cart_list[$ke]['quantity'];
                    //product表
                    $ProductModel   = new ProductModel();
                    $product_row    = $ProductModel->getProduct($va['product_id']);
                    $cart_list[$ke]['weight']   	= $product_row[$va['product_id']]['weight'];
                    $cart_list[$ke]['cubage']   	= $product_row[$va['product_id']]['cubage'];
                    $cart_list[$ke]['subhead']  	= $product_row[$va['product_id']]['subhead'];
                    $cart_list[$ke]['brand']    	= $product_row[$va['product_id']]['brand'];
                    $cart_list[$ke]['type']         = $product_row[$va['product_id']]['type'];
                    $cart_list[$ke]['is_shelves'] 	= $product_row[$va['product_id']]['is_shelves'];
                    $cart_list[$ke]['status'] 		= $product_row[$va['product_id']]['status'];
                    $cart_list[$ke]['market_price'] = $product_row[$va['product_id']]['market_price'];
                    $cart_list[$ke]['pprice'] 		= $product_row[$va['product_id']]['price'];
                    $cart_list[$ke]['amount'] 		= $product_row[$va['product_id']]['stock'];
                    $cart_list[$ke]['pname'] 		= $product_row[$va['product_id']]['name'];
                    $cart_list[$ke]['pic'] 			= $product_row[$va['product_id']]['pic'];
                    $cart_list[$ke]['catid'] 		= $product_row[$va['product_id']]['catid'];
                    $cart_list[$ke]['pid'] 			= $product_row[$va['product_id']]['id'];
                    $cart_list[$ke]['freight'] 		= $product_row[$va['product_id']]['freight_id'];
                    $cart_list[$ke]['freight_type'] = $product_row[$va['product_id']]['freight_type'];
                    $cart_list[$ke]['is_invoice'] 	= $product_row[$va['product_id']]['is_invoice'];

                    //setmeal规格表
                    if($va['spec_id'] != '0')
                    {
                        $Product_SetmealModel = new Product_SetmealModel();
                        $setmeal              = $Product_SetmealModel->getSetmeal($va['spec_id']);
                        $cart_list[$ke]['setmealname'] = $setmeal[$va['spec_id']]['setmeal'];
                        $cart_list[$ke]['spec_name']   = $setmeal[$va['spec_id']]['spec_name'];
                        $cart_list[$ke]['stock']       = $setmeal[$va['spec_id']]['stock'];
                        $cart_list[$ke]['sprice']      = $setmeal[$va['spec_id']]['price'];
                    }
                    else
                    {
                        $cart_list[$ke]['setmealname'] = '';
                        $cart_list[$ke]['spec_name']   = '';
                        $cart_list[$ke]['stock']       = '';
                        $cart_list[$ke]['sprice']      = '';
                    }

                }
			}
			$cart_pro_rows[$value['seller_id']]=$cart_list;
		}
			}

		//fb($cart_pro_rows);
		$sumprice = array();
		$lists = array();
		foreach ($cart_pro_rows as $key => $value) 
		{
			$sumprice[$key] = 0;
			foreach ($value as $ke => $val) 
			{
				$lists[$val['seller_id']]['is_invoice'] = 0;
				//fb($val);
				
				$setmealname = $val['setmealname'] ? explode(',',$val['setmealname']) : "";
				$spec_name = $val['spec_name'] ? explode(',',$val['spec_name']) : "";
				if($spec_name && $setmealname)
				{
					foreach($setmealname as $k => $v)
					{
						$cart_pro_rows[$key][$ke]['spec'][] = $spec_name[$k].":".$v;	
					}	
				}

				//产品库存数量，用套餐的替换
				$cart_pro_rows[$key][$ke]['stock'] = $stock = $val['spec_id'] ? $val['stock']:$val['amount'];

				unset($cart_pro_rows[$key][$ke]['sprice']);
				unset($cart_pro_rows[$key][$ke]['pprice']);
				unset($cart_pro_rows[$key][$ke]['amount']);

				if($stock < 1 || $val['status'] < 1 || $val['is_shelves'] < 1)
				{
					//将产品从购物车中删除
					$Product_CartModel->removeCart($val['id']);
					unset($cart_pro_rows[$key][$ke]);
				}
				else
				{
					$sumprice[$key] += $val['sumprice'];//单店总价
					//fb($key);
					if($val['is_invoice']=='true')
					{
						$lists[$val['seller_id']]['is_invoice']++;	
					}
					unset($cart_pro_rows[$key][$ke]['is_invoice']);
				}
			}
		}

		//免运费设置
		$shop_data = $ShopModel->getShop($seller_id);

        fb($lists);
        //fb($cart_pro_rows);
        //fb($shop_data);
        foreach ($shop_data as $kes =>$key) //店铺信息
        {
        $re = array();
        $list = array();
        $list['is_invoice'] = 0;
        //fb($key);
        $shop_free_shipping = $key['shop_free_shipping'];
        $shop_free_price_str = $key['shop_free_price'];
        $akey = $key['userid'];

            $shop_free_price_row = json_decode($shop_free_price_str);

            $shop_free_shipping = $shop_free_shipping ? $shop_free_shipping : "0";

            if($sumprice[$kes] >= $shop_free_shipping)
            {
                $list['mail'] = $list['ems'] = $list['express'] = 0; //免运费设置end


            }
            else
            {
                $mail = $ems = $express = 0;
                $logistics = array();
                fb($cart_pro_rows[$key['userid']]);
                //$akey = $key['userid'];
                fb($akey);
                foreach ($cart_pro_rows[$key['userid']] as $val)
                {
                    //foreach ($value as $ke => $val) {

                        //获取商品平邮、快递、EMS、总邮费
                        $logistics[$val['freight']]['freight_id'] = $val['freight'];
                        $logistics[$val['freight']]['freight_type'] = $val['freight_type'];
                        $logistics[$val['freight']]['num'] = $val['num'];
                        $logistics[$val['freight']]['weight'] = $val['weight']*$val['num'];
                        $logistics[$val['freight']]['cubage'] = $val['cubage']*$val['num'];
                    //}
                }

                foreach($logistics as $key => $val)
                {
                    if(intval($val['freight_type']))
                    {
                        //获取运费模板平邮、快递、EMS
                        $Logistics_TempModel = new Logistics_TempModel();
                        $price_types = $Logistics_TempModel->getTemp($val['freight_id']);
                        $unit = $price_types[$val['freight_id']]['price_type'];

                        //更加expess、mail、ems获取自定义物流模板内容
                        $Logistics_TempConModel = new Logistics_TempConModel();
                        $tempcon_express = $Logistics_TempConModel->getTempConByType($val['freight_id'],$area,'express',$unit,$val['num']);
                        $express +=$tempcon_express;

                        $tempcon_mail = $Logistics_TempConModel->getTempConByType($val['freight_id'],$area,'mail',$unit,$val['num']);
                        $mail +=$tempcon_mail;

                        $tempcon_ems = $Logistics_TempConModel->getTempConByType($val['freight_id'],$area,'ems',$unit,$val['num']);
                        $ems +=$tempcon_ems;
                    }
                }
                $list['mail'] = $re['mail'] = $mail;
                $list['ems'] = $re['ems'] = $ems;
                $list['express'] = $re['express'] = $express;
                if($re['mail']>0 || $re['ems']>0 || $re['express']>0)
                {
                    if($re['mail'] <= 0){$list['mails'] = 1;}else{$list['mails'] = 0;}
                    if($re['ems'] <= 0){$list['emss'] = 1;}else{$list['emss'] = 0;}
                    if($re['express'] <= 0){$list['expresss'] = 1;}else{$list['expresss'] = 0;}
                }
                else
                {
                    $list['mails'] = 0;
                    $list['emss'] = 0;
                    $list['expresss'] = 0;
                }
            }

            $list['sumprice'] = $sumprice[$kes];//单个卖家的商品总价
            $list['prolist']  = $cart_pro_rows[$akey]; //单个商店的产品列表
            //fb($list);

            //获取当前店铺下可用的代金券
            $v_price = $sumprice[$kes] ? $sumprice[$kes] : '0';
            $VoucherModel = new VoucherModel();
            $voucher[$kes] = $VoucherModel->getVoucherByMid($user_id,$kes,$v_price);

            $lists[$kes] = $list;

        }
        // fb($voucher);
        // fb($lists);
        // fb($data);
        foreach ($data as $key => $value)
        {
            $rde[$value['seller_id']] = $value;
        }
        //fb($re);
        $sumprices = 0;
            foreach ($rde as $key => $value)
            {
                if($lists[$key]['prolist'])
                {
                    $rde[$key]['sumprice']   = $lists[$key]['sumprice'];
                    $rde[$key]['voucher']    = $voucher[$key];

                    $lists[$key]['mail']    = $lists[$key]['mails'] == 1 ? 0 : $lists[$key]['mail'];
                    $lists[$key]['ems']     = $lists[$key]['emss'] == 1 ? 0 : $lists[$key]['ems'];
                    $lists[$key]['express'] = $lists[$key]['expresss'] == 1 ? 0 : $lists[$key]['express'];

                    $rde[$key]['mail']       = $lists[$key]['mail'];
                    $rde[$key]['ems']        = $lists[$key]['ems'];
                    $rde[$key]['express']    = $lists[$key]['express'];
                    $rde[$key]['is_invoice'] = $lists[$key]['is_invoice'];
                    $rde[$key]['prolist']    = $lists[$key]['prolist'];

                    $sumprices += $lists[$key]['sumprice'];

                    $de[$key] = $rde[$key];
                }
            }

            $res['cart']     = $de;
            $res['sumprice'] = $sumprices;

        }
        else
        {
            $res = array();
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

        $this->data->addBody(-140, $res, $msg, $status);
    }


	/**
	 * 商品加入购物车
	 * @param $product_id 商品ID
	 * @param $quantity 数量 默认值：1
	 * @param $spec_id 规格ID  默认值：0
	 * @access public
	 */
	public function cartAdd()
	{
		$user_id = Perm::$userId;

		$nums = request_int('quantity','1');    //数量
		$id   = request_int('pid');			//商品id
		$sid  = request_int('sid','0');
		$dist_user_id = request_int('dist_user_id');

		$dat = array();
		//判断商品是否存在，是否有效
		$ProductModel = new ProductModel();
		$goods = $ProductModel->getGoodsByPid($id);

		$Product_CartModel = new Product_CartModel();

		if ($goods)
		{
			if(!empty($sid))
			{
				$Product_SetmealModel = new Product_SetmealModel();
				$setmeal_rows = $Product_SetmealModel->getSetmeal($sid);
				$de = $setmeal_rows[$sid];

				$Product_CartModel->sql->setwhere('spec_id',$sid);
			}
			$good_row = array();
			$Product_CartModel->sql->setwhere('product_id',$id)->setwhere('buyer_id',$user_id);
			$good_rows = $Product_CartModel->getCart("*");

			//判断用户是否已将这件商品加入购物车
			if($good_rows)
			{
				foreach ($good_rows as $key => $value)
				{
					$good_row = $value;
				}
				$gquantity = $good_row['quantity']*1;
			}
			else
			{
				$gquantity = 0;
			}
			

			$stock = $sid ? $de['stock']:$goods[$id]['stock'];
			$price = $sid ? $de['price']:$goods[$id]['price'];

			fb($price);
			fb($gquantity);
			fb($stock);
			fb($nums);
			if($gquantity + $nums > $stock || $nums < 0)
			{
				//更新购物车数量
				//$filed = array('quantity' => $stock );
				//$flag =$Product_CartModel->editCart($good_row['id'],$filed);
				$flag = false;
				//$dat['reason'] = '商品库存不足，请仔细核查数量';
				//return $good_row['id'];
			}
			else
			{
				$filed_row = array();
				fb($good_row);
				if(!empty($good_row['id']))
				{
					//更新购物车数量
					$filed_row['quantity'] = $nums;
					fb($filed_row);
					$flag = $Product_CartModel->editUserCart($good_row['id'],$filed_row,$user_id,1);

					//return $good_row['id'];
				}
				else
				{
					//select `member_id` from product where id=$produc_id
					$member_id_row = $ProductModel->getProduct($id);
					$member_id = $member_id_row[$id]['member_id'];

					//select discountd from MECARD
					$Member_CardModel = new Member_CardModel();
					$discounts_row = $Member_CardModel->getCardDiscount($member_id,$user_id);

					$discounts = 0;
					if($discounts_row)
					{
						$discounts = $discounts_row['discounts'];
					}
					fb($discounts);
					if($discounts > 0)
					{
						$price = ($price * $discounts)/10;
					}
					fb($price);
					if($dist_user_id)//分销
					{

					}
					else
					{
						$field = array( 'buyer_id'     => $user_id, 
										'product_id'   => $id,
										'seller_id'    => $goods[$id]['member_id'],
										'price'		   => $price,
										'quantity'	   => $nums,
										'create_time'  => time(),
										'spec_id'	   => $sid,
										'is_tg'		   => $goods[$id]['is_tg'],
										'discounts'	   => $discounts);
						$flag = $Product_CartModel->addCart($field);


						//
					}


				}
			}
			if($flag)
			{
				$dat['msg']    = '商品已成功加入购物车';
				$msg    = 'success';
				$status = 200;
			}
			else
			{
				$dat['msg']    = '商品未成功加入购物车';
				$msg    = 'failure';
				$status = 250;
			}
		}
		else
		{
			$dat    = array();
			$msg    = '购买商品不存在或者已经下架';
			$status = 250;
		}
		fb($dat);

		$this->data->addBody(-140, $dat, $msg, $status);
	}

	/**
	 * 批量加入购物车
	 * @param $product_id 商品ID
	 * @param $quantity 数量 默认值：1
	 * @param $spec_id 规格ID  默认值：0
	 * @access public
	 */
	public function cartsAdd()
	{
		$user_id = Perm::$userId;

		/*$nums = request_int('quantity','1');    //数量
		$id   = request_int('pid');			//商品id
		$sid  = request_int('sid','0');*/
		$dist_user_id = request_int('dist_user_id');

		$nums = request_string('quantity');    //数量
		$id   = request_string('pid');			//商品id
		$sid  = request_string('sid');

		$nums_row = explode(',', $nums);
		$id_row   = explode(',', $id);
		$sid_row      = explode(',', $sid);

		$n = count($nums_row);
		for ($i=0; $i < $n; $i++) 
		{ 
			$order_pro_row[$i]['quantity'] = $nums_row[$i];
			$order_pro_row[$i]['pid'] = $id_row[$i];
			$order_pro_row[$i]['sid'] = $sid_row[$i];
		}
		fb($order_pro_row);

foreach ($order_pro_row as $kkey => $vvalue) 
{
	$flag = true;
			$nums = $vvalue['quantity'];
			$id   = $vvalue['pid'];
			$sid  = $vvalue['sid'];

		$dat = array();
		//判断商品是否存在，是否有效
		$ProductModel = new ProductModel();
		$goods = $ProductModel->getGoodsByPid($id);

		$Product_CartModel = new Product_CartModel();

		if ($goods)
		{
			if(!empty($sid))
			{
				$Product_SetmealModel = new Product_SetmealModel();
				$setmeal_rows = $Product_SetmealModel->getSetmeal($sid);
				$de = $setmeal_rows[$sid];

				$Product_CartModel->sql->setwhere('spec_id',$sid);
			}
			$good_row = array();
			$Product_CartModel->sql->setwhere('product_id',$id)->setwhere('buyer_id',$user_id);
			$good_rows = $Product_CartModel->getCart("*");

			//判断用户是否已将这件商品加入购物车
			if($good_rows)
			{
				foreach ($good_rows as $key => $value)
				{
					$good_row = $value;
				}
				$gquantity = $good_row['quantity']*1;
			}
			else
			{
				$gquantity = 0;
			}
			

			$stock = $sid ? $de['stock']:$goods[$id]['stock'];
			$price = $sid ? $de['price']:$goods[$id]['price'];

			fb($price);
			fb($gquantity);
			fb($stock);
			fb($nums);
			if($gquantity + $nums > $stock)
			{
				//更新购物车数量
				//$filed = array('quantity' => $stock );
				//$flag =$Product_CartModel->editCart($good_row['id'],$filed);
				$flag = false;
				//$dat['reason'] = '商品库存不足，请仔细核查数量';
				//return $good_row['id'];
			}
			else
			{
				$filed_row = array();
				fb($good_row);
				if(!empty($good_row['id']))
				{
					//更新购物车数量
					$filed_row['quantity'] = $nums;
					fb($filed_row);
					$flag = $Product_CartModel->editUserCart($good_row['id'],$filed_row,$user_id,1);

					//return $good_row['id'];
				}
				else
				{
					//select `member_id` from product where id=$produc_id
					$member_id_row = $ProductModel->getProduct($id);
					$member_id = $member_id_row[$id]['member_id'];

					//select discountd from MECARD
					$Member_CardModel = new Member_CardModel();
					$discounts_row = $Member_CardModel->getCardDiscount($member_id,$user_id);

					$discounts = 0;
					if($discounts_row)
					{
						$discounts = $discounts_row['discounts'];
					}
					fb($discounts);
					if($discounts > 0)
					{
						$price = ($price * $discounts)/10;
					}
					fb($price);
					if($dist_user_id)//分销
					{

					}
					else
					{
						$field = array( 'buyer_id'     => $user_id, 
										'product_id'   => $id,
										'seller_id'    => $goods[$id]['member_id'],
										'price'		   => $price,
										'quantity'	   => $nums,
										'create_time'  => time(),
										'spec_id'	   => $sid,
										'is_tg'		   => $goods[$id]['is_tg'],
										'discounts'	   => $discounts);
						$flag = $Product_CartModel->addCart($field);


						//
					}


				}
			}
			if($flag)
			{
				$dat['res']    = '商品已成功加入购物车';
				$dat['msg']    = 'success';
				$dat['status'] = 200;
				$dat['pid']    = $vvalue['pid'];
			}
			else
			{
				$dat['res']  = '商品未成功加入购物车';
				$dat['msg']    = 'failure';
				$dat['status'] = 250;
				$dat['pid']    = $vvalue['pid'];
			}
		}
		else
		{
			$dat['res']    = '购买商品不存在或者已经下架';
			$dat['msg']    = 'failure';
			$dat['status'] = 250;
			$dat['pid']    = $vvalue['pid'];
		}

		$da[$vvalue['pid']] = $dat;

}
	foreach ($da as $key => $value)
	{
		if($value['status'] == 200)
		{
			unset($da[$key]);
		}
	}
	if(!empty($da))
	{
		$msg = 'failure';
		$status = 250;
		$datas = array_keys($da);
	}
	else
	{
		$msg = 'success';
		$status = 200;
		$datas = $da;
	}

		$this->data->addBody(-140, $datas,$msg,$status);
	}

	/**
	 * 修改购物车数量
	 *
	 * @access public
	 */
	public function cartEdit()
	{
		$user_id  = Perm::$userId;
		$id       = request_int('id');
		$quantity = request_int('quantity');
		$act	  = request_int('act');  //1->+ 2->- 空->直接替换 

		$field_row['quantity'] = $quantity;

		$Product_CartModel = new Product_CartModel();
		$flag              = $Product_CartModel->editUserCart($id, $field_row, $user_id, $act);

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
	 * 读取用户购物车列表
	 *
	 * @access public
	 */
	public function cartRemove()
	{
		$user_id = Perm::$userId;

		$id_str = request_string('id');

		if ('*' == $id_str)
		{
			$id = $id_str;
		}
		else
		{
			$id = explode(',', $id_str);
		}

		$Product_CartModel = new Product_CartModel();
		$flag              = $Product_CartModel->removeUserCart($id, $user_id);

		if ($flag)
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

	//订单
	/**
	 * 订单列表
	 *
	 * @access public
	 */
	public function orderList()
	{
		$user_id = Perm::$userId;		//用户ID
		$status  = request_int('status');//订单状态
		$rate = request_int('rate');  //评价状态
		$name = request_string('name');	//商品名称

		$page = request_int('page',1);
		$rows = request_int('rows',20);



		$Product_OrderModel    = new Product_OrderModel();
		$order_rows            = $Product_OrderModel->getOrdersList($user_id,$status,$page,$rows,$rate,$name);
if(!empty($order_rows['items']))
{
		foreach ($order_rows['items'] as $k => $value) {
			//获取店铺名称
			$ShopModel         = new ShopModel();
			$company           = $ShopModel->getCompanyByUid($value['seller_id']);
			$order_rows['items'][$k]['company'] = $company;

			//获取订单商品信息
			$Product_OrderProModel = new Product_OrderProModel();
			$good_rows         = $Product_OrderProModel->getOrderProByOid($value['order_id']);
		if(is_array($good_rows)){
			foreach ($good_rows as $rowkey => $rowvalue)
			{
				
				$ProductModel   = new ProductModel();
				$product = $ProductModel->getProduct($rowvalue['pid']);
				$good_rows[$rowkey]['is_invoice'] = $product[$rowvalue['pid']]['is_invoice'];

			}
		}

			$order_rows['items'][$k]['isret'] = '0';//用于判断返修、退货
			$order_rows['items'][$k]['product'] = $good_rows;

		}
		if(is_array($order_rows['items'])){
			foreach ($order_rows['items'] as $k => $value) 
			{
				if(is_array($value['product'])){
					foreach ($value['product'] as $ke => $val)
					{
						if($val['status'] < 0  || $val['status'] >3)
						{
							$order_rows['items'][$k]['isret'] = '1';
						}
					}
				}
			}
		}
		if($status == '4')  //返修、退货
		{
			foreach ($order_rows['items'] as $key => $value) 
			{
				fb($value);
				if($value['isret'] == '1')
				{
					$order_row[]=$order_rows['items'][$key];
				}
			}

			unset($order_rows['items']);

			$offset = $rows * ($page - 1);
			$end    = $offset + ($rows-1);

			foreach ($order_row as $key => $value) 
			{
				if($key >= $offset && $key <= $end)
				{
					$order_rows['items'][$key] = $order_row[$key];
				}
			}

			$order_rows['total'] = $total = count($order_row);
			$order_rows['totalsize'] = ceil_r($total / $rows);
			$order_rows['records']   = count($order_rows['items']);

		}
}
else
{
	$order_rows = array();
}

		

fb($order_rows);

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


		$this->data->addBody(-140, $order_rows, $msg, $status);

	}



	/**
	 * 获取待付款/待收货/待评价 订单数量
	 * @param $product_id 商品ID
	 * @param $quantity 数量 默认值：1
	 * @param $spec_id 规格ID  默认值：0
	 * @access public
	 */
	public function getOrderNum()
	{
		$user_id = Perm::$userId;		//用户ID
		$status  = request_int('status');//订单状态
		$rate = request_int('rate');  //评价状态

		$Product_OrderModel   = new Product_OrderModel();
		$res                  = $Product_OrderModel->getOrdersNum($user_id,$status,$rate);

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
	 * 提交订单
	 * @param $product_id 商品ID
	 * @param $quantity 数量 默认值：1
	 * @param $spec_id 规格ID  默认值：0
	 * @access public
	 */
	public function orderAdd()
	{
		$user_id = Perm::$userId;
		$consignee_id = request_int('consignee_id'); //收货地址id
		$pid = request_string('pid_row');		 //商品id字符串
		$pid_row = explode(',', $pid);

		if($consignee_id)
		{
		
			//获取收货地址
			$Delivery_AddressModel = new Delivery_AddressModel();
			$address = $Delivery_AddressModel->getAddress($consignee_id);
			//fb($address);
			if($address)
			{

				$addr = $address[$consignee_id];
				//fb($addr);
				$on_city = $address[$consignee_id]['cityid'];

				$DistrictModel = new DistrictModel();
				$area = $DistrictModel->getdistrictname($on_city);

				//从购物车表按照店铺读取商品信息
				$Product_CartModel = new Product_CartModel();
				$data = $Product_CartModel->getCartClist($user_id);

				$sumprice = 0;
				//获取店铺名称
				foreach ($data as $key => $value)
				{
					$ShopModel = new ShopModel();
					$company = $ShopModel->getCompanyByUid($value['seller_id']);
					$seller_id[] = $value['seller_id'];

					$data[$key]['company'] = $company;

					//获取单个店铺商品及商品总价格、平邮、快递、EMS、总邮费
					$cart_list = $Product_CartModel->getCartList($user_id, $value['seller_id'], $pid_row);//cart表
			
					foreach ($cart_list as $ke => $va)
					{
						$cart_list[$ke]['sumprice'] = $cart_list[$ke]['price']*$cart_list[$ke]['quantity']*1;
						$cart_list[$ke]['num'] = $cart_list[$ke]['quantity'];
						//product表
						$ProductModel   = new ProductModel();
						$product_row    = $ProductModel->getProduct($va['product_id']);
						$cart_list[$ke]['weight']   	= $product_row[$va['product_id']]['weight'];
						$cart_list[$ke]['cubage']   	= $product_row[$va['product_id']]['cubage'];
						$cart_list[$ke]['subhead']  	= $product_row[$va['product_id']]['subhead'];
						$cart_list[$ke]['brand']    	= $product_row[$va['product_id']]['brand'];
						$cart_list[$ke]['type']         = $product_row[$va['product_id']]['type'];
						$cart_list[$ke]['is_shelves'] 	= $product_row[$va['product_id']]['is_shelves'];
						$cart_list[$ke]['status'] 		= $product_row[$va['product_id']]['status'];
						$cart_list[$ke]['market_price'] = $product_row[$va['product_id']]['market_price'];
						$cart_list[$ke]['pprice'] 		= $product_row[$va['product_id']]['price'];
						$cart_list[$ke]['amount'] 		= $product_row[$va['product_id']]['stock'];
						$cart_list[$ke]['pname'] 		= $product_row[$va['product_id']]['name'];
						$cart_list[$ke]['pic'] 			= $product_row[$va['product_id']]['pic'];
						$cart_list[$ke]['catid'] 		= $product_row[$va['product_id']]['catid'];
						$cart_list[$ke]['pid'] 			= $product_row[$va['product_id']]['id'];
						$cart_list[$ke]['freight'] 		= $product_row[$va['product_id']]['freight_id'];
						$cart_list[$ke]['freight_type'] = $product_row[$va['product_id']]['freight_type'];
						$cart_list[$ke]['is_invoice'] 	= $product_row[$va['product_id']]['is_invoice'];

						//setmeal规格表
						if($va['spec_id'] != '0')
						{
							$Product_SetmealModel = new Product_SetmealModel();
							$setmeal              = $Product_SetmealModel->getSetmeal($va['spec_id']);
							$cart_list[$ke]['setmealname'] = $setmeal[$va['spec_id']]['setmeal'];
							$cart_list[$ke]['spec_name']   = $setmeal[$va['spec_id']]['spec_name'];
							$cart_list[$ke]['stock']       = $setmeal[$va['spec_id']]['stock'];
							$cart_list[$ke]['sprice']      = $setmeal[$va['spec_id']]['price'];
						}
						else
						{
							$cart_list[$ke]['setmealname'] = '';
							$cart_list[$ke]['spec_name']   = '';
							$cart_list[$ke]['stock']       = '';
							$cart_list[$ke]['sprice']      = '';
						}

					}
					$cart_pro_rows[$value['seller_id']]=$cart_list;
				}
		
		//fb($cart_pro_rows);
		$sumprice = array();
		$lists = array();
		foreach ($cart_pro_rows as $key => $value) 
		{
			$sumprice[$key] = 0;
			foreach ($value as $ke => $val) 
			{
				//fb($val);
				$lists[$val['seller_id']]['is_invoice'] = '0';
				$setmealname = $val['setmealname'] ? explode(',',$val['setmealname']) : "";
				$spec_name = $val['spec_name'] ? explode(',',$val['spec_name']) : "";
				if($spec_name && $setmealname)
				{
					foreach($setmealname as $k => $v)
					{
						$cart_pro_rows[$key][$ke]['spec'][] = $spec_name[$k].":".$v;	
					}	
				}

				//产品库存数量，用套餐的替换
				$cart_pro_rows[$key][$ke]['stock'] = $stock = $val['spec_id'] ? $val['stock']:$val['amount'];

				unset($cart_pro_rows[$key][$ke]['sprice']);
				unset($cart_pro_rows[$key][$ke]['pprice']);
				unset($cart_pro_rows[$key][$ke]['amount']);

				if($stock < 1 || $val['status'] < 1 || $val['is_shelves'] < 1)
				{
					//将产品从购物车中删除
					$Product_CartModel->removeCart($val['id']);
					unset($cart_pro_rows[$key][$ke]);
				}
				else
				{
					$sumprice[$key] += $val['sumprice'];//单店总价
					//fb($key);
					if($val['is_invoice']=='true')
					{
						$lists[$val['seller_id']]['is_invoice']++;	
					}
					unset($cart_pro_rows[$key][$ke]['is_invoice']);
				}
			}
		}
        //fb($sumprice);
        //免运费设置
        $shop_data = $ShopModel->getShop($seller_id);
        // foreach ($shop_data as $key)
        // {
        // 	$shop_free_shipping = $key['shop_free_shipping'];
        // 	$shop_free_price_str = $key['shop_free_price'];
        // }
        //fb($cart_pro_rows);
        //fb($shop_data);
        foreach ($shop_data as $kes =>$key) //店铺信息
        {
                $re = array();
                $list = array();
                $list['is_invoice'] = 0;
                //fb($key);
                $shop_free_shipping = $key['shop_free_shipping'];
                $shop_free_price_str = $key['shop_free_price'];
                $shop_free_price_row = json_decode($shop_free_price_str);
                $shop_free_shipping = $shop_free_shipping ? $shop_free_shipping : "0";
                if($sumprice[$kes] >= $shop_free_shipping)
                {
                    $list['mail'] = $list['ems'] = $list['express'] = 0; //免运费设置end
                }
                else
                {
                    $mail = $ems = $express = 0;
                    $logistics = array();
                    //fb($cart_pro_rows[$key['userid']]);
                    $akey = $key['userid'];
                    foreach ($cart_pro_rows[$key['userid']] as $val)
                    {
                        fb($val);
                        //foreach ($value as $ke => $val) {
                            //获取商品平邮、快递、EMS、总邮费
                            $logistics[$val['freight']]['freight_id'] = $val['freight'];
                            $logistics[$val['freight']]['freight_type'] = $val['freight_type'];
                            $logistics[$val['freight']]['num'] = $val['num'];
                            $logistics[$val['freight']]['weight'] = $val['weight']*$val['num'];
                            $logistics[$val['freight']]['cubage'] = $val['cubage']*$val['num'];
                        //}
                    }

                    foreach($logistics as $key => $val)
                    {
                        if(intval($val['freight_type']))
                        {
                            //获取运费模板平邮、快递、EMS
                            $Logistics_TempModel = new Logistics_TempModel();
                            $price_types = $Logistics_TempModel->getTemp($val['freight_id']);
                            $unit = $price_types[$val['freight_id']]['price_type'];

                            //更加expess、mail、ems获取自定义物流模板内容
                            $Logistics_TempConModel = new Logistics_TempConModel();
                            $tempcon_express = $Logistics_TempConModel->getTempConByType($val['freight_id'],$area,'express',$unit,$val['num']);
                            $express +=$tempcon_express;

                            $tempcon_mail = $Logistics_TempConModel->getTempConByType($val['freight_id'],$area,'mail',$unit,$val['num']);
                            $mail +=$tempcon_mail;

                            $tempcon_ems = $Logistics_TempConModel->getTempConByType($val['freight_id'],$area,'ems',$unit,$val['num']);
                            $ems +=$tempcon_ems;
                        }
                    }
                    $list['mail'] = $re['mail'] = $mail;
                    $list['ems'] = $re['ems'] = $ems;
                    $list['express'] = $re['express'] = $express;
                    //fb($list);
                    if($re['mail']>0 || $re['ems']>0 || $re['express']>0)
                    {
                        if($re['mail'] <= 0){$list['mails'] = 1;}else{$list['mails'] = 0;}
                        if($re['ems'] <= 0){$list['emss'] = 1;}else{$list['emss'] = 0;}
                        if($re['express'] <= 0){$list['expresss'] = 1;}else{$list['expresss'] = 0;}
                    }
                    else
                    {
                        $list['mails'] = 0;
                        $list['emss'] = 0;
                        $list['expresss'] = 0;
                    }
                }

                $list['sumprice'] = $sumprice[$kes];//单个卖家的商品总价
                $list['prolist']  = $cart_pro_rows[$akey]; //单个商店的产品列表
                //fb($list);

                //获取当前店铺下可用的代金券
                $v_price = $sumprice[$kes] ? $sumprice[$kes] : '0';
                $VoucherModel = new VoucherModel();
                $voucher[$kes] = $VoucherModel->getVoucherByMid($user_id,$kes,$v_price);
                $lists[$kes] = $list;
        }
        // fb($voucher);
        // fb($lists);
        // fb($data);
		foreach ($data as $key => $value) 
		{
			$rde[$value['seller_id']] = $value;
		}
        //fb($re);
        $sumprices = 0;
		foreach ($rde as $key => $value) 
		{
			if($lists[$key]['prolist'])
			{
				$rde[$key]['sumprice']   = $lists[$key]['sumprice'];
				$rde[$key]['voucher']    = $voucher[$key];

				$lists[$key]['mail']    = $lists[$key]['mails'] == 1 ? 0 : $lists[$key]['mail'];
				$lists[$key]['ems']     = $lists[$key]['emss'] == 1 ? 0 : $lists[$key]['ems'];
				$lists[$key]['express'] = $lists[$key]['expresss'] == 1 ? 0 : $lists[$key]['express'];

				$rde[$key]['mail']       = $lists[$key]['mail'];
				$rde[$key]['ems']        = $lists[$key]['ems'];
				$rde[$key]['express']    = $lists[$key]['express'];
				$rde[$key]['is_invoice'] = $lists[$key]['is_invoice'];
				$rde[$key]['prolist']    = $lists[$key]['prolist'];

				$sumprices += $lists[$key]['sumprice'];

				$de[$key] = $rde[$key];
			}
		}

		$res['cart']     = $de;
		$res['sumprice'] = $sumprices;
		//循环店铺，生成多个订单
        fb($res);
		//合并付款
		$uprice = 0;
		$buyer = $user_id;
		$inorder = '';

		foreach ($res['cart'] as $key => $val) 
		{
			if($val['prolist'])
			{
				$sell_userid = $val['seller_id'];
				if(!empty($sell_userid))
				{
					$logistics_type  = request_string('logistics_type_'.$sell_userid);  //物流方式
					$logistics_price = request_int('logistics_price_'.$sell_userid);    //物流价格
					$invoice_title   = request_int('invoice_'.$sell_userid) > 0 ? (request_int('invoice_title_'.$sell_userid) ? request_int('invoice_title_'.$sell_userid) : $addr['name']) : "";
					$product_price   = $val['sumprice'];//购物总价
					$order_id        = date('Ymdhis').rand(0,9);//订单号
					$msg             = htmlspecialchars(request_string('msg_'.$sell_userid,'123123'));
					$time 			 = time();
					$vou_price       = 0; //优惠价格
					$discounts       = $val['discounts'];  //会员折扣
					$inorder        .=$order_id.","; 

					/*****是否使用代金券******/
					if(request_int('voucher_'.$sell_userid) != '' && request_int('voucher_'.$sell_userid) > 0)
					{
						$id = request_int('voucher_'.$sell_userid) * 1;
						
						$rest = $VoucherModel->getVoucherByMid($user_id,$sell_userid,$product_price,$id);
						if($rest)
						{
							$vo = $rest[$id];
							$vou_price = ($product_price - $vo['price'] > 0) ? $vo['price'] : $product_price;
							$vprice = $product_price - $vo['price'];
							$product_price = $vprice > 0 ? $vprice:0;

							/********更新优惠券状态 和 绑定 order_id*********/
							$VoucherModel->editVoucherStatus($order_id,$vo['id']);

							/********更新优惠券模板中的使用次数*******/
							$Voucher_Temp = new Voucher_Temp();
							$Voucher_Temp->editVoucherTempUsed($vo['temp_id']);
						}
					}

					$dist_user_id = $val['dist_user_id'];

					$Product_OrderModel = new Product_OrderModel();
					/***生成买家订单***/
					$ads = $addr['area'].' '.$addr['address'];
					$field = array(	'`userid`'           => $user_id,
									'`order_id`'		 => $order_id,
									'`buyer_id`'		 => '0',
									'`seller_id`'		 => $sell_userid,
									'`consignee`'		 => $addr['name'],
									'`consignee_address`'=> $ads,
									'`consignee_tel`'    => $addr['tel'],
									'`consignee_mobile`' => $addr['mobile'],
									'`product_price`'	 => $product_price,
									'`logistics_type`'	 => $logistics_type,
									'`logistics_price`'	 => $logistics_price,
									'`status`'			 => '1',
									'`des`'				 => $msg,
									'`create_time`'		 => $time,
									'`uptime`'			 => $time,
									'`invoice_title`'	 => $invoice_title,
									'`voucher_price`'	 => $vou_price,
									'`discounts`'		 =>	$discounts,
									'`dist_user_id`'	 => $dist_user_id
									);
					$Product_OrderModel->addOrder($field);

					/***生成卖家订单***/
					$fiel = array(	'`userid`'           => $sell_userid,
									'`order_id`'		 => $order_id,
									'`buyer_id`'		 => $user_id,
									'`seller_id`'		 => '0',
									'`consignee`'		 => $addr['name'],
									'`consignee_address`'=> $ads,
									'`consignee_tel`'    => $addr['tel'],
									'`consignee_mobile`' => $addr['mobile'],
									'`product_price`'	 => $product_price,
									'`logistics_type`'	 => $logistics_type,
									'`logistics_price`'	 => $logistics_price,
									'`status`'			 => '1',
									'`des`'				 => $msg,
									'`create_time`'		 => $time,
									'`uptime`'			 => $time,
									'`invoice_title`'	 => $invoice_title,
									'`voucher_price`'	 => $vou_price,
									'`discounts`'		 =>	$discounts,
									'`dist_user_id`'	 => $dist_user_id);
					$Product_OrderModel->addOrder($fiel);

					foreach ($val['prolist'] as $key => $val) 
					{
						$val['spec_id'] = $val['spec_id']?$val['spec_id']:"0";
						//插入订单商品表
						$Product_OrderProModel =new Product_OrderProModel();
						$file = array(	'order_id'  => $order_id,
										'buyer_id'  => $user_id,
										'pid'		=> $val['product_id'],
										'pcatid'	=> $val['catid'],
										'name'		=> $val['pname'],
										'pic'		=> $val['pic'],
										'price'		=> $val['price'],
										'num'		=> $val['quantity'],
										'time'		=> time(),
										'setmeal'	=> $val['spec_id'],
										'is_tg'		=> $val['is_tg'],
										'spec_name'	=> $val['spec_name'],
										'spec_value'=> $val['setmealname']);
						$Product_OrderProModel->addOrderPro($file);

						//查找商品详情
						$Product_DetailModel = new Product_DetailModel();
						$detail_rows = $Product_DetailModel->getDetails($val['product_id']);
						//fb($detail_rows);
						//$a = array('1' => '=========================', '2'=>'=================');
						//fb($a);
						//fb($detail_rows[$val['product_id']]['detail']);
						$datial = addslashes($detail_rows[$val['product_id']]['detail']);
						//fb($datial);

						//插入快照表
						$Product_SnapshotModel = new Product_SnapshotModel();
						$filed = array( 'order_id'   => $order_id, 
										'product_id' => $val['product_id'],
										'spec_id'	 => $val['spec_id'],
										'member_id'	 => $sell_userid,
										'shop_id'	 => $sell_userid,
										'catid'		 => $val['catid'],
										'type'		 => $val['type'],
										'name'		 => $val['pname'],
										'subhead'	 => $val['subhead'],
										'brand'		 => $val['brand'],
										'price'		 => $val['price'],
										'freight'	 => '0',
										'pic'		 => $val['pic'],
										'uptime'	 => time(),
										'detail'	 => $datial,
										'spec_name'	 => $val['spec_name'],
										'spec_value' => $val['setmealname']);
						$Product_SnapshotModel->addSnapshot($filed);


					}

					$post = array();
					$post['action']='add';//填加流水
					$post['type']=2;//担保接口
					$post['seller_email'] = $sell_userid;//卖家账号
					$post['buyer_email'] = $user_id;//买家账号
					$post['order_id'] = $order_id;//外部订单号
					$post['price'] = $product_price*1 + $logistics_price*1;//订单总价，单价元
					$post['extra_param'] = '';//自定义参数，可存放任何内容

					$Web_Config = new Web_ConfigModel();
					$weburl     = $Web_Config->getProConfig('weburl');

					$post['return_url'] = $weburl.'/api/order.php?id='.$order_id;//返回地址
					$post['notify_url'] = $weburl.'/api/order.php?id='.$order_id;//异步返回地址
					$post['name']="订单【".$order_id."】消费";

					$uprice += $post['price'];

					//$res=pay_get_url($post,true);//跳转至订单生成页面
					$res = PayHelper::getPayUrl($post);
					fb($res);
					// if($res<0)
					// {
					// 	if($res==-2)
					// 		msg('main.php?m=payment&s=admin_info','您的支付账户还没有开通');
					// 	if($res==-1)
					// 		msg("$config[weburl]/?m=product&s=confirm_order",'卖家没有开通支付功能，暂不能购买');	
					// }
					if($res >=0)
					{
						$flag = true;
						$dat = array('message' => '订单提交成功');
					}
					
				}
			}
		}

		//插入合并支付表
		$uorder  = "U".date("Ymdhis",time()).rand(100,999);  //18位
		$inorder = substr($inorder, 0, -1);

		$fild = array(  'order_id'       => $uorder,
						'inorder'     =>$inorder,
						'price'       =>$uprice,
						'create_time' => time() );

		$Product_UnionOrderModel = new Product_UnionOrderModel();
		$Product_UnionOrderModel->addUnionOrder($fild);

		$post = array();
		$post['action']='add';//填加流水
		$post['type']=2;//担保接口
		$post['seller_email'] = "Myzx168@163.com";//卖家账号
		$post['buyer_email'] = $user_id;//卖家账号
		$post['order_id'] = $uorder;//外部订单号
		$post['price'] = $uprice;//订单总价，单价元
		$post['extra_param'] = $inorder;//自定义参数，可存放任何内容
		$post['return_url'] = $weburl.'/api/order.php?id='.$uorder;//返回地址
		$post['notify_url'] = $weburl.'/api/order.php?id='.$uorder;//异步返回地址
		$post['name']="订单【".$order_id."】合并消费";

		PayHelper::getPayUrl($post);

		$dat = array( 'uorder' => $uorder,
					  'uprice' => $uprice);

		//----清空购物车
		$flag = $Product_CartModel->removeUserCart($pid_row,$user_id);

		//更改流水订单状态
        }
        else
        {
            $flag = false;
            $dat = array('message' => '请填写正确的收货地址');
        }
        }
        else
        {
            $flag = false;
            $dat = array('message' => '请填写收货地址');
        }

        if ($flag)
        {
            $msg    = 'success';
            $status = 200;
        }
        else
        {
            $msg    = 'failure';
            $status = 250;
        }
		$this->data->addBody(-140, $dat, $msg, $status);
	}

	/**
	 * 读取用户订单列表
	 *
	 * @access public
	 */
	public function orderEdit()
	{
		$user_id  = Perm::$userId;

		$data['id']                     = $_REQUEST['id']                 ; // ID
		$data['userid']                 = $_REQUEST['userid']             ; // 会员ID
		$data['order_id']               = $_REQUEST['order_id']           ; // 订单ID
		$data['out_trade_no']           = $_REQUEST['out_trade_no']       ; //
		$data['buyer_id']               = $_REQUEST['buyer_id']           ; // 买家ID
		$data['seller_id']              = $_REQUEST['seller_id']          ; // 卖家ID
		$data['consignee']              = $_REQUEST['consignee']          ; // 收货人姓名
		$data['consignee_address']      = $_REQUEST['consignee_address']  ; // 收货人地址
		$data['consignee_tel']          = $_REQUEST['consignee_tel']      ; // 收货人电话
		$data['consignee_mobile']       = $_REQUEST['consignee_mobile']   ; // 收货人手机
		$data['product_price']          = $_REQUEST['product_price']      ; // 订购价格
		$data['logistics_type']         = $_REQUEST['logistics_type']     ; // 物流类型
		$data['logistics_price']        = $_REQUEST['logistics_price']    ; // 物流类型
		$data['logistics_name']         = $_REQUEST['logistics_name']     ; // 物流公司名称
		$data['invoice_no']             = $_REQUEST['invoice_no']         ; // 物流发货单号
		$data['invoice_title']          = $_REQUEST['invoice_title']      ; //
		$data['payment_name']           = $_REQUEST['payment_name']       ; // 支付名称
		$data['status']                 = $_REQUEST['status']             ; // 定单状态
		$data['return_status']          = $_REQUEST['return_status']      ; // 退货/款状态
		$data['buyer_comment']          = $_REQUEST['buyer_comment']      ; // 卖家是否评论
		$data['seller_comment']         = $_REQUEST['seller_comment']     ; // 买家是否评论
		$data['des']                    = $_REQUEST['des']                ; // 备注
		$data['create_time']            = $_REQUEST['create_time']        ; // 下定单时间
		$data['payment_time']           = $_REQUEST['payment_time']       ; // 支付时间
		$data['deliver_time']           = $_REQUEST['deliver_time']       ; // 配送时间
		$data['uptime']                 = $_REQUEST['uptime']             ; // 更新时间
		$data['time_expand']            = $_REQUEST['time_expand']        ; // 延长时间
		$data['voucher_price']          = $_REQUEST['voucher_price']      ; // 优惠价格计算
		$data['discounts']              = $_REQUEST['discounts']          ; // 会员折扣
		$data['is_virtual']             = $_REQUEST['is_virtual']         ; // 是否为虚拟商品 1是，0不是 默认0
		$data['dist_user_id']           = $_REQUEST['dist_user_id']       ; // 分销者Id



		$Product_OrderModel = new Product_OrderModel();
		$flag              = $Product_OrderModel->editUserOrder($id, $data, $user_id);

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
	 * 删除用户购物车
	 *
	 * @access public
	 */
	public function orderRemove()
	{
		$user_id = Perm::$userId;

		$id_str = request_string('id');

		if ('*' == $id_str)
		{
			$id = $id_str;
		}
		else
		{
			$id = implode(',', $id_str);
		}

		$Product_OrderModel = new Product_OrderModel();
		$flag              = $Product_OrderModel->removeUserOrder($id, $user_id);

		if ($flag)
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
	 * 删除订单
	 *	$status = '-1'
	 * @access public
	 */
	public function orderDelete()
	{
		$user_id = Perm::$userId;
		$order_id = request_string('id');
		$status   = '-1';

		//更改订单状态
		$Product_OrderModel = new Product_OrderModel();
		$flag=$Product_OrderModel->editOrderStatus($order_id,$status,$user_id);

		if ($flag)
		{
			$msg    = 'success';
			$status = 200;
			$dat['massage'] = '订单删除成功';
		}
		else
		{
			$msg    = 'failure';
			$status = 250;
			$dat['massage'] = '订单删除失败';
		}


		$this->data->addBody(-140, $dat, $msg, $status);


	}

	/**
	 * 订单查找
	 *	$status = '0'
	 * @access public
	 */
	public function OrderSearch()
	{
		$user_id  = Perm::$userId;
		//订单id
		$order_id = request_string('orderid');

		$name = request_string('name');

		//搜索订单商品名称
		$Product_OrderProModel = new Product_OrderProModel();
		$Product_OrderProModel->sql->setWhere('name','%'.$name.'%','LIKE')->setWhere('userid',$user_id);
		$pro_row = $Product_OrderProModel->getOrderPro("*");
		fb($pro_row);
		//1.获取订单详情
		/*
		$Product_OrderModel = new Product_OrderModel();
		$Product_OrderModel->sql->setWhere('order_id',$order_id)->setWhere('userid',$user_id);
		$order_row = $Product_OrderModel->getOrder("*");
		fb($order_row);
		$Product_OrderProModel = new Product_OrderProModel();
		$Product_OrderProModel->sql->setWhere('order_id',$order_id);
		$pro_row = $Product_OrderProModel->getOrderPro("*");
		fb($pro_row);
		*/
		$data = $pro_row;
		

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
	 * 退款/退货
	 *	$status = '0'
	 * @access public
	 */
	public function OrderRefund()
	{
		$user_id  = Perm::$userId;
		//订单id
		$order_id = request_string('orderid');
		//订单商品id
		$proid    = request_int('proid');
		//退款原因
		$reason   = request_string('reason');
		//上传凭证(图片)
		//$pic      = request_string('pic');
		$pic = '';


		$flag = false;

		if (isset($_FILES['pic']))
		{
			//处理上传logo
			$upload = new HTTP_Upload('en');
			$files  = $upload->getFiles();

			if (PEAR::isError($files))
			{
				$data['msg'] = '用户图片上传错误';
				$flag = false;
			}
			else
			{
				foreach ($files as $file)
				{
					if ($file->isValid())
					{

						$config = Yf_Registry::get('config');

						$p = '/uploadfile/apply/';

						$ist = $image_config['image_storage_type'] ? $image_config['image_storage_type'] : "1";

						switch ($ist)
						{
							case "1":
							{
								$p .= date('Y') . '/' . date('m') . '/' . date('d') . '/';
								break;
							}
							case "2":
							{
								$p .= date('Y') . '/' . date('m') . '/';
								break;
							}
							case "3":
							{
								$p .= date('Y') . '/';
								break;
							}
							default:
							{
								break;
							}
						}

						$path = $config['webroot'] . $p;

						if (!file_exists($path))
						{
							make_dir_path($path);
						}

						$file->setName('uniq');

						$file_name = $file->moveTo($path);

						if (PEAR::isError($file_name))
						{
							$flag = false;
							$data['msg'] = $file->getMessage();
						}
						else
						{
							$data['attachment_mime_type'] = $file->upload['type']; // 上传的附件类型

							$data_row['mime']    = $file->upload['type'];
							$data_row['type']    = 'image';
							$data_row['subtype'] = $file->upload['upload'];


							$url = $config['weburl'] . $p .  $file->upload['name'];

							$logo = $url;
							$pic = $logo;
							fb($pic);

						}
					}
					else
					{
						$flag = false;
						$data['msg'] = '上传图片发生错误' . $_FILES['upload']['name'];
					}
				}

			}
		}

		$MemberModel = new MemberModel();
		$user_row = $MemberModel->getMember($user_id);
		$user_name = $user_row[$user_id]['user'];

		//1.获取订单详情
		$Product_OrderModel = new Product_OrderModel();
		$Product_OrderModel->sql->setWhere('order_id',$order_id)->setWhere('userid',$user_id);
		$order_row = $Product_OrderModel->getOrder("*");
		//fb($order_row);
		foreach ($order_row as $key => $value) 
		{
			$opinfo['userid'] = $value['userid'];
			$opinfo['order_id'] = $value['order_id'];
			$opinfo['buyer_id'] = $value['buyer_id'];
			$opinfo['seller_id'] = $value['seller_id'];
			$opinfo['status'] = $value['status'];
			$opinfo['product_price'] = $value['product_price'];
		}

		$Product_OrderProModel = new Product_OrderProModel();
		$Product_OrderProModel->sql->setWhere('order_id',$order_id)->setWhere('id',$proid);
		$pro_row = $Product_OrderProModel->getOrderPro("*");
		//fb($pro_row);
		foreach ($pro_row as $key => $value) 
		{
			$opinfo['price'] = $value['price'];
			$opinfo['num'] = $value['num'];
			$opinfo['name'] = $value['name'];
			$opinfo['pic'] = $value['pic'];
			$opinfo['pid'] = $value['id'];
		}

		$ShopModel = new ShopModel();
		$ShopModel->sql->setWhere('userid',$opinfo['seller_id']);
		$shop_row = $ShopModel->getShop("*");
		//fb($shop_row);
		foreach ($shop_row as $key => $value) 
		{
			$opinfo['user'] = $value['user'];
			$opinfo['company'] = $value['company'];
		}

		$ReturnModel = new ReturnModel();
		$ReturnModel->sql->setWhere('order_id',$order_id)->setWhere('member_id',$user_id)->setWhere('status','0','>')->setWhere('product_id',$proid);
		$return_row = $ReturnModel->getReturn('*');
		foreach ($return_row as $key => $value) 
		{
			unset($return_row[$key]['status']);
		}

		$info_row = array_merge($opinfo,$return_row);

		fb($info_row);

		$T = time();
		$R = "R".$T;
		if($info_row['status'] == '2')
		{
			$goods_status = '0';
		}
		if($info_row['status'] == '4')
		{
			$goods_status = '1';
		}
		else
		{
			$goods_status = '0';
		}

		$types = $opinfo['status'] == 2?"1":"2";

		$field = array( 'order_id'		=> $order_id,
						'refund_id'		=> $R,
						'product_id'	=> $proid,
						'seller_id'		=> $info_row['seller_id'],
						'member_id' 	=> $user_id,
						'refund_price'  => $info_row['product_price'],
						'create_time'   => time(),
						'reason' 		=> $reason,
						'status'		=> '1',
						'goods_status'  => $goods_status,
						'type'   		=> $types
					  );
		$ReturnModel->addReturn($field);

		$type_name = $types ==2 ? "退货退款":"仅退款";
		$goods_status_name = $goods_status == 1 ? "买家已收到货":"买家未收到货";
		$msg="买家（".$user_name."）于".date("Y-m-d H:i:s",$T)." 创建了退款申请。买家要求：".$type_name."，货物状态：".$goods_status_name."，退款金额：".$info_row['product_price']."元，退款原因：".$reason;
		$field2 = array( 'refund_id'	=> $R,
						 'order_id'		=> $order_id,
						 'member_id'	=> $user_id,
						 'type'			=> '1',
						 'content'		=> $msg,
						 'pic'			=> $pic,
						 'create_time'	=> time(),
						);
		$TalkModel = new TalkModel();
		$TalkModel->addTalk($field2);

		//set_order_product_statu($_POST['order_id'],'5',$_POST['id']);
		$Product_OrderProModel = new Product_OrderProModel();
		$close_reason = $Product_OrderProModel->editOrderProStatus($order_id,'5',$proid);

		if($close_reason)
		{
			//更新退货表
			$ReturnModel = new ReturnModel();
			$ReturnModel->editReturnCreason($order_id,$close_reason);
		}

		if ($close_reason)
		{
			$msg    = 'failure';
			$status = 250;
		}
		else
		{
			$msg    = 'success';
			$status = 200;
		}

		$data = array();

		$this->data->addBody(-140, $data, $msg, $status);
		
	}

	/**
	 * 取消订单（未付款）
	 *	$status = '0'
	 * @access public
	 */
	public function orderCancel()
	{
		$user_id  = Perm::$userId;
		$order_id = request_string('id');
		$reason   = request_string('state_info');
		$status   = '0';

		//更新订单商品表中的reason字段
		$Product_OrderProModel = new Product_OrderProModel();
		$Product_OrderProModel->editOrderReason($order_id,$reason);

		//更改订单状态
		$Product_OrderModel = new Product_OrderModel();
		$data=$Product_OrderModel->editOrderStatus($order_id,$status,$user_id);

		if ($data) 
		{
			//更改订单商品状态
			$close_reason = $Product_OrderProModel->editOrderProStatus($order_id,$status);

			if($close_reason)
			{
				//更新退货表
				$ReturnModel = new ReturnModel();
				$ReturnModel->editReturnCreason($order_id,$close_reason);
			}

			$flag = true;
			$dat['message'] = '订单取消成功';
		}else
		{
			$flag = false;
			$dat['message'] = '订单取消失败';
		}

		if ($flag)
		{
			$msg    = 'success';
			$status = 200;
		}
		else
		{
			$msg    = 'failure';
			$status = 250;
		}


		$this->data->addBody(-140, $dat, $msg, $status);

		

	}

	/**
	 * 确认订单
	 *	$status = '4'
	 * @access public
	 */
	public function orderFirm()
	{
		$status   = '4';
		$user_id  = Perm::$userId;
		$order_id = request_string('id');

		$flag = true;
		// $tmpPwd   = request_string('tmpPwd');
		// $tmpPwd   = md5($tmpPwd);

		//校验支付密码
		// $Pay_MemberModel = new Pay_MemberModel();
		// $id_row = $Pay_MemberModel->getPayPass($tmpPwd,$user_id);

		$one_price = 0;
		$id_row = 1;
		if($id_row)
		{
			//更改订单状态
			$Product_OrderModel = new Product_OrderModel();
			$data=$Product_OrderModel->editOrderStatus($order_id,$status,$user_id);

			if(!$data['flag'])
			{
				$flag = false;
				$data = array();
			}else{
				$data = $data['pay_member'];
			
				//更改订单商品状态
				$Product_OrderProModel = new Product_OrderProModel();
				$res = $Product_OrderProModel->editOrderProStatus($order_id,$status);

				//添加积分
				foreach ($data as $key) {
					$sum = ($key['product_price'] + $key['logistics_price'])*1;	
				}
				
				$Member_InfoModel = new Member_InfoModel();
				$desc = $Member_InfoModel->addPoints($sum, '1', $order_id, $user_id);

				//添加积分流水
				//1.获取用户名
				$MemberModel = new MemberModel();
				$member = $MemberModel->getMember($user_id);
				
				foreach ($member as $key) {
					$user = $key['user'];
				}
				//2.插入积分流水表中
				$field = array('member_id'    => $user_id,
								'member_name' => $user,
								'points'	  => $sum,
								'type'		  => 1,
								'create_time' => time(),
								'`desc`'        => $desc);
				$Points_LogModel = new Points_LogModel();
				$Points_LogModel->addLog($field);

				//佣金计算
				//1.获取订单商品
				$good_rows = $Product_OrderProModel->getOrderProByOid($order_id);  
				foreach ($good_rows as $k => $val) 
				{
					fb($val);
					//获取商品分类的佣金比
					$Product_CatModel = new Product_CatModel();
					$cat_row = $Product_CatModel->getCat($val['pcatid']);
					foreach ($cat_row as $key => $value) {
						fb($value);
						$price = $val['price']*$value['commission']*$val['num'];
						fb($price);
					}
					$one_price += $price;
					fb($one_price);
				}

				if($one_price > 0)
				{
					//--------------写入流水账。卖家扣相关的费用=总站佣金+分站佣金。
					$post['type']=1;//直接到账
					$post['action']='add';//
					$post['buyer_email']=$user_id;//
					$post['seller_email']='0';//
					$post['order_id']='C'.time();//外部订单号
					$post['extra_param'] = 'Commission';
					$post['price'] = $one_price;//订单总价，单价元
					$post['name1'] = '订单'.$order_id.'拥金收入';
					$post['name'] = '订单'.$order_id.'拥金支出';
					//pay_get_url($post,true);//跳转至订单生成页面
					PayHelper::getPayUrl($post);
				}
			}	

		}

		if ($flag)
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
	 * 获取订单商品列表
	 *	
	 * @access public
	 */
	public function orderGoodsList()
	{
		$user_id  = Perm::$userId;
		$order_id = request_int('order_id','201504210951058');

		$Product_OrderProModel = new Product_OrderProModel();
		$order_row = $Product_OrderProModel->getOrderProByOid($order_id);
		

		foreach ($order_row as $key => $value) 
		{
			$ProductModel = new ProductModel();
			$product_row = $ProductModel->getProduct($value['pid']);
			fb($product_row);
			$order_row[$key]['userid'] = $product_row[$value['pid']]['member_id'];
			$order_row[$key]['user'] = $product_row[$value['pid']]['member_name'];
			$order_row[$key]['bprice'] = $product_row[$value['pid']]['price'];
		}
		fb($order_row);

		if ($order_row)
		{
			$msg    = 'success';
			$status = 200;
		}
		else
		{
			$msg    = 'failure';
			$status = 250;
		}
		$this->data->addBody(-140, $order_row, $msg, $status);
	}

	/**
	 * 支付成功后修改订单状态与商品库存
	 *	$status = '2'
	 * @access public
	 */
	public function editOrderStatus()
	{
		$user_id = Perm::$userId;
		$order_id = request_string('order_id');
		$payment_name = request_string('payment_name');  //支付方式
		$flag = 1;
		fb($flag);
		//$order_id = '201512041205272';
		$status  = '2';

		//修改支付订单
		$Pay_CashflowModel = new Pay_CashflowModel();
		$data = $Pay_CashflowModel->editOrderStatus($order_id,$status);
		fb($data);
		if($data)  //订单状态改变
		{
			//合并支付订单
			if(substr($order_id, 0,1) == "U")
			{
				$Product_UnionOrderModel = new Product_UnionOrderModel();
				$data     = $Product_UnionOrderModel->getUnionInfo($order_id);
				$id       = $data['id'];
				$inorder  = explode(',', $data['inorder']);
				//fb($inorder);

				// 更新合并订单状态
				$field = array('status' => 2);
				$Product_UnionOrderModel->editUnionOrder($id,$field);

				foreach ($inorder as $key => $val) //合并订单中的单个订单
				{
					//修改订单状态
					$file1 = array( 'status'       => 2,
									'payment_name' => $payment_name,
									'payment_time' => time() 
								 );
					$Product_OrderModel = new Product_OrderModel();
					$Product_OrderModel->sql->setWhere('order_id',$val);
					$order = $Product_OrderModel->getOrder("*");
					foreach ($order as $k => $v) 
					{
						$Product_OrderModel->editOrder($v['id'],$file1);
					}
					

					//获取订单商品详情
					$Product_OrderProModel = new Product_OrderProModel();
					$good_rows = $Product_OrderProModel->getOrderProByOid($val); 
					foreach ($good_rows as $key => $value) 
					{
						//修改订单商品状态
						$file2  = array('status' => 1);
						$Product_OrderProModel->editOrderPro($value['id'],$file2);
						//fb($value);

						$status = $value['status'];
						$pid    = $value['pid'];
						//fb($status);
						
						if($status < 2)
						{
							//---------------------付款成功减库存
							if(!empty($value['num']))
							{
								//修改商品销售数量
								$ProductModel = new ProductModel();
								$ProductModel->editProuductSales($value['pid'],$value['num']);
										
								if($value['setmeal'])
								{
									//修改规格库存数量
									$Product_SetmealModel = new Product_SetmealModel();
									$Product_SetmealModel->editSetmealStock($value['setmeal'],$value['num']);
								}		
							
								//修改商品库存
								$ProductModel->editProuductStock($value['pid'],$value['num']);
		
							}

						}
					}

				}

			}
			else //非合并订单支付
			{
				    //修改订单状态
					$file1 = array( 'status'       => 2,
									'payment_name' => $payment_name,
									'payment_time' => time() 
								  );
					$Product_OrderModel = new Product_OrderModel();
					$Product_OrderModel->sql->setWhere('order_id',$order_id);
					$order = $Product_OrderModel->getOrder("*");

					foreach ($order as $k => $v) 
					{
						$Product_OrderModel->editOrder($v['id'],$file1);
					}

					//获取订单商品详情
					$Product_OrderProModel = new Product_OrderProModel();
					$good_rows = $Product_OrderProModel->getOrderProByOid($order_id); 
					foreach ($good_rows as $key => $value) 
					{
						//修改订单商品状态
						$file2  = array('status' => 1);
						$Product_OrderProModel->editOrderPro($value['id'],$file2);
						//fb($value);

						$status = $value['status'];
						$pid    = $value['pid'];
						//fb($status);
						
						if($status < 2)
						{
							//---------------------付款成功减库存
							if(!empty($value['num']))
							{
								//修改商品销售数量
								$ProductModel = new ProductModel();
								$ProductModel->editProuductSales($value['pid'],$value['num']);
										
								if($value['setmeal'])
								{
									//修改规格库存数量
									$Product_SetmealModel = new Product_SetmealModel();
									$Product_SetmealModel->editSetmealStock($value['setmeal'],$value['num']);
								}		
							
								//修改商品库存
								$ProductModel->editProuductStock($value['pid'],$value['num']);
		
							}

						}
					}
			}
				
		}
		else
		{
			$flag = 0;
		}

		$res = array();
		if ($flag)
		{
			$msg    = 'success';
			$status = 200;
		}
		else
		{
			$msg    = 'success';
			$status = 200;
			$res = array('message'=>'已支付');
		}

		$this->data->addBody(-140, $res, $msg, $status);
	}

	public function getCartNum()
	{
		$user_id = Perm::$userId;

		$res['num'] = 0;
		$Product_CartModel = new Product_CartModel();
		$data = $Product_CartModel->getCartlist($user_id);
		fb($data);
		foreach ($data as $key => $value) 
		{
			$res['num'] += $value['quantity'];
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

		$this->data->addBody(-140, $res, $msg, $status);
	}

}

?>
