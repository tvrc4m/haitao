<?php /* Smarty version 2.6.20, created on 2016-03-03 13:00:39
         compiled from spec.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'truncate', 'spec.htm', 182, false),)), $this); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>产品规格</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="admin.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="../script/jquery-1.4.4.min.js"></script>
<script type="text/javascript" src="../script/base.js"></script>
</head>
<body>
	<div class="container">
        <div class="flow"> 
            <div class="itemtitle">
                <h3>产品规格</h3>
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
/admin/module.php?m=product&s=spec.php&operation=add">添加规格</a>
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
                        <input type="hidden" name="s" value="spec.php">
                        <input placeholder="请输入规格名称..." type="text" name="key" class="txt s w250" value="<?php echo $_GET['key']; ?>
" />
                        <input type="submit" value="搜索" />
                    </form>
                    </div>
               </td>
            </tr>
        </table>
        
        <?php if ($_GET['operation'] == 'add' || $_GET['operation'] == 'edit'): ?>
        <form name="spec" id="spec" method="post">
        <input name="id" type="hidden" id="id" value="<?php echo $this->_tpl_vars['de']['id']; ?>
">
        <table class="table table1">
            <thead>
                <tr>
                    <th class="partition" colspan="99">规格</th>
                </tr>
            </thead>
            <tbody>
            <tr>
                <td width="70">规格名称</td>
                <td colspan="2">
                <input name="spec_name" id="spec_name" type="text" class="w350" value="<?php echo $this->_tpl_vars['de']['name']; ?>
"><?php if ($this->_tpl_vars['de']['taobao_spec_id']): ?>&nbsp;<img title="淘宝导入数据" align="absmiddle" src="../image/admin/taobao.gif" /><?php endif; ?>
                </td>
            </tr>  
            <tr>
                <td width="70">属性值</td>
                <td width="70">排序</td>
                <td>值</td>
            </tr>
            <?php $_from = $this->_tpl_vars['de']['item']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['list']):
?>
            <tr>
            	<td></td>
                <td><input type="text" class="w50" value="<?php echo $this->_tpl_vars['list']['displayorder']; ?>
" maxlength="3" name="new_displayorder[<?php echo $this->_tpl_vars['list']['id']; ?>
]" /></td>
                <td><div><input type="text" class="w250" id="name" name="new_name[<?php echo $this->_tpl_vars['list']['id']; ?>
]" value="<?php echo $this->_tpl_vars['list']['name']; ?>
" /><?php if ($this->_tpl_vars['list']['taobao_spec_id']): ?>&nbsp;<img title="淘宝导入数据" align="absmiddle" src="../image/admin/taobao.gif" /><?php endif; ?><a href="javascript:void(0);" class="deleterow" onClick="deleterow(this);">删除</a></div></td>
            </tr>
            <?php endforeach; else: ?>
            <?php unset($this->_sections['name']);
$this->_sections['name']['name'] = 'name';
$this->_sections['name']['loop'] = is_array($_loop=5) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['name']['show'] = true;
$this->_sections['name']['max'] = $this->_sections['name']['loop'];
$this->_sections['name']['step'] = 1;
$this->_sections['name']['start'] = $this->_sections['name']['step'] > 0 ? 0 : $this->_sections['name']['loop']-1;
if ($this->_sections['name']['show']) {
    $this->_sections['name']['total'] = $this->_sections['name']['loop'];
    if ($this->_sections['name']['total'] == 0)
        $this->_sections['name']['show'] = false;
} else
    $this->_sections['name']['total'] = 0;
if ($this->_sections['name']['show']):

            for ($this->_sections['name']['index'] = $this->_sections['name']['start'], $this->_sections['name']['iteration'] = 1;
                 $this->_sections['name']['iteration'] <= $this->_sections['name']['total'];
                 $this->_sections['name']['index'] += $this->_sections['name']['step'], $this->_sections['name']['iteration']++):
$this->_sections['name']['rownum'] = $this->_sections['name']['iteration'];
$this->_sections['name']['index_prev'] = $this->_sections['name']['index'] - $this->_sections['name']['step'];
$this->_sections['name']['index_next'] = $this->_sections['name']['index'] + $this->_sections['name']['step'];
$this->_sections['name']['first']      = ($this->_sections['name']['iteration'] == 1);
$this->_sections['name']['last']       = ($this->_sections['name']['iteration'] == $this->_sections['name']['total']);
?>
            <tr>
            	<td></td>
                <td><input type="text" class="w50" maxlength="3" name="displayorder[]" value="<?php echo $this->_sections['name']['index']+1; ?>
" /></td>
                <td><input type="text" class="w250" id="name" name="name[]" /></td>
            </tr>
            <?php endfor; endif; ?>
            <?php endif; unset($_from); ?>
            <tr>
            	<td></td>
                <td colspan="2"><div><a class="addtr" onClick="addrow(this, 0,addrowkey)" href="javascript:void(0);">添加属性值</a></div></td>
            </tr>
           
            <tr>
                <td>排序</td>
                <td colspan="2">
                <input name="spec_displayorder" maxlength="2" id="spec_displayorder" type="text" class="w350" value="<?php echo $this->_tpl_vars['de']['displayorder']; ?>
">
                </td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td colspan="2">
                    <input class="submit" onclick="return check()" type="submit" value="提交">
                    <input name="act" type="hidden" id="action" value="<?php if (! $_GET['editid']): ?>save<?php else: ?>edit<?php endif; ?>">
                </td>
            </tr>
        </tbody>
        </table>
        </form>
        <span id="error"></span>
        <script type="text/javascript">
		function check()
		{				
			if(!$("#spec_name").val())
			{
				error('error','对不起，规格名称还没有填写');
				return false;
			}
			var name=$(".table").find("#name");
			var flag=1;
			$.each(name,function(i){
				if($(this).val()){flag=0;}
			});
			if(flag)
			{
				error('error','对不起，表单还没有填写完整');
				return false;
			}
		}
        var rowtypedata = [
            [
                [1,''],
				[1,'<input type="text" class="w50" maxlength="3" name="displayorder[]" value="{1}" />'], 
                [1, '<div><input name="name[]" id="name" class="w250" type="text" /><a href="javascript:;" class="deleterow" onClick="deleterow(this)">删除</a></div>'],
                [1, '']
            ],
        ];
        
        var addrowdirect = 0;
        var addrowkey=$("input[id='name']").length+1;
        function addrow(obj, type) {
            var table = obj.parentNode.parentNode.parentNode.parentNode.parentNode;
            if(!addrowdirect) {
                var row = table.insertRow(obj.parentNode.parentNode.parentNode.rowIndex);
            } else {
                var row = table.insertRow(obj.parentNode.parentNode.parentNode.rowIndex + addrowdirect);
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
        <?php else: ?>
        <form action="" name="form" id="form" method="post">
        <input type="hidden" name="act" value="op" />
        <table class="table">
            <tbody>
                <tr class="header">
                    <th width="30" class="pl20"><input type="checkbox" class="checkall" id="del"></th>
                    <th width="50" class="al">操作</th>
                    <th width="100" class="al">规格名称</th>
                    <th class="al">规格值列</th>
                </tr>
                <?php $_from = $this->_tpl_vars['de']['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['list']):
?>
                <tr>
                    <td class="pl20"><input type="checkbox" value="<?php echo $this->_tpl_vars['list']['id']; ?>
" class="checkitem" name="chk[]"></td>
                    <td class="al">
                    <a genre="edit" href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/admin/module.php?m=product&s=spec.php&operation=edit&editid=<?php echo $this->_tpl_vars['list']['id']; ?>
">编辑</a>
					</td>
                    <td class="al">
                    <?php if ($this->_tpl_vars['list']['taobao_spec_id']): ?><img title="淘宝导入数据" align="top" src="../image/admin/taobao.gif" />&nbsp;&nbsp;<?php endif; ?><?php echo $this->_tpl_vars['list']['name']; ?>
</td>
                    <td class="al"><?php if ($this->_tpl_vars['list']['item']): ?><?php echo ((is_array($_tmp=$this->_tpl_vars['list']['item'])) ? $this->_run_mod_handler('truncate', true, $_tmp, 150, '') : smarty_modifier_truncate($_tmp, 150, '')); ?>
<?php else: ?>NULL<?php endif; ?></td>
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