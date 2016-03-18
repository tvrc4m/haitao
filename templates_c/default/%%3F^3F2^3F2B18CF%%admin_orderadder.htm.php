<?php /* Smarty version 2.6.20, created on 2016-03-16 14:27:39
         compiled from admin_orderadder.htm */ ?>
<script type="text/javascript" charset="utf-8" src="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/script/district.js" >
</script>
<script type="text/javascript" src="../script/jquery.validation.min.js"></script>
<script language="javascript">
<?php if ($this->_tpl_vars['de']['area']): ?>
	<?php $this->assign('area', 1); ?>
<?php else: ?>
	<?php $this->assign('area', 0); ?>
<?php endif; ?>
$(function(){
	$('#form').validate({
		errorPlacement: function(error, element){
			element.next('.form-error').append(error);
		},      
		rules : {
			name:{
				required:true
			},
			address:{
				required:true
			},
			zip:{
				digits:true
			},
			tel:{
				digits:true
			},
			mobile:{
				required:true,
				digits:true
			}<?php if (! $this->_tpl_vars['de']['area']): ?>
            ,
			select_1:{
				required:true
			},
			select_2:{
				required:true
			},
			select_3:{
				required:true
			}
			<?php endif; ?>
		},
		messages : {
			name:{
				required:'请填写收货人'
			},
			address:{
				required:'请填写街道地址'
			},
			zip:{
				digits:'请填写正确邮编'
			},
			tel:{
				digits:'请填写正确电话'
			},
			mobile:{
				required:'请填写手机号',
				digits:'请填写正确手机号'
			}<?php if (! $this->_tpl_vars['de']['area']): ?>
            ,
			select_1:{
				required:'请选择所属区域'
			},
			select_2:{
				required:'请选择所属区域'
			},
			select_3:{
				required:'请选择所属区域'
			}
			<?php endif; ?>
		}
	});
});
</script>
<div class="path">
    <div>
    	<?php if ($this->_tpl_vars['cg_u_type'] == 1): ?>
    		<a href="main.php?cg_u_type=1">我的商城</a> <span>&gt;</span>
        <?php else: ?>
    		<a href="main.php?cg_u_type=2">卖家中心</a> <span>&gt;</span>
        <?php endif; ?>
        <a href="main.php?m=member&s=admin_orderadder">收货地址</a> <span>&gt;</span>
        <?php if ($_GET['type'] == 'add'): ?>新增收货地址<?php elseif ($_GET['type'] == 'edit'): ?>编辑收货地址<?php else: ?>收货地址列表<?php endif; ?>
    </div>
</div>
<div class="main">
	<div class="wrap">
        <div class="hd">
            <ul class="tabs">
                <li class="<?php if ($_GET['type']): ?>normal<?php else: ?>active<?php endif; ?>"><a href="main.php?m=member&s=admin_orderadder">收货地址列表</a></li>
                <li class="<?php if ($_GET['type'] == 'add'): ?>active<?php else: ?>normal<?php endif; ?>"><a href="main.php?m=member&s=admin_orderadder&type=add">新增收货地址</a></li>
                <?php if ($_GET['type'] == 'edit'): ?>
                <li class="active"><a href="main.php?m=member&s=admin_orderadder&type=edit">编辑收货地址</a></li>
                <?php endif; ?>
            </ul>
        </div>
        <?php if ($_GET['type'] == 'add' || $_GET['type'] == 'edit'): ?>
        <div class="form-style">
            <form id="form" name="form" action="" method="post">
            <input type="hidden" value="<?php echo $this->_tpl_vars['de']['id']; ?>
" name="edid">
            <input type="hidden" value="<?php if ($this->_tpl_vars['de']['id']): ?>edit<?php else: ?>add<?php endif; ?>" name="submit">
           <input type="hidden" name="ty" value="<?php if ($_GET['url']): ?>pro<?php endif; ?>" />
            <dl>
                <dt><em>*</em>收货人：</dt>
                <dd><input maxlength="30" name="name" value="<?php echo $this->_tpl_vars['de']['name']; ?>
" class="text w150"> <div id="form-error" class="form-error"></div></dd>
            </dl>
            
            <dl>
                <dt><em>*</em>所在区域：</dt>
                <dd>
                <input type="hidden" name="t" id="t" value="<?php echo $this->_tpl_vars['de']['area']; ?>
" />
                <input type="hidden" name="province" id="id_1" value="<?php echo $this->_tpl_vars['de']['provinceid']; ?>
