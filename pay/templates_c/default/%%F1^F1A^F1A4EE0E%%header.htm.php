<?php /* Smarty version 2.6.20, created on 2016-05-26 15:02:45
         compiled from header.htm */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>我的<?php echo $this->_tpl_vars['config']['company']; ?>
 － <?php echo $this->_tpl_vars['config']['company']; ?>
</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<script type="text/javascript" src="script/jquery-1.4.4.min.js"></script>
<link href="../templates/default/css/page.css" rel="stylesheet" type="text/css" />
<link href="templates/default/css/page.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div class="top">
   <div class="site-nav">
    <div class="w fn-clear">
        <ul class="fn-left">
            <li class="nav">
                <span class="icon4"></span>
                <div class="nav-fore1"><a href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/?temp=wap">手机蚂蚁</a></div>
            </li>
            <li class="nav">
                <span class="icon7"></span>
                <div class="nav-fore1">400-010-1977</div>
            </li>
        </ul>
        <ul class="fn-right">
            <li class="nav<?php if ($_COOKIE['USER']): ?> drop-down<?php endif; ?> user">
                <script src="<?php echo $this->_tpl_vars['config']['web_url']; ?>
/login_statu.php?m=index&p=pay"></script>
            </li>
            <?php if ($this->_tpl_vars['current'] != 'index'): ?>
            <li class="nav">
                <div class="nav-fore1">
                    <a href="<?php echo $this->_tpl_vars['config']['web_url']; ?>
"><?php echo $this->_tpl_vars['config']['company']; ?>
首页</a>
                </div>
            </li>
            <?php endif; ?>
            <li class="nav drop-down">
                <div class="nav-fore1">
                    <a href="<?php echo $this->_tpl_vars['config']['web_url']; ?>
/main.php?cg_u_type=1">我的商城</a>
                    <i><em></em></i>
                </div>
                <div class="nav-fore2">
                    <ul>
                        <li><a href="<?php echo $this->_tpl_vars['config']['web_url']; ?>
/main.php?m=product&s=admin_buyorder&cg_u_type=1">已买到的商品</a></li>
                        <li><a href="<?php echo $this->_tpl_vars['config']['web_url']; ?>
/main.php?m=product&s=admin_footprint&cg_u_type=1">我的足迹</a></li>
                        <li><a href="<?php echo $this->_tpl_vars['config']['pay_url']; ?>
"><?php echo $this->_tpl_vars['config']['pay_name']; ?>
</a></li>
                    </ul>
                </div>
            </li>
            <li class="site-nav-pipe">|</li>
            <li class="nav drop-down">
                <div class="nav-fore1">
                    <?php if ($this->_tpl_vars['cominfo']['shop_type'] == 1): ?>
                    <a href="<?php echo $this->_tpl_vars['config']['web_url']; ?>
/main.php?m=shop&s=admin_step&shop_type=2&cg_u_type=2">卖家中心</a>
                    <?php else: ?>
                    <a href="<?php echo $this->_tpl_vars['config']['web_url']; ?>
/main.php?cg_u_type=2">卖家中心</a>
                    <?php endif; ?>
                    <i><em></em></i>
                </div>
                <div class="nav-fore2">
                    <ul>
                        <li><a href="<?php echo $this->_tpl_vars['config']['web_url']; ?>
/main.php?m=shop&s=admin_step&cg_u_type=2">免费开店</a></li>
                        <li><a href="<?php echo $this->_tpl_vars['config']['web_url']; ?>
/main.php?m=product&s=admin_sellorder&cg_u_type=2">已卖出的商品</a></li>
                        <li><a href="<?php echo $this->_tpl_vars['config']['web_url']; ?>
/main.php?m=product&s=admin_product_list&cg_u_type=2">出售中的商品</a></li>
                    </ul>
                </div>
            </li>
            <li class="nav collect drop-down">
                <div class="nav-fore1">
                    <a href="<?php echo $this->_tpl_vars['config']['web_url']; ?>
/main.php?m=sns&s=admin_share_product&cg_u_type=1">
                    <span>收藏夹</span>
                    </a>
                    <i><em></em></i>
                </div>
                <div class="nav-fore2">
                    <ul>
                        <li><a href="<?php echo $this->_tpl_vars['config']['web_url']; ?>
/main.php?m=sns&s=admin_share_product&cg_u_type=1">收藏的商品</a></li>
                        <li><a href="<?php echo $this->_tpl_vars['config']['web_url']; ?>
/main.php?m=sns&s=admin_share_shop&cg_u_type=1">收藏的店铺</a></li>
                    </ul>
                </div>
            </li>
        </ul>
    </div>
</div>
<script type="text/javascript">
$('.drop-down').hover(function(){
    $(this).addClass("hover");
},function(){
    $(this).removeClass("hover");
});
</script>
	<div class="w fn-clear">
		<div class="top-b fn-clear">
        	<h2><a href="index.php"><img height="40" src="<?php if ($this->_tpl_vars['config']['logo']): ?><?php echo $this->_tpl_vars['config']['logo']; ?>
<?php else: ?><?php echo $this->_tpl_vars['config']['web_url']; ?>
/image/default/Logo.png<?php endif; ?>" /></a></h2>
              	<ul class="nav">
            	<li <?php if (! $this->_tpl_vars['current']): ?>class="current"<?php endif; ?>>
                	<a href="<?php echo $this->_tpl_vars['config']['web_url']; ?>
/index.php">我的<?php echo $this->_tpl_vars['config']['company']; ?>
</a>
                </li>
            	<li <?php if ($this->_tpl_vars['current'] == 'record'): ?>class="current"<?php endif; ?>>
                	<a href="<?php echo $this->_tpl_vars['config']['web_url']; ?>
/?m=payment&s=record">交易记录</a>
                </li>
            </ul>
        </div>
    </div>
</div>