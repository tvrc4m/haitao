<?php /* Smarty version 2.6.20, created on 2016-03-03 11:39:36
         compiled from nav.htm */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>导航设置</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="admin.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="../script/jquery-1.4.4.min.js"></script>
<script type="text/javascript" src="../script/jquery.validation.min.js"></script>
</head>
<body>
	<div class="container">
        <div class="flow">
            <div class="itemtitle">
                <h3>导航设置</h3>
                <ul>
                    <li <?php if ($_GET['operation'] == '' || $_GET['operation'] == '1'): ?>class="current"<?php endif; ?>><a href="nav.php"><span>主导航</span></a></li>
				</ul>
            </div>
        </div>
        <div class="h35"></div>
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
        <input type="hidden" name="navtype" value="<?php if ($_GET['operation']): ?><?php echo $_GET['operation']; ?>
<?php else: ?>1<?php endif; ?>" />
        <table class="table">
            <tbody>
                <tr class="header">
                    <th width="70" class="al">显示顺序</th>
                    <th class="al" width="260">名称</th>
                    <th class="al">链接</th>
                    <?php if ($_GET['operation'] != 2 && $_GET['operation'] != 3): ?>
                    <th class="al" width="150">选中标志</th>
                    <?php endif; ?>
                    <th width="80">类型</th>
                    <th width="80">可用</th>
                    <th width="80"></th>
                </tr>
                <?php $_from = $this->_tpl_vars['de']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['list']):
?>
                <tr>
                    <td class="al"><input type="text" class="w50" maxlength="3" name="displayorder[<?php echo $this->_tpl_vars['list']['id']; ?>
]" value="<?php echo $this->_tpl_vars['list']['displayorder']; ?>
" /></td>
                    
                    <td class="al">
                    <div>
                    <input type="text" name="name[<?php echo $this->_tpl_vars['list']['id']; ?>
]" value="<?php echo $this->_tpl_vars['list']['name']; ?>
" />
                    <?php if ($_GET['operation'] != 3): ?>
                    <a class="addchildboard" onclick="addrowdirect = 1;addrow(this, 1,<?php echo $this->_tpl_vars['list']['id']; ?>
)" href="javascript:void(0);">添加二级分类</a>
                    <?php endif; ?>
                    </div>
                    </td>
                    <td class="al">
                    <?php if ($this->_tpl_vars['list']['type'] == 1): ?>
                    <input type="text" name="url[<?php echo $this->_tpl_vars['list']['id']; ?>
]" value="<?php echo $this->_tpl_vars['list']['url']; ?>
" class="w400" />
                    <?php else: ?>
                    <input type="hidden" name="url[<?php echo $this->_tpl_vars['list']['id']; ?>
]" value="<?php echo $this->_tpl_vars['list']['url']; ?>
" class="w400" />
                    <?php echo $this->_tpl_vars['list']['url']; ?>

                    <?php endif; ?>
                    </td>
                    <?php if ($_GET['operation'] != 2 && $_GET['operation'] != 3): ?>
                    <td class="al">
                    <?php if ($this->_tpl_vars['list']['type'] == 1): ?>
                    <input type="text" name="identifier[<?php echo $this->_tpl_vars['list']['id']; ?>
]" value="<?php echo $this->_tpl_vars['list']['identifier']; ?>
" />
                    <?php else: ?>
                    <input type="hidden" name="identifier[<?php echo $this->_tpl_vars['list']['id']; ?>
]" value="<?php echo $this->_tpl_vars['list']['identifier']; ?>
" />
                    <?php echo $this->_tpl_vars['list']['identifier']; ?>

                    <?php endif; ?>
                    </td>
                    <?php endif; ?>
                    <td><?php if ($this->_tpl_vars['list']['type'] == 1): ?>自定义<?php else: ?>内置<?php endif; ?></td>
                    <td>
                    <input type="checkbox" class="fn" <?php if ($this->_tpl_vars['list']['available'] == 1): ?>checked="checked"<?php endif; ?> value="1" name="available[<?php echo $this->_tpl_vars['list']['id']; ?>
]" />
                    </td>
                    <td>
                    <?php if ($_GET['operation'] == 3): ?>
                    <a href="nav.php?operation=edit&editid=<?php echo $this->_tpl_vars['list']['id']; ?>
"><?php echo $this->_tpl_vars['editimg']; ?>
</a> 
                    <?php endif; ?>
                    
                    <?php if ($this->_tpl_vars['list']['type'] == 1): ?>
                    <a onclick="return confirm('确定删除吗');" href="nav.php?operation=<?php echo $_GET['operation']; ?>
&delid=<?php echo $this->_tpl_vars['list']['id']; ?>
"><?php echo $this->_tpl_vars['delimg']; ?>
</a> 
                    <?php endif; ?>
                    </td>
                </tr>
                <?php $_from = $this->_tpl_vars['list']['scat']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['slist']):
