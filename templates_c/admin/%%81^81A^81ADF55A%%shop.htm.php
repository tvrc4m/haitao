<?php /* Smarty version 2.6.20, created on 2016-03-01 09:37:11
         compiled from shop.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'shop.htm', 150, false),array('modifier', 'getdistrictid', 'shop.htm', 434, false),)), $this); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link href="admin.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="../script/jquery-1.4.4.min.js"></script>
<script type="text/javascript" src="../script/district.js"></script>
<script>
var weburl="<?php echo $this->_tpl_vars['config']['weburl']; ?>
";
function getHTML(v,ob,sscatid,scatid,tcatid)
{
	if(ob=='tcatid'){
		document.getElementById('scatid').options.length=0;
		document.getElementById('sscatid').options.length=0;
		document.getElementById('scatid').style.visibility="hidden";
		document.getElementById('sscatid').style.visibility="hidden";
	}
	if(ob=='scatid'){
		document.getElementById('sscatid').options.length=0;
		document.getElementById('sscatid').style.visibility="hidden";
	}
	var url = '<?php echo $this->_tpl_vars['config']['weburl']; ?>
/ajax_back_end.php';
	var sj = new Date();
	var pars = 'shuiji=' + sj+'&cattype=com&pcatid='+v;
	$.post(url, pars,showResponse);
	function showResponse(originalRequest)
	{
		if(originalRequest=='')
			return false;
		var tempStr = 'var MyMe = ' + originalRequest;
		var i=1;var j=0;
		eval(tempStr);
		for(var s in MyMe)
		{
			++j;
		}
		if(j>0)
			document.getElementById(ob).style.visibility="visible";
		else
			document.getElementById(ob).style.visibility="hidden";
		document.getElementById(ob).options.length =j+1;
		document.getElementById(ob).options[0].value = '';
        document.getElementById(ob).options[0].text = '--请选择--';
		document.getElementById(ob).options[0].selected = true;
		for(var k in MyMe)
		{
			var cityId=MyMe[k][0];
			var ciytName=MyMe[k][1];
			document.getElementById(ob).options[i].value = cityId;
			document.getElementById(ob).options[i].text = ciytName;

			if(cityId==scatid||cityId==tcatid||cityId==sscatid)
			{
				document.getElementById(ob).options[i].selected = true;
				scityid=cityId;
			}
			i++;
	　	}
	 }
}
function sd()
{
	$("#d_1").attr('class','hidden')
	$("#d_2").removeClass('hidden')
}
</script>
<title>店铺</title>
</head>
<body>
	<div class="container">
        <div class="flow">
            <div class="itemtitle">
                <h3>店铺</h3>
                <ul>
                    <?php if ($_GET['operation'] == ''): ?>
                    <li <?php if ($_GET['operation'] == ''): ?>class="current"<?php endif; ?>><a href="?m=<?php echo $_GET['m']; ?>
&s=<?php echo $_GET['s']; ?>
"><span>搜索</span></a></li>
                    <?php endif; ?>

                    <?php if ($_GET['operation'] != ''): ?>
                    <li <?php if ($_GET['operation'] == 'list'): ?>class="current"<?php endif; ?>><a href="?m=<?php echo $_GET['m']; ?>
&s=<?php echo $_GET['s']; ?>
&operation=list"><span>管理</span></a></li>
                    <li><a href="?m=<?php echo $_GET['m']; ?>
&s=shop_application.php"><span>开店申请</span></a></li>
                    <?php endif; ?>

                    <?php if ($_GET['operation'] == 'edit'): ?>
                    <li class="current"><a href="#"><span>修改</span></a></li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
        <div class="h35"></div>
        <?php if ($_GET['operation'] == 'edit'): ?>
        <table class="table">
            <tr>
                <th class="partition" colspan="99">操作提示</th>
            </tr>
            <tr>
                <td>
                    <ul class="tips">
                        <li>如会员在与网站签约的时候可以约定此会员拥有哪项服务，点选后，这里的状态值会在会员店铺中显示，产品列表或详情处等</li>
                    </ul>
                </td>
            </tr>
        </table>
        <form name="form" id="form" method="post">
        <input name="id" type="hidden" id="id" value="<?php echo $this->_tpl_vars['de']['userid']; ?>
">
 		<table class="table table1">
            <thead>
                <tr>
                    <th class="partition" colspan="99">
                    店铺信息
                    <a class="fr" href="to_login.php?action=submit&user=<?php echo $this->_tpl_vars['de']['user']; ?>
" target="_blank">进入店铺后台</a>
                    </th>
                </tr>
            </thead>
            <tbody>
            <tr>
                <td width="100">店主用户名</td>
                <td><a target="_blank" href="../home.php?uid=<?php echo $this->_tpl_vars['de']['userid']; ?>
"><?php echo $this->_tpl_vars['de']['user']; ?>
</a></td>
            </tr>
            <tr>
                <td>商铺名称</td>
                <td>
                <a target="_blank" href="../shop.php?uid=<?php echo $this->_tpl_vars['de']['userid']; ?>
"><?php echo $this->_tpl_vars['de']['company']; ?>
</a>&nbsp;
                <?php if ($this->_tpl_vars['de']['shop_auth'] == 1): ?>
                <a target="_blank" href="<?php echo $this->_tpl_vars['de']['shop_auth_pic']; ?>
"><img align="absmiddle" src="../image/default/certification.gif" /></a>
                <?php else: ?>
                    <?php if ($this->_tpl_vars['de']['shop_auth_pic']): ?><a target="_blank" href="<?php echo $this->_tpl_vars['de']['shop_auth_pic']; ?>
"><img align="absmiddle" src="../image/default/certification_no.gif" /></a><?php else: ?><?php endif; ?>
                <?php endif; ?>
                 <?php if ($this->_tpl_vars['de']['shopkeeper_auth'] == 1): ?>
                <a target="_blank" href="<?php echo $this->_tpl_vars['de']['shopkeeper_auth_pic']; ?>
"><img align="absmiddle" src="../image/default/certautonym.gif" /></a>
                <?php else: ?>
                    <?php if ($this->_tpl_vars['de']['shopkeeper_auth_pic']): ?><a target="_blank" href="<?php echo $this->_tpl_vars['de']['shopkeeper_auth_pic']; ?>
"><img align="absmiddle" src="../image/default/certautonym_no.gif" /></a><?php else: ?><?php endif; ?>
                <?php endif; ?>
                </td>
            </tr>
            <tr>
                <td>地址</td>
                <td><?php echo $this->_tpl_vars['de']['area']; ?>
 <?php echo $this->_tpl_vars['de']['addr']; ?>
</td>
            </tr>
            <tr>
                <td>联系电话</td>
                <td><?php echo $this->_tpl_vars['de']['tel']; ?>
</td>
            </tr>
            <tr>
                <td>主营商品</td>
                <td><?php echo $this->_tpl_vars['de']['main_pro']; ?>
</td>
            </tr>
            <tr>
                <td>上次登入时间</td>
                <td><?php echo ((is_array($_tmp=$this->_tpl_vars['de']['uptime'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%Y-%m-%d&nbsp;%H:%M:%S") : smarty_modifier_date_format($_tmp, "%Y-%m-%d&nbsp;%H:%M:%S")); ?>
</td>
            </tr>
            <tr>
                <td>创店时间</td>
                <td><?php echo ((is_array($_tmp=$this->_tpl_vars['de']['create_time'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%Y-%m-%d&nbsp;%H:%M:%S") : smarty_modifier_date_format($_tmp, "%Y-%m-%d&nbsp;%H:%M:%S")); ?>
</td>
            </tr>
            <tr>
                <td>商品数量</td>
                <td><?php echo $this->_tpl_vars['de']['product_num']; ?>
</td>
            </tr>
            <tr>
                <td>收藏数量</td>
                <td><?php echo $this->_tpl_vars['de']['shop_collect']; ?>
</td>
            </tr>
            <tr>
                <td>访问数量</td>
                <td><input type="text" name="view" value="<?php echo $this->_tpl_vars['de']['view_times']; ?>
"></td>
            </tr>
            <tr>
                <td>有效期</td>
                <td>
                <script language="javascript">
				var cdr = new Calendar("cdr");
				document.write(cdr);
				cdr.showMoreDay = true;
				</script>
				<input type="text" name="stime" value="<?php echo $this->_tpl_vars['de']['stime']; ?>
" onFocus="cdr.show(this);"/>
				--
				<input type="text" name="etime" value="<?php echo $this->_tpl_vars['de']['etime']; ?>
" onFocus="cdr.show(this);"/> (exp:2008-02-01)
                </td>
            </tr>

            <tr>
                <td>店铺等级</td>
                <td>
                <select name="grade" id="grade">
                    <?php $_from = $this->_tpl_vars['grade']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['list']):
?>
                    <option value="<?php echo $this->_tpl_vars['list']['id']; ?>
" <?php if ($this->_tpl_vars['de']['grade'] == $this->_tpl_vars['list']['id']): ?>selected="selected"<?php endif; ?> ><?php echo $this->_tpl_vars['list']['name']; ?>
</option>
                    <?php endforeach; endif; unset($_from); ?>
                </select>
                </td>
            </tr>
            <tr>
                <td>店铺分类</td>
                <td>
                    <input type="hidden" name="oldcatid" value="<?php echo $this->_tpl_vars['de']['catid']; ?>
" />
                    <?php if ($this->_tpl_vars['de']['cat']): ?><div id="d_1"><?php echo $this->_tpl_vars['de']['cat']; ?>
&nbsp;&nbsp;<a href="javascript:sd();">编辑</a></div><?php endif; ?>
                	<div id="d_2" <?php if ($this->_tpl_vars['de']['cat']): ?>class="hidden"<?php endif; ?>>
                    <select class="select" name="catid" id="catid" onChange="getHTML(this.value,'tcatid')">
                    <option value="">--请选择--</option>
                    <?php $_from = $this->_tpl_vars['catlist']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['list']):
?><option value="<?php echo $this->_tpl_vars['list']['id']; ?>
" <?php if ($this->_tpl_vars['list']['id'] == $this->_tpl_vars['de']['catid']): ?>selected="selected"<?php endif; ?> ><?php echo $this->_tpl_vars['list']['name']; ?>

                    </option>
                    <?php endforeach; endif; unset($_from); ?>
                    </select>
                    <select class="select" style="visibility:hidden" name="tcatid" id="tcatid" onChange="getHTML(this.value,'scatid')">
                    </select>
                    <select class="select" style="visibility:hidden" name="scatid" id="scatid" onChange="getHTML(this.value,'sscatid')">
                    </select>
                    <select class="select" style="visibility:hidden"  name="sscatid" id="sscatid">
                    </select>
                    </div>
                </td>
            </tr>
           	<tr>
                <td>保证金</td>
                <td><?php echo $this->_tpl_vars['de']['earnest']; ?>
</td>
            </tr>
            <tr>
                <td>增加保证金</td>
                <td><input type="text" name="earnest" value=""></td>
            </tr>

            <?php if ($this->_tpl_vars['shop_type'] == 1): ?>
            <tr>
                <td>是否开通店铺</td>
                <td>
                	<?php if ($_GET['type'] == 'application'): ?>
                    <label><input name="shop_statu" <?php if ($this->_tpl_vars['de']['shop_statu'] == '1'): ?>checked="checked"<?php endif; ?> type="radio" class="radio" value="1" />审核通过开启</label>
                    <label><input name="shop_statu" <?php if ($this->_tpl_vars['de']['shop_statu'] == '0'): ?>checked="checked"<?php endif; ?> type="radio" class="radio" value="0" />待审核</label>
                    <label><input name="shop_statu" <?php if ($this->_tpl_vars['de']['shop_statu'] == '-2'): ?>checked="checked"<?php endif; ?> type="radio" class="radio" value="-2"  />审核不通过</label>
                    <?php else: ?>
                	<label><input name="shop_statu" <?php if ($this->_tpl_vars['de']['shop_statu'] == '1'): ?>checked="checked"<?php endif; ?> type="radio" class="radio" value="1" />开启</label>
                    <label><input name="shop_statu" <?php if ($this->_tpl_vars['de']['shop_statu'] == '0'): ?>checked="checked"<?php endif; ?> type="radio" class="radio" value="0" />待审核</label>
             		<label><input name="shop_statu" <?php if ($this->_tpl_vars['de']['shop_statu'] == '-1'): ?>checked="checked"<?php endif; ?> type="radio" class="radio" value="-1" />关闭</label>
                    <?php endif; ?>
            	</td>
            </tr>
                <?php if ($this->_tpl_vars['distribution_user_state'] == -3): ?>
                <tr>
                    <td>平台提取佣金比率</td>
                    <td><input type="text" name="commission_shop_rate_plantform" class="w250" value="<?php echo $this->_tpl_vars['de']['commission_shop_rate_plantform']; ?>
"></td>
                </tr>
                <tr>
                    <td>一级店铺佣金比率</td>
                    <td><input type="text" name="commission_shop_rate_0" class="w250" value="<?php echo $this->_tpl_vars['de']['commission_shop_rate_0']; ?>
"></td>
                </tr>
                <tr>
                    <td>二级店铺佣金比率</td>
                    <td><input type="text" name="commission_shop_rate_1" class="w250" value="<?php echo $this->_tpl_vars['de']['commission_shop_rate_1']; ?>
"></td>
                </tr>
                <tr>
                    <td>三级店铺佣金比率</td>
                    <td><input type="text" name="commission_shop_rate_2" class="w250" value="<?php echo $this->_tpl_vars['de']['commission_shop_rate_2']; ?>
"></td>
                </tr>
                <?php endif; ?>
            <?php else: ?>
            <tr>
                <td>是否开通分销店铺</td>
                <td>
                    <?php if ($_GET['type'] == 'application'): ?>
                    <label><input name="shop_statu" <?php if ($this->_tpl_vars['de']['shop_statu'] == '-3'): ?>checked="checked"<?php endif; ?> type="radio" class="radio" value="-3" />审核通过，开启分销店铺</label>
                    <label><input name="shop_statu" <?php if ($this->_tpl_vars['de']['shop_statu'] == '-4'): ?>checked="checked"<?php endif; ?> type="radio" class="radio" value="-4" />待审核</label>
                    <label><input name="shop_statu" <?php if ($this->_tpl_vars['de']['shop_statu'] == '-5'): ?>checked="checked"<?php endif; ?> type="radio" class="radio" value="-5"  />审核不通过</label>
                    <?php else: ?>
                    <label><input name="shop_statu" <?php if ($this->_tpl_vars['de']['shop_statu'] == '-3'): ?>checked="checked"<?php endif; ?> type="radio" class="radio" value="-3" />开启分销</label>
                    <label><input name="shop_statu" <?php if ($this->_tpl_vars['de']['shop_statu'] == '-4'): ?>checked="checked"<?php endif; ?> type="radio" class="radio" value="-4" />待审核</label>
                    <label><input name="shop_statu" <?php if ($this->_tpl_vars['de']['shop_statu'] == '-6'): ?>checked="checked"<?php endif; ?> type="radio" class="radio" value="-6" />关闭</label>
                    <?php endif; ?>
                </td>
            </tr>
            <?php endif; ?>
             <tr>
                <td>审核结果说明</td>
                <td><input type="text" name="reason" class="w250" value="<?php echo $this->_tpl_vars['de']['reason']; ?>
" ></td>
            </tr>
            <tr>
                <td>店铺顶级域名</td>
                <td><input type="text" name="domin" class="w250" value="<?php echo $this->_tpl_vars['de']['domin']; ?>
"></td>
            </tr>
            <tr>
                <td>推荐状态</td>
                    <td>
                    <?php $_from = $this->_tpl_vars['rc_member']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['num'] => $this->_tpl_vars['list']):
?>

                    <input type="radio" name="statu" id="tj<?php echo $this->_tpl_vars['num']; ?>
" value="<?php echo $this->_tpl_vars['num']; ?>
" <?php if ($this->_tpl_vars['de']['statu'] == $this->_tpl_vars['num']): ?> checked="checked" <?php endif; ?> ><label for="tj<?php echo $this->_tpl_vars['num']; ?>
"><?php echo $this->_tpl_vars['list']; ?>
</label>
                    </option>
                    <?php endforeach; endif; unset($_from); ?>
                </td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td>
                <input class="submit" type="submit" value="提交">
                <input name="act" type="hidden" id="action" value="edit">
                </td>
            </tr>
            </tbody>
        </table>
        </form>
        <?php elseif ($_GET['operation'] == 'list'): ?>
        <script type="text/javascript">
        $(function(){
            /* 全选 */
             $('.checkall').click(function(){
                var _self = this;
                $('.checkitem').each(function(){
                    if (!this.disabled)
                    {
                        $(this).attr('checked', _self.checked);
                    }
                });
                $('.checkall').attr('checked', this.checked);
            });
        });
        </script>
        <form action="" method="post">
        <table class="table">
            <tbody>
                <tr class="header">
                    <th width="30">删</th>
                    <th width="70">排名指数</th>
                    <th width="120" class="al">店主用户名</th>
                    <th class="al">商铺名称</th>
                    <th width="120">店铺等级</th>
                    <th width="120">商品数量</th>
                    <th width="120">保证金</th>
                    <th width="120">创店时间</th>
                    <th width="50">状态</th>
                   	<th width="50"></th>
          		</tr>
                <?php $_from = $this->_tpl_vars['de']['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['list']):
?>
                <tr>
                    <td><input type="checkbox" value="<?php echo $this->_tpl_vars['list']['userid']; ?>
" class="checkitem" name="chk[]"></td>
                    <td><input type="text" class="w50" maxlength="3" name="rank[<?php echo $this->_tpl_vars['list']['userid']; ?>
]" value="<?php echo $this->_tpl_vars['list']['rank']; ?>
" onbeforepaste="clipboardData.setData('text',clipboardData.getData('text').replace(/[^\d]/g,''))" onkeyup="value=value.replace(/[^\d]/g,'')" /></td>

                    <td class="al"><a target="_blank" href="../home.php?uid=<?php echo $this->_tpl_vars['list']['userid']; ?>
