<?php /* Smarty version 2.6.20, created on 2016-03-25 09:53:04
         compiled from cards.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'number_format', 'cards.htm', 145, false),array('modifier', 'date_format', 'cards.htm', 146, false),)), $this); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>充值卡管理</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="admin.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="../script/jquery-1.4.4.min.js"></script>
<script type="text/javascript" src="../script/jquery.validation.min.js"></script>
<script>
$(function(){
	$('#form').validate({
		errorPlacement: function(error, element){
			element.nextAll('.form-error').append(error);
		},      
		rules : {
			total_price:{
				required:true
			},
			num:{
				required:true
			},
			stime:{
				required:true
			},
			etime:{
				required:true
			}
			
		},
		messages : {
			total_price:{
				required:'请填写充值面额'
			},
			num:{
				required:'请填写生成数量'
			},
			stime:{
				required:'请填写有效时间'
			},
			etime:{
				required:'请填写有效时间'
			}
		}
	});
});
</script>
</head>
<body>
	<div class="container">
        <div class="flow">
            <div class="itemtitle">
                <h3>充值卡管理</h3>
                <ul>
                    <li <?php if ($_GET['operation'] == ''): ?>class="current"<?php endif; ?>><a href="?m=<?php echo $_GET['m']; ?>
&s=<?php echo $_GET['s']; ?>
"><span>管理</span></a></li>
                    <li <?php if ($_GET['operation'] == 'add'): ?>class="current"<?php endif; ?>><a href="?m=<?php echo $_GET['m']; ?>
&s=<?php echo $_GET['s']; ?>
&operation=add"><span>添加</span></a></li>
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
                        <th class="partition" colspan="99">充值卡</th>
                    </tr>
                </thead>
                
                <tbody>
                <tr>
                    <td width="100">充值面额</td>
                    <td>
                    <input name="total_price" id="total_price" type="text" class="w350" value="50"><div id="form-error" class="form-error"></div>
                    </td>
                </tr>
                <tr>
                    <td>有效时间</td>
                    <td>
						<script language="javascript" src="../script/Calendar.js"></script>
                        <script language="javascript">
                        var cdr = new Calendar("cdr");
                        document.write(cdr);
                        cdr.showMoreDay = true;
                        </script>
                        <input onFocus="cdr.show(this);" type="text" name="stime" id="stime" size="15" value=""> -
                        <input onFocus="cdr.show(this);" type="text" name="etime" id="etime" size="15" value="">
                        <div id="form-error" class="form-error"></div>
                    </td>
                </tr>
             
                <tr>
                    <td>生成数量</td>
                    <td>
                    <input name="num" id="num" type="text" class="w350" value="1">
                    <div id="form-error" class="form-error"></div>
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
                    <th width="200" class="al">卡号</th>
                    <th width="200">密码</th>
                    <th width="100">面额</th>
                    <th width="150">创建时间</th>
                    <th width="">有效时间</th>
                    <th width="100">状态</th>
                    <th width="100">使用人</th>
                    <th width="50">操作</th>
                </tr>
                <?php $_from = $this->_tpl_vars['de']['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['list']):
?>
                <tr>
                    <td><input type="checkbox" value="<?php echo $this->_tpl_vars['list']['id']; ?>
" class="checkitem" name="chk[]"></td>
                    <td class="al"><?php echo $this->_tpl_vars['list']['card_num']; ?>
</td>
                    <td><?php echo $this->_tpl_vars['list']['password']; ?>
</td>
                    <td><?php echo $this->_tpl_vars['config']['money']; ?>
 <?php echo ((is_array($_tmp=$this->_tpl_vars['list']['total_price'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2) : number_format($_tmp, 2)); ?>
</td>
					<td><?php echo ((is_array($_tmp=$this->_tpl_vars['list']['creat_time'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%Y-%m-%d&nbsp;%H:%M:%S") : smarty_modifier_date_format($_tmp, "%Y-%m-%d&nbsp;%H:%M:%S")); ?>
</td>
                    <td><?php echo ((is_array($_tmp=$this->_tpl_vars['list']['stime'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%Y-%m-%d") : smarty_modifier_date_format($_tmp, "%Y-%m-%d")); ?>
---<?php echo ((is_array($_tmp=$this->_tpl_vars['list']['etime'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%Y-%m-%d") : smarty_modifier_date_format($_tmp, "%Y-%m-%d")); ?>
</td>
                    <td><?php if ($this->_tpl_vars['list']['statu'] == 1): ?>已使用<?php else: ?>未使用<?php endif; ?></td>
                    <td><?php if ($this->_tpl_vars['list']['use_name']): ?><?php echo $this->_tpl_vars['list']['use_name']; ?>
<?php else: ?>无人使用<?php endif; ?></td>
                    <td><a onclick="return confirm('确定删除吗');" href="?m=<?php echo $_GET['m']; ?>
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
                	<td colspan="2">
                        <input type="checkbox" class="checkall" id="del">
                        <input type="hidden" name="act" value="op" />
                        <input type="submit" value="删除" />
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