<?php /* Smarty version 2.6.20, created on 2016-03-03 11:38:11
         compiled from voucher.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'voucher.htm', 117, false),)), $this); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>会员等级</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="admin.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="../script/jquery-1.4.4.min.js"></script>
<script type="text/javascript" src="../script/jquery.validation.min.js"></script>
<script type="text/javascript" src="../script/my_lightbox.js"></script>
<script type="text/javascript" src="../script/Calendar.js"></script>
<script type="text/javascript">
var cdr = new Calendar("cdr");
document.write(cdr);
cdr.showMoreDay = true;
</script>
</head>
<body>
	<div class="container">
            <div class="flow"> 
                <div class="itemtitle">
                    <h3>代金券管理</h3>
                    <ul>
                        <li <?php if ($_GET['operation'] == ''): ?>class="current"<?php endif; ?>><a href="?m=voucher&s=voucher.php"><span>店铺代金券管理</span></a></li>
                        <li <?php if ($_GET['operation'] == 'apply'): ?>class="current"<?php endif; ?>><a href="?m=voucher&s=voucher.php&operation=apply"><span>应用申请</span></a></li>                       <li <?php if ($_GET['operation'] == 'config'): ?>class="current"<?php endif; ?>><a href="?m=voucher&s=voucher.php&operation=config"><span>配置项</span></a></li>
                    </ul>
                </div>
            </div>
            <div class="h35"></div>
            <?php if (! $_GET['operation']): ?>
            <div class="">
                <table class="select_table">
                <tr>
                    <td>
                        <div class="select_box">
                            <form action="" method="get">
                            <input type="hidden" name="m" value="voucher">
                            <input type="hidden" name="s" value="voucher.php">
                            <input placeholder="请输入店铺名称..." type="text" name="name" class="txt s w250" value="<?php echo $_GET['name']; ?>
"  />

                            <input readonly="readonly" onFocus="cdr.show(this);" class="txt c w100" type="text" name="stime" id="stime" value="<?php echo $_GET['stime']; ?>
" placeholder="请选择创建时间"> 
                            <em class="fl mr5">-</em> 
                            <input readonly="readonly" onFocus="cdr.show(this);" class="txt c w100" type="text" name="etime" id="etime" value="<?php echo $_GET['etime']; ?>
" placeholder="请选择过期时间">
                            <div class="catalogBox">
                                <input type="hidden" value="<?php echo $_GET['grade']; ?>
" name="status" id="status">
                                <div class="select">
                                    <span>
                                    <?php if ($_GET['status'] == 1): ?>
                                        有效
                                    <?php elseif ($_GET['status'] == 2): ?>
                                    失效
                                    <?php else: ?>
                                        状态
                                    <?php endif; ?></span>
                                    <b></b>
                                </div>
                                <div style="display:none;" class="i-select">
                                    <ul>
                                        <li key="" class="sub-line">状态</li>
                                        <li key="1">有效</li>
                                        <li key="2">失效</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="catalogBox">
                                <input type="hidden" value="<?php echo $_GET['isindesx']; ?>
" name="isindesx" id="isindesx">
                                <div class="select">
                                    <span>
                                    <?php if ($_GET['isindesx'] == 2): ?>
                                        已推荐
                                    <?php elseif ($_GET['isindesx'] == 1): ?>
                                    未推荐
                                    <?php else: ?>
                                        是否推荐
                                    <?php endif; ?></span>
                                    <b></b>
                                </div>
                                <div style="display:none;" class="i-select">
                                    <ul>
                                        <li key="" class="sub-line">是否推荐</li>
                                        <li key="2">已推荐</li>
                                        <li key="1">未推荐</li>
                                    </ul>
                                </div>
                            </div>
                            <input type="submit" value="搜索" />
                            </form>
                        </div>
                        <a class="refresh" href="?m=voucher&s=voucher.php"></a>
                    </td>
                </tr>
            </table>
           <div style="position: relative;" id="threadlist">   
               <div class="tips_i">手工设置代金券失效后,用户将不能领取该代金券,但是已经领取的代金券仍然可以使用</div>
                <table class="table">
                    <tbody>
                        <tr class="header">
                            <th width="240" class="al">店铺名称</th>
                            <th class="al" width="240">代金券名称</th>
                            <th width="100" class="al">面额</th>
                            <th width="80" class="al">消费金额</th>
                            <th width="180" >有效期</th>
                            <th width="80">添加时间</th>
                            <th width="80">状态</th>
                            <th width="70">推荐</th>
                            <th width="70">操作</th>
                        </tr>
                    </tbody>
                    <?php $_from = $this->_tpl_vars['re']['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['vo']):
?>
                    <tr>
                        <td><?php echo $this->_tpl_vars['vo']['shop_name']; ?>
</td>
                        <td><?php echo $this->_tpl_vars['vo']['name']; ?>
</td>
                        <td><?php echo $this->_tpl_vars['vo']['price']; ?>
</td>
                        <td><?php echo $this->_tpl_vars['vo']['limit']; ?>
</td>
                        <td class="center"><?php echo ((is_array($_tmp=$this->_tpl_vars['vo']['start_time'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%Y-%m-%d") : smarty_modifier_date_format($_tmp, "%Y-%m-%d")); ?>
~ <?php echo ((is_array($_tmp=$this->_tpl_vars['vo']['end_time'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%Y-%m-%d") : smarty_modifier_date_format($_tmp, "%Y-%m-%d")); ?>
</td>
                        <td class="center"><?php echo ((is_array($_tmp=$this->_tpl_vars['vo']['start_time'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%Y-%m-%d") : smarty_modifier_date_format($_tmp, "%Y-%m-%d")); ?>
</td>
                        <td class="center"><?php if ($this->_tpl_vars['vo']['status'] == 1): ?>有效<?php else: ?>失效<?php endif; ?></td>
                        <td class="center"><?php if ($this->_tpl_vars['vo']['isindex'] == 1): ?>已推荐<?php else: ?>未推荐<?php endif; ?></td>
                        <td class="center"><?php if ($this->_tpl_vars['vo']['isindex'] == 1): ?><a href="module.php?m=voucher&s=voucher.php&delindex=<?php echo $this->_tpl_vars['vo']['id']; ?>
">取消推荐</a><?php else: ?><a href="module.php?m=voucher&s=voucher.php&addindex=<?php echo $this->_tpl_vars['vo']['id']; ?>
">推荐</a><?php endif; ?><br/>
                            <?php if ($this->_tpl_vars['vo']['status'] == 1): ?><a onclick="return confirm('手动修改代金券失效状态后将不可恢复，确定吗？')" href="module.php?m=voucher&s=voucher.php&delstatus=<?php echo $this->_tpl_vars['vo']['id']; ?>
">失效</a><?php endif; ?>
                        </td>
                    </tr>
                    <?php endforeach; else: ?>
                    <tr>
                         <td colspan="12" class="norecord"><i></i><span>没有符合条件的记录</span></td>
                    </tr>
                    <?php endif; unset($_from); ?>
                    <tr>
                        <td colspan="12"><div class="page>"<?php echo $this->_tpl_vars['re']['page']; ?>
</div></td>
                    </tr>
                </table>
            </div>
        </div>
        <?php elseif ($_GET['operation'] == 'apply'): ?>
        <div>
            <table class="select_table">
                <tr>
                    <td>
                        <div class="select_box">
                            <form action="" method="get">
                            <input type="hidden" name="m" value="voucher">
                            <input type="hidden" name="s" value="voucher.php">
                            <input placeholder="请输入店铺名称..." type="text" name="name" class="txt s w250" value="<?php echo $_GET['name']; ?>
"  />
                             <input type="submit" value="搜索" />
                            </form>
                        </div>
                    </td>
                </tr>
            </table>
            <table class="table">
                    <tbody>
                        <tr class="header">
                            <th width="240" class="al">店铺名称</th>
                            <th width="120" class="al">开始时间</th>
                            <th width="120" class="al">结束时间</th>
                        </tr>
                    </tbody>
                    <?php $_from = $this->_tpl_vars['re']['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['vo']):
?>
                    <tr>
                        <td><?php echo $this->_tpl_vars['vo']['shop_name']; ?>
</td>
                        <td><?php echo ((is_array($_tmp=$this->_tpl_vars['vo']['start_time'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%Y-%m-%d") : smarty_modifier_date_format($_tmp, "%Y-%m-%d")); ?>
</td>
                        <td><?php echo ((is_array($_tmp=$this->_tpl_vars['vo']['end_time'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%Y-%m-%d") : smarty_modifier_date_format($_tmp, "%Y-%m-%d")); ?>
</td>
                    </tr>
                    <?php endforeach; else: ?>
                    <tr>
                         <td colspan="12" class="norecord"><i></i><span>没有符合条件的记录</span></td>
                    </tr>
                    <?php endif; unset($_from); ?>
                    <tr>
                        <td colspan="12"><div class="page>"<?php echo $this->_tpl_vars['re']['page']; ?>
</div></td>
                    </tr>
            </table>
        </div>
        <?php elseif ($_GET['operation'] == 'amount' && ! $_GET['act']): ?>
        <div class="">
            <div class="tips_i">管理员规定代金券面额，店铺发放代金券时面额从规定的面额中选择</div>
             <table class="table">
                    <tbody>
                        <tr class="header">
                            <th width="240" class="al">名称</th>
                            <th width="120" class="al">代金券面额(元)</th>
                            <th width="120px" class="al">兑换积分数</th>
                            <th width="120px" class="al">操作</th>
                        </tr>
                    </tbody>
                    <?php $_from = $this->_tpl_vars['re']['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['vo']):
?>
                    <tr>
                        <td align="center"><?php echo $this->_tpl_vars['vo']['name']; ?>
</td>
                        <td><?php echo $this->_tpl_vars['vo']['price']; ?>
</td>
                        <td><?php echo $this->_tpl_vars['vo']['points']; ?>
</td>
                        <td><a href="module.php?m=voucher&s=voucher.php&operation=amount&act=edit&id=<?php echo $this->_tpl_vars['vo']['id']; ?>
">编辑</a> <a onclick="return confirm('确定删除');" href="module.php?m=voucher&s=voucher.php&operation=amount&delid=<?php echo $this->_tpl_vars['vo']['id']; ?>
">删除</a></td>
                    </tr>
                    <?php endforeach; else: ?>
                    <tr>
                         <td colspan="12">没有符合条件的记录</td>
                    </tr>
                    <?php endif; unset($_from); ?>
                    <tr>
                        <td colspan="12"><div class="page>"<?php echo $this->_tpl_vars['re']['page']; ?>
</div></td>
                    </tr>
            </table>
        </div>
        <?php elseif ($_GET['operation'] == 'amount' && $_GET['act']): ?>
        <div class="select_box select_box_t">
             <div class="tips_i">管理员规定代金券面额，店铺发放代金券时面额从规定的面额中选择</div>
             <form method="post" action="">
                 <table class="table">
                    <tr>
                        <td width="180px;"> * 代金券面额(元):　</td>
                        <td><input type="text"  class="text w250" name="price" onblur="this.value=isNaN(this.value*1)?1:this.value*1" value="<?php echo $this->_tpl_vars['re']['price']; ?>
" /></td>
                    </tr>
                <tr>
                    <td>*名称:　</td>
                    <td><input type="text"  class="text w250" name="name" value="<?php echo $this->_tpl_vars['re']['name']; ?>
"　placeholder="如：10元" /></td>
                </tr>
                <tr>
                    <td >* 积分兑换点数:　</td>
                    <td> <input type="text"  class="text w250" name="points" onblur="this.value=isNaN(this.value*1)?1:this.value*1" value="<?php if ($this->_tpl_vars['re']['points']): ?><?php echo $this->_tpl_vars['re']['points']; ?>
<?php else: ?>0<?php endif; ?>" /></td>
                </tr>
                <tr>
                    <td ></td>
                    <td> <?php if ($this->_tpl_vars['re']['id']): ?><input type="hidden" name="id" value="<?php echo $this->_tpl_vars['re']['id']; ?>
"/><input type="hidden" name="act" value="edit_amount"/><?php else: ?><input type="hidden" name="act" value="add_amount"/><?php endif; ?>
                        <input type="submit" name="submit" value="提交"/></td>
                </tr>
                 </table>
            </form>
             <script>
                $("form").submit(function(){
                    if(!$("input[name='price']").val())
                    {
                        $("input[name='price']").focus();
                        alert("面额填写错误")
                        return false;
                    }
                    if(!$("input[name='name']").val())
                    {
                        $("input[name='name']").focus();
                        alert("名称不能为空")
                        return false;
                    }
                })
             </script>
        </div>
        <?php else: ?>
        <div class=" select_box select_box_t">
            <div class="tips_i"><b>本应用业务逻辑流程：</b><br/>　1、平台方首先设置好配置项。<br/>　2、商家根据平台方设置的价格购买此应用。<br/>　3、商家发布代金券,设置面额，可兑换积分数等。<br/>　4、会员在积分商城兑换该商家发布的代金券。<br/>　5、购买商家商品时，在确认订单步骤可以使用该商家的代金券直接抵扣现金进行交易。</div>
             <form method="post" action="">
                 <table class="table">
                    <tr>
                        <td width="180px"> * 购买单价（元/月）：</td>
                        <td>
                            <input type="text"  class="text w250" name="p_v_price" value="<?php echo $this->_tpl_vars['p_voucher_config']['p_v_price']; ?>
" />　<span class="bz">购买代金劵活动所需费用，购买后卖家可以在所购买周期内发布代金劵促销活动</span>
                         </td>
                    </tr>
                <tr>
                    <td> * 每月活动数量：</td>
                    <td>
                          <input type="text"  class="text w250" name="p_v_limittimes" value="<?php echo $this->_tpl_vars['p_voucher_config']['p_v_limittimes']; ?>
"　placeholder="如：10元" />　<span class="bz">每家店铺每月最多可以发布的代金劵促销活动数量</span>
                    </td>
                </tr>
                <tr>
                    <td >* 买家最大领取数量:</td>
                    <td>
                         <input type="text"  class="text w250" name="p_v_eachlimit" value="<?php echo $this->_tpl_vars['p_voucher_config']['p_v_eachlimit']; ?>
" />　<span class="bz">买家最多只能拥有同一个店铺尚未消费抵用的店铺代金券最大数量</span>
                    </td>
                </tr>
                <tr>
                    <td ></td>
                    <td>
                        <input type="hidden" name="act" value="config"/>
                        <input type="submit" name="submit" value="提交"/>
                    </td>
                </tr>
                 </table>
            </form>
        </div>
        <?php endif; ?>
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
        });
    });
</script>
</body>
</html>