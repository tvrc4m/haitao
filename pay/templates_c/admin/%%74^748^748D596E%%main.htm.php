<?php /* Smarty version 2.6.20, created on 2016-03-01 09:36:48
         compiled from main.htm */ ?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>商务管理系统</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link href="admin.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="../script/jquery-1.4.4.min.js"></script>
<script type="text/javascript" src="../script/jquery.ui.js"></script>
<script type="text/javascript" src="../script/dialog/dialog.js" id="dialog_js"></script>
<script type="text/javascript" src="../script/base.js"></script>
</head>
<body style="overflow:hidden;">
<div id="append_parent"></div>
<div id="ajaxwaitid"></div>
<table width="100%" height="100%" id="frametable" cellpadding="0" cellspacing="0">
<tr>
	<td colspan="2" height="60">
		<div id="header">
            <div class="logo"><img width="180" src="../image/admin/logo.gif"></div>
            <div class="info">
                <p class="portrait">您好: <?php echo $_SESSION['ADMIN_USER']; ?>
</p>
                <p><a href="index.php?action=logout" target="_top">退出</a></p>
                <p><a target="_blank" href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
">首页</a></p>            
            </div>
    		<div class="nav"><ul id="topmenu"><?php echo $this->_tpl_vars['nav']; ?>
</ul></div>
        </div>
        </td>
    </tr>
    <tr>
    	<td width="180" valign="top" class="menutd">
        <div class="menu" id="leftmenu"><?php echo $this->_tpl_vars['item']; ?>
</div>
        </td>
        <td height="100%" valign="top" class="frame">
        <div style="position:relative; height:100%;">
            <iframe id="main" name="main" width="100%" frameborder="0" height="100%"></iframe>
        </div>
        </td>
    </tr>
</table>
<div style="" id="scrolllink">
	<span onClick="menuScroll(1)"><img src="../image/admin/scrollu.gif"></span>
    <span onClick="menuScroll(2)"><img src="../image/admin/scrolld.gif"></span>
</div>
<div class="copyright">
	<p>Powered by <a target="_blank" href="http://www.mall-builder.com">MallBuilder</a></p>
	<p>&copy; 2007-2015</p>
</div>
<script>
$('.add-menu').click(function(){
	var url=String(parent.main.location);
	n=url.lastIndexOf('/')+1;
})
var headers = new Array('index','global','pay','product','member','shop','business','website','running','tools');
var menukey = '';
function toggleMenu(key, url) {
	switchheader(key);
	menukey = key;
	if(url) {
		parent.main.location = url;
		var hrefs = document.getElementById('menu_' + key).getElementsByTagName('a');
		for(var j = 0; j < hrefs.length; j++) {
			hrefs[j].className = j == 0 ? 'tabon' : '';
		}
	}
	setMenuScroll();
}
function setMenuScroll() {
	var obj = document.getElementById('menu_' + menukey);
	if(!obj) {
		return;
	}
	var scrollh = document.body.offsetHeight - 160;
	obj.style.overflow = 'visible';
	obj.style.height = '';
	document.getElementById('scrolllink').style.display = 'none';
	
	if(obj.offsetHeight + 150 > document.body.offsetHeight && scrollh > 0) {
		obj.style.overflow = 'hidden';
		obj.style.height = scrollh+10 + 'px';
		document.getElementById('scrolllink').style.display = '';
	}
}
function menuScroll(op, e) {
	var obj = document.getElementById('menu_' + menukey);
	var scrollh = document.body.offsetHeight - 160;
	if(op == 1) {
		obj.scrollTop = obj.scrollTop - scrollh;
	} else if(op == 2) {
		obj.scrollTop = obj.scrollTop + scrollh;
	} else if(op == 3) {
		if(!e) e = window.event;
		if(e.wheelDelta <= 0 || e.detail > 0) {
			obj.scrollTop = obj.scrollTop + 20;
		} else {
			obj.scrollTop = obj.scrollTop - 20;
		}
	}
}
function switchheader(key) {
	for(var k in headers) {
		if(document.getElementById('menu_' + headers[k])) {
			document.getElementById('menu_' + headers[k]).style.display = headers[k] == key ? '' : 'none';
		}
	}
	var lis = document.getElementById('topmenu').getElementsByTagName('li');
	for(var i = 0; i < lis.length; i++) {
		if(lis[i].className == 'navon') lis[i].className = '';
	}
	document.getElementById('header_' + key).parentNode.className = 'navon';
}

var menus = document.getElementById('leftmenu').getElementsByTagName('a');
for(var i = 0; i < menus.length; i++) {
	var menu = menus[i];
	menu.onclick = function() {
		for(var i = 0; i < menus.length; i++)
		{
			menus[i].className = '';
		}
		parent.main.location = this.href;
		this.className = 'tabon';
		return false;
	}
}
function opendiv(obj) {
	
	obj.className = obj.className != 'add' ? 'add' : 'minus';
	setMenuScroll();
}
function _attachEvent(obj, evt, func) {
	if(obj.addEventListener) {
		obj.addEventListener(evt, func, false);
	} else if(obj.attachEvent) {
		obj.attachEvent("on" + evt, func);
	}
}
toggleMenu('index','main_index.php');

_attachEvent(window, 'resize', setMenuScroll, document);

function closeWin(url)
{
	close_win();
	document.getElementById('main').src=url;
}
</script>
</body>
</html>