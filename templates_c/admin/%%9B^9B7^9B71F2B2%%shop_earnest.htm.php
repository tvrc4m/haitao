<?php /* Smarty version 2.6.20, created on 2016-03-03 11:40:04
         compiled from shop_earnest.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'number_format', 'shop_earnest.htm', 69, false),array('modifier', 'date_format', 'shop_earnest.htm', 70, false),)), $this); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>保证金</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="admin.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="../script/jquery-1.4.4.min.js"></script>
</head>
<body>
	<div class="container">
        <div class="flow">
            <div class="itemtitle">
                <h3>保证金</h3>
                <ul>
                    <li class="current"><a href="?m=<?php echo $_GET['m']; ?>
&s=<?php echo $_GET['s']; ?>
"><span>管理</span></a></li>
                    <li><a href="?m=<?php echo $_GET['m']; ?>
&s=shop.php"><span>店铺管理</span></a></li>
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
        <table class="table">
            <tbody>
                <tr class="header">
                    <th width="30">删</th>
                    <th width="120" class="al">店主用户名</th>
                    <th class="al">商铺名称</th>
                    <th width="120">店铺分类</th>
                    <th width="120">店铺等级</th>
                    <th width="120">保证金</th>
                    <th width="120">交纳时间</th>
                    <th width="120">负责人</th>
                    <th width="100"></th>
                </tr>
                <?php $_from = $this->_tpl_vars['de']['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['list']):
?>
                <tr>
                    <td><input type="checkbox" value="<?php echo $this->_tpl_vars['list']['userid']; ?>
" class="checkitem" name="chk[]"></td>
                    <td class="al"><a target="_blank" href="../home.php?uid=<?php echo $this->_tpl_vars['list']['userid']; ?>
"><?php echo $this->_tpl_vars['list']['user']; ?>
</a></td>
                    <td class="al">
                    <a target="_blank" href="../shop.php?uid=<?php echo $this->_tpl_vars['list']['userid']; ?>
"><?php echo $this->_tpl_vars['list']['company']; ?>
</a>&nbsp;
                    <?php if ($this->_tpl_vars['list']['shop_auth'] == 1): ?>
                    <a target="_blank" href="<?php echo $this->_tpl_vars['list']['shop_auth_pic']; ?>
"><img align="absmiddle" src="../image/default/certification.gif" /></a>
                    <?php else: ?>
                        <?php if ($this->_tpl_vars['list']['shop_auth_pic']): ?><a target="_blank" href="<?php echo $this->_tpl_vars['list']['shop_auth_pic']; ?>
"><img align="absmiddle" src="../image/default/certification_no.gif" /></a><?php else: ?><?php endif; ?>
                    <?php endif; ?>
                    <?php if ($this->_tpl_vars['list']['shopkeeper_auth'] == 1): ?>
                    <a target="_blank" href="<?php echo $this->_tpl_vars['list']['shopkeeper_auth_pic']; ?>
"><img align="absmiddle" src="../image/default/certautonym.gif" /></a>
                    <?php else: ?>
                        <?php if ($this->_tpl_vars['list']['shopkeeper_auth_pic']): ?><a target="_blank" href="<?php echo $this->_tpl_vars['list']['shopkeeper_auth_pic']; ?>
"><img align="absmiddle" src="../image/default/certautonym_no.gif" /></a><?php else: ?><?php endif; ?>
                    <?php endif; ?>
                    </td>
                    <td><?php echo $this->_tpl_vars['list']['cat']; ?>
</td>
                    <td><?php echo $this->_tpl_vars['list']['grade']; ?>
</td>
                    <td><?php echo ((is_array($_tmp=$this->_tpl_vars['list']['money'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2) : number_format($_tmp, 2)); ?>
</td>
                    <td><?php echo ((is_array($_tmp=$this->_tpl_vars['list']['time'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%Y-%m-%d <br> %H:%M:%S") : smarty_modifier_date_format($_tmp, "%Y-%m-%d <br> %H:%M:%S")); ?>
</td>
                    <td><?php echo $this->_tpl_vars['list']['admin']; ?>
</td>
                    <td>
                    <a href="?m=<?php echo $_GET['m']; ?>
&s=shop.php&type=earnest&operation=edit&editid=<?php echo $this->_tpl_vars['list']['userid']; ?>
"><?php echo $this->_tpl_vars['editimg']; ?>
</a> 
                    <a onclick="return confirm('确定删除吗');" href="?m=<?php echo $_GET['m']; ?>
&s=<?php echo $_GET['s']; ?>
&delid=<?php echo $this->_tpl_vars['list']['userid']; ?>
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
    </div>
</body>
</html>