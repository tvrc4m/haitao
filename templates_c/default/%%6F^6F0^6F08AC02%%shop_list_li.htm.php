<?php /* Smarty version 2.6.20, created on 2016-03-01 11:02:27
         compiled from shop_list_li.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'number_format', 'shop_list_li.htm', 10, false),)), $this); ?>
<?php $_from = $this->_tpl_vars['shop']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['num'] => $this->_tpl_vars['list']):
?>
	<?php if ($this->_tpl_vars['num'] < 3): ?>
    <dl class="fore1">
    	<dt><b><?php echo $this->_tpl_vars['num']+1; ?>
</b><a target="_blank" href="shop.php?uid=<?php echo $this->_tpl_vars['list']['userid']; ?>
"><?php echo $this->_tpl_vars['list']['company']; ?>
</a><dt>
        <dd class="clearfix">
    		<div class="pic"><a target="_blank" href="shop.php?uid=<?php echo $this->_tpl_vars['list']['userid']; ?>
"><img width="50" height="50" src="<?php echo $this->_tpl_vars['list']['logo']; ?>
" /></a></div>
            <div class="info">
            	<p>店主：<a target="_blank" href="home.php?uid=<?php echo $this->_tpl_vars['list']['userid']; ?>
"><?php echo $this->_tpl_vars['list']['name']; ?>
</a></p>
                <p>信用度：<?php if ($this->_tpl_vars['list']['sellerpointsimg']): ?><img align="absmiddle" src="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/image/points/<?php echo $this->_tpl_vars['list']['sellerpointsimg']; ?>
"><?php else: ?><?php echo $this->_tpl_vars['list']['sellerpoints']; ?>
<?php endif; ?></p>
                <p>好评率：<?php echo ((is_array($_tmp=$this->_tpl_vars['list']['favorablerate'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2) : number_format($_tmp, 2)); ?>
%</p>
            </div>
       </dd>
    </dl>
    <?php else: ?>
    <div class="fore2">
    	<b><?php echo $this->_tpl_vars['num']+1; ?>
</b><a target="_blank" href="shop.php?uid=<?php echo $this->_tpl_vars['list']['userid']; ?>
"><?php echo $this->_tpl_vars['list']['company']; ?>
</a>
    </div>
    <?php endif; ?>
<?php endforeach; endif; unset($_from); ?>