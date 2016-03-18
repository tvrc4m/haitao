<?php /* Smarty version 2.6.20, created on 2016-03-16 11:40:52
         compiled from admin_message_list.htm */ ?>
<script language="javascript">
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
	 
	$('#btn').click(function(){
		
		if($('.checkitem:checked').length == 0){
			return false;
		}
		var url = "main.php?m=message&s=admin_message_list_inbox";
		var name = $(this).attr('name');
		var items = '';
			$('.checkitem:checked').each(function(){
				items += this.value + ',';
		});
		items = items.substr(0, (items.length - 1));
		$.get(url, name + '=' + items,showResponse);
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
    	<?php if ($this->_tpl_vars['cg_u_type'] == 1): ?>
    		<a href="main.php?cg_u_type=1">我的商城</a> <span>&gt;</span>
        <?php else: ?>
    		<a href="main.php?cg_u_type=2">卖家中心</a> <span>&gt;</span>
        <?php endif; ?> 
        <?php if ($_GET['s'] == 'admin_message_list_outbox'): ?><?php echo $this->_tpl_vars['lang']['outbox']; ?>

        <?php elseif ($_GET['s'] == 'admin_message_list_savebox'): ?><?php echo $this->_tpl_vars['lang']['savebox']; ?>

        <?php elseif ($_GET['s'] == 'admin_message_list_delbox'): ?><?php echo $this->_tpl_vars['lang']['delbox']; ?>

        <?php else: ?><?php echo $this->_tpl_vars['lang']['inbox']; ?>

        <?php endif; ?>
    </div>
</div>
<div class="main">
	<div class="wrap">
        <div class="hd">
            <ul class="tabs">
                <li class="<?php if ($_GET['s'] == 'admin_message_list_inbox'): ?>active<?php else: ?>normal<?php endif; ?>"><a href="main.php?m=message&s=admin_message_list_inbox"><?php echo $this->_tpl_vars['lang']['inbox']; ?>
</a></li>
                <li class="<?php if ($_GET['s'] == 'admin_message_list_outbox'): ?>active<?php else: ?>normal<?php endif; ?>"><a href="main.php?m=message&s=admin_message_list_outbox"><?php echo $this->_tpl_vars['lang']['outbox']; ?>
</a></li>
            </ul>
        </div>
        <table class="table-list-style">
            <thead>
            <tr>
                <th width="60"><input type="checkbox" class="checkall" id="del"></th>
                <th width="10"></th>
                <th class="tl" width="200">
                <?php if ($_GET['s'] == 'admin_message_list_delbox'): ?>
                	<?php echo $this->_tpl_vars['lang']['from_to']; ?>

                <?php else: ?>
                    <?php if ($_GET['s'] == 'admin_message_list_outbox'): ?>
                    	<?php echo $this->_tpl_vars['lang']['receiv']; ?>

                    <?php else: ?>
                    	<?php echo $this->_tpl_vars['lang']['from']; ?>

                    <?php endif; ?>
                <?php endif; ?>
                </th>
                <th class="tl">主题</th>
                <th width="120">时间</th>
            </tr>
            </thead>
            <tbody>
            <?php $_from = $this->_tpl_vars['re']['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['list']):
?>
            <tr>
            	<td><input type="checkbox" value="<?php echo $this->_tpl_vars['list']['id']; ?>
" class="checkitem" name="chk[]"></td>
                <td></td>
                <td class="tl">
                <?php if (! $this->_tpl_vars['list']['iflook']): ?>
                	<img src="image/default/unred.gif" width="16" height="14" />
                <?php elseif ($this->_tpl_vars['list']['iflook'] == 3): ?>
                	<img src="image/default/replied.gif" width="16" height="14" />
                <?php elseif ($this->_tpl_vars['list']['iflook'] == 1 || $this->_tpl_vars['list']['iflook'] == 2): ?>
                	<img src="image/default/read.gif" width="16" height="14" />
                <?php endif; ?>
                <?php if ($this->_tpl_vars['list']['fromuserid'] || $this->_tpl_vars['list']['msgtype'] == '3'): ?>
                    <?php if ($this->_tpl_vars['list']['msgtype'] == '3'): ?>
                    	<?php echo $this->_tpl_vars['lang']['system_msg']; ?>

                    <?php else: ?>
                    	<?php echo $this->_tpl_vars['list']['fromname']; ?>

                    <?php endif; ?>
                <?php else: ?>
                    <?php echo $this->_tpl_vars['lang']['tourists']; ?>

                <?php endif; ?>
                </td>
                <td class="tl"><a href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/main.php?m=message&s=admin_message_det&id=<?php echo $this->_tpl_vars['list']['id']; ?>
"><?php echo $this->_tpl_vars['list']['sub']; ?>
</a></td>
                <td><?php echo $this->_tpl_vars['list']['date']; ?>
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
                <td class="tc"><input type="checkbox" class="checkall" id="del"></td>
                <td colspan="20">
                <label for="del" class="btn2">全选</label>
                <a id="btn" confirm="您确定要删除吗?" name="did" class="btn2" href="javascript:void(0);">删除</a>
                <div class="pagination"><?php echo $this->_tpl_vars['re']['page']; ?>
</div>
                </td>
            </tr>
            </tfoot>
        </table>
     </div>   
</div>