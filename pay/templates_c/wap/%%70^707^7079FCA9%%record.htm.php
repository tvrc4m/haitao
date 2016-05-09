<?php /* Smarty version 2.6.20, created on 2016-05-09 11:06:35
         compiled from record.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'record.htm', 77, false),)), $this); ?>
<div class="block fn-clear">
    <div class="balance account">
        <p>
        账户余额
        <!--<a target="_blank" href="">百度金融火热抢购中！</a>-->
        </p>
        <div>
            <span class="wallet">
                <em><strong><?php echo $this->_tpl_vars['de']['cash']; ?>
</strong></em>
                <span> 元</span>
            </span>
            <a class="btn" href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/?m=payment&s=recharge">充 值</a>
            <a class="btn" href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/?m=payment&s=withdraw">提 现</a>
            <!-- <a class="btn1" href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/?m=payment&s=transfer">转 账</a> -->
        </div>
    </div>
</div>
<div class="block fn-clear">
	<div class="record">
        <!-- <h2>
            <?php if ($_GET['mold'] == 1): ?>充值记录<?php elseif ($_GET['mold'] == 2): ?>提现记录<?php else: ?>交易记录<?php endif; ?>
            <span>可用余额<strong><?php echo $this->_tpl_vars['de']['cash']; ?>
</strong>元</span>
        </h2> -->
        <div style="height:10px;background-color:#ededed;"></div>
         <p>
            <a href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/index.php">收支明细</a>
            <!-- <a href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/?m=payment&s=record&mold=0" <?php if ($_GET['mold'] == 0): ?>class="pay_sgo"<?php endif; ?> >交易记录</a> -->
            <a href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/index.php?m=payment&s=record&mold=1" <?php if ($_GET['mold'] == 1): ?>class="pay_sgo"<?php endif; ?> >充值记录</a>
            <a href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/index.php?m=payment&s=record&mold=2" <?php if ($_GET['mold'] == 2): ?>class="pay_sgo"<?php endif; ?> >提现记录</a>
        </p>
    	<?php if (! $_GET['mold']): ?>
   		<div class="filter">
    	<div class="date"></div>
        <dl class="fn-clear">
        	<dt>交易分类：</dt>
            <dd>
            <a <?php if (! $_GET['type']): ?>class="current"<?php endif; ?> href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/?m=payment&s=record<?php if ($_GET['status']): ?>&status=<?php echo $_GET['status']; ?>
<?php endif; ?>">全部</a>
            <a <?php if ($_GET['type'] == 1): ?>class="current"<?php endif; ?> href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/?m=payment&s=record&type=1<?php if ($_GET['status']): ?>&status=<?php echo $_GET['status']; ?>
<?php endif; ?>">付款</a>
            <a <?php if ($_GET['type'] == 2): ?>class="current"<?php endif; ?> href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/?m=payment&s=record&type=2<?php if ($_GET['status']): ?>&status=<?php echo $_GET['status']; ?>
<?php endif; ?>">收款</a>
            </dd>
        </dl>
        <dl class="fn-clear">
        	<dt>交易状态：</dt>
            <dd>
            <a <?php if (! $_GET['status']): ?>class="current"<?php endif; ?> href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/?m=payment&s=record<?php if ($_GET['type']): ?>&type=<?php echo $_GET['type']; ?>
<?php endif; ?>">全部</a>
            <a <?php if ($_GET['status'] == 1): ?>class="current"<?php endif; ?> href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/?m=payment&s=record&status=1<?php if ($_GET['type']): ?>&type=<?php echo $_GET['type']; ?>
<?php endif; ?>">未付款</a>
            <a <?php if ($_GET['status'] == 2): ?>class="current"<?php endif; ?> href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/?m=payment&s=record&status=2<?php if ($_GET['type']): ?>&type=<?php echo $_GET['type']; ?>
<?php endif; ?>">等待发货</a>
            <a <?php if ($_GET['status'] == 3): ?>class="current"<?php endif; ?> href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/?m=payment&s=record&status=3<?php if ($_GET['type']): ?>&type=<?php echo $_GET['type']; ?>
<?php endif; ?>">未确认收货</a>
			<a <?php if ($_GET['status'] == 4): ?>class="current"<?php endif; ?> href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/?m=payment&s=record&status=4<?php if ($_GET['type']): ?>&type=<?php echo $_GET['type']; ?>
<?php endif; ?>">成功</a>
            <a <?php if ($_GET['status'] == 10): ?>class="current"<?php endif; ?> href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/?m=payment&s=record&status=10<?php if ($_GET['type']): ?>&type=<?php echo $_GET['type']; ?>
<?php endif; ?>">失败</a>
            </dd>
        </dl>
    </div>
    <?php endif; ?>
        <table width="100%" cellpadding="0" cellspacing="0">
            <tr>
                <th class="al">名称 | 交易号</td>
                <?php if (! $_GET['mold']): ?><th class="al" width="15%">对方</th><?php endif; ?>
                <th width="25%">金额(元)</th>
                <th width="25%">状态</th>
                <!--<th width="60">操作</th>-->
            </tr>
            <?php $_from = $this->_tpl_vars['re']['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['list']):
?>
            <tr class="trse">
                <td class="al">
                <?php echo $this->_tpl_vars['list']['note']; ?>

                <div>
                    交易号
                    <?php if ($this->_tpl_vars['list']['order_id'] && $this->_tpl_vars['list']['mold'] != 8): ?>
                        <?php echo $this->_tpl_vars['list']['order_id']; ?>

                    <?php else: ?>
                        <?php echo $this->_tpl_vars['list']['flow_id']; ?>

               		<?php endif; ?>
             	</div>
                <br>
                <br>
                时间：<?php echo ((is_array($_tmp=$this->_tpl_vars['list']['time'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%Y-%m-%d") : smarty_modifier_date_format($_tmp, "%Y-%m-%d")); ?>

                </td>
                <?php if (! $_GET['mold']): ?><td class="al"><?php echo $this->_tpl_vars['list']['name']['real_name']; ?>
</td><?php endif; ?>
                <td class="price<?php if ($this->_tpl_vars['list']['minus'] == 'T'): ?> minus<?php endif; ?>"><?php if ($this->_tpl_vars['list']['minus'] != 'T'): ?>+<?php endif; ?><?php echo $this->_tpl_vars['list']['price']; ?>
</td>
                <td <?php if ($this->_tpl_vars['list']['is_refund'] == 'true'): ?>rowspan="2"<?php endif; ?>>
                <?php if ($this->_tpl_vars['list']['statu'] == 1): ?><?php if ($this->_tpl_vars['list']['mold'] == 8): ?>进行中<?php else: ?>等待付款<?php endif; ?>
                <?php elseif ($this->_tpl_vars['list']['statu'] == 2): ?>
                    <?php if ($this->_tpl_vars['list']['buyer_email'] == ''): ?>
                        已付款
                    <?php else: ?>
                        等待发货
                    <?php endif; ?>
                <?php elseif ($this->_tpl_vars['list']['statu'] == 3): ?>
                    <?php if ($this->_tpl_vars['list']['buyer_email'] == ''): ?>
                        等待确认收货
                    <?php else: ?>
                        已发货
                    <?php endif; ?>
                <?php elseif ($this->_tpl_vars['list']['statu'] == 4): ?>交易成功
                <?php elseif ($this->_tpl_vars['list']['statu'] == 5): ?>
                    <?php if ($this->_tpl_vars['list']['buyer_email'] == ''): ?>
                        已审请退货
                    <?php else: ?>
                        要求退货
                    <?php endif; ?>
                <?php elseif ($this->_tpl_vars['list']['statu'] == 6): ?>
                    已退货
                <?php else: ?>已取消
                <?php endif; ?>
                <br>
                <p <?php if ($this->_tpl_vars['list']['is_refund'] == 'true'): ?>rowspan="2"<?php endif; ?>>
                <?php if ($this->_tpl_vars['list']['statu'] == 1 && $this->_tpl_vars['list']['seller_email'] && ( $this->_tpl_vars['list']['mold'] == 3 || $this->_tpl_vars['list']['mold'] == 0 )): ?>
                <a href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/index.php?m=payment&s=pay&tradeNo=<?php echo $this->_tpl_vars['list']['order_id']; ?>
">付款</a>
                <?php else: ?>
                <a href="<?php if ($this->_tpl_vars['list']['return_url']): ?><?php echo $this->_tpl_vars['list']['return_url']; ?>
<?php else: ?><?php echo $this->_tpl_vars['config']['weburl']; ?>
/index.php?m=payment&s=detail&tradeNo=<?php echo $this->_tpl_vars['list']['flow_id']; ?>
<?php endif; ?>">详情</a>
                <?php endif; ?> </p>
                </td>
            </tr>
            <?php if ($this->_tpl_vars['list']['is_refund'] == 'true'): ?>
            <tr>
            	<td class="al">退款</td>
                <td></td>
            	<td class="price <?php if ($this->_tpl_vars['list']['minus'] != 'T'): ?> minus<?php endif; ?>">
                	<?php if ($this->_tpl_vars['list']['minus'] == 'T'): ?>+<?php else: ?>-<?php endif; ?><?php echo $this->_tpl_vars['list']['refund_amount']; ?>

                </td>
            </tr>
            <?php endif; ?>
            <?php endforeach; else: ?>
            <tr>
                <td colspan="99">
                <div class="none fn-clear">
                    <img class="fn-left" src="templates/default/image/none.jpg" />
                    <span class="fn-left">没有找到记录，请调整搜索条件</span>
                </div>
                </td>
            </tr>
            <?php endif; unset($_from); ?>
           <!--  <?php if ($this->_tpl_vars['re']['page'] && $this->_tpl_vars['re']['page'] != '   '): ?>
            <tr>
                <td colspan="99">
                <div class="page"><?php echo $this->_tpl_vars['re']['page']; ?>
</div>
                </td>
            </tr>
            <?php endif; ?>-->
           <!--  <tr>
                <td colspan="99">
                    <a href="javascript:ajax_page();" class="m_jiazai next"><i></i>点击加载更多</a>
                </td>
            </tr>  -->
        </table>
         <div style="width:100%;text-align:center;padding:10px 0;" class="tr-btn">
            <a href="javascript:void(0);" class="m_jiazai next" id="more-msg">下拉加载更多</a>
        </div>
    </div>
</div>
<script>
$(function(){
    var minL=$(".record table tbody tr.trse").size();
    if(minL<5){
        $(".tr-btn").hide();
    }
    var page = 0 ;
    var stop=true; 
    $(window).scroll(function(){
        totalheight = parseFloat($(window).height()) + parseFloat($(window).scrollTop()); 
        if($(document).height() <= totalheight){ 
            if(stop==true){ 
                $("#more-msg").html("正在加载中.....");
                stop=false; 
                var ptype = 'record';
                var mold = "<?php echo $_GET['mold']; ?>
";
                $.ajax({
                    url: "<?php echo $this->_tpl_vars['config']['weburl']; ?>
/"+"ajax_index.php",
                    type: 'get',
                    data: {ptype: ptype,mold:mold,page:page},
                    dataType: "json",
                    success: function(msg){
                            if(msg.status==2){
                            var dataLength= msg.data.length; 
                            for(var i=0;i<dataLength;i++){
                                var timestamp3 = Number(msg.data[i].time);
                                var newDate = new Date();
                                newDate.setTime(timestamp3 * 1000);
                                Date.prototype.format = function(format) {
                                       var date = {
                                              "M+": this.getMonth() + 1,
                                              "d+": this.getDate()
                                       };
                                       if (/(y+)/i.test(format)) {
                                              format = format.replace(RegExp.$1, (this.getFullYear() + '').substr(4 - RegExp.$1.length));
                                       }
                                       for (var k in date) {
                                              if (new RegExp("(" + k + ")").test(format)) {
                                                     format = format.replace(RegExp.$1, RegExp.$1.length == 1
                                                            ? date[k] : ("00" + date[k]).substr(("" + date[k]).length));
                                              }
                                       }
                                       return format;
                                }
                                var dataTime=(newDate.format('yyyy-MM-dd'));
                                $(".record table tbody").append("<tr>"+
                                "<td class='al'>"+
                               ""+msg.data[i].note+""+
                                "<div>"+
                                    "交易号"+
                                    "<?php if ($this->_tpl_vars['list']['order_id'] && $this->_tpl_vars['list']['mold'] != 8): ?>"+
                                        ""+msg.data[i].order_id+""+
                                    "<?php else: ?>"+
                                        ""+msg.data[i].flow_id+""+
                                    "<?php endif; ?>"+
                                "</div>"+
                                "<br>"+
                                "<br>"+
                                "时间："+dataTime+""+
                                "</td>"+
                                "<?php if (! $_GET['mold']): ?><td class='al'><?php echo $this->_tpl_vars['list']['name']['real_name']; ?>
</td><?php endif; ?>"+
                                "<td class='price<?php if ($this->_tpl_vars['list']['minus'] == 'T'): ?> minus<?php endif; ?>'><?php if ($this->_tpl_vars['list']['minus'] != 'T'): ?>+<?php endif; ?>"+msg.data[i].price+"</td>"+
                                "<td <?php if ($this->_tpl_vars['list']['is_refund'] == 'true'): ?>rowspan='2'<?php endif; ?>>"+
                                "<?php if ($this->_tpl_vars['list']['statu'] == 1): ?><?php if ($this->_tpl_vars['list']['mold'] == 8): ?>进行中<?php else: ?>等待付款<?php endif; ?>"+
                                "<?php elseif ($this->_tpl_vars['list']['statu'] == 2): ?>"+
                                    "<?php if ($this->_tpl_vars['list']['buyer_email'] == ''): ?>"+
                                        "已付款"+
                                    "<?php else: ?>"+
                                        "等待发货"+
                                    "<?php endif; ?>"+
                                "<?php elseif ($this->_tpl_vars['list']['statu'] == 3): ?>"+
                                    "<?php if ($this->_tpl_vars['list']['buyer_email'] == ''): ?>"+
                                        "等待确认收货"+
                                    "<?php else: ?>"+
                                       "已发货"+
                                    "<?php endif; ?>"+
                                "<?php elseif ($this->_tpl_vars['list']['statu'] == 4): ?>交易成功"+
                                "<?php elseif ($this->_tpl_vars['list']['statu'] == 5): ?>"+
                                    "<?php if ($this->_tpl_vars['list']['buyer_email'] == ''): ?>"+
                                        "已审请退货"+
                                    "<?php else: ?>"+
                                       "要求退货"+
                                    "<?php endif; ?>"+
                                "<?php elseif ($this->_tpl_vars['list']['statu'] == 6): ?>"+
                                    "已退货"+
                                "<?php else: ?>已取消"+
                                "<?php endif; ?>"+
                                "<br>"+
                                "<p <?php if ($this->_tpl_vars['list']['is_refund'] == 'true'): ?>rowspan='2'<?php endif; ?>>"+
                                "<?php if ($this->_tpl_vars['list']['statu'] == 1 && $this->_tpl_vars['list']['seller_email'] && ( $this->_tpl_vars['list']['mold'] == 3 || $this->_tpl_vars['list']['mold'] == 0 )): ?>"+
                                "<a href='<?php echo $this->_tpl_vars['config']['weburl']; ?>
/index.php?m=payment&s=pay&tradeNo="+msg.data[i].order_id+"'>付款</a>"+
                               "<?php else: ?>"+
                                " <a href='<?php if ($this->_tpl_vars['list']['return_url']): ?><?php echo $this->_tpl_vars['list']['return_url']; ?>
<?php else: ?><?php echo $this->_tpl_vars['config']['weburl']; ?>
/index.php?m=payment&s=detail&tradeNo="+msg.data[i].flow_id+"<?php endif; ?>'>详情</a>"+
                                "<?php endif; ?> </p>"+
                                "</td>"+
                            "</tr>"+
                            "<?php if ($this->_tpl_vars['list']['is_refund'] == 'true'): ?>"+
                            "<tr>"+
                                "<td class='al'>退款</td>"+
                                "<td></td>"+
                                "<td class='price <?php if ($this->_tpl_vars['list']['minus'] != 'T'): ?> minus<?php endif; ?>'>"+
                                    "<?php if ($this->_tpl_vars['list']['minus'] == 'T'): ?>+<?php else: ?>-<?php endif; ?>"+msg.data[i].refund_amount+""+
                                "</td>"+
                            "</tr>"+
                            "<?php endif; ?>")
                            } 
                        stop=true;        
                        page+=5;
                        }else{
                         $("#more-msg").html("已到最底部");
                    }  
                    }
                });
            } 
        } 
    });   
})
</script>