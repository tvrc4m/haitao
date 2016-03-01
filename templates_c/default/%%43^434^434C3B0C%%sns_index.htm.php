<?php /* Smarty version 2.6.20, created on 2016-03-01 11:02:29
         compiled from sns_index.htm */ ?>
<!--
/*
* @Auth:bruce
* @Uptime:2014-11-26
* @Desc:sns 更新js。
*/
 -->
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "sns_header.htm", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<link rel='stylesheet' href='<?php echo $this->_tpl_vars['config']['weburl']; ?>
/module/sns/templates/sns.css' media='screen' />
<script type="text/javascript" src="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/script/jquery.ui.js"></script>
<script type="text/javascript" src="script/jquery-1.4.4.min.js"></script>
<script type="text/javascript" src="script/jquery.lazyload.min.js"></script>
<script type="text/javascript" src="script/blocksit.min.js"></script>
<script type="text/javascript" src="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/script/dialog/dialog.js" id="dialog_js"></script>
<script type="text/javascript" src="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/script/jquery.charCount.js"></script>
<script type="text/javascript" src="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/script/jquery.validation.min.js"></script>
<div class="w main">
	<div class="channel_info clearfix">
    	<h1>广场&nbsp;&nbsp;&nbsp;</h1>
        <!--<a class="image-text" title="图文" href="">图文</a>
        <a class="read" title="阅读" href="">阅读</a>-->
        <a class="release" title="发布信息" href="main.php?cg_u_type=1">发布信息</a>
        <p>今日更新:<?php echo $this->_tpl_vars['count2']; ?>
</p>
        <p>听众:<?php echo $this->_tpl_vars['count1']; ?>
</p>
    </div>
    <div class="list clearfix"></div>
</div>
<div id="append_parent"></div>
<div id="ajaxwaitid"></div>
	<div id="wrapper">
		<div id="container">
			<?php echo $this->_tpl_vars['string']; ?>

		</div>
	</div>

	<div id="test" style="display:none;" page="1"></div>
</body>

<script type="text/javascript">
function delay_f()
	{
		$('#container').BlocksIt({
			numOfCol:5,
			offsetX: 8,
			offsetY: 8
		});
	}

$(function(){
	$("img.lazy").lazyload({		
		load:function(){
			$('#container').BlocksIt({
				numOfCol:5,
				offsetX: 8,
				offsetY: 8
			});
		}
	});	


	var At =  setTimeout("delay_f()", 100)
	
	$(window).scroll(function(){
		// 当滚动到最底部以上50像素时， 加载新内容
		if ($(document).height() - $(this).scrollTop() - $(this).height()<50){
			page = $("#test").attr("page")
			page = page*1 + 1;
			$("#test").attr("page",page)
			$.post('index.php?m=sns&curpage=1<?php if ($_GET['key']): ?>&key=<?php echo $_GET['key']; ?>
<?php endif; ?>&page='+page,{},function (d){
				if(" " != d)
				{
					$('#container').append(d);	
					$('#container').BlocksIt({
						numOfCol:5,
						offsetX: 8,
						offsetY: 8
					});
					$("img.lazy").lazyload();
				}
			})
		}
	});
	
	//window resize
	var currentWidth = 1210;
	$(window).resize(function() {
		var winWidth = $(window).width();
		var conWidth;
		if(winWidth < 660) {
			conWidth = 440;
			col = 2
		} else if(winWidth < 880) {
			conWidth = 660;
			col = 3
		} else if(winWidth < 1210) {
			conWidth = 880;
			col = 4;
		} else {
			conWidth = 1210;
			col = 5;
		}
		
		if(conWidth != currentWidth) {
			currentWidth = conWidth;
			$('#container').width(conWidth);
			$('#container').BlocksIt({
				numOfCol: col,
				offsetX: 8,
				offsetY: 8
			});
		}
	});
});

function ajax_form(id, title, url, width, model)
{
    if (!width)	width = 480;
    if (!model) model = 1;
    var d = DialogManager.create(id);;
    d.setTitle(title);
    d.setContents('ajax', url);
    d.setWidth(width);
    d.show('center',model);
    return d;
}
$("[genre='sns_forward']").live('click',function(){
	var uname='<?php echo $_COOKIE['USER']; ?>
';
	if(uname=='')
	{
		alert('<?php echo $this->_tpl_vars['lang']['no_logo']; ?>
');
		window.location.href='<?php echo $this->_tpl_vars['config']['weburl']; ?>
/login.php?forward=index.php?m=sns';
		return false;
	}
	var data = $(this).attr('data-param');
	eval("data = "+data);
	ajax_form("forward_form", '转发', '<?php echo $this->_tpl_vars['config']['weburl']; ?>
/main.php?cg_u_type=1&m=sns&s=sns&op=forward&bid='+data.bid, 500);
	return false;
});
$("[genre='sns_comment']").live('click',function(){
	
	var uname='<?php echo $_COOKIE['USER']; ?>
';
	if(uname=='')
	{
		alert('<?php echo $this->_tpl_vars['lang']['no_logo']; ?>
');
		window.location.href='<?php echo $this->_tpl_vars['config']['weburl']; ?>
/login.php?forward=index.php?m=sns';
		return false;
	}
	var data = $(this).attr('data-param');
	eval("data = "+data);
	ajax_form("comment_form", '评论', '<?php echo $this->_tpl_vars['config']['weburl']; ?>
/main.php?cg_u_type=1&m=sns&s=sns&op=comment&bid='+data.bid, 500);
	return false;
});
$(function(){
	//加关注
	$(".attention").live('click',function(){
		
		var url = '<?php echo $this->_tpl_vars['config']['weburl']; ?>
/module/sns/ajax_update.php';
		var uname='<?php echo $_COOKIE['USER']; ?>
';
		if(uname=='')
		{
			alert('<?php echo $this->_tpl_vars['lang']['no_logo']; ?>
');
			window.location.href='<?php echo $this->_tpl_vars['config']['weburl']; ?>
/login.php?forward=index.php?m=sns';
			return false;
		}
		var data_str = $(this).attr('data-param');
        eval( "data_str = "+data_str);
		var pars = 'mid='+data_str.uid+'&uname='+uname+'&op=add';
		$.post(url, pars,showResponse);
		function showResponse(originalRequest)
		{
			if(originalRequest>1)
				alert('成功添加');
			else if (originalRequest>0)
				alert('已添加');
			else
				alert('参数传递错误，无法完成操作');
		}
	});
});


</script>
</html>