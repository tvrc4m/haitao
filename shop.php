<?php
include_once("includes/global.php");
include_once("includes/smarty_config.php");
include_once("includes/user_shop_class.php");
//===============================================
$id=$_GET['id']*1;
$_GET['uid']*=1;
$catid=$_GET['catid']*1;
$_GET['firstRow']=empty($_GET['firstRow'])?NULL:$_GET['firstRow'];
$action=isset($_GET['action'])?$_GET['action']:NULL;
//------------------------
user_read_rec($buid,$_GET['uid'],3);//记录会员查看店铺
//------------------------
$shop = new shop();
//------------------------
$flag=md5($action.$_GET['uid'].$id.$_GET['firstRow'].$config['weburl'].$catid.$config['temp']);
if($action!="mail"&&$action!="comments"&&empty($_GET['template'])&&$buid!=$_GET['uid'])
{	
	$dir=get_userdir($_GET['uid']);//根据会员ID生成缓存目录
	useCahe('shop/'.$dir,true);
}
if(!$tpl->is_cached("space_temp_inc.htm",$flag)) {
	//重新定向
	if (isset($_REQUEST['shop_id'])) {
		$company = $shop->user_detail(intval($_REQUEST['shop_id']));
	} else {
		$company = $shop->user_detail($_GET['uid']);

		if (isset($_REQUEST['dist_id'])) {
			$PluginManager = Yf_Plugin_Manager::getInstance();
			$PluginManager->trigger('analyse', intval($_GET['uid']), 0, $company['company']);
		}
	}

	// 如果为3， 则代表分佣及卖家
	if ((1 == $company['shop_type'] && $company['shop_statu'] == -3) || (2 == $company['shop_type'] && $company['shop_statu'] == 1) || (1 == $company['shop_statu'] && 3 == $company['shop_type'])) {
		$ajax = !empty($_GET['sAjax']) ? $_GET['sAjax'] : 0;
		if ($ajax) {
			echo json_encode(array(
				'status' => 1
			));
			die;
		}
		//-----------------语言包--------------------
		include_once("lang/" . $config['language'] . "/user_space.php");
		$dir = $config['webroot'] . '/module/';
		$handle = opendir($dir);
		while ($filename = readdir($handle)) {
			if ($filename != "." && $filename != "..") {
				if (file_exists($dir . $filename . '/config.php')) {
					include("$dir/$filename/config.php");
				}
			}
		}
		ksort($shopconfig['menu']);
		$tpl->assign("nav_menu", $shopconfig['menu']);
		//------------信息名－自定义－企业名－网站名-------------------
		$config_file = $config['webroot'] . "/config/shop_config/shop_config_" . $_GET['uid'] . '.php';
		if (file_exists($config_file)) {
			include($config_file);
		}

		$company["shop_title"] = ($shopconfig["hometitle"] ? '' : $company['company']);
		$company["shop_keywords"] = $shopconfig['homedes'] . ',' . $company['main_pro'];
		$company["shop_description"] = $company['main_pro'];
		$company["logo"] = $company['plogo'];

		//-------------使用指定店铺模板。-----------------------------
		if (!empty($_GET['template'])) {
			if (file_exists($config['webroot'] . "/templates/$_GET[template]"))
				$company['template'] = $_GET['template'];
		}
		if (empty($company['template'])) $company['template'] = 'user_templates_default';
		if ($config['temp'] == 'wap') $company['template'] = 'wap';
		if ($config['temp'] == 'wap_app') $company['template'] = 'wap_app';

		$tpl->template_dir = $config['webroot'] . "/templates/" . $company['template'] . "/";
		$tpl->compile_dir = $config['webroot'] . "/templates_c/" . $company['template'] . "/";
		$tpl->assign("imgurl", "templates/" . $company['template'] . "/img/");
		//-----------------------------------------------------
		$score = $shop->score();
		foreach ($score as $key => $value) {
			$score[$key] = $value ? $value : 5;
		}

		$score['aw'] = $score['a'] / 5 * 100;
		$score['bw'] = $score['b'] / 5 * 100;
		$score['cw'] = $score['c'] / 5 * 100;
		$score['dw'] = $score['d'] / 5 * 100;

		$tpl->assign("ulink", $shop->get_user_link());
		$tpl->assign("score", $score);
		$tpl->assign("custom_cat", $shop->get_custom_cat_list(1));
		$tpl->assign("shop_nav", $shop->get_shop_nav());
		//-------------------------module分发--------------------
		if (!empty($_GET['m']) && !empty($_GET['action'])) {
			$_GET['m'] = preg_replace('#[^a-z]#iuU', '', $_GET['m']);
			if (file_exists("$config[webroot]/module/" . $_GET['m'] . "/lang/" . $config['language'] . ".php"))
				include("$config[webroot]/module/" . $_GET['m'] . "/lang/" . $config['language'] . ".php");//#调用模块语言包

			include("module/" . $_GET['m'] . "/space_" . $_GET['action'] . ".php");

			$tpl->template_dir = $config['webroot'] . "/templates/" . $company['template'] . "/";
		} else {
			//微信分享
			$tpl->assign("is_wechat",false);
			//微信分享
			if ($config['bw'] == "weixin")
			{
				include_once("pay/module/payment/lib/WxPayPubHelper/WxPay.pub.config.php");
				/**
				if(!isset($_SESSION['access_token']) || (time()-$_SESSION['tmpTime'])>7200)
				{
					//获取微信票据
					$date = file_get_contents("https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=" . WxPayConf_pub::APPID . "&secret=" . WxPayConf_pub::APPSECRET);
					$wobj = json_decode($date);
					$_SESSION['access_token'] = $wobj -> access_token;

					if(isset($wobj -> access_token))
					{
						$tmp = file_get_contents("https://api.weixin.qq.com/cgi-bin/ticket/getticket?access_token=".$wobj -> access_token."&type=jsapi");
						$tobj = json_decode($tmp);
						$_SESSION['ticket'] = $tobj->ticket;
					}

					$_SESSION['tmpTime'] = time();
				}
				{
					$_SESSION['noncestr'] = randomkeys(12);

					$strTmp = "https://".$_SERVER['HTTP_HOST'];
					if(!empty($_SERVER['REQUEST_URI']))
					{
						$strTmp .= $_SERVER['REQUEST_URI'];
					}
					$_SESSION['appid'] = WxPayConf_pub::APPID;
					$str_tmp = "jsapi_ticket=".$_SESSION['ticket']."&noncestr=".$_SESSION['noncestr']."&timestamp=".$_SESSION['tmpTime']."&url=".$strTmp;
					$_SESSION['signature'] = sha1($str_tmp);
				}
				*/
				include_once("includes/jssdk.php");
				$jssdk = new JSSDK(WxPayConf_pub::APPID,WxPayConf_pub::APPSECRET);
				$wechat_share_data = $jssdk->getSignPackage();
				$tpl->assign("wechat_share",$wechat_share_data);
				$tpl->assign("is_wechat",true);

			}

			//-----------------------------------------

			$sql = "select name as pname,price,id,pic,market_price from " . PRODUCT . " where shop_rec=1 and member_id='$_GET[uid]' and is_shelves=1 and status=1 order by id limit 0,8";
			$db->query($sql);
			$re = $db->getRows();
			$tpl->assign("rec_pro", $re);
			//$sql="select name as pname,price,id,pic,market_price from ".PRODUCT." where member_id = '$_GET[uid]' and is_shelves=1 and status>0 order by id desc limit 0,12";
			$sql = "select p.name as pname,p.price,p.id,p.pic,p.market_price,p.national,n.img,n.title from mallbuilder_product p left join mallbuilder_national_pavilions n ON p.`national` = n.`id` where p.member_id = '$_GET[uid]' and p.is_shelves=1 and p.status>0 order by p.id desc limit 0,12";
			$db->query($sql);
			$de = $db->getRows();
			$tpl->assign("pro", $de);
			//
			$PluginManager = Yf_Plugin_Manager::getInstance();
			$PluginManager->trigger('dist_product', intval($_GET['uid']));
			$dis = "?uid=" . $_REQUEST['uid'] . "&dist_id=" . $_REQUEST['uid'];
			$tpl->assign("dis", $dis);
			//-------------------------------------------
			if ($_GET[fx] == 'fx')
				$page = "space_index_fx.htm";
			else
				$page = "space_index.htm";
		}
		//--------------------------------------------
		if (!empty($_GET['uid'])) {
			$sql = "select time from " . CUSTOMTIME . " where userid=$_GET[uid]";
			$db->query($sql);
			$working_time = $db->fetch_Row();

		} elseif (!empty($_GET['id'])) {
			$sql = "select time from " . CUSTOMTIME . " a left join " . PRODUCT . " b ON a.userid =b.member_id where b.id='$_GET[id]'";
			$db->query($sql);
			$working_time = $db->fetch_Row();
		}
		if (empty($working_time)) {
			$working_time = array('AM 10:00 - PM 18:00');
		}
		$tpl->assign("working_time", $working_time);
		$tpl->assign("cs", $shop->get_cs());
		$tpl->assign("shopconfig", $shopconfig);
		$tpl->assign("com", $company);
        $tpl->assign("shopid", $_GET['uid']);

        //获取店铺相应的品牌
        $sql = "SELECT brand FROM mallbuilder_product where member_id = ".$_GET['uid']." GROUP BY brand";
        $db->query($sql);
        $pbrand = $db->getRows();
        if(!empty($pbrand)){
            foreach($pbrand as $key => $val){
                $pstr .= "'".$val['brand']."',";
            }
            $pstr = trim($pstr,',');
            $sql = "SELECT * FROM mallbuilder_brand WHERE `status` = 1 and logo<>'' AND name in($pstr) ORDER BY displayorder DESC LIMIT 10";
            $db->query($sql);
            $brand = $db->getRows();
            $tpl->assign("brand", $brand);
        }else {
            //获取品牌
            $sql = "SELECT * FROM mallbuilder_brand WHERE `status` = 1 and logo<>'' ORDER BY displayorder DESC LIMIT 10";
            $db->query($sql);
            $brand = $db->getRows();
            $tpl->assign("brand", $brand);
        }
        //取相应店铺的对应分类

		switch($_GET['uid']){
			case 91 : $pcat = 1007; break;
			case 49 : $pcat = 1006; break;
			case 48 : $pcat = 1004; break;
			case 44 : $pcat = 1005; break;
            default : $pcat = 1004;
		}

		//获取分类
		$sql = "SELECT catid,cat,wpic FROM mallbuilder_product_cat where catid > $pcat"."00 and catid < $pcat"."99";
		$db->query($sql);
		$catids = $db->getRows();
		foreach ($catids as $k => $v) {
			$catids[$v['catid']] = $v;
            unset($catids[$k]);
		}
		$tpl->assign("catids", $catids);

		//获取商品
		if ($config['temp'] == 'wap') {
			$limit = 3;
		} elseif ($config['temp'] == 'default') {
			$limit = 10;
		}

			foreach ($catids as $key => $val) {
					if(!empty($_GET['uid'])){
						$sql = "SELECT a.pid,a.name,a.subhead,a.trade,a.market_price,a.price,a.pic,a.id,a.catid,b.img,b.title FROM mallbuilder_product a LEFT JOIN mallbuilder_national_pavilions b ON a.national = b.id WHERE member_id = {$_GET['uid']} and LOCATE({$val['catid']},a.catid)>0  LIMIT " . $limit;
						$db->query($sql);
						$product = $db->getRows();
						foreach ($product as $k => $v) {
							$sql = "SELECT COUNT(id) as nums FROM mallbuilder_product_comment WHERE pid = " . $v['id'];
							$db->query($sql);
							$product[$k]['nums'] = $db->fetchField('nums');
						}
						if (!empty($product)) {
							$products[$val['catid']] = $product;
						}
					}else{
						$products='';
					}

			}

			$tpl->assign("products", $products);

            //获取橱窗推荐
            $sql = "SELECT a.pid,a.name,a.subhead,a.trade,a.market_price,a.price,a.pic,a.id,a.catid,b.img,b.title FROM mallbuilder_product a LEFT JOIN mallbuilder_national_pavilions b ON a.national = b.id WHERE a.shop_rec = 1 and is_shelves = 1 AND a.member_id = ".$_GET[uid]."  LIMIT 10";
            $db->query($sql);
            $cproduct = $db->getRows();
            $tpl->assign("cproducts", $cproduct);

			//判断是否收藏商品
			if (!empty($_COOKIE['USER'])) {
				$user = $_COOKIE['USER'];
				$shopid = $_GET['uid'];
				//获取 当前用户 userid
				$sql = "select userid from " . MEMBER . " where user='" . $user . "'";
				$db->query($sql);
				$uid = $db->fetchField('userid');

				//判断 当前用户 是否 添加 共享 商铺
				$sql = "select statu from " . SSHOP . " where uid=" . $uid . " and shopid=" . $shopid;
				$db->query($sql);
				$sshop = $db->fetchRow();
				if ($sshop['statu'] != 1) {
					$tpl->assign('sns_shop', 'no');
				} else {
					$tpl->assign('sns_shop', 'yes');
				}
			}
			include_once("footer.php");

			//----------------------------------------------
			if (empty($output))
				$tpl->assign("output", $tpl->fetch($page ? $page : "space_company.htm", $flag));
			else
				$tpl->assign("output", $output);
		} else {
			if ($config['temp'] == 'wap') {
				msg("$config[weburl]", "商铺还未开启，或暂时关闭,将转向主页");
			} else {
				echo json_encode(array(
					'status' => 0
				));
				die;
			}
		}
}
	$tpl->assign("chat_open_flag", $chat_open_flag);
	$tpl->display("space_temp_inc.htm", $flag);


?>