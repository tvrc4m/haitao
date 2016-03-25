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
$(function(){
    $("form").find("input").each(function(){
        $(this).focus(function(){
            $("form").find('dl').removeClass("focus");
            $(this).parents('dl').addClass("focus");
        });
    });
});
var phnumber=/^13[0-9]{1}[0-9]{8}$|14[57]{1}[0-9]{8}$|15[0-9]{1}[0-9]{8}$|18[0-9]{1}[0-9]{8}$/;
var user=/^[A-Za-z0-9\u4e00}-\u9fa5}]{4,16}$/;
var password=/^[A-Za-z0-9]{6,10}$/;
$(document).ready(function(){ 
    jQuery.focusblur = function(focusid) { 
        var focusblurid = $(focusid);
        var span = $(focusid).parent().parent().next(); 
        focusblurid.blur(function(){ 
            var thisval = $(this).val();
            var flag; 
            if(focusid == "#user")
                flag = user.test(thisval);
            if(focusid == "#mobile")
                flag = phnumber.test(thisval);
            if(focusid == "#password")
                flag = password.test(thisval);

            if(flag){
                span.removeClass("fault");
                span.addClass("correct");
                } else{
                span.removeClass("correct");
                span.addClass("fault");
            }

        }); 
    }; 
    /*下面是调用方法*/ 
    $.focusblur("#user"); 
    $.focusblur("#mobile"); 
    $.focusblur("#password");
}); 
$(".inp_close").live("tap",function(){
    var userName=$("#user");
    if(userName.val() != ""){
        userName.val("");
    }
})