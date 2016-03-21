<?php /* Smarty version 2.6.20, created on 2016-03-19 18:15:50
         compiled from product_list_li_2.htm */ ?>
<!-- <?php $_from = $this->_tpl_vars['pro']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['num'] => $this->_tpl_vars['list']):
?>
<li class="fore<?php echo $this->_tpl_vars['num']+1; ?>
">
<div class="p-img">
    <a target="_blank" href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/?m=product&s=detail&id=<?php echo $this->_tpl_vars['list']['id']; ?>
">
        <img src='<?php echo $this->_tpl_vars['list']['pic']; ?>
_220X220.jpg' />
    </a>
</div>
<div class="p-name"><a target="_blank" href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/?m=product&s=detail&id=<?php echo $this->_tpl_vars['list']['id']; ?>
"><?php echo $this->_tpl_vars['list']['pname']; ?>
</a></div>
</li>
<?php endforeach; endif; unset($_from); ?> -->

<?php $_from = $this->_tpl_vars['pro']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['num'] => $this->_tpl_vars['list']):
?>
<li>
    <a href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/?m=product&s=detail&id=<?php echo $this->_tpl_vars['list']['id']; ?>
" class="goods_img"><img src="../../../uploadfile/adv/2016/g_img.jpg" alt=""></a>
    <a href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/?m=product&s=detail&id=<?php echo $this->_tpl_vars['list']['id']; ?>
" title="" class="goods_text"><?php echo $this->_tpl_vars['list']['pname']; ?>
</a>
    <p><var>￥180</var><s>￥235</s></p>
</li>
<?php endforeach; endif; unset($_from); ?>