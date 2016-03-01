<?php /* Smarty version 2.6.20, created on 2016-03-01 09:44:27
         compiled from shop_link.htm */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>友情链接</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="admin.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="../script/jquery-1.4.4.min.js"></script>
<script type="text/javascript" src="../script/jquery.validation.min.js"></script>
<script>
$(function(){
	$('#form').validate({
		errorPlacement: function(error, element){
			element.next('.form-error').append(error);
		}, 
		rules : {
			name:{
				required:true
			},
			url:{
				required:true
			},
		},
		messages : {
			name:{
				required:'请填写名称',
			},
			url:{
				required:'请填写URL',
			},
		}
	});
});
</script>
</head>
<body>
	<div class="container">
        <div class="flow"> 
            <div class="itemtitle">
                <h3>友情链接</h3>
                <ul>
                    <li <?php if ($_GET['operation'] == ''): ?>class="current"<?php endif; ?>><a href="?m=<?php echo $_GET['m']; ?>
&s=<?php echo $_GET['s']; ?>
"><span>管理</span></a></li>
                    <?php if ($_GET['operation'] == 'edit'): ?>
                    <li class="current"><a href="#"><span>修改</span></a></li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
        <div class="h35"></div>  
        <?php if ($_GET['operation'] == 'edit'): ?>
            <form name="form" id="form" method="post">
            <input name="id" type="hidden" id="id" value="<?php echo $this->_tpl_vars['de']['id']; ?>
">
            <table class="table table1">
             	<thead>
                    <tr>
                        <th class="partition" colspan="99">友情链接</th>
                </thead>
                <tbody>
         
                <tr>
                    <td width="100">店铺名称</td>
                    <td><a target="_blank" href="../shop.php?uid=<?php echo $this->_tpl_vars['de']['shop_id']; ?>
"><?php echo $this->_tpl_vars['de']['shop_name']; ?>
</a></td>
                </tr>
                <tr>
                    <td>店主用户名</td>
                    <td><a target="_blank" href="../home.php?uid=<?php echo $this->_tpl_vars['de']['shop_id']; ?>
"><?php echo $this->_tpl_vars['de']['member_name']; ?>
</a></td>
                </tr>
                
                <tr>
                    <td>标题</td>
                    <td>
                    <input name="name" id="name" type="text" class="w350" value="<?php echo $this->_tpl_vars['de']['name']; ?>
"/>
                    <div id="form-error" class="form-error"></div>
                    </td>
                </tr>
                
                <tr>
                    <td>链接</td>
                    <td>
                    <input name="url" id="url" type="text" class="w350" value="<?php echo $this->_tpl_vars['de']['url']; ?>
"/>
                    <div id="form-error" class="form-error"></div>
                    </td>
                </tr>
                
                <tr>
                    <td>描述</td>
                    <td>
                    <textarea name="desc" id="desc"  class="w350"><?php echo $this->_tpl_vars['de']['desc']; ?>
</textarea>
                    </td>
                </tr>
                
                <tr>
                    <td>状态</td>
                    <td>
                    <input type="radio" name="status" value="1" id="open" <?php if ($this->_tpl_vars['de']['status'] == 1): ?>checked="checked"<?php endif; ?>/><label for="open">开启</label>
                    <input type="radio" name="status" value="0" id="close" <?php if ($this->_tpl_vars['de']['status'] != 1): ?>checked="checked"<?php endif; ?>/><label for="close">关闭</label>
                    </td>
                </tr>
                
                <tr>
                    <td>&nbsp;</td>
                    <td>
                    <input class="submit" type="submit" value="提交">
                    <input name="act" type="hidden" id="action" value="edit">
                    </td>
                </tr>
                </tbody>
            </table>
            </form>
        <?php else: ?>
		<script type="text/javascript">
        $(function(){
            /* 全选 */
             $('.checkall').click(function(){
                var _self = this;
                $('.checkitem').each(function(){
                    if (!this.disabled)
                    {
                        $(this).attr('checked', _self.checked);
                    }
                });
                $('.checkall').attr('checked', this.checked);
            });	 
        });
        </script>
        <form action="" method="post">
        <table class="table">
            <tbody>
                <tr class="header">
                    <th width="30">删</th>
                    <th width="70">店铺ID</th>
                    <th width="100" class="al">店主用户名</th>
                    <th width="100" class="al">店铺名称</th>
                    <th width="100">标题</th>
                    <th width="250">链接</th>
                    <th>描述</th>
                    <th width="100">状态</th>
                    <th width="50"></th>
                </tr>
                <?php $_from = $this->_tpl_vars['de']['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['list']):
?>
                <tr>
                    <td><input type="checkbox" value="<?php echo $this->_tpl_vars['list']['id']; ?>
" class="checkitem" name="chk[]"></td>
                  	<td><?php echo $this->_tpl_vars['list']['shop_id']; ?>
</td>
                  	<td class="al"><a target="_blank" href="../home.php?uid=<?php echo $this->_tpl_vars['list']['shop_id']; ?>
"><?php echo $this->_tpl_vars['list']['member_name']; ?>
</a></td>
                  	<td class="al"><a target="_blank" href="../shop.php?uid=<?php echo $this->_tpl_vars['list']['shop_id']; ?>
"><?php echo $this->_tpl_vars['list']['shop_name']; ?>
</a></td>
                    <td><?php echo $this->_tpl_vars['list']['name']; ?>
</td>
                    <td><?php echo $this->_tpl_vars['list']['url']; ?>
</td>
                    <td><?php echo $this->_tpl_vars['list']['desc']; ?>
</td>
                    <td><?php if ($this->_tpl_vars['list']['status']): ?>开启<?php else: ?>关闭<?php endif; ?></td>
                    <td>
                    <a href="?m=<?php echo $_GET['m']; ?>
&s=<?php echo $_GET['s']; ?>
&operation=edit&editid=<?php echo $this->_tpl_vars['list']['id']; ?>
"><?php echo $this->_tpl_vars['editimg']; ?>
</a> 
                    <a onclick="return confirm('确定删除吗');" href="?m=<?php echo $_GET['m']; ?>
&s=<?php echo $_GET['s']; ?>
&delid=<?php echo $this->_tpl_vars['list']['id']; ?>
"><?php echo $this->_tpl_vars['delimg']; ?>
</a>
                    </td>
                </tr>
                <?php endforeach; else: ?>
                <tr>
                    <td class="norecord" colspan="99"><i></i><span>暂无符合条件的数据记录</span></td>
                </tr>
                <?php endif; unset($_from); ?>
            </tbody>
            <tfoot>
                <tr>
                	<td colspan="5">
                        <input type="checkbox" class="checkall" id="del">
                        <input type="hidden" name="act" value="op" />
                        <input type="submit" name="submit" value="<?php echo $this->_tpl_vars['lang']['btn_submit']; ?>
" />
                        <input type="submit" name="submit" value="<?php echo $this->_tpl_vars['lang']['btn_open']; ?>
" />
                        <input type="submit" name="submit" value="<?php echo $this->_tpl_vars['lang']['btn_close']; ?>
" />
                    </td>
                    <td colspan="99"><div class="page"><?php echo $this->_tpl_vars['de']['page']; ?>
</div></td>
                </tr>
            </tfoot>
        </table>
        </form>
        <?php endif; ?>
    </div>
</body>
</html>