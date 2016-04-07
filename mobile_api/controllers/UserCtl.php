<?php
/**
 *
 * 用户相关api
 *
 * @category   Framework
 * @package    Controller
 * @author     Xinze <xinze@live.cn>
 * @copyright  Copyright (c) 2010, 黄新泽
 * @version    1.0
 * @todo
 */
class UserCtl extends Yf_AppController
{
	/**
	 * 用户登录
	 *
	 * @access public
	 */
	public function login()
	{
		$MemberModel = new MemberModel();

		$user_account = request_string('user_account');

		//检测登录状态
		$user_id_row = $MemberModel->getUserIdByAccount($user_account);
		fb($user_id_row);
		fb(request_string('user_password'));
		$data = array();

		if ($user_id_row)
		{
			$user_rows = $MemberModel->getMember($user_id_row);
			$user_row = array_pop($user_rows);

			if ($user_id_row && ($user_row['password'] == md5(request_string('user_password'))))
			{
				$data = array();
				$data['user_id'] = $user_row['userid'];
				$encrypt_str = Perm::encryptUserInfo($data);

				$data['k'] = $encrypt_str;
				//location_to(Yf_Registry::get('base_url'));

				$msg = 'success';
				$status = 200;
			}
			else
			{

				//location_go_back('输入密码有误');

				$msg = '密码有误';
				$status = 250;
			}
		}
		else
		{
			$msg = '用户名不存在';
			$status = 250;
		}


		$this->data->addBody(-140, $data, $msg, $status);
	}

	/**
	 * 手机获取注册码
	 *
	 * @access public
	 */
    public function regCode()
    {

        $mobile = request_string('mobile');

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

        $result = json_decode(Sms::send($mobile, $contents),true);
        if ($result['error']==0&&$result['msg']=='ok')
        {
            $msg = 'success';
            $status = 200;
        }
        else
        {
            $msg = '失败';
            $status = 250;
        }

        $this->data->addBody(-140, $data, $msg, $status);
    }