" />
                <input type="hidden" name="city" id="id_2" value="<?php echo $this->_tpl_vars['de']['cityid']; ?>
" />
                <input type="hidden" name="area" id="id_3" value="<?php echo $this->_tpl_vars['de']['areaid']; ?>
" />
                <?php if ($_GET['act'] == 'return'): ?><input type="hidden" name="ty" value="pro" /><?php endif; ?>
               
               
                <?php if ($this->_tpl_vars['de']['area']): ?><div id="d_1"><?php echo $this->_tpl_vars['de']['area']; ?>
&nbsp;&nbsp;<a href="javascript:sd();">编辑</a></div><?php endif; ?>
                
                <div id="d_2" <?php if ($this->_tpl_vars['de']['area']): ?>class="hidden"<?php endif; ?>>
                    <select id="select_1" name="select_1" onChange="district(this);">
                    <option value="">--请选择--</option>
                    <?php echo $this->_tpl_vars['prov']; ?>

                    </select>
                    <select id="select_2" name="select_2" onChange="district(this);" class="hidden"></select>
                	<select id="select_3" name="select_3" onChange="district(this);" class="hidden"></select>
                	<div id="form-error" class="form-error"></div>
                </div>
                </dd>
            </dl>
            <dl>
                <dt><em>*</em>街道地址：</dt>
                <dd>
                	<input type="text" value="<?php echo $this->_tpl_vars['de']['address']; ?>
" name="address" id="address" class="w300 text"><div id="form-error" class="form-error"></div>
                    <p class="hint">不必重复填写所在地区</p>
               	</dd>
            </dl>
            <dl>
                <dt>邮政编码：</dt>
                <dd><input type="text" name="zip"  id="zip" maxlength="6" class="w80 text" value="<?php echo $this->_tpl_vars['de']['zip']; ?>
" ><div id="form-error" class="form-error"></div></dd>
            </dl>
            <dl>
                <dt>电话号码：</dt>
                <dd><input type="text" name="tel" id="tel" class="w150 text" value="<?php echo $this->_tpl_vars['de']['tel']; ?>
"><div id="form-error" class="form-error"></div></dd>
            </dl>
            <dl>
                <dt><em>*</em>手机号码：</dt>
                <dd><input type="text" name="mobile" id="mobile" maxlength="18" class="w150 text" value="<?php echo $this->_tpl_vars['de']['mobile']; ?>
"><div id="form-error" class="form-error"></div></dd>
            </dl>
            <dl>
                <dt>默认地址：</dt>
                <dd><input type="checkbox" <?php if ($this->_tpl_vars['de']['default'] == 2): ?>checked="checked"<?php endif; ?> name="default" value="1" /></dd>
            </dl>
            <dl class="foot">
                <dt>&nbsp;</dt>
                <dd><input type="submit" value="提交" class="submit"></dd>
            </dl>
            </form>
        </div>  
        <?php else: ?>
        <table class="table-list-style">
            <thead>
            <tr>
                <th width="10"></th>
                <th class="tl" width="100">收货人</th>
                <th class="tl">所在区域</th>
                <th class="tl" width="100">邮编</th>
                <th class="tl" width="100">电话/手机</th>
                <th width="90">操作</th>
            </tr>
            </thead>
            <tbody>
            <?php $_from = $this->_tpl_vars['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['num'] => $this->_tpl_vars['list']):
?>
            <tr>
            	<td></td>
                <td class="tl"><?php echo $this->_tpl_vars['list']['name']; ?>
</td>
                <td class="tl"><?php echo $this->_tpl_vars['list']['area']; ?>
<?php echo $this->_tpl_vars['list']['address']; ?>
</td>
                <td class="tl"><?php echo $this->_tpl_vars['list']['zip']; ?>
</td>
                <td class="tl"><?php echo $this->_tpl_vars['list']['tel']; ?>
<br />
                <?php echo $this->_tpl_vars['list']['mobile']; ?>
</td>
                <td><a href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/main.php?m=member&s=admin_orderadder&id=<?php echo $this->_tpl_vars['list']['id']; ?>
&type=edit" >修改</a> <a href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/main.php?m=member&s=admin_orderadder&edid=<?php echo $this->_tpl_vars['list']['id']; ?>
">删除</a></td>
            </tr>
            <?php endforeach; else: ?>
            <tr>
            	<td colspan="20" class="norecord">
                	<i></i><span>暂无符合条件的数据记录</span>	
                </td>
            </tr>
            <?php endif; unset($_from); ?>
            </tbody>
        </table>
        <?php endif; ?>
     </div>   
</div>