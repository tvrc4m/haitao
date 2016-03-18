<?php /* Smarty version 2.6.20, created on 2016-03-17 19:57:28
         compiled from product_list_li.htm */ ?>
<?php $_from = $this->_tpl_vars['pro']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['num'] => $this->_tpl_vars['hotli']):
?>
<li class="fore<?php echo $this->_tpl_vars['num']+1; ?>
">
<div class="p-img ld">
    <a target="_blank" href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/?m=product&s=detail&id=<?php echo $this->_tpl_vars['hotli']['id']; ?>
">
        <img width="100" src='<?php echo $this->_tpl_vars['hotli']['pic']; ?>
_220X220.jpg' />
    </a>
</div>
<div class="p-name"><a target="_blank" href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/?m=product&s=detail&id=<?php echo $this->_tpl_vars['hotli']['id']; ?>
"><?php echo $this->_tpl_vars['hotli']['pname']; ?>
</a></div>
<div class="p-price"><strong><?php echo $this->_tpl_vars['config']['money']; ?>
<?php echo $this->_tpl_vars['hotli']['price']; ?>
</strong></div>
</li>
<?php endforeach; endif; unset($_from); ?>