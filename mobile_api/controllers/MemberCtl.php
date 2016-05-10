<?php

class MemberCtl extends Yf_AppController
{
	public function getCard()
	{
		$user_id = Perm::$userId;
		$status  = request_int('status', 1);
		$serial  = request_string('serial');

		$page = request_int('page', 1);
		$rows = request_int('rows', 10);
		$sort = request_string('sort', 'asc');


		$Member_CardModel = new Member_CardModel();
		//$data = array();
		$data = $Member_CardModel->getCardList($user_id, $status, $page, $rows, $sort, $serial);

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


	public function getShopCardList()
	{
		$user_id = Perm::$userId;
		$status  = request_int('status', 1);
		$shop_id = $user_id;

		$page = request_int('page', 1);
		$rows = request_int('rows', 10);
		$sort = request_string('sort', 'asc');


		$Member_CardModel = new Member_CardModel();
		//$data = array();
		$data = $Member_CardModel->getShopCardList($shop_id, $status, $page, $rows, $sort);

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

	//已知序列号绑定会员ID
	public function bindCard()
	{
		$serial = request_string('serial');                //会员卡序列号

		$blind_member_id = Perm::$userId;

		$Member_CardModel = new Member_CardModel();

		$flag = $Member_CardModel->bindCard($serial, $blind_member_id);

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


	//给定卡序列号 判断是否存在 ? 插入绑定 : 绑定出错
	public function addBoundUser()
	{
		$serial = request_string('serial');                //会员卡序列号
		//$serial = strval($serial);
		$blind_member_id = request_int('blind_member_id'); //会员id

		$Member_CardModel = new Member_CardModel();

		$data = $Member_CardModel->addCardList($serial, $blind_member_id);
		
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

	//修改用户信息
	public function editMemberInfo()
	{
		$user_id = Perm::$userId;        //用户id

		//$logo  = request_string('logo');  //头像
		$name  = request_string('name');  //昵称
		$sex   = request_int('sex');         //性别
		$pwd   = request_string('pwd');   //密码
		$birth = request_int('birth');    //生日


		Yf_Log::log('$user_id : ' . $user_id, Yf_Log::INFO, 'member');
		Yf_Log::log('$_FILES : ' . json_encode($_FILES), Yf_Log::INFO, 'member');
		Yf_Log::log('$_REQUEST : ' . json_encode($_REQUEST), Yf_Log::INFO, 'member');

		$MemberModel = new MemberModel();

		$data = array();
		$field = array();
		$flag = false;

		if (isset($_FILES['logo']))
		{
			//处理上传logo
			$upload = new HTTP_Upload('en');
			$files  = $upload->getFiles();

			if (PEAR::isError($files))
			{
				$data['msg'] = '用户logo上传错误';
				$flag = false;
			}
			else
			{
				foreach ($files as $file)
				{
					if ($file->isValid())
					{

						$config = Yf_Registry::get('config');

						$p = '/uploadfile/member/';

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
							$field['logo'] = $logo;


							if (preg_match("/member/", $logo))
							{
								$ude = $MemberModel->getMember($user_id);
								$de  = $ude[$user_id];
								fb($de);
								$Web_Config = new Web_ConfigModel();
								$weburl     = $Web_Config->getWeburl();
								//fb($weburl);

								$logo_row = array();
								$logo_row = array(
										'uid' => $de['userid'],
										'pay_id' => $de['pay_id'],
										'logo' => $logo
								);
								fb($logo_row);
								PayHelper::updatePayMemberLogo($logo_row);
							}
						}
					}
					else
					{
						$flag = false;
						$data['msg'] = '用户logo发生错误' . $_FILES['upload']['name'];
					}
				}

			}
		}

		if ($name)
		{
			$field['name'] = $name;
		}

		if ($sex)
		{
			$field['sex'] = $sex;
		}

		if ($pwd)
		{
			$field['password'] = md5($pwd);
		}

		if ($birth)
		{
			$field['birth'] = $birth;
		}


		if ($field)
		{
			$flag = $MemberModel->editMember($user_id, $field);
		}

		fb($flag);


		$user_rows = $MemberModel->getMember($user_id);
		$data = array_merge($data, $user_rows[$user_id]);

		if ($flag)
		{
			$msg         = '用户信息修改成功';
			$status      = 200;
		}
		else
		{
			$msg         = '用户信息修改失败';
			$status      = 250;
		}


		Yf_Log::log('$data : ' . json_encode($data), Yf_Log::INFO, 'member');
		$this->data->addBody(-140, $data, $msg, $status);

	}

	//获取账户余额
	public function getMemberCash()
	{
		$user_id = Perm::$userId;        //用户id

		$Pay_MemberModel = new Pay_MemberModel();
		$cash            = $Pay_MemberModel->getCash($user_id);
		fb($cash);
		
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


		$this->data->addBody(-140, $cash, $msg, $status);
	}


	/**
	 * 重新设置支付密码验证码
	 *
	 * @access public
	 */
	public function findPasswdCode()
	{
		$mobile = request_string('mobile');

		//判断用户是否存在  $mobile
		if (true)
		{
			$data = array();

			$data['user_code'] = rand(1000, 9999);

			$config_cache = Yf_Registry::get('config_cache');

			if (!file_exists($config_cache['default']['cacheDir']))
			{
				mkdir($config_cache['default']['cacheDir']);
			}

			$Cache_Lite = new Cache_Lite_Output($config_cache['default']);

			$Cache_Lite->save($data['user_code'], $mobile);

			//发送短消息
			$contents = '您的验证码是：' . $data['user_code'] . '。请不要把验证码泄露给其他人。如非本人操作，可不用理会！';

			$result = Sms::send($mobile, $contents);

			{
				if (true)
				{
					$msg    = 'success';
					$status = 200;
				}
				else
				{
					$msg    = '失败';
					$status = 250;
				}

			}
		}
		else
		{
			$msg    = '用户账号不存在';
			$status = 250;
		}

		$this->data->addBody(-140, $data, $msg, $status);
	}


	public function resetPayPasswd()
	{
		//
		$user_code = request_string('user_code');

		$data         = array();
		$data['user'] = request_string('user_account');

		if (request_string('pay_passwd'))
		{
			fb(request_string('pay_passwd'));
			$data['password'] = md5(request_string('pay_passwd'));


			$config_cache = Yf_Registry::get('config_cache');
			$Cache_Lite   = new Cache_Lite_Output($config_cache['default']);

			$user_code_pre = $Cache_Lite->get($data['user']);


			if ($user_code == $user_code_pre)
			{
				$Pay_MemberModel = new Pay_MemberModel();
				$MemberModel = new MemberModel();

				//检测登录状态
				$user_id_row = $MemberModel->getUserIdByAccount($data['user']);

				if ($user_id_row)
				{
					//重置密码
					$user_id          = $user_id_row[0];              //通过user_id找到id
					$reset_passwd_row = array();

					//$reset_passwd_row['pay_pass'] = $data['password'];
					$flag = $Pay_MemberModel->editMemberPayPass($user_id, $data['password']);

					if ($flag)
					{
						$msg    = '重置密码成功';
						$status = 200;

						$Cache_Lite->remove($data['user']);
					}
					else
					{
						$msg    = '重置密码失败';
						$status = 250;
					}
				}
				else
				{
					$msg    = '用户不存在';
					$status = 250;
				}
			}
			else
			{
				$msg    = '验证码错误';
				$status = 250;
			}

		}
		else
		{
			$msg    = '密码不能为空';
			$status = 250;
		}


		unset($data['password']);

		$this->data->addBody(-140, $data, $msg, $status);
	}

	public function get()
	{
		//$user_id     = Perm::$userId;        //用户idrequest_string
		$user_id     = request_int('id') ? request_int('id') : null;        //用户id
		$MemberModel = new MemberModel();
		$data        = $MemberModel->getMember($user_id);
		if ($data)
		{
			$msg    = 'success';
			$status = 200;
		}
		else
		{
			$msg    = '失败';
			$status = 250;
		}
		$this->data->addBody(-140, $data, $msg, $status);
	}

	//获取好友列表
	public function getFriends()
	{
		$user_id = Perm::$userId;	//用户id
		$Sns_FriendModel = new Sns_FriendModel();
		$data = $Sns_FriendModel->getFriends($user_id);
		
		//在好友列表中添加电话
		foreach ($data as $key => $value) 
		{
			fb($value);
			$MemberModel = new MemberModel();
			$user_data   = $MemberModel->getMember($value['fuid']);
			fb($user_data);
			$data[$key]['mobile'] = $user_data[$value['fuid']]['mobile'];
		}
		if ($data)
		{
			$msg    = 'success';
			$status = 200;
		}
		else
		{
			$msg    = '失败';
			$status = 250;
		}

		$this->data->addBody(-140, $data, $msg, $status);
	}

	//关注好友
	public function addFriend()
	{
		$user_id = Perm::$userId;    //当前用户id
		$fuser_id = request_int('uid');  //关注用户id

		//获取 当前用户信息
		$MemberModel = new MemberModel();
		$user_data        = $MemberModel->getMember($user_id);
		fb($user_data);

		//获取 关注用户信息
		$fuser_data        = $MemberModel->getMember($fuser_id);
		fb($fuser_data);

		//查找当前用户是否已经关注过此用户
		$Sns_FriendModel = new Sns_FriendModel();
		$re = $Sns_FriendModel->checkFriends($user_id,$fuser_id);
		if($re)
		{
			$flag = false;
			$stat = 1;   //已关注
		}
		else
		{
			//当前用户的朋友数加1
			$Member_InfoModel = new Member_InfoModel();
			$refriend = $Member_InfoModel->addFriends($user_id,'2');
			fb($refriend);

			//被关注的用户粉丝数加1
			$refan = $Member_InfoModel->addFans($fuser_id,'2');
			fb($refan);
			if($refriend && $refan)
			{
				//查找被关注的用户是否关注当前用户
				$ret = $Sns_FriendModel->checkFriends($fuser_id,$user_id);
				fb($ret);
				if($ret) 
				{
					$status = '2';//已关注

					//更新关注状态
					$Sns_FriendModel->editStatus($fuser_id,$user_id,$status);
				}else
				{
					$status = '1';//未关注
				}


				//添加关注数据
				$field = array( 'uid'      => $user_id,
								'group_id' => '1',
								'uname'    =>  $user_data[$user_id]['user'],
								'uimg'     =>  $user_data[$user_id]['logo'], 
								'fuid'     => $fuser_id,
								'funame'   => $fuser_data[$fuser_id]['user'],
								'fuimg'    => $fuser_data[$fuser_id]['logo'],
								'addtime'  => time(),
								'state'    => $status,
								);
				$dat = $Sns_FriendModel->addFriend($field);
				if($dat)
				{
					$flag = true;
				}
				else
				{
					$flag = false;
					$stat =2;//关注失败
				}
			}
			else
			{
				$flag  = false;
				$stat  = 2; //关注失败
			}
		}

		if ($flag)
		{
			$msg    = 'success';
			$status = 200;
			$data = array();
		}
		else
		{
			$msg    = '失败';
			$status = 250;
			$data[] = $stat;
		}

		$this->data->addBody(-140, $data, $msg, $status);
	}


	//取消好友关注
	public function delFriends()
	{
		$user_id  = Perm::$userId;    //当前用户id
		$fid = request_int('fid');    //关注id

		//获取关注信息
		$Sns_FriendModel = new Sns_FriendModel();
		$data        = $Sns_FriendModel->getFriend($fid);
		fb($data);
		foreach ($data as $key => $value) 
		{
			$fuser_id = $value['fuid'];
		}

		//查找关注信息(被关注会员 是否 关注当前用户)
		$re = $Sns_FriendModel->checkFriends($fuser_id,$user_id);
		fb($re);
		if($re)
		{
			$field = array('state' => 1, );
			$Sns_FriendModel->editFriend($re,$field);
		}

		//删除
		$dat = $Sns_FriendModel->removeFriend($fid);
		
		if($dat)
		{
			//当前用户的朋友数减1
			$Member_InfoModel = new Member_InfoModel();
			$refriend = $Member_InfoModel->addFriends($user_id,'1');

			//被关注的用户粉丝数减1
			$refan = $Member_InfoModel->addFans($fuser_id,'1');
		}
		$data = array();
		if ($refriend && $refan && $dat)
		{
			$msg    = 'success';
			$status = 200;
		}
		else
		{
			$msg    = '失败';
			$status = 250;
		}

		$this->data->addBody(-140, $data, $msg, $status);
		

	}

}

?>