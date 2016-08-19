/**
 * 用户登陆
 * @author LiXiongXiong
 * @method hjLogin
 * 
 */
define(["module", "utility",  "formValid"], function(module, Util, formValid) {
    "use strict";
    function hjLogin() {
        this.init();
    }
    var formValid = new formValid();
    var utility = new Util();
    hjLogin.prototype.init = function() {
        var _self = this;
    };
    hjLogin.prototype.formtap = function(form, obj1, obj2 ,obj3) {
        $(form).find(obj1).each(function(){
            $(this).on('input propertychange', function(){
                var val=$(this).val();
                if(val !=""){
                    $(this).parent().find(obj2).addClass(obj3);
                }
                else{
                     $(this).parent().find(obj2).removeClass(obj3);
                }           
            }); 
            $(this).on("focus",function(){
                var val=$(this).val();
                if(val !=""){
                    $(this).parent().find(obj2).addClass(obj3);
                }else{
                    $(this).parent().find(obj2).removeClass(obj3);
                }
            });
            $(this).on("blur",function(){
                $(this).parent().find(obj2).removeClass(obj3);
            });  
        });
        $(obj2).on("click", function(){ 
            $(this).parent().find("input").val("");
            $(this).removeClass(obj3);
        });  
    }
    hjLogin.prototype.loginCtrl = function(form, subBtn , ajaxUrl ,skipUrl) {
        formValid.init(form);
        $(subBtn).on("click", function() {
            var url = skipUrl,
                userVal = $(form).find("input[name=user]").val(),
                pwdVal = $(form).find("input[name=password]").val();
            $.ajax({
                url: ajaxUrl + "?" + Math.random(),
                type: "POST",
                dataType: "json",
                data: {
                    username:userVal,
                    password:pwdVal,
                    action:"login",
                    forword:url
                },
                success: function(data) {
                    if(!data.url){
                        utility.tipsWarn(data.errmsg);
                    
                    }else{
                        window.location.href = data.url;  
                    } 
                },
                error: function() {
                    utility.tipsWarn("抱歉，请求错误，请刷新再试！");
                }
            })
        })
    }
    hjLogin.prototype.registerCtrl = function(form, subBtn , ajaxUrl, skipUrl) {
        $(subBtn).on("click", function() {
            var url = skipUrl,
                mobileVal = $(form).find("input[name=mobile]").val(),
                svodeVal = $(form).find("input[name=smsvode]").val(),
                pwdVal = $(form).find("input[name=password]").val();
            $.ajax({
                url: ajaxUrl + "?" + Math.random(),
                type: "POST",
                dataType: "json",
                data: {
                    username:mobileVal,
                    password:pwdVal,
                    action:"register",
                    forword:url
                },
                success: function(data) {
                    if(!data.url){
                        utility.tipsWarn(data.errmsg);
                    
                    }else{
                        window.location.href = data.url;  
                    } 
                },
                error: function() {
                    utility.tipsWarn("抱歉，请求错误，请刷新再试！");
                }
            })
        })
    }
    hjLogin.prototype.lostpassCtrl = function(form, subBtn , ajaxUrl, skipUrl) {
        $(subBtn).on("click", function() {
            var url = skipUrl,
                mobileVal = $(form).find("input[name=mobile]").val(),
                svodeVal = $(form).find("input[name=smsvode]").val(),
                pwdVal = $(form).find("input[name=password]").val();
            $.ajax({
                url: ajaxUrl + "?" + Math.random(),
                type: "POST",
                dataType: "json",
                data: {
                    username:mobileVal,
                    password:pwdVal,
                    action:"lostpass",
                    forword:url
                },
                success: function(data) {
                    if(!data.url){
                        utility.tipsWarn(data.errmsg);
                    
                    }else{
                        window.location.href = data.url;  
                    } 
                },
                error: function() {
                    utility.tipsWarn("抱歉，请求错误，请刷新再试！");
                }
            })
        })
    }
    hjLogin.prototype.sendValidCode = function(isForm ,form, sedBtn, sec, ajaxUrl) {
        var _self = this, num = sec ,timer = null;
        var type = isForm ? isForm : "lostpass"
        $(sedBtn).on("click",function(){
            var _this = $(this) , mobileVal = $(form).find("input[name=mobile]").val();
            $.ajax({
                url: ajaxUrl + "?" + Math.random(),
                type: "POST",
                dataType: "json",
                data: {
                    username:mobileVal,
                    action:"yzCode",
                    type:type
                },
                success: function(data) {
                    utility.tipsWarn(data.errmsg);
                    if(data.status == '10017'){
                        _this.attr("disabled",true);
                        _this.removeClass("yes").addClass("no").html('<var>' + num + '</var>秒后重新发送');
                        timer = setInterval(function() {
                            num--;
                            if (num < 0) {
                                clearInterval(timer);
                                _this.attr("disabled",false);
                                _this.removeClass("no").addClass("yes").html("发送短信验证码");
                                num = sec;
                            } else {
                                _this.find("var").html(num);
                            }
                        }, 1000);
                    }
                },
                error: function() {
                    utility.tipsWarn("抱歉，请求错误，请刷新再试！");
                }
            })
            return false;
        });
    }
    hjLogin.prototype.checker = function(obj) {
        $(obj).on("click", function() {
            var _this = $(this), icon=String("&#xe712;") ,icon2=String("&#xe738;");
            if (_this.hasClass("seled")) {
                _this.removeClass("seled");
                _this.find("i.txt_icon6").html(icon2)
            } else {
                _this.addClass("seled");
                _this.find("i.txt_icon6").html(icon)
            }
        });
    }
    module.exports = new hjLogin();
});