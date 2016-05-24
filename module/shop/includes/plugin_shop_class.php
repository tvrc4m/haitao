<?php
class shop
{
	var $db;
	var $tpl;
	var $page;
	function shop()
	{
		global $db;
		global $tpl;		
		$this -> db     = & $db;
		$this -> tpl    = & $tpl;
	}
	
	//获取店铺分类名
	function GetShopCatName($id)
	{
		if(!empty($id))
		{
			$sql = "select name,parent_id from ".SHOPCAT." where id ='$id' ";
			$this->db->query($sql);
			$v=$this->db->fetchRow();
			$str[]=$val=$v['name'];
			if($v['parent_id']!=0)
			{
				$str[]=$this->GetShopCatName($v['parent_id']);
			}
		}
		if(is_array($str))
			$val=implode(' ',array_reverse($str));
		
		return $val;
	}
	
	//获取店铺分类
	function GetShopCatList()
	{
		$sql="select id,name from ".SHOPCAT."  where parent_id=0 order by displayorder ,id";
		$this->db->query($sql);
		return $this->db->getRows();
	}
	
	//获取店铺商品数量
	function GetProductNum($id)
	{
		$sql="select count(*) as num from ".PRODUCT." where member_id='$id'";
		$this->db->query($sql);
		return $this->db->fetchField('num');	
	}
	//获取店铺类型列表
	function GetShopGradeList()
	{
		$sql="select * from ".SHOPGRADE;
		$this->db->query($sql);
		return $this->db->getRows();
	}
	//获取店铺类型
	function GetShopGrade($id)
	{
		$sql="select * from ".SHOPGRADE." where id='$id'";
		$this->db->query($sql);
		return $this->db->fetchRow();
	}
	//添加店铺类型
	function AddShopGrade()
	{
		$time=time();
		$sql="insert into ".SHOPGRADE." (name,fee,`desc`,status,create_time) values ('$_POST[name]','$_POST[fee]','$_POST[desc]','$_POST[status]','$time')";
		$this->db->query($sql);
	}
	//修改店铺类型
	function EditShopGrade($id)
	{
		$sql="update ".SHOPGRADE." set name='$_POST[name]',`desc`='$_POST[desc]',status='$_POST[status]',fee='$_POST[fee]' where id='$id'";
		$this->db->query($sql);
	}
	//获取店铺列表
	function GetShopList($str="")
	{
		if(!empty($_GET['name']))
			$scl.=" and (user like '%$_GET[name]%')";
			
		if(!empty($_GET['shop_name']))
			$scl.=" and (company like '%".trim($_GET['shop_name'])."%')";	
		
		if(!empty($_GET['id']))
			$scl.=" and userid='$_GET[id]'";
			
		if(!empty($_GET['province']))
			$scl.=" and provinceid='$_GET[province]'";
		if(!empty($_GET['city']))
			$scl.=" and cityid='$_GET[city]'";
		if(!empty($_GET['area']))
			$scl.=" and areaid='$_GET[area]'";
		
		/*if($_SESSION['province'] and empty($_GET['province']))
			$scl.=" and provinceid='".getdistrictid($_SESSION['province'])."'";
		if($_SESSION['city'] and empty($_GET['city']))
			$scl.=" and cityid='".getdistrictid($_SESSION['city'])."'";
		if($_SESSION['area'] and empty($_GET['area']))
			$scl.=" and areaid='".getdistrictid($_SESSION['area'])."'";*/


		if(!empty($_GET['catid']))
		{
            if(!is_array($_GET['catid'])){                      //lemons2015-05-20 bug 分页get数组处理失败
                $_GET['catid'] = explode(',',$_GET['catid']);
            }
			foreach($_GET['catid'] as $key=>$val)
			{
				if($key==0)
				$scl.="and ( catid like '$val%'";
				else
				$scl.=" or catid like '$val%'";
			}
			$scl.=") ";
		}
		if($_GET['grade'])
		{
			$grade=implode(",",$_GET['grade']);
			$scl.=" and grade in ($grade)";
		}
		//==================================
		$sql="SELECT * from ".SHOP."  WHERE 1 $scl $str order by userid desc";
		//分页
		$page = new Page;
		$page->listRows=20;
		if (!$page->__get('totalRows')){
			$this->db->query($sql);
			$page->totalRows = $this->db->num_rows();
		}
		$sql .= "  limit ".$page->firstRow.",".$page->listRows;
		$this->db->query($sql);
		$de['list'] = $this->db->getRows();
		foreach($de['list'] as $key=>$v)
		{
			//获取当前店铺类型
			$sql="select name from ".SHOPGRADE." where id='$v[grade]'";
			$this->db->query($sql);
			$grade=$this->db->fetchField('name');
			$de['list'][$key]['grade']=$grade;
			$de['list'][$key]['cat']=$this->GetShopCatName($v['catid']);
			//获取当前店铺商品数量
			$sql="select count(*) as num from ".PRODUCT." where member_id='$v[userid]'";
			$this->db->query($sql);
			$num=$this->db->fetchField('num');
			$de['list'][$key]['product_num']=$num;
		}
		$de['page'] = $page->prompt();
		return $de;
	}
	//获取店铺信息
	function GetShop($id)
	{
		$sql="select * from ".SHOP." where userid='$id'";
		$this->db->query($sql);
		return $this->db->fetchRow();
	}
	//修改店铺信息
	function EditShop($id)
	{
		global $config;
		$_POST['stime']=strtotime($_POST['stime'])*1;
		$_POST['etime']=strtotime($_POST['etime'])*1;
		$time=time();
		$credit=NULL;
		if($_POST['credit'])
		{
			foreach($_POST['credit'] as $v)
			{
				$credit=$credit+$v;
			}
		}
		$earnest=$_POST['earnest']*1;
		$catid=$_POST['catid']?$_POST['catid']:"0";
		$catid=$catid?$catid:$_POST['oldcatid'];
		$credit=$credit?$credit:"0";
		$shop_statu=$_POST['shop_statu']?$_POST['shop_statu']:"0";
		
        $sql="update ".SHOP." set statu='$_POST[statu]',stime='$_POST[stime]',etime='$_POST[etime]',template='$_POST[template]',shop_statu='$_POST[shop_statu]',credit='$credit',domin='$_POST[domin]',catid='$catid',view_times='$_POST[view]',grade='$_POST[grade]' ,earnest=earnest+$earnest where userid='$id'";
		$re=$this->db->query($sql);	
		if(!empty($earnest))
		{
			$sql="select id from ".SHOPEARNEST." where shop_id='$id'";
			$this->db->query($sql);	
			$shop_id=$this->db->fetchField('id');
			if(empty($shop_id))
			{
				$sql="insert into ".SHOPEARNEST." (shop_id,money,content,admin,create_time) 
					values ('$id','$earnest','$_POST[desc]','$_SESSION[ADMIN_USER]','$time')";
				$re=$this->db->query($sql);
			}
			else
			{
				$sql="update ".SHOPEARNEST." set money=money+$earnest,content='$_POST[con]',admin='$_SESSION[ADMIN_USER]',create_time='$time' where shop_id='$id'";
				$re=$this->db->query($sql);
			}
		}

		//关闭店铺后，商品下架......
		if (-1 == $shop_statu)
		{
			$down_reason = '所属店铺关闭，统一下架';
			$sql         = "UPDATE " . PRODUCT . " SET status='-1', down_reason='" . $down_reason . "' WHERE member_id='$id'";
			$re          = $this->db->query($sql);
			//
		}
	}
	
