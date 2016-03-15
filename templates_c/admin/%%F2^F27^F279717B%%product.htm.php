<?php /* Smarty version 2.6.20, created on 2016-03-15 10:08:19
         compiled from product.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'product.htm', 104, false),)), $this); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>产品管理</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="admin.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="../script/jquery-1.4.4.min.js"></script>
<script type="text/javascript" src="../script/moderate.js"></script>
</head>
<body>
<div class="container">
    <div class="flow">
        <div class="itemtitle">
            <h3>产品管理</h3>
            <ul>
                <li <?php if ($_GET['operation'] == ''): ?>class="current"<?php endif; ?>><a href="?m=<?php echo $_GET['m']; ?>
&s=product.php"><span>所有产品</span></a></li>
                <li <?php if ($_GET['operation'] == 'wait'): ?>class="current"<?php endif; ?>><a href="?m=<?php echo $_GET['m']; ?>
&s=product.php&operation=wait"><span>待审核</span></a></li>
                <li <?php if ($_GET['operation'] == 'down'): ?>class="current"<?php endif; ?>><a href="?m=<?php echo $_GET['m']; ?>
&s=product.php&operation=down"><span>违规下架产品</span></a></li>
                <?php if ($_GET['operation'] == 'edit'): ?>
                <li class="current"><a href="#"><span>修改</span></a></li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
    <div class="h35"></div>
    <?php if ($_GET['operation'] == 'edit'): ?>
    <form id="form" method="post">
    <table class="table table1">
        <tr>
            <td width="80">状态</td>
            <td>
            <?php $_from = $this->_tpl_vars['status']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['list']):
?>
            <?php if ($this->_tpl_vars['key']): ?>
            <label><input type="radio" name="status" value="<?php echo $this->_tpl_vars['key']; ?>
" /><?php echo $this->_tpl_vars['list']; ?>
</label>
            <?php endif; ?>
            <?php endforeach; endif; unset($_from); ?>
            </td>
        </tr>
        <tr>
            <td>备注</td>
            <td><textarea name="note" class="w245"></textarea></td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td>
            <input class="submit" type="submit" value="提交">
            <input name="act" type="hidden" id="action" value="add">
            </td>
        </tr>
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
                    <input type="hidden" name="s" value="product.php">
                    <input placeholder="请输入产品名称..." type="text" name="name" class="txt s w250" value="<?php echo $_GET['name']; ?>
"  />
                    <input placeholder="请输入店铺名称..." type="text" name="user" class="txt w150" value="<?php echo $_GET['user']; ?>
"  />
                    <input type="submit" value="搜索" />
                    </form>
                </div>
                <a class="refresh" href="?m=<?php echo $_GET['m']; ?>
&s=product.php"></a>
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
                <th colspan="2" class="al">产品名称</th>
                <th width="100">销售价</th>
                <th width="100">库存</th>
                <th width="80">竟价排名</th>
                <th width="80">状态</th>
                <th width="80">浏览</th>
                <th width="80">更新时间</th>
            </tr>
            <?php $_from = $this->_tpl_vars['de']['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['list']):
?>
            <tr>
                <td><input type="checkbox" value="<?php echo $this->_tpl_vars['list']['id']; ?>
" class="checkitem" onclick="tmodclick(this)" name="chk[]"></td>               
                <td>
                <a href="?s=cpmod.php&id=<?php echo $this->_tpl_vars['list']['id']; ?>
&<?php echo $this->_tpl_vars['url']; ?>
"><?php echo $this->_tpl_vars['editimg']; ?>
</a>
                </td>
                <td class="al" width="80" valign="top"><a target="_blank" href="../?m=product&s=detail&id=<?php echo $this->_tpl_vars['list']['id']; ?>
"><img class="img" alt="<?php echo $this->_tpl_vars['list']['pname']; ?>
" src="<?php echo $this->_tpl_vars['list']['pic']; ?>
_60X60.jpg" /></a></td>
                <td class="al" valign="top">
                <h4><a target="_blank" href="../?m=product&s=detail&id=<?php echo $this->_tpl_vars['list']['id']; ?>
"><?php echo $this->_tpl_vars['list']['pname']; ?>
</a></h4>
                
                <p>所属店铺：<?php echo $this->_tpl_vars['list']['company']; ?>
</p>
                <p>所属分类：<?php echo $this->_tpl_vars['list']['catname']; ?>
</p>
                <p>所属品牌：<?php echo $this->_tpl_vars['list']['brand']; ?>
</p>
                </td>
                <td><center><?php echo $this->_tpl_vars['config']['money']; ?>
 <?php echo $this->_tpl_vars['list']['price']; ?>
</center></td>
                <td><center><?php echo $this->_tpl_vars['list']['amount']; ?>
</center></td>
                <td><center><?php echo $this->_tpl_vars['list']['rank']; ?>
</center></td>
                <td><center><?php $this->assign('num', $this->_tpl_vars['list']['statu']); ?><?php if ($this->_tpl_vars['status'][$this->_tpl_vars['num']] == '违规下架'): ?><a style="cursor: pointer;color: red;" title="<?php echo $this->_tpl_vars['list']['down_reason']; ?>
"><?php echo $this->_tpl_vars['status'][$this->_tpl_vars['num']]; ?>
</a><?php else: ?><?php echo $this->_tpl_vars['status'][$this->_tpl_vars['num']]; ?>
<?php endif; ?></center></td>
                <td><center><?php echo $this->_tpl_vars['list']['read_nums']; ?>
</center></td>
                <td><center><?php echo ((is_array($_tmp=$this->_tpl_vars['list']['uptime'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%Y-%m-%d<br>%H:%M:%S") : smarty_modifier_date_format($_tmp, "%Y-%m-%d<br>%H:%M:%S")); ?>
</center></td>
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
            <span>个产品: </span>
        </h6>
        <p>
            <a id="button" key="up" href="javascript:;"><b>可售</b></a>
            <span>|</span>
            <a id="button" key="down1" href="javascript:;"><b>违规下架</b></a>
            <span>|</span>
            <a id="button" key="tj" href="javascript:;"><b>推荐</b></a>
            <span>|</span>
            <a id="button" key="del" href="javascript:;"><b>删除</b></a>
        </p>
        <p class="down_reason hidden">
            <input type="text" name="down_reason" class="txt s w150" placeholder="请输入违规下架理由"/>
            <a id="button" key="down" href="javascript:;"><b>确定</b></a>
        </p>
        <!--<p>
            <a id="button" key="edit" href="javascript:;">编辑</a>
            <span>|</span>
            <a id="button" key="del" href="javascript:;">删除</a>
        </p>-->
    </div>
    </form>
	</div>
    <?php endif; ?>
</div>
<script>
$("#button").live('click',function(){
    var key=$(this).attr("key")
	if(key=='edit')
	{
		window.location="module.php?m=product&s=product.php&operation=edit";
	}else if(key=='down1'){
        $(".down_reason").removeClass("hidden");
    }
	else
	{
		$("#act").val(key);		
		$("#form")[0].submit();
	}
	return false;
});
</script>    
</body>
</html>