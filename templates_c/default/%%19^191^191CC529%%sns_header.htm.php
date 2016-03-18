<?php /* Smarty version 2.6.20, created on 2016-03-18 09:35:02
         compiled from sns_header.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'truncate', 'sns_header.htm', 19, false),)), $this); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php if ($this->_tpl_vars['title']): ?><?php echo $this->_tpl_vars['title']; ?>
,<?php echo $this->_tpl_vars['config']['company']; ?>
<?php else: ?><?php echo $this->_tpl_vars['config']['title']; ?>
,<?php echo $this->_tpl_vars['config']['company']; ?>
<?php endif; ?></title>
<meta name="description" content="<?php echo $this->_tpl_vars['config']['description']; ?>
" />
<meta name="keywords" content="<?php echo $this->_tpl_vars['config']['keyword']; ?>
" />
<script src="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/script/jquery-1.4.4.min.js" type="text/javascript"></script>
<link type="text/css" rel="stylesheet" href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/module/sns/templates/sns.css">
</head>
<body>
<div class="shortcut">
    <div class="w clearfix">
        <ul class="fl">
            <li><a hidefocus="true" title="<?php echo $this->_tpl_vars['config']['company']; ?>
" href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
"><img height="31" src="<?php if ($this->_tpl_vars['config']['logo']): ?><?php echo $this->_tpl_vars['config']['logo']; ?>
<?php else: ?><?php echo $this->_tpl_vars['config']['weburl']; ?>
/image/logo.gif<?php endif; ?>" /></a></li>
        </ul>
        <ul class="fl nav">
        	<?php $_from = $this->_tpl_vars['menus']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['nav'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['nav']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['num'] => $this->_tpl_vars['list']):
        $this->_foreach['nav']['iteration']++;
?>
                <li><a href="<?php if (((is_array($_tmp=$this->_tpl_vars['list']['link_addr'])) ? $this->_run_mod_handler('truncate', true, $_tmp, 4, '') : smarty_modifier_truncate($_tmp, 4, '')) == 'http'): ?><?php echo $this->_tpl_vars['list']['link_addr']; ?>
<?php else: ?><?php echo $this->_tpl_vars['config']['weburl']; ?>
/<?php echo $this->_tpl_vars['list']['link_addr']; ?>
<?php endif; ?>"><?php echo $this->_tpl_vars['list']['menu_name']; ?>
</a></li>
            <?php endforeach; endif; unset($_from); ?>
        </ul>
        <ul class="fr">
        <?php if ($this->_tpl_vars['buid'] > 0): ?>
        <li><a href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/main.php?cg_u_type=1">欢迎您 <?php echo $_COOKIE['USER']; ?>
</a></li>
        <?php else: ?>
        	<li><a href="login.php">登录</a></li>
            <li><a href="<?php echo $this->_tpl_vars['config']['regname']; ?>
">注册</a></li>
        <?php endif; ?>
        </ul>
        <ul class="pr">
            <li>
            <form method="get" action="<?php echo $this->_tpl_vars['config']['weburl']; ?>
">
                <input type="hidden" name="m" value="sns" />
            	<input type="text" class="txt" name="key" placeholder="搜索你喜欢的" value="<?php echo $_GET['key']; ?>
"  />
                <input type="submit" class="submit" value="" />
            </form>
            </li>
        </ul>
    </div>
</div>