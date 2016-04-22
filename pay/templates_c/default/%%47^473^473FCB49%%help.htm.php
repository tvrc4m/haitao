<?php /* Smarty version 2.6.20, created on 2016-04-22 15:26:23
         compiled from help.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'truncate', 'help.htm', 24, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "header.htm", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<div class="main">
	<div class="w fn-clear">
        <div class="fn-left">
            <ul class="ul">
                <?php $_from = $this->_tpl_vars['con_groups']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['list']):
?>
                <li><a href="help.php?id=<?php echo $this->_tpl_vars['list']['id']; ?>
"><?php echo $this->_tpl_vars['list']['title']; ?>
</a></li>
                <?php endforeach; endif; unset($_from); ?>
            </ul>
            <div class="m1">
                <div class="mt">联系客服</div>
                <div class="mc">
					<p>客服服务电话
                    <b><?php echo $this->_tpl_vars['config']['owntel']; ?>
</b>
                    <p>客服邮箱
                    <b class="email"><?php echo $this->_tpl_vars['config']['email']; ?>
</b>
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
        <div class="fn-right">
        	<h3>
            	<a href="help.php">帮助中心</a>
                <?php $_from = $this->_tpl_vars['con_groups']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['list']):
?>
                <?php if ($this->_tpl_vars['list']['id'] == $_GET['id']): ?>
                <a href="help.php?id=<?php echo $this->_tpl_vars['list']['id']; ?>
"><?php echo $this->_tpl_vars['list']['title']; ?>
</a>
                <?php endif; ?>
                <?php endforeach; endif; unset($_from); ?>
                <?php if ($_GET['type'] && $this->_tpl_vars['de']['con_title']): ?>
                 > &nbsp;<?php echo $this->_tpl_vars['de']['con_title']; ?>

                <?php endif; ?>
            </h3>
            <?php if ($_GET['type']): ?>
            <div class="con"><?php echo $this->_tpl_vars['de']['con_desc']; ?>
</div>
            <?php else: ?>
            <ul>
            	<?php $_from = $this->_tpl_vars['de']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['list']):
?>
                <li><i>?</i><a href="help.php?id=<?php echo $this->_tpl_vars['list']['con_group']; ?>
&type=<?php echo $this->_tpl_vars['list']['con_id']; ?>
"><?php echo $this->_tpl_vars['list']['con_title']; ?>
</a></li>
                <?php endforeach; endif; unset($_from); ?>
            </ul>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "footer.htm", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>