	//添加修改幻灯片
	function update_slide()
	{
		global $buid;
		foreach($_POST['slideurl'] as $val)
		{
			if($val!=="http://")
			{
				$slideurl[]=$val;
			}
		}
		if($slideurl)
		{
			$slideurl=implode(',',$slideurl);
		}
		$slide=array_filter($_POST['slide']);
		$slide=implode(',',$slide);
		$this->db->query("select shop_id from ".SSET." where shop_id='$buid'");
		$shop_id=$this->db->fetchRow();
		if($shop_id)
		{
			$sql="update ".SSET." set shop_slide='$slide',shop_slideurl ='$slideurl' where shop_id='$buid'";
		}
		else
		{
			$sql="insert into ".SSET." (shop_id,shop_slide,shop_slideurl) values ('$buid','$slide','$slideurl')";
		}
		$re=$this->db->query($sql);
	}
	//获取幻灯片
	function get_slide()
	{
		global $buid;
		$sql="select `shop_slide`,`shop_slideurl` from ".SSET." where shop_id='$buid'";
		$this->db->query($sql);
		$re=$this->db->fetchRow();
		$de['slide']=explode(',',$re['shop_slide']);
		$de['slideurl']=explode(',',$re['shop_slideurl']);
		return $de;
	}
	
	//申请开店
	function update_user()
	{
		global $config,$buid,$buser;$catid=NULL;$ssql=NULL;
		$pn=time();
		//--------------------------------------
		$this->db->query("select userid, shop_statu, shop_type from ".SHOP." where userid='$buid'");
		$ure=$this->db->fetchRow();
		$uid=$ure['userid'];
		
		$str="";
		if($_POST['grade'])
		{
			$str= ",grade='$_POST[grade]'";	
		}
		$catid=$_POST['catid'];
		if(!empty($_POST['tcatid'])){
			$catid=$_POST['tcatid'];
			
		}
		if(!empty($_POST['scatid'])){
			$catid=$_POST['scatid'];
		}
		if(!empty($_POST['sscatid'])){
			$catid=$_POST['sscatid'];
		}

		$shop_type = 2;

		global $distribution_open_flag;

		if (isset($_SESSION['shop_type']) && 1==$_SESSION['shop_type'] && $distribution_open_flag)
		{
			$shop_type = 1;

			global $distribution_config;
			$distribution_shop_check_flag = $distribution_config['distribution_shop_check_flag'];

			if ($distribution_shop_check_flag)
			{
				$shop_statu = -4; //分销店铺，需要审核
			}
			else
			{
				$shop_statu = -3;
			}
		}
		else
		{
			$shop_statu=$_POST['shop_statu']*1;
			$shop_type = 2;
		}

		$_POST['area']*=1;
		$_POST['city']*=1;
		$_POST['province']*=1;
		$_POST['street']*=1;
		
		$lng = $_POST['lng'];
		$lat = $_POST['lat'];

		if(!empty($uid))
		{
			/*
			echo $ure['shop_type'], $ure['shop_statu'];
			echo '<br />';
			echo $shop_type, $shop_statu;
			die();
			*/
			if (3==$ure['shop_type'] && 1==$ure['shop_statu']) //分销商已经开通
			{
				$shop_type = 3;
				$shop_statu = 1;
			}

			if (3==$ure['shop_type'] && -1==$ure['shop_statu']) //分销商已经开通
			{
				$shop_type = 3;
				$shop_statu = -1;
			}

			if (3==$ure['shop_type'] && 0==$ure['shop_statu'])
			{
				$shop_type = 3;
				$shop_statu = 0;
			}

			if (1==$ure['shop_type'] && -3==$ure['shop_statu']) //分销商已经开通
			{
				$shop_type = 1;
				$shop_statu = -3;

				//申请开通卖家店铺
				if ('admin_step' == $_REQUEST['s'])
				{
					$shop_type = 3;
					$shop_statu = 0;
				}
			}

			if (2==$ure['shop_type'] && 1==$ure['shop_statu'] && $distribution_open_flag) //商家已经开通
			{
				$shop_type = 3;
				$shop_statu = -3;
			}

			$lng_lat = '';
			if (isset($_POST['lng']) && isset($_POST['lat']))
			{
				$lng_lat = "`lng` = '$lng',`lat` = '$lat' ,";
			}

			$sql="UPDATE ".SHOP." SET $lng_lat user='$buser',company='$_POST[company]',tel='$_POST[tel]',provinceid='$_POST[province]',addr='$_POST[addr]',cityid='$_POST[city]',areaid='$_POST[area]',streetid='$_POST[street]',area='$_POST[t]',main_pro='$_POST[main_pro]',uptime='$pn',create_time='$pn',logo='$_POST[logo]',shop_statu='$shop_statu',shop_type='$shop_type' $str $ssql WHERE userid='$buid'";
			
			$re=$this->db->query($sql);
			
			$sql="update ".SSET." set  wap_bannar='$_POST[wap_bannar]',shop_logo='$_POST[shop_logo]',shop_banner='$_POST[shop_banner]',shop_title='$_POST[shop_title]',shop_keywords='$_POST[shop_keywords]',shop_description='$_POST[shop_description]' where shop_id='$buid'";
			$re=$this->db->query($sql);
		}
		else
		{
			if (-3 != $shop_statu && -4 != $shop_statu && $distribution_open_flag)
			{
				$shop_statu = -3;
				$shop_type = 1;
			}

			$sql="insert into ".SHOP." (company,tel,provinceid,addr,cityid,areaid,streetid,area,userid,user,logo,main_pro,grade,catid,uptime,create_time,shop_statu,shop_type,`lng`,`lat`) VALUES ('$_POST[company]','$_POST[tel]','$_POST[province]','$_POST[addr]','$_POST[city]','$_POST[area]','$_POST[street]','$_POST[t]','$buid','$buser','$_POST[logo]','$_POST[main_pro]','$_POST[grade]','$catid','$pn','$pn',$shop_statu,$shop_type,'$lng','$lat')";
			$re=$this->db->query($sql);
			
			$sql="insert into ".SSET." (shop_id,shop_logo,shop_banner,shop_title,shop_keywords,shop_description,wap_bannar) values ('$buid','$_POST[shop_logo]','$_POST[shop_banner]','$_POST[shop_title]','$_POST[shop_keywords]','$_POST[shop_description]','$_POST[wap_bannar]')";
			$re=$this->db->query($sql);
		}
		$intro=$_POST['intro'];
		$fp=fopen($config['webroot'].'/config/shop_data/shop_data_'.$buid.'.txt','w');
		fwrite($fp,$intro,strlen($intro));
		fclose($fp);
		return $re;
	}
	
