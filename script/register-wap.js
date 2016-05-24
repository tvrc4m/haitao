function do_login()
{
    if(document.getElementById('mobile').value.length < 1)
    {
        document.getElementById('mobile').focus();
        return false;
    }
    
    if(document.getElementById('smsvode').value.length < 1)
    {
        document.getElementById('smsvode').focus();
        return false;
    }
    if(document.getElementById('password').value.length < 1)
    {
        document.getElementById('password').focus();
        return false;
    }
    if(document.getElementById('user_ni').value.length < 1)
    {
        document.getElementById('user_ni').focus();
        return false;
    }
    if(document.getElementById('user_qq').value.length < 1)
    {
        document.getElementById('user_qq').focus();
        return false;
    }

}
$(function(){
    // $("form").find("input").each(function(){
    //     $(this).focus(function(){
    //         $("form").find('dl').removeClass("focus");
    //         $(this).parents('dl').addClass("focus");
    //         $(this).parentsUntil("form").find("p").css("display","none");
    //     });
    // });
});
var phnumber=/^1(3[0-9]|4[57]|5[0-35-9]|8[0-9]|7[07])\d{8}$/;
var password=/^[A-Za-z0-9]{6,10}$/;
var userni=/^[A-Za-z0-9]{2,16}$/;
var userqq=/^[1-9]\d{4,10}$/;
var phcode=/^[0-9]{6}$/;
$(document).ready(function(){
    jQuery.focusblur = function(focusid) {
        var focusblurid = $(focusid);
        var span = $(focusid).parent().next();
        focusblurid.blur(function(){
            var thisval = $(this).val();
            var tip = $(this).parentsUntil("form").find("p");
            console.log(tip)
            var flag;
            if(focusid == "#mobile"){
                flag = phnumber.test(thisval);
            }
            if(focusid == "#smsvode")
                flag = phcode.test(thisval);
            if(focusid == "#password")
                flag = password.test(thisval);
            if(focusid == "#user_ni")
                flag = userni.test(thisval);
            if(focusid == "#user_qq")
                flag = userqq.test(thisval);
            if(!flag){
                if(focusid == "#mobile"){
                    tip.find(".tipcon").text("请输入正确的手机号码，且为11位纯数字格式");
                }
                if(focusid == "#smsvode"){
                    tip.find(".tipcon").text("请输入正确的验证码，且为6位纯数字格式");
                }
                if(focusid == "#password"){
                    tip.find(".tipcon").text("长度为6-10个字符，建议使用字母加数字组合");
                }
                if(focusid == "#user_ni"){
                    tip.find(".tipcon").text("长度为2-16个字符，建议使用字母加数字组合");
                }
                if(focusid == "#user_qq"){
                    tip.find(".tipcon").text("输入正确qq号");
                }
                tip.css({"display":"block","margin-top": "10px","color":"#ff5c5c"});
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
            }else if(flag&&focusid == "#user_qq"){
                $.ajax({
                    url: 'register.php',
                    type: 'post',
                    data: {user_qq: thisval, check_qq: 'check'},
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
            }else if(flag&&focusid == "#user_ni"){
                $.ajax({
                    url: 'register.php',
                    type: 'post',
                    data: {user_ni: thisval, check_ni: 'check'},
                    dataType: 'json',
                    success: function(datainfo){
                        console.log(datainfo)
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
    $.focusblur("#user_ni");
    $.focusblur("#user_qq");
});