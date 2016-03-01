<?php /* Smarty version 2.6.20, created on 2016-03-01 09:39:19
         compiled from announcement.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'announcement.htm', 89, false),array('modifier', 'strip_tags', 'announcement.htm', 146, false),array('modifier', 'truncate', 'announcement.htm', 146, false),)), $this); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>公告</title>
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
			title:{
				required:true
			},
			
		},
		messages : {
			title:{
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
                <h3>公告</h3>
                <ul>
                    <li <?php if ($_GET['operation'] == ''): ?>class="current"<?php endif; ?>><a href="?m=announcement&s=announcement.php"><span>管理</span></a></li>
                    <li <?php if ($_GET['operation'] == 'add'): ?>class="current"<?php endif; ?>><a href="?m=announcement&s=announcement.php&operation=add"><span>添加</span></a></li>
                    <?php if ($_GET['operation'] == 'edit'): ?>
                    <li class="current"><a href="#"><span>修改</span></a></li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
        <div class="h35"></div>  
        <?php if ($_GET['operation'] == 'add' || $_GET['operation'] == 'edit'): ?>
            <form name="form" id="form" method="post">
            <input name="id" type="hidden" id="id" value="<?php echo $this->_tpl_vars['de']['id']; ?>
">
            <table class="table table1">
                <thead>
                    <tr>
                        <th class="partition" colspan="99">公告</th>
                    </tr>
                </thead>
                
                <tbody>
                <tr>
                    <td width="100">标题</td>
                    <td>
                    <input name="title" id="title" type="text" class="w350" value="<?php echo $this->_tpl_vars['de']['title']; ?>
"><div id="form-error" class="form-error"></div>
                    </td>
                </tr>
                
                <tr>
                    <td>外部链接</td>
                    <td>
                    <input name="url" type="text" class="w350" value="<?php echo $this->_tpl_vars['de']['url']; ?>
">
                    </td>
                </tr>
                
                <tr>
                    <td>公告内容</td>
                    <td>
                    	<script charset="utf-8" src="../lib/kindeditor/kindeditor-min.js"></script>
						<script>
						var editor;
						KindEditor.ready(function(K) {
							editor = K.create('textarea[name="content"]', {
								
							});
						});
						</script>
                        <textarea style="width:80%; height:300px" name="content"><?php echo $this->_tpl_vars['de']['content']; ?>
</textarea>
                    </td>
                </tr>
                
                <tr>
                    <td>发布时间</td>
                    <td>
                    <input name="create_time" id="create_time" type="text" class="w150 fl" value="<?php if ($this->_tpl_vars['de']['create_time']): ?><?php echo ((is_array($_tmp=$this->_tpl_vars['de']['create_time'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%Y-%m-%d %H:%M:%S") : smarty_modifier_date_format($_tmp, "%Y-%m-%d %H:%M:%S")); ?>
<?php else: ?><?php echo ((is_array($_tmp=$this->_tpl_vars['time'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%Y-%m-%d %H:%M:%S") : smarty_modifier_date_format($_tmp, "%Y-%m-%d %H:%M:%S")); ?>
<?php endif; ?>">
                    
                    <input type="button" onclick="document.getElementById('create_time').value='<?php echo ((is_array($_tmp=$this->_tpl_vars['time'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%Y-%m-%d %H:%M:%S") : smarty_modifier_date_format($_tmp, "%Y-%m-%d %H:%M:%S")); ?>
'" value="设为当前时间" class="btn">
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
                    <th width="30"></th>
                    <th width="70">显示顺序</th>
                    <th width="200" class="al">标题</th>
                    <th class="al">内容</th>
                    <th width="50">状态</th>
                    <th width="100">发布时间</th>
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
                    <td class="al"><?php echo $this->_tpl_vars['list']['title']; ?>
</td>
                    <td class="al"><?php if ($this->_tpl_vars['list']['url']): ?><?php echo $this->_tpl_vars['list']['url']; ?>
<?php else: ?><?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['list']['content'])) ? $this->_run_mod_handler('strip_tags', true, $_tmp) : smarty_modifier_strip_tags($_tmp)))) ? $this->_run_mod_handler('truncate', true, $_tmp, 100) : smarty_modifier_truncate($_tmp, 100)); ?>
<?php endif; ?></td>
                    <td><?php if ($this->_tpl_vars['list']['status'] == 1): ?>开启<?php else: ?>关闭<?php endif; ?></td>
                    <td><?php echo ((is_array($_tmp=$this->_tpl_vars['list']['create_time'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%Y-%m-%d <br> &nbsp;%H:%M:%S") : smarty_modifier_date_format($_tmp, "%Y-%m-%d <br> &nbsp;%H:%M:%S")); ?>
</td>
                    <td>
                    <a href="?m=announcement&s=announcement.php&operation=edit&editid=<?php echo $this->_tpl_vars['list']['id']; ?>
"><?php echo $this->_tpl_vars['editimg']; ?>
</a> 
                    <a onclick="return confirm('确定删除吗');" href="?m=announcement&s=announcement.php&delid=<?php echo $this->_tpl_vars['list']['id']; ?>
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
                        <input type="checkbox" class="checkall" id="del">
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