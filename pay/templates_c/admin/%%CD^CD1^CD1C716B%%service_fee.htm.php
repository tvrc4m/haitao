<?php /* Smarty version 2.6.20, created on 2016-03-03 10:45:41
         compiled from service_fee.htm */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>服务费配置</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="admin.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="../script/jquery-1.4.4.min.js"></script>
<script type="text/javascript" src="../script/my_lightbox.js"></script>
</head>
<body>
	<div class="container">
        <div class="flow">
            <div class="itemtitle">
                <h3>服务费配置</h3>
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
        <table class="table">
            <tbody>
                <tr class="header partition" >
                    <th width="30"></th>
                    <th class="al">到账时间</th>
                    <th width="200" class="al">服务费率</th>
                    <th width="200" class="al">服务费下限</th>
                    <th width="200" class="al">服务费上限</th>
                    <th width="50"></th>
                </tr>
                <?php $_from = $this->_tpl_vars['de']['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['list']):
?>
                <tr>
                    <td><input <?php if ($this->_tpl_vars['key'] < 2): ?>disabled="disabled"<?php endif; ?>type="checkbox" value="<?php echo $this->_tpl_vars['list']['id']; ?>
" class="checkitem" name="chk[]"></td>
                    <td class="al"><input type="text" class="w100" name="name[<?php echo $this->_tpl_vars['list']['id']; ?>
]" value="<?php echo $this->_tpl_vars['list']['name']; ?>
" /></td>
                    <td class="al"><input type="text" class="w100" name="fee_rates[<?php echo $this->_tpl_vars['list']['id']; ?>
]" value="<?php echo $this->_tpl_vars['list']['fee_rates']; ?>
" /></td>
                    <td class="al"><input type="text" class="w100" name="fee_min[<?php echo $this->_tpl_vars['list']['id']; ?>
]" value="<?php echo $this->_tpl_vars['list']['fee_min']; ?>
" /></td>
                    <td class="al"><input type="text" class="w100" name="fee_max[<?php echo $this->_tpl_vars['list']['id']; ?>
]" value="<?php echo $this->_tpl_vars['list']['fee_max']; ?>
" /></td>
                    <td>
                    <?php if ($this->_tpl_vars['key'] > 2): ?>
					<a onclick="return confirm('确定删除吗');" href="?m=<?php echo $_GET['m']; ?>
&s=<?php echo $_GET['s']; ?>
&delid=<?php echo $this->_tpl_vars['list']['id']; ?>
"><?php echo $this->_tpl_vars['delimg']; ?>
</a>
                    <?php endif; ?>
                    </td>
                </tr>
                <?php endforeach; else: ?>
                <tr>
                    <td class="norecord" colspan="99"><i></i><span>暂无符合条件的数据记录</span></td>
                </tr>
                <?php endif; unset($_from); ?>
            </tbody>
            <tbody>
                <tr>
                    <td></td>
                    <td colspan="99" class="al"><div><a class="addtr" onclick="addrow(this, 0, addrowkey)" href="javascript:void(0);">添加</a></div></td>
                </tr>
            </tbody>
            <tfoot>
                <tr>
                	<td colspan="99">
                        <input type="checkbox" class="checkall" id="del">
                        <input type="hidden" name="act" value="op" />
                        <input type="submit" name="submit" value="提交" />
                        <div class="page"><?php echo $this->_tpl_vars['de']['page']; ?>
</div>
                    </td>
                </tr>
            </tfoot>
        </table>
        </form>
    </div>
<script>
var rowtypedata = [
	[
		[1, ''], 
		[1, '<div><input name="newname[]" class="100" type="text" /><a href="javascript:;" class="deleterow" onClick="deleterow(this)">删除</a></div>','al'],
		[1, '<input name="newfee_rates[]" class="w100" value="" type="text" />','al'],
		[1, '<input name="newfee_min[]" class="w100"  value="2" type="text" />','al'],
		[1, '<input name="newfee_max[]" class="w100"  value="25" type="text"  />','al'],
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
</body>
</html>