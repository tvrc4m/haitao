<?php /* Smarty version 2.6.20, created on 2016-07-19 16:12:57
         compiled from header.htm */ ?>
<!DOCTYPE>
<html>
<head>
<title>我的<?php echo $this->_tpl_vars['config']['company']; ?>
 － <?php echo $this->_tpl_vars['config']['company']; ?>
</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<script type="text/javascript" src="script/jquery-1.4.4.min.js"></script>
<link href="templates/default/css/page.css" rel="stylesheet" type="text/css" />
</head>
<body>
 <!--header start-->
  <div class="header">
    <!--top start-->
    <div class="top">
      <div class="w clear">
        <ul class="fl clear">
          <li><a href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/?temp=wap" title="手机蚂蚁">手机蚂蚁</a></li>
          <li><div>400-010-1977</div></li>
        </ul>
        <ul class="fr clear">
          <script src="<?php echo $this->_tpl_vars['config']['web_url']; ?>
/login_statu.php?m=index&p=pay"></script>
          <li class="drop-down">
            <a href="<?php echo $this->_tpl_vars['config']['web_url']; ?>
/main.php?cg_u_type=1">我的商城</a>
            <div>
              <a href="<?php echo $this->_tpl_vars['config']['web_url']; ?>
/main.php?m=product&s=admin_buyorder&cg_u_type=1">已买到的商品</a>
              <a href="<?php echo $this->_tpl_vars['config']['web_url']; ?>
/main.php?cg_u_type=2">我的足迹</a>
              <a href="<?php echo $this->_tpl_vars['config']['pay_url']; ?>
">蚂蚁钱包</a>
            </div>
          </li>
          <li class="drop-down">
            <?php if ($this->_tpl_vars['cominfo']['shop_type'] == 1): ?>
            <a href="<?php echo $this->_tpl_vars['config']['web_url']; ?>
/main.php?m=shop&s=admin_step&shop_type=2&cg_u_type=2">卖家中心</a>
            <?php else: ?>
            <a href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/main.php?cg_u_type=2">卖家中心</a>
            <?php endif; ?>
            <div>
              <a href="<?php echo $this->_tpl_vars['config']['web_url']; ?>
/main.php?m=shop&s=admin_step&cg_u_type=2">免费开店</a>
              <a href="<?php echo $this->_tpl_vars['config']['web_url']; ?>
/main.php?m=product&s=admin_sellorder&cg_u_type=2">已卖出的商品</a>
              <a href="<?php echo $this->_tpl_vars['config']['web_url']; ?>
/main.php?m=product&s=admin_product_list&cg_u_type=2">出售中的商品</a>
            </div>
          </li>
          <li class="drop-down">
            <a href="<?php echo $this->_tpl_vars['config']['web_url']; ?>
/main.php?m=sns&s=admin_share_product&cg_u_type=1">收藏夹</a>
            <div>
              <a href="<?php echo $this->_tpl_vars['config']['web_url']; ?>
/main.php?m=sns&s=admin_share_product&cg_u_type=1">收藏商品</a>
              <a href="<?php echo $this->_tpl_vars['config']['web_url']; ?>
/main.php?m=sns&s=admin_share_shop&cg_u_type=1">收藏店铺</a>
            </div>
          </li>
        </ul>
      </div>
    </div>
    <!--top end-->
    <div class="nav"> 
        <a href="<?php echo $this->_tpl_vars['config']['web_url']; ?>
" class="icon-logo"></a>
        <ul>
            <li <?php if (! $this->_tpl_vars['current']): ?>class="current"<?php endif; ?>>
                <a href="<?php echo $this->_tpl_vars['config']['web_url']; ?>
/pay/index.php">我的<?php echo $this->_tpl_vars['config']['company']; ?>
</a>
            </li>
            <li <?php if ($this->_tpl_vars['current'] == 'record'): ?>class="current"<?php endif; ?>>
                <a href="<?php echo $this->_tpl_vars['config']['web_url']; ?>
/pay/?m=payment&s=record">交易记录</a>
            </li>
        </ul>
    </div>
</div>