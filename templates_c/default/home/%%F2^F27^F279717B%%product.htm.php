<?php /* Smarty version 2.6.20, created on 2016-03-18 13:41:05
         compiled from product.htm */ ?>
<script>
function collect_goods(id){
	
	var url = '<?php echo $this->_tpl_vars['config']['weburl']; ?>
/module/sns/ajax_update.php';
	var uname='<?php echo $_COOKIE['USER']; ?>
';
	if(uname=='')
	{
		alert('<?php echo $this->_tpl_vars['lang']['no_logo']; ?>
');
		window.location.href='<?php echo $this->_tpl_vars['config']['weburl']; ?>
/login.php?forward=shop.php?uid=<?php echo $_GET['uid']; ?>
';
		return false;
	}
	var pars = 'pid='+id+'&uname='+uname;
	$.post(url, pars,showResponse);
	function showResponse(originalRequest)
	{
		if(originalRequest>1)
			alert('<?php echo $this->_tpl_vars['lang']['fav_ok']; ?>
');
		else if (originalRequest>0)
			alert('<?php echo $this->_tpl_vars['lang']['fav_isbing']; ?>
');
		else
			alert('<?php echo $this->_tpl_vars['lang']['error']; ?>
');
	}
	
}
</script>
<div class="main-widget">
   <div id="img" class="clearfix">
        <?php $_from = $this->_tpl_vars['sharegoods']['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['name'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['name']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['list']):
        $this->_foreach['name']['iteration']++;
?>
        <div class="drop">
            <dl class="drop-inner">
                <dt class="drop-img">
                <a title="<?php echo $this->_tpl_vars['list']['pname']; ?>
" href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/?m=product&s=detail&id=<?php echo $this->_tpl_vars['list']['pid']; ?>
" target="_blank"><img src="<?php if ($this->_tpl_vars['list']['image']): ?><?php echo $this->_tpl_vars['list']['image']; ?>
<?php else: ?>image/default/nopic.gif<?php endif; ?>" /></a>
                </dt>
                <dd class="drop-cmt"><?php if ($this->_tpl_vars['list']['content']): ?><?php echo $this->_tpl_vars['list']['content']; ?>
<?php else: ?>分享了商品<?php endif; ?></dd>
                <dd class="drop-ops">
                    <span class="collect">
                        <a href="javascript:collect_goods('<?php echo $this->_tpl_vars['list']['pid']; ?>
');"><i></i>收藏</a>
                        <strong> <?php echo $this->_tpl_vars['list']['collectnum']; ?>
 </strong>
                    </span>
                </dd>
            </dl>
        </div>
        <?php endforeach; endif; unset($_from); ?>
    </div>
</div>
<script src="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/script/jquery.masonry.js" type="text/javascript"></script> 
<script type="text/javascript">
$(function(){
	$("#img").imagesLoaded( function(){
		$("#img").masonry({
			itemSelector : '.drop'
		});
	});
});
</script> 