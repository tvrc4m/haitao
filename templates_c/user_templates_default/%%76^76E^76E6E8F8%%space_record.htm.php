<?php /* Smarty version 2.6.20, created on 2016-03-19 14:33:27
         compiled from space_record.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'number_format', 'space_record.htm', 24, false),array('modifier', 'date_format', 'space_record.htm', 26, false),)), $this); ?>
<table width="100%" cellpadding="0" cellspacing="0" class="record">
<!-- <thead>
    <tr>
        <td colspan="5">交易中<b><?php echo $this->_tpl_vars['re']['total1']; ?>
</b>笔，交易成功<b><?php echo $this->_tpl_vars['re']['total2']; ?>
</b>笔，纠纷退款<b><?php echo $this->_tpl_vars['re']['total3']; ?>
</b>笔</td>
    </tr>
    <tr>
        <td colspan="5">原价：<?php echo $this->_tpl_vars['config']['money']; ?>
<em><?php echo $this->_tpl_vars['de']['price']; ?>
</em><span>拍下价格的不同可能会由促销和打折引起的，详情可以咨询卖家。</span></td>
    </tr>
</thead> -->
<tbody>
    <tr class="pl_nav">
        <th class="pl15">买家</th>
        <th>拍下价格</th>
        <th>数量</th>
        <th>付款时间</th>
        <th>款式和型号</th>
    </tr>
    <?php $_from = $this->_tpl_vars['re']['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['list']):
?>
    <tr>
        <td class="pl15">
        <p>&nbsp;<?php echo $this->_tpl_vars['list']['user']; ?>
</p>
        <p><img src="image/points/<?php echo $this->_tpl_vars['list']['buyerpoints']; ?>
" /></p>
        </td>
        <td><span><?php echo $this->_tpl_vars['config']['money']; ?>
<b><?php echo ((is_array($_tmp=$this->_tpl_vars['list']['price']*$this->_tpl_vars['list']['num'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2) : number_format($_tmp, 2)); ?>
</b></span></td>
        <td><?php echo $this->_tpl_vars['list']['num']; ?>
</td>
        <td><?php echo ((is_array($_tmp=$this->_tpl_vars['list']['time'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%Y-%m-%d&nbsp;%H:%M:%S") : smarty_modifier_date_format($_tmp, "%Y-%m-%d&nbsp;%H:%M:%S")); ?>
</td>
        <td class="spec">
        <?php $_from = $this->_tpl_vars['list']['spec']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['slist']):
?>
        <?php echo $this->_tpl_vars['slist']; ?>

        <?php endforeach; endif; unset($_from); ?>
        </td>
    </tr>
    <?php endforeach; else: ?>
    <tr>
        <td class="no-result" colspan="5">暂时还没有买家购买此商品</td>
    </tr>
    <?php endif; unset($_from); ?>
</tbody>  
</table>
<div class="pages"><?php echo $this->_tpl_vars['re']['page']; ?>
</div>
<script type="text/javascript">
$(".pages a").click(function(){
	$("body,html").animate({scrollTop:$(".inner-wrap").offset().top});
	$('#deal-record').html('<div class="loading"><p>正在努力加载中...</p></div>');
	$('#deal-record').load($(this).attr("href"));
	return false;
});
</script>