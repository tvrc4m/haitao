<?php /* Smarty version 2.6.20, created on 2016-03-29 17:05:14
         compiled from index.htm */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "header.htm", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<header>
    <div class="nav-w">
        <section class="nav-s iconfont"><a onclick="javascript:history.back(-1)"><nav>&#xe60d</nav></a></section>
        <section class="nav-c"><span><?php echo $this->_tpl_vars['config']['company']; ?>
</span></section>
        <section class="nav-e"><?php if ($_GET['m']): ?><a href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
"><nav style="color: #fff">首页</nav></a><?php else: ?><a href="<?php echo $this->_tpl_vars['config']['web_url']; ?>
/main.php?cg_u_type=1"><nav style="color: #fff">买家中心</nav></a><?php endif; ?></section>
    </div>
</header>
<section class="banner">
	<div class="user cn-clear">
    	<div class="img"><img height="72" src="templates/default/image/avatar.png" /></div>
        <div class="img-cover"></div>
        <div class="info">
        	<div class="user_info">
            <p>个人账户：</p>
            <p><?php echo $this->_tpl_vars['de']['email']; ?>

                <a href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/?m=payment&s=settings"><span class="iconfont edit_icon" style="color: #0579C6">&#xe624;</span></a>
                <a href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/?m=payment&s=setpass"><span class="iconfont edit_icon">&#xe625;</span></a>
            </p>
            </div>
            <div class="user_account"><em><?php echo $this->_tpl_vars['de']['cash']; ?>
</em>元</div>
        </div>
    </div>
</section>
<section class="container">
	<div class="fn-right"><?php echo $this->_tpl_vars['output']; ?>
</div>
</section>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "footer.htm", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>