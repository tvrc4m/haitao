<?php /* Smarty version 2.6.20, created on 2016-03-18 13:41:27
         compiled from space_index.htm */ ?>
<?php if ($this->_tpl_vars['com']['shop_statu'] == 1): ?>
<div class="module_special">
	<h2><?php echo $this->_tpl_vars['lang']['product_showcase']; ?>
</h2>
    <div class="con">
    	<ul class="list">
            <?php $_from = $this->_tpl_vars['rec_pro']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['list']):
?>
            <li>
                <div class="pic"><a target="_blank" title="<?php echo $this->_tpl_vars['list']['pname']; ?>
" href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/?m=product&s=detail&id=<?php echo $this->_tpl_vars['list']['id']; ?>
"><img src="<?php echo $this->_tpl_vars['list']['pic']; ?>
_220X220.jpg" width=220  height=220 alt="<?php echo $this->_tpl_vars['list']['pname']; ?>
" /></a></div>
                <h3><a target="_blank" title="<?php echo $this->_tpl_vars['list']['pname']; ?>
" href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/?m=product&s=detail&id=<?php echo $this->_tpl_vars['list']['id']; ?>
"><?php echo $this->_tpl_vars['list']['pname']; ?>
</a></h3>
                <p><?php echo $this->_tpl_vars['config']['money']; ?>
 <?php echo $this->_tpl_vars['list']['price']; ?>
</p>
            </li>
            <?php endforeach; endif; unset($_from); ?>
        </ul>
    </div>
</div>
<div class="module_special">
	<h2><?php echo $this->_tpl_vars['lang']['new_listing']; ?>
</h2>
    <div class="con">
    	<ul class="list">
            <?php $_from = $this->_tpl_vars['pro']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['list']):
?>
            <li>
                <div class="pic"><a target="_blank" title="<?php echo $this->_tpl_vars['list']['pname']; ?>
" href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/?m=product&s=detail&id=<?php echo $this->_tpl_vars['list']['id']; ?>
"><img src="<?php echo $this->_tpl_vars['list']['pic']; ?>
_220X220.jpg" width=220  height=220 alt="<?php echo $this->_tpl_vars['list']['pname']; ?>
" /></a></div>
                <h3><a target="_blank" title="<?php echo $this->_tpl_vars['list']['pname']; ?>
" href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/?m=product&s=detail&id=<?php echo $this->_tpl_vars['list']['id']; ?>
"><?php echo $this->_tpl_vars['list']['pname']; ?>
</a></h3>
                <p><?php echo $this->_tpl_vars['config']['money']; ?>
 <?php echo $this->_tpl_vars['list']['price']; ?>
</p>
            </li>
            <?php endforeach; endif; unset($_from); ?>
        </ul>
    </div>
</div>
<?php endif; ?>
<?php if ($this->_tpl_vars['dist_pro']): ?>
<div class="module_special">
    <h2><?php echo $this->_tpl_vars['lang']['distribution_list']; ?>
</h2>
    <div class="con">
        <ul class="list">
            <?php $_from = $this->_tpl_vars['dist_pro']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['list']):
?>
            <li>
                <div class="pic"><a target="_blank" title="<?php echo $this->_tpl_vars['list']['pname']; ?>
" href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/?m=product&s=detail&id=<?php echo $this->_tpl_vars['list']['id']; ?>
&shop_id=<?php echo $this->_tpl_vars['com']['shop_id']; ?>
"><img src="<?php echo $this->_tpl_vars['list']['pic']; ?>
_220X220.jpg" width=220  height=220 alt="<?php echo $this->_tpl_vars['list']['pname']; ?>
" /></a></div>
                <h3><a target="_blank" title="<?php echo $this->_tpl_vars['list']['pname']; ?>
" href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/?m=product&s=detail&id=<?php echo $this->_tpl_vars['list']['id']; ?>
&shop_id=<?php echo $this->_tpl_vars['com']['shop_id']; ?>
"><?php echo $this->_tpl_vars['list']['pname']; ?>
</a></h3>
                <p><?php echo $this->_tpl_vars['config']['money']; ?>
 <?php echo $this->_tpl_vars['list']['price']; ?>
</p>
            </li>
            <?php endforeach; endif; unset($_from); ?>
        </ul>
    </div>
</div>
<?php endif; ?>