<?php
/*
* @Auth:bruce
* @Uptime:2014-11-26
* @Desc:商品删除后，分享时缺少pid sql报错，选择分享商品时去除已删除的商品，sns遮挡错误。
*/
class share
{
	var $db;
	function share()
	{
		global $db;	
		$this -> db     = & $db;
	}
	
	function GetShareShopList($begin = 0, $limit = 10)
	{
		global $config,$buid;
		
		if($_GET['key'])
		{
			$sql=" and a.shopname like '%$_GET[key]%'";	
		}
		$sql="select * from ".SSHOP." a left join ".SHOP." b on a.shopid = b.userid where a.statu=1 and uid=$buid $sql order by addtime desc";
		
		include_once($config['webroot']."/includes/page_utf_class.php");
		$page = new Page;
		$page->listRows = $limit;
        $page->firstRow = $begin;

		if (!$page->__get('totalRows')){
			$this->db->query("select count(id) as num from ".SSHOP." where uid=$buid ");
			$num=$this->db->fetchRow();
			$page->totalRows = $num['num'];
		}

        if(isset($_GET['ptype']) && $_GET['ptype'] == 'ajax') {
            $sql .= "  limit ".$page->firstRow.",".$page->listRows;
        }else{
            $sql .= "  limit ".$page->listRows;
        }

		$this->db->query($sql);
		$re["list"]=$this->db->getRows();
        foreach($re['list'] as $key => $val){
            $sql = "select id,`name`,market_price,price,pic from mallbuilder_product where member_id = ".$val['userid']." ORDER BY sales DESC limit 3";
            $this->db->query($sql);
            $re['list'][$key]['products'] = $this->db->getRows();
        }
		$re["page"]=$page->prompt();
		return $re;
	}
	
	function GetShareGoodsList($begin = 0, $limit = 10)
	{
		global $config,$buid;
		if($_GET['key'])
		{
			$sql=" and b.pname like '%$_GET[key]%'";	
		}
		$sql="select a.id,a.pid,a.commentcount,b.image,b.pname,b.price,b.collectnum,c.sales,c.price,c.market_price,d.img,d.title from mallbuilder_sns_shareproduct a left join mallbuilder_sns_shareproduct_info b on a.pid = b.pid left join mallbuilder_product c on a.pid=c.id left join mallbuilder_national_pavilions d on c.national = d.id where a.statu=1 and a.uid=$buid order by a.addtime desc ";
		
		include_once($config['webroot']."/includes/page_utf_class.php");
		$page = new Page;
		$page->listRows = $limit;
		$page->firstRow = $begin;

		if (!$page->__get('totalRows')){
			$this->db->query("select count(id) as num from ".SPRO." where uid=$buid ");
			$num=$this->db->fetchRow();
			$page->totalRows = $num['num'];
		}

        if(isset($_GET['ptype']) && $_GET['ptype'] == 'ajax') {
            $sql .= "  limit ".$page->firstRow.",".$page->listRows;
        }else{
            $sql .= "  limit ".$page->listRows;
        }
		$this->db->query($sql);
		$re["list"]=$this->db->getRows();
//        echo "<pre>";
//        var_export($re['list']); die;
		$re["page"]=$page->prompt();
		return $re;
	}
	
	function GetShareShop()
	{
		global $buid;
		$sql="select shopid,shopname,logo from ".SSHOP." a left join ".SHOP." b on a.shopid = b.userid where uid=$buid order by addtime desc";
		$this->db->query($sql);
		$re=$this->db->getRows();
		return $re;
	}
	
	function GetShareGoods()
	{
		global $buid;	
		$sql="select a.pid,image,pname from ".SPRO." a left join ".SPROINFO." b on a.pid = b.pid where uid=$buid order by a.addtime desc";
		$this->db->query($sql);
		$re=$this->db->getRows();
		return $re;
	}
	
	function GetProduct($id)
	{
		global $buid;	
		$sql="select pid,image,pname,price,collectnum from ".SPROINFO." where pid=$id";
		$this->db->query($sql);
		$re=$this->db->fetchRow();
		return $re;
	}
	
	function DelShareShop($id)
	{
		$sql="select shopid from ".SSHOP." where id='$id'";
		$this->db->query($sql);
		$shopid=$this->db->fetchField('shopid');
		//修改收藏人气
		$this->db->query("update ".SHOP." set shop_collect=shop_collect-1 where userid='$shopid'");	
		
		return $this->db->query("delete from ".SSHOP." where id='$id'");
	}
	
	function DelShareProduct($id)
	{
		$sql="select pid from ".SPRO." where id='$id'";
		$this->db->query($sql);
		$pid=$this->db->fetchField('pid');
		//修改收藏人气
		$this->db->query("update ".SPROINFO." set collectnum=collectnum-1 where pid='$pid'");

		return $this->db->query("delete from ".SPRO." where id='$id'");
	}
}

?>