<?php
/**
 *
 * 地址相关api
 *
 * @category   Framework
 * @package    Controller
 * @author     Xinze <xinze@live.cn>
 * @copyright  Copyright (c) 2010, 黄新泽
 * @version    1.0
 * @todo
 */
class UserAddressCtl extends Yf_AppController
{
	/**
	 * 地址列表
	 *
	 * @return array $rows 返回的查询内容
	 * @access public
	 */
	public function getList()
	{
		$user_id = Perm::$userId;		
		$page 	 = request_int('page');  
		$lenght_rows = request_int('lenght');
		$isdefault = request_int('isdefault')?1:0;

		$Delivery_AddrModel = new Delivery_AddressModel();
		$data = $Delivery_AddrModel->getAddressList($user_id, $page, $lenght_rows, $isdefault);

		$arr = array(); //这里不是数组会输出 250

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

	/**
	 * 添加地址
	 *
	 * @return array $rows 返回结果1 or 0
	 * @access public
	 */
	public function add()
	{

		$user_id = Perm::$userId;  		
		$field_row =array(
			'userid' 		=> $user_id,
			'name' 			=> $_REQUEST['name'],
			'provinceid'	=> $_REQUEST['provinceid'],
			'cityid'	 	=> $_REQUEST['cityid'],
			'areaid'	 	=> $_REQUEST['areaid'],
			'area'	 		=> $_REQUEST['area'],
			'address'	 	=> $_REQUEST['address'],
			'zip'	 		=> $_REQUEST['zip'],
			'tel'	 		=> $_REQUEST['tel'],
			'mobile'	 	=> $_REQUEST['mobile']
		);

		$Delivery_AddrModel = new Delivery_AddressModel();
		$data = $Delivery_AddrModel->addUserAddress($field_row);

		$arr = array(); //这里不是数组会输出 250
		
		if ($data)
		{
			$arr['add_addr_id'] = $data;
			$msg 				= 'success';
			$status 			= 200;
		}
		else
		{

			$msg 	= 'failure';
			$status = 250;
		}

		$this->data->addBody(-140, $arr, $msg, $status);
		
	}

	/**
	 * 修改地址
	 * @param  @id 			主键
	 * @param  $user_id 	用户id
	 * @param  $field_row  地址array
	 * @return array $rows 返回的查询内容
	 * @access public
	 */
	public function edit()
	{

		$id 	 = request_int('id');
		$user_id = Perm::$userId;		
		$field_row =array(
			'userid' 		=> $user_id,
			'name' 			=> $_REQUEST['name'],
			'provinceid'	=> $_REQUEST['provinceid'],
			'cityid'	 	=> $_REQUEST['cityid'],
			'areaid'	 	=> $_REQUEST['areaid'],
			'area'	 		=> $_REQUEST['area'],
			'address'	 	=> $_REQUEST['address'],
			'zip'	 		=> $_REQUEST['zip'],
			'tel'	 		=> $_REQUEST['tel'],
			'mobile'	 	=> $_REQUEST['mobile']
		);	

		$Delivery_AddrModel = new Delivery_AddressModel();
		$data = $Delivery_AddrModel->editUserAddress($id, $field_row, $user_id);

		$arr = array();

		if ($data == true )
		{
			$msg = 'success';
			$status = 200;
		}
		else
		{
			$msg = 'failure';
			$status = 250;
		}
		$this->data->addBody(-140, $arr, $msg, $status);
		
	}

	/**
	 * 删除地址
	 *
	 * @return array $rows 返回结果1 or 0
	 * @access public
	 */
	public function remove()
	{

		$user_id = Perm::$userId;
		$addr_id = request_int('id');	// => 需要删除的 地址id

		$Delivery_AddrModel = new Delivery_AddressModel();
		$data = $Delivery_AddrModel->removeUserAddress($addr_id,$user_id);

		$arr = array();

		if ($data)
		{
			$arr['remove_status'] = $data;
			$msg = 'success';
			$status = 200;
		}
		else
		{
			$msg = 'failure';
			$status = 250;
		}

		$this->data->addBody(-140, $arr, $msg, $status);
		
	}

	/**
	 * 修改默认地址
	 *
	 * @return array $rows 返回结果1 or 0
	 * @access public
	 */
	public function setDefaultAddr()
	{

		$user_id = Perm::$userId;		
		$addr_id = request_int('id');	// =>  地址id主键
		$field_name = '`default`';

		//默认地址 default  1->0
		$getDefaultModel = new Delivery_AddressModel();
		$id_rowDefault = $getDefaultModel->getAddressListDefault($user_id, 1, 10, 1);

		$AddressModel 	= new Delivery_Address();
		$statusData 	= $AddressModel->editAddressSingleField($id_rowDefault[0], $field_name, 0, 1);

		$setDefault  = $AddressModel->editAddressSingleField($addr_id, $field_name, 1, 0);

		$arr = array();

		if ($setDefault)
		{
			$arr['setDefaultAddr'] = $setDefault;
			$msg = 'success';
			$status = 200;
		}
		else
		{
			$msg = 'failure';
			$status = 250;
		}

		$this->data->addBody(-140, $arr, $msg, $status);
		
	}

}


?>
