<?php /* Smarty version 2.6.20, created on 2016-03-19 16:12:01
         compiled from product_list.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'getName', 'product_list.htm', 12, false),array('modifier', 'replace', 'product_list.htm', 59, false),array('modifier', 'getdistrictname', 'product_list.htm', 105, false),array('modifier', 'urlencode', 'product_list.htm', 130, false),array('insert', 'label', 'product_list.htm', 158, false),)), $this); ?>
<link href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/module/product/templates/pro.css" rel="stylesheet" type="text/css" />
<div class="w">
    <div class="detailnav">
    
    	<?php if ($_GET['key']): ?>
        <strong><a href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
?m=product&s=list">全部结果</a></strong><span>
        <?php endif; ?>
        
        <?php $_from = $this->_tpl_vars['catname']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['list']):
?>
        
        <?php if ($this->_tpl_vars['key'] == 0 && ! $_GET['key']): ?>
        <strong><a href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
?m=product&s=list&id=<?php echo $this->_tpl_vars['list']; ?>
"><?php echo ((is_array($_tmp=$this->_tpl_vars['list'])) ? $this->_run_mod_handler('getName', true, $_tmp) : getName($_tmp)); ?>
</a></strong><span>
        <?php else: ?>
         > <a href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
?m=product&s=list&id=<?php echo $this->_tpl_vars['list']; ?>
"><?php echo ((is_array($_tmp=$this->_tpl_vars['list'])) ? $this->_run_mod_handler('getName', true, $_tmp) : getName($_tmp)); ?>
</a>
        <?php endif; ?>
        
        <?php endforeach; else: ?>
        
        <?php if (! $_GET['key']): ?>
        <strong><a href="index.php">首页</a></strong><span>
         > <a href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
?m=product&s=list">全部商品</a>
        <?php endif; ?>
        
        <?php endif; unset($_from); ?>
        
        <?php if ($_GET['key']): ?>
         > "<?php echo $_GET['key']; ?>
"
        <?php endif; ?>
        
        <?php if ($_GET['brand']): ?>
         > <a href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
?m=product&s=list&<?php echo $this->_tpl_vars['url']; ?>
"><?php echo $_GET['brand']; ?>
</a>
        <?php endif; ?>
        
        </span>
    </div>
</div>

<div class="w pd20">
    <?php if ($this->_tpl_vars['brand'] || $this->_tpl_vars['catfile'] || $this->_tpl_vars['cat']): ?>
    <div id="select">
    	<?php if ($this->_tpl_vars['cat']): ?>
        <dl class="first">
            <dt>分类：</dt>
            <dd>
                <?php $this->assign('id', $_GET['id']); ?>
                <?php $_from = $this->_tpl_vars['cat']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['list']):
?>
                <div>
                <a <?php if ($this->_tpl_vars['id'] == $this->_tpl_vars['list']['catid']): ?>class="curr"<?php endif; ?> href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/?m=product&s=list&id=<?php echo $this->_tpl_vars['list']['catid']; ?>
"><?php echo $this->_tpl_vars['list']['cat']; ?>
</a>
                </div>
                <?php endforeach; endif; unset($_from); ?>
            </dd>
        </dl>
        <?php endif; ?> 
        <?php if ($this->_tpl_vars['brand']): ?>
        <dl <?php if (! $this->_tpl_vars['cat']): ?>class="first"<?php endif; ?> >
            <dt>品牌：</dt>
            <dd>
                <?php $this->assign('b', $_GET['brand']); ?>
                <div><a <?php if ($this->_tpl_vars['b'] == ""): ?>class="curr"<?php endif; ?> href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/?<?php echo ((is_array($_tmp=$this->_tpl_vars['url'])) ? $this->_run_mod_handler('replace', true, $_tmp, "&brand=".($this->_tpl_vars['b']), "") : smarty_modifier_replace($_tmp, "&brand=".($this->_tpl_vars['b']), "")); ?>
">不限</a></div>
                <?php $_from = $this->_tpl_vars['brand']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['list']):
?>
                <div>
                <a <?php if ($this->_tpl_vars['b'] == $this->_tpl_vars['list']['name']): ?>class="curr"<?php endif; ?> href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/?<?php echo ((is_array($_tmp=$this->_tpl_vars['url'])) ? $this->_run_mod_handler('replace', true, $_tmp, "&brand=".($this->_tpl_vars['b']), "") : smarty_modifier_replace($_tmp, "&brand=".($this->_tpl_vars['b']), "")); ?>
&brand=<?php echo $this->_tpl_vars['list']['name']; ?>
"><?php echo $this->_tpl_vars['list']['name']; ?>
</a>
                </div>
                <?php endforeach; endif; unset($_from); ?>
            </dd>
        </dl>
        <?php endif; ?>            
        <?php $_from = $this->_tpl_vars['catfile']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['num'] => $this->_tpl_vars['list']):
?>
        <?php $this->assign('fieldName', $this->_tpl_vars['list']['field']); ?>
        <?php $this->assign('s', $_GET[$this->_tpl_vars['fieldName']]); ?>
        <dl <?php if (! $this->_tpl_vars['brand'] && ! $this->_tpl_vars['cat'] && $this->_tpl_vars['num'] == 0): ?>class="first"<?php endif; ?> >
            <dt><?php echo $this->_tpl_vars['list']['name']; ?>
：</dt>
            <dd>
                <div><a <?php if ($_GET[$this->_tpl_vars['fieldName']] == ""): ?>class="curr"<?php endif; ?> href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/?<?php echo ((is_array($_tmp=$this->_tpl_vars['url'])) ? $this->_run_mod_handler('replace', true, $_tmp, "&".($this->_tpl_vars['fieldName'])."=".($this->_tpl_vars['s']), "") : smarty_modifier_replace($_tmp, "&".($this->_tpl_vars['fieldName'])."=".($this->_tpl_vars['s']), "")); ?>
">不限</a></div>
                
                <?php $_from = $this->_tpl_vars['list']['catItem']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['slist']):
?>
                    <div><a <?php if ($_GET[$this->_tpl_vars['fieldName']] == $this->_tpl_vars['slist']['id']): ?>class="curr"<?php endif; ?> href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/?<?php echo ((is_array($_tmp=$this->_tpl_vars['url'])) ? $this->_run_mod_handler('replace', true, $_tmp, "&".($this->_tpl_vars['fieldName'])."=".($this->_tpl_vars['s']), "") : smarty_modifier_replace($_tmp, "&".($this->_tpl_vars['fieldName'])."=".($this->_tpl_vars['s']), "")); ?>
&<?php echo $this->_tpl_vars['list']['field']; ?>
=<?php echo $this->_tpl_vars['slist']['id']; ?>
"><?php echo $this->_tpl_vars['slist']['name']; ?>
</a></div>
                <?php endforeach; endif; unset($_from); ?>
            </dd>
        </dl>
        <?php endforeach; endif; unset($_from); ?>
    </div>
    <?php endif; ?>
    
    <div class="itemSearchList clearfix">
    	<?php if ($this->_tpl_vars['info']['list']): ?>
        <div class="itemSearchResult clearfix">


        <div class="filter clearfix">
            <div class="fore1 clearfix">
                <div class="order">
                    <?php $this->assign('s', $_GET['orderby']); ?>
                    <a <?php if (! $this->_tpl_vars['s']): ?>class="current"<?php endif; ?> href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/?<?php echo ((is_array($_tmp=$this->_tpl_vars['url'])) ? $this->_run_mod_handler('replace', true, $_tmp, "&orderby=".($this->_tpl_vars['s']), "") : smarty_modifier_replace($_tmp, "&orderby=".($this->_tpl_vars['s']), "")); ?>
"><span>综合</span></a>
                    <a <?php if ($this->_tpl_vars['s'] == 1): ?>class="current"<?php endif; ?> href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/?<?php echo ((is_array($_tmp=$this->_tpl_vars['url'])) ? $this->_run_mod_handler('replace', true, $_tmp, "&orderby=".($this->_tpl_vars['s']), "") : smarty_modifier_replace($_tmp, "&orderby=".($this->_tpl_vars['s']), "")); ?>
&orderby=1"><span>销量</span><!-- <b></b> --></a>
                    <a <?php if ($this->_tpl_vars['s'] == 4): ?>class="current"<?php endif; ?> href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/?<?php echo ((is_array($_tmp=$this->_tpl_vars['url'])) ? $this->_run_mod_handler('replace', true, $_tmp, "&orderby=".($this->_tpl_vars['s']), "") : smarty_modifier_replace($_tmp, "&orderby=".($this->_tpl_vars['s']), "")); ?>
&orderby=4"><span>新品</span><!-- <b></b> --></a>
                    <a <?php if ($this->_tpl_vars['s'] == 5 || $this->_tpl_vars['s'] == 6): ?>class="current <?php if ($this->_tpl_vars['s'] == 5): ?>up<?php endif; ?>"<?php endif; ?> href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/?<?php echo ((is_array($_tmp=$this->_tpl_vars['url'])) ? $this->_run_mod_handler('replace', true, $_tmp, "&orderby=".($this->_tpl_vars['s']), "") : smarty_modifier_replace($_tmp, "&orderby=".($this->_tpl_vars['s']), "")); ?>
&orderby=<?php if ($this->_tpl_vars['s'] == 6): ?>5<?php else: ?>6<?php endif; ?>"><span>价格</span><b></b></a>
                    <a <?php if ($this->_tpl_vars['s'] == 2): ?>class="current"<?php endif; ?> href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/?<?php echo ((is_array($_tmp=$this->_tpl_vars['url'])) ? $this->_run_mod_handler('replace', true, $_tmp, "&orderby=".($this->_tpl_vars['s']), "") : smarty_modifier_replace($_tmp, "&orderby=".($this->_tpl_vars['s']), "")); ?>
&orderby=2"><span>人气</span><!-- <b></b> --></a>
                    <!-- <a <?php if ($this->_tpl_vars['s'] == 3): ?>class="current"<?php endif; ?> href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/?<?php echo ((is_array($_tmp=$this->_tpl_vars['url'])) ? $this->_run_mod_handler('replace', true, $_tmp, "&orderby=".($this->_tpl_vars['s']), "") : smarty_modifier_replace($_tmp, "&orderby=".($this->_tpl_vars['s']), "")); ?>
&orderby=3"><span>信用</span><b></b></a> -->
                    
                    
                </div>

                <div class="sendadd">发货地</div>
                <div class="area"><span><?php if (((is_array($_tmp=$_GET['province'])) ? $this->_run_mod_handler('getdistrictname', true, $_tmp) : getdistrictname($_tmp))): ?><?php echo ((is_array($_tmp=$_GET['province'])) ? $this->_run_mod_handler('getdistrictname', true, $_tmp) : getdistrictname($_tmp)); ?>
<?php else: ?><?php endif; ?></span><b></b></div>
                <div style="display:none;" class="i-area">
                    <ul>
                        <?php $_from = $this->_tpl_vars['province']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['list']):
?>
                        <li key="<?php echo $this->_tpl_vars['list']['id']; ?>
"><?php echo $this->_tpl_vars['list']['name']; ?>
</li>
                        <?php endforeach; endif; unset($_from); ?>
                    </ul>
                </div>
                <?php $this->assign('p', $_GET['province']); ?>
                <script>
                    $(function(){
                        $(".area").click(function(){
                            var obj=$(this);
                            $(this).next().slideToggle("fast",function(){
                                if($(obj).next().is(":visible")){
                                    $(document).one('click',function(){
                                        $(".area").next().slideUp("fast");
                                    });
                                }});
                        });
                        $(".i-area li").click(function(){
                            var str=$(this).html();
                            $(this).parent().parent().prev().children("span").html(str);
                            $(this).parent().parent().slideToggle();
                            var id=$(this).attr("key");
                            <?php $this->assign('p', ((is_array($_tmp=$_GET['province'])) ? $this->_run_mod_handler('urlencode', true, $_tmp) : urlencode($_tmp))); ?>
                            window.location='<?php echo $this->_tpl_vars['config']['weburl']; ?>
/?<?php echo ((is_array($_tmp=$this->_tpl_vars['url'])) ? $this->_run_mod_handler('replace', true, $_tmp, "&province=".($this->_tpl_vars['p']), "") : smarty_modifier_replace($_tmp, "&province=".($this->_tpl_vars['p']), "")); ?>
&province='+id;
                        });
                    });
                </script>
               <!--  <div class="total">共<strong><?php echo $this->_tpl_vars['info']['count']; ?>
</strong>个商品</div> -->
            </div>
        </div>
    
            <ul class="clearfix border_left">
                <?php $_from = $this->_tpl_vars['info']['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['num'] => $this->_tpl_vars['list']):
?>
                <li <?php if (( $this->_tpl_vars['num']+1 ) % 4 == 0): ?>class="mr0"<?php endif; ?> >
                    <div class="p-info">
                        <a class="p-img" href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/?m=product&s=detail&id=<?php echo $this->_tpl_vars['list']['id']; ?>
">  <img height="200" width="200" alt="<?php echo $this->_tpl_vars['list']['pname']; ?>
" src="<?php echo $this->_tpl_vars['list']['pic']; ?>
_220X220.jpg"> </a>
                        <p class="p-price"><strong><?php echo $this->_tpl_vars['config']['money']; ?>
<?php echo $this->_tpl_vars['list']['price']; ?>
</strong></p>
                        <a class="p-name" href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/?m=product&s=detail&id=<?php echo $this->_tpl_vars['list']['id']; ?>
"><?php echo $this->_tpl_vars['list']['pname']; ?>
</a>
                        
                      <!-- <div class="p-shop"><a href="shop.php?uid=<?php echo $this->_tpl_vars['list']['userid']; ?>
"><?php echo $this->_tpl_vars['list']['company']; ?>
</a></div> -->
                    </div>
                </li>
                <?php endforeach; endif; unset($_from); ?>
            </ul>
			<div class="page"><?php echo $this->_tpl_vars['info']['page']; ?>
</div>
        </div>
        <div class="hotProduct">
        	<div class="m">
                <div class="mt"><h3>为您推荐</h3></div>
                <div class="mc">
                 <?php require_once(SMARTY_CORE_DIR . 'core.run_insert_handler.php');
echo smarty_core_run_insert_handler(array('args' => array('name' => 'label', 'type' => 'product', 'catid' => $_GET['id'], 'o' => '1', 'temp' => 'product_list_li', 'limit' => 6)), $this); ?>

                </div>
            </div>
        </div>
        <?php else: ?>
        <div class="itemsNull">
            <h3>很抱歉，没有找到符合条件的宝贝</h3>
            <p>
                <em>建议您：</em>
                <span>1、适当减少筛选条件，可以获得更多结果</span>
                <span>2、尝试其他关键字</span>
            </p>
        </div>
        <?php endif; ?>
    </div>
</div>