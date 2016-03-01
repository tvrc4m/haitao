<?php /* Smarty version 2.6.20, created on 2016-03-01 11:00:37
         compiled from sub_domain_city.htm */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "header.htm", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<style>
.city dt,.city dt a { font-size:24px; font-weight:bold; padding:10px 0;}
.city dd b{ font-size:20px; font-weight:normal; margin-right: 5px;}
</style>
<div class="w city">
	<?php if ($this->_tpl_vars['config']['baseurl']): ?>
		<div style=" font-size:14px; font-weight:bold; text-align:left; padding:10px;border: 1px solid #A9BAD3;">
		<?php echo $this->_tpl_vars['lang']['selectcity']; ?>

		</div>
		
        <div style="border: 1px solid #A9BAD3; margin-top:5px;padding:10px;">
			<span style="width:200px;text-align:left; display:block; height:30px;">
			   <a href="http://www.<?php echo $this->_tpl_vars['config']['baseurl']; ?>
"><strong><?php echo $this->_tpl_vars['lang']['backto']; ?>
</strong></a>
			</span>
            <dl>
			<?php $_from = $this->_tpl_vars['prov']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['list']):
?>
				<dt>
				<?php if ($this->_tpl_vars['list']['domain']): ?><a href="http://<?php echo $this->_tpl_vars['list']['domain']; ?>
.<?php echo $this->_tpl_vars['config']['baseurl']; ?>
"><?php echo $this->_tpl_vars['list']['con']; ?>
</a><?php else: ?><?php echo $this->_tpl_vars['list']['con']; ?>
<?php endif; ?>
                </dt>
				
                <?php $_from = $this->_tpl_vars['list']['city']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['slist']):
?>
                <dd>  
                    <?php if ($this->_tpl_vars['slist']['domain']): ?><a href="http://<?php echo $this->_tpl_vars['slist']['domain']; ?>
.<?php echo $this->_tpl_vars['config']['baseurl']; ?>
"><b><?php echo $this->_tpl_vars['slist']['con2']; ?>
</b></a><?php else: ?><b><?php echo $this->_tpl_vars['slist']['con2']; ?>
</b><?php endif; ?>
                    
                    <?php $_from = $this->_tpl_vars['slist']['area']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['clist']):
?>
                    <span><?php if ($this->_tpl_vars['clist']['domain']): ?><a href="http://<?php echo $this->_tpl_vars['clist']['domain']; ?>
.<?php echo $this->_tpl_vars['config']['baseurl']; ?>
"><?php echo $this->_tpl_vars['clist']['con3']; ?>
</a><?php else: ?><?php echo $this->_tpl_vars['clist']['con3']; ?>
<?php endif; ?></span>
                    <?php endforeach; endif; unset($_from); ?>
                </dd>
                <?php endforeach; endif; unset($_from); ?>
                
			<?php endforeach; endif; unset($_from); ?>
            </dl>
		<div class="clear"></div>
		</div>
        
	<?php else: ?>
		系统基本路径没有设置，二级域名分站不可用。
	<?php endif; ?>
</div>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "footer.htm", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>