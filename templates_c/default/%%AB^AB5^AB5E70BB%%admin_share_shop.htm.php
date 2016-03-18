<?php /* Smarty version 2.6.20, created on 2016-03-16 14:53:26
         compiled from admin_share_shop.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'admin_share_shop.htm', 76, false),)), $this); ?>
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
	 
	$('#del').click(function(){
		if($('.checkitem:checked').length == 0){ 
			return false;
		}
		var url = "main.php?m=sns&s=admin_share_shop";
		var items = '';
			$('.checkitem:checked').each(function(){
				items += this.value + ',';
		});
		items = items.substr(0, (items.length - 1));
		$.get(url,'pid=' + items,showResponse);
		function showResponse(originalRequest)
		{
			document.location.reload();
		}
		return false;
	});
});
</script>
<div class="path">
    <div>
    	<a href="main.php?cg_u_type=1">我的商城</a> <span>&gt;</span> 
        收藏店铺
    </div>
</div>
<div class="main">
	<div class="wrap">
        <div class="hd">
            <ul class="tabs">
                <li class="normal"><a href="main.php?m=sns&s=admin_share_product">收藏商品</a></li>
                <li class="active"><a href="main.php?m=sns&s=admin_share_shop">收藏店铺</a></li>
                <!--<div class="search">
                    <div class="i-search ld">
                    <form method="get">
                        <input type="hidden" name="m" value="sns" />
                        <input type="hidden" name="s" value="admin_share_shop" />
                        <input type="hidden" name="act" value="search" />
                        <input name="key" class="text" type="text" value="<?php echo $_GET['key']; ?>
" />
                        <input class="search_button" type="submit" value="搜索" />
                    </form>
                    </div>
                </div>-->
            </ul>
        </div>
        <table class="table-list-style">
            <thead>
            <tr>
                <th width="30"></th>
                <th width="70"></th>
                <th class="tl">店铺</th>
                <th width="150">收藏时间</th>
                <th width="90">收藏人气</th>
                <th width="90">操作</th>
            </tr>
            </thead>
            <tbody>
            <?php $_from = $this->_tpl_vars['re']['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['num'] => $this->_tpl_vars['slist']):
?>
            <tr>
            	<td><input type="checkbox" value="<?php echo $this->_tpl_vars['slist']['id']; ?>
" class="checkitem" name="chk[]"></td>
                <td><div class="pic_small"><a target="_blank" href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/shop.php?uid=<?php echo $this->_tpl_vars['slist']['shopid']; ?>
"><img height="50" width="50" src="<?php if ($this->_tpl_vars['slist']['logo'] != ''): ?><?php echo $this->_tpl_vars['slist']['logo']; ?>
<?php else: ?>image/default/user_admin/default_user_portrait.gif<?php endif; ?>" /></a></div></td>
                <td class="tl"><a target="_blank" href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/shop.php?uid=<?php echo $this->_tpl_vars['slist']['shopid']; ?>
"><?php echo $this->_tpl_vars['slist']['company']; ?>
</a><p><?php echo $this->_tpl_vars['slist']['area']; ?>
</p><p><?php echo $this->_tpl_vars['slist']['user']; ?>
</p></td>
                <td><?php echo ((is_array($_tmp=$this->_tpl_vars['slist']['addtime'])) ? $this->_run_mod_handler('date_format', true, $_tmp) : smarty_modifier_date_format($_tmp)); ?>
</td>
                <td><?php echo $this->_tpl_vars['slist']['shop_collect']; ?>
</td>
                <td>
                <p><a href="main.php?m=sns&s=admin_share_shop&type=del&id=<?php echo $this->_tpl_vars['slist']['id']; ?>
">删除</a></p>
                </td>
            </tr>
            <?php endforeach; else: ?>
            <tr>
            	<td colspan="20" class="norecord">
                	<i></i><span>暂无符合条件的数据记录</span>	
                </td>
            </tr>
            <?php endif; unset($_from); ?>
            </tbody>
            <tfoot>
            <tr>
            	<td class="tc"><input type="checkbox" class="checkall"></td>
                <td colspan="20">
                <label for="del" class="btn2">全选</label>
                <a id="del" confirm="您确定要删除吗?" class="btn2" href="javascript:void(0);">删除</a>
                <div class="pagination"><?php echo $this->_tpl_vars['re']['page']; ?>
</div>
                </td>
            </tr>
            </tfoot>
        </table>
     </div>   
</div>