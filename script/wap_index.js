
// 搜索框
var $jj = jQuery.noConflict();
$jj(function(){
	// var windowWid=$(window).width();
	// $jj(".s-page").css({"-webkit-transform": "translateX("+windowWid+"px)","-moz-transform": "translateX("+windowWid+"px)","-ms-transform": "translateX("+windowWid+"px)","-o-transform": "translateX("+windowWid+"px)","transform": "translateX("+windowWid+"px)"})
	$jj(".s_main").find("input").focus(function(){
		$jj(".s-page").show();
		
		$jj(".cc-search-hide").addClass("cc-search-show").removeClass("cc-search-hide")
		$(".main_container").hide();		
	})
	$jj(".cc-search-tab > li").click(function(){
		$jj(this).addClass("cur").siblings("li").removeClass("cur");
		$jj("#m").val($jj(this).attr("data"))
		$jj("#s").val($jj(this).attr("data-s"))
	})
	$jj(".cc-back").click(function(){
		$jj(".s-page").hide();
		$jj(".cc-search-show").addClass("cc-search-hide").removeClass("cc-search-show")
		$(".main_container").show();	
	})

	$jj(".main_crousel").eq(0).css({"margin-top":"0px"});
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
			$jj(".main").css({"position":"fixed","top":0,"width":"100%","z-index":"999","left":0})
			$jj(".main_crousel").eq(0).css({"margin-top":"50px"});
			$jj(".filter").eq(0).css({"margin-top":"50px"})
		}
	})
});
