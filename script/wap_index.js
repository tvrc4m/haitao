
// 搜索框
var $jj = jQuery.noConflict();
$jj(function(){
	$jj(".s_main").find("input").focus(function(){
		$jj(".s-page").show().siblings().hide()
		$jj(".cc-search-hide").addClass("cc-search-show").removeClass("cc-search-hide")
		
	})
	$jj(".cc-search-tab > li").click(function(){
		$jj(this).addClass("cur").siblings("li").removeClass("cur");
		$jj("#m").val($jj(this).attr("data"))
		$jj("#s").val($jj(this).attr("data-s"))
	})
	$jj(".cc-back").click(function(){
		$jj(".s-page").hide().siblings().show()
		$jj(".cc-search-show").addClass("cc-search-hide").removeClass("cc-search-show")
	})

	$jj(function(){
		$jj(".scrollLoading").scrollLoading();
	})

 	// 幻灯片效果
	// $jj("#owl-demo").owlCarousel({
	//   navigation : false, // Show next and prev buttons
	//   slideSpeed : 200,
	//   singleItem:true,
	//   autoPlay:2000,
	// });


	// js获取屏幕宽度，自动调节相应模块的宽高比例
 // 	var w=window.innerWidth|| document.documentElement.clientWidth|| document.body.clientWidth;
	// if(w <=540)
	// {
	// 	var rate = w/540;
	// 	var h = 67*100*rate/100;
	// 	var h1 = 224*100*rate/100;
	// 	$jj(".index_icon1").height(h+"px")
	// 	$jj(".shopli").find("img").height(h1+"px")
	// }
	// else
	// {
	// 	$jj(".index_icon1").height("60px")
	// 	$jj(".shopli").find("img").height("224px")
	// }

	function getPositionError(error) {
      //  HTML5 定位失败时，调用百度地图定位   
        var geolocation = new BMap.Geolocation();
        geolocation.getCurrentPosition(function(r){
            if(this.getStatus() == BMAP_STATUS_SUCCESS){
                var mk = new BMap.Marker(r.point);
                var pt = r.point;

                $jj.cookie("lng",pt.lng,{expires:7});
                $jj.cookie("lat",pt.lat,{expires:7});

                $jj.post("ajax_back_end.php",{"act":"reposition","lng":pt.lng,"lat":pt.lat},function(){})
                              
            }
        },{enableHighAccuracy: true});

    }

    function getPositionSuccess( position ){
		var lat = position.coords.latitude;
		var lng = position.coords.longitude;

		var ggPoint = new BMap.Point(lng,lat);

		//转换成百度地图坐标
		var trunback = function (point){

		     $jj.cookie("lng",point.lng,{expires:7});
		     $jj.cookie("lat",point.lat,{expires:7});

		     $jj.post("ajax_back_end.php",{"act":"reposition","lng":point.lng,"lat":point.lat},function(){})
		}

		BMap.Convertor.translate(ggPoint,0,trunback);     
    }



	// 先HTML5定位，定位不到再百度地图定位
	if(!$jj.cookie("lng")  || !$jj.cookie("lat"))
	{
		var position_option = {enableHighAccuracy: true,maximumAge: 30000,timeout: 20000};
        navigator.geolocation.getCurrentPosition(getPositionSuccess, getPositionError, position_option);
	}
	else
	{
	    var t_lng = $jj.cookie("lng")
	    var t_lat = $jj.cookie("lat")

	    $jj.post("ajax_back_end.php",{"act":"reposition","lng":$jj.cookie("lng"),"lat":$jj.cookie("lat")},function(){})
	    
	}

	// 首页附近的店铺异步获取信息
	function getHtmlSecond()
	{
		$jj.post("ajax_back_end.php",{"act":"getNearInfo"},function(data){
			if(data == "1")
			{
				var t = setTimeout(getHtmlSecond,800);
			}
			else
			{
				$jj(".nearShop").html(data);
			}
		});
	}

	if($jj(".nearShop").length > 0)
	{
		getHtmlSecond();
	}
});

$jj(document).scroll(function(){
	var h = $jj(document).scrollTop();
	if(h > 50)
	{
		$jj(".main").css({"position":"fixed","top":0,"width":"100%","z-index":"999"})
		$jj("#J_search").eq(0).css({"margin-top":"50px"});
		$jj(".filter").eq(0).css({"margin-top":"50px"})
	}
})

// $(function(){
// 	$(".guanggao_kong").each(function(index){
// 		$(".guanggao_kong").eq(index).append("<div class='g_wei'>"+
// 	        	"<a href='javascript:void(0)'><img src='image/wap/mayi_wap_guanggao1.jpg'></a>"+
// 	        "</div>")
// 	})		
// })