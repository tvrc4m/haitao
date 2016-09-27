<?php
//类如此写，不是太好，不过考虑兼容结构及使用方便，如此做
class distribution_shop_limit
{
	var $db;
	var $tpl;
	var $page;

	public function __construct()
	{
		global $db;
		global $config;
		global $tpl;

		$this->db  = &$db;
		$this->tpl = &$tpl;
	}

	public function add_limit_shop($shop_id,$limit_type,$limit_content,$status=1){

		global $db;
		$sql = sprintf("INSERT INTO   %s  (shop_id, limit_type, limit_content, status) VALUES ( %d, %d, %d, %d)", DISTRIBUTION_SHOP_LIMIT, $shop_id, $limit_type, limit_content, $status);
		$re = $this->db->query($sql);
		return $re;
	}

	public function update_limit_shop($shop_id,$update_data){
		if(empty($update_data))
			return false;
		global $db;
		$set_str = "";
		foreach ($update_data as $key => $value) {
			$set_str .="$key='{$value}',";
		}
		$set_str =rtrim($set_str,",");
		if($set_str=="")
			return false;
		$sql= sprintf("UPDATE %s SET %s WEHRE shop_id=%s",DISTRIBUTION_SHOP_LIMIT,$set_str,$shop_id);
		$re = $this->db->query($sql);
		return $re;
	}
	public function add_shop_access_user($shop_id,$user_id){
		//判断商铺是否限制分销
		global $db;
		$shop_limit_sql = sprintf("SELECT * FROM %s WHERE shop_id=%s ",DISTRIBUTION_SHOP_LIMIT,$shop_id);
		$shop_limit_re = $this->db->query($shop_limit_sql);
		$shop_limit_result = $this->db->fetchRow();
		if(empty($shop_limit_result)){
			return true;
		}else{
		  $access_user_sql = sprintf("SELECT * FROM %s WHERE shop_id=%s AND user_id=%s",DISTRIBUTION_SHOP_ACCESS_USER,$shop_id,$user_id);
		  $access_user_re = $this->db->query($access_user_sql);
		  $access_user_result = $this->db->fetchRow();
		  if(!empty($access_user_result)){
				return true;
			}
			else
			{
				//店铺限制状态
				if($shop_limit_result["status"] ==1){
					//类型,1限制商品2,限制消费总额
					if($shop_limit_result["limit_type"]==1){
						$check_sql = sprintf("SELECT COUNT(DISTINCT(op.pid)) AS num FROM %s op, %s od WHERE od.order_id=op.order_id AND od.status=4 AND op.pid in (".$shop_limit_result["limit_content"].") AND op.buyer_id=%s AND od.seller_id=%s",ORPRO,ORDER,$user_id,$shop_id);
						$check_re = $this->db->query($check_sql);
						$limit_num = $this->db->fetchField("num");
						if($limit_num < count(explode(",", $shop_limit_result["limit_content"])))
						{
							return false;
						}
					}else if($shop_limit_result["limit_type"]==2){
						$check_sql = sprintf("SELECT SUM(product_price)  AS total_money FROM %s WHERE seller_id=%s AND buyer_id=%s AND status=4",ORDER,$shop_id,$user_id);
						$check_re = $this->db->query($check_sql);
						$limit_money = round($this->db->fetchField("total_money"),2);
						if($limit_money < round($shop_limit_result["limit_content"],2))
						{
							return false;
						}
					}
					//加入分销
					$inser_sql = sprintf("INSERT INTO %s ( `shop_id`, `user_id`, `create_time`) VALUES (%s,%s,%s,%s)",DISTRIBUTION_SHOP_ACCESS_USER,$shop_id,$user_id,time());
					return $this->db->query($inser_sql);
				}
			}
		}
	}

	public function is_access_user($product_id,$user_id){
		global $db;
		if(empty($product_id) || empty($user_id))
			return false;
		$product_check_sql = sprintf("SELECT member_id FROM %s WHERE id=%s",PRODUCT,$product_id);
		$this->db->query($product_check_sql);
		$shop_id = $this->db->fetchField("member_id");

		$shop_limit_sql = sprintf("SELECT * FROM %s WHERE shop_id=%s AND status=%s",DISTRIBUTION_SHOP_LIMIT,$shop_id,1);
		$this->db->query($shop_limit_sql);
		$shop_limit_result = $this->db->fetchRow();
		if(empty($shop_limit_result)){
			return true;
		}else
		{
			$access_user_sql = sprintf("SELECT * FROM %s WHERE shop_id=%s AND user_id=%s",DISTRIBUTION_SHOP_ACCESS_USER,$shop_id,$user_id);
		  $access_user_re = $this->db->query($access_user_sql);
		  $access_user_result = $this->db->fetchRow();
		  if(!empty($access_user_result)){
				return true;
			}
			else
			{
				return false;
			}
		}
	}

}
?>