	//获取店铺信息
	function get_shop_info($id)
	{
		if(empty($id)) return NULL;
			
		global $config;$catname=NULL;$catv=array();

		$sql="select b.*,a.regtime,a.lastLoginTime,a.email,a.mobile,a.email_verify,a.mobile_verify,a.logo as plogo,a.ip,sellerpoints,buyerpoints,a.name,a.userid,b.userid as uid,pay_id
			from ".MEMBER." a left join ".SHOP." b on a.userid=b.userid WHERE a.userid='$id'";
		$this->db->query($sql);
		$re=$this->db->fetchRow();

		$sql="select name from ".SHOPGRADE." where id= '$re[grade]' ";
		$this ->db ->query($sql);
		$re['gradename']=$this ->db->fetchField('name');
		
		$sql="select * from ".POINTS." order by id";
		$this ->db ->query($sql);
		$de=$this ->db->getRows();
		foreach($de as $k=>$v)
		{
			$ar=explode('|',$v['points']);
			if($re['sellerpoints']<=$ar[1] and $re['sellerpoints']>=$ar[0])
			{
				$re["sellerpointsimg"]=$v['img'];
			}
			if($re['buyerpoints']<=$ar[1] and $re['buyerpoints']>=$ar[0])
			{
				$re["buyerpointsimg"]=$v['img'];
			}
		}
		return $re;
	}
	
