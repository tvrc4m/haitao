<?php /* Smarty version 2.6.20, created on 2016-03-28 14:21:55
         compiled from member.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'member.htm', 131, false),)), $this); ?>
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
            <h3>支付会员管理</h3>
            <?php if ($_GET['operation'] == 'edit'): ?>
            <ul>
            <li class="current"><a href="#"><span>编辑</span></a></li>
            </ul>
            <?php endif; ?>
		</div>
    </div>
    <div class="h35"></div>
    <?php if ($_GET['operation'] == 'edit'): ?>
        <form name="form" id="form" method="post">
        <input name="id" type="hidden" id="id" value="<?php echo $this->_tpl_vars['de']['pay_id']; ?>
">
 		<table class="table table1">
            <thead>
                <tr>
                    <th class="partition" colspan="99">会员信息</th>
                </tr>
            </thead>
            <tbody>
            <tr>
                <td width="100">邮箱</td>
                <td><?php echo $this->_tpl_vars['de']['pay_email']; ?>
</td>
            </tr>
            <?php if ($this->_tpl_vars['de']['pay_mobile']): ?>
            <tr>
                <td>手机</td>
                <td><?php echo $this->_tpl_vars['de']['pay_mobile']; ?>
</td>
            </tr>
            <?php endif; ?>
            <tr>
                <td>真实姓名</td>
                <td>
				<p><?php echo $this->_tpl_vars['de']['real_name']; ?>
</p>
                <p class="icon" style="margin-top:5px;">
                	<i class="fore1<?php if ($this->_tpl_vars['de']['identity_verify'] == 'false'): ?> f<?php endif; ?>"></i>
				</p>
                </td>
            </tr>
            <tr>
                <td>登录密码</td>
                <td>
                <input type="text" name="login_pass" class="w150" value="" />
                <p style="color:#CCC;">不填默认</p>
                </td>
            </tr><!--
            <tr>
                <td>支付密码</td>
                <td>
                <input type="text" name="pay_pass" class="w150" value="" />
                <p style="color:#CCC;">不填默认</p>
                </td>
            </tr>-->
           
            <tr>
                <td>&nbsp;</td>
                <td>
                <input class="submit" type="submit" value="提交">
                <input name="act" type="hidden" id="action" value="edit">
                </td>
            </tr>
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
                    <input type="hidden" name="s" value="member.php">
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
                <th width="30">操作</th>
                <th colspan="2" class="al">会员</th>
                <th width="150">预存款</th>
                <th width="120">最后登录</th>
            </tr>
            <?php $_from = $this->_tpl_vars['de']['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['list']):
?>
            <tr>
                <td><input <?php if ($this->_tpl_vars['list']['real_name'] == 'administrator'): ?>disabled="disabled"<?php endif; ?> type="checkbox" value="<?php echo $this->_tpl_vars['list']['pay_id']; ?>
" class="checkitem" onclick="tmodclick(this)" name="chk[]"></td>               
                <td>
               	<a href="module.php?m=payment&s=cashflow.php&operation=add&email=<?php echo $this->_tpl_vars['list']['pay_email']; ?>
">充值</a>
                <?php if ($this->_tpl_vars['list']['real_name'] != 'administrator'): ?>
               	<a href="module.php?m=payment&s=member.php&operation=edit&id=<?php echo $this->_tpl_vars['list']['pay_id']; ?>
">编辑</a><?php endif; ?>
                </td>
                <td class="al" width="80" valign="top"><img width="60" class="img" alt="<?php echo $this->_tpl_vars['list']['pname']; ?>
" src="../templates/default/image/avatar.png" /></td>
                <td class="al" valign="top">
                <h4 style="margin-bottom:5px;">
                    <?php if ($this->_tpl_vars['list']['real_name']): ?><?php echo $this->_tpl_vars['list']['real_name']; ?>
&nbsp;&nbsp;<?php endif; ?>
                    <span style="font-weight:normal;"><?php echo $this->_tpl_vars['list']['pay_email']; ?>
</span>
                </h4>
                <p>注册时间：<?php echo ((is_array($_tmp=$this->_tpl_vars['list']['regtime'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%Y-%m-%d&nbsp;%H:%M:%S") : smarty_modifier_date_format($_tmp, "%Y-%m-%d&nbsp;%H:%M:%S")); ?>
</p>
                <p class="icon">
                	<i class="fore1<?php if ($this->_tpl_vars['list']['identity_verify'] == 'false'): ?> f<?php endif; ?>"></i>
				</p>
                </td>
                <td>
                <p>可用<font color="red" style="margin:0 2px;"><b><?php echo $this->_tpl_vars['list']['cash']; ?>
</b></font>元</p>
                <p>冻结<font color="red" style="margin:0 2px;"><b><?php echo $this->_tpl_vars['list']['unreachable']; ?>
</b></font>元</p>
                </td>
                <td><?php echo ((is_array($_tmp=$this->_tpl_vars['list']['lastLoginTime'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%Y-%m-%d<br>%H:%M:%S") : smarty_modifier_date_format($_tmp, "%Y-%m-%d<br>%H:%M:%S")); ?>
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
            <a id="button" key="del" href="javascript:;">删除</a>
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