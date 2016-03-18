<?php /* Smarty version 2.6.20, created on 2016-03-16 11:23:41
         compiled from user_admin/admin_main_p.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('insert', 'label', 'user_admin/admin_main_p.htm', 61, false),)), $this); ?>
<div class="wrap_buyer clearfix">
    <div class="layout_l">
        <div class="member_info">
            <dl>
                <dt>
                	<a title="编辑用户信息" href="main.php?m=member&s=admin_member"><?php echo $this->_tpl_vars['cominfo']['name']; ?>
</a>&nbsp;(<?php echo $_COOKIE['USER']; ?>
)
                </dt>
                <dd class="qd">
                    <span class="iconfont">&#xe621;</span>&nbsp;<a href="main.php?m=member&s=admin_member&type=email"><?php if ($this->_tpl_vars['cominfo']['email'] && $this->_tpl_vars['cominfo']['email_verify'] == 1): ?>已认证<?php else: ?>未认证<?php endif; ?></a>
                    <span class="iconfont">&#xe61d;</span><a href="main.php?m=member&s=admin_member&type=mobile"><?php if ($this->_tpl_vars['cominfo']['mobile'] && $this->_tpl_vars['cominfo']['mobile_verify'] == 1): ?>已认证<?php else: ?>未认证<?php endif; ?></a>
                </dd>
				<dd class="payment">
                    <a target="_blank" href="<?php echo $this->_tpl_vars['config']['pay_url']; ?>
"><?php echo $this->_tpl_vars['config']['pay_name']; ?>
</a>
                    &nbsp;&nbsp;<span class="iconfont">&#xe61c;</span>&nbsp;<span class="qd"><?php if ($this->_tpl_vars['is_qd']): ?>已签到<?php else: ?><a href="javascript:void(0)">每日签到</a><?php endif; ?></span>
                    &nbsp;&nbsp;<span class="iconfont">&#xe615;</span>&nbsp;<a href="main.php?m=points&s=admin_points">积分明细</a></dd>
            </dl>
            <div class="clear"></div>
        </div>
        
        <div class="weibo">
        <form action="main.php?m=sns&s=sns" name="shareform" id="shareform" method="post">
            <div class="clearfix">
                <div class="charcount" id="weibo"></div>
                <div class="weibopic"></div>
            </div>
            <div class="weibo_con clearfix">
                <input type="hidden" name="act" value="share">
                <textarea name="content" id="content"></textarea><span class="form-error"></span>
                <div></div>
            </div>
            <div class="weibo_button clearfix">
                <a id="shareGoods" style="color: #FFCF2B;" class="iconfont" href="javascript:void(0)" title="分享产品">&#xe609;</a>
                <a id="shareStore" style="color: #0579C6" class="iconfont" href="javascript:void(0)" title="分享店铺">&#xe619;</a>
                <a id="insertFace" class="iconfont" href="javascript:void(0)" title="分享表情">&#xe60b;</a>
                <input type="submit" id="btn" value="分享" class="button">
			</div>
        </form>
        </div>
        
        <div class="tabmenu">
            <ul class="tab">
                <li class="active"><a href="javascript:void(0)">&nbsp;&nbsp;&nbsp;动态</a><div></div></li>
            </ul>
        </div>
        <div class="friendtrace" id="friendtrace"></div>
    </div>
    
    <div class="layout_r">
        <div class="user_atten clearfix">
            <ul>
                <li><a href="main.php?m=sns&s=admin_friends"><strong><?php echo $this->_tpl_vars['count']['friend']; ?>
</strong><span>关注 </span></a></li>
                <li><a href="main.php?m=sns&s=admin_friends&type=fan"><strong><?php echo $this->_tpl_vars['count']['fan']; ?>
</strong><span>粉丝 </span></a></li>
                <li class="li"><a href=""><strong><?php echo $this->_tpl_vars['count']['blog']; ?>
</strong><span>微博 </span></a></li>
            </ul>
        </div>
        <div class="right_module">            
            <form class="right_module_title">
                <fieldset><legend>可能感兴趣的人</legend></fieldset>
            </form>
            <div class="right_module_content friends">
            <?php require_once(SMARTY_CORE_DIR . 'core.run_insert_handler.php');
echo smarty_core_run_insert_handler(array('args' => array('name' => 'label', 'type' => 'sns_friends', 'temp' => 'friends_list_1', 'limit' => 3)), $this); ?>

            </div>
        </div>
        
        <div class="right_module">            
            <form class="right_module_title">
                <fieldset><legend>热门活动</legend></fieldset>
            </form>
            <div class="right_module_content ad174">
            <script src='<?php echo $this->_tpl_vars['config']['weburl']; ?>
/api/ad.php?id=8&catid=<?php echo $_GET['id']; ?>
&name=<?php echo $_GET['key']; ?>
'></script>
            </div>
        </div>
        
        <div class="right_module">            
            <form class="right_module_title">
                <fieldset><legend>商品推荐</legend></fieldset>
            </form>
            <div class="right_module_content ad174">
            <script src='<?php echo $this->_tpl_vars['config']['weburl']; ?>
/api/ad.php?id=9&catid=<?php echo $_GET['id']; ?>
&name=<?php echo $_GET['key']; ?>
'></script>
            </div>
        </div>
        <div class="right_module">            
            <form class="right_module_title">
                <fieldset><legend>公告栏</legend></fieldset>
            </form>
            <div class="right_module_content con">
            <?php require_once(SMARTY_CORE_DIR . 'core.run_insert_handler.php');
echo smarty_core_run_insert_handler(array('args' => array('name' => 'label', 'type' => 'announcement', 'temp' => 'notice_list', 'limit' => 5)), $this); ?>

            </div>
        </div>
    </div>
</div>
</div>
<script src="script/jquery.caretInsert.js"></script>
<script>
var weburl = "<?php echo $this->_tpl_vars['config']['weburl']; ?>
"
<?php if (! $this->_tpl_vars['is_qd']): ?>
$('.qd a').click(function(){
	var url = 'ajax_back_end.php';
	var sj = new Date();
	var pars = 'shuiji=' + sj+'&qd=1&id=<?php echo $this->_tpl_vars['cominfo']['userid']; ?>
'; 
	$.post(url, pars,showResponse);
	function showResponse(originalRequest)
	{	
		$('.qd').html("已签到");
	}
});
<?php endif; ?>
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
$('.weibo_con textarea').live('blur',function(){
	$(this).parent().removeClass('focus');
}).live('focus',function(){
	$(this).parent().addClass('focus');
});

$('#friendtrace').snsinit();
$('#friendtrace').snsshow({url:"<?php echo $this->_tpl_vars['config']['weburl']; ?>
/main.php?m=sns&s=sns&curpage=1",'iIntervalId':true});

//显示分享商品页面	
$('#shareGoods').click(function(){	
	ajax_form("sharegoods", '<?php echo $this->_tpl_vars['lang']['share_buy_and_collection_of_baby']; ?>
', '<?php echo $this->_tpl_vars['config']['weburl']; ?>
/main.php?m=sns&s=sns&op=sharegoods', 500);
	return false;
});

//显示分享店铺页面
$('#shareStore').click(function(){
	ajax_form("shareshop", '<?php echo $this->_tpl_vars['lang']['share_shop']; ?>
', '<?php echo $this->_tpl_vars['config']['weburl']; ?>
/main.php?m=sns&s=sns&op=shareshop', 500);
	return false;
});
$("[genre='sns_forward']").live('click',function(){
	var data = $(this).attr('data-param');
	eval("data = "+data);
	ajax_form("forward_form", '<?php echo $this->_tpl_vars['lang']['forwarding']; ?>
', '<?php echo $this->_tpl_vars['config']['weburl']; ?>
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
$("[data_type='fd_del']").live('click',function(){
	var data_str = $(this).attr('data-param');
	eval("data_str = "+data_str);
	var url = "<?php echo $this->_tpl_vars['config']['weburl']; ?>
/main.php?m=sns&s=sns";
	var pars = 'bid='+data_str.bid+'&op=del';
	$.post(url, pars,showResponse);
	function showResponse(originalRequest)
	{
		var d = DialogManager.create('notice');
		d.setTitle('<?php echo $this->_tpl_vars['lang']['message']; ?>
');
		d.setContents('message', { type: 'notice', text: "<?php echo $this->_tpl_vars['lang']['deleted_successfully']; ?>
" });
		d.setWidth(270);
		d.show('center');
		function closefunc()
		{
			DialogManager.close("notice");
			$('#friendtrace').snsshow({url:"<?php echo $this->_tpl_vars['config']['weburl']; ?>
/main.php?m=sns&s=sns&curpage=1",'iIntervalId':true});
		}
		setTimeout(closefunc,1000);
	}
});


function $$(id) {
	return !id ? null : document.getElementById(id);
}
$("#btn").bind('click',function(){		
	formid='shareform';
	var ajaxframeid = 'ajaxframe';
	var ajaxframe = $$(ajaxframeid);
	if(!ajaxframe){
		var div = document.createElement('div');
		div.style.display = 'none';
		div.innerHTML = '<iframe name="' + ajaxframeid + '" id="' + ajaxframeid + '" loading="1"></iframe>';
		ajaxframe = $$(ajaxframeid);
		$$('append_parent').appendChild(div);
	}
	$$(formid).target = ajaxframeid;
	$('#'+formid).validate({
		errorPlacement: function(error, element){
			element.next('.form-error').append(error)
		},  
		rules : {
			content : {
				required: true,
				maxlength : 140
			}
		},
		messages : {
			content : {
				required: '不能为空!',
				maxlength: '不能超过140字'
			}
		}, 
		submitHandler:function(form){  
			form.submit();
			function closefunc()
			{
				$("#content").val('');
				DialogManager.close("notice");
				$('#friendtrace').snsshow({url:"<?php echo $this->_tpl_vars['config']['weburl']; ?>
/main.php?m=sns&s=sns&curpage=1",'iIntervalId':true});
			}
			var d = DialogManager.create('notice');
			d.setTitle('<?php echo $this->_tpl_vars['lang']['message']; ?>
');
			d.setContents('message', { type: 'notice', text: "<?php echo $this->_tpl_vars['lang']['share_successful']; ?>
" });
			d.setWidth(270);
			d.show('center');
			setTimeout(closefunc,800);
		}
	});
});
$("#content").charCount({
	allowed: 140,
	warning: 10,
	counterContainerID:'weibo',
	firstCounterText:'还可以输入<span>',
	endCounterText:'</span>字',
	errorCounterText:'已经超出<span>'
});
</script>
<script src="script/face/face.js"></script>