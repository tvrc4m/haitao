<?php /* Smarty version 2.6.20, created on 2016-04-22 14:53:42
         compiled from withdraw.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'number_format', 'withdraw.htm', 41, false),)), $this); ?>
<script type="text/javascript" src="script/jquery-1.4.4.min.js"></script>
<script type="text/javascript" src="script/Validator.js"></script>
<link href="templates/wap/css/pay.css" rel="stylesheet" type="text/css" />
<div class="block">
	<div class="i-block">
    	 <h2>提取到银行卡<span><a class="withdraw" href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/?m=payment&s=record&mold=2">提取记录</a></span></h2>
    </div>
    <div style="background-color:#ededed;height:10px;"></div>
	<div class="form">
    <form method="post" onSubmit="return Validator.Validate(this,3)">
    <input type="hidden" name="act" value="withdraw" />
    	<fieldset id="bank">
        <dl>
            <dt>姓名</dt>
            <dd><input type="text" class="text w100" name="CardName" id="CardName" placeholder="开户人姓名" dataType="Require" msg="请填写开户人姓名" /></dd>
        </dl>
    	<dl>
        	<dt>银行</dt>
            <dd><input type="text" class="text w210" name="bank" id="bank" placeholder="输入银行"  dataType="Require" msg="请填写收款方"/></dd>
        </dl>
    	<dl>
        	<dt>卡号</dt>
            <dd><input type="text" class="text w210" name="CardNo" id="CardNo" placeholder="银行卡号" maxlength="32"  dataType="Require" msg="请填写银行卡号" onbeforepaste="clipboardData.setData('text',clipboardData.getData('text').replace(/[^\d.]/g,''))" onkeyup="value=value.replace(/[^\d.]/g,'')"/></dd>
        </dl>
    	
        </fieldset>
        <div style="background-color:#ededed;height:10px;"></div>
        <fieldset id="amount">
        <dl>
        	<dt>金额</dt>
            <dd><input type="text" placeholder="免服务费" class="text w100" name="amount" id="amount" dataType="Require" onblur="calculateFee(this.value)" msg="请填写付款金额" onbeforepaste="clipboardData.setData('text',clipboardData.getData('text').replace(/[^\d.]/g,''))" onkeyup="value=value.replace(/[^\d.]/g,'')"/></dd>
        </dl>
        <!-- <dl>
        	<dt>到账时间：</dt>
            <dd class="time">
            	<?php $_from = $this->_tpl_vars['fee']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['list']):
?>
                <p>
                    <label>
                        <input type="radio" name="supportTime" value="<?php echo $this->_tpl_vars['list']['id']; ?>
" <?php if (! $this->_tpl_vars['key']): ?>checked="checked"<?php endif; ?> data-param="{'max':'<?php echo $this->_tpl_vars['list']['fee_max']; ?>
','min':'<?php echo $this->_tpl_vars['list']['fee_min']; ?>
','rates':'<?php echo $this->_tpl_vars['list']['fee_rates']; ?>
'}" />
                        <span><?php echo $this->_tpl_vars['list']['name']; ?>
</span>
                        <em><?php echo ((is_array($_tmp=$this->_tpl_vars['list']['fee_rates'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2) : number_format($_tmp, 2)); ?>
%服务费</em>
                    </label>
                </p>
                <?php endforeach; endif; unset($_from); ?>
            </dd>
        </dl>
        <dl class="free">
        	<dt>服务费：</dt>
            <dd>
            <span id="extraFee">0</span> 元（付款总额<span id="amountTotal" class="org">0</span>元）
            <div class="freeItem">
                <div class="i-item">
                    <a href="#">点击查看收费标准</a>
                    <div class="fn-hide">	
                        <table>
                            <tr>
                                <th>到账时间</th>
                                <th>服务费率</th>
                                <th>服务费下限</th>
                                <th>服务费上限</th>
                            </tr>
            				<?php $_from = $this->_tpl_vars['fee']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['list']):
?>
                            <tr>
                            	<td><?php echo $this->_tpl_vars['list']['name']; ?>
</td>
                            	<td><?php echo ((is_array($_tmp=$this->_tpl_vars['list']['fee_rates'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2) : number_format($_tmp, 2)); ?>
%</td>
                            	<td><?php echo ((is_array($_tmp=$this->_tpl_vars['list']['fee_min'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2) : number_format($_tmp, 2)); ?>
元/笔</td>
                            	<td><?php echo ((is_array($_tmp=$this->_tpl_vars['list']['fee_max'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2) : number_format($_tmp, 2)); ?>
元/笔</td>
                            </tr>
               			 	<?php endforeach; endif; unset($_from); ?>
                        </table>
                    </div>
                </div>
            </div>
            
            </dd>
        </dl> -->
        </fieldset>
        <fieldset id="other">
        <dl class="otherss">
        	<dt>说明</dt>
            <dd><input type="text" class="text w210" name="reason" id="reason" placeholder="可选" /></dd>
        </dl>
        </fieldset>
        <fieldset>
            <dl class="otherss">
                <dt>密码</dt>
                <dd><input type="password" class="text w210" name="pay_passwd" id="pay_passwd" placeholder="支付密码" /></dd>
            </dl>
        </fieldset>
        <dl>
            <dt></dt>
            <dd>
            <input type="submit" class="submit" value="确定提现" />
            <div class="tixian">提现额度不低于<span>100.00</span>元</div>
            </dd>
        </dl>
    </form>    
    </div>
</div>	
<script type="text/javascript">
$('.freeItem').hover(function(){					 
	$(this).addClass("hover");
},function(){
	$(this).removeClass("hover")
});

// $(".time").find("input[type='radio']").click(function(){
// 	var val = $("input[name='amount']").val();	
// 	calculateFee(val);
// });

// function calculateFee(val){
// 	if(!val)
// 	{
// 		return false;	
// 	}
// 	var amount = parseFloat(val).toFixed(2);
// 	if (amount <= 0) return;
// 	var data = $(".time").find("input[type='radio']:checked").attr('data-param');
//     console.log(data)
// 	eval("data = "+data);
// 	var i=data.min;
// 	var a=data.max;
// 	var r=data.rates/100;
// 	var n=0;
// 	if(r*amount<=i){ n=i; }
// 	else if(r*amount>=a){ n=a; }
// 	else{ n=r*amount; }
// 	//n=Math.round(n);//小叶写的
//     var pn=new Number(n);//poy改的
//     n=pn.toFixed(2);//poy改的
// 	$('#extraFee').html(n);
// 	$('#amountTotal').html((parseFloat(n)+parseFloat(amount)).toFixed(2));
// }
// $(function(){
//     var a=$("#amount").val();
//     console.log(a)
//     if(a<100){
//         a=100;
//     } 
// })
   
</script>