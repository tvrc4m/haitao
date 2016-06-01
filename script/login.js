function do_login()
{
	if(document.getElementById('user').value.length < 1)
	{
		document.getElementById('user').focus();
		return false;
	}
	if(document.getElementById('password').value.length < 1)
	{
		document.getElementById('password').focus();
		return false;
	}
}
function do_register()
{
    if(document.getElementById('mobile').value.length < 1)
    {
        document.getElementById('mobile').focus();
        return false;
    }
    if(document.getElementById('password').value.length < 1)
    {
        document.getElementById('password').focus();
        return false;
    }
    if(document.getElementById('phcode').value.length < 1)
    {
        document.getElementById('phcode').focus();
        return false;
    }
}
/*focus边框变色*/
$(function(){
    $("form").find("input").each(function(){
        $(this).focus(function(){
            $("form").find('dl').removeClass("focus");
            $(this).parents('dl').addClass("focus");
            $(this).parentsUntil("form").find("p").css("display","none");
        });
    });
});

var phnumber=/^1(3[0-9]|4[57]|5[0-35-9]|8[0-9]|7[07])\d{8}$/;
var password=/^[\s\S]{6,16}$/;
var phcode=/^[0-9]{6}$/;
$(document).ready(function(){
    jQuery.focusblur = function(focusid) { 
        var focusblurid = $(focusid);
        focusblurid.blur(function(){
            var thisval = $(this).val();
            var tip = $(this).parentsUntil("form").find("p");
            var flag =true; 
            if(focusid == "#user" && thisval =="")
                flag = false;
            if(focusid == "#mobile")
                flag = phnumber.test(thisval);
            if(focusid == "#smsvode")
                flag = phcode.test(thisval);
            if(focusid == "#password")
                flag = password.test(thisval);
            if(!flag){
                if(focusid == "#user"){
                     tip.find(".tipcon").text("请输入用户名");
                }
                if(focusid == "#mobile"){
                    tip.find(".tipcon").text("请输入正确的手机号码，且为11位纯数字格式");
                }
                if(focusid == "#smsvode"){
                    tip.find(".tipcon").text("请输入正确的验证码，且为6位纯数字格式");
                }
                if(focusid == "#password"){
                    tip.find(".tipcon").text("长度为6-10个字符");
                }
                tip.css("display","block");
            }
            if(flag&&focusid == "#mobile"){
                $.ajax({
                    url: 'register.php',
                    type: 'post',
                    data: {mobile: thisval, check_mobile: 'check'},
                    dataType: 'json',
                    success: function(datainfo){
                        if(datainfo.status_code!=200) {
                            tip.find(".tipcon").text(datainfo.message);
                            tip.css("display","block");
                        }else{
                            tip.css("display","none");
                        }
                    }
                });
            }else if(flag&&focusid == "#smsvode"){
                $.ajax({
                    url: 'register.php',
                    type: 'post',
                    data: {smsvode: thisval, check_sms: 'check'},
                    dataType: 'json',
                    success: function(datainfo){
                        if(datainfo.status_code!=200) {
                            tip.find(".tipcon").text(datainfo.message);
                            tip.css("display","block");
                        }else{
                            tip.css("display","none");
                        }
                    }
                });
            }
       }); 
    }; 
    //下面是调用方法
    $.focusblur("#mobile");
    $.focusblur("#smsvode");  
    $.focusblur("#password");
    $.focusblur("#user");
});