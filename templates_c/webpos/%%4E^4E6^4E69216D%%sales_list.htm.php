<?php /* Smarty version 2.6.20, created on 2016-03-03 15:31:51
         compiled from sales_list.htm */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "header.htm", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<style>
#matchCon { width: 220px; }
#print{margin-left:10px;}
a.ui-btn{margin-left:10px;}
#reAudit,#audit{display:none;}
</style>
</head>

<body class="body">
	<div class="wrapper">
		<div class="mod-search cf">
			<div class="fl">
				<ul class="ul-inline">
					<li>
					  <input type="text" id="matchCon" class="ui-input ui-input-ph" value="请输入订单编号">
					</li>
					<li>
						<label>日期:</label>
						<input type="text" id="beginDate" value="" class="ui-input ui-datepicker-input">
						<i>-</i>
						<input type="text" id="endDate" value="" class="ui-input ui-datepicker-input">
					</li>
					<li>
						<!-- <a class="mrb more" id="moreCon">(高级搜索)</a> -->
						<a class="ui-btn" id="search">查询</a>
						<!--<a class="ui-btn ui-btn-refresh" id="refresh" title="刷新"><b></b></a>-->
					</li>
				</ul>
			</div>
			<div class="fr">
				<a class="ui-btn ui-btn-sp" id="add">下单</a>
				<a href="#" class="ui-btn mrb" id="btn-refresh">刷新</a>
				<!-- <a class="ui-btn" id="print" target="_blank" href="javascript:void(0);">打印</a> -->
				<!-- <a href="#" class="ui-btn" id="import">导入</a> -->
				<!-- <a class="ui-btn" id="export" target="_blank" href="javascript:void(0);">导出</a> -->
				<!-- <a class="ui-btn dn" id="audit">审核</a><a class="ui-btn" id="reAudit">反审核</a> -->
			</div>
		</div>

		<div class="grid-wrap">
			<table id="grid"></table>
			<div id="page"></div>
		</div>
	</div>
	
	<script src="js/sales_list.js?ver=201508241556"></script>
</body>
</html>