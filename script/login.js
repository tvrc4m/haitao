function do_login()
{
	if(document.getElementById('user').value.length < 1)
	{
		alert(nousername);
		document.getElementById('user').focus();
		return false;
	}
	if(document.getElementById('password').value.length < 1)
	{
		alert(nouserpass);
		document.getElementById('password').focus();
		return false;
	}
	if(document.getElementById('randcode').value.length < 1)
	{
		alert(norandcode);
		document.getElementById('randcode').focus();
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
var user=/^[A-Za-z0-9\u4e00}-\u9fa5}]{4,16}$/;
var password=/^[A-Za-z0-9]{6,10}$/;
$(document).ready(function(){
    jQuery.focusblur = function(focusid) { 
        var focusblurid = $(focusid);
        focusblurid.blur(function(){
            var thisval = $(this).val();
            var tip = $(this).parentsUntil("form").find("p");
            var flag; 
            if(focusid == "#user")
                flag = user.test(thisval);
            if(focusid == "#mobile")
                flag = phnumber.test(thisval);
            if(focusid == "#password")
                flag = password.test(thisval);
            if(!flag){
                if(focusid == "#user"){
                    tip.find(".tipcon").text("长度为4-16字符，建议使用字母、数字或中文组合");

                }
                if(focusid == "#mobile"){
                    tip.find(".tipcon").text("请输入正确的手机号码，且为11位纯数字格式");
                }
                if(focusid == "#password"){
                    tip.find(".tipcon").text("长度为6-10个字符，建议使用字母加数字组合");
                }
                tip.css("display","block");
            }

            if(flag&&focusid == "#user"){
                /* 验证用户名 */
                    $.ajax({
                        url: 'register.php',
                        type: 'post',
                        data: {user: thisval, is_check: 'check'},
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

                }else if(flag&&focusid == "#mobile"){
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
            }

        }); 
    }; 
    //下面是调用方法
    $.focusblur("#user"); 
    $.focusblur("#mobile"); 
    $.focusblur("#password");
});
// $(".inp_close").live("tap",function(){
//     var userName=$("#user");
//     if(userName.val() != ""){
//         userName.val("");
//     }
// })