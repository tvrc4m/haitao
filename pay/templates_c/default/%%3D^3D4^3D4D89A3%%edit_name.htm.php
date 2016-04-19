<?php /* Smarty version 2.6.20, created on 2016-04-18 14:58:34
         compiled from edit_name.htm */ ?>
<script type="text/javascript" src="script/jquery.validation.min.js"></script>
<link href="templates/default/css/pay.css" rel="stylesheet" type="text/css" />
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

function IdentityCodeValid() {
    var code = $("#identity_card").val();
    var city={11:"北京",12:"天津",13:"河北",14:"山西",15:"内蒙古",21:"辽宁",22:"吉林",23:"黑龙江 ",31:"上海",32:"江苏",33:"浙江",34:"安徽",35:"福建",36:"江西",37:"山东",41:"河南",42:"湖北 ",43:"湖南",44:"广东",45:"广西",46:"海南",50:"重庆",51:"四川",52:"贵州",53:"云南",54:"西藏 ",61:"陕西",62:"甘肃",63:"青海",64:"宁夏",65:"新疆",71:"台湾",81:"香港",82:"澳门",91:"国外 "};
    var tip = "";
    var pass= true;

    if(!code || !/^\d{6}(18|19|20)?\d{2}(0[1-9]|1[12])(0[1-9]|[12]\d|3[01])\d{3}(\d|X)$/i.test(code)){
        tip = "身份证号格式错误";
        pass = false;
    }

    else if(!city[code.substr(0,2)]){
        tip = "身份证地址编码错误，请输入正确的身份证号";
        pass = false;
    }
    else{
        //18位身份证需要验证最后一位校验位
        if(code.length == 18){
            code = code.split('');
            //∑(ai×Wi)(mod 11)
            //加权因子
            var factor = [ 7, 9, 10, 5, 8, 4, 2, 1, 6, 3, 7, 9, 10, 5, 8, 4, 2 ];
            //校验位
            var parity = [ 1, 0, 'X', 9, 8, 7, 6, 5, 4, 3, 2 ];
            var sum = 0;
            var ai = 0;
            var wi = 0;
            for (var i = 0; i < 17; i++)
            {
                ai = code[i];
                wi = factor[i];
                sum += ai * wi;
            }
            var last = parity[sum % 11];
            if(parity[sum % 11] != code[17]){
                tip = "身份证校验位错误，请输入正确的身份证号";
                pass =false;
            }
        }
    }
    if(!pass) alert(tip);
    return pass;
}
</script>
<div class="block">
	<div class="i-block">
    	 <h2>实名认证</h2>
    </div>
    
    <?php if ($this->_tpl_vars['de']['identity_verify'] == 'true'): ?>
    <div class="tips"><span></span>温馨提示：您的实名认证认证成功。</div>
    <?php endif; ?>
    <?php if ($this->_tpl_vars['de']['identity_verify'] == 'false' && $this->_tpl_vars['de']['identity_card'] && $this->_tpl_vars['de']['real_name']): ?>
    <div class="tips"><span></span>温馨提示：您的实名认证信息正在审核中。</div>
    <?php endif; ?>
    <?php if ($this->_tpl_vars['de']['identity_verify'] == 'refused' && $this->_tpl_vars['de']['identity_card'] && $this->_tpl_vars['de']['real_name']): ?>
    <div class="tips"><span></span>温馨提示：您的实名认证信息被拒绝,请重新上传认证资料。</div>
    <?php endif; ?>
    <?php if ($this->_tpl_vars['de']['identity_verify'] != 'true'): ?>
   <!--  <ol class="fn-clear step2">
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
    </ol> -->
    <?php endif; ?>
    <div class="form">
    <form method="post" id="form" onsubmit="return IdentityCodeValid();">
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
            <dd><input type="text" class="text" name="real_name" id="real_name" value="<?php echo $this->_tpl_vars['de']['real_name']; ?>
" <?php if ($this->_tpl_vars['de']['identity_verify'] == 'true'): ?>readonly<?php endif; ?>/>
            <div class="form-error"></div></dd>
        </dl>

        <dl>
            <dt>身份证号码：</dt>
            <dd><input type="text" class="text" name="identity_card" id="identity_card" value="<?php echo $this->_tpl_vars['de']['identity_card']; ?>
" <?php if ($this->_tpl_vars['de']['identity_verify'] == 'true'): ?>readonly<?php endif; ?> onbeforepaste="clipboardData.setData('text',clipboardData.getData('text').replace(/[^\d.]/g,''))" onkeyup="value=value.replace(/[^\d.]/g,'')" /><div class="form-error"></div></dd>
        </dl>
        </fieldset>
        <?php if ($this->_tpl_vars['de']['identity_verify'] != 'true'): ?>
        <dl>
            <dt></dt>
            <dd><input type="submit" class="submit" value="确 定" /></dd>
        </dl>
        <?php endif; ?>
    </form>
    </div>

</div>