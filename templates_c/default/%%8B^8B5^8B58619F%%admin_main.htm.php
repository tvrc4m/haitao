<?php /* Smarty version 2.6.20, created on 2016-03-16 11:34:23
         compiled from user_admin/admin_main.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'user_admin/admin_main.htm', 53, false),array('insert', 'getNotice', 'user_admin/admin_main.htm', 74, false),)), $this); ?>
<div class="fl i-fl">
    <div class="container h166">
        <div class="hd"><h2>店铺提示</h2></div>
        <div class="content">
            <dl class="focus">
                <h2>您需要关注的店铺情况：</h2>
                <dt>商品提示：</dt>
                <dd><a href="main.php?m=product&s=admin_product_storage">仓库待上架商品 (<strong><?php echo $this->_tpl_vars['shop_count']['prdouct']['1']; ?>
</strong>)</a></dd>
                <dt>咨询提示：</dt>
                <dd><a href="main.php?m=product&s=admin_shop_consult&type=to_reply"><?php echo $this->_tpl_vars['lang']['the_buyer_message']; ?>
 (<strong><?php echo $this->_tpl_vars['shop_count']['consult']; ?>
</strong>)</a></dd>
                <dt>违规提示：</dt>
                <dd><a href="main.php?m=report&s=admin_report"><?php echo $this->_tpl_vars['lang']['report_lock_up']; ?>
 (<strong>0</strong>)</a></dd>
            </dl>
            <ul>
                <li><a href="main.php?m=product&s=admin_product_list">出售中的商品 (<strong><?php echo $this->_tpl_vars['shop_count']['prdouct']['2']+$this->_tpl_vars['shop_count']['prdouct']['3']; ?>
</strong>)</a></li>
                <li><a href="main.php?m=product&s=admin_product_storage&statu=-1">违规下架的商品 (<strong><?php echo $this->_tpl_vars['shop_count']['prdouct']['0']; ?>
</strong>)</a></li>
                <li><a href="main.php?m=product&s=admin_product">商品发布</a></li>
                <li><a href="main.php?m=product&s=admin_product_batch">淘宝数据导入</a></li>
            </ul>
        </div>
    </div>
    <div class="container h166">
        <div class="hd"><h2>交易提示</h2></div>
        <div class="content">
            <dl class="focus">
                <h2>您需要立即处理的交易订单：</h2>
                <dt>近期售出：</dt>
                <dd><a href="main.php?m=product&s=admin_sellorder">交易中的订单 (<strong><?php echo $this->_tpl_vars['shop_count']['order']['0']; ?>
</strong>)</a></dd>
            </dl>
            <ul>
                <li><a href="main.php?m=product&s=admin_sellorder&status=1">待付款 (<strong><?php echo $this->_tpl_vars['shop_count']['order']['1']; ?>
</strong>)</a></li>
                <li><a href="main.php?m=product&s=admin_sellorder&status=2">待发货 (<strong><?php echo $this->_tpl_vars['shop_count']['order']['2']; ?>
</strong>)</a></li>
                <li><a href="main.php?m=product&s=admin_sellorder&status=3">待收货 (<strong><?php echo $this->_tpl_vars['shop_count']['order']['3']; ?>
</strong>)</a></li>
                <li><a href="main.php?m=product&s=admin_sellorder&status=5">退货 (<strong><?php echo $this->_tpl_vars['shop_count']['order']['4']; ?>
</strong>)</a></li>
                <li><a href="main.php?m=product&s=admin_sellorder">近期售出 (<strong><?php echo $this->_tpl_vars['shop_count']['order']['0']; ?>
</strong>)</a></li>
                <li><a href="main.php?m=product&s=admin_sellorder&status=4">待评价 (<strong><?php echo $this->_tpl_vars['shop_count']['order']['5']; ?>
</strong>)</a></li>
            </ul>
        </div>
    </div>

	<!--[if IE]><script src="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/script/excanvas.js"></script><![endif]-->
    <div class="container">
        <div class="hd"><h2>店铺流量</h2></div>
        <div class="content">
		<canvas id="cv" width="575" height="142"></canvas>
		</div>
	</div>
	<script type="text/javascript" src="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/script/Chart.js" ></script>
    <script>
	window.onload = function() {
		var ctx = document.getElementById('cv').getContext('2d');
		var data = {
				labels : [<?php $_from = $this->_tpl_vars['date']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['num'] => $this->_tpl_vars['list']):
?><?php if ($this->_tpl_vars['num'] != 0): ?>,<?php endif; ?>"<?php echo ((is_array($_tmp=$this->_tpl_vars['list'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%m-%d") : smarty_modifier_date_format($_tmp, "%m-%d")); ?>
"<?php endforeach; endif; unset($_from); ?>],
				datasets : 
				[
					{
						fillColor : "rgba(220,220,220,0.5)",
						strokeColor : "#DCDCDC",
						pointColor : "#DCDCDC",
						pointStrokeColor : "#fff",
						data : [<?php $_from = $this->_tpl_vars['count']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['num'] => $this->_tpl_vars['list']):
?><?php if ($this->_tpl_vars['num'] != 0): ?>,<?php endif; ?>"<?php echo $this->_tpl_vars['list']; ?>
"<?php endforeach; endif; unset($_from); ?>]
					}
				]
			}
		new Chart(ctx).Line(data);
	};
    </script>
</div>
<div class="fr i-fr">
    <div class="news container h166">
        <div class="hd"><h2>商城公告</h2></div>
        <div class="content">
            <ul>
                <?php require_once(SMARTY_CORE_DIR . 'core.run_insert_handler.php');
echo smarty_core_run_insert_handler(array('args' => array('name' => 'getNotice', 'limit' => 5)), $this); ?>

            </ul>
        </div>
    </div>
    <div class="contact container h166">
        <div class="hd"><h2>平台联系方式</h2></div>
        <div class="content">
            <ul>
                <li>客服电话: <?php echo $this->_tpl_vars['config']['owntel']; ?>
</li>
                <li>电子邮箱:<br /><?php echo $this->_tpl_vars['config']['email']; ?>
</li>
                <li>服务时间:<br />9:00-18:00(周一至周日)</li>
            </ul>
        </div>
    </div>
</div>