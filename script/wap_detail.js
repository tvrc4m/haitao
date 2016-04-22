 var $jq = jQuery.noConflict();
 $jq(function(){
 	var dScrotop=$jq(".nav-box").offset().top;
 	$jq(window).scroll(function(){
        var wScrotop=$jq(document).scrollTop();
        if(wScrotop>=dScrotop){
            $jq(".nav-box").addClass("nav-wrapper-test");
        }
        else{
            $jq(".nav-box").removeClass("nav-wrapper-test");
        }
    })
    $jq(".nav-box ul li").click(function(){
    	$jq(window).scrollTop(dScrotop);
        var liLength=$jq(this).index();
        $jq(this).addClass("active").siblings().removeClass("active");
        $jq(".j_tab").eq(liLength).addClass("pdetail_show").siblings().removeClass("pdetail_show");
    })
    $jq(".select_guanshui_ic").click(function(){
        $jq(".select_guanshui_hid").toggleClass("select_guanshui_hid_test");
    })
    $jq(".scrollLoading").scrollLoading();
 })
