/*
*登录注册找回密码页面js
*author:tianxiaobao
*/
define(function (require,exports,module) {
	var $ = require('jquery');
	"use strict";
	function Check(){
		this.init();
	}
	Check.prototype.init = function(){
		/*focus边框变色*/
		$(function(){
		    $("form").find("input").each(function(){
		        $(this).focus(function(){
		            $("form").find('dl').removeClass("focus");
		            $(this).parents('dl').addClass("focus");
		            
		        });
		    });
		});
	}
	/*
	*登录操作
	*/
	Check.prototype.login = function(){
		$("input[type=button]").click(function(){
			$.post("login.php",{name:$("#user").val(),password:$("#password").val()},function(msg){
				switch(msg.code){
					case 1001:
						setTip("请输入用户名");
						break;
					case 1002:
						setTip("请输入用户名");
						break;
					case 1003:
						$(".tips").css("display","none");
						break;
				}
				function setTip(s){
					$(".tips").text(s).css("display","block");
				}
			});
		});
	};
	/*
	*注册操作
	*/
	Check.prototype.regist = function() {
		$("input[type=submit]").click(function(){
			$.post("",{mobile:$("#mobile").val(),smsvode:$("#smsvode").val(),password:$("#password").val()},function(msg){
				switch(msg.code){
					case 1001:
						alert(1);
						break;
					case 1002:
						alert(2);
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
	Check.prototype.idcode = function(){
		var num = 60;
	    $(".idcode .btn").click(function(){
	    	$.post("",{mobile:$("#mobile").val()},function(msg){
				switch(msg.code){
					case 1001:
						alert(1);
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
	module.exports = new Check();
});