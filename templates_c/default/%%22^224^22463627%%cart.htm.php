<?php /* Smarty version 2.6.20, created on 2016-03-01 11:00:16
         compiled from cart.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'count', 'cart.htm', 30, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "../../../templates/default/site_nav.htm", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<link type="text/css" rel="stylesheet" href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/module/product/templates/cart.css">
<div class="header">
	<div class="w fn-clear">
        <div class="logo">
            <a title="<?php echo $this->_tpl_vars['config']['company']; ?>
" href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
">
                <img src="<?php if ($this->_tpl_vars['config']['logo']): ?><?php echo $this->_tpl_vars['config']['logo']; ?>
<?php else: ?><?php echo $this->_tpl_vars['config']['weburl']; ?>
/image/logo.gif<?php endif; ?>" />
                <span></span>
            </a>
        </div>
		<div class="search">
            <form action="" class="form" method="get">
            <div class="i-search">
                <input type="hidden" value="product" name="m" id="m">
                <input type="hidden" value="list" name="s" id="s">
                <input type="text" class="text" name="key" id="key" value="<?php echo $_GET['key']; ?>
" autocomplete="off">
			</div>
            <input type="submit" value="搜&nbsp;索" class="button">
            </form>
        </div>
    </div>  
</div>
<div class="cart w">
    <div class="cart-hd">
        <h2>我的购物车</h2><?php echo $_GET['dist_user_id']; ?>

        <?php if ($this->_tpl_vars['cart']['cart']): ?>
        <span>已选商品(不含运费)：<strong class="Price"><?php echo $this->_tpl_vars['config']['money']; ?>
<em class="subtotal">0.00</em></strong><a class="submit-btn submit-btn-disabled" href="javascript:void(0);">结算</a></span>
        <?php endif; ?>
    </div>
    <?php if ($_GET['type'] == 'clear' || count($this->_tpl_vars['cart']['cart']) < 1): ?>
        <div class="cart-empty w">
            <div class="message">
            购物车内暂时没有产品，您可以<a href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
">去首页</a>挑选喜欢的
            </div>
        </div>
    <?php else: ?>  
    <?php if ($_GET['type'] == 'numf'): ?>
        <div align="center"><font color="#FF0000">库存数量不够(已经为定订购产品的最大值)</font></div>
    <?php elseif ($_GET['type'] == 'pronull'): ?>
        <div align="center"> <font color="#FF0000">产品不存在或订购销完或已经删除</font></div>
    <?php elseif ($_GET['type'] == 'del'): ?>
        <div align="center"><font color="#FF0000">购物车不存在该产品已经删除</font></div>
    <?php endif; ?>
    <form id="form" method="post" action="">
    <input type="hidden" id="act" name="act" />
    <table width="100%" cellpadding="0" cellspacing="0" class="cart-con">
    	<thead>
            <tr>
                <th width="45">
                <label class="cart-checkbox"><input data-type="all" type="checkbox"><em>全选</em></label>
                </th>
                <th>商品信息</th>
                <th width="128">单价（元）</th>
                <th width="115">数量</th>
                <th width="115">金额（元）</th>
                <th width="80">操作</th>
            </tr>
        </thead>
        <tbody>
        <?php $_from = $this->_tpl_vars['cart']['cart']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['list']):
?>

        <?php if ($this->_tpl_vars['list']['dist_user_id']): ?>
        <tr>
            <th colspan="6">
                <label class="cart-checkbox"><input type="checkbox" data-type="shop" data-value="<?php echo $this->_tpl_vars['list']['dist_user_id']; ?>
" name="checkbox" value="<?php echo $this->_tpl_vars['pro']['id']; ?>
"><em></em></label>
                店铺:
                <a target="_blank" href="shop.php?uid=<?php echo $this->_tpl_vars['list']['dist_user_id']; ?>
"><?php echo $this->_tpl_vars['list']['company']; ?>
</a>
                <!--<a href="http://wpa.qq.com/msgrd?v=3&amp;uin=&amp;site=qq&amp;menu=yes" target="_blank"><img align="absmiddle" src="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/image/default/cart/qq.gif"></a>-->
            </th>
        </tr>
        <?php $_from = $this->_tpl_vars['list']['prolist']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['n'] => $this->_tpl_vars['pro']):
?>
        <tr>
            <td class="first">
                <label class="cart-checkbox"><input type="checkbox" data-value="<?php echo $this->_tpl_vars['list']['dist_user_id']; ?>
" name="product_id[]" value="<?php echo $this->_tpl_vars['pro']['id']; ?>
"><em></em></label>
            </td>
            <td>
                <div class="pro-img">
                    <a target="_blank" href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/?m=product&s=detail&id=<?php echo $this->_tpl_vars['pro']['product_id']; ?>
&shop_id=<?php echo $this->_tpl_vars['list']['dist_user_id']; ?>
">
                        <img height="80" alt="<?php echo $this->_tpl_vars['pro']['name']; ?>
" src="<?php echo $this->_tpl_vars['pro']['pic']; ?>
_220X220.jpg">
                    </a>
                </div>
                <div class="pro-name">
                    <a target="_blank" href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/?m=product&s=detail&id=<?php echo $this->_tpl_vars['pro']['product_id']; ?>
&shop_id=<?php echo $this->_tpl_vars['list']['dist_user_id']; ?>
">
                        <?php if ($this->_tpl_vars['pro']['is_tg'] == 'true'): ?><span>团购</span><?php endif; ?>
                        <?php echo $this->_tpl_vars['pro']['pname']; ?>

                    </a>
                    <?php $_from = $this->_tpl_vars['pro']['spec']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['lists']):
?>
                    <p><?php echo $this->_tpl_vars['lists']; ?>
</p>
                    <?php endforeach; endif; unset($_from); ?>
                </div>
            </td>
            <td>
                <?php if ($this->_tpl_vars['pro']['market_price'] > 0): ?>
                <p><s><?php echo $this->_tpl_vars['pro']['market_price']; ?>
</s></p>
                <?php endif; ?>
                <p class="price"><?php echo $this->_tpl_vars['pro']['price']; ?>
</p>
                <?php if ($this->_tpl_vars['pro']['market_price'] > 0): ?>
                <div class="promo-content">卖家促销</div>
                <?php endif; ?>
            </td>
            <td>
                <div class="computing fn-clear">
                    <div class="computing_item">
                        <div class="computing_num">
                            <input maxlength="4" data-id='<?php echo $this->_tpl_vars['pro']['id']; ?>
' data-max="<?php echo $this->_tpl_vars['pro']['stock']; ?>
" name="nums" id="nums" type="text" value="<?php echo $this->_tpl_vars['pro']['num']; ?>
" />
                        </div>
                        <div class="computing_act">
                            <input type="button" class="<?php if ($this->_tpl_vars['pro']['stock'] <= 1): ?>no_<?php endif; ?>add">
                            <input type="button" class="<?php if ($this->_tpl_vars['pro']['num'] == 1): ?>no_<?php endif; ?>reduce">
                        </div>
                    </div>
                </div>
            </td>
            <td id="cell<?php echo $this->_tpl_vars['pro']['id']; ?>
">
                <span id="price" class="price org"><?php echo $this->_tpl_vars['pro']['sumprice']; ?>
</span>
            </td>
            <td class="last">
                <a href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/?m=product&s=cart&deid=<?php echo $this->_tpl_vars['pro']['id']; ?>
">删除</a>
            </td>
        </tr>
        <?php endforeach; endif; unset($_from); ?>
        <?php else: ?>
        <tr>
            <th colspan="6">
                <label class="cart-checkbox"><input type="checkbox" data-type="shop" data-value="<?php echo $this->_tpl_vars['list']['seller_id']; ?>
" name="checkbox" value="<?php echo $this->_tpl_vars['pro']['id']; ?>
"><em></em></label>
                店铺:
                <a target="_blank" href="shop.php?uid=<?php echo $this->_tpl_vars['list']['seller_id']; ?>
"><?php echo $this->_tpl_vars['list']['company']; ?>
</a>
                <!--<a href="http://wpa.qq.com/msgrd?v=3&amp;uin=&amp;site=qq&amp;menu=yes" target="_blank"><img align="absmiddle" src="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/image/default/cart/qq.gif"></a>-->
            </th>
        </tr>
        <?php $_from = $this->_tpl_vars['list']['prolist']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['n'] => $this->_tpl_vars['pro']):
?>
        <tr>
            <td class="first">
                <label class="cart-checkbox"><input type="checkbox" data-value="<?php echo $this->_tpl_vars['list']['seller_id']; ?>
" name="product_id[]" value="<?php echo $this->_tpl_vars['pro']['id']; ?>
"><em></em></label>
            </td>
            <td>
                <div class="pro-img">
                    <a target="_blank" href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/?m=product&s=detail&id=<?php echo $this->_tpl_vars['pro']['product_id']; ?>
">
                        <img height="80" alt="<?php echo $this->_tpl_vars['pro']['name']; ?>
" src="<?php echo $this->_tpl_vars['pro']['pic']; ?>
_220X220.jpg">
                    </a>
                </div>
                <div class="pro-name">
                    <a target="_blank" href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/?m=product&s=detail&id=<?php echo $this->_tpl_vars['pro']['product_id']; ?>
">
                        <?php if ($this->_tpl_vars['pro']['is_tg'] == 'true'): ?><span>团购</span><?php endif; ?>
                        <?php echo $this->_tpl_vars['pro']['pname']; ?>

                    </a>
                    <?php $_from = $this->_tpl_vars['pro']['spec']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['lists']):
?>
                    <p><?php echo $this->_tpl_vars['lists']; ?>
</p>
                    <?php endforeach; endif; unset($_from); ?>
                </div>
            </td>
            <td>
                <?php if ($this->_tpl_vars['pro']['market_price'] > 0): ?>
                <p><s><?php echo $this->_tpl_vars['pro']['market_price']; ?>
</s></p>
                <?php endif; ?>
                <p class="price"><?php echo $this->_tpl_vars['pro']['price']; ?>
</p>
                <?php if ($this->_tpl_vars['pro']['market_price'] > 0): ?>
                <div class="promo-content">卖家促销</div>
                <?php endif; ?>
            </td>
            <td>
                <div class="computing fn-clear">
                    <div class="computing_item">
                        <div class="computing_num">
                            <input maxlength="4" data-id='<?php echo $this->_tpl_vars['pro']['id']; ?>
' data-max="<?php echo $this->_tpl_vars['pro']['stock']; ?>
" name="nums" id="nums" type="text" value="<?php echo $this->_tpl_vars['pro']['num']; ?>
" />
                        </div>
                        <div class="computing_act">
                            <input type="button" class="<?php if ($this->_tpl_vars['pro']['stock'] <= 1): ?>no_<?php endif; ?>add">
                            <input type="button" class="<?php if ($this->_tpl_vars['pro']['num'] == 1): ?>no_<?php endif; ?>reduce">
                        </div>
                    </div>
                </div>
            </td>
            <td id="cell<?php echo $this->_tpl_vars['pro']['id']; ?>
">
                <span id="price" class="price org"><?php echo $this->_tpl_vars['pro']['sumprice']; ?>
</span>
            </td>
            <td class="last">
                <a href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/?m=product&s=cart&deid=<?php echo $this->_tpl_vars['pro']['id']; ?>
">删除</a>
            </td>
        </tr>
        <?php endforeach; endif; unset($_from); ?>
        <?php endif; ?>
        <?php endforeach; endif; unset($_from); ?>
        </tbody>
    </table>
    
	<div class="toolbar fn-clear">
    	<div class="select-all">
            <label class="cart-checkbox"><input type="checkbox" data-type="all"><em>全选</em></label>
        </div>
        <div class="operations">
            <a class="delete" href="javascript:void(0);">删除</a>
        </div>
        <a class="submit-btn submit-btn-disabled" href="javascript:void(0);">结算</a>
        <div class="cart-sum">
            <span>合计(不含运费)：</span>
            <strong class="Price"><?php echo $this->_tpl_vars['config']['money']; ?>
<em class="subtotal">0.00</em></strong>
        </div>
        <div class="cart-count">
            <span>已选商品</span>
            <em>0</em>
            <span>件</span>
        </div>
    </div>
    </form>
    <?php endif; ?>
</div>
<script type="text/javascript">
$(".operations a").bind("click",function(){
	$("#act").val($(this).attr("class"));
	$("#form").submit();
});
$(".submit-btn").bind("click",function(){
	if(!$(this).hasClass("submit-btn-disabled"))
	{
		$("#form").attr("action","<?php echo $this->_tpl_vars['config']['weburl']; ?>
/?m=product&s=confirm_order");
		$("#form").submit();
	}
});
$(".cart-checkbox input[type='checkbox']").click(function(){
	var flag = $(this).attr("checked");
	var data_type = $(this).attr("data-type");
	if(flag == true)
	{
		if(data_type == 'all')
		{
			ckeckbox("input[type='checkbox']",true);
		}
		else if(data_type == 'shop')
		{
			var data_value = $(this).attr("data-value");
			ckeckbox("input[data-value='"+data_value+"']",true);
		}	
		$(this).parent().addClass("cart-checkbox-checked");
	}
	else
	{
		if(data_type == 'all')
		{
			ckeckbox("input[type='checkbox']",false);
		}
		else if(data_type == 'shop')
		{
			var data_value = $(this).attr("data-value");
			ckeckbox("input[data-value='"+data_value+"']",false);
		}
		$(this).parent().removeClass("cart-checkbox-checked");
		$(this).parent().parent().parent().removeClass("checked");
	}
	count();
});
function ckeckbox(obj,flag)
{
	$(".cart-checkbox").find(obj).each(function(){
		if(flag == true)
		{
			$(this).parent().addClass("cart-checkbox-checked");
			$(this).attr("checked","checked");
		}
		else
		{
			$(this).parent().parent().parent().removeClass("checked");
			$(this).parent().removeClass("cart-checkbox-checked");
			$(this).attr("checked","");	
		}
	});
}
function count()
{
	var count = 0;
	var num = 0;
	$(".cart-checkbox").find("input[name='product_id[]']:checked").each(function(){
		var value = $(this).val();
		var price = $(this).parent().parent().parent().find("#cell"+value+" span").html();
		price = price.replace(/,/g, "")
		price = Number(price);
		count = count + price;
		num ++;
		$(this).parent().parent().parent().addClass("checked");
	});
	$(".subtotal").html(count.toFixed(2));
	$(".cart-count em").html(num);
	if(num>0) 
		$(".submit-btn").removeClass("submit-btn-disabled");
	else
		$(".submit-btn").addClass("submit-btn-disabled");	
}
var c=$(".computing_item");
var e=null;
c.each(function(){
	var g=$(this).find(".computing_act input");		
	var h=$(this).find("input#nums");
	var o=this;
	var f=h.attr("data-max");
	var i=1;
	var id=h.attr("data-id");
	h.bind("input propertychange",function(){
		var j=this;
		var k=$(j).val();
		e&&clearTimeout(e);
		e=setTimeout(function(){
			var l=Math.max(Math.min(f,k.replace(/\D/gi,"").replace(/(^0*)/,"")||1),i);
			$(j).val(l);
			edit_num(id,l,o);
			if(l==f){
				g.eq(0).attr("class","no_add");
				if(l==i)
					g.eq(1).attr("class","no_reduce")
				else
					g.eq(1).attr("class","reduce")
			}else{
				if(l<=i){
					g.eq(1).attr("class","no_reduce");
					g.eq(0).attr("class","add")
				}else{
					g.eq(1).attr("class","reduce");
					g.eq(0).attr("class","add")
				}
			}
		},50)
	}).trigger("input propertychange").blur(function(){$(this).trigger("input propertychange")}).keydown(function(l){
		if(l.keyCode==38||l.keyCode==40)
		{
			var j=0;
			l.keyCode==40&&(j=1);g.eq(j).trigger("click")
		}
	});
	g.bind("click",function(l){
		if(!$(this).hasClass("no_reduce")){
			var j=parseInt(h.val(),10)||1;
			if($(this).hasClass("add")&&!$(this).hasClass("no_add")){
				$(this).next().attr("class","reduce");
				if(f>i&&j>=f){
					$(this).attr("class","no_add")
				}
				else
				{
					j++;
					edit_num(id,j,o);
				}
			}else{
				if($(this).hasClass("reduce")&&!$(this).hasClass("no_reduce")){
					j--;
					edit_num(id,j,o);
					$(this).prev().attr("class","add");
					j<=i&&$(this).attr("class","no_reduce")
				}
			}
			h.val(j)
		}
	})
})
function edit_num(id,num,obj){
	var url = "?m=product&s=cart";
	var pars = 'id='+id+'&num='+num;
	$.post(url, pars,showResponse);
	function showResponse(originalRequest)
	{
		$('#cell'+id+' span').html((Number(originalRequest).toFixed(2)));	
		count()
	}
}
</script>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "../../../templates/default/footer.htm", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>