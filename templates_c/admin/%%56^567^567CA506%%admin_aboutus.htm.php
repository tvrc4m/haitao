<?php /* Smarty version 2.6.20, created on 2016-03-03 13:03:01
         compiled from admin_aboutus.htm */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>独立页面</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="admin.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="../script/jquery-1.4.4.min.js"></script>
<script language="javascript" src="../script/Calendar.js"></script>
<script type="text/javascript" src="../script/jquery.validation.min.js"></script>
<script>
$(function(){
	$('#form').validate({
		errorPlacement: function(error, element){
			element.next('.form-error').append(error);
		},      
		rules : {
			con_title:{
				required:true
			},
		},
		messages : {
			con_title:{
				required:'请填写标题',
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
                <h3>独立页面</h3>
                <ul>
                    <li <?php if ($_GET['operation'] == ''): ?>class="current"<?php endif; ?>><a href="aboutus.php"><span>管理</span></a></li>
                    <li <?php if ($_GET['operation'] == 'add'): ?>class="current"<?php endif; ?>><a href="aboutus.php?operation=add"><span>添加</span></a></li>
                    <?php if ($_GET['operation'] == 'edit'): ?>
                    <li class="current"><a href="#"><span>修改</span></a></li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
        <div class="h35"></div>  
        <?php if ($_GET['operation'] == 'add' || $_GET['operation'] == 'edit'): ?>
            <form name="form" id="form" method="post">
            <input name="id" type="hidden" id="id" value="<?php echo $this->_tpl_vars['de']['con_id']; ?>
">
            <table class="table table1">
                <thead>
                    <tr>
                        <th class="partition" colspan="99">独立页面</th>
                    </tr>
                </thead>
                <tbody>
                <tr>
                    <td width="100">名称</td>
                    <td>
                    <input name="con_title" id="con_title" type="text" class="w350" value="<?php echo $this->_tpl_vars['de']['con_title']; ?>
"><div id="form-error" class="form-error"></div>
                    </td>
                </tr>
                
                <tr>
                    <td>调用网址</td>
                    <td><input type="text" name="con_linkaddr" class="w350" value="<?php echo $this->_tpl_vars['de']['con_linkaddr']; ?>
" ></td>
				</tr>
                
                <tr>
                    <td>活动详情</td>
                    <td>
                    	<script charset="utf-8" src="../lib/kindeditor/kindeditor-min.js"></script>
                    	<script>
						var editor;
						KindEditor.ready(function(K) {
							editor = K.create('textarea[name="con_desc"]', {
								
							});
						});
						</script>
                        <textarea style="width:80%; height:300px" name="con_desc"><?php echo $this->_tpl_vars['de']['con_desc']; ?>
</textarea>
                    </td>
                </tr>
                
                <tr>
                    <td>Template</td>
                    <td><input type="text" name="template" class="w350" value="<?php echo $this->_tpl_vars['de']['template']; ?>
" ></td>
				</tr>
                
                <tr>
                    <td>SEO Title</td>
                    <td><input type="text" name="title" class="w350" value="<?php echo $this->_tpl_vars['de']['title']; ?>
" ></td>
				</tr>
                <tr>
                    <td>SEO keywords</td>
                    <td><input type="text" name="keywords" class="w350" value="<?php echo $this->_tpl_vars['de']['keywords']; ?>
" ></td>
				</tr>
                <tr>
                    <td>SEO description</td>
                    <td><input type="text" name="description" class="w350" value="<?php echo $this->_tpl_vars['de']['description']; ?>
" ></td>
				</tr>
                <tr>
            <td>调用留言板</td>
            <td>
            	<input type="radio" name="msg_online" value="1" id="open" <?php if ($this->_tpl_vars['de']['msg_online'] == 1): ?>checked="checked"<?php endif; ?>/><label for="open">开启</label>
                <input type="radio" name="msg_online" value="0" id="close" <?php if ($this->_tpl_vars['de']['msg_online'] != 1): ?>checked="checked"<?php endif; ?>/><label for="close">关闭</label>
           
          </tr>
                
                <tr>
                    <td>展示状态</td>
                    <td>
                    <input type="radio" name="con_statu" value="1" id="open" <?php if ($this->_tpl_vars['de']['con_statu'] == 1): ?>checked="checked"<?php endif; ?>/><label for="open">开启</label>
                    <input type="radio" name="con_statu" value="0" id="close" <?php if ($this->_tpl_vars['de']['con_statu'] != 1): ?>checked="checked"<?php endif; ?>/><label for="close">关闭</label>
                    </td>
                </tr>
                
                <tr>
                    <td>&nbsp;</td>
                    <td>
                    <input class="submit" type="submit" value="提交">
                    <input name="act" type="hidden" id="action" value="<?php if (! $_GET['editid']): ?>save<?php else: ?>edit<?php endif; ?>">
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
                    <th width="70" class="al">显示顺序</th>
                    <th class="al" width="200">显示名称</th>
                    <th class="al">调用地址</th>
                    <th width="100">模板</th>
                    <th width="100">状态</th>
                    <th width="100"></th>
                </tr>
                <?php $_from = $this->_tpl_vars['de']['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['list']):
?>
                <tr>
                    <td class="al"><input type="text" class="w50" maxlength="3" name="displayorder[<?php echo $this->_tpl_vars['list']['con_id']; ?>
]" value="<?php echo $this->_tpl_vars['list']['con_no']; ?>
" onbeforepaste="clipboardData.setData('text',clipboardData.getData('text').replace(/[^\d]/g,''))" onkeyup="value=value.replace(/[^\d]/g,'')" /></td>
                    
                    <td class="al"><?php echo $this->_tpl_vars['list']['con_title']; ?>
</td>
					<td class="al">
                    <?php if ($this->_tpl_vars['list']['con_linkaddr']): ?>                    
                    <input readonly="readonly" name="url[<?php echo $this->_tpl_vars['list']['con_id']; ?>
]" class="w250" type="text" value="<?php echo $this->_tpl_vars['list']['con_linkaddr']; ?>
" >
                    <?php else: ?>
                    <input readonly="readonly" name="url[<?php echo $this->_tpl_vars['list']['con_id']; ?>
]" class="w250" type="text" value="aboutus.php?type=<?php echo $this->_tpl_vars['list']['con_id']; ?>
">
                    <?php endif; ?>
                    </td>
                    <td><?php if ($this->_tpl_vars['list']['template']): ?><?php echo $this->_tpl_vars['list']['template']; ?>
<?php else: ?>Default<?php endif; ?></td>
                    <td><?php if ($this->_tpl_vars['list']['con_statu'] == 1): ?>开启<?php else: ?>关闭<?php endif; ?></td>
                    <td>
                    <a href="aboutus.php?operation=edit&editid=<?php echo $this->_tpl_vars['list']['con_id']; ?>
"><?php echo $this->_tpl_vars['editimg']; ?>
</a> 
                    <a onclick="return confirm('确定删除吗');" href="aboutus.php?delid=<?php echo $this->_tpl_vars['list']['con_id']; ?>
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
                	<td colspan="2">
                        <input type="hidden" name="act" value="op" />
                        <input type="submit" value="提交" />
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