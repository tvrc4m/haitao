<?php /* Smarty version 2.6.20, created on 2016-03-18 13:34:24
         compiled from space_temp_inc.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'truncate', 'space_temp_inc.htm', 7, false),array('modifier', 'regex_replace', 'space_temp_inc.htm', 25, false),array('modifier', 'number_format', 'space_temp_inc.htm', 87, false),array('modifier', 'strip_tags', 'space_temp_inc.htm', 99, false),array('function', 'geturl', 'space_temp_inc.htm', 144, false),array('function', 'math', 'space_temp_inc.htm', 223, false),)), $this); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php if ($this->_tpl_vars['com']['shop_title'] != ''): ?><?php echo $this->_tpl_vars['com']['shop_title']; ?>
 - <?php echo $this->_tpl_vars['config']['company']; ?>
<?php else: ?><?php echo $this->_tpl_vars['title']; ?>
 - <?php echo $this->_tpl_vars['config']['company']; ?>
<?php endif; ?></title>
<meta name="description" content="<?php if ($this->_tpl_vars['com']['shop_keywords'] != ''): ?><?php echo $this->_tpl_vars['com']['shop_keywords']; ?>
<?php else: ?><?php echo $this->_tpl_vars['keyword']; ?>
<?php endif; ?>">
<meta name="keywords" content="<?php if ($this->_tpl_vars['com']['shop_description'] != ''): ?><?php echo $this->_tpl_vars['com']['shop_description']; ?>
<?php else: ?><?php echo ((is_array($_tmp=$this->_tpl_vars['de']['description'])) ? $this->_run_mod_handler('truncate', true, $_tmp, 100, "...", true) : smarty_modifier_truncate($_tmp, 100, "...", true)); ?>
<?php endif; ?>">
<link rel="stylesheet" type="text/css" href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/templates/user_templates_default/space.css"/>
<script src="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/script/jquery-1.4.4.min.js" type="text/javascript"></script>
<script language="javascript" src="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/templates/user_templates_default/jquery.Sonline.js"></script>
<script language="javascript" src="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/script/jquery.flexslider-min.js"></script>
<script type="text/javascript">
function getfavshop()
{	
	var url = '<?php echo $this->_tpl_vars['config']['weburl']; ?>
/module/sns/ajax_update.php';
	
	var uname='<?php echo $_COOKIE['USER']; ?>
';
	if(uname=='')
	{
		alert('<?php echo $this->_tpl_vars['lang']['no_logo']; ?>
');
		window.location.href='<?php echo $this->_tpl_vars['config']['weburl']; ?>
/login.php?forward=shop.php?uid=<?php echo $_GET['uid']; ?>
';
		return false;
	}
	var shopid='<?php echo $_GET['uid']; ?>
';
	var shopname="<?php echo ((is_array($_tmp=$this->_tpl_vars['com']['company'])) ? $this->_run_mod_handler('regex_replace', true, $_tmp, "/[\r\t\n]/", "") : smarty_modifier_regex_replace($_tmp, "/[\r\t\n]/", "")); ?>
";
	var pars = 'uname='+uname+'&shopid='+shopid+'&shopname='+shopname;
	$.post(url, pars,showResponse);
	function showResponse(originalRequest)
	{
		if(originalRequest>1)
			alert('<?php echo $this->_tpl_vars['lang']['fav_ok']; ?>
');
		else if (originalRequest>0)
			alert('<?php echo $this->_tpl_vars['lang']['fav_isbing']; ?>
');
		else
			alert('<?php echo $this->_tpl_vars['lang']['error']; ?>
');
	 }
	
}
$(function(){
	$("body").Sonline({
		<?php if (! $this->_tpl_vars['cs']): ?>
		DefaultsOpen:false,
		<?php endif; ?>
		Qqlist:"<?php echo $this->_tpl_vars['cs']; ?>
" //多个QQ用','隔开，QQ和客服名用'|'隔开
	});
})	
</script>
</head>
<body>

<div class="site-nav">
	<div class="w">
    	<ul class="left">
			<li><script src="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/login_statu.php"></script></li>
        </ul>
    	<ul class="right">
			<li class="nbr"><a href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/main.php?m=message&s=admin_message_list_inbox" class="note"><?php echo $this->_tpl_vars['lang']['news_station']; ?>
</a></li>
			<li><a href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/main.php?m=sns&s=admin_share_product">收藏夹</a></li>
			<li><a href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/?m=product&s=cart" class="shopping">购物车<span><script src="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/?m=product&s=cart_number"></script></span>件</a></li>
            <li><a href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/main.php?cg_u_type=2">卖家中心</a></li>
            <li><a href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/main.php?cg_u_type=1">我的商城</a></li>
            <li><a href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
" class="index"><?php echo $this->_tpl_vars['config']['company']; ?>
首页</a></li>
        </ul>
    </div>
</div>


<div class="header">
	<div class="w">
        <div class="logo">
        <a href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/shop.php?uid=<?php echo $_GET['uid']; ?>
">
       
        <img width="180" height="40" src="<?php if ($this->_tpl_vars['com']['shop_logo']): ?><?php echo $this->_tpl_vars['com']['shop_logo']; ?>
<?php else: ?><?php if ($this->_tpl_vars['config']['logo']): ?><?php echo $this->_tpl_vars['config']['logo']; ?>
<?php else: ?><?php echo $this->_tpl_vars['config']['weburl']; ?>
/image/logo.gif<?php endif; ?><?php endif; ?>" >
        </a>
        </div>
         
         <div class="shop_info">
        	<div class="shop_info_simple">
            	<p><a class="shop_name" href="#"><?php echo $this->_tpl_vars['com']['company']; ?>
</a> <?php if ($this->_tpl_vars['chat_open_flag']): ?>&nbsp; <a href="javascript:void(0);" onclick="return chat(<?php echo $this->_tpl_vars['com']['shop_id']; ?>
);"><span class="iconfont" style="color: #FF6600;font-size: 16px;">&#xe635;</span></a><?php endif; ?></p>
                <div class="shop_credit">
                    <span><?php if ($this->_tpl_vars['com']['sellerpointsimg']): ?><img alt="<?php echo $this->_tpl_vars['com']['sellerpoints']; ?>
" title="<?php echo $this->_tpl_vars['com']['sellerpoints']; ?>
" align="absmiddle" src="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/image/points/<?php echo $this->_tpl_vars['com']['sellerpointsimg']; ?>
"><?php else: ?><?php echo $this->_tpl_vars['com']['sellerpoints']; ?>
<?php endif; ?></span>
                </div>
            </div>
            <div class="shop_info_details">
            	<dl style="width:190px">
                	<dt>描述相符：</dt>
                    <dd><span class="star"><em style=" width:<?php echo $this->_tpl_vars['score']['aw']; ?>
%"><?php echo ((is_array($_tmp=$this->_tpl_vars['score']['a'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 1) : number_format($_tmp, 1)); ?>
</em></span><span class="num"><?php echo ((is_array($_tmp=$this->_tpl_vars['score']['a'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 1) : number_format($_tmp, 1)); ?>
分</span></dd>
                    <dt>服务态度：</dt>
                    <dd><span class="star"><em style=" width:<?php echo $this->_tpl_vars['score']['bw']; ?>
%"><?php echo ((is_array($_tmp=$this->_tpl_vars['score']['b'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 1) : number_format($_tmp, 1)); ?>
</em></span><span class="num"><?php echo ((is_array($_tmp=$this->_tpl_vars['score']['b'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 1) : number_format($_tmp, 1)); ?>
分</span></dd>
                    <dt>发货速度：</dt>
                    <dd><span class="star"><em style=" width:<?php echo $this->_tpl_vars['score']['cw']; ?>
%"><?php echo ((is_array($_tmp=$this->_tpl_vars['score']['c'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 1) : number_format($_tmp, 1)); ?>
</em></span><span class="num"><?php echo ((is_array($_tmp=$this->_tpl_vars['score']['c'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 1) : number_format($_tmp, 1)); ?>
分</span></dd>
                </dl>
                <dl style="width:160px">
                	<?php if ($this->_tpl_vars['com']['name']): ?>
                    <dt>店主：</dt>
                    <dd><?php echo $this->_tpl_vars['com']['name']; ?>
</dd>
                    <?php endif; ?>
                    <dt>创店时间：</dt>
                    <dd><?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['com']['regtime'])) ? $this->_run_mod_handler('strip_tags', true, $_tmp) : smarty_modifier_strip_tags($_tmp)))) ? $this->_run_mod_handler('truncate', true, $_tmp, 10, "") : smarty_modifier_truncate($_tmp, 10, "")); ?>
</dd>
				</dl>
              	<dl style="width:150px">
					<dt>商品数量：</dt>
                    <dd><?php echo $this->_tpl_vars['com']['count']; ?>
</dd>
                   
                </dl>
                <dl style="width:320px">
                    <dt>所在地区：</dt>
                    <dd><?php echo $this->_tpl_vars['com']['area']; ?>
</dd>
                </dl>
            </div>
        </div>
        
		<div class="shop-search">
            <div>
            <form action="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/shop.php" method="get" id="search_form">
                <input type="text" autocomplete="off" onkeyup="get_search_word(this.value);" value="<?php echo $_GET['keyword']; ?>
" id="keyword"  name="keyword" class="search_input">
                <input type="submit" value="搜本店" class="search_btn">
                <input type="submit" value="搜平台" class="search_btn_platform">
                <input id="search" type="hidden" name="search" value="search" />
                <input id="uid" name="uid" type="hidden" value="<?php echo $_GET['uid']; ?>
" />
                <input id="action" name="action" type="hidden" value="product_list" />
                <input id="s" name="s" type="hidden" value="list" />
                <input id="m" name="m" type="hidden" value="product" />

            </form>
            </div>
            <div id="key_select"></div>
		</div>
    </div>
</div>

<div style="background:url(<?php if ($this->_tpl_vars['com']['shop_banner']): ?><?php echo $this->_tpl_vars['com']['shop_banner']; ?>
<?php else: ?><?php echo $this->_tpl_vars['config']['weburl']; ?>
/templates/user_templates_default/img/ad.gif<?php endif; ?>) center top no-repeat;">
	<div id="nav">
		<div class="banner"></div>
		<div class="nav_bg">
            <div class="w">
            <ul class="clearfix">
                <a href="javascript:getfavshop();" class="collection"></a>
                <?php $_from = $this->_tpl_vars['nav_menu']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['list']):
?>
                <?php if ($this->_tpl_vars['list']['menu_show'] == '1'): ?>
                    <?php if ($this->_tpl_vars['list']['menu_link'] != ''): ?>
                        <li class="<?php if ($this->_tpl_vars['list']['menu_link'] == $_GET['action']): ?>active<?php else: ?>normal<?php endif; ?>"  ><a href="shop.php?uid=<?php echo $this->_tpl_vars['com']['userid']; ?>
&action=<?php echo $this->_tpl_vars['list']['menu_link']; ?>
&m=<?php echo $this->_tpl_vars['list']['module']; ?>
"><span><?php echo $this->_tpl_vars['list']['menu_name']; ?>
</span></a></li>
                        <?php else: ?>
                        <li class="<?php if ($_GET['action'] == ''): ?>active<?php else: ?>normal<?php endif; ?>" ><a href="<?php echo smarty_function_geturl(array('user' => $this->_tpl_vars['com']['number'],'uid' => $this->_tpl_vars['com']['userid'],'com' => $this->_tpl_vars['com']['company']), $this);?>
"><span><?php echo $this->_tpl_vars['list']['menu_name']; ?>
</span></a></li>
                    <?php endif; ?>
                <?php endif; ?>
                <?php endforeach; endif; unset($_from); ?>
                <?php $_from = $this->_tpl_vars['shop_nav']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['list']):
?>
                	<?php if ($this->_tpl_vars['key'] < 4): ?>
                    <li class="<?php if ($_GET['action'] == 'public' && $_GET['id'] == $this->_tpl_vars['list']['id']): ?>active<?php else: ?>normal<?php endif; ?>"  ><a <?php if ($this->_tpl_vars['list']['new_open'] == 1): ?>target="_blank"<?php endif; ?> href="<?php if ($this->_tpl_vars['list']['url']): ?><?php echo $this->_tpl_vars['list']['url']; ?>
<?php else: ?>shop.php?uid=<?php echo $this->_tpl_vars['com']['userid']; ?>
&action=public&m=shop&id=<?php echo $this->_tpl_vars['list']['id']; ?>
<?php endif; ?>"><span><?php echo $this->_tpl_vars['list']['title']; ?>
</span></a></li>
                    <?php endif; ?>
                <?php endforeach; endif; unset($_from); ?>
            </ul>
            </div>
        </div>
    </div>
</div>

<div class="w">
    <?php if ($_GET['m'] == 'product' && $_GET['s'] == 'detail'): ?>
    <?php echo $this->_tpl_vars['output']; ?>

    <?php else: ?>
    <?php if (! $_GET['action']): ?>
    <div class="flexslider clearfix">
        <ul class="slides">
            <?php if ($this->_tpl_vars['com']['slide']['0']): ?>
            <?php $_from = $this->_tpl_vars['com']['slide']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['num'] => $this->_tpl_vars['list']):
?>
            <li style="width: 100%; float: left; margin-right: -100%; display: <?php if ($this->_tpl_vars['num'] == 0): ?>list-item<?php else: ?>none<?php endif; ?>;"><?php if ($this->_tpl_vars['com']['slideurl'][$this->_tpl_vars['num']]): ?><a target="_blank" href="<?php echo $this->_tpl_vars['com']['slideurl'][$this->_tpl_vars['num']]; ?>
"><img src="<?php echo $this->_tpl_vars['list']; ?>
"></a><?php else: ?><img src="<?php echo $this->_tpl_vars['list']; ?>
"><?php endif; ?></li>
            <?php endforeach; endif; unset($_from); ?>  
            <?php else: ?> 
            <li style="width: 100%; float: left; margin-right: -100%; display: list-item;"> <img src="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/templates/user_templates_default/img/f01.jpg"> </li>
            <li style="width: 100%; float: left; margin-right: -100%; display: none;"> <img src="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/templates/user_templates_default/img/f02.jpg"> </li>
            <li style="width: 100%; float: left; margin-right: -100%; display: none;"> <img src="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/templates/user_templates_default/img/f03.jpg"> </li>
            <li style="width: 100%; float: left; margin-right: -100%; display: none;"> <img src="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/templates/user_templates_default/img/f04.jpg"> </li>
           <?php endif; ?>
        </ul>
    </div>
    <script type="text/javascript">
	$(window).load(function() {
		$('.flexslider').flexslider();
	}); 
	</script> 
    <?php endif; ?>
    <div id="left">
        <div class="user clearfix">
            <div class="user_photo">
                <h2><?php echo $this->_tpl_vars['com']['company']; ?>
 <?php if ($this->_tpl_vars['chat_open_flag']): ?>&nbsp; <a href="javascript:void(0);" onclick="return chat(<?php echo $this->_tpl_vars['com']['shop_id']; ?>
);"><span class="iconfont" style="color: #FF6600;font-size: 18px;">&#xe635;</span></a><?php endif; ?></h2>
                <dl>
                    <dt>
                        <?php if ($this->_tpl_vars['com']['logo']): ?>
                            <img width="65" height="60" src="<?php echo $this->_tpl_vars['com']['logo']; ?>
">
                        <?php else: ?>
                            <img src="image/default/nopic.gif" width="65" height="60" />
                        <?php endif; ?>
                    </dt>
                    <dd><b><a target="_blank" href="home.php?uid=<?php echo $this->_tpl_vars['com']['userid']; ?>
"><?php echo $this->_tpl_vars['com']['name']; ?>
</a></b></dd>
					<dd><img title="<?php echo $this->_tpl_vars['lang']['credit_of_seller']; ?>
<?php echo $this->_tpl_vars['com']['sellerpoints']; ?>
" align="absmiddle" src="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/image/points/<?php echo $this->_tpl_vars['com']['sellerpointsimg']; ?>
"></dd>
                    <dd>好评率：<?php if ($this->_tpl_vars['com']['favorablerate'] == '100'): ?><?php echo ((is_array($_tmp=$this->_tpl_vars['com']['favorablerate'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 0) : number_format($_tmp, 0)); ?>
<?php else: ?><?php echo ((is_array($_tmp=$this->_tpl_vars['com']['favorablerate'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2) : number_format($_tmp, 2)); ?>
<?php endif; ?>%</dd>
                </dl> 
            </div>
            <div class="clear"></div>
            <div class="user_data">
                <h2>动态评价</h2>
                <p>描述相符：<span class="star"><em style=" width:<?php echo $this->_tpl_vars['score']['aw']; ?>
%"><?php echo ((is_array($_tmp=$this->_tpl_vars['score']['a'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 1) : number_format($_tmp, 1)); ?>
</em></span><span class="num"><?php echo ((is_array($_tmp=$this->_tpl_vars['score']['a'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 1) : number_format($_tmp, 1)); ?>
分</span></p>
                <p>服务态度：<span class="star"><em style=" width:<?php echo $this->_tpl_vars['score']['bw']; ?>
%"><?php echo ((is_array($_tmp=$this->_tpl_vars['score']['b'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 1) : number_format($_tmp, 1)); ?>
</em></span><span class="num"><?php echo ((is_array($_tmp=$this->_tpl_vars['score']['b'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 1) : number_format($_tmp, 1)); ?>
分</span></p>
                <p>发货速度：<span class="star"><em style=" width:<?php echo $this->_tpl_vars['score']['cw']; ?>
%"><?php echo ((is_array($_tmp=$this->_tpl_vars['score']['c'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 1) : number_format($_tmp, 1)); ?>
</em></span><span class="num"><?php echo ((is_array($_tmp=$this->_tpl_vars['score']['c'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 1) : number_format($_tmp, 1)); ?>
分</span></p>
                <p>物流速度：<span class="star"><em style=" width:<?php echo $this->_tpl_vars['score']['dw']; ?>
%"><?php echo ((is_array($_tmp=$this->_tpl_vars['score']['d'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 1) : number_format($_tmp, 1)); ?>
</em></span><span class="num"><?php echo ((is_array($_tmp=$this->_tpl_vars['score']['d'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 1) : number_format($_tmp, 1)); ?>
分</span></p>			
				<h2>店铺信息</h2>
                <p>认证信息：
                <img src="image/default/certification<?php if ($this->_tpl_vars['com']['shop_auth'] != '1'): ?>_no<?php endif; ?>.gif" />
                <img src="image/default/certautonym<?php if ($this->_tpl_vars['com']['shopkeeper_auth'] != '1'): ?>_no<?php endif; ?>.gif" />
                </p>
                <p>保证金：<?php echo $this->_tpl_vars['com']['earnest']; ?>
</p>
                <p>商品数量：<?php echo $this->_tpl_vars['com']['count']; ?>
</p>
                <p>创店时间：<?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['com']['regtime'])) ? $this->_run_mod_handler('strip_tags', true, $_tmp) : smarty_modifier_strip_tags($_tmp)))) ? $this->_run_mod_handler('truncate', true, $_tmp, 10, "") : smarty_modifier_truncate($_tmp, 10, "")); ?>
</p>
            </div>
            <div class="shop_other">
                <ul>
                    <li class="info_qrcode">
                        <a href="javascript:void(0)">
                        <span>店铺二维码</span><b></b>
                        <!--<p class="qrcode"><img src="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/uploadfile/phpqrcode/<?php echo $_GET['uid']; ?>
.jpg"></p>-->
                        <p class="qrcode"><img src="api/share_qrcode.php?type=shop&shop_id=<?php echo $_GET['uid']; ?>
&rand=<?php echo smarty_function_math(array('equation' => "rand(1,10000)"), $this);?>
"></p>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="i-search">
            <h2>店内搜索</h2>
            <div class="con">
                <form method="get" action="shop.php" name="" id="">
                	<table>
                    	<tr>
                        	<td width="40">商品：</td>
                        	<td><input type="text" name="keyword" value="<?php echo $_GET['keyword']; ?>
" class="text w112"></td>
                        </tr>
                    	<tr>
                        	<td>价格：</td>
                        	<td>
                            <input type="text" name="price1" value="<?php echo $_GET['price1']; ?>
" class="text w48">
                            -
                            <input type="text" name="price2" value="<?php echo $_GET['price2']; ?>
" class="text w48">
                            </td>
                        </tr>
                    	<tr>
                        	<td></td>
                        	<td><input type="submit" value="搜索" class="btn"></td>
                        </tr>
                    </table>
                    <input id="search" type="hidden" value="search" />
                    <input id="uid" name="uid" type="hidden" value="<?php echo $_GET['uid']; ?>
" />
                    <input id="action" name="action" type="hidden" value="product_list" />
                    <input id="m" name="m" type="hidden" value="product" />
                </form>
            </div>
        </div>
        <?php if ($this->_tpl_vars['custom_cat']): ?>
        <div class="module_common">
            <h2>分类</h2>
            <div class="con">
                <ul class="submenu">
                    <li><a class="block_ico" href="shop.php?uid=<?php echo $_GET['uid']; ?>
&action=product_list&m=product" title="<?php echo $this->_tpl_vars['lang']['whole']; ?>
">全部</a>
                    </li></li>
                    <?php $_from = $this->_tpl_vars['custom_cat']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['list']):
?>
                    <li>
                    <a class="<?php if ($this->_tpl_vars['list']['con']): ?>none_ico<?php else: ?>block_ico<?php endif; ?>" href="shop.php?uid=<?php echo $_GET['uid']; ?>
&action=product_list&m=product&cat=<?php echo $this->_tpl_vars['list']['id']; ?>
" title="<?php echo $this->_tpl_vars['list']['name']; ?>
"><?php echo $this->_tpl_vars['list']['name']; ?>
</a>
                    <?php if ($this->_tpl_vars['list']['con']): ?>
                    <ul>
                        <?php $_from = $this->_tpl_vars['list']['con']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['lists']):
?>
                            <li><a href="shop.php?uid=<?php echo $_GET['uid']; ?>
&action=product_list&m=product&cat=<?php echo $this->_tpl_vars['lists']['id']; ?>
" title="<?php echo $this->_tpl_vars['lists']['name']; ?>
"><?php echo $this->_tpl_vars['lists']['name']; ?>
</a></li>
                        <?php endforeach; endif; unset($_from); ?>
                    </ul>
                    <?php endif; ?>
                    </li>
                    <?php endforeach; endif; unset($_from); ?>
                </ul>
            </div>
        </div>
        <?php endif; ?>
        <?php if (count ( $this->_tpl_vars['ulink'] ) > 0): ?>
        <div class="module_common">
            <h2>友情链接</h2>
            <div class="con">
                <div class="con_child">
                    <ul class="submenu">
                        <?php $_from = $this->_tpl_vars['ulink']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['link']):
?>
                        <li><a target="_blank" class="link_ico" href="<?php echo $this->_tpl_vars['link']['url']; ?>
" title="<?php echo $this->_tpl_vars['link']['desc']; ?>
"><?php echo $this->_tpl_vars['link']['name']; ?>
</a></li>
                        <?php endforeach; endif; unset($_from); ?>
                    </ul>
                </div>
            </div>
        </div>
        <?php endif; ?>
    </div>
	<div id="right"><?php echo $this->_tpl_vars['output']; ?>
</div>
    <div class="clear"></div>
	<?php endif; ?>
</div>
<script type="text/javascript">
    $(".block_ico,.none_ico").click(function(e){
        var xx = e.originalEvent.x || e.originalEvent.layerX || 0; 
        var lo = $(this).offset().left

        if($(this).parents("li").find("ul").length > 0)
        {
            if($(this).parents("li").find("ul").is(":visible"))
            {

                $(this).parents("li").find("ul").slideUp()
                $(this).removeClass("none_ico").addClass("block_ico")
            }
            else
            {
                $(this).parents("li").find("ul").slideDown()
                 $(this).removeClass("block_ico").addClass("none_ico")
            }
        }
        
        if(xx*1 - lo*1 < 22)
        {
            return false
        }
    })


    $(".search_btn").mouseover(function(e){
        $('#search_form').attr('action', "<?php echo $this->_tpl_vars['config']['weburl']; ?>
/shop.php");
    })

    $(".search_btn_platform").mouseover(function(e){
        $('#search_form').attr('action', "<?php echo $this->_tpl_vars['config']['weburl']; ?>
/?m=product&s=list");
    })


    function get_search_word(k)
    {
        if(k!='')
        {
            var url = '<?php echo $this->_tpl_vars['config']['weburl']; ?>
/ajax_back_end.php';
            var sj = Math.random();
            var pars = 'shuiji=' + sj+'&search_flag=1&key='+k;
            $.post(url, pars,showResponse);
        }

        function showResponse(originalRequest)
        {
            if(originalRequest)
            {
                $('#key_select').show();
                //$('#key_select').css("display",'block');
                $('#key_select').html(originalRequest);
            }
            else
                $('#key_select').hide();
        }

    }
    function select_word(v)
    {
        $('#keyword').val(v);
        $('#key_select').hide();
    }

</script>


<div id="footer">
    <p><?php echo $this->_tpl_vars['web_con']; ?>
</p><?php echo $this->_tpl_vars['bt']; ?>
 
</div>

<?php echo $this->_tpl_vars['chat_html']; ?>


</body>
</html>
