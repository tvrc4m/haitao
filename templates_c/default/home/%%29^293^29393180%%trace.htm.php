<?php /* Smarty version 2.6.20, created on 2016-03-18 13:41:06
         compiled from trace.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'trace.htm', 29, false),)), $this); ?>
<div class="main-widget">
	<div class="item-bd pt0">
    	<?php $_from = $this->_tpl_vars['blog']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['num'] => $this->_tpl_vars['list']):
?>
        <div class="sns-item" <?php if (! $this->_tpl_vars['num']): ?>style="padding-top:5px"<?php endif; ?> >
            <div class="sns-wrap">
           		<p class="sns-title"><a target="_blank" href="home.php?uid=<?php echo $this->_tpl_vars['list']['member_id']; ?>
"><?php echo $this->_tpl_vars['list']['member_name']; ?>
</a></p>
                <div class="sns-text"><span><?php echo $this->_tpl_vars['list']['title']; ?>
</span></div>
                <?php if ($this->_tpl_vars['list']['original_id']): ?>
                <div class="quote-wrap">
                     <?php if ($this->_tpl_vars['list']['original_status'] == 1): ?>
                     原文已删除
                     <?php else: ?>
                     <p class="sns-title"><a target="_blank" href="home.php?uid=<?php echo $this->_tpl_vars['list']['ouid']; ?>
"><?php echo $this->_tpl_vars['list']['ouser']; ?>
</a></p>
                    <div class="sns-text"><span><?php echo $this->_tpl_vars['list']['otitle']; ?>
</span></div>
                    <?php if ($this->_tpl_vars['list']['oimg']): ?>
                    <div class="sns-img clearfix">
                        <ul>
                            <?php $_from = $this->_tpl_vars['list']['opic']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['p']):
?>
                                <?php if ($this->_tpl_vars['list']['otype'] == 2): ?>
                                    <li><img class="small" src="<?php echo $this->_tpl_vars['p']; ?>
_120X120.jpg"></li>
                                <?php else: ?>
                                    <li><img src="<?php echo $this->_tpl_vars['p']; ?>
"></li>
                                <?php endif; ?>
                            <?php endforeach; endif; unset($_from); ?>
                        </ul>
                    </div>
                	<?php endif; ?>
                    <div class="sns-extra">
                    	<span class="sns-time"><?php echo ((is_array($_tmp=$this->_tpl_vars['list']['ocreate_time'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%m-%d&nbsp;%H:%M") : smarty_modifier_date_format($_tmp, "%m-%d&nbsp;%H:%M")); ?>
</span>
                    </div>
                    <?php endif; ?>
                </div>
                <?php else: ?>
                	<?php if ($this->_tpl_vars['list']['img']): ?>
                    <div class="sns-img clearfix">
                        <ul>
                            <?php $_from = $this->_tpl_vars['list']['pic']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['p']):
?>
                                <?php if ($this->_tpl_vars['list']['type'] == 2): ?>
                                    <li><img class="small" src="<?php echo $this->_tpl_vars['p']; ?>
_120X120.jpg"></li>
                                <?php else: ?>
                                    <li><img src="<?php echo $this->_tpl_vars['p']; ?>
"></li>
                                <?php endif; ?>
                            <?php endforeach; endif; unset($_from); ?>
                        </ul>
                    </div>
                	<?php endif; ?>
                    <?php if ($this->_tpl_vars['list']['comment']): ?>
                    <div class="commnet">
                    <?php $_from = $this->_tpl_vars['list']['comment']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['slist']):
?>
                    	<div class="commnet_list">
                            <dl>
                                <dt><a target="_blank" href="home.php?uid=<?php echo $this->_tpl_vars['slist']['member_id']; ?>
"><?php echo $this->_tpl_vars['slist']['member_name']; ?>
</a><?php echo $this->_tpl_vars['slist']['content']; ?>
</dt><dd><?php echo ((is_array($_tmp=$this->_tpl_vars['slist']['addtime'])) ? $this->_run_mod_handler('date_format', true, $_tmp) : smarty_modifier_date_format($_tmp)); ?>
</dd>
                            </dl>
                        </div>
                    <?php endforeach; endif; unset($_from); ?>
                    </div>
                    <?php endif; ?>
                <?php endif; ?>
                <div class="sns-extra">
                    <span class="sns-time"><?php echo ((is_array($_tmp=$this->_tpl_vars['list']['create_time'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%m-%d&nbsp;%H:%M") : smarty_modifier_date_format($_tmp, "%m-%d&nbsp;%H:%M")); ?>
</span>
                    <span class="sns-action">
                        <span>
                        <a data-param="{&quot;bid&quot;:&quot;<?php echo $this->_tpl_vars['list']['id']; ?>
&quot;}" genre="sns_forward" href="javascript:void(0);">转发</a>
                        <a data-param="{&quot;bid&quot;:&quot;<?php echo $this->_tpl_vars['list']['id']; ?>
&quot;}" genre="sns_comment" href="javascript:void(0);">评论</a>
                        </span>
                    </span>
                </div>
			</div>
        </div>
        <?php endforeach; endif; unset($_from); ?>
    </div>
</div>
<script type="text/javascript" src="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/script/dialog/dialog.js" id="dialog_js"></script>
<script>
$("[genre='sns_forward']").live('click',function(){
	var data = $(this).attr('data-param');
	eval("data = "+data);
	ajax_form("forward_form", '转发', '<?php echo $this->_tpl_vars['config']['weburl']; ?>
/main.php?m=sns&s=sns&op=forward&bid='+data.bid, 500);
	return false;
});
$("[genre='sns_comment']").live('click',function(){
	var data = $(this).attr('data-param');
	eval("data = "+data);
	ajax_form("comment_form", '评论', '<?php echo $this->_tpl_vars['config']['weburl']; ?>
/main.php?m=sns&s=sns&op=comment&bid='+data.bid, 500);
	return false;
});
$('.small').live('click',function(){
	$(this).addClass('large').removeClass('small');	
	var url=$(this).attr("src")
	url = url.substr(0,url.lastIndexOf('_'));
	$(this).attr("src",url);
});
$('.large').live('click',function(){
	$(this).addClass('small').removeClass('large');	
	var url=$(this).attr("src")
	$(this).attr("src",url+"_120X120.jpg");
});
</script>