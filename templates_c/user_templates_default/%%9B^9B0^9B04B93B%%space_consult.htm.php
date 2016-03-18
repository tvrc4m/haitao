<?php /* Smarty version 2.6.20, created on 2016-03-17 19:57:29
         compiled from space_consult.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'space_consult.htm', 12, false),)), $this); ?>
<div class="consult-hd"><a class="add-consult" href="javascript:void(0);">我要提问</a>因厂家更改商品包装、场地、附配件等不做提前通知，且每位咨询者购买、提问时间等不同。为此，客服给到的回复仅对提问者3天内有效，其他网友仅供参考！给您带来的不变还请谅解，谢谢！</div>
<div class="consult-bd clearfix">
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
                <em><?php echo ((is_array($_tmp=$this->_tpl_vars['list']['question_time'])) ? $this->_run_mod_handler('date_format', true, $_tmp) : smarty_modifier_date_format($_tmp)); ?>
</em>
            </div>
        </div>
        <dl>
            <dt><em>Q:</em><?php echo $this->_tpl_vars['list']['question']; ?>
</dt>
            <dd><em>A:</em><?php echo $this->_tpl_vars['list']['answer']; ?>
</dd>
        </dl>
    </li>
<?php endforeach; else: ?>
	<li class="no-result">购买之前，如有问题，请<a class="add-consult" href="javascript:void(0);">提问</a></li>
<?php endif; unset($_from); ?>
</ul>
<div class="pages"><?php echo $this->_tpl_vars['re']['page']; ?>
</div>
</div>
<div class="consult-box hidden">
    <div class="consult-form">
        <div class="consult-mt"><a class="close" href="javascript:void(0);"></a><h2>我要提问</h2></div>
        <div class="consult-mc">
        <form method="post" onsubmit="return check()">
           <label>提问内容:</label>
           <div class="count" id="count"></div>
           <textarea name="con" id="con"></textarea>
           <input type="submit" id="submit" value="提交" />
           <input type="hidden" name="act" value="<?php echo $this->_tpl_vars['act']; ?>
" />
        </form>
        </div>
        <dl>
			<dt>提问小贴士：</dt>
			<dd>因厂家更改商品包装、产地、附配件等不做提前通知，且每位咨询者购买情况、提问时间等不同。为此，客服给到的回复仅对提问者3天内有效，其他网友仅供参考！给您带来的不便还请谅解，谢谢！</dd>
		</dl>
    </div>
</div>
<script type="text/javascript" src="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/script/jquery.charCount.js"></script>
<script type="text/javascript">
function check()
{
	$("#submit").attr("disabled","true");
	if(!$("#con").val() || $("#con").val().length>=200)
	{
		$("#con").focus();
		$("#submit").attr("disabled","");
		return false;	
	}
	$("#submit").val("提交中...");
}
$(".add-consult").click(function(){
	
	var isIE=!!window.ActiveXObject;
	var isIE6=isIE&&!window.XMLHttpRequest; 
	if(isIE && isIE6){
		alert("对不起，您的浏览器不支持此操作!请更换浏览器或升级浏览器版本。");
		return false;
	}
	var uname='<?php echo $_COOKIE['USER']; ?>
';
	if(uname=='')
	{
		window.location.href='<?php echo $this->_tpl_vars['config']['weburl']; ?>
/login.php?forward='+encodeURIComponent('<?php echo $this->_tpl_vars['config']['weburl']; ?>
?m=product&s=detail&id=<?php echo $_GET['id']; ?>
');
		return false;
	}
	$("body,html").animate({scrollTop:$(".inner-wrap").offset().top});
	ScreenLocker.lock(333);
	$(".consult-box").show();
});
$(".close").click(function(){
	ScreenLocker.unlock();
	$(".consult-box").hide();
});
$("#con").charCount({
	allowed: 200,
	warning: 10,
	counterContainerID:'count',
	firstCounterText:'还可以输入<span>',
	endCounterText:'</span>字',
	errorCounterText:'已经超出<span>'
});
$(".pages a").click(function(){
	$("body,html").animate({scrollTop:$(".inner-wrap").offset().top});
	$('.consult-bd').html('<div class="loading"><p>正在努力加载中...</p></div>');
	$('#consult').load($(this).attr("href"));
	return false;
});
</script>