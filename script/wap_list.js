$(function(){
    $(window).scroll(function(){
        var h = $(window).scrollTop();
        var wHeight=500;
        if(h>wHeight){
            $(".addtop").show()
            $(".addtop").click(function(){
                $(window).scrollTop(0);
            })
        }else{
            $(".addtop").hide()
        }
        if(h > 50)
        {
            $(".main").css({"position":"fixed","top":0,"width":"100%","z-index":"999"});
            $(".filter").css({"position":"fixed","top":"50px","width":"100%","z-index":"9999","background-color":"#fff","margin-top":"0px"})
            $(".itemSearchList").eq(0).css({"margin-top":"50px"})
        }
    })
    $(".list").click(function(){
        window.scroll(0,0);
        $('.leftcate').show();
        $('.itemSearchResult').hide();
        $('.main').append('<div id="leftmask"></div>')
        $('#leftmask')[0].style.height =$(".main").height()+20;
    });
    $('.remove').click(function(){
        $('.leftcate').hide();
        $('.itemSearchResult').show();
        $('#leftmask').remove();
    });
    $(".scrollLoading").scrollLoading(); 
})