"><?php echo $this->_tpl_vars['list']['user']; ?>
</a></td>
                    <td class="al">
                    <a target="_blank" href="../shop.php?uid=<?php echo $this->_tpl_vars['list']['userid']; ?>
"><?php echo $this->_tpl_vars['list']['company']; ?>
</a>&nbsp;
                    <?php if ($this->_tpl_vars['list']['shop_auth'] == 1): ?>
                    <a target="_blank" href="<?php echo $this->_tpl_vars['list']['shop_auth_pic']; ?>
"><img align="absmiddle" src="../image/default/certification.gif" /></a>
                    <?php else: ?>
                        <?php if ($this->_tpl_vars['list']['shop_auth_pic']): ?><a target="_blank" href="<?php echo $this->_tpl_vars['list']['shop_auth_pic']; ?>
"><img align="absmiddle" src="../image/default/certification_no.gif" /></a><?php else: ?><?php endif; ?>
                    <?php endif; ?>
                    <?php if ($this->_tpl_vars['list']['shopkeeper_auth'] == 1): ?>
                    <a target="_blank" href="<?php echo $this->_tpl_vars['list']['shopkeeper_auth_pic']; ?>
"><img align="absmiddle" src="../image/default/certautonym.gif" /></a>
                    <?php else: ?>
                        <?php if ($this->_tpl_vars['list']['shopkeeper_auth_pic']): ?><a target="_blank" href="<?php echo $this->_tpl_vars['list']['shopkeeper_auth_pic']; ?>