	public function register()
	{

		/*
		$data['userid']                 = $_REQUEST['userid']             ; // ID
		$data['pid']                    = $_REQUEST['pid']                ; // 父类ID
		$data['user']                   = $_REQUEST['user']               ; // 会员名
		$data['password']               = $_REQUEST['password']           ; // 密码
		$data['name']                   = $_REQUEST['name']               ; // 真实名字
		$data['sex']                    = $_REQUEST['sex']                ; // 性别
		$data['mobile']                 = $_REQUEST['mobile']             ; // 手机
		$data['email']                  = $_REQUEST['email']              ; // 邮箱
		$data['qq']                     = $_REQUEST['qq']                 ; // QQ
		$data['ww']                     = $_REQUEST['ww']                 ; // 旺旺
		$data['provinceid']             = $_REQUEST['provinceid']         ; // 省ID
		$data['cityid']                 = $_REQUEST['cityid']             ; // 市ID
		$data['areaid']                 = $_REQUEST['areaid']             ; // 区ID
		$data['streetid']               = $_REQUEST['streetid']           ; //
		$data['area']                   = $_REQUEST['area']               ; // 省市区
		$data['grade_id']               = $_REQUEST['grade_id']           ; //
		$data['logo']                   = $_REQUEST['logo']               ; // LOGO
		$data['ip']                     = $_REQUEST['ip']                 ; // IP
		$data['statu']                  = $_REQUEST['statu']              ; // 状态
		$data['regtime']                = $_REQUEST['regtime']            ; // 注册时间
		$data['lastLoginTime']          = $_REQUEST['lastLoginTime']      ; // 最后登录时间
		$data['invite']                 = $_REQUEST['invite']             ; // 邀请者
		$data['sellerpoints']           = $_REQUEST['sellerpoints']       ; // 卖家信用
		$data['buyerpoints']            = $_REQUEST['buyerpoints']        ; // 买家信用
		$data['email_verify']           = $_REQUEST['email_verify']       ; // 邮箱验证
		$data['mobile_verify']          = $_REQUEST['mobile_verify']      ; // 手机验证
		$data['pay_id']                 = $_REQUEST['pay_id']             ; //
		*/

		//
		$user_code                      = (int)request_string('user_code');

		$data = array();
		$data['user']                   = request_string('user_account');

		if (request_string('user_passwd'))
		{
			$data['password']               = md5(request_string('user_passwd'));
           

			$config_cache = Yf_Registry::get('config_cache');
			$Cache_Lite = new Cache_Lite_Output($config_cache['default']);

			$user_code_pre = $Cache_Lite->get($data['user']);

			if ($user_code == $user_code_pre)
			{
				$MemberModel = new MemberModel();

				//检测登录状态
				$user_id_row = $MemberModel->getUserIdByAccount($data['user']);


				if ($user_id_row)
				{
					$msg = '用户名已经存在';
					$status = 250;
				}
				else
				{
					$data['userid'] = $MemberModel->addMember($data, true);
					$user_id = $data['userid'];

					/*
					$user_rows = $MemberModel->getMember($user_id_row);
					$user_row = array_pop($user_rows);
					*/
					if ($data['userid'])
					{
						$data_info['member_id'] = $data['userid'];

						$Member_InfoModel = new Member_InfoModel();
						$re = $Member_InfoModel->addInfo($data_info);

						//pay 支付中心加上url请求
						if($re)
						{
							$pay_member_row = array();
							$pay_member_row['userid'] = $user_id;
							$pay_member_row['email'] = $data['user'];
							$pay_id = PayHelper::getMemberUrl($pay_member_row, true);

							fb($pay_id);
							if($pay_id)
							{
								$field_row = array();
								$field_row['pay_id'] = $pay_id;

								$MemberModel->editMemberPayId($user_id, $field_row);
							}

							//-------------绑定一键连接
							/*
							if(!empty($_REQUEST['connect_id']))
							{
								$sql="update ".USERCOON." set userid='$user_id' where id='$_REQUEST[connect_id]'";
								$db->query($sql);
							}
							*/

							//
							/*
							$PluginManager = Yf_Plugin_Manager::getInstance();
							$PluginManager->trigger('reg_done', $user_id, $data['user']);
							*/
						}

						$d = array();
						$d['user_id'] = $data['userid'];
						$encrypt_str = Perm::encryptUserInfo($d);

						$data['k'] = $encrypt_str;
						//location_to(Yf_Registry::get('base_url'));

						$Cache_Lite->remove($data['user']);

						$msg = 'success';
						$status = 200;
					}
					else
					{
						$msg = '注册失败';
						$status = 250;
					}

				}
			}
			else
			{
				$msg = '验证码错误';
				$status = 250;
			}
		}
		else
		{
			$msg = '密码不能为空';
			$status = 250;
		}


		unset($data['password']);

		$this->data->addBody(-140, $data, $msg, $status);
	}


	public function logout()
	{
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


		$this->data->addBody(-140, $data, $msg, $status);
	}


	/**
	 * 手机获取找回密码验证码
	 *
	 * @access public
	 */
	public function findPasswdCode()
	{
		$mobile                    = request_string('mobile');

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
					$msg = 'success';
					$status = 200;
				}
				else
				{
					$msg = '失败';
					$status = 250;
				}

			}
		}
		else
		{
			$msg = '用户账号不存在';
			$status = 250;
		}

		$this->data->addBody(-140, $data, $msg, $status);
	}


	public function resetPasswd()
	{
		//
		$user_code = request_string('user_code');

		$data         = array();
		$data['user'] = request_string('user_account');

		if (request_string('user_passwd'))
		{
			$data['password'] = md5(request_string('user_passwd'));


			$config_cache = Yf_Registry::get('config_cache');
			$Cache_Lite   = new Cache_Lite_Output($config_cache['default']);

			$user_code_pre = $Cache_Lite->get($data['user']);


			if ($user_code == $user_code_pre)
			{
				$MemberModel = new MemberModel();

				//检测登录状态
				$user_id_row = $MemberModel->getUserIdByAccount($data['user']);

				if ($user_id_row)
				{
					//重置密码
					$user_id          = $user_id_row[0];
					$reset_passwd_row = array();

					$reset_passwd_row['password'] = $data['password'];

					$flag = $MemberModel->editMember($user_id, $reset_passwd_row);

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
				$msg = '验证码错误';
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
}
?>