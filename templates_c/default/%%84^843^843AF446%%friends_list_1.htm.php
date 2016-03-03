<?php /* Smarty version 2.6.20, created on 2016-03-03 11:51:20
         compiled from friends_list_1.htm */ ?>
<?php $_from = $this->_tpl_vars['member']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['num'] => $this->_tpl_vars['list']):
?>
    <dl class="clearfix">
        <dt><a target="_blank" href="home.php?uid=<?php echo $this->_tpl_vars['list']['userid']; ?>
"><img height="50" width="50" src="<?php if ($this->_tpl_vars['list']['logo']): ?><?php echo $this->_tpl_vars['list']['logo']; ?>
<?php else: ?>image/default/avatar.png<?php endif; ?>" /></a></dt>
        <dd>
        <p class="name"><a target="_blank" href="home.php?uid=<?php echo $this->_tpl_vars['list']['userid']; ?>
"><?php echo $this->_tpl_vars['list']['name']; ?>
</a></p>
        <a class="addicon" href="javascript:void(0)" data-param="{'mid':'<?php echo $this->_tpl_vars['list']['userid']; ?>
'}" data_type="followbtn"><span><em>+</em>关注</span></a>
        </dd>
    </dl>
<?php endforeach; endif; unset($_from); ?>
<script>
$(function(){
	//加关注
	$("[data_type='followbtn']").live('click',function(){
		var url = '<?php echo $this->_tpl_vars['config']['weburl']; ?>
/module/sns/ajax_update.php';
		var uname='<?php echo $_COOKIE['USER']; ?>
';
		var data_str = $(this).attr('data-param');
        var index=$(this).parent().parent().index();
	    eval( "data_str = "+data_str);
		var pars = 'mid='+data_str.mid+'&uname='+uname+'&op=add';
		$.post(url, pars,showResponse);
		function showResponse(originalRequest)
		{
			if(originalRequest>1)
			{	
				$(".friends dl").eq(index).find('a[class="addicon"]').remove();
				$(".friends dl").eq(index).find('p[class="name"]').after('成功添加');
			}
			else if (originalRequest>0)
			{
				$(".friends dl").eq(index).find('a[class="addicon"]').remove();
				$(".friends dl").eq(index).find('p[class="name"]').after('已添加');
			}
			else
				alert('参数传递错误，无法完成操作');
		}
	});
});
</script>