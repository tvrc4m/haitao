jQuery.noConflict();
// 搜索框
jQuery(function(){
	jQuery(".s_main").find("input").focus(function(){
		jQuery(".s-page").show().siblings().hide()
		jQuery(".cc-search-hide").addClass("cc-search-show").removeClass("cc-search-hide")
		
	})
	jQuery(".cc-search-tab > li").click(function(){
		jQuery(this).addClass("cur").siblings("li").removeClass("cur");
		jQuery("#m").val(jQuery(this).attr("data"))
		jQuery("#s").val(jQuery(this).attr("data-s"))
	})
	jQuery(".cc-back").click(function(){
		jQuery(".s-page").hide().siblings().show()
		jQuery(".cc-search-show").addClass("cc-search-hide").removeClass("cc-search-show")
	})

 	// 幻灯片效果
	jQuery("#owl-demo").owlCarousel({
	  navigation : false, // Show next and prev buttons
	  slideSpeed : 200,
	  singleItem:true,
	  autoPlay:2000,
	});


	// js获取屏幕宽度，自动调节相应模块的宽高比例
 	var w=window.innerWidth|| document.documentElement.clientWidth|| document.body.clientWidth;
	if(w <=540)
	{
		var rate = w/540;
		var h = 67*100*rate/100;
		var h1 = 224*100*rate/100;
		jQuery(".index_icon1").height(h+"px")
		jQuery(".shopli").find("img").height(h1+"px")
	}
	else
	{
		jQuery(".index_icon1").height("60px")
		jQuery(".shopli").find("img").height("224px")
	}

	function getPositionError(error) {
      //  HTML5 定位失败时，调用百度地图定位   
        var geolocation = new BMap.Geolocation();
        geolocation.getCurrentPosition(function(r){
            if(this.getStatus() == BMAP_STATUS_SUCCESS){
                var mk = new BMap.Marker(r.point);
                var pt = r.point;

                jQuery.cookie("lng",pt.lng,{expires:7});
                jQuery.cookie("lat",pt.lat,{expires:7});

                jQuery.post("ajax_back_end.php",{"act":"reposition","lng":pt.lng,"lat":pt.lat},function(){})
                              
            }
        },{enableHighAccuracy: true});

    }

    function getPositionSuccess( position ){
		var lat = position.coords.latitude;
		var lng = position.coords.longitude;

		var ggPoint = new BMap.Point(lng,lat);

		//转换成百度地图坐标
		var trunback = function (point){

		     jQuery.cookie("lng",point.lng,{expires:7});
		     jQuery.cookie("lat",point.lat,{expires:7});

		     jQuery.post("ajax_back_end.php",{"act":"reposition","lng":point.lng,"lat":point.lat},function(){})
		}

		BMap.Convertor.translate(ggPoint,0,trunback);     
    }



	// 先HTML5定位，定位不到再百度地图定位
	if(!jQuery.cookie("lng")  || !jQuery.cookie("lat"))
	{
		var position_option = {enableHighAccuracy: true,maximumAge: 30000,timeout: 20000};
        navigator.geolocation.getCurrentPosition(getPositionSuccess, getPositionError, position_option);
	}
	else
	{
	    var t_lng = jQuery.cookie("lng")
	    var t_lat = jQuery.cookie("lat")

	    jQuery.post("ajax_back_end.php",{"act":"reposition","lng":jQuery.cookie("lng"),"lat":jQuery.cookie("lat")},function(){})
	    
	}

	// 首页附近的店铺异步获取信息
	function getHtmlSecond()
	{
		jQuery.post("ajax_back_end.php",{"act":"getNearInfo"},function(data){
			if(data == "1")
			{
				var t = setTimeout(getHtmlSecond,800);
			}
			else
			{
				jQuery(".nearShop").html(data);
			}
		});
	}

	if(jQuery(".nearShop").length > 0)
	{
		getHtmlSecond();
	}
});

jQuery(document).scroll(function(){
	var h = jQuery(document).scrollTop();
	if(h > 50)
	{
		jQuery(".main").css({"position":"fixed","top":0,"width":"100%","z-index":"20"})
		jQuery("#J_search").eq(0).css({"margin-top":"50px"});
		jQuery(".filter").eq(0).css({"margin-top":"50px"})
	}
})
// jQuery(function(){
// 	jQuery(".guanggao_kong").each(function(index){
// 		jQuery(".guanggao_kong").eq(index).append("<div class='g_wei'>"+
// 	        	"<a href='javascript:void(0)'><img src='image/wap/mayi_wap_guanggao1.jpg'></a>"+
// 	        "</div>")
// 	})		
// })