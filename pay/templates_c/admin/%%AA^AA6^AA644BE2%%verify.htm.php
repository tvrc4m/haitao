<?php /* Smarty version 2.6.20, created on 2016-04-11 15:38:29
         compiled from verify.htm */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>支付会员管理</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="admin.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="../script/jquery-1.4.4.min.js"></script>
<script type="text/javascript" src="../script/moderate.js"></script>
</head>
<body>
<div class="container">
    <div class="flow">
        <div class="itemtitle">
            <h3>支付会员管理</h3>
            <?php if ($_GET['operation'] == 'edit'): ?>
            <ul>
            <li class="current"><a href="#"><span>编辑</span></a></li>
            </ul>
            <?php endif; ?>
		</div>
    </div>
    <div class="h35"></div>
    <table class="select_table">
        <tr>
            <td>
                <div class="select_box">
                    <form action="" method="get">
                    <input type="hidden" name="m" value="<?php echo $_GET['m']; ?>
">
                    <input type="hidden" name="s" value="verify.php">
                    <input placeholder="请输入邮箱..." type="text" name="email" class="txt s w250" value="<?php echo $_GET['email']; ?>
"  />
                    <input placeholder="请输入真实姓名..." type="text" name="name" class="txt w150" value="<?php echo $_GET['name']; ?>
"  />
                    <input type="submit" value="搜索" />
                    </form>
                </div>
                <a class="refresh" href="?m=<?php echo $_GET['m']; ?>
&s=member.php"></a>
            </td>
        </tr>
    </table>
	<div style="position: relative;" id="threadlist">   
    <form action="" method="post" id="form" name="form">
    <input type="hidden" name="act" id="act" value="op" />
    <table class="table product">
        <tbody>
            <tr class="header">
                <th width="12"></th>
                <th class="al" width="250">会员</th>
                <th class="al" width="150">真实姓名</th>
                <th class="al">身份证</th>
            </tr>
            <?php $_from = $this->_tpl_vars['de']['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['list']):
?>
            <tr>
                <td><input <?php if ($this->_tpl_vars['list']['real_name'] == 'administrator'): ?>disabled="disabled"<?php endif; ?> type="checkbox" value="<?php echo $this->_tpl_vars['list']['pay_id']; ?>
" class="checkitem" onclick="tmodclick(this)" name="chk[]"></td>
                <td class="al"><?php echo $this->_tpl_vars['list']['pay_email']; ?>
</td>
                <td class="al"><?php echo $this->_tpl_vars['list']['real_name']; ?>
</td>
                <td class="al"><?php echo $this->_tpl_vars['list']['identity_card']; ?>
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
                <td colspan="99" class="pages">
                <div class="fl">每页最多显示： 20条</div>
                <div class="page"><?php echo $this->_tpl_vars['de']['page']; ?>
</div>
				<div class="fr">共有<?php echo $this->_tpl_vars['de']['count']; ?>
条记录</div>
                </td>
            </tr>
        </tfoot>
    </table>
    
    <div id="mdly" class="hidden">
        <a onclick="$('#mdly').addClass('cpd');" href="javascript:;" class="min">最小化</a>
        <label>
        <input type="checkbox" onclick="if(!($('.max')[0].innerHTML = modclickcount = checkall(this.form, 'chk'))) {$('#mdly').hide();}" name="chkall">
        全选
        </label>
        <h6>
            <span>选中</span>
            <strong class="max" onclick="$('#mdly').removeClass('cpd');">0</strong>
            <span>个会员: </span>
        </h6>
        <p style="padding:18px 0 0;">
            <a id="button" key="pass" href="javascript:;">通过</a>
            <a id="button" key="no" href="javascript:;">不通过</a>
        </p>
    </div>
    </form>
	</div>
</div>
<script>
$("#button").live('click',function(){
	var key=$(this).attr("key")
	$("#act").val(key);		
	$("#form")[0].submit();
	return false;
});
</script>
</body>
</html>