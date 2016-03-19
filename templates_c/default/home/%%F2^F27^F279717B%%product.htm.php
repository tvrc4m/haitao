<?php /* Smarty version 2.6.20, created on 2016-03-18 11:31:52
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