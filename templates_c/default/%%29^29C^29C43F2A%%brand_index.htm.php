<?php /* Smarty version 2.6.20, created on 2016-03-01 11:02:26
         compiled from brand_index.htm */ ?>
<link href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/module/brand/templates/brand.css" rel="stylesheet" type="text/css" />
<div class="w">
    <div class="detailnav">
        <strong><a href="#">首页</a></strong>
        <span> >  全部品牌</span>
    </div>
</div>
<div class="w w1">
    <?php $_from = $this->_tpl_vars['bcat']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['num'] => $this->_tpl_vars['list']):
?>
    	<?php if ($this->_tpl_vars['list']['brand']): ?>
        <div class="item clearfix">
            <div class="left">
            	<b><?php echo $this->_tpl_vars['list']['catname']; ?>
</b>
            </div>
            <div class="right">
            	<?php $_from = $this->_tpl_vars['list']['brand']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['clist']):
?>
                	<li> <a target="_blank" href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/?m=product&s=list&brand=<?php echo $this->_tpl_vars['clist']['name']; ?>
"><img width="130" height="80" src="<?php echo $this->_tpl_vars['clist']['logo']; ?>
" /></a></li>
    			<?php endforeach; endif; unset($_from); ?>
            </div>
        </div>
        <?php endif; ?>
    <?php endforeach; endif; unset($_from); ?>
</div>