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
	/*
	*初始化
	*/
	Check.prototype.init = function(){
	    $("form").find("input").each(function(){
	        $(this).focus(function(){
	            $("form").find('dl').removeClass("focus");
	            $(this).parents('dl').addClass("focus");
	        });
			$(window).keypress(function (event) {
				var key = event.which;
				if (key == 13) {
					$(".button").click();
				}
			});
	    });
	}
	/*
	*登录操作
	*/
	Check.prototype.login = function(){
		var _self = this;
		$(".button").click(function(){
			$.post("/api/login.php",{username:$("#user").val(),password:$("#password").val(),action:"login",forword:url},function(msg){
				var data = JSON.parse(msg);
				if(data.url){
					window.location.href = data.url;
				}else{
					_self.setTip(data.errmsg);	
				}
			});
		});
	};
	/*
	*注册操作
	*/
	Check.prototype.regist = function() {
		var _self = this;
		$(".button").click(function(){
			$.post("/api/login.php",{mobile:$("#mobile").val(),smsvode:$("#smsvode").val(),password:$("#password").val()},function(msg){
				var data = JSON.parse(msg);
				if(data.url){
					window.location.href = data.url;
				}else{
					_self.setTip(data.errmsg);
				}
			});
		});
	};
	/*
	*找回密码
	*/
	Check.prototype.lostpass = function() {
		var _self = this;
		$(".button").click(function(){
			$.post("/api/login.php",{mobile:$("#mobile").val(),smsvode:$("#smsvode").val(),password:$("#password").val()},function(msg){
				var data = JSON.parse(msg);
				if(data.url){
					window.location.href = data.url;
				}else{
					_self.setTip(data.errmsg);
				}
			});
		});
	};
	/*
	*获取验证码
	*/
	Check.prototype.idCode = function(from){
		var _self = this;
		var num = 60;
		var type = from ? from : "lostpass"
	    $(".idcode .btn").click(function(){
	    	$.post("/api/login.php",{username:$("#mobile").val(),action:"yzCode",type:type},function(msg){
	    		var data = JSON.parse(msg);
				_self.setTip(data.errmsg);
				if(data.status == '10017'){
					$(".idcode .btn").attr("disabled","true").css("background-color","#ccc");
                    var interval = window.setInterval(function(){
                        num = num - 1;
                        $(".idcode .btn").attr("value",num+ "秒后重新发送");
                        if (num < 1) {
                            $(".idcode .btn").attr("disabled",false).css("background-color","#ff5c5c");
                            clearInterval(interval);
                            $(".idcode .btn").attr("value","发送短信验证码");
                            num = 60;
                        };
                    },1000);
                    $(".tips").css("display","none");
				}
			});
	    });
	};
	/*
	*错误提示
	*/
	Check.prototype.setTip = function(s){
		$(".tips").text(s).css("display","block");
	}
	module.exports = new Check();
});