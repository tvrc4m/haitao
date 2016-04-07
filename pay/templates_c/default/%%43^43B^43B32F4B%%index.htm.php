<?php /* Smarty version 2.6.20, created on 2016-03-25 09:49:53
         compiled from index.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'truncate', 'index.htm', 55, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "header.htm", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<div class="banner w">
	<div class="user">
    	<div class="img"><img height="72" src="<?php if ($this->_tpl_vars['de']['logo']): ?><?php echo $this->_tpl_vars['de']['logo']; ?>
<?php else: ?>templates/default/image/avatar.png<?php endif; ?>"/></div>
        <div class="img-cover"></div>
        <div class="info">
        	<div class="user_info">
            <p>个人账户：</p>
            <p>
                <span><?php echo $this->_tpl_vars['de']['email']; ?>
</span>
                <a <?php if ($this->_tpl_vars['de']['identity_verify'] == 'true'): ?>class="current"<?php endif; ?> href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
?act=edit&op=name"></a>
            </p>
            </div>
            <div class="user_account">账户余额：<em><?php echo $this->_tpl_vars['de']['cash']; ?>
</em>元</div>
        </div>
    </div>
    <div class="greeting">
    	<span>您好，</span>
        <p>每一天，努力让梦想更近一些~</p>
    </div>
</div>
<div class="container w fn-clear">
	<div class="fn-left">
        <div class="sidenav">
            <div class="m fore1">
            	<div class="mt">资金管理</div>
            	<div class="mc fn-clear">
                	<a href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/?m=payment&s=recharge">充值</a>
                    <a href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/?m=payment&s=withdraw">提现</a>
                    <a href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/?m=payment&s=transfer">转账</a>
                </div>
            </div>
            <div class="m fore2">
            	<div class="mt">交易查询</div>
            	<div class="mc fn-clear">
                	<a href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/?m=payment&s=record">交易明细</a>
                    <a href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/?m=payment&s=record&mold=1">充值记录</a>
                    <a href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/?m=payment&s=record&mold=2">提现记录</a>
                </div>
            </div>
            <div class="m fore3">
            	<div class="mt">账户管理</div>
            	<div class="mc fn-clear">
                	<a href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/?m=payment&s=settings">账户信息</a>
                	<a href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/?m=payment&s=setpass">支付密码</a>
                    <a href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/?act=edit&op=name">实名认证</a>
                </div>
            </div>
        </div>
        <div class="m1">
            <div class="mt"><a target="_blank" href="help.php">常见问题</a></div>
            <div class="mc">
                <ul>
                	<?php $_from = $this->_tpl_vars['help']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['list']):
?>
                    <li><a target="_blank" href="help.php?id=<?php echo $this->_tpl_vars['list']['con_group']; ?>
&type=<?php echo $this->_tpl_vars['list']['con_id']; ?>
"><?php echo ((is_array($_tmp=$this->_tpl_vars['list']['con_title'])) ? $this->_run_mod_handler('truncate', true, $_tmp, 20, "") : smarty_modifier_truncate($_tmp, 20, "")); ?>
</a></li>
                    <?php endforeach; endif; unset($_from); ?>
                </ul>
            </div>
        </div>
    </div>
	<div class="fn-right"><?php echo $this->_tpl_vars['output']; ?>
</div>
</div>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "footer.htm", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>