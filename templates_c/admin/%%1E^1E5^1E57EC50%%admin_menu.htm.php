<?php /* Smarty version 2.6.20, created on 2016-03-01 09:37:01
         compiled from admin_menu.htm */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>常用操作管理</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="admin.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="../script/jquery-1.4.4.min.js"></script>
</head>
<body>
	<div class="container">
        <div class="flow">
            <div class="itemtitle">
                <h3>编辑常用操作</h3>
                <ul>
                    <li <?php if ($_GET['operation'] == ''): ?>class="current"<?php endif; ?>><a href="?m=<?php echo $_GET['m']; ?>
&s=<?php echo $_GET['s']; ?>
"><span>管理</span></a></li>
                </ul>
            </div>
        </div>
        <div class="h35"></div>
        <form action="" method="post">
        <table class="table">
            <tr class="header">
                <th width="70">显示顺序</th>
                <th class="al" width="200">名称</th>
                <th class="al">URL</th>
                <th width="70"></th>
            </tr>   
            <?php $_from = $this->_tpl_vars['de']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['list']):
?>
                <tr>
                    <td class="al"><input type="text" class="w50" maxlength="3" name="displayorder[<?php echo $this->_tpl_vars['list']['id']; ?>
]" value="<?php echo $this->_tpl_vars['list']['displayorder']; ?>
" onbeforepaste="clipboardData.setData('text',clipboardData.getData('text').replace(/[^\d]/g,''))" onkeyup="value=value.replace(/[^\d]/g,'')" /></td>
                    <td class="al"><input type="text" class="w150" name="name[<?php echo $this->_tpl_vars['list']['id']; ?>
]" value="<?php echo $this->_tpl_vars['list']['name']; ?>
" /></td>
                    <td class="al"><input type="text" class="w350" name="url[<?php echo $this->_tpl_vars['list']['id']; ?>
]" value="<?php echo $this->_tpl_vars['list']['url']; ?>
" /></td>
                    <td>
                    <a onclick="return confirm('确定删除吗');" href="?m=shop&s=shop_cat.php&delid=<?php echo $this->_tpl_vars['list']['id']; ?>
"><?php echo $this->_tpl_vars['delimg']; ?>
</a>
                   </td>
                </tr>
            <?php endforeach; else: ?>
            <tr>
                <td class="norecord" colspan="99"><i></i><span>暂无符合条件的数据记录</span></td>
            </tr>
            <?php endif; unset($_from); ?>
            <tbody>
                <tr>
                    <td class="al" colspan="99"><div><a class="addtr" onclick="addrow(this, 0)" href="javascript:void(0);">添加常用操作</a></div></td>
                </tr>
            </tbody>
            
            <tfoot>
                <tr>
                	<td colspan="3">
                        <input type="hidden" name="act" value="op" />
                        <input type="submit" name="submit" value="提交" />
                    </td>
                </tr>
            </tfoot>
        </table>
        </form>
    </div>
</body>
<script>
var rowtypedata = [
	[
		[1,'<input type="text" class="w50" maxlength="3" name="newdisplayorder[]" value="255" />','al'], 
		[1, '<div><input name="newname[]" class="w150" type="text" /><a href="javascript:;" class="deleterow" onClick="deleterow(this)">删除</a></div>','al'],
		[1, '<input name="newurl[]" class="w350" type="text" />','al'],
		[1, '']
	],
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
</html>