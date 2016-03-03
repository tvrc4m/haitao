<?php /* Smarty version 2.6.20, created on 2016-03-03 11:40:03
         compiled from shipping_address.htm */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>发货地址</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="admin.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="../script/jquery-1.4.4.min.js"></script>
</head>
<body>
	<div class="container">
        <div class="flow"> 
            <div class="itemtitle">
                <h3>发货地址</h3>
                <ul>
                    <li <?php if ($_GET['operation'] == ''): ?>class="current"<?php endif; ?>><a href="?m=<?php echo $_GET['m']; ?>
&s=<?php echo $_GET['s']; ?>
"><span>管理</span></a></li>
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
                    <th width="80" class="al">店铺ID</th>
                    <th width="80" class="al">店主用户名</th>
                    <th width="140" class="al">店铺名称</th>
                    <th width="80">收货人</th>
                    <th class="al">所在区域</th>
                    <th width="140">电话</th>
                    <th width="100">手机</th>
                    <th width="60">邮编</th>
                    <th width="30"></th>
                </tr>
                <?php $_from = $this->_tpl_vars['de']['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['list']):
?>
                <tr>
                    <td><input type="checkbox" value="<?php echo $this->_tpl_vars['list']['id']; ?>
" class="checkitem" name="chk[]"></td>
                    <td class="al"><?php echo $this->_tpl_vars['list']['userid']; ?>
</td>
                    <td class="al"><a target="_blank" href="../home.php?uid=<?php echo $this->_tpl_vars['list']['userid']; ?>
"><?php echo $this->_tpl_vars['list']['user']; ?>
</a></td>   
                    <td class="al"><a target="_blank" href="../shop.php?uid=<?php echo $this->_tpl_vars['list']['userid']; ?>
"><?php echo $this->_tpl_vars['list']['company']; ?>
</a></td>
                    <td><?php echo $this->_tpl_vars['list']['name']; ?>
</td>
                    <td class="al"><?php echo $this->_tpl_vars['list']['area']; ?>
 <?php echo $this->_tpl_vars['list']['addr']; ?>
</td>
                    <td><?php echo $this->_tpl_vars['list']['tel']; ?>
</td>
                    <td><?php echo $this->_tpl_vars['list']['mobile']; ?>
</td>
                    <td><?php echo $this->_tpl_vars['list']['post']; ?>
</td>
                    <td>
                    <a onclick="return confirm('确定删除吗');" href="?m=<?php echo $_GET['m']; ?>
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
    </div>
</body>
</html>