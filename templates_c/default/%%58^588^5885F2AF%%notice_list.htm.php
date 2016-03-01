<?php /* Smarty version 2.6.20, created on 2016-03-01 11:00:01
         compiled from notice_list.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'strip_tags', 'notice_list.htm', 3, false),array('modifier', 'truncate', 'notice_list.htm', 3, false),)), $this); ?>
<?php $_from = $this->_tpl_vars['notice']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['num'] => $this->_tpl_vars['list']):
?>
<?php if ($this->_tpl_vars['num'] == 0): ?>
<div><?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['list']['content'])) ? $this->_run_mod_handler('strip_tags', true, $_tmp) : smarty_modifier_strip_tags($_tmp)))) ? $this->_run_mod_handler('truncate', true, $_tmp, 40) : smarty_modifier_truncate($_tmp, 40)); ?>
<a href="<?php if ($this->_tpl_vars['list']['url']): ?><?php echo $this->_tpl_vars['list']['url']; ?>
<?php else: ?><?php echo $this->_tpl_vars['config']['weburl']; ?>
/?m=announcement&s=detail&id=<?php echo $this->_tpl_vars['list']['id']; ?>
<?php endif; ?>" target="_blank" title="<?php echo $this->_tpl_vars['list']['title']; ?>
" >查看详情»</a></div> 
<?php else: ?>
<p><a href="<?php if ($this->_tpl_vars['list']['url']): ?><?php echo $this->_tpl_vars['list']['url']; ?>
<?php else: ?><?php echo $this->_tpl_vars['config']['weburl']; ?>
/?m=announcement&s=detail&id=<?php echo $this->_tpl_vars['list']['id']; ?>
<?php endif; ?>" target="_blank" title="<?php echo $this->_tpl_vars['list']['title']; ?>
" ><?php echo ((is_array($_tmp=$this->_tpl_vars['list']['title'])) ? $this->_run_mod_handler('truncate', true, $_tmp, 26, '') : smarty_modifier_truncate($_tmp, 26, '')); ?>
</a></p>
<?php endif; ?>
<?php endforeach; endif; unset($_from); ?>