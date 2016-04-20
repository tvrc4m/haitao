$(function(){
    $(document).scroll(function(){
        var h = $(document).scrollTop();
        if(h > 50)
        {
            $(".main").css({"position":"fixed","top":0,"width":"100%","z-index":"999"});
            $(".filter").css({"position":"fixed","top":"50px","width":"100%","z-index":"9999","background-color":"#fff","margin-top":"0px"})
            $(".itemSearchList").eq(0).css({"margin-top":"100px"})
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
    function distribute_goods(id){
        var url = '<{$config.weburl}>/module/distribution/add.php';
        var uname='<{$smarty.cookies.USER}>';
        if(uname=='')
        {
            alert('<{$lang.no_logo}>');
            window.location.href='<{$config.weburl}>/login.php?forward=index.php?m=product&s=detail&id='+id;
            return false;
        }
        var pars = 'pid='+id+'&uname='+uname;
        $.post(url, pars,showResponse);
        function showResponse(originalRequest)
        {
            if(originalRequest>1)
                alert('成功添加至我的分销!');
            else if (originalRequest>0)
                alert('该内容已经在你的分销中心，请勿重复添加！');
            else
                alert('参数传递错误，无法完成操作!');
        }
    }
    $(".scrollLoading").scrollLoading();
})