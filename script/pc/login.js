/*
*登录、注册、找回密码页面js
*author:tianxiaobao
*/
define(function (require,exports,module) {
	var $ = require('jquery');
	"use strict";
	function Check(){
		this.init();
	}
	var url = "<{$smarty.get.forward}>";
	/*
	*初始化
	*/
	Check.prototype.init = function(){
	    $("form").find("input").each(function(){
	        $(this).focus(function(){
	            $("form").find('dl').removeClass("focus");
	            $(this).parents('dl').addClass("focus");
	        });
	    });
	}
	/*
	*登录操作
	*/
	Check.prototype.login = function(){
		var _self = this;
		$(".button").click(function(){
			$.post("login.php",{name:$("#user").val(),password:$("#password").val(),action:"login",forword:url},function(data){
				switch(data.code){
					case 1001:
						this.setTip("请输入用户名");
						break;
					case 1002:
						this.setTip("请输入用户名");
						break;
					case 1003:
						$(".tips").css("display","none");
						break;
				}
			});
		});
	};
	/*
	*注册操作
	*/
	Check.prototype.regist = function() {
		$(".button").click(function(){
			$.post("register.php",{mobile:$("#mobile").val(),smsvode:$("#smsvode").val(),password:$("#password").val()},function(data){
				switch(data.code){
					case 1001:
						this.setTip("请输入用户名");
						break;
					case 1002:
						this.setTip("请输入用户名");
						break;
					case 1003:
						alert(3);
						break;
				}
			});
		});
	};
	/*
	*获取验证码
	*/
	Check.prototype.idCode = function(){
		var num = 60;
	    $(".idcode .btn").click(function(){
	    	$.post("register.php",{mobile:$("#mobile").val()},function(data){
				switch(data.code){
					case 1001:
						this.setTip();
						break;
					case 1002:
						$(".idcode .btn").attr("disabled","true").css("background-color","#ccc");
                        var interval = window.setInterval(function(){
                            num = num - 1;
                            $(".idcode .btn").attr("value",num+ "秒后重新发送");
                            if (num < 1) {
                                $(".idcode .btn").attr("disabled",false).css("background-color","#ff5c5d");
                                clearInterval(interval);
                                $(".idcode .btn").attr("value","发送短信验证码");
                                num = 60;
                            };
                        },1000);
						break;
				}
			});
	    });
	};
	Check.prototype.setTip = function(s){
		$(".tips").text(s).css("display","block");
	}
	module.exports = new Check();
});