<?php /* Smarty version 2.6.20, created on 2016-05-12 16:42:52
         compiled from pay.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'number_format', 'pay.htm', 45, false),)), $this); ?>
<script type="text/javascript">
    //调用微信JS api 支付
    function jsApiCall()
    {
        WeixinJSBridge.invoke('getBrandWCPayRequest',{
            'appId':"<?php echo $this->_tpl_vars['jsApiParameters']['appId']; ?>
",
            'timeStamp':"<?php echo $this->_tpl_vars['jsApiParameters']['timeStamp']; ?>
",
            'nonceStr':"<?php echo $this->_tpl_vars['jsApiParameters']['nonceStr']; ?>
",
            'package':"<?php echo $this->_tpl_vars['jsApiParameters']['package']; ?>
",
            'signType':"<?php echo $this->_tpl_vars['jsApiParameters']['signType']; ?>
",
            'paySign':"<?php echo $this->_tpl_vars['jsApiParameters']['paySign']; ?>
"
            },function(res){
               // WeixinJSBridge.log(res.err_msg);
                if(res.err_msg == "get_brand_wcpay_request:ok")// 支付成功
                {
                    alert("付款成功，如果订单状态未改变请3分钟后刷新查看");
                    var order_id="<?php echo $_GET['tradeNo']; ?>
";
                    location.href = "<?php echo $this->_tpl_vars['config']['web_url']; ?>
/main.php?m=product&s=admin_buyorder&cg_u_type=1&zt=3";

                }
            });
    }
    function callpay()
    {
        if (typeof WeixinJSBridge == "undefined"){
            if( document.addEventListener ){
                document.addEventListener('WeixinJSBridgeReady', jsApiCall, false);
            }else if (document.attachEvent){
                document.attachEvent('WeixinJSBridgeReady', jsApiCall);
                document.attachEvent('onWeixinJSBridgeReady', jsApiCall);
            }
        }else{
            jsApiCall();
        }
    }
</script>
<link href="templates/wap/css/pay.css" rel="stylesheet" type="text/css" />
<div class="block fn-clear">
	<div class="i-block payment">
        <div class="title title2">
       		<div>
            <h3><?php echo $this->_tpl_vars['re']['note']; ?>
</h3>
            <p>
            收款方： Myzx168@163.com<!--<?php if ($this->_tpl_vars['re']['real_name']): ?><?php echo $this->_tpl_vars['re']['real_name']; ?>
<?php else: ?><?php echo $this->_tpl_vars['re']['seller_email']; ?>
<?php endif; ?>-->
            <span><strong><?php echo ((is_array($_tmp=$this->_tpl_vars['re']['price'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2) : number_format($_tmp, 2)); ?>
</strong>元</span>
            </p>
            </div>
        </div>


		
        <?php if ($this->_tpl_vars['re']['statu'] == 1): ?>
        <div class="form">
        <form method="post">
        <input type="hidden" name="act" value="pay" />
        <input type="hidden" name="payment_type" id="payment_type" value="<?php echo $this->_tpl_vars['pay']['0']['payment_type']; ?>
" />
            <fieldset>
            <dl>
                <dt style="margin-left:5px;">请选择支付方式：</dt>
                <dd class="pay">
                    <ul class="fn-clear">
                    <?php if ($this->_tpl_vars['config']['bw'] == 'weixin'): ?>
                    <li>                       
                        <a class="form_weixin_btn" data-param="{'id':'weixin'}">微信支付<i></i></a>            
                    </li>
                    <?php endif; ?>
                    <?php $_from = $this->_tpl_vars['pay']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['list']):
?>
                        <li>           
                            <a class="form_qianbao_btn" data-param="{'id':'<?php echo $this->_tpl_vars['list']['payment_type']; ?>
'}"><img src="image/payment/<?php echo $this->_tpl_vars['list']['payment_type']; ?>
.gif" class="form_qianbao_img"><?php echo $this->_tpl_vars['list']['payment_name']; ?>
<i></i></a>
                            <div style="border-top:1px solid #f1f1f1;height:0;"></div>
                        </li>
                    <?php endforeach; endif; unset($_from); ?>  
                    </ul>
                </dd>
            </dl> 
            </fieldset>
            <?php if ($this->_tpl_vars['account'] != 'false'): ?>
            <fieldset class="fieldset">  
            <dl class="free">
                <dt></dt>
                <dd>可用总额：<span class="free_price"><?php echo $this->_tpl_vars['de']['cash']; ?>
</span> 元</dd>
            </dl> 
            <dl class="free2">
                <dt>支付密码：</dt>
                <dd><input type="password" class="text" name="password" value="" placeholder="填写支付密码" /></dd>
            </dl>
            </fieldset>
            <?php endif; ?>
            <dl class="btn_pay">
                <dt></dt>
                <dd>
                <?php if ($this->_tpl_vars['config']['bw'] == 'weixin'): ?>
                <div class="form_weixin_btns2" onclick="callpay()" >确定支付</div>
                <div style="display:none"><input style="font-size:14px;letter-spacing:1px;margin-left:-12px;padding:0;" type="submit" class="submit" value="确定支付" /></div>
                <?php else: ?>
                <input style="font-size:14px;letter-spacing:1px;margin-left:-12px;" type="submit" class="submit" value="确定支付" />
                <?php endif; ?>
                </dd>
            </dl>
        </form>   
        </div>
        <?php endif; ?>
    
    </div>
</div>
<script type="text/javascript" src="script/jquery-1.4.4.min.js"></script>
<script type="text/javascript">
$(function(){
    $(".pay .fn-clear li:first-of-type").find("i").addClass("formsh")
   $(".pay li").bind("click",function(){
        var liIndex=$(this).index();
        console.log(liIndex)
        var data = $(this).children('a').attr('data-param');
        eval("data = "+data);
        <?php if ($this->_tpl_vars['account'] != 'false'): ?>
        if(data.id=='account')
        {
            $('.fieldset').show();
        }
        else
        {
            $('.fieldset').hide();
        }
        <?php endif; ?>
        $("#payment_type").val(data.id);
        $(this).find("i").toggleClass("formsh").end().siblings().find("i").removeClass("formsh");
        $(".btn_pay dd div").eq(liIndex).show().siblings().hide();
    }); 
})

</script>