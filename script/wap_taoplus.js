// 漂浮插件
$(".taoplus").click(function(){

	var obj = $(this).find("div.circle")
	var obj2 = $(this).find("div.tpbtn")
	
	if(obj.hasClass("hide"))
	{
		obj.removeClass("hide").addClass("show")
		obj2.removeClass("on").addClass("off")
	}
	else
	{
		obj.removeClass("show").addClass("hide")
		obj2.removeClass("off").addClass("on")
	}
})
$(".tpicons").find("li").click(function(){
	location.href=$(this).find("a").attr("dataurl")
})

// 漂浮插件
$("body").append("<script type='text/javascript' src='script/taoplus.js'></script>");
$(".gain_ma").live("tap",function(){
	var _this= $(this)
    var num = 60;
    var time = window.setInterval(function(){
    	_this.addClass("gain_ma_test");
        num = num - 1;
        _this.html(num+ "秒后重新获取");
        if (num < 1) {
        	_this.removeClass("gain_ma_test");
            clearInterval(time);
            _this.html("获取验证码");
            num = 60;
        };
    },1000);
})