<?php /* Smarty version 2.6.20, created on 2016-03-19 19:06:48
         compiled from space_reviews.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'number_format', 'space_reviews.htm', 5, false),)), $this); ?>
<div class="reviews-hd">
	<div class="reviews-hd-fore1 clearfix">
    	<div class="score">
            <span>商品与描述相符</span>
            <strong><?php echo ((is_array($_tmp=$this->_tpl_vars['score']['a'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 1) : number_format($_tmp, 1)); ?>
</strong>
            <span>分</span>
        </div>
    	<div class="links"><a target="_blank" href="shop.php?uid=<?php echo $_GET['uid']; ?>
&action=credit&m=shop"><i></i>店铺评价</a></div>
    </div>
	<div class="reviews-hd-fore2">
    	<div class="filter clearfix">
        	<ul>
            	<li><label><input type="radio" name="reviews-type" <?php if (! $_GET['catid']): ?> checked="checked"<?php endif; ?> value="0" /><span>全部</span></label></li>
            	<li><label><input type="radio" name="reviews-type" <?php if ($_GET['catid'] == 3): ?> checked="checked"<?php endif; ?>value="3" /><span>好评</span></label></li>
            	<li><label><input type="radio" name="reviews-type" <?php if ($_GET['catid'] == 2): ?> checked="checked"<?php endif; ?>value="2" /><span>中评</span></label></li>
            	<li><label><input type="radio" name="reviews-type" <?php if ($_GET['catid'] == 1): ?> checked="checked"<?php endif; ?>value="1" /><span>差评</span></label></li>
			</ul>
        </div>
    </div>
</div>
<div class="reviews-bd clearfix">
<ul>
<?php $_from = $this->_tpl_vars['re']['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['list']):
?>
    <li class="clearfix">
        <div class="buyer">
            <div class="avatar">
                <span>
                    <img width="40" height="40" src="<?php echo $this->_tpl_vars['list']['logo']; ?>
"><Br />
                    <span><?php echo $this->_tpl_vars['list']['user']; ?>
</span>
                </span><br />
                <img src="image/points/<?php echo $this->_tpl_vars['list']['buyerpoints']; ?>
" />
            </div>
        </div>
        <dl>
            <dt><?php echo $this->_tpl_vars['list']['con']; ?>
</dt>
            <dd><?php echo $this->_tpl_vars['list']['uptime']; ?>
</dd>
        </dl>
    </li>
<?php endforeach; else: ?>
	<li class="no-result">没有找到结果</li>
<?php endif; unset($_from); ?>
</ul>
<div class="pages"><?php echo $this->_tpl_vars['re']['page']; ?>
</div>
</div>
<script type="text/javascript">
$(".pages a").click(function(){
	$("body,html").animate({scrollTop:$(".inner-wrap").offset().top});
	$('.reviews-bd').html('<div class="loading"><p>正在努力加载中...</p></div>');
	$('#reviews').load($(this).attr("href"));
	return false;
});
$(".filter input").click(function(){
	$('.reviews-bd').html('<div class="loading"><p>正在努力加载中...</p></div>');
	$('#reviews').load('<?php echo $this->_tpl_vars['config']['weburl']; ?>
/?m=product&s=detail&id=<?php echo $this->_tpl_vars['de']['id']; ?>
&ajax=reviews&catid='+$(this).val());
})
</script>