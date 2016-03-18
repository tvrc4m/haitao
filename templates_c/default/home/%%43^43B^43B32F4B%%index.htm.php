<?php /* Smarty version 2.6.20, created on 2016-03-17 09:41:53
         compiled from index.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'index.htm', 177, false),)), $this); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $this->_tpl_vars['title']; ?>
-<?php echo $this->_tpl_vars['config']['company']; ?>
</title>
</head>
<link href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/module/sns/templates/home/home.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/script/jquery-1.4.4.min.js"></script>
<script type="text/javascript" src="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/script/jquery.ui.js"></script>
<script type="text/javascript" src="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/script/jquery.validation.min.js"></script>
<script type="text/javascript" src="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/script/jquery.charCount.js"></script>
<script type="text/javascript" src="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/script/sns.js"></script>
<script>
$(function(){
	//加关注
	$("[genre='followbtn']").live('click',function(){
		
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
		var data_str = $(this).attr('data-param');
        eval( "data_str = "+data_str);
		var pars = 'mid='+data_str.mid+'&uname='+uname+'&op=add';
		$.post(url, pars,showResponse);
		function showResponse(originalRequest)
		{
			if(originalRequest>1)
				alert('成功添加');
			else if (originalRequest>0)
				alert('已添加');
			else
				alert('参数传递错误，无法完成操作');
		}
	});
});
</script>
<body>
<div id="site-nav">
    <div id="site-nav-bd">
    	<p class="login-info"><script src="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/login_statu.php"></script></p>
        <ul class="quick-menu">
            <li class="user-center">
                <div class="menu">
                    <a href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/main.php?cg_u_type=1" class="menu-hd">我的商城<b></b></a>
                    <div class="menu-bd">
                    <ul>
                        <li><a href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/main.php?cg_u_type=1&m=product&s=admin_buyorder">已买到的商品</a></li>
                        <li><a target="_blank" href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/home.php?uid=<?php echo $this->_tpl_vars['userid']; ?>
">个人主页</a></li>
                        <li><a href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/main.php?cg_u_type=1&m=sns&s=admin_friends">我的好友</a></li>
                    </ul>
                    </div>
                </div>
            </li>
            <li class="seller-center">
                <div class="menu">
                    <a href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/main.php?cg_u_type=2" class="menu-hd">卖家中心<b></b></a>
                    <div class="menu-bd">
                    <ul>
                        <li><a href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/main.php?cg_u_type=2&m=product&s=admin_sellorder">已售出的商品</a></li>
                        <li><a href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/main.php?cg_u_type=2&m=product&s=admin_product_list">销售中的商品</a></li>
                        <li><a target="_blank" href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/shop.php?uid=<?php echo $this->_tpl_vars['userid']; ?>
">我的店铺</a></li>
                    </ul>
                    </div>
                </div>
            </li>
            <li class="cart">
				<span class="menu-hd"><s></s><a href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/?m=product&s=cart">购物车<strong class="goods_num"><script src="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/?m=product&s=cart_number"></script></strong>种商品</a><i></i></span>
            </li>
            <li class="favorite">
                <div class="menu">
                    <a href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/main.php?cg_u_type=1" class="menu-hd">我的收藏<b></b></a>
                    <div class="menu-bd">
                    <ul>
                        <li><a href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/main.php?cg_u_type=1&m=sns&s=admin_share_product">收藏的商品</a></li>
                        <li><a href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/main.php?cg_u_type=1&m=sns&s=admin_share_shop">收藏的店铺</a></li>
                    </ul>
                    </div>
                </div>
            </li>
            <li><a href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/main.php?m=message&s=admin_message_list_inbox">站内消息</a></li>
        </ul>
    </div>
</div>

<div id="header">
	<div class="wrapper">
		<h1 id="logo"><a href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
"><img style="padding-top:5px;" height=40 src="<?php if ($this->_tpl_vars['config']['logo']): ?><?php echo $this->_tpl_vars['config']['logo']; ?>
<?php else: ?><?php echo $this->_tpl_vars['config']['weburl']; ?>
/image/logo.gif<?php endif; ?>" /></a></h1>
    	<h2>个人主页</h2>
        <div class="search">
        <form method="get" action="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/" id="formSearch">
            <input type="text" class="text" id="key" name="key">
          	<input type="hidden" name="m" value="" />
            <input type="hidden" name="s" value="list" />
			<a onclick="$('#formSearch').submit();" href="javascript:void(0)"> <span>搜索</span> </a>
        </form>
        </div>
    </div>
</div>
<div id="append_parent"></div>
<div id="ajaxwaitid"></div>
<div id="container">
	<div id="content" class="wrapper">
    	<div class="head">
        	<div class="info clearfix">
            	<div class="info-left">
                	<div class="basic-info">
                        <div class="realy-info">
                       		<span class="credit">买家信用</span>
                            <img class="points" align="absmiddle" title="<?php echo $this->_tpl_vars['member']['buyerpoints']; ?>
个买家信用积分" src="image/points/<?php echo $this->_tpl_vars['member']['buyerpointsimg']; ?>
">
                        </div>
                        <div class="meta">
                        	<span class="sex<?php if ($this->_tpl_vars['member']['sex'] == 2): ?> female<?php endif; ?>"><?php if ($this->_tpl_vars['member']['sex'] == 2): ?>女<?php else: ?>男<?php endif; ?></span>
                        	<span><?php echo $this->_tpl_vars['member']['area']; ?>
</span><br />
							<span><a href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/shop.php?uid=<?php echo $_GET['uid']; ?>
">逛TA商铺</a></span>
                        </div>
                        <h2 class="name"><div class="nick"><?php echo $this->_tpl_vars['member']['name']; ?>
</div></h2>
                    </div>
                    <div class="user-avatar"><img width="160" height="160" src="<?php if ($this->_tpl_vars['member']['logo']): ?><?php echo $this->_tpl_vars['member']['logo']; ?>
<?php else: ?>image/default/avatar.png<?php endif; ?>"></div>
                </div>
                <div class="info-right">
                	<div class="attention-box">
                        <div class="attention clearfix">
                            <ul>
                                <li><b class="large"><?php echo $this->_tpl_vars['count']['f']; ?>
</b><span>粉丝</span></li>
                                <li><b class="large"><?php echo $this->_tpl_vars['count']['g']; ?>
</b><span>关注</span></li>
                                <li><b class="large"><?php echo $this->_tpl_vars['count']['v']; ?>
</b><span>访问</span></li><li class="clear"></li>
                            </ul>
                        </div>
                    </div>
                    <?php if ($_GET['uid'] != $this->_tpl_vars['userid']): ?>
						<div class="follow-widget">
							<?php if ($this->_tpl_vars['friend']): ?>
								<span class="<?php if ($this->_tpl_vars['fan']): ?>all_gz<?php else: ?>have_gz<?php endif; ?>">
								<b style="margin-left:25px;">已关注</b> &nbsp;&nbsp;
								<a href="main.php?m=message&s=admin_message_sed&uid=<?php echo $_GET['uid']; ?>
">发私信</a></span>
							<?php else: ?>
								<a genre="followbtn" data-param="{'mid':'<?php echo $_GET['uid']; ?>
'}" href="javascript:void(0)"></a>
							<?php endif; ?>
						</div>
                    <?php endif; ?>
                </div>
            </div>
            <div class="clear"></div>
            <div class="nav">
            	<ul class="clearfix">
                	<li class="<?php if ($_GET['act'] == ''): ?>current <?php endif; ?>first">
                    	<a class="front" href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/home.php?uid=<?php echo $_GET['uid']; ?>
">首页</a>
                    </li>
                    <li <?php if ($_GET['act'] == 'product'): ?>class="current"<?php endif; ?> >
                    	<a class="product" href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/home.php?uid=<?php echo $_GET['uid']; ?>
&act=product">宝贝</a>
                    </li>
                    <li class="<?php if ($_GET['act'] == 'trace'): ?>current <?php endif; ?>last">
                    	<a class="trace" href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/home.php?uid=<?php echo $_GET['uid']; ?>
&act=trace">新鲜事</a>
                    </li>
                </ul>
            </div>
        </div>
        
        <div class="body clearfix">
        	<div class="body-main <?php if ($_GET['act'] == 'product'): ?>pro<?php endif; ?>"><?php echo $this->_tpl_vars['output']; ?>
</div>
        	<?php if ($_GET['act'] != 'product'): ?>
            <div class="body-side">
            	<div class="visitors">
					<h4><em>最近访客</em></h4>   
					<ul class="visitlist">
                    	<?php $_from = $this->_tpl_vars['visitors']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['nums'] => $this->_tpl_vars['list']):
?>
                        <li>
                            <p class="visitor_pic">
                                <a target="_blank" href="home.php?uid=<?php echo $this->_tpl_vars['list']['userid']; ?>
"><img height="60" width="60" src="<?php if ($this->_tpl_vars['list']['logo'] != '' && $this->_tpl_vars['list']['logo'] != '0'): ?><?php echo $this->_tpl_vars['list']['logo']; ?>
<?php else: ?>image/default/user_admin/default_user_portrait.gif<?php endif; ?>" /></a>
                            </p>
                            <p class="visitor_name"><a target="_blank" href="home.php?uid=<?php echo $this->_tpl_vars['list']['userid']; ?>
"><?php echo $this->_tpl_vars['list']['user']; ?>
</a></p>
                            <p class="visitor_time"><?php echo ((is_array($_tmp=$this->_tpl_vars['list']['time'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%m月 %d日") : smarty_modifier_date_format($_tmp, "%m月 %d日")); ?>
</p>
                        </li>
                        <?php endforeach; else: ?>
                        <span>&nbsp;&nbsp;暂无访客</span>
                        <?php endif; unset($_from); ?>
                    </ul> 
                </div>
            </div>
            <?php endif; ?>
        </div>
    </div>
</div>
<div id="footer">
    <div class="footer">
        <p><?php echo $this->_tpl_vars['web_con']; ?>
</p>
        <?php echo $this->_tpl_vars['bt']; ?>
<br>
    </div>
</div>
</body>
</html>