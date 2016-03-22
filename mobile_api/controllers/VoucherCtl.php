<?php
/**
 * jsonp
 *
 * 其它服务器回调
 *
 * @category   Framework
 * @package    Controller
 * @author     Xinze <xinze@live.cn>
 * @copyright  Copyright (c) 2010, 黄新泽
 * @version    1.0
 * @todo
 */
class VoucherCtl extends Yf_AppController
{
	public function get()
	{
		$user_id = Perm::$userId;
		$status  = request_int('status');
		$shop_id  = request_int('shop_id', 0);

		$VoucherModel = new VoucherModel();
		
		//$data = array();
		$data = $VoucherModel->getVoucherList($user_id, $status, $shop_id);
		
		if (true)
		{
			$msg = 'success';
			$status = 200;
		}
		else
		{
			$msg = 'failure';
			$status = 250;
		}


		$this->data->addBody(-140, $data, $msg, $status);
	}


	public function getShopVoucherList()
	{
		$user_id = Perm::$userId;
		$shop_id  = $user_id;

		$VoucherModel = new VoucherModel();

		//$data = array();
		$page = request_int('page', 1);
		$rows = request_int('rows', 10);
		$sort = request_string('sort', 'asc');

		$status  = request_int('status');

		$data = $VoucherModel->getVoucherByShopId($shop_id, $status);

		if (true)
		{
			$msg = 'success';
			$status = 200;
		}
		else
		{
			$msg = 'failure';
			$status = 250;
		}


		$this->data->addBody(-140, $data, $msg, $status);
	}

	//兑换代金券
	public function exchangeVoucher()
	{
		$user_id = Perm::$userId;

		$shop_id  = request_int('shop_id');
		$temp_id  = request_int('temp_id');

		/*

if($points>=$temp_row['points'])
{



        if($db -> query($sql))
        {

        }

        echo "<h2 style='text-align:center;line-height:48px;'>恭喜您，兑换成功！</h2>";
}
else
{
        echo "<h2 style='text-align:center;line-height:48px;'>积分不足，兑换失败！</h2>";
}
		 * */
		$Voucher_TempModel = new Voucher_TempModel();
		$temp_rows = $Voucher_TempModel->getTemp($temp_id);
		fb($temp_rows);

		$temp_row = $temp_rows[$temp_id];

		//得到一个有限代金券
		$VoucherModel = new VoucherModel();
		$voucher_rows = $VoucherModel->getUserVoucherByTempId($user_id, $temp_id);
		$num = count($voucher_rows);

		if($num >= $temp_row['eachlimit']) // 每人限制领取几张
		{
			$flag = false;
			$msg = '每人限制领取 ' . $temp_row['eachlimit'] . '张';
		}
		else if($temp_row['total'] <= $temp_row['giveout']) // 兑换完了
		{

			$flag = false;
			$msg = '您来晚了,代金券已经兑换完了~';
		}
		else
		{
			//减少用户积分
			$points = $temp_rows[$temp_id]['points'];

			$serial = time().rand(100000, 999999);

			$field_row = array();
			$field_row['serial'] = $serial;
			$field_row['temp_id'] = $temp_id;
			$field_row['name'] = $temp_row['name'];
			$field_row['desc'] = $temp_row['desc'];
			$field_row['start_time'] = $temp_row['start_time'];
			$field_row['end_time'] = $temp_row['end_time'];
			$field_row['price'] = $temp_row['price'];
			$field_row['`limit`'] = $temp_row['limit'];
			$field_row['shop_id'] = $temp_row['shop_id'];
			$field_row['status'] = 1;
			$field_row['create_time'] = time();
			$field_row['member_id'] = $user_id;
			$field_row['member_name'] = Perm::$row['user'];
			$field_row['logo'] = $temp_row['logo'];
			$field_row['shop_name'] = $temp_row['shop_name'];
			$field_row['name'] = $temp_row['name'];

			$flag = $VoucherModel->addVoucher($field_row);

			//更新模板数量
			// 增加模板表中的已发放数量
			$temp_field_row = array();
			$temp_field_row['giveout'] = $temp_row['giveout'] + 1;
			$temp_rows = $Voucher_TempModel->editTemp($temp_id, $temp_field_row);


			//$flag=$member->add_points(-$temp_row['points'],'7','',$buid);
			//$flag=$member->add_points($temp_row['points'],'7','',$temp_row['shop_id']);
			//买家扣除积分
			$Member_InfoModel = new Member_InfoModel();
			$member_info_rows = $Member_InfoModel->getInfo($user_id);
			$member_info_row = $member_info_rows[$user_id];

			$points_field_row = array();
			$points_field_row['points'] = $member_info_row['points'] - $temp_row['points'];
			$Member_InfoModel->editInfo($user_id, $points_field_row);


			//卖家增

			$points_field_row = array();
			$points_field_row['points'] = $member_info_row['points'] + $temp_row['points'];
			$Member_InfoModel->editInfo($temp_row['shop_id'], $points_field_row);
		}


		if ($flag)
		{
			$msg = 'success';
			$status = 200;
		}
		else
		{
			$msg = isset($msg) ? $msg : 'failure';
			$status = 250;
		}

		$this->data->addBody(-140, array(), $msg, $status);
	}

	//
	public function getShopVoucherTemp()
	{
		$user_id = Perm::$userId;
		$shop_id  = request_int('shop_id');

		$Voucher_TempModel = new Voucher_TempModel();

		//$data = array();
		$page = request_int('page', 1);
		$rows = request_int('rows', 10);
		$sort = request_string('sort', 'asc');

		$status  = request_int('status');

		$data = $Voucher_TempModel->getVoucherTempByShopId($shop_id, $status);

		if (true)
		{
			$msg = 'success';
			$status = 200;
		}
		else
		{
			$msg = 'failure';
			$status = 250;
		}

		$this->data->addBody(-140, $data, $msg, $status);
	}


	//获取代金券数量
	public function getVoucherNum()
	{
		$user_id = Perm::$userId;
		$VoucherModel = new VoucherModel();
		
		//$data = array();
		$data = $VoucherModel->getVoucherNum($user_id);
		
		if ($data)
		{
			$msg = 'success';
			$status = 200;
		}
		else
		{
			$msg = 'failure';
			$status = 250;
		}


		$this->data->addBody(-140, $data, $msg, $status);
	}


	//获取附近代金券
	//取得店铺代金券, 使用新接口api
	public function getNearVoucher()
	{
		//后台设置获取概率

		$Web_Config = new Web_ConfigModel();

		$distance = $Web_Config->getProConfig('p_v_distance');
		$p_v_rand = $Web_Config->getProConfig('p_v_rand');

		$p_v_rand = intval($p_v_rand * 100);
		$fetch_flag = rand(1, 100) < $p_v_rand;

		$data = array();

		if (1 == $fetch_flag)
		{
			$user_id = Perm::$userId;
			$VoucherModel = new VoucherModel();

			$lng = request_float('lng');
			$lat = request_float('lat');
			$limit = 1;

			//去的附近的店铺
			//单位米
			$ShopModel = new ShopModel();
			$shop_rows = $ShopModel->getNearShopVoucher($lat, $lng, $distance, $limit);


			if ($shop_rows)
			{
				$data = array_pop($shop_rows);
			}
		}
		else
		{

		}


		if ($data)
		{
			$msg = 'success';
			$status = 200;
		}
		else
		{
			$msg = 'failure';
			$status = 250;
		}


		$this->data->addBody(-140, $data, $msg, $status);
	}
}
?>
