<?php /* Smarty version 2.6.20, created on 2016-03-01 09:40:51
         compiled from main.htm */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "header.htm", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<body>
	<div id="container" class="cf">
		<div id="col-side">
			<img id="icon-vension" src="./img/icon_v_s_e.png" alt="标准版体验版">
			<ul id="nav" class="cf static">
				<!-- <li class="item item-vip"> 
					<a href="javascript:void(0);" class="vip main-nav">高级<span class="arrow">&gt;</span></a>
					 
				</li>
				 -->
				<li class="item item-setting">
                    <a data-right="BU_QUERY" href="member.php" rel="pageTab" tabid="setting-member" tabtxt="会员" class="vip main-nav">
						<i class="iconfont">&#xe60a;</i><p>会员</p><s></s><span class="arrow">&gt;</span>
					</a>
                </li>
				
				<li class="item item-purchase"> 
					<!-- <a href="javascript:void(0);" class="purchase main-nav">购货<span class="arrow">&gt;</span></a> -->
					<a data-right="BU_QUERY" href="sales.php" rel="pageTab" tabid="setting-sales" tabtxt="下单" class="purchase main-nav">
						<i class="iconfont">&#xe627;</i><p>下单</p><s></s><span class="arrow">&gt;</span>
					</a>
				</li>
				<li class="item item-sales"> 
					<!-- <a href="javascript:void(0);" class="sales main-nav">销货<span class="arrow">&gt;</span></a> -->
					<a data-right="BU_QUERY" href="sales_list.php" rel="pageTab" tabid="setting-order" tabtxt="订单" class="sales main-nav">
						<i class="iconfont">&#xe625;</i><p>订单</p><s></s><span class="arrow">&gt;</span>
					</a>
				</li>
				<li class="item item-storage"> 
					<!-- <a href="javascript:void(0);" class="storage main-nav">仓库<span class="arrow">&gt;</span></a> -->
					<a href="javascript:void(0);"  class="report main-nav">
						<i class="iconfont">&#xe621;</i><p>报表</p><s></s><span class="arrow">&gt;</span>
					</a>
					<div class="new_sub_nav">
						<ul class="cf" id="setting-base">
							<li>
								<i class="iconfont"></i>
								<a data-right="BU_QUERY" href="order.php?met=1" rel="pageTab" tabid="setting-baseConfig" tabtxt="日销售">日销售</a>
								<em></em>
							</li>
							<li>
								<i class="iconfont"></i>
								<a data-right="BU_QUERY" href="order.php?met=2" rel="pageTab" tabid="setting-baseConfig" tabtxt="周销售">周销售</a>
								<em></em>
							</li>
							<li>
								<i class="iconfont"></i>
								<a data-right="BU_QUERY" href="order.php?met=3" rel="pageTab" tabid="setting-baseConfig" tabtxt="月销售">月销售</a>
								<em></em>
							</li>
							<!-- <div style="min-height:50px;"></div> -->
						</ul>
					</div>
				</li>           
				<!-- <li class="item item-money"> 
					<a href="javascript:void(0);" class="money main-nav">资金<span class="arrow">&gt;</span></a>      
				</li>  -->     
			</ul>
		</div>
		
		<div id="col-main">
			<div id="main-hd" class="cf">
				<div class="tit"> <a class="company" id="companyName" href="javascript:;" title=""></a> <span class="period" id="period"></span> </div>
				<ul class="user-menu">
					<li class="qq"><a href="" onclick="return false;" id="wpa">你好，<?php echo $_SESSION['ADMIN_USER']; ?>
</a></li>
					<li class="space">|</li>				
					<!-- <li class="telphone">电话：021-64966875-8001</li>
					<li class="space">|</li>
					<li><a href="http://yuanfeng021.com/" target="_blank" class="buy-now">购买</a></li>
					<li class="space">|</li> -->
					<li><a href="index.php?action=logout">退出</a></li>
				</ul>  
			</div>
			<div id="main-bd"><div class="page-tab" id="page-tab"></div></div>
		</div>
	</div>
	<script src="js/default.js"></script>
</body>
</html>