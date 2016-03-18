<?php /* Smarty version 2.6.20, created on 2016-03-16 11:32:38
         compiled from admin_share_product.htm */ ?>
<script>
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
		var url = "main.php?m=sns&s=admin_share_product";
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
        收藏商品
    </div>
</div>
<div class="main">
	<div class="wrap">
        <div class="hd">
            <ul class="tabs">
                <li class="active"><a href="main.php?m=sns&s=admin_share_product">收藏商品</a></li>
                <li class="normal"><a href="main.php?m=sns&s=admin_share_shop">收藏店铺</a></li>
                <!--<div class="search">
                    <div class="i-search ld">
                    <form method="get">
                        <input type="hidden" name="m" value="sns" />
                        <input type="hidden" name="s" value="admin_share_product" />
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
            <tr>
                <td colspan="20" class="pic_model">
                    <ul>
                    <?php $_from = $this->_tpl_vars['re']['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['num'] => $this->_tpl_vars['list']):
?>
                    	<li>
                        <dl>
                            <dt>
                           <input type="checkbox" value="<?php echo $this->_tpl_vars['list']['id']; ?>
" class="checkitem" name="chk[]">
                            <a target="_blank" href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/?m=product&s=detail&id=<?php echo $this->_tpl_vars['list']['pid']; ?>
"><?php echo $this->_tpl_vars['list']['pname']; ?>
</a></dt>
                            <dd class="picture">
                                <div><a target="_blank" href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/?m=product&s=detail&id=<?php echo $this->_tpl_vars['list']['pid']; ?>
"><img width="150" height="150" src="<?php if ($this->_tpl_vars['list']['image']): ?><?php echo $this->_tpl_vars['list']['image']; ?>
<?php else: ?>image/default/nopic.gif<?php endif; ?>"></a></div>
                                <div class="handle"><a href="main.php?m=sns&s=admin_share_product&type=del&id=<?php echo $this->_tpl_vars['list']['id']; ?>
">删除</a></div>
                            </dd>
                            <dd>价格：<em class="price"><?php echo $this->_tpl_vars['list']['price']; ?>
</em> 元</dd>
                        </dl>
                        </li>
                    <?php endforeach; endif; unset($_from); ?>
                    </ul>
                </td>
            </tr>
			<?php if (! $this->_tpl_vars['re']['list']): ?>
            <tr>
            	<td colspan="20" class="norecord" style="border-top:none;">
                	<i></i><span>暂无符合条件的数据记录</span>	
                </td>
            </tr>
            <?php endif; ?>
            </tbody>
            <tfoot>
            <tr>
            	<td width="2"></td>
            	<td>
                <input type="checkbox" class="checkall">
                <a id="del" confirm="您确定要删除吗?" class="btn2" href="javascript:void(0);">删除</a>
                <div class="pagination"><?php echo $this->_tpl_vars['re']['page']; ?>
</div>
                </td>
            </tr>
            </tfoot>
        </table>
     </div>   
</div>