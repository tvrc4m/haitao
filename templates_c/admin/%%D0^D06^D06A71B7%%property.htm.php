<?php /* Smarty version 2.6.20, created on 2016-03-01 11:49:20
         compiled from property.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'in_array', 'property.htm', 78, false),array('modifier', 'count', 'property.htm', 146, false),)), $this); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>产品类型</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="admin.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="../script/jquery-1.4.4.min.js"></script>
<script type="text/javascript" src="../script/base.js"></script>
</head>
<body>
	<div class="container">
        <div class="flow"> 
            <div class="itemtitle">
                <h3>产品类型</h3>
            </div>
        </div>
        <div class="h35"></div>
        <table class="select_table">
            <tr>    
                <td class="pl0">
				<ul class="button">
                    <li class="button">
                        <a class="a_button" id="del_button" href="javascript:void();">删除</a>
                    </li>
                    <li class="button">
                        <a class="a_button" id="add" href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/admin/module.php?m=product&s=property.php&operation=add">添加类型</a>
                    </li>
                    <li class="button">
                        <a class="a_button" id="add" href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/admin/module.php?m=product&s=property.php&operation=taobao">淘宝导入</a>
                    </li>
                    <li class="button">
                        <a class="a_button" id="add" href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/admin/module.php?m=product&s=property.php&operation=setting">淘宝导入配置</a>
                    </li>
                </ul>
                </td>
                <td width="400">
                    <a class="refresh fr" href="?m=<?php echo $_GET['m']; ?>
&s=<?php echo $_GET['s']; ?>
"></a>
                	<div class="select_box fr">
                    <form action="" method="get">
                        <input type="hidden" name="m" value="<?php echo $_GET['m']; ?>
">
                        <input type="hidden" name="s" value="property.php">
                        <input placeholder="请输入类型名称..." type="text" name="key" class="txt s w250" value="<?php echo $_GET['key']; ?>
" />
                        <input type="submit" value="搜索" />
                    </form>
                    </div>
               </td>
            </tr>
        </table>
        <?php if ($_GET['operation'] == 'add' || $_GET['operation'] == 'edit'): ?>
        <form name="property" id="property" action="module.php?m=product&s=property.php" method="post">
        <input name="id" type="hidden" id="id" value="<?php echo $this->_tpl_vars['de']['id']; ?>
">
        <table class="table table1">
            <thead>
                <tr class="partition" >
                    <th class="al" colspan="99">&nbsp;产品类型</th>
                </tr>
            </thead>
           	<tbody>
            <tr>
                <td width="70">类型名称</td>
                <td>
                <input name="pname" id="name" type="text" class="w350" value="<?php echo $this->_tpl_vars['de']['name']; ?>
">
                <?php if ($this->_tpl_vars['de']['taobao_type_id']): ?>&nbsp;<img title="淘宝导入数据" align="absmiddle" src="../image/admin/taobao.gif" /><?php endif; ?>
                </td>
            </tr>
            </tbody>
		</table>
        <table class="table table1">
            <thead>
            <tr class="partition">
            	<td colspan="2">选择关联规格</td>
            </tr>
			</thead>
            <tbody>
            <tr>
            	<td>
                <?php $_from = $this->_tpl_vars['spec']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['list']):
?>
                <label><input <?php if ($this->_tpl_vars['de']['spec_id']): ?><?php if (((is_array($_tmp=$this->_tpl_vars['list']['id'])) ? $this->_run_mod_handler('in_array', true, $_tmp, $this->_tpl_vars['de']['spec_id']) : in_array($_tmp, $this->_tpl_vars['de']['spec_id']))): ?>checked="checked"<?php endif; ?><?php endif; ?> type="checkbox" name="spec[]" value="<?php echo $this->_tpl_vars['list']['id']; ?>
" /><?php echo $this->_tpl_vars['list']['name']; ?>
<?php if ($this->_tpl_vars['list']['taobao_spec_id']): ?>&nbsp;<img title="淘宝导入数据" align="top" src="../image/admin/taobao.gif" /><?php endif; ?></label>
                <?php endforeach; else: ?>
                <a href="module.php?m=product&s=spec.php&operation=add">添加规格</a>
                <?php endif; unset($_from); ?>
                </td>
            </tr>
            </tbody>
        </table>   
        <table class="table table1">
            <thead>
            <tr class="partition">
            	<td colspan="6">添加扩展属性</td>
            </tr>
			</thead>
            <tbody>
            <tr>
                <td width="60">&nbsp;排序</td>
                <td width="150">属性名</td>
                <td width="120">前台表现类型</td>
                <td>属性可选值&nbsp;例如：红色,紫色,白色,蓝色,黑色 其中","为半角字符</td>
                <td width="60">操作</td>
            </tr>
            <?php $_from = $this->_tpl_vars['de']['property']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['num'] => $this->_tpl_vars['list']):
?>
            <tr>
                <td><input type="text" class="w50" maxlength="2" name="displayorders[<?php echo $this->_tpl_vars['list']['id']; ?>
]" value="<?php echo $this->_tpl_vars['list']['displayorder']; ?>
" /></td>
                <td>
                <input type="text" name="names[<?php echo $this->_tpl_vars['list']['id']; ?>
]" value="<?php echo $this->_tpl_vars['list']['name']; ?>
" />
                <?php if ($this->_tpl_vars['list']['taobao_property_id']): ?>&nbsp;<img title="淘宝导入数据" align="absmiddle" src="../image/admin/taobao.gif" /><?php endif; ?>
                </td>
                <td><select name="selects[<?php echo $this->_tpl_vars['list']['id']; ?>
]">
                    <option value="1" <?php if ($this->_tpl_vars['list']['format'] == 'select' && $this->_tpl_vars['list']['is_search'] == 0): ?>selected="selected"<?php endif; ?> >下拉不可筛选</option>
                    <option value="2" <?php if ($this->_tpl_vars['list']['format'] == 'select' && $this->_tpl_vars['list']['is_search'] == 1): ?>selected="selected"<?php endif; ?>>下拉可筛选</option>
                    <option value="3" <?php if ($this->_tpl_vars['list']['format'] == 'text'): ?>selected="selected"<?php endif; ?> >输入项</option>
                    <option value="4" <?php if ($this->_tpl_vars['list']['format'] == 'checkbox'): ?>selected="selected"<?php endif; ?> >多选框</option>
                </select></td>
                <td><textarea rows="1" style="width:95%" name="items[<?php echo $this->_tpl_vars['list']['id']; ?>
]"><?php echo $this->_tpl_vars['list']['item']; ?>
</textarea><input type="hidden" name="property_id[<?php echo $this->_tpl_vars['list']['id']; ?>
]" value="<?php echo $this->_tpl_vars['list']['property_value_id']; ?>
" /></td>
                <td><div><a href="javascript:;" class="deleterow" onclick="deleterows(this)">删除</a></div></td>
            </tr>
            <?php endforeach; endif; unset($_from); ?>
            <tr>
                <td colspan="6"><div><a class="addtr" onClick="addrows(this,0)" href="javascript:void(0);">添加一个扩展属性</a></div>
                </td>
            </tr>
            </tbody>
        </table>
        <input class="submit" type="submit" onclick="return check()" value="提交">
        <input name="act" type="hidden" id="action" value="<?php if (! $_GET['editid']): ?>save<?php else: ?>edit<?php endif; ?>">
        </form>
        <span id="error"></span>
        <script type="text/javascript">
		function check()
		{				
			if(!$("#name").val())
			{
				error('error','对不起，类型名称还没有填写');
				return false;
			}
		}
		var rowtypedata = [
            [
				['<input type="text" maxlength="2" class="w50" name="displayorder[]" value="0" />'], 
                ['<input type="text" name="name[]" value="" />'], 
                ['<select name="select[]"><option value="1">下拉不可筛选</option><option value="2">下拉可筛选</option><option value="3">输入项</option><option value="4">多选框</option></select>'],
                ['<textarea rows="1" style="width:95%" name="item[]"></textarea>'],
				['<div><a href="javascript:;" class="deleterow" onClick="deleterows(this)">删除</a></div>']
            ]
        ];
        var addrowdirects = 0;
        var j = <?php if ($this->_tpl_vars['de']['value']): ?><?php echo count($this->_tpl_vars['de']['value']); ?>
<?php else: ?>1<?php endif; ?>;
        function addrows(obj, type) {
            var table = obj.parentNode.parentNode.parentNode.parentNode.parentNode;
            if(!addrowdirects) {
                var row = table.insertRow(obj.parentNode.parentNode.parentNode.rowIndex);
            } else {
                var row = table.insertRow(obj.parentNode.parentNode.parentNode.rowIndex + addrowdirects);
            }
            var typedata = rowtypedata[type];
            for(var i = 0; i <= typedata.length - 1; i++) {
                var cell = row.insertCell(i);
				var tmp = typedata[i][0];
                tmp = tmp.replace(/\{(n)\}/g, function($1) { return j;});
                cell.innerHTML = tmp;
            }
            addrowdirects = 0;
            j++;
        }
        function deleterows(obj) {
            var table = obj.parentNode.parentNode.parentNode.parentNode.parentNode;
            var tr = obj.parentNode.parentNode.parentNode;
            table.deleteRow(tr.rowIndex);
        }
        </script> 
        <?php elseif ($_GET['operation'] == 'setting'): ?>
        <form method="post">
        <table class="table table1">
            <thead>
                <tr class="partition" >
                    <th class="al" colspan="99">&nbsp;淘宝导入</th>
                </tr>
            </thead>
           	<tbody>
            <tr>
                <td width="70">App Key</td>
                <td>
                <input name="appkey" id="appkey" type="text" class="w350" value="<?php echo $this->_tpl_vars['taobao_config']['appkey']; ?>
" />
                </td>
            </tr>
            <tr>
                <td>App Secret</td>
                <td>
                <input name="secretKey" id="secretKey" type="text" class="w350"  value="<?php echo $this->_tpl_vars['taobao_config']['secretKey']; ?>
"  />
                &nbsp;&nbsp;
                <a target="_blank" href="http://open.taobao.com">获取</a>
                </td>
            </tr>
            </tbody>
		</table>
        <input type="hidden" name="act" value="setting" />
        <input class="submit" type="submit" onclick="return check()" value="提交">
        </form>
        <span id="error"></span>
        <script type="text/javascript">
		function check()
		{				
			if(!$("#appkey").val())
			{
				error('error','对不起，App Key还没有填写');
				return false;
			}
			if(!$("#secretKey").val())
			{
				error('error','对不起，App Secret还没有填写');
				return false;
			}
		}
		</script>
        <?php elseif ($_GET['operation'] == 'taobao'): ?>
        <form method="post">
        <table class="table table1">
            <thead>
                <tr class="partition" >
                    <th class="al" colspan="99">&nbsp;淘宝导入</th>
                </tr>
            </thead>
           	<tbody>
            <tr>
                <td width="70">类型名称</td>
                <td>
                <input name="pname" id="name" type="text" class="w350" />
                </td>
            </tr>
            <tr>
                <td>淘宝分类ID</td>
                <td>
                <input name="cid" id="cid" type="text" class="w350">
                &nbsp;&nbsp;
                <a target="_blank" href="http://api.taobao.com/apitools/apiTools.htm?spm=a219a.7395905.0.181&catId=3&apiName=taobao.itemcats.get&scopeId=">获取</a>&nbsp;&nbsp;
                <a target="_blank" href="http://api.taobao.com/apidoc/api.htm?spm=a219a.7395905.0.15&path=categoryId:3-apiId:121">帮助</a>
                </td>
            </tr>
            </tbody>
		</table>
        <input type="hidden" name="act" value="taobao" />
        <input class="submit" type="submit" onclick="return check()" value="提交">
        </form>
        <span id="error"></span>
        <script type="text/javascript">
		function check()
		{				
			if(!$("#name").val())
			{
				error('error','对不起，类型名称还没有填写');
				return false;
			}
			if(!$("#cid").val())
			{
				error('error','对不起，淘宝分类ID还没有填写');
				return false;
			}
		}
		</script>
        <?php else: ?>
        <form action="" name="form" id="form" method="post">
        <input type="hidden" name="act" value="op" />
        <table class="table">
            <tbody>
                <tr class="partition">
                    <th width="30" class="al"><input type="checkbox" class="checkall" id="del"></th>
                    <th width="50" class="al">操作</th>
                    <th class="al">类型名称</th>
                </tr>
                <?php $_from = $this->_tpl_vars['de']['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['list']):
?>
                <tr>
                    <td class="al"><input type="checkbox" value="<?php echo $this->_tpl_vars['list']['id']; ?>
" class="checkitem" name="chk[]"></td>
                    <td class="al">
                    <a genre="edit" href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/admin/module.php?m=product&s=property.php&operation=edit&editid=<?php echo $this->_tpl_vars['list']['id']; ?>
">编辑</a>
					</td>
                    <td class="al">
                    <?php if ($this->_tpl_vars['list']['taobao_type_id']): ?><img title="淘宝导入数据" align="top" src="../image/admin/taobao.gif" />&nbsp;<?php endif; ?>
                    <?php echo $this->_tpl_vars['list']['name']; ?>

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
                    <td colspan="99">
                    <div class="fl">每页最多显示： 20条</div>
                    <div class="page"><?php echo $this->_tpl_vars['de']['page']; ?>
</div>
                    <div class="fr">共有<?php echo $this->_tpl_vars['count']; ?>
条记录</div>
                    </td>
                </tr>
            </tfoot>
        </table>
        </form>
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
        $("#del_button").click(function () {
            $("#form")[0].submit();
            return false;
        });
        </script>
        <?php endif; ?> 
    </div>
</body>
</html> 