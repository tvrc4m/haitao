<?php /* Smarty version 2.6.20, created on 2016-03-01 09:41:01
         compiled from product_select.htm */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "header.htm", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<style>.matchCon{width:280px;}</style>
	<body class="body">
		<style>
			#matchCon { width: 200px; }
			.grid-wrap{position:relative;}
			.ztreeDefault{position: absolute;right: 0;top: 0;background-color: #fff;border: 1px solid #D6D5D5;width: 140px;height: 406px;overflow-y: auto;}
			#matchCon { width: 200px; }
			.bgwh {background-color: #fff;}
			.ul-inline li{list-style: none; float: left;  margin-right: 10px;  }
			.p20 {padding: 20px; }
			.m0 {  margin: 0;  }
			.mod-search {  padding: 0 18px 10px 0;  font-family: 'Lucida Console';}
			.fl {  float: left;}
			.ui-combo-active, .ui-combo-active:hover {  border: 1px solid #aaa;  }
			.ui-combo-active, .ui-combo-active input {  box-shadow: 0 2px 1px rgba(0,0,0,.11) inset;  }
			.cf:after {  clear: both;  content: ".";  display: block;  height: 0;  overflow: hidden;  visibility: hidden;  }
			.ui-btn {
			  display: inline-block;
			  padding: 0 13px;
			  height: 28px;
			  border: 1px solid #c1c1c1;
			  border-radius: 2px;
			  box-shadow: 0 1px 1px rgba(0,0,0,.15);
			  background: #fff;
			  background: -moz-linear-gradient(top,#fff,#f4f4f4);
			  background: -webkit-gradient(linear,0 0,0 100%,from(#fff),to(#f4f4f4));
			  background: -o-linear-gradient(top,#fff,#f4f4f4);
			  background: -ms-linear-gradient(top,#fff 0,#f4f4f4 100%);
			  background: linear-gradient(top,#fff,#f4f4f4);
			  filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#ffffff', endColorstr='#f4f4f4');
			  font: 14px/2 \5b8b\4f53;
			  color: #555;
			  vertical-align: middle;
			  cursor: pointer;
			}
			.mrb {margin-right: 10px;  }
			a {outline: none;}
			a {  text-decoration: none;  color: #555;  cursor: pointer; }
			#matchCon {width: 200px;  }
			.ui-input-ph { color: #aaa;}
			.ui-input {
			  padding: 6px 5px;
			  width: 100px;
			  height: 16px;
			  line-height: 16px;
			  border: 1px solid #ddd;
			  color: #555;
			  vertical-align: middle;
			  outline: 0;
			}
			button, input, select, textarea {  font-size: 100%;color: #555;}
			body, button, input, select, textarea {  font: 12px/1.5 arial, \5b8b\4f53;  color: #555;  }
			body, h1, h2, h3, h4, h5, h6, hr, p, blockquote, dl, dt, dd, ul, ol, li, pre, form, fieldset, legend, button, input, textarea, th, td {
			  margin: 0;
			  padding: 0;
			}
		</style>
		<div class="container fix p20">
			  <div class="mod-search m0 cf">
				<div class="fl">
				  <ul class="ul-inline">
					<li>
					  <input type="text" id="matchCon" class="ui-input ui-input-ph" value="请输入商品编号/名称">
					</li>
					<li><a class="ui-btn mrb" id="search">查询</a><!-- <a class="ui-btn" id="refresh">刷新</a> --></li>
				  </ul>
				</div>
			  </div>
			  <div class="grid-wrap">
				<table id="grid">
				</table>
				<div id="page"></div>
			  </div>
		</div>
		<script src="js/product_select.js"></script>
	</body>
</html>