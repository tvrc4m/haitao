<?php /* Smarty version 2.6.20, created on 2016-04-25 18:10:47
         compiled from edit_name.htm */ ?>
<script type="text/javascript" src="script/jquery.validation.min.js"></script>
<link href="templates/wap/css/pay.css" rel="stylesheet" type="text/css" />
<script>
$(function(){
	$('#form').validate({
		errorPlacement: function(error, element){
			element.nextAll('.form-error').append(error);
		},      
		rules : {
			real_name:{
				required:true
			},
			identity_card:{
				required:true
			}
		},
		messages : {
			real_name:{
				required:'请输入真实姓名。'
			},
			identity_card:{
				required:'请输入身份证号码。'
			}
		}
	});
});
</script>
<div class="block">
	<div class="i-block">
    	 <h2>实名认证</h2>
    </div>
    
    <?php if ($this->_tpl_vars['de']['identity_verify'] == 'true'): ?>
    <div class="tips"><span></span>温馨提示：您的实名认证认证成功。</div>
    <?php else: ?>
    
    <?php if ($this->_tpl_vars['de']['identity_verify'] == 'false' && $this->_tpl_vars['de']['identity_card'] && $this->_tpl_vars['de']['real_name']): ?>
    <div class="tips"><span></span>温馨提示：您的实名认证信息正在审核中。</div>
    <?php endif; ?>
    
    <ol class="fn-clear step2">
        <li class="fore1">  
            <em class="icon">        
                <i></i>
                <strong></strong>
                <b>1</b>
            </em>
            <span>验证身份</span>
        </li>			
        <li class="fore2">
            <em class="icon">        
                <i></i>
                <strong></strong>
                <b>2</b>
            </em>
            <span>实名认证</span>
        </li>			
        <li class="fore3">
            <em class="icon">        
                <i></i>
                <b>3</b>
            </em>
            <span>成功</span>
        </li>	
    </ol>
    <div class="form">
    <form method="post" id="form">
    <input type="hidden" value="name" name="act" />
       	<fieldset>
        <dl class="email">
            <dt><?php echo $this->_tpl_vars['config']['company']; ?>
账户名：</dt>
            <dd><?php echo $this->_tpl_vars['de']['pay_email']; ?>
</dd>
        </dl>
        
        <dl>
            <dt>真实姓名：</dt>
            <dd><input type="text" class="text" name="real_name" id="real_name" value="" />
            <div class="form-error"></div></dd>
        </dl>
        
        <dl>
            <dt>身份证号码：</dt>
            <dd><input type="text" class="text" name="identity_card" id="identity_card" value="" onbeforepaste="clipboardData.setData('text',clipboardData.getData('text').replace(/[^\d.]/g,''))" onkeyup="value=value.replace(/[^\d.]/g,'')" /><div class="form-error"></div></dd>
        </dl>
        
		</fieldset>
        <dl>
        	<dt></dt>
            <dd><input type="submit" class="submit" value="确 定" /></dd>
        </dl>
    </form>  
    </div>
    <?php endif; ?>
</div>