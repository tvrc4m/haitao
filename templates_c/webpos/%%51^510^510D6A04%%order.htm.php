<?php /* Smarty version 2.6.20, created on 2016-03-03 15:32:28
         compiled from order.htm */ ?>
<!doctype html>
<html lang="zh-CN">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
	<meta name="renderer" content="webkit">
	<title>线下下单系统</title>
	<link href="css/common.css" rel="stylesheet">
	<link href="css/ui.min.css" rel="stylesheet">
	<link rel="stylesheet" href="css/report.css" />

	<script src="js/models/sea.js?ver=20150529" id="seajsnode"></script>
	<script src="js/libs/jquery/jquery-1.10.2.min.js"></script>

	<style type="text/css">
		#filter-menu .con{ width:355px; }
		#filter-menu label.tit{ width:80px; }
		/*.ui-jqgrid tr.jqgrow td {white-space: normal !important;}*/
	</style>
</head>

<body>
	<div class="mod-report">
		<div class="search-wrap" id="report-search">
			<div class="s-inner cf">
				<div class="fl"> 
					<strong class="tit mrb fl">选择查询条件：</strong>
					<div class="ui-btn-menu fl" id="filter-menu"> 
						<span class="ui-btn menu-btn"> <strong id="selected-period">请选择查询条件</strong><b></b> </span>
						<div class="con">
							<ul class="filter-list">
								<li>
									<label class="tit">订单日期:</label>
									<input type="text" value="" class="ui-input ui-datepicker-input" name="filter-fromDate" id="filter-fromDate" maxlength="10" />
									<span>至</span>
									<input type="text" value="" class="ui-input ui-datepicker-input" name="filter-toDate" id="filter-toDate" maxlength="10" />
								</li>
							</ul>
							
							<ul class="filter-list" id="more-conditions">
								<!-- <li>
									<label class="tit">预计交货日期:</label>
									<input type="text" value="" class="ui-input ui-datepicker-input" name="filter-fromDeliveryDate" id="filter-fromDeliveryDate" maxlength="10" />
									<span>至</span>
									<input type="text" value="" class="ui-input ui-datepicker-input" name="filter-toDeliveryDate" id="filter-toDeliveryDate" maxlength="10" />
								</li> -->
								<!-- <li>
									<label class="tit">客户:</label>
									<span class="mod-choose-input" id="filter-customer"><input type="text" class="ui-input" id="customerAuto"/>
									<span class="ui-icon-ellipsis"></span></span>
								</li>
								<li style="height:60px; ">
									<label class="tit">商品:</label>
									<span class="mod-choose-input" id="filter-goods">
										<input type="text" class="ui-input" id="goodsAuto"/>
										<span class="ui-icon-ellipsis"></span>
									</span>
									<p style="color:#999; padding:3px 0 0 0; ">（可用,分割多个编码如1001,1008,2001，或直接输入编码段如1001--1009查询）</p>
								</li> -->
							  
								<!-- <li id="status-wrap">
									<label class="tit">状态:</label>
									<label class="chk"><input type="checkbox" value="0" name="status" />未出库</label>
									<label class="chk"><input type="checkbox" value="1" name="status" />部分出库</label>
									<label class="chk"><input type="checkbox" value="2" name="status" />已出库</label>
								</li> -->
								<!-- <li>
									<label class="tit">销售人员:</label>
									<span class="mod-choose-input" id="filter-saler">
										<input type="text" class="ui-input" id="salerAuto"><span class="ui-icon-ellipsis"></span>
									</span>
								</li> -->
							</ul>
							
							<div class="btns"> 
								<a href="#" id="conditions-trigger" class="conditions-trigger" tabindex="-1">更多条件<b></b></a> 
								<a class="ui-btn ui-btn-sp" id="filter-submit" href="#">确定</a> 
								<a class="ui-btn" id="filter-reset" href="#" tabindex="-1">重置</a> 
							</div>
						</div>
					</div>
					<a id="refresh" class="ui-btn ui-btn-refresh fl mrb"><b></b></a> 
					<span class="txt fl" id="cur-search-tip"></span> 
				</div>
				
				<div class="fr">
					<a href="#" class="ui-btn ui-btn-sp mrb fl" id="btn-print">打印</a><!-- <a href="#" class="ui-btn fl" id="btn-export">导出</a> -->
				</div>
			</div>
		</div>
	  
		<div class="ui-print">
			<span id="config" class="ui-icon ui-state-default ui-icon-config"></span>
			<div class="grid-wrap" id="grid-wrap">
				<div class="grid-title">销售订单表</div>
				<div class="grid-subtitle"></div>
				<table id="grid"></table>
			</div>
		</div>
		<div class="no-query"></div>
	</div>

	<script>
		seajs.use("salesOrderTracking");
		<?php if ($_GET['met']): ?>parent.SYSTEM.beginDate='<?php echo $this->_tpl_vars['begin']; ?>
';<?php endif; ?>
	</script>
</body>
</html>