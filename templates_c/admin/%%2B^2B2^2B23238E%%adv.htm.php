<?php /* Smarty version 2.6.20, created on 2016-03-03 11:59:33
         compiled from adv.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'adv.htm', 128, false),)), $this); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>广告管理</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="admin.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="../script/jquery-1.4.4.min.js"></script>
<script type="text/javascript" src="../script/jquery.validation.min.js"></script>
<script src="../script/my_lightbox.js" language="javascript"></script>
<script language="javascript" src="../script/Calendar.js"></script>
<script language="javascript">
var weburl="<?php echo $this->_tpl_vars['config']['weburl']; ?>
";

</script>
</head>
<body>
	<div class="container">
        <div class="flow">
            <div class="itemtitle">
                <h3>广告</h3>
                <ul>
					<li <?php if ($_GET['operation'] == ''): ?>class="current"<?php endif; ?>><a href="?m=adv&s=adv.php"><span>广告位管理</span></a></li>
                      
					<li <?php if ($_GET['operation'] == 'add_ads'): ?>class="current"<?php endif; ?>><a href="?m=adv&s=adv.php&operation=add_ads"><span>新增广告位</span></a></li>
                    
                    <li <?php if ($_GET['operation'] == 'ads'): ?>class="current"<?php endif; ?>><a href="?m=adv&s=adv.php&operation=ads"><span>广告管理</span></a></li>
                  
                    <li <?php if ($_GET['operation'] == 'add'): ?>class="current"<?php endif; ?>><a href="?m=adv&s=adv.php&operation=add"><span>新增广告</span></a></li>
                </ul>
            </div>
        </div>
        
        <div class="h35"></div> 
         
        <?php if ($_GET['operation'] == 'add' || $_GET['operation'] == 'edit'): ?>
        	<script language="javascript">
			var cdr = new Calendar("cdr");
			document.write(cdr);
			cdr.showMoreDay = true;
			
			$(function(){
				$('#form').validate({
					errorPlacement: function(error, element){
						element.nextAll('.form-error').append(error);
					},      
					rules : {
						name:{
							required:true
						},
						stime:{
							required:true
						},
						etime:{
							required:true
						},
						
					},
					messages : {
						name:{
							required:'请填写广告名称',
						},
						etime:{
							required:'请填写开始时间',
						},
						stime:{
							required:'请填写结束时间',
						},
						
					}
				});
			});
			</script>
            <form name="form" id="form" method="post">
            <input name="id" type="hidden" id="id" value="<?php echo $this->_tpl_vars['de']['ID']; ?>
">
            <table class="table table1">
            	<thead>
                    <tr>
                        <th class="partition" colspan="99">新增广告</th>
                    </tr>
                </thead>
                <tbody>
                <tr>
					<td width="100">广告名称</td>
                    <td>
                    <input name="name" id="name" type="text" class="w350" value="<?php echo $this->_tpl_vars['de']['name']; ?>
"><div id="form-error" class="form-error"></div>
                    </td>
                </tr>
                
                <tr>
                	<td>广告位</td>              
                    <td>
                    <select id="group_id" name="group_id">
                    	<?php $_from = $this->_tpl_vars['re']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['list']):
?>
                        	<option data-param="{'type':'<?php echo $this->_tpl_vars['list']['ad_type']; ?>
'}" value="<?php echo $this->_tpl_vars['list']['ID']; ?>
" <?php if ($this->_tpl_vars['list']['ID'] == $this->_tpl_vars['de']['group_id']): ?>selected="selected"<?php endif; ?> ><?php echo $this->_tpl_vars['list']['name']; ?>
</option>
                        <?php endforeach; endif; unset($_from); ?>
                    </select>
                    <input type="hidden" name="ad_type" id="ad_type" value="<?php if ($this->_tpl_vars['de']['ad_type']): ?><?php echo $this->_tpl_vars['de']['ad_type']; ?>
<?php else: ?><?php echo $this->_tpl_vars['re']['0']['ad_type']; ?>
<?php endif; ?>" />
                 	</td>
                </tr>
                
                <tr>
                	<td>类别</td>              
                    <td><span id="cat"><?php $_from = $this->_tpl_vars['type']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['slist']):
?><?php if ($this->_tpl_vars['de']['ad_type']): ?><?php if ($this->_tpl_vars['key'] == $this->_tpl_vars['de']['ad_type']): ?><?php echo $this->_tpl_vars['slist']; ?>
<?php endif; ?><?php else: ?><?php if ($this->_tpl_vars['key'] == $this->_tpl_vars['re']['0']['ad_type']): ?><?php echo $this->_tpl_vars['slist']; ?>
<?php endif; ?><?php endif; ?><?php endforeach; endif; unset($_from); ?></span></td>
                </tr>
                
                <tr>
                	<td>投入类别ＩＤ</td>                 
                    <td>
                    <input name="catid" id="catid" type="text" class="w350" value="<?php if ($this->_tpl_vars['de']['catid']): ?><?php echo $this->_tpl_vars['de']['catid']; ?>
<?php else: ?>0<?php endif; ?>">
                 	</td>
                </tr>
                
                <tr>
                	<td>链接网址</td>                  
                    <td>
                    <input name="url" id="url" type="text" class="w350" value="<?php echo $this->_tpl_vars['de']['url']; ?>
">
                 	</td>
                </tr>
                
                <tr>
                	<td>起止时间</td>
                    <td>
                    <script language="javascript">
                    var cdr = new Calendar("cdr");
                    document.write(cdr);
                    cdr.showMoreDay = true;
                    </script>
                    <input onFocus="cdr.show(this);" class="w160" type="text" name="stime" id="stime" value="<?php if ($this->_tpl_vars['de']['stime']): ?><?php echo ((is_array($_tmp=$this->_tpl_vars['de']['stime'])) ? $this->_run_mod_handler('date_format', true, $_tmp) : smarty_modifier_date_format($_tmp)); ?>
<?php else: ?><?php echo ((is_array($_tmp=$this->_tpl_vars['time'])) ? $this->_run_mod_handler('date_format', true, $_tmp) : smarty_modifier_date_format($_tmp)); ?>
<?php endif; ?>">
                    <s>-</s>
                    <input onFocus="cdr.show(this);" class="w160" type="text" name="etime" id="etime" value="<?php if ($this->_tpl_vars['de']['stime']): ?><?php echo ((is_array($_tmp=$this->_tpl_vars['de']['etime'])) ? $this->_run_mod_handler('date_format', true, $_tmp) : smarty_modifier_date_format($_tmp)); ?>
<?php else: ?><?php echo ((is_array($_tmp=$this->_tpl_vars['time1'])) ? $this->_run_mod_handler('date_format', true, $_tmp) : smarty_modifier_date_format($_tmp)); ?>
<?php endif; ?>">
                    <div id="form-error" class="form-error"></div>
                    
                </tr>
                <tr id="tr1" <?php if ($this->_tpl_vars['de']['ad_type'] == 3): ?>class="hidden"<?php endif; ?>>
                	<td>图片</td>
                    <td>
					<input name="pic" class="w350" type="text" id="pic" value="<?php echo $this->_tpl_vars['de']['picName']; ?>
" />	
                    [<a href="javascript:uploadfile('上传LOGO','pic','','','adv')">上传</a>] 
                    [<a href="javascript:preview('pic');">预览</a>]
                    [<a onclick="javascript:$('#pic').val('');" href="#">删除</a>]
                    <div id="form-error" class="form-error"></div>
                    </td>
                </tr>
                <tr id="tr2" <?php if ($this->_tpl_vars['de']['ad_type'] != 3): ?>class="hidden"<?php endif; ?>>
                	<td>文本</td>
                    <td>
					<textarea class="w343" name="con"><?php echo $this->_tpl_vars['de']['con']; ?>
</textarea>
                    </td>
                </tr>
                <tr>
                	<td>是否开启</td>
                    <td>
                    <input name="isopen" type="checkbox" class="checkbox" id="isopen" value="1" <?php if ($this->_tpl_vars['de']['isopen'] == 1): ?>checked="checked"<?php endif; ?> />
                    <label for="isopen">开启</label>
                    </td>
                </tr>
                <tr>
                	<td></td>
                    <td>
                    <input class="submit" type="submit" value="提交">
                    <input name="act" type="hidden" id="action" value="<?php if (! $_GET['editid']): ?>save<?php else: ?>edit<?php endif; ?>">
                    </td>
                </tr>
                </tbody>
            </table>
            </form>
            <script>
            
			$("#group_id").change(function(){
				
				var arr = new Array();
				<?php $_from = $this->_tpl_vars['type']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['num'] => $this->_tpl_vars['list']):
?>
				arr.push('<?php echo $this->_tpl_vars['list']; ?>
');
				<?php endforeach; else: ?>
				arr.push('');
				<?php endif; unset($_from); ?>
				
				var val=$(this).val();
				$.each($('option[value="'+val+'"]'),function(i){
					var data = $(this).attr('data-param');
					eval("data = "+data);
					$('#cat').html(arr[data.type]);
					$('#ad_type').val(data.type);
					if(data.type==3)
					{
						$('#tr1').addClass('hidden');
						$('#tr2').removeClass('hidden');
					}
					else
					{
						$('#tr2').addClass('hidden');
						$('#tr1').removeClass('hidden');
					}
				})
				
				
			})
            </script>
		<?php elseif ($_GET['operation'] == 'add_ads' || $_GET['operation'] == 'edit_ads'): ?>
       		<script language="javascript">
			$(function(){
				$('#form').validate({
					errorPlacement: function(error, element){
						element.nextAll('.form-error').append(error);
					},      
					rules : {
						name:{
							required:true
						},
						width:{
							required:true
						},
						height:{
							required:true
						},
						
					},
					messages : {
						name:{
							required:'请填写广告名称',
						},
						width:{
							required:'请填写宽',
						},
						height:{
							required:'请填写高',
						},
						
					}
				});
			});
			</script>
            <form name="form" id="form" method="post">
            <input name="id" type="hidden" id="id" value="<?php echo $this->_tpl_vars['de']['ID']; ?>
">
            <table class="table table1">
            	<thead>
                    <tr>
                        <th class="partition" colspan="99">新增广告位</th>
                    </tr>
                </thead>
                <tbody>
                <tr>
					<td width="100">广告位名称</td>
                    <td>
                    <input name="name" id="name" type="text" class="w350" value="<?php echo $this->_tpl_vars['de']['name']; ?>
"><div id="form-error" class="form-error"></div>
                    </td>
                </tr>
                
                <tr>
                	<td>广告位分组</td>              
                    <td>
                    <input name="group" id="group" type="text" class="w350" value="<?php echo $this->_tpl_vars['de']['group']; ?>
">
                 	</td>
                </tr>
                
                <tr>
                	<td>广告位类型</td>                 
                    <td>
                    <select name="ad_type">
                  	<?php $_from = $this->_tpl_vars['type']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['list']):
?>
                    	<option value="<?php echo $this->_tpl_vars['key']; ?>
" <?php if ($this->_tpl_vars['key'] == $this->_tpl_vars['de']['ad_type']): ?>selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['list']; ?>
</option>
                    <?php endforeach; endif; unset($_from); ?>
                    </select>
                 	</td>
                </tr>
                
                <tr>
                	<td>宽×高</td>
                    <td>
                    <input class="w160" type="text" name="width" id="width" value="<?php if ($this->_tpl_vars['de']['width']): ?><?php echo $this->_tpl_vars['de']['width']; ?>
<?php else: ?>100<?php endif; ?>">
                    <s>X</s>
                    <input class="w160" type="text" name="height" id="height" value="<?php if ($this->_tpl_vars['de']['height']): ?><?php echo $this->_tpl_vars['de']['height']; ?>
<?php else: ?>100<?php endif; ?>">
                    <div id="form-error" class="form-error"></div>
                    
                </tr>
                 <tr>
                	<td>出售价格</td>
                    <td>
                    <input class="w160" type="text" name="price" id="price" value="<?php if ($this->_tpl_vars['de']['price']): ?><?php echo $this->_tpl_vars['de']['price']; ?>
<?php else: ?>0<?php endif; ?>">
                    <s>/</s>
                    <select name="unit" class="w162">
                        <option <?php if ($this->_tpl_vars['de']['unit'] == 'day'): ?>selected="selected"<?php endif; ?> value="day">天</option>
                        <option <?php if ($this->_tpl_vars['de']['unit'] == 'week'): ?>selected="selected"<?php endif; ?> value="week">星期</option>
                        <option <?php if ($this->_tpl_vars['de']['unit'] == 'month'): ?>selected="selected"<?php endif; ?> value="month">月</option>
                    </select>
                </tr>
                <tr>
                	<td>广告位数量</td>
                    <td>
					<input name="total" class="w350" type="text" id="total" value="<?php echo $this->_tpl_vars['de']['total']; ?>
" />	
					<em>(设为0时不可购买)</em>
					</td>
                </tr>
                <tr>
                	<td>广告位描述</td>
                    <td><textarea class="w343" rows="5" name="con"><?php echo $this->_tpl_vars['de']['con']; ?>
</textarea></td>
                </tr>
                <tr>
                	<td></td>
                    <td>
                    <input class="submit" type="submit" value="提交">
                    <input name="act" type="hidden" id="action" value="<?php if (! $_GET['editid']): ?>save<?php else: ?>edit<?php endif; ?>">
                    </td>
                </tr>
                </tbody>
            </table>
            </form>
        <?php elseif ($_GET['operation'] == 'ads'): ?>
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
        <form action="" method="get">
        <input type="hidden" name="m" value="adv">
        <input type="hidden" name="s" value="adv.php">
        <input type="hidden" name="operation" value="ads">
        <table class="select_table">
            <tbody>
                <tr>
                    <td width="70">广告名称:</td>
                    <td width="260"><input type="text" name="name" class="w250" value="<?php echo $_GET['name']; ?>
" /></td>
               		<td width="70">广告位类别:</td>
                    <td width="70">
                    <select name="ad_type">
                    <option value="">请选择</option>
                  	<?php $_from = $this->_tpl_vars['type']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['list']):
?>
                    	<option value="<?php echo $this->_tpl_vars['key']+1; ?>
" <?php if (( $this->_tpl_vars['key']+1 ) == $_GET['ad_type']): ?>selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['list']; ?>
</option>
                    <?php endforeach; endif; unset($_from); ?>
                    </select>
                    </td>
					<td width="70">所属广告位:</td>
                    <td width="70">
                    <select name="group">
                    <option value="">请选择</option>
                  	<?php $_from = $this->_tpl_vars['re']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['list']):
?>
                    	<option value="<?php echo $this->_tpl_vars['list']['ID']; ?>
" <?php if ($this->_tpl_vars['list']['ID'] == $_GET['group']): ?>selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['list']['name']; ?>
</option>
                    <?php endforeach; endif; unset($_from); ?>
                    </select></td>
                    <td><input type="image" src="../image/admin/search.gif" /></td>
                </tr>
            </tbody>
        </table>
        </form>
        <form action="" method="post">
        <input name="type" type="hidden" id="type" value="<?php echo $_GET['type']; ?>
">
        <table class="table">
            <tbody>
                <tr class="header partition">
                    <th width="30"></th>
                    <th class="al">广告名称</th>
                    <th>所属广告位</th>
                    <th width="70">类别</th>
                    <th width="70">投入类别</th>
                    <th width="50">地区</th>
                    <th width="90">开始时间</th>
                    <th width="90">结束时间</th>
                    <th width="70">点击率</th>
                    <th width="100">广告主</th>
                    <th width="50">状态</th>
                    <th width="50"></th>
                </tr>
                <?php $_from = $this->_tpl_vars['de']['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['list']):
?>
                <tr>
                    <td><input type="checkbox" value="<?php echo $this->_tpl_vars['list']['ID']; ?>
" class="checkitem" name="chk[]"></td>
                    <td class="al"><?php echo $this->_tpl_vars['list']['name']; ?>
</td>
                    <td><?php echo $this->_tpl_vars['list']['title']; ?>
</td>
                    <td><?php $_from = $this->_tpl_vars['type']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['slist']):
?><?php if ($this->_tpl_vars['key'] == $this->_tpl_vars['list']['ad_type']): ?><?php echo $this->_tpl_vars['slist']; ?>
<?php endif; ?><?php endforeach; endif; unset($_from); ?></td>
                    <td><?php echo $this->_tpl_vars['list']['catid']; ?>
</td>
                    <td><?php if ($this->_tpl_vars['list']['province'] || $this->_tpl_vars['list']['city'] || $this->_tpl_vars['list']['area']): ?><a title="<?php echo $this->_tpl_vars['list']['province']; ?>
<?php echo $this->_tpl_vars['list']['city']; ?>
<?php echo $this->_tpl_vars['list']['area']; ?>
">分站</a><?php else: ?>总站<?php endif; ?></td>
                    <td><?php echo ((is_array($_tmp=$this->_tpl_vars['list']['stime'])) ? $this->_run_mod_handler('date_format', true, $_tmp) : smarty_modifier_date_format($_tmp)); ?>
</td>
                    <td><?php echo ((is_array($_tmp=$this->_tpl_vars['list']['etime'])) ? $this->_run_mod_handler('date_format', true, $_tmp) : smarty_modifier_date_format($_tmp)); ?>
</td>
                    <td><?php echo $this->_tpl_vars['list']['shownum']; ?>
</td>
                    <td><?php if ($this->_tpl_vars['list']['user']): ?><a href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/shop.php?uid=<?php echo $this->_tpl_vars['list']['userid']; ?>
" target="_break" ><?php echo $this->_tpl_vars['list']['user']; ?>
</a><?php else: ?>管理员<?php endif; ?></td>
                    <td><?php if ($this->_tpl_vars['list']['isopen'] == 1): ?>开启<?php else: ?>关闭<?php endif; ?></td>
					<td>
                    <a href="?m=adv&s=adv.php&operation=edit&editid=<?php echo $this->_tpl_vars['list']['ID']; ?>
&<?php echo $this->_tpl_vars['getstr']; ?>
"><?php echo $this->_tpl_vars['editimg']; ?>
</a> 
					<a onclick="return confirm('确定删除吗');" href="?m=adv&s=adv.php&operation=ads&delid=<?php echo $this->_tpl_vars['list']['ID']; ?>
&<?php echo $this->_tpl_vars['getstr']; ?>
"><?php echo $this->_tpl_vars['delimg']; ?>
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
                	<td colspan="3">
                        <input type="checkbox" class="checkall" id="del">
                        <input type="hidden" name="act" value="op" />
                        <input type="submit" name="submit" value="删除" />
                    </td>
                    <td colspan="99"><div class="page"><?php echo $this->_tpl_vars['de']['page']; ?>
</div></td>
                </tr>
            </tfoot>
        </table>
        </form>
        <?php else: ?>
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
        <form action="" method="get">
        <input type="hidden" name="m" value="adv">
        <input type="hidden" name="s" value="adv.php">
        <table class="select_table">
            <tbody>
                <tr>
                    <td width="70">广告位名称:</td>
                    <td width="260"><input type="text" name="name" class="w250" value="<?php echo $_GET['name']; ?>
" /></td>
               		<td width="70">广告位类别:</td>
                    <td width="70">
                    <select name="ad_type">
                    <option value="">请选择</option>
                  	<?php $_from = $this->_tpl_vars['type']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['list']):
?>
                    	<option value="<?php echo $this->_tpl_vars['key']+1; ?>
" <?php if (( $this->_tpl_vars['key']+1 ) == $_GET['ad_type']): ?>selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['list']; ?>
</option>
                    <?php endforeach; endif; unset($_from); ?>
                    </select>
                    </td>
					<td width="70">广告位分组:</td>
                    <td width="70">
                    <select name="group">
                    <option value="">请选择</option>
                  	<?php $_from = $this->_tpl_vars['re']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['list']):
?>
                    	<option value="<?php echo $this->_tpl_vars['list']['group']; ?>
" <?php if ($this->_tpl_vars['list']['group'] == $_GET['group']): ?>selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['list']['group']; ?>
</option>
                    <?php endforeach; endif; unset($_from); ?>
                    </select></td>
                    <td><input type="image" src="../image/admin/search.gif" /></td>
                </tr>
            </tbody>
        </table>
        </form>
        <form action="" method="post">
        <input name="type" type="hidden" id="type" value="<?php echo $_GET['type']; ?>
">
        <table class="table">
            <tbody>
                <tr class="header partition">
                    <th width="4"></th>
                    <th class="al" colspan="2">广告位名称</th>
                    <th width="70">分组</th>
                    <th width="70">类别</th>
                    <th width="70">宽度</th>
                    <th width="50">高度</th>
                    <th width="90">单价</th>
                    <th width="90">正在展示</th>
                    <th width="70">已发布</th>
                    <th width="100">点击率</th>
                    <th width="100">调用代码</th>
                    <th width="50"></th>
                </tr>
                <?php $_from = $this->_tpl_vars['de']['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['list']):
?>
                <tr>
                    <td><input type="checkbox" value="<?php echo $this->_tpl_vars['list']['ID']; ?>
" class="checkitem" name="chk[]"></td>
                    <td width="30"><?php echo $this->_tpl_vars['list']['ID']; ?>
</td>
                    <td class="al"><a href="module.php?m=adv&s=adv.php&operation=ads&group=<?php echo $this->_tpl_vars['list']['ID']; ?>
"><?php echo $this->_tpl_vars['list']['name']; ?>
</a></td>
                    <td><?php echo $this->_tpl_vars['list']['group']; ?>
</td>
                    <td><?php $_from = $this->_tpl_vars['type']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['slist']):
?><?php if ($this->_tpl_vars['key'] == $this->_tpl_vars['list']['ad_type']): ?><?php echo $this->_tpl_vars['slist']; ?>
<?php endif; ?><?php endforeach; endif; unset($_from); ?></td>
                    <td><?php echo $this->_tpl_vars['list']['width']; ?>
</td>
                    <td><?php echo $this->_tpl_vars['list']['height']; ?>
</td>
                    <td><?php if ($this->_tpl_vars['list']['price'] != '0.00' && $this->_tpl_vars['list']['price']): ?><?php echo $this->_tpl_vars['list']['price']; ?>
/<?php echo $this->_tpl_vars['list']['unit']; ?>
<?php else: ?>0<?php endif; ?></td>
                    <td><?php echo $this->_tpl_vars['list']['num1']; ?>
</td>
                    <td><?php echo $this->_tpl_vars['list']['num']; ?>
</td>
                    <td><?php echo $this->_tpl_vars['list']['shownum']; ?>
</td>
                    <td><input type="text" readonly="readonly" value="<script src='&lt;{$config.weburl}&gt;/api/ad.php?id=<?php echo $this->_tpl_vars['list']['ID']; ?>
&catid=&lt;{$smarty.get.id}&gt&name=&lt;{$smarty.get.key}&gt'></script>" size="25"></td>
					<td>
                        <a href="?m=adv&s=adv.php&operation=edit_ads&editid=<?php echo $this->_tpl_vars['list']['ID']; ?>
&<?php echo $this->_tpl_vars['getstr']; ?>
"><?php echo $this->_tpl_vars['editimg']; ?>
</a> 
                        <a onclick="return confirm('确定删除吗');" href="?m=adv&s=adv.php&delid=<?php echo $this->_tpl_vars['list']['ID']; ?>
&<?php echo $this->_tpl_vars['getstr']; ?>
"><?php echo $this->_tpl_vars['delimg']; ?>
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
                	<td colspan="3">
                        <input type="checkbox" class="checkall" id="del">
                        <input type="hidden" name="act" value="op" />
                        <input type="submit" name="submit" value="删除" />
                    </td>
                    <td colspan="99"><div class="page"><?php echo $this->_tpl_vars['de']['page']; ?>
</div></td>
                </tr>
            </tfoot>
        </table>
        </form>
        <?php endif; ?>
    </div>
</body>
</html>