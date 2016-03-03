<?php /* Smarty version 2.6.20, created on 2016-03-03 15:31:42
         compiled from header.htm */ ?>
<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=1280, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
	<meta name="renderer" content="webkit|ie-comp|ie-stand">
	<title>WebPos收银系统</title>
	<link href="css/base.css" rel="stylesheet" type="text/css">
	<link href="css/default.css" rel="stylesheet" type="text/css" id="defaultFile">
	<link href="css/iconfont.css" rel="stylesheet" type="text/css">
	<link href="css/common.css?ver=20140430" rel="stylesheet" type="text/css">
	<link href="css/ui.min.css?ver=20140430" rel="stylesheet">
	
	<script src="js/libs/jquery/jquery-1.10.2.min.js"></script>
	<script src="js/libs/json2.js"></script>
	<script src="js/models/common.js?ver=20140430"></script>
	<script src="js/libs/jquery/grid.js?ver=20140430"></script>
	<script src="js/libs/jquery/plugins.js?ver=20140430"></script>
	<script src="js/libs/jquery/plugins/jquery.dialog.js?self=true&ver=20140430"></script>
	<script src="js/libs/tabs.js?ver=20140430"></script>
	
	<script type="text/javascript">
		var DOMAIN = document.domain;
		var WDURL = "";
		var SCHEME= "default";
		try{
			document.domain = 'yuanfeng021.com';
		}catch(e){
		}
	</script>

	<!-- author：309558639 | team：http://www.yuanfengerp.com/ -->
	<script>
		var CONFIG = {
			DEFAULT_PAGE: true,
			SERVICE_URL: './erp.php?ctl=Service'
		};
		//系统参数控制
		
		var date = new Date();
		var month = date.getMonth()+1;
		var day = date.getDate();
		var beginDate = date.getFullYear()+'-'+month+'-01';
		var endDate = date.getFullYear()+'-'+month+'-'+day;
		var SYSTEM = {
			version: 1,
			skin: "default",
			curDate: '1423619990432',  //系统当前日期
			DBID: '88887785', //账套ID
			serviceType: '15', //账套类型，13：表示收费服务，12：表示免费服务
			realName: '体验用户', //真实姓名
			userName: 'Demo', //用户名
			companyName: 'WebPos收银系统',	//公司名称
			companyAddr: '',	//公司地址
			phone: '',	//公司电话
			fax: '',	//公司传真
			postcode: '',	//公司邮编
			startDate: '2015-08-26', //启用日期
			endDate:endDate,
			beginDate:beginDate,
			currency: 'RMB',	//本位币
			qtyPlaces: '4',	//数量小数位
			pricePlaces: '4',	//单价小数位
			amountPlaces: '2', //金额小数位
			valMethods:	'firstInFirstOut',	//存货计价方法
			invEntryCount: '',//试用版单据分录数
			rights: {},//权限列表
			billRequiredCheck: 0, //是否启用单据审核功能  1：是、0：否
			requiredCheckStore: 1, //是否检查负库存  1：是、0：否
			hasOnlineStore: 1,	//是否启用网店
			enableStorage: 0,	//是否启用仓储
			genvChBill: 0,	//生成凭证后是否允许修改单据
			requiredMoney: 0, //是否启用资金功能  1：是、0：否
			taxRequiredCheck: 1,
			taxRequiredInput: 0,//默认的税率
			isAdmin:true, //是否管理员
			siExpired:false,//是否过期
			siType:2, //服务版本，1表示基础版，2表示标准版
			siVersion:4, //1表示试用、2表示免费（百度版）、3表示收费，4表示体验版
			Mobile:"",//当前用户手机号码
			isMobile:true,//是否验证手机
			isshortUser:false,//是否联邦用户
			shortName:"",//shortName
			isOpen:false,//是否弹出手机验证
			enableAssistingProp:1 //是否开启辅助属性功能  1：是、0：否

		};
		
		var cacheList = {};	//缓存列表查询
		//区分服务支持
		var name = '<?php echo $_SESSION['ADMIN_USER']; ?>
';
		var id = '<?php echo $_SESSION['ADMIN_USER_ID']; ?>
';
		SYSTEM.servicePro = SYSTEM.siType === 2 ? 'forbscm3' : 'forscm3';
		SYSTEM.goodsInfo = [];
		SYSTEM.allStorageInfo = [];
		SYSTEM.storageInfo = [];
		SYSTEM.customerInfo = [];
		SYSTEM.supplierInfo = [];
		SYSTEM.addrInfo = [];
		SYSTEM.salesInfo = [{'id':id, 'name':name}];
		SYSTEM.accountInfo = [];
		SYSTEM.paymentInfo = [];
		SYSTEM.unitInfo = [];
	</script>
</head>