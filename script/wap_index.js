
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

 	// 幻灯片效果
	$jj("#owl-demo").owlCarousel({
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
		$jj(".index_icon1").height(h+"px")
		$jj(".shopli").find("img").height(h1+"px")
	}
	else
	{
		$jj(".index_icon1").height("60px")
		$jj(".shopli").find("img").height("224px")
	}
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
$jj(".m_main-v1s").eq(0).css({"margin-top":"0px"});
$jj(document).scroll(function(){
	var h = $jj(document).scrollTop();
	var wHeight=$jj(window).height();
	if(h>wHeight){
		$jj(".addtop").show()
		$jj(".addtop").click(function(){
			$jj(window).scrollTop(0);
		})
	}else{
		$jj(".addtop").hide()
	}
	if(h > 50)
	{
		$jj(".main").css({"position":"fixed","top":0,"width":"100%","z-index":"999"})
		$jj(".m_main-v1s").eq(0).css({"margin-top":"50px"});
		$jj(".filter").eq(0).css({"margin-top":"50px"})
	}
})
$jj(function(){
	var daHeight=$jj(".da_banner").offset().top;
	$jj(".da_banner li").click(function(){
		$jj(".da_banner").addClass("da_list_test");
		$jj(window).scrollTop(daHeight);
		var liSize=$jj(this).index();
		$jj(this).addClass("current").siblings().removeClass("current");
		$jj(".da_list>div").eq(liSize).addClass("list_current").siblings().removeClass("list_current");
	})	
 	$jj(window).scroll(function(){
        var wScrotop=$jj(window).scrollTop();
        if(wScrotop>=daHeight){
            $jj(".da_banner").addClass("da_list_test");
        }
        else{
            $jj(".da_banner").removeClass("da_list_test");
        }
    })
 })
