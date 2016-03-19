<?php /* Smarty version 2.6.20, created on 2016-03-18 13:18:18
         compiled from main.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'main.htm', 141, false),)), $this); ?>
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
<div class="head">
    <div class="info clearfix">
        <div class="info-left">
            <div class="basic-info">
                <h2 class="name"><div class="nick"><?php echo $this->_tpl_vars['member']['name']; ?>
</div></h2>
                <span class="realy-info">
                    <span class="credit">买家信用</span>
                    <img class="points" align="absmiddle" title="<?php echo $this->_tpl_vars['member']['buyerpoints']; ?>
个买家信用积分" src="image/points/<?php echo $this->_tpl_vars['member']['buyerpointsimg']; ?>
">
                </span>
                <span class="meta">
                    <span class="sex<?php if ($this->_tpl_vars['member']['sex'] == 2): ?> female<?php endif; ?>"><?php if ($this->_tpl_vars['member']['sex'] == 2): ?>女<?php else: ?>男<?php endif; ?></span>
                    <!-- <span><?php echo $this->_tpl_vars['member']['area']; ?>
</span> -->
                    <span><a href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/shop.php?uid=<?php echo $_GET['uid']; ?>
">逛TA商铺</a></span>
                </span>
                
            </div>
            <div class="user-avatar"><img width="160" height="160" src="<?php if ($this->_tpl_vars['member']['logo']): ?><?php echo $this->_tpl_vars['member']['logo']; ?>
<?php else: ?>image/default/avatar.png<?php endif; ?>"></div>
        </div>
        <div class="info-right">
            <div class="attention-box">
                <div class="attention clearfix">
                    <ul>
                        <li><b class="large"><?php echo $this->_tpl_vars['count']['f']; ?>
</b><span>粉丝</span></li>
                        <li><b class="large"><?php echo $this->_tpl_vars['count']['g']; ?>
</b><span>关注</span></li>
                        <li><b class="large"><?php echo $this->_tpl_vars['count']['v']; ?>
</b><span>访问</span></li><li class="clear"></li>
                    </ul>
                </div>
            </div>
            <?php if ($_GET['uid'] != $this->_tpl_vars['userid']): ?>
                <div class="follow-widget">
                    <?php if ($this->_tpl_vars['friend']): ?>
                        <span class="<?php if ($this->_tpl_vars['fan']): ?>all_gz<?php else: ?>have_gz<?php endif; ?>">
                        <b style="margin-left:25px;">已关注</b> &nbsp;&nbsp;
                        <a href="main.php?m=message&s=admin_message_sed&uid=<?php echo $_GET['uid']; ?>
">发私信</a></span>
                    <?php else: ?>
                        <a genre="followbtn" data-param="{'mid':'<?php echo $_GET['uid']; ?>
'}" href="javascript:void(0)"></a>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
    <div class="clear"></div>
    <div class="nav">
        <ul class="clearfix">
            <li class="<?php if ($_GET['act'] == ''): ?>current <?php endif; ?>first">
                <a class="front" href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/home.php?uid=<?php echo $_GET['uid']; ?>
">首页</a>
            </li>
            <li <?php if ($_GET['act'] == 'product'): ?>class="current"<?php endif; ?> >
                <a class="product" href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/home.php?uid=<?php echo $_GET['uid']; ?>
&act=product">宝贝</a>
            </li>
            <li class="<?php if ($_GET['act'] == 'trace'): ?>current <?php endif; ?>last">
                <a class="trace" href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/home.php?uid=<?php echo $_GET['uid']; ?>
&act=trace">新鲜事</a>
            </li>
        </ul>
    </div>
</div>
<div class="main-widget">
	<h3 class="item-hd">
    	<a class="read-more" href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/home.php?uid=<?php echo $_GET['uid']; ?>
&act=product">查看全部</a>
        <span><a href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/home.php?uid=<?php echo $_GET['uid']; ?>
&act=product">我分享的宝贝</a></span>
    </h3>
    <div class="item-bd">
    	<ul class="clearfix">
        	<?php $_from = $this->_tpl_vars['sharegoods']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['name'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['name']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['list']):
        $this->_foreach['name']['iteration']++;
?>
            <li <?php if ($this->_foreach['name']['iteration'] == 3): ?>class="last"<?php endif; ?>>
            	<div class="sitem">
                	<div class="pic">
                    <a title="<?php echo $this->_tpl_vars['list']['pname']; ?>
" href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/?m=product&s=detail&id=<?php echo $this->_tpl_vars['list']['pid']; ?>
" target="_blank"><img width="226" height="210" src="<?php if ($this->_tpl_vars['list']['image']): ?><?php echo $this->_tpl_vars['list']['image']; ?>
<?php else: ?>image/default/nopic.gif<?php endif; ?>" /></a>
                    </div>
                	<div class="content"><?php if ($this->_tpl_vars['list']['content']): ?><?php echo $this->_tpl_vars['list']['content']; ?>
<?php else: ?>分享了商品<?php endif; ?></div>
                    <div class="func">
                        <span class="collect">
                            <a href="javascript:collect_goods('<?php echo $this->_tpl_vars['list']['pid']; ?>
');"><i></i>收藏</a>
                            <strong> <?php echo $this->_tpl_vars['list']['collectnum']; ?>
 </strong>
                        </span>
                    </div>
                </div>
            </li>
            <?php endforeach; endif; unset($_from); ?>
        </ul>
    </div>
</div>
<div class="main-widget clearfix">
	<h3 class="item-hd">
    	<a href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/home.php?uid=<?php echo $_GET['uid']; ?>
&act=trace" class="read-more">查看全部</a>
        <span><a href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/home.php?uid=<?php echo $_GET['uid']; ?>
&act=trace">我的新鲜事</a></span>
    </h3>
    <div class="item-bd">
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
                <?php endif; ?>
                <div class="sns-extra">
                    <span class="sns-time"><?php echo ((is_array($_tmp=$this->_tpl_vars['list']['create_time'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%m-%d&nbsp;%H:%M") : smarty_modifier_date_format($_tmp, "%m-%d&nbsp;%H:%M")); ?>
</span>
                    <span class="sns-action">
                        <span>
                        <a data-param="{&quot;bid&quot;:&quot;<?php echo $this->_tpl_vars['list']['id']; ?>
&quot;}" genre="sns_forward" href="javascript:void(0);" class="sns-action-forward">转发</a>
                        <a data-param="{&quot;bid&quot;:&quot;<?php echo $this->_tpl_vars['list']['id']; ?>
&quot;}" genre="sns_comment" href="javascript:void(0);" class="sns-action-comment">评论</a>
                        </span>
                    </span>
                </div>
			</div>
        </div>
        <?php endforeach; endif; unset($_from); ?>
        <div class="sns-next"><a href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/home.php?uid=<?php echo $_GET['uid']; ?>
&act=trace">去看更多新鲜事<i></i></a></div>
    </div>
</div>
<script type="text/javascript" src="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/script/dialog/dialog.js" id="dialog_js"></script>
<script>
$("[genre='sns_forward']").live('click',function(){
	var data = $(this).attr('data-param');
	eval("data = "+data);
	ajax_form("forward_form", '转发', '<?php echo $this->_tpl_vars['config']['weburl']; ?>
/main.php?m=sns&s=sns&op=forward&cg_u_type=1&bid='+data.bid, 500);
	return false;
});
$("[genre='sns_comment']").live('click',function(){
	var data = $(this).attr('data-param');
	eval("data = "+data);
	ajax_form("comment_form", '评论', '<?php echo $this->_tpl_vars['config']['weburl']; ?>
/main.php?m=sns&s=sns&op=comment&cg_u_type=1&bid='+data.bid, 500);
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

<?php echo $this->_tpl_vars['chat_html']; ?>