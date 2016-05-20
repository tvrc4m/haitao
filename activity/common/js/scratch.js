$(function(){
    var a=$(window).height();
    if(a<=960){
        $(".page1_2").addClass('page1_2s');
        $(".page1_8").addClass('page1_8s');
        $(".page1_6").addClass('page1_6s');
        $(".page1_3").addClass('page1_3s');
        $(".page1_4").addClass('page1_4s');
    }
    if(a==853){
        $(".page1_2").addClass('page1_2ss');
        $(".page1_8").addClass('page1_8ss');
        $(".page1_6").addClass('page1_6ss');
        $(".page1_3").addClass('page1_3ss');
        $(".page1_4").addClass('page1_4ss');
    }
    var mobile   = /Android|webOS|iPhone|iPad|iPod|BlackBerry/i.test(navigator.userAgent);
    var touchstart = mobile ? "touchstart" : "mousedown";
    var touchend = mobile ? "touchend" : "mouseup";
    var touchmove = mobile ? "touchmove" : "mousemove";
    $('html,body').on(touchmove,function(e){
        e.preventDefault()
    })
    var dotimer;
    var is_timer=false;
    var movenum=0;
    var downtime=30;
    var pagemove=false;
    var moneynum=0;
    var motionObj=[];
    var loadingPath='../common/images/scratch/';
    var musicPath='';//是否含有背景音乐，有就传路径，没有就为'';
    var manifest=[
        {src:loadingPath+'p1_1.png'},
    ]
    var  lefnum=parseInt($(".page1_5").css("margin-left"))*2;
    var  topnum=parseInt($(".page1_5").css("margin-top"))*2;
    console.log(lefnum)
    var ptext = ["10元微信红包","11元微信红包","12元微信红包","13元微信红包","14元微信红包","15元微信红包","16元微信红包","17元微信红包"];
    // 前端测试
    var psui=parseInt(Math.random()*4)
    // 前端测试
    $("#price p").html(ptext[psui]);
    $("#price img").attr({"src":"../common/images/scratch/pg1_5_z"+psui+".png"})
    var myCanvas = document.getElementById("mycanvas");
    var ctx = myCanvas.getContext("2d");
    var touchRadius = 20;
    ctx.fillStyle = "#666666";
    ctx.fillRect(0,0,500,300);
    var fillCircle = function(x,y,radius,fillColor){
        this.fillStyle = fillColor || "#EEE";
        this.beginPath();
        this.moveTo(x,y);
        this.arc(x,y,radius,0,Math.PI * 2,false);
        this.fill();
    }
    var device = /android|webos|iphone|ipad|ipod|blackberry|iemobile|opera mini/i.test(navigator.userAgent.toLowerCase());
    // navigator.userAgent.toLowerCase() 判断liulanqi类型并转成小写
    var clickEvtName = device ? 'touchstart' : 'mousedown';
    var moveEvtName = device ? 'touchmove' : 'mousemove';
        if(!device){
            var isMouseDown = false;
            document.addEventListener("mouseup",function(e){
                isMouseDown = false;
            },false);
        }else{
            document.addEventListener("touchmove",function(e){
                if(isMouseDown){
                    e.preventDefault();
                }
            },false);
            document.addEventListener("mouseup",function(e){
                isMouseDown = false;
            },false);
        }
        
    myCanvas.addEventListener(clickEvtName,function(e){
        isMouseDown = true;
        var x = (device?e.touches[0].clientX:e.clientX)-80;
        var y = (device?e.touches[0].clientY:e.clientY)-468;
        ctx.globalCompositeOperation = "destination-out";
        fillCircle.call(ctx,x,y,touchRadius);
    },false);

    myCanvas.addEventListener(moveEvtName,function(e){
        if(!device && !isMouseDown){
            return false;
        }
        var x = (device?e.touches[0].clientX:e.clientX)-80;
        var y = (device?e.touches[0].clientY:e.clientY)-468;
        ctx.globalCompositeOperation = "destination-out";
        fillCircle.call(ctx,x,y,touchRadius);
        e.preventDefault();
        mousedown = false;
        var data=ctx.getImageData(0,0,x,y).data;
        for(var i=0,j=0;i<data.length;i+=4){
            if(data[i] && data[i+1] && data[i+2] && data[i+3]){
            j++;
            }
        }
        if(j<=x*y*0.35){
            var aText=$("#price p").html();
            var aImg=$("#price img").attr("src");
            $('.page1_9').show();
            $(".am-dialog-mask").addClass("am-dialog-mask-test")
            $(".page1_9 .pag_test span").text(aText);
            $(".page1_9 .pag_img").attr({"src": aImg});
        }
    },false);
    $(".btn_img").bind("click",function(){
        $('.page1_9').hide();
        $(".am-dialog-mask").removeClass("am-dialog-mask-test")
    })
})