	//获取店铺简介
	function get_shop_detail($buid)
	{
		global $config;
		$fn=$config['webroot'].'/config/shop_data/shop_data_'.$buid.'.txt';
		@$fp=fopen($fn,'r');
		@$con=fread($fp,filesize($fn));
		@fclose($fp);
		$con=str_replace('\"','"',$con);
		return $con;
	}
	//获取店铺配置
	function get_shop_setting()
	{
		global $buid;
		$sql="select `shop_logo`,`wap_bannar`,`wap_logo`,`shop_banner`,`shop_title`,`shop_keywords`,`shop_description` from ".SSET." where shop_id='$buid'";
		$this->db->query($sql);
		$re=$this->db->fetchRow();
		return $re;
	}
	
	//获取当前会员商品订单总数
	function get_all_count($table,$array="",$type="1")
	{
		global $buid,$config;
		if(is_array($array))
		{
			foreach($array as $k=>$v)
			{
				
				if($table==ORDER)
				{	
					if($type=="1")
					{
						if($v=="all")
						{
							$str=" and buyer_id = 0";
						}
						elseif($v=="4")
						{
							$str=" and buyer_id = 0 and status=$v and buyer_comment!='1'";
						}
						else
						{
							$str=" and buyer_id = 0 and status=$v";
						}
					}
					else
					{
						if($v=="all")
						{
							$str=" and seller_id!=''";
						}
						elseif($v=="4")
						{
							$str=" and seller_id!='' and status=$v and buyer_comment!='1'";
						}
						else
						{
							$str=" and seller_id!='' and status=$v";
						}	
					}
				}
				elseif($table==PRODUCT)
				{
					if($v=='-2')
						$str=" and is_shelves='0'";
					elseif($v=='-1')
						$str=" and status='-1'";
					else
						$str=" and status='$v' and is_shelves='1'";
				}
				else
				{
					$str=" and statu=$v ";
				}
				
				if($type == 1 and $config['temp'] == "wap")
				{
					$str .= " and is_virtual = 0";
				}

				if($table==PRODUCT)
				{
					$sql="select count(*) as count from ".$table." where member_id='$buid' $str ";
				}
				else
				{
					$sql="select count(*) as count from ".$table." where seller_id='$buid' $str ";
				}
				$this->db->query($sql);
				$a=$this->db->fetchField('count');
				$count[$k]=$a?$a:"0";
			}
		}
		else
		{
			$sql="select count(*) as count from ".$table." where fromid='$buid' ";
			$this->db->query($sql);
			$a=$this->db->fetchField('count');
			$count=$a?$a:"0";
		}
		return $count;
	}
	//获取店铺评分
	function get_shop_comment()
	{
		global $buid;
		$sql="select avg(item1) as a,avg(item2) as b,avg(item3) as c,avg(item4) as d from ".UCOMMENT." where byid = '$buid'";
		$this->db->query($sql);
		$u=$this->db->fetchRow();
		foreach($u as $key => $val){
			$u[$key] = empty($val) ? 5 : $val ;
		}
		$u['aw']=$u['a']/5*100;
		$u['bw']=$u['b']/5*100;
		$u['cw']=$u['c']/5*100;
		$u['dw']=$u['d']/5*100;
		return $u;;
	}
	
