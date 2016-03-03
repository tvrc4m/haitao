<?php /* Smarty version 2.6.20, created on 2016-03-03 11:39:54
         compiled from product_consult.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'count', 'product_consult.htm', 81, false),array('modifier', 'date_format', 'product_consult.htm', 90, false),)), $this); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>产品咨询</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="admin.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="../script/jquery-1.4.4.min.js"></script>
</head>
<body>
<div class="container">
    <div class="flow">
        <div class="itemtitle">
            <h3>产品咨询</h3>
            <ul>
                <li <?php if ($_GET['operation'] == ''): ?>class="current"<?php endif; ?>><a href="?m=product&s=product_consult.php"><span>全部咨询</span></a></li>
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
    <form action="" method="get">
    <input type="hidden" name="m" value="product">
    <input type="hidden" name="s" value="product_consult.php">
    <table class="select_table">
        <tbody>
            <tr>
                <td width="70">产品名称:</td>
                <td colspan="2"><input type="text" name="name" class="w250" value="<?php echo $_GET['name']; ?>
" /></td>
            </tr>
            <tr>
                <td width="70">咨询内容:</td>
                <td colspan="2"><input type="text" name="key" class="w250" value="<?php echo $_GET['key']; ?>
" /></td>
            </tr>
            <tr>    
                <td width="70">咨询分类:</td>
                <td width="50">
                <select name="status">
                	<option value="">请选择</option>
                    <option <?php if ($_GET['status'] == 1): ?> selected="selected"<?php endif; ?> value="1">未回复</option>
                    <option <?php if ($_GET['status'] == 2): ?> selected="selected"<?php endif; ?> value="2">回复</option>
                </select>
                </td>
                <td><input type="image" src="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/image/admin/search.gif" /></td>
            </tr>
        </tbody>
    </table>
    </form>
    <form action="" method="post" id="form" name="form">
    <input type="hidden" name="act" value="op" />
    <table class="table product">
        </thead>
        <tbody>
            <tr class="partition">
                <th width="1"></th>
                <th width="20">删</th>
                <th class="al" width="*">咨询内容</th>
                <th width="100">提问者</th>
                <th width="60">更新时间</th>
            </tr>
            <?php $_from = $this->_tpl_vars['de']['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
            <tr bgcolor="#EFF8FD">
            	<td colspan="4" class="al pl20">
                <a target="_blank" href="../?m=product&s=detail&id=<?php echo $this->_tpl_vars['item']['id']; ?>
"><?php echo $this->_tpl_vars['item']['pname']; ?>
</a>
                <strong class="red ml10"><?php echo $this->_tpl_vars['config']['money']; ?>
<?php echo $this->_tpl_vars['item']['price']; ?>
</strong>
                <span class="ml10">库存：<?php echo $this->_tpl_vars['item']['stock']; ?>
</span>
                </td>
                <td><a href="?m=product&s=product_consult.php&id=<?php echo $this->_tpl_vars['item']['id']; ?>
"><?php echo count($this->_tpl_vars['item']['consult']); ?>
条记录</a></td>
            </tr>   
            <?php $_from = $this->_tpl_vars['item']['consult']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['list']):
?>
            <tr>
                <td></td>
                <td><input type="checkbox" value="<?php echo $this->_tpl_vars['list']['id']; ?>
" class="checkitem" name="chk[]"></td>
                <td class="al"><?php if ($this->_tpl_vars['list']['status'] == 2): ?><?php echo $this->_tpl_vars['list']['question']; ?>
<?php else: ?><span class="red"><?php echo $this->_tpl_vars['list']['question']; ?>
<?php endif; ?></span></td>
               
                <td><?php echo $this->_tpl_vars['list']['member_name']; ?>
</td>
				<td><?php echo ((is_array($_tmp=$this->_tpl_vars['list']['question_time'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%Y-%m-%d<br>%H:%M:%S") : smarty_modifier_date_format($_tmp, "%Y-%m-%d<br>%H:%M:%S")); ?>
</td>
			</tr>
            <?php endforeach; endif; unset($_from); ?>
            <?php endforeach; else: ?>
            <tr>
                <td class="norecord" colspan="99"><i></i><span>暂无符合条件的数据记录</span></td>
            </tr>
            <?php endif; unset($_from); ?>
        </tbody>
        <tfoot>
            <tr>
            	<td></td>
            	<td colspan="5">
                <input type="checkbox" class="checkall" id="del">
                <input type="hidden" name="act" value="op" />
				<input type="submit" value="删除" />
                <div class="page"><?php echo $this->_tpl_vars['de']['page']; ?>
</div>
                </td>
            </tr>
        </tfoot>
    </table>
    </form>
</div>
</body>
</html>