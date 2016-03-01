<?php /* Smarty version 2.6.20, created on 2016-03-01 09:40:56
         compiled from sales.htm */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "header.htm", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<link href="css/sales.css?ver=201508241556" rel="stylesheet" type="text/css">
<script src="js/models/jquery.md5.js" type="text/javascript"></script>
<style>

#barCodeInsert{margin-left: 10px;font-weight: 100;font-size: 12px;color: #fff;background-color: #B1B1B1;padding: 0 5px;border-radius: 2px;line-height: 19px;height: 20px;display: inline-block;}
#barCodeInsert.active{background-color: #23B317;}
.hidden{display:none;}

select {
  /*Chrome和Firefox里面的边框是不一样的，所以复写了一下*/
  border: solid 1px #000;
  /*很关键：将默认的select选择框样式清除*/
  appearance:none;
  -moz-appearance:none;
  -webkit-appearance:none;
  /*在选择框的最右侧中间显示小箭头图片*/
  background: url("./img/spr_icons.png") no-repeat scroll right center transparent;
  background-position:80px -16px;
  /*为下拉小箭头留出一点位置，避免被文字覆盖*/
  padding-right: 14px;
}
/*清除ie的默认选择框样式清除，隐藏下拉箭头*/
select::-ms-expand { display: none; }
</style>
<body class="body">
<div class="wrapper">
	<span id="config" class="ui-icon ui-state-default ui-icon-config"></span>
	<div class="mod-toolbar-top mr0 cf dn" id="toolTop"></div>
	<div class="bills cf">
		<div class="con-header">
			<dl class="cf">
				<dd class="pct25">
					<label>客户:</label>
					<span class="ui-combo-wrap" id="customer">
						<input type="text" name="" class="input-txt" autocomplete="off" value="" data-ref="date">
						<i class="ui-icon-ellipsis"></i>
					</span>
				</dd>
				
				<dd id="identifier" class="pct20 tc">
					<label>销售人员:</label>
					<span class="ui-combo-wrap" id="sales">
						<input type="text" class="input-txt" autocomplete="off">
						<i class="trigger"></i>
					</span>
				</dd>
				
				<dd class="pct20 tc">
				  <label>下单日期:</label>
				  <input type="text" id="date" class="ui-input ui-datepicker-input" value="2015-09-08">
				</dd>
				
				<!-- <dd class="pct20 tc">
				  <label>交货日期:</label>
				  <input type="text" id="deliveryDate" class="ui-input ui-datepicker-input" value="">
				</dd> -->
				
				<dd id="classes" class="pct15 tr">
					<input type="hidden" name="classes" value="150601">
					<!-- <label class="radio"><input type="radio" name="classes" value="150601">售出</label> -->
					<!-- <label class="radio"><input type="radio" name="classes" value="150602">退货</label> -->
				</dd>
			</dl>
			<!-- <p id="identifier" class="cf tr" style="margin: 10px 0 0 0; "><label>单据编号:</label><span id="number">XSDD20150908001</span></p> -->
		</div>
    
		<div class="grid-wrap">
			<table id="grid"></table>
			<div id="page"></div>
		</div>
   
		<div class="con-footer cf">
			<div class="mb10">
				<textarea type="text" id="note" class="ui-input ui-input-ph">暂无备注信息</textarea>
			</div>
			
			<ul id="amountArea" class="cf">
				<li>
					<label>优惠率:</label>
					<input type="text" id="discountRate" class="ui-input" data-ref="deduction">%
				</li>
				<li>
					<label>优惠金额:</label>
					<input type="text" id="deduction" class="ui-input" data-ref="payment">
				</li>
				<li>
					<label>优惠后金额:</label>
					<input type="text" id="discount" class="ui-input ui-input-dis" data-ref="discountRate" disabled>
				</li>
				<li>
					<label>账户余额:</label>
					<input type="text" id="cash" value="0" class="ui-input ui-input-dis" data-ref="cash" disabled>
				</li>
				<li id="accountWrap" class="">
					<label>支付方式:</label>
					<span class="ui-combo-wrap" id="account" style="padding:0;">
						<select style="border:0px;height:30px;width:100px;" id="paymentMethod" name="paymentMethod">
							<option value="1">现金支付</option>
							<option value="2">余额支付</option>
							<!-- <option value="1">POS刷卡</option>
							<option value="1">支付宝</option>
							<option value="1">微信支付</option> -->
						</select>
						<!-- <input type="text" class="input-txt" autocomplete="off" value="现金支付" disabled> -->
						<!-- <i class="trigger"></i> -->
					</span>
					<a id="accountInfo" class="ui-icon ui-icon-folder-open" style="display:none;"></a>
				</li>
				<li>
					<label>支付密码:</label>
					<input type="password" id="password" value="" class="ui-input" data-ref="password">
				</li>
			</ul>
			
			<ul class="">
				<!-- <li>
					<label id="paymentTxt">本次收款:</label>
					<input type="text" id="payment" class="ui-input">&emsp;
				</li>
				
				<li id="accountWrap" class="">
					<label>支付方式:</label>
					<span class="ui-combo-wrap" id="account" style="padding:0;">
						<input type="text" class="input-txt" autocomplete="off" value="现金支付">
						<i class="trigger"></i>
					</span>
					<a id="accountInfo" class="ui-icon ui-icon-folder-open" style="display:none;"></a>
				</li>
				<li>
					<label>本次欠款:</label>
					<input type="text" id="arrears" class="ui-input ui-input-dis" disabled>
				</li>
				<li>
					<label>累计欠款:</label>
					<input type="text" id="totalArrears" class="ui-input ui-input-dis" disabled>
				</li> -->
			</ul>
			
			<ul class="c999 cf">
				<!-- <li>
					<label>制单人:</label>
					<span id="userName"></span>
				</li> -->
				<!-- <li>
					<label>审核人:</label>
					<span id="checkName"></span>
				</li> -->
				<li>
					<label>最后修改时间:</label>
					<span id="modifyTime"></span>
				</li>
			</ul>
		</div>
		
		<div class="cf" id="bottomField">
			<div class="fr" id="toolBottom"></div>
		</div>
		<div id="mark"></div>
	</div>
  
	<div id="initCombo" class="dn">
		<input type="text" class="textbox goodsAuto" name="goods" autocomplete="off">
		<input type="text" class="textbox storageAuto" name="storage" autocomplete="off">
		<input type="text" class="textbox unitAuto" name="unit" autocomplete="off">
		<input type="text" class="textbox priceAuto" name="price" autocomplete="off">
		<input type="text" class="textbox skuAuto" name="price" autocomplete="off">
	</div>
	<div id="storageBox" class="shadow target_box dn"></div>
</div>
<script src="js/sales_order.js"></script>
</body>
</html>