	//获取认证状态
	function GetCertification()
	{
		global $buid;
		$sql="select shop_auth,shopkeeper_auth,shop_auth_pic,shopkeeper_auth_pic from ".SHOP." where userid='$buid'";
		$this->db->query($sql);
		$re=$this->db->fetchRow();
		return $re;
	}
	
	//认证状态
	function Certification()
	{
		global $buid;
		
		if($_POST['shop_auth_pic'])
		{
			$str=" ,shop_auth=0";
		}
		if($_POST['shopkeeper_auth_pic'])
		{
			$str=" ,shopkeeper_auth=0";
		}
		$sql="UPDATE ".SHOP." SET shop_auth_pic='$_POST[shop_auth_pic]',shopkeeper_auth_pic='$_POST[shopkeeper_auth_pic]' WHERE userid='$buid'";
		$re=$this->db->query($sql);
	}
	
	function GetShopStatus($id)
	{
		$sql="select shop_statu from ".SHOP." where userid='$id'";
		$this->db->query($sql);
		$shop_statu=$this->db->fetchField('shop_statu');
		return $shop_statu;
	}
	
	function GetViews($array)
	{
		global $buid;
		foreach($array as $val)
		{
			$min=$val-24*60*60;
			$sq=" and time<=$val and time>=$min";
			$sql="select count(*) as count from ".READREC." where tid='$buid' $sq and type='3'";
			$this->db->query($sql);
			$arr[]=$this->db->fetchField('count');
		}
		return $arr;
	}

	// 获取待回复咨询条数
	function GetConsultNumber($type = 1)
	{
		global $buid;
		if($type == 1)
		{
			$ss = " and (answer is NULL or answer='')";	
		}

		$sql = "select count(*) as `numall` from ".CONSULT." where product_member_id='$buid' $ss ";
		$this -> db -> query($sql);
		$num = $this -> db -> fetchField("numall");
		return  $num;
	}
}
?>
