<?php /* Smarty version 2.6.20, created on 2016-03-03 10:45:39
         compiled from cashflow.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'cashflow.htm', 168, false),array('modifier', 'number_format', 'cashflow.htm', 169, false),)), $this); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>资金明细</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="admin.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="../script/jquery-1.4.4.min.js"></script>
<script language="javascript" src="../script/Calendar.js"></script>
<script type="text/javascript" src="../script/jquery.validation.min.js"></script>
<script language="javascript">
var cdr = new Calendar("cdr");
document.write(cdr);
cdr.showMoreDay = true;
</script>
</head>
<body>
<div class="container">
    <div class="flow">
        <div class="itemtitle">
            <h3>资金明细</h3>
            <ul>
                <li <?php if ($_GET['operation'] == ''): ?>class="current"<?php endif; ?>><a href="?m=<?php echo $_GET['m']; ?>
&s=<?php echo $_GET['s']; ?>
"><span>资金明细</span></a></li>
                <li <?php if ($_GET['operation'] == 'add'): ?>class="current"<?php endif; ?>><a href="?m=<?php echo $_GET['m']; ?>
&s=<?php echo $_GET['s']; ?>
&operation=add"><span>手动操作</span></a></li>
            </ul>
        </div>
    </div>
    <div class="h35"></div>
    <?php if ($_GET['operation'] == 'add' || $_GET['operation'] == 'edit'): ?>
    <script>
	$(function(){
		$('#form').validate({
			errorPlacement: function(error, element){
				element.next('.form-error').append(error);
			},      
			rules : {
				email:{
					required:true
				},
				cash:{
					required:true,
					digits:true
				}
			},
			messages : {
				email:{
					required:'请填写Email'
				},
				cash:{
					required:'请填写充值金额'
				}
			}
		});
	});
	</script>
    <form id="form" method="post">
     <table class="table table1">
        <tr>
            <td width="80">Email</td>
            <td>
            <input class="w250" name="email" id="email" value="<?php echo $_GET['email']; ?>
" type="text" />
            <div class="form-error"></div>
            </td>
        </tr>
        <tr>
            <td>增减类型</td>
            <td>
           <div class="catalogBox">
                <input type="hidden" value="+" name="type" id="type">
                <div class="select w215">
                    <span>增加</span>
                    <b></b>
                </div>
                <div style="display:none;" class="i-select w252">
                    <ul>
                        <li key="+" class="sub-line">增加</li>
                        <li key="-" class="sub-line">减少</li>
                    </ul>
                </div>
            </div>
            </td>
        </tr>
        <tr>
            <td>充值金额</td>
            <td>
            <input class="w250" name="cash" type="text" id="cash" maxlength="10" />
            <div class="form-error"></div>
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
                    <input type="hidden" name="s" value="cashflow.php">
                    <input placeholder="真实姓名" type="text" name="name" class="txt s w200" value="<?php echo $_GET['name']; ?>
" />
                    <div class="catalogBox">
                        <input type="hidden" value="<?php echo $_GET['type']; ?>
" name="type" id="type">
                        <div class="select">
                            <span>
                            <?php if ($_GET['type']): ?>
                			<?php $this->assign('n', $_GET['type']-1); ?>
                            <?php echo $this->_tpl_vars['payment_type'][$this->_tpl_vars['n']]; ?>

                            <?php else: ?>
                            全部类型
                            <?php endif; ?></span>
                            <b></b>
                        </div>
                        <div style="display:none;" class="i-select">
                            <ul>
                                <li key="" class="sub-line">全部类型</li>
                                <?php $_from = $this->_tpl_vars['payment_type']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['num'] => $this->_tpl_vars['list']):
?>
                                <li key="<?php echo $this->_tpl_vars['num']+1; ?>
"><?php echo $this->_tpl_vars['list']; ?>
</li>
                                <?php endforeach; endif; unset($_from); ?>
                            </ul>
                        </div>
                    </div>
                    <input onFocus="cdr.show(this);" class="txt c w95" type="text" name="stime" id="stime" value="<?php echo $_GET['stime']; ?>
"> 
                    <em class="fl mr5">-</em> 
                    <input onFocus="cdr.show(this);" class="txt c w95" type="text" name="etime" id="etime" value="<?php echo $_GET['etime']; ?>
">
                    <input type="submit" value="搜索" />
                </form>
                </div>
                <a class="refresh" href="?m=<?php echo $_GET['m']; ?>
&s=<?php echo $_GET['s']; ?>
"></a>
           </td>
        </tr>
    </table>
    <form action="" method="post">
    <table class="table">
        <tbody>
            <tr class="header">
                <th width="140" class="al">流水号</th>
                <th width="150" class="al">会员名称</th>
                <th width="100">创建时间</th>
                <th width="120">金额(元)</th>
                <th width="60">管理员</th>
                <th width="120">类型</th>
                <th class="al">描述</th>
				<th width="60">状态</th>
            </tr>
            <?php $_from = $this->_tpl_vars['de']['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['list']):
?>
            <tr>
                <td class="al"><?php echo $this->_tpl_vars['list']['flow_id']; ?>
</td>
                <td class="al">
                <?php if ($this->_tpl_vars['list']['pay_email'] != "admin@systerm.com"): ?>
                    <?php if ($this->_tpl_vars['list']['real_name']): ?>
                    	<?php echo $this->_tpl_vars['list']['real_name']; ?>

                    <?php else: ?>
                    	<?php echo $this->_tpl_vars['list']['pay_email']; ?>

                    <?php endif; ?>
                <?php else: ?>
                系统账户
                <?php endif; ?></td>
                <td><?php echo ((is_array($_tmp=$this->_tpl_vars['list']['time'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%Y-%m-%d&nbsp;%H:%M") : smarty_modifier_date_format($_tmp, "%Y-%m-%d&nbsp;%H:%M")); ?>
</td>
                <td><?php echo ((is_array($_tmp=$this->_tpl_vars['list']['price'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2) : number_format($_tmp, 2)); ?>
</td>
                <td><?php echo $this->_tpl_vars['list']['censor']; ?>
</td>
                <td><?php $this->assign('num', $this->_tpl_vars['list']['mold']); ?><?php echo $this->_tpl_vars['payment_type'][$this->_tpl_vars['num']]; ?>
</td>
                <td class="al"><?php echo $this->_tpl_vars['list']['note']; ?>
</td>
                <td><?php $this->assign('num1', $this->_tpl_vars['list']['statu']); ?><?php echo $this->_tpl_vars['payment_statu'][$this->_tpl_vars['num1']]; ?>
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
                <td class="pages" colspan="99">
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
    <?php endif; ?>
</div> 
<script>
$(function(){
	$(".select").click(function(){ 
		var obj=$(this);
		$(this).next().slideToggle("fast",function(){
			if($(obj).next().is(":visible")){
				$(document).one('click',function(){
					$(".select").next().slideUp("fast");
				});
			}
		});
	});
	$(".i-select li").click(function(){
		var str=$(this).html();
		$(this).parent().parent().prev().prev().attr("value",$(this).attr("key"));
		$(this).parent().parent().prev().children().html(str);
		$(this).parent().parent().slideToggle();
	});
});
</script>
</body>
</html>