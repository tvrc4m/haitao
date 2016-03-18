<?php /* Smarty version 2.6.20, created on 2016-03-16 14:31:25
         compiled from admin_buyvoucher.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'admin_buyvoucher.htm', 25, false),)), $this); ?>
<div class="path">
    <div>
    	<a href="main.php?cg_u_type=1">我的商城</a> <span>&gt;</span>我的代金券 
    </div>
</div>

<div class="main">
	<div class="wrap">
       <table class="table-list-style order voucher_list">
            <thead>
                <tr>
                    <th width="82"></th>
                    <th width="200" class="al">代金券序列号</th>
                    <th width="80">面额</th>
                    <th width="100">有效期</th>
                    <th width="80">状态</th>
                    <th width="80">操作</th>
                </tr>
            </thead>
            <?php $_from = $this->_tpl_vars['list']['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['vo']):
?>
            <tr>
                <td><img src="<?php echo $this->_tpl_vars['vo']['logo']; ?>
" class="w70b1"/></td>
                <td class="al">名　称：<?php echo $this->_tpl_vars['vo']['name']; ?>
    (已领<?php echo $this->_tpl_vars['vo']['getnum']; ?>
张/限领<?php echo $this->_tpl_vars['vo']['eachlimit']; ?>
张)<br/>使用范围：<?php echo $this->_tpl_vars['vo']['shop_name']; ?>
　<i>使用条件：订单满<?php echo $this->_tpl_vars['vo']['limit']; ?>
元</i><br/>序列号：<?php echo $this->_tpl_vars['vo']['serial']; ?>
</td>
                <td><?php echo $this->_tpl_vars['vo']['price']; ?>
</td>
                <td><?php echo ((is_array($_tmp=$this->_tpl_vars['vo']['start_time'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%Y-%m-%d") : smarty_modifier_date_format($_tmp, "%Y-%m-%d")); ?>
 ~ <?php echo ((is_array($_tmp=$this->_tpl_vars['vo']['end_time'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%Y-%m-%d") : smarty_modifier_date_format($_tmp, "%Y-%m-%d")); ?>
</td>
                <td><?php if ($this->_tpl_vars['vo']['status'] == 1): ?>未使用<?php elseif ($this->_tpl_vars['vo']['status'] == 2): ?>已用<?php elseif ($this->_tpl_vars['vo']['status'] == 3): ?>过期<?php else: ?>收回<?php endif; ?></td>
                <td><a href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/shop.php?uid=<?php echo $this->_tpl_vars['vo']['shop_id']; ?>
" target="_blank">使用</a> <a onclick="return confirm('确定吗？')" href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/main.php?m=voucher&s=admin_buyvoucher&del_v_id=<?php echo $this->_tpl_vars['vo']['id']; ?>
">删除</a></td>
            </tr>
            <?php endforeach; else: ?>
            <tr>
                <td colspan="6"><div style="line-height:45px;text-align:center">您还没有领取代金券,<a style="display: inline;color:blue" href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/index.php?m=points" target="_blank">去看看</a></div></td>
            </tr>
            <?php endif; unset($_from); ?>
            <?php if ($this->_tpl_vars['list']['page']): ?>
            <tr>
                <td colspan="6"><div class="pagination"><?php echo $this->_tpl_vars['list']['page']; ?>
</div></td>
            </tr>
            <?php endif; ?>
        </table>
        </div>
</div>