"><img align="absmiddle" src="../image/default/certautonym_no.gif" /></a><?php else: ?><?php endif; ?>
                    <?php endif; ?>
                    </td>
                    <td><?php echo $this->_tpl_vars['list']['grade']; ?>
</td>
                    <td>&nbsp;<?php echo $this->_tpl_vars['list']['product_num']; ?>
</td>
                    <td>&nbsp;<?php echo $this->_tpl_vars['list']['earnest']; ?>
</td>
                    <td><?php echo ((is_array($_tmp=$this->_tpl_vars['list']['create_time'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%Y-%m-%d <br> %H:%M:%S") : smarty_modifier_date_format($_tmp, "%Y-%m-%d <br> %H:%M:%S")); ?>
</td>
          			<td><?php if ($this->_tpl_vars['list']['shop_statu'] == 1): ?>卖家店铺开启<?php elseif ($this->_tpl_vars['list']['shop_statu'] == -3): ?>分销店铺开启<?php elseif ($this->_tpl_vars['list']['shop_statu'] == -6): ?>分销店铺关闭<?php else: ?>卖家店铺关闭<?php endif; ?></td>
                    <td>
                    <a href="?m=shop&s=shop.php&operation=edit&editid=<?php echo $this->_tpl_vars['list']['userid']; ?>
&<?php echo $this->_tpl_vars['getstr']; ?>
"><?php echo $this->_tpl_vars['editimg']; ?>
</a>
                    <a href="to_login.php?action=submit&user=<?php echo $this->_tpl_vars['list']['user']; ?>
" target="_blank"><?php echo $this->_tpl_vars['setimg']; ?>
</a>
                    </td>

                </tr>
                <?php endforeach; else: ?>
                <tr>
                    <td class="norecord" colspan="99"><i></i><span>暂无符合条件的数据记录</span></td>
                </tr>
                <?php endif; unset($_from); ?>
            </tbody>
            <tfoot>
                <tr>
                	<td colspan="2">
                        <input type="checkbox" class="checkall" id="del">
                        <input type="hidden" name="act" value="op" />
                        <input type="submit" value="提交" />
                    </td>
                    <td colspan="99"><div class="page"><?php echo $this->_tpl_vars['de']['page']; ?>
</div></td>
                </tr>
            </tfoot>
        </table>
        </form>
        <?php else: ?>
        <table class="table">
            <tr>
                <th class="partition" colspan="99">提示</th>
            </tr>
            <tr>
            	<td>
                	<ul class="tips">
                    	<li>通过店铺管理，您可以进行编辑店铺信息、店铺类型以及删除店铺等操作。</li>
                        <li>请先根据条件搜索用户，然后选择相应的操作。</li>
                    </ul>
                </td>
            </tr>
        </table>
        <form name="form" id="form" method="get">
        <input name="m" type="hidden" id="m" value="<?php echo $_GET['m']; ?>
">
        <input name="s" type="hidden" id="s" value="<?php echo $_GET['s']; ?>
">
        <input name="operation" type="hidden" id="operation" value="list">
        <table class="table table1">
            <tbody>
            <tr>
                <td width="100">会员名</td>
                <td><input type="text" class="w350" name="name" id="name" /></td>
            </tr>
            <tr>
                <td width="100">会员ID</td>
                <td><input type="text" class="w350" name="id" id="id" /></td>
            </tr>
            <tr>
                <td>商铺名称</td>
                <td><input type="text" class="w350" name="shop_name" id="shop_name" /></td>
            </tr>
            <!--<tr>
                <td>店铺类型</td>
                <td>
                <select name="grade[]" id="grade" class="w350" size="5" style="height:auto;" multiple="multiple">
               		<?php $_from = $this->_tpl_vars['grade']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['list']):
?>
                    <option value="<?php echo $this->_tpl_vars['list']['id']; ?>
"><?php echo $this->_tpl_vars['list']['name']; ?>
</option>
                    <?php endforeach; endif; unset($_from); ?>
                </select>
                </td>
            </tr>-->
            <tr>
                <td>店铺分类</td>
                <td>
                <select name="catid[]" id="catid" class="w350" size="10" style="height:auto;" multiple="multiple">
                    <?php $_from = $this->_tpl_vars['catlist']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['list']):
?>
                    <option value="<?php echo $this->_tpl_vars['list']['id']; ?>
"><?php echo $this->_tpl_vars['list']['name']; ?>
</option>
                    <?php endforeach; endif; unset($_from); ?>
                </select>
                </td>
            </tr>
            <tr>
                <td>所在地区</td>
                <td>
                <input type="hidden" id="t" />
                <input type="hidden" name="province" id="id_1" value="<?php echo ((is_array($_tmp=$_SESSION['province'])) ? $this->_run_mod_handler('getdistrictid', true, $_tmp) : getdistrictid($_tmp)); ?>
" />
                <input type="hidden" name="city" id="id_2" value="<?php echo ((is_array($_tmp=$_SESSION['city'])) ? $this->_run_mod_handler('getdistrictid', true, $_tmp) : getdistrictid($_tmp)); ?>
"  />
                <input type="hidden" name="area" id="id_3" value="<?php echo ((is_array($_tmp=$_SESSION['area'])) ? $this->_run_mod_handler('getdistrictid', true, $_tmp) : getdistrictid($_tmp)); ?>
" />
                <?php if (! $_SESSION['province']): ?>
                <select id="select_1" onChange="district(this);">
                <option value="">--请选择--</option>
                <?php echo $this->_tpl_vars['prov']; ?>

                </select>
                <select id="select_2" onChange="district(this);" class="hidden"></select>
                <select id="select_3" onChange="district(this);" class="hidden"></select>
                <?php endif; ?>
                </td>
            </tr>

            <tr>
                <td>&nbsp;</td>
                <td><input class="submit" type="submit" value="提交"></td>
            </tr>
            </tbody>
        </table>
            </form>
        <?php endif; ?>
    </div>
</body>
</html>