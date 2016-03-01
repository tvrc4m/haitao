<?php /* Smarty version 2.6.20, created on 2016-03-01 09:40:24
         compiled from home_config.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'in_array', 'home_config.htm', 47, false),array('modifier', 'count', 'home_config.htm', 71, false),)), $this); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>首页内容配置</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="admin.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="../script/jquery-1.4.4.min.js"></script>
</head>
<body>
	<div class="container">
        <div class="flow">
            <div class="itemtitle">
                <h3>首页内容配置</h3>
                <ul>
                    <li <?php if ($_GET['operation'] == ''): ?>class="current"<?php endif; ?> ><a href="home_config.php"><span>首页产品</span></a></li>
                    
                    <li <?php if ($_GET['operation'] == 'cat'): ?>class="current"<?php endif; ?> ><a href="home_config.php?operation=cat"><span>首页分类</span></a></li>
                  
                </ul>
            </div>
        </div>
        <div class="h35"></div>  
        <?php if ($_GET['operation'] == 'cat'): ?>
        <form name="form" id="form" method="post">
        <table class="table home tl">
        <tbody>
            <tr class="header partition">
                <th width="20"></th>
                <th width="60">显示顺序</th>
                <th class="al" width="200">分类名称</th>
                <th width="120">显示名称</th>
                <th width="120">颜色</th>
                <th width="120">标签</th>
                <th>子菜单</th>
			</tr>
            <?php $_from = $this->_tpl_vars['de']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['name'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['name']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['list']):
        $this->_foreach['name']['iteration']++;
?>
        	<?php $this->assign('catid', $this->_tpl_vars['list']['catid']); ?>
            <tr>
            	<td><input id="catid" <?php if ($this->_tpl_vars['index_catid'][$this->_tpl_vars['catid']]['catid']): ?>checked="checked"<?php endif; ?> type="checkbox" name="index_catid[<?php echo $this->_tpl_vars['list']['catid']; ?>
]" value="<?php echo $this->_tpl_vars['list']['catid']; ?>
" /></td>
            	<td><input type="text" name="displayorder[<?php echo $this->_tpl_vars['list']['catid']; ?>
]" class="w50" value="<?php if ($this->_tpl_vars['index_catid'][$this->_tpl_vars['catid']]['displayorder']): ?><?php echo $this->_tpl_vars['index_catid'][$this->_tpl_vars['catid']]['displayorder']; ?>
<?php else: ?>255<?php endif; ?>" /></td>
                <td><?php echo $this->_foreach['name']['iteration']; ?>
F&nbsp;&nbsp;&nbsp;<?php echo $this->_tpl_vars['list']['cat']; ?>
</td>
            	<td><input type="text" name="name[<?php echo $this->_tpl_vars['list']['catid']; ?>
]" placeholder="<?php echo $this->_tpl_vars['list']['cat']; ?>
" value="<?php echo $this->_tpl_vars['index_catid'][$this->_tpl_vars['catid']]['name']; ?>
" /></td>
            	<td><input type="text" name="color[<?php echo $this->_tpl_vars['list']['catid']; ?>
]" placeholder="#0000000" value="<?php echo $this->_tpl_vars['index_catid'][$this->_tpl_vars['catid']]['color']; ?>
" /></td>
            	<td><input type="text" name="temp[<?php echo $this->_tpl_vars['list']['catid']; ?>
]" value="<?php echo $this->_tpl_vars['index_catid'][$this->_tpl_vars['catid']]['temp']; ?>
" /></td>
                <td>
            	<?php $_from = $this->_tpl_vars['list']['con']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['slist']):
?>
                <label><input <?php if (@ ((is_array($_tmp=$this->_tpl_vars['slist']['catid'])) ? $this->_run_mod_handler('in_array', true, $_tmp, $this->_tpl_vars['index_catid'][$this->_tpl_vars['catid']]['tab']) : in_array($_tmp, $this->_tpl_vars['index_catid'][$this->_tpl_vars['catid']]['tab']))): ?>checked="checked"<?php endif; ?> type="checkbox" name="tab[<?php echo $this->_tpl_vars['list']['catid']; ?>
][]" value="<?php echo $this->_tpl_vars['slist']['catid']; ?>
" /><?php echo $this->_tpl_vars['slist']['cat']; ?>
</label>
                <?php endforeach; endif; unset($_from); ?>
                </td>
            </tr>
            <?php endforeach; endif; unset($_from); ?>
        </tbody>
        <tfoot>
        <tr>
            <td></td>
            <td colspan="2">
                <input type="hidden" name="act" value="save" />
                <input type="submit" value="提交" />
            </td>
        </tr>
        </tfoot>
        </table>
        </form>    
        <?php else: ?>
        <form name="form" id="form" method="post">
        <table class="table2" width="100%">
            <tr>
                <td class="td">疯狂抢购</td>
            </tr>
            <tr>
                <td <?php if (count($this->_tpl_vars['reg_config']['newpro_list']) > 7): ?>class="small"<?php endif; ?>>
                <?php $_from = $this->_tpl_vars['reg_config']['newpro_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['list']):
?>
                <li class="plist">
                    <div class="p-img"><img src="<?php echo $this->_tpl_vars['list']['pic']; ?>
_<?php if (count($this->_tpl_vars['reg_config']['newpro_list']) > 7): ?>60X60<?php else: ?>120X120<?php endif; ?>.jpg"></div>
                    <div class="p-name"><?php echo $this->_tpl_vars['list']['pname']; ?>
</div>
                    <div class="p-price"><strong><?php echo $this->_tpl_vars['config']['money']; ?>
<?php echo $this->_tpl_vars['list']['price']; ?>
</strong></div>
                    <div class="handle"><a href="?key=newpro&id=<?php echo $this->_tpl_vars['list']['id']; ?>
">删除</a></div>
                </li>
                <?php endforeach; endif; unset($_from); ?>
                <li class="plist add_pro<?php if (! count($this->_tpl_vars['reg_config']['newpro_list'])): ?> no<?php endif; ?> " key="newpro"><a href="#"></a></li>
                </td>
            </tr>
            <tr>
                <td class="td">热卖产品</td>
            </tr>
            <tr>
                <td <?php if (count($this->_tpl_vars['reg_config']['hotpro_list']) > 7): ?>class="small"<?php endif; ?>>
                <?php $_from = $this->_tpl_vars['reg_config']['hotpro_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['list']):
?>
                <li class="plist<?php if (count($this->_tpl_vars['reg_config']['hotpro_list']) > 7): ?> small<?php endif; ?>">
                    <div class="p-img"><img src="<?php echo $this->_tpl_vars['list']['pic']; ?>
_<?php if (count($this->_tpl_vars['reg_config']['hotpro_list']) > 7): ?>60X60<?php else: ?>120X120<?php endif; ?>.jpg"></div>
                    <div class="p-name"><?php echo $this->_tpl_vars['list']['pname']; ?>
</div>
                    <div class="p-price"><strong><?php echo $this->_tpl_vars['config']['money']; ?>
<?php echo $this->_tpl_vars['list']['price']; ?>
</strong></div>
                    <div class="handle"><a href="?key=hotpro&id=<?php echo $this->_tpl_vars['list']['id']; ?>
">删除</a></div>
                </li>
                <?php endforeach; endif; unset($_from); ?>
                <li class="plist add_pro<?php if (! count($this->_tpl_vars['reg_config']['hotpro_list'])): ?> no<?php endif; ?> " key="hotpro"><a href="#"></a></li>
				</td>
            </tr>
          
        </table>
        </form>
        <?php endif; ?>
    </div>
<script>
$(".home").find("input[id='catid']").each(function(i){
	var obj=$(this).parent().parent();										   
	if($(this).attr('checked')==true)
	{
		obj.find('input').attr('disabled','');
	}
	else
	{
		obj.find('input').attr('disabled','disabled');
	}
	$(this).attr('disabled','');
})
$("#catid").live('click',function(){
	var obj=$(this).parent().parent();	
	if($(this).attr('checked')==true)
	{
		obj.find('input').attr('disabled','');
	}
	else
	{
		obj.find('input').attr('disabled','disabled');
	}
	$(this).attr('disabled','');
});
$(".add_pro").live('click',function(){
	var key = $(this).attr('key');
	window.parent.iframe_form("list", "选择产品", '<?php echo $this->_tpl_vars['config']['weburl']; ?>
/admin/module.php?m=product&s=product_list.php&key='+key,790,600);
	return false;
});
$('.plist').hover(function(){					 
	$(this).addClass("hover");
},function(){
	$(this).removeClass("hover");	
});
</script>    
</body>
</html>