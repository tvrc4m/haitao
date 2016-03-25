<?php /* Smarty version 2.6.20, created on 2016-03-25 12:01:25
         compiled from pro_cat_shop_left.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'truncate', 'pro_cat_shop_left.htm', 7, false),)), $this); ?>
<?php $_from = $this->_tpl_vars['cat']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['num'] => $this->_tpl_vars['cList']):
?>
    <?php if ($this->_tpl_vars['num'] < 5): ?>
        <li>
            <label>
                <a target="_blank" href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/?m=product&s=list&id=<?php echo $this->_tpl_vars['cList']['catid']; ?>
">
                    <i class="icon_menu_01"></i>
                    <b class="mid"><?php echo ((is_array($_tmp=$this->_tpl_vars['cList']['cat'])) ? $this->_run_mod_handler('truncate', true, $_tmp, 8, "") : smarty_modifier_truncate($_tmp, 8, "")); ?>

                    </b>
                </a>
            </label>
            <p>
                <?php $_from = $this->_tpl_vars['cList']['scat']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['n'] => $this->_tpl_vars['sublist']):
?>
                    <a href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/?m=product&s=list&id=<?php echo $this->_tpl_vars['sublist']['catid']; ?>
" title=""><?php echo $this->_tpl_vars['sublist']['cat']; ?>
</a>
                <?php endforeach; endif; unset($_from); ?>
            </p>
        </li>
    <?php endif; ?>
<?php endforeach; endif; unset($_from); ?>