<?php

/** 
 * wap
 * @author 
 * @copyright 
 */
class WapCtl extends Yf_AppController
{

	public function geturl()
	{

		$member_id  = request_int('member_id');			//会员ID

		$WapUserModel = new Wap_WapUserModel();
		$result = $WapUserModel->getmininfo(false, $member_id);
		
		$data = array();
		if($member_id == '2314')
		// if($result['category'] == 1)	//施工人员
		{
			$data['url'] = 'http://119.90.133.156/mallbuilder-api/mobile_api/wap/Construction/';
		}
		else if($member_id == '2328')	
		// else if($result['category'] == 2)	//业主
		{
			$data['url'] = 'http://119.90.133.156/mallbuilder-api/mobile_api/wap/Owner/';
		}
		else if($member_id == '2329')	
		// else if($result['category'] == 3)	//线下店
		{
			$data['url'] = 'http://119.90.133.156/mallbuilder-api/mobile_api/wap/Lineshop/';
		}

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

	//我的信息
	public function getmyinfo()
	{

		$category  	= request_int('category');			//1施工人员2业主3线下店
		$member_id  = request_int('member_id');			//会员ID

		$WapUserModel = new Wap_WapUserModel();
		$result = $WapUserModel->getmininfo($category, $member_id);

		if (!empty($result['grade'])) 
		{
			$grade = $result['grade'];
			$GradeModel = new Wap_WapGrade();
			$res_grade = $GradeModel ->getGrade($grade);
			$result['grade'] = $res_grade[$grade]['grade'];
		}

		$data = array();
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


		$this->data->addBody(-140, $result, $msg, $status);
	}

	//业主下单
	public function Sendorder()
	{
 
		//$category  	= request_int('category');			//1施工人员2业主3线下店
		//$member_id  = request_int('member_id');			//会员ID
		$field_row = array();

		$field_row['user_id']	= request_int('member_id');
		$field_row['order_id']	= request_int('member_id').time();
		$field_row['con'] 		= $_REQUEST['con'];
		$field_row['title']		= $_REQUEST['title'];
		$field_row['uptime']	= time();

		$data = array();
		if(empty($field_row['title']) || empty($field_row['con']))
		{
			$msg = 'success';
			$status = 300;
			$this->data->addBody(-140, $data, $msg, $status);
			return  false;
		}

		$WapOrderModel = new Wap_WapOrderModel();
		$result = $WapOrderModel->addOrders($field_row);
		
		if ($result)
		{
			$msg = 'success';
			$status = 200;
			$data['order_id'] = request_int('member_id').time();
		}
		else
		{
			$msg = 'failure';
			$status = 250;
		}


		$this->data->addBody(-140, $data, $msg, $status);
	}

	//获取艾猫订单接口
	public function getOrders()
	{
		// $key = 'KjkiHUh24kkHG68IKUuhgy9HHYgHJM152512';    //艾猫的默认密钥
		$key = 'KjkiHUh2';		//我们去他默认密钥的前8位
		$flag	= 'O';
		// $user_id = 31044;	//31044 这是测试ID
		$str = request_int('user_id');

		$data = array();
		$AmallModel = new GetAmall();
		$result = $AmallModel->sendAmallUrl($str, $flag, $key);

		//des 解密		
		$des = new DesComponent();
		$desresult = $des->decrypt($result, $key);
		$data = json_decode($desresult, true);

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

	//获取艾猫登录
	public function getAlogin()
	{
		// $key = 'KjkiHUh24kkHG68IKUuhgy9HHYgHJM152512';    //艾猫的默认密钥
		$key = 'KjkiHUh2';		//我们去他默认密钥的前8位
		$uname 	= request_string('uname');
		$upwd 	= request_string('upwd');
		$flag = 'L';
		// $uname 	= '666666';			=>测试数据
		// $upwd 	= '123456';

		$des = new DesComponent();
		$userinfo = "j_username=".$uname.",j_password=".$upwd;
		$str = $des->encrypt($userinfo, $key);
		$data = array();
		// $data['resul'] = $str;
		$AmallModel = new GetAmall();
		$result = $AmallModel->sendAmallUrl($str, $flag, $key);

		// // //des 解密
		$desresult = $des->decrypt($result, $key);
		// $data['a'] = $desresult;
		$data['resul'] = json_decode($desresult, true);

		if ($data['resul'] != null)
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

	//生活小贴士
	public function lifeRobot()
	{
		$flag 	= 'R';
		$str 	= '';
		$key 	= '';
		$AmallModel = new GetAmall();
		$result = $AmallModel->sendAmallUrl($str, $flag, $key);
		$data = json_decode($result, true);
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
	//生活小贴士 -详情
	public function lifeRobotinfo()
	{
		$flag 	= 'X';
		$str 	= request_string('id');
		$key 	= '';
		$AmallModel = new GetAmall();
		$result = $AmallModel->sendAmallUrl($str, $flag, $key);

		$data = array();
		$data['res'] = json_decode($result);

		if ($data['res'])
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
