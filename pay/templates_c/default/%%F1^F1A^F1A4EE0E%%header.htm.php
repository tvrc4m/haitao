<?php /* Smarty version 2.6.20, created on 2016-04-22 12:01:01
         compiled from header.htm */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>我的<?php echo $this->_tpl_vars['config']['company']; ?>
 － <?php echo $this->_tpl_vars['config']['company']; ?>
</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<script type="text/javascript" src="script/jquery-1.4.4.min.js"></script>
<link href="templates/default/css/page.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div class="top">
    <div class="nav">
        <div class="top-a w fn-clear">
            <ul class="fn-left">
                <li>你好, <?php if ($this->_tpl_vars['de']['real_name']): ?><?php echo $this->_tpl_vars['de']['real_name']; ?>
<?php else: ?><?php echo $this->_tpl_vars['de']['pay_email']; ?>
<?php endif; ?></li>
                <li><a href="<?php echo $this->_tpl_vars['config']['web_url']; ?>
/main.php?cg_u_type=1">买家中心</a></li>
            </ul>
            <ul class="fn-right">
                <li><a href="help.php">帮助中心</a></li>
            </ul>
        </div>
    </div>
	<div class="w fn-clear">
		<div class="top-b fn-clear">
        	<h2><a href="index.php"><img height="40" src="<?php if ($this->_tpl_vars['config']['logo']): ?><?php echo $this->_tpl_vars['config']['logo']; ?>
<?php else: ?><?php echo $this->_tpl_vars['config']['web_url']; ?>
/image/default/Logo.png<?php endif; ?>" /></a></h2>
              	<ul class="nav">
            	<li <?php if (! $this->_tpl_vars['current']): ?>class="current"<?php endif; ?>>
                	<a href="index.php">我的<?php echo $this->_tpl_vars['config']['company']; ?>
</a>
                </li>
            	<li <?php if ($this->_tpl_vars['current'] == 'record'): ?>class="current"<?php endif; ?>>
                	<a href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/?m=payment&s=record">交易记录</a>
                </li>
            </ul>
        </div>
    </div>
</div>