?>
                <tr>
                    <td class="al"><input type="text" class="w50" maxlength="3" name="displayorder[<?php echo $this->_tpl_vars['slist']['id']; ?>
]" value="<?php echo $this->_tpl_vars['slist']['displayorder']; ?>
" /></td>
                    <td class="al">
                    <div class="board"><input type="text" name="name[<?php echo $this->_tpl_vars['slist']['id']; ?>
]" value="<?php echo $this->_tpl_vars['slist']['name']; ?>
" /></div>
                    </td>
                    <td class="al"><input type="text" name="url[<?php echo $this->_tpl_vars['slist']['id']; ?>
]" value="<?php echo $this->_tpl_vars['slist']['url']; ?>
" class="w400" /></td>
                    <?php if ($_GET['operation'] != 2 && $_GET['operation'] != 3): ?>
                    <td class="al"></td>
                    <?php endif; ?>
                    <td><?php if ($this->_tpl_vars['slist']['type'] == 1): ?>自定义<?php else: ?>内置<?php endif; ?></td>
                    <td>
                    <input type="checkbox" class="fn" <?php if ($this->_tpl_vars['slist']['available'] == 1): ?>checked="checked"<?php endif; ?> value="1" name="available[<?php echo $this->_tpl_vars['slist']['id']; ?>
]" />
                    </td>
                    <td>
                    <?php if ($_GET['operation'] == 3): ?>
                    <a href="nav.php?operation=edit&editid=<?php echo $this->_tpl_vars['slist']['id']; ?>
"><?php echo $this->_tpl_vars['editimg']; ?>
</a> 
                    <?php endif; ?>
                    
                    <?php if ($this->_tpl_vars['slist']['type'] == 1): ?>
                    <a onclick="return confirm('确定删除吗');" href="nav.php?operation=<?php echo $_GET['operation']; ?>
&delid=<?php echo $this->_tpl_vars['slist']['id']; ?>
"><?php echo $this->_tpl_vars['delimg']; ?>
</a> 
                    <?php endif; ?>
                    </td>
                </tr>
                <?php endforeach; endif; unset($_from); ?>
                <?php endforeach; else: ?>
                <tr>
                    <td class="norecord" colspan="99"><i></i><span>暂无符合条件的数据记录</span></td>
                </tr>
                <?php endif; unset($_from); ?>
                <tr>
                    <td class="al" colspan="99"><div><a class="addtr" onclick="addrow(this, 0)" href="javascript:void(0);">添加一级分类</a></div></td>
                </tr>
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
        <script>
        var rowtypedata = [
            [
                [1,'<input type="text" class="w50" maxlength="3" name="newdisplayorder[]" value="0" />','al'], 
                [1, '<div><input name="newname[]" type="text" /><a href="javascript:;" class="deleterow" onClick="deleterow(this)">删除</a></div>','al'],
				[1, '<input name="newurl[]" class="w400" type="text" />','al'],
				<?php if ($_GET['operation'] != 2 && $_GET['operation'] != 3): ?>
				[1, '<input name="newidentifier[]" type="text" />','al'],
				<?php endif; ?>
                [3, '']
            ],
			[
				[1,'<input type="text" class="w50" maxlength="3" name="newdisplayorder1[{1}][]" value="" />','al'], 
				[1, '<div class="board"><input name="newname1[{1}][]"  type="text" /><a href="javascript:;" class="deleterow" onClick="deleterow(this)">删除</a></div>','al'],
				[1, '<input name="newurl1[{1}][]" class="w400" type="text" />','al'],
				[4, '']
			]
        ];
        var addrowdirect = 0;
        var addrowkey = 0;
        function addrow(obj, type) {
            var table = obj.parentNode.parentNode.parentNode.parentNode.parentNode;
            var tbody = obj.parentNode.parentNode.parentNode.parentNode;
            if(!addrowdirect) {
                var row = table.insertRow(obj.parentNode.parentNode.parentNode.rowIndex);
            } else {
                var row = table.insertRow(obj.parentNode.parentNode.parentNode.rowIndex + 1);
            }
            var typedata = rowtypedata[type];
            for(var i = 0; i <= typedata.length - 1; i++) {
                var cell = row.insertCell(i);
                cell.colSpan = typedata[i][0];
                var tmp = typedata[i][1];
                if(typedata[i][2]) {
                    cell.className = typedata[i][2];
                }
                tmp = tmp.replace(/\{(n)\}/g, function($1) {return addrowkey;});
                tmp = tmp.replace(/\{(\d+)\}/g, function($1, $2) {return addrow.arguments[parseInt($2) + 1];});
                cell.innerHTML = tmp;
            }
            addrowkey ++;
            addrowdirect = 0;
        }
        function deleterow(obj) {
            var table = obj.parentNode.parentNode.parentNode.parentNode.parentNode;
            var tr = obj.parentNode.parentNode.parentNode;
            table.deleteRow(tr.rowIndex);
        }
        </script>
    </div>
</body>
</html>