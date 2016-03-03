<?php /* Smarty version 2.6.20, created on 2016-03-03 11:39:55
         compiled from brand.htm */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>品牌</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="admin.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="../script/jquery-1.4.4.min.js"></script>
<script type="text/javascript" src="../script/jquery.validation.min.js"></script>
<script src="../script/my_lightbox.js" language="javascript"></script>
<script language="javascript">
$(function(){
	$('#form').validate({
		errorPlacement: function(error, element){
			element.next('.form-error').append(error);
		},      
		rules : {
			name:{
				required:true
			},
			catid:{
				required:true
			},
		},
		messages : {
			name:{
				required:'请填写品牌',
			},
			catid:{
				required:'请填写分类',
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
                <h3>品牌</h3>
                <ul>
                    <li <?php if ($_GET['operation'] == ''): ?>class="current"<?php endif; ?>><a href="?m=brand&s=brand.php"><span>管理</span></a></li>
                    <li <?php if ($_GET['operation'] == 'add'): ?>class="current"<?php endif; ?>><a href="?m=brand&s=brand.php&operation=add"><span>添加</span></a></li>
                    <li <?php if ($_GET['operation'] == 'batch'): ?>class="current"<?php endif; ?>><a href="?m=brand&s=brand.php&operation=batch"><span>批量添加</span></a></li>
                    <?php if ($_GET['operation'] == 'edit'): ?>
                    <li class="current"><a href="#"><span>修改</span></a></li>
                    <?php endif; ?>
                    <li><a href="?m=brand&s=brand_cat.php"><span>分类管理</span></a></li>
                </ul>
            </div>
        </div>
        <div class="h35"></div>  
        <?php if ($_GET['operation'] == 'add' || $_GET['operation'] == 'edit' || $_GET['operation'] == 'batch'): ?>
            <form name="form" id="form" method="post">
            <input name="id" type="hidden" id="id" value="<?php echo $this->_tpl_vars['de']['id']; ?>
">
            <table class="table table1">
                <thead>
                    <tr>
                        <th class="partition" colspan="99">品牌</th>
                    </tr>
                </thead>
                <tbody>
                <tr>
                    <td width="100">品牌</td>
                    <td>
                    <?php if ($_GET['operation'] == 'batch'): ?> 
                    <textarea name="name" id="name" class="w350" rows="10"></textarea>
                    <?php else: ?>
                    <input name="name" id="name" type="text" class="w350" value="<?php echo $this->_tpl_vars['de']['name']; ?>
">
                    <?php endif; ?>
                    <div id="form-error" class="form-error"></div>
                    </td>
                </tr>
                
                <tr>
                    <td>分类</td>
                    <td>
                    <select class="select" name='catid'>
                    	<option value=''>选择品牌分类</option>
                        <?php $_from = $this->_tpl_vars['cat']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['list']):
?>
                        <option <?php if ($this->_tpl_vars['de']['catid'] == $this->_tpl_vars['list']['id']): ?> selected="selected" <?php endif; ?>value="<?php echo $this->_tpl_vars['list']['id']; ?>
"><?php echo $this->_tpl_vars['list']['catname']; ?>
</option>	
                        <?php $_from = $this->_tpl_vars['list']['scat']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['slist']):
?>
                        <option <?php if ($this->_tpl_vars['de']['catid'] == $this->_tpl_vars['slist']['id']): ?> selected="selected" <?php endif; ?>value="<?php echo $this->_tpl_vars['slist']['id']; ?>
">┣ <?php echo $this->_tpl_vars['slist']['catname']; ?>
</option>	
                        <?php endforeach; endif; unset($_from); ?> 
                        <?php endforeach; endif; unset($_from); ?> 
            		</select>
                    <div id="form-error" class="form-error"></div>
                    </td>
                </tr>
                
                <tr>
                    <td>LOGO</td>
                    <td>
                    <input name="pic" class="w350" type="text" id="pic" value="<?php echo $this->_tpl_vars['de']['logo']; ?>
" />
                    <input name="oldpic" type="hidden" value="<?php echo $this->_tpl_vars['de']['logo']; ?>
" />
                    [<a href="javascript:uploadfile('上传LOGO','pic',400,240,'brand')">上传</a>] 
                    [<a href="javascript:preview('pic');">预览</a>]
                    [<a onclick="javascript:$('#pic').val('');" href="#">删除</a>] <span class="bz"></span>
                    </td>
                </tr>
                
                <tr>
                    <td>点击数</td>
                    <td><input type="text" name="hits" value="<?php if ($this->_tpl_vars['de']['hits']): ?><?php echo $this->_tpl_vars['de']['hits']; ?>
<?php else: ?>0<?php endif; ?>" onbeforepaste="clipboardData.setData('text',clipboardData.getData('text').replace(/[^\d]/g,''))" onkeyup="value=value.replace(/[^\d]/g,'')"/></td>
				</tr>
                
                <tr>
                    <td>状态</td>
                    <td>
                    <!--<input type="radio" name="status" value="2" id="tj" <?php if ($this->_tpl_vars['de']['status'] == 2): ?>checked="checked"<?php endif; ?>/><label for="tj">推荐</label>-->
                    <input type="radio" name="status" value="1" id="open" <?php if ($this->_tpl_vars['de']['status'] == 1): ?>checked="checked"<?php endif; ?>/><label for="open">开启</label>
                    <input type="radio" name="status" value="0" id="close" <?php if ($this->_tpl_vars['de']['status'] == 0): ?>checked="checked"<?php endif; ?>/><label for="close">关闭</label>
                    </td>
                </tr>
               
                <tr>
                    <td>&nbsp;</td>
                    <td>
                    <input class="submit" type="submit" value="提交">
                    <input name="act" type="hidden" id="action" value="<?php if (! $_GET['editid']): ?><?php if ($_GET['operation'] == 'batch'): ?>batch<?php else: ?>save<?php endif; ?><?php else: ?>edit<?php endif; ?>">
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
                    <th width="70">显示顺序</th>
                    <th width="100">logo</th>
                    <th class="al">品牌</th>
                    <th width="120">分类</th>
                    <th width="100">状态</th>
                    <th width="50"></th>
                </tr>
                <?php $_from = $this->_tpl_vars['de']['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['list']):
?>
                <tr>
                    <td><input type="checkbox" value="<?php echo $this->_tpl_vars['list']['id']; ?>
" class="checkitem" name="chk[]"></td>
                    <td><input type="text" class="w50" maxlength="3" name="displayorder[<?php echo $this->_tpl_vars['list']['id']; ?>
]" value="<?php echo $this->_tpl_vars['list']['displayorder']; ?>
" onbeforepaste="clipboardData.setData('text',clipboardData.getData('text').replace(/[^\d]/g,''))" onkeyup="value=value.replace(/[^\d]/g,'')" /></td>
                    <td><?php if ($this->_tpl_vars['list']['logo']): ?><img width="40" class="img" src="<?php echo $this->_tpl_vars['list']['logo']; ?>
" /><?php else: ?><img class="img" width="40" src="../image/default/nopic.gif" /><?php endif; ?></td>
                    <td class="al"><?php echo $this->_tpl_vars['list']['name']; ?>
</td>
                    <td><?php echo $this->_tpl_vars['list']['catname']; ?>
</td>
                    <td><?php if ($this->_tpl_vars['list']['status'] == 1): ?>开启<?php elseif ($this->_tpl_vars['list']['status'] == 2): ?>推荐<?php else: ?>关闭<?php endif; ?></td>
                    <td>
                    <a href="?m=brand&s=brand.php&operation=edit&editid=<?php echo $this->_tpl_vars['list']['id']; ?>
"><?php echo $this->_tpl_vars['editimg']; ?>
</a> 
                    <a onclick="return confirm('确定删除吗');" href="?m=brand&s=brand.php&delid=<?php echo $this->_tpl_vars['list']['id']; ?>
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
                	<td colspan="4">
                        <input type="checkbox" class="checkall" id="del">
                        <input type="hidden" name="act" value="op" />
                        <input type="submit" name="submit" value="<?php echo $this->_tpl_vars['lang']['btn_submit']; ?>
" />
                        <input type="submit" name="submit" value="<?php echo $this->_tpl_vars['lang']['rc']; ?>
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