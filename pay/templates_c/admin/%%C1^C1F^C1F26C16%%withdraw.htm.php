<?php /* Smarty version 2.6.20, created on 2016-03-03 10:45:37
         compiled from withdraw.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'withdraw.htm', 73, false),)), $this); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>提现申请</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="admin.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="../script/jquery-1.4.4.min.js"></script>
<script type="text/javascript" src="../script/moderate.js"></script>
</head>
<body>
<style>
.icon{clear:both;}
.icon i{background:url(../image/admin/icon.png) no-repeat;float:left;width:24px;height:21px;margin:5px 5px 0 0;}
.icon i.fore1{background-position:-6px -101px;}
.icon i.fore1.f{background-position:-6px -1px;}
.icon i.fore2{background-position:-72px -101px;}
.icon i.fore2.f{background-position:-70px -1px;}
.icon i.fore3{background-position:-132px -100px;}
.icon i.fore3.f{background-position:-132px 0;}
</style>
<div class="container">
    <div class="flow">
        <div class="itemtitle">
            <h3>提现申请</h3>
            <?php if ($_GET['operation'] == 'edit'): ?>
            <ul>
            <li class="current"><a href="#"><span>操作</span></a></li>
            </ul>
            <?php endif; ?>
		</div>
    </div>
    <div class="h35"></div>
    <?php if ($_GET['operation'] == 'edit'): ?>
        <form name="form" id="form" method="post">
        <input name="id" type="hidden" id="id" value="<?php echo $this->_tpl_vars['de']['id']; ?>
">
        <input name="userid" type="hidden" id="userid" value="<?php echo $this->_tpl_vars['de']['pay_id']; ?>
">
 		<table class="table table1">
			<tbody>
            <tr>
                <td width="80">申请人</td>
                <td>
				<p><?php echo $this->_tpl_vars['de']['real_name']; ?>
 (<?php echo $this->_tpl_vars['de']['pay_email']; ?>
)</p>
                <p class="icon" style="margin-top:5px;">
                	<i class="fore1<?php if ($this->_tpl_vars['de']['identity_verify'] == 'false'): ?> f<?php endif; ?>"></i>
                	<i class="fore2<?php if ($this->_tpl_vars['de']['identity_verify'] == 'false' || $this->_tpl_vars['de']['mobile_verify'] == 'false'): ?> f<?php endif; ?>"></i>
                	<i class="fore3<?php if ($this->_tpl_vars['de']['mobile_verify'] == 'false'): ?> f<?php endif; ?>"></i>
                </p>
                </td>
            </tr>
           
            <tr>
                <td>提现银行</td>
                <td><?php echo $this->_tpl_vars['de']['bank']; ?>
</td>
            </tr>
            <tr>
                <td>银行卡号</td>
                <td><?php echo $this->_tpl_vars['de']['cardno']; ?>
</td>
            </tr>
            <tr>
                <td>开户人</td>
                <td><?php echo $this->_tpl_vars['de']['cardname']; ?>
</td>
            </tr>
            <tr>
                <td>提现金额</td>
                <td><b style="color:red;font-size:14px;"><?php echo $this->_tpl_vars['de']['amount']; ?>
</b></td>
            </tr>
            <tr>
                <td>服务费</td>
                <td><?php echo $this->_tpl_vars['de']['fee']; ?>
</td>
            </tr>
            <tr>
                <td>申请时间</td>
                <td><?php echo ((is_array($_tmp=$this->_tpl_vars['de']['add_time'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%Y-%m-%d&nbsp;%H:%M:%S") : smarty_modifier_date_format($_tmp, "%Y-%m-%d&nbsp;%H:%M:%S")); ?>
</td>
            </tr>
            <tr>
                <td>到账时间</td>
                <td><?php echo $this->_tpl_vars['de']['supportTimeName']; ?>
</td>
            </tr>
            <tr>
            	<td>操作</td>
            	<td>
                <?php if ($this->_tpl_vars['de']['is_succeed'] == 20): ?>完成
                <?php elseif ($this->_tpl_vars['de']['is_succeed'] == 50): ?>取消
                <?php else: ?>
                <?php if ($this->_tpl_vars['de']['is_succeed'] == 0): ?>
                <label><input type="radio" name="result" value="10" checked="checked" />处理中</label>
                <?php else: ?>
                <label><input type="radio" name="result" value="20" checked="checked" />完成</label>
                <?php endif; ?>
                <label><input type="radio" name="result" value="50" />取消</label>
                <?php endif; ?>
                </td>
            </tr>
            <?php if ($this->_tpl_vars['de']['is_succeed'] == 10 || $this->_tpl_vars['de']['is_succeed'] == 20): ?>
            <tr>
                <td>回执流水号</td>
                <td>
            	<?php if ($this->_tpl_vars['de']['is_succeed'] == '10'): ?>
                	<input type="text" name="bankflow" class="w250" value="" />
                <?php else: ?>
                	<?php echo $this->_tpl_vars['de']['bankflow']; ?>

                <?php endif; ?>
                </td>
            </tr>
           	<?php endif; ?>
            <tr>
                <td>备注</td>
                <td>
            	<?php if ($this->_tpl_vars['de']['is_succeed'] == '10' || $this->_tpl_vars['de']['is_succeed'] == '0'): ?>
                	<textarea name="con" class="w245"></textarea>
                <?php else: ?>
                	<?php echo $this->_tpl_vars['de']['con']; ?>

                <?php endif; ?>
                </td>
            </tr>
			<?php if ($this->_tpl_vars['de']['is_succeed'] == '10' || $this->_tpl_vars['de']['is_succeed'] == '0'): ?>
            <tr>
                <td>&nbsp;</td>
                <td>
                <input class="submit" type="submit" value="提交">
                <input name="act" type="hidden" id="action" value="edit">
                </td>
            </tr>
			<?php endif; ?>
            </tbody>
        </table>
        </form>
    <?php else: ?>
    <table class="select_table">
        <tr>
            <td>
                <div class="select_box">
                    <form action="" method="get">
                    <input type="hidden" name="m" value="<?php echo $_GET['m']; ?>
">
                    <input type="hidden" name="s" value="withdraw.php">
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
                <th class="al" colspan="2">申请人</th>
                <th width="150">提现金额</th>
                <th width="60">服务费</th>
                <th width="100">到账时间</th>
                <th width="150">提现银行</th>
                <th width="80">申请日期</th>
                <th width="80">状态</th>
                <th width="50">操作</th>
            </tr>
            <?php $_from = $this->_tpl_vars['de']['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['list']):
?>
            <tr>
            	<td></td>              
				<td class="al" width="80" valign="top"><img width="60" class="img" alt="<?php echo $this->_tpl_vars['list']['pname']; ?>
" src="../templates/default/image/avatar.png" /></td>
                <td class="al" valign="top">
                <h4 style="margin-bottom:5px;">
                    <?php echo $this->_tpl_vars['list']['real_name']; ?>
&nbsp;&nbsp;
                    <span style="font-weight:normal;"><?php echo $this->_tpl_vars['list']['pay_email']; ?>
</span>
                </h4>
                <p>注册时间：<?php echo ((is_array($_tmp=$this->_tpl_vars['list']['regtime'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%Y-%m-%d&nbsp;%H:%M:%S") : smarty_modifier_date_format($_tmp, "%Y-%m-%d&nbsp;%H:%M:%S")); ?>
</p>
                <p class="icon">
                	<i class="fore1<?php if ($this->_tpl_vars['list']['identity_verify'] == 'false'): ?> f<?php endif; ?>"></i>
                </p>
                </td>
                <td><font color="red"><b><?php echo $this->_tpl_vars['list']['amount']; ?>
</b></font></td>
                <td><?php echo $this->_tpl_vars['list']['fee']; ?>
</td>
                <td><?php echo $this->_tpl_vars['list']['supportTimeName']; ?>
</td>
                <td><?php echo $this->_tpl_vars['list']['bank']; ?>
</td>
                <td><?php echo ((is_array($_tmp=$this->_tpl_vars['list']['add_time'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%Y-%m-%d<br>%H:%M:%S") : smarty_modifier_date_format($_tmp, "%Y-%m-%d<br>%H:%M:%S")); ?>
</td>
                <td>
                <p>
                    <?php if ($this->_tpl_vars['list']['is_succeed'] == 10): ?>处理中
                    <?php elseif ($this->_tpl_vars['list']['is_succeed'] == 20): ?>提现成功
                    <?php elseif ($this->_tpl_vars['list']['is_succeed'] == 50): ?>取消
                    <?php else: ?>待操作
                    <?php endif; ?>
                </p>
               	<p><?php if ($this->_tpl_vars['list']['censor']): ?><?php echo $this->_tpl_vars['list']['censor']; ?>
<?php endif; ?></p>
                </td>
                <td><a href="module.php?m=payment&s=withdraw.php&operation=edit&id=<?php echo $this->_tpl_vars['list']['id']; ?>
">操作</a></td>
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
    <?php endif; ?>
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