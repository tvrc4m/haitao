<?php
class logistics
{
	var $db;
	var $tpl;
	var $page;
	
	function logistics()
	{
		global $db;
		global $tpl;		
		$this -> db     = & $db;
	}
	
	function add_logis()
	{
		global $buid;
		$_POST['province'] *= 1;
		$_POST['city'] *= 1;
		$_POST['area'] *= 1;
		$_POST['street'] *= 1;
		$sql="insert into ".LGSTEMP." (userid,title,price_type,type,province_id,city_id,area_id,street_id,area,uptime) 
		values ('$buid','$_POST[title]','$_POST[price_type]','$_POST[type]','$_POST[province]','$_POST[city]','$_POST[area]','$_POST[street]','$_POST[t]','".time()."')";
		$this->db->query($sql);
		$id=$this->db->lastid();
		if($id)
		{
			$this->update_logis_temp_con($id,$_POST['type']);
		}
	}
	
	function edit_logis($id)
	{
		$_POST['province'] *= 1;
		$_POST['city'] *= 1;
		$_POST['area'] *= 1;
		$_POST['street'] *= 1;
		$sql="update ".LGSTEMP." set title='$_POST[title]',price_type='$_POST[price_type]',type='$_POST[type]',province_id='$_POST[province]',city_id='$_POST[city]',area_id='$_POST[area]',street_id='$_POST[street]',area='$_POST[t]',uptime='".time()."' where id='$id'";
		$this->db->query($sql);
		if($id)
		{
			$this->update_logis_temp_con($id,$_POST['type']);
		}

	}
	
	function update_logis_temp_con($id,$type)
	{
		$sql="delete from ".LGSTEMPCON." where temp_id='$id'";
		$this->db->query($sql);
		if($type == '2')
		{
			foreach($_POST['lg'] as $key => $v)
			{
				$sql="insert into ".LGSTEMPCON." (temp_id,logistics_type,default_num,default_price,add_num,add_price,define_citys) 			values ('$id','$v','1','0','1','0','default')";
				$this->db->query($sql);
			}
		}
		else
		{
			//------------express
			if($_POST['default_express_price'])
			{
				foreach($_POST['default_express_price'] as $key=>$v)
				{
					if(!empty($v))
					{
						$_POST['default_express_num'][$key]*=1;
						$_POST['default_express_price'][$key]*=1;
						$_POST['add_express_num'][$key]*=1;
						$_POST['add_express_price'][$key]*=1;
						
						$sql="insert into ".LGSTEMPCON." 
						(temp_id,logistics_type,default_num,default_price,add_num,add_price,define_citys) 
						values 
						('$id','express','".$_POST['default_express_num'][$key]."','".$_POST['default_express_price'][$key]."','".$_POST['add_express_num'][$key]."','".$_POST['add_express_price'][$key]."','".$_POST['add_express_city'][$key]."')";
						$this->db->query($sql);
					}
				}
			}
			//----------ems
			if($_POST['default_ems_price'])
			{
				foreach($_POST['default_ems_price'] as $key=>$v)
				{
					if(!empty($v))
					{
						$_POST['default_ems_num'][$key]*=1;
						$_POST['default_ems_price'][$key]*=1;
						$_POST['add_ems_num'][$key]*=1;
						$_POST['add_ems_price'][$key]*=1;
						
						$sql="insert into ".LGSTEMPCON." 
						(temp_id,logistics_type,default_num,default_price,add_num,add_price,define_citys) 
						values 
						('$id','ems','".$_POST['default_ems_num'][$key]."','".$_POST['default_ems_price'][$key]."','".$_POST['add_ems_num'][$key]."','".$_POST['add_ems_price'][$key]."','".$_POST['add_ems_city'][$key]."')";
						$this->db->query($sql);
					}
				}
			}
			//----------mail
			if($_POST['default_mail_price'])
			{
				foreach($_POST['default_mail_price'] as $key=>$v)
				{
					if(!empty($v))
					{
						$_POST['default_mail_num'][$key]*=1;
						$_POST['default_mail_price'][$key]*=1;
						$_POST['add_mail_num'][$key]*=1;
						$_POST['add_mail_price'][$key]*=1;
						
						$sql="insert into ".LGSTEMPCON." 
						(temp_id,logistics_type,default_num,default_price,add_num,add_price,define_citys) 
						values 
						('$id','mail','".$_POST['default_mail_num'][$key]."','".$_POST['default_mail_price'][$key]."','".$_POST['add_mail_num'][$key]."','".$_POST['add_mail_price'][$key]."','".$_POST['add_mail_city'][$key]."')";
						$this->db->query($sql);
					}
				}
			}
		}
	}
	
	
	
	
	
	
	
	function add_lgsaddr()
	{
		global $buid;
		
		$sql="insert into ".SHIPPINGADDR."(`userid`,`name`,`provinceid`,`cityid`,`areaid`,`area`,`addr`,`post`,`tel`,
			`mobile` ,`company` ,`con` ) 
			values('$buid','$_POST[name]','$_POST[province]',
			'$_POST[city]','$_POST[area]','$_POST[t]','$_POST[addr]','$_POST[post]','$_POST[tel]','$_POST[mobile]','$_POST[company]'
			,'$_POST[con]')";
	
		$this->db->query($sql);
	}
	function edit_lgsaddr()
	{
		global $buid;
		
		$sql="update ".SHIPPINGADDR."  set `name`='$_POST[name]',`provinceid`='$_POST[province]',`cityid`='$_POST[city]',`areaid`='$_POST[area]',`area`='$_POST[t]',`addr`='$_POST[addr]',`post`='$_POST[post]',
		`tel`='$_POST[tel]',`mobile`='$_POST[mobile]',`company`='$_POST[company]',
		`con`='$_POST[con]' where `userid`='$buid' and id='$_POST[id]'";
		$this->db->query($sql);
	}
	function lgsaddr_detail($id)
	{
		global $buid;
		$sql="select  *  from  ".SHIPPINGADDR."   where `userid`='$buid' and `id`='$id' limit 1";
		$this->db->query($sql);
		return $this->db->fetchRow($sql);
	}
	function lgsaddr_list()
	{
		global $buid;
		$sql="select *  from  ".SHIPPINGADDR."   where `userid`='$buid' ";
		$this->db->query($sql);
		return $this->db->getRows($sql);
	}
	function del_lgsaddr($id)
	{
		global $buid;
		$sql="delete  from  ".SHIPPINGADDR."   where `userid`='$buid'  and id='$id'";
		$re=$this->db->query($sql);
		return $re;
	}
	
	//修改选定发货地址 $type=1//退货地址 
	function set_lgsaddr($type,$id=0) 
	{
		global $buid;
		if($type==1)
		{
			$sql="update ".SHIPPINGADDR."  set  `default_receipt`=0  where `userid`='$buid' ";
			$this->db->query($sql);
			$sql="update ".SHIPPINGADDR."  set  `default_receipt`=1  where `userid`='$buid' and id='$id'";
			$this->db->query($sql);
		}
		else
		{
			$sql="update ".SHIPPINGADDR."  set  `default_delivery`=0  where `userid`='$buid' ";
			$this->db->query($sql);
			$sql="update ".SHIPPINGADDR."  set  `default_delivery`=1 where `userid`='$buid' and id='$id'";
			$this->db->query($sql);
		}
		
	}
	
}
?>