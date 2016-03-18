<?php /* Smarty version 2.6.20, created on 2016-03-16 14:53:22
         compiled from admin_buyer_card.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'admin_buyer_card.htm', 43, false),)), $this); ?>
<div class="path">
    <div>
    	<a href="main.php?cg_u_type=1">我的商城</a> <span>&gt;</span>我的会员卡 
    </div>
</div>

<div class="main">
    <div class="wrap">
        <div class="searchbar">
            <form method="post">
                <div>
                <input type="text" name="serial" value="" class="w250" placeholder="请输入商家提供的序列号"/>
                <input type="hidden" name="act" value="add_bind_card"/>
                <span class="search-btn"><input type="submit" name="submit" value="搜索"/></span>
                </div>
            </form>
            <script>
                $("input[name='submit']").click(function(){
                    if(!$("input[name='serial']").val())
                    {
                        $("input[name='serial']").focus();
                        return false;
                    }
                })
            </script>
        </div>
       <table class="table-list-style order voucher_list">
            <thead>
                <tr>
                    <th width="82"></th>
                    <th width="200" class="al">会员卡序列号</th>
                    <th width="80">折扣</th>
                    <th width="100">激活日期</th>
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
                <td class="al">会员卡名：<?php echo $this->_tpl_vars['vo']['name']; ?>
<br/>发放店铺：<?php echo $this->_tpl_vars['vo']['shop_name']; ?>
　<br/>卡序列号：<?php echo $this->_tpl_vars['vo']['serial']; ?>
</td>
                <td><?php echo $this->_tpl_vars['vo']['discounts']; ?>
</td>
                <td><?php echo ((is_array($_tmp=$this->_tpl_vars['vo']['used_time'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%Y-%m-%d %H:%I:%S") : smarty_modifier_date_format($_tmp, "%Y-%m-%d %H:%I:%S")); ?>
</td>
                <td><?php if ($this->_tpl_vars['vo']['status'] == 1): ?>正常<?php else: ?>不可用<?php endif; ?></td>
                <td><a href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/shop.php?uid=<?php echo $this->_tpl_vars['vo']['shop_id']; ?>
" target="_blank">使用</a> <a onclick="return confirm('确定吗？')" href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/main.php?m=member&s=admin_buyer_card&del_v_id=<?php echo $this->_tpl_vars['vo']['id']; ?>
">删除</a></td>
            </tr>
            <?php endforeach; else: ?>
            <tr>
                <td colspan="6" class="norecord"><i></i><span>暂无符合条件的数据记录</span></td>
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