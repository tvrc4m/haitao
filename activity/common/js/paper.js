$(function(){
    $(window).load(function(){
        var listHei=$(".page1_5_0 img").width();
        $(".page1_5_zs").css({"width":listHei+"px"});
        $(".page1_5_huoqu").css({"width":listHei+"px"});
    })
    setInterval(function(){
        $(".page1_5 img").attr({"src":"../common/images/paper/pg1_5s.png"});
         setTimeout(function(){
            $(".page1_5 img").attr({"src":"../common/images/paper/pg1_5.png"});
        },500)
    },1000)
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
    var loadingPath='../common/images/paper/';
    var musicPath='';//是否含有背景音乐，有就传路径，没有就为'';
    var manifest=[
        {src:loadingPath+'p1_1.png'},

    ]
    initMusic();
    var luckdrawnum=1;
    var oActImg0 = document.getElementById("luck_0");
    var oActImg1 = document.getElementById("luck_1");
    var oActImg2 = document.getElementById("luck_2");
    var oActImg3 = document.getElementById("luck_3");
    var oActImg4 = document.getElementById("luck_4");
    var oActImg5 = document.getElementById("luck_5");
    var oActImg6 = document.getElementById("luck_6");
    var oActImg7 = document.getElementById("luck_7");
    $(oActImg0).show();
    var aActImgs = [oActImg0,oActImg1,oActImg2,oActImg3,oActImg4,oActImg5,oActImg6,oActImg7];
    var rank0 = 0,rank1 = 1,rank2 = 2,rank3 = 3,rank4 = 4,rank5 = 5,rank6 = 6,rank7 = 7;
    var startNum=0,activeNum = 0,speed = 300,Timer = null,flag=false,cycle=0,EndIndex=0,award_type=0,award_id= 0;
    var activearr=["10元微信红包","11元微信红包","12元微信红包","13元微信红包","14元微信红包","15元微信红包","16元微信红包","17元微信红包"]
    var psui=parseInt(Math.random()*8)
    var award_type=psui;
     $(".page1_4 span").text(luckdrawnum);
    function setActive(){
        activeNum++;
        if(activeNum>= aActImgs.length){
            activeNum = 0;
            cycle++;
        }
        $(aActImgs[activeNum]).show();
        var frame_class = $("#frame").attr("class");
        $('#frame').removeClass(frame_class);
        $(".page1_5_huoqu").removeClass(frame_class);
        $(".page1_5_huoqu img").attr({"src":""});
        $('.page1_5_huoqu p').html("")
        $('#frame').addClass('page5_0_'+activeNum);
        $('.page1_5_huoqu').addClass('page5_0_'+activeNum);
        $(".page1_5_huoqu img").attr({"src":"../common/images/paper/pg1_5_z"+activeNum+".png"});
        $('.page1_5_huoqu p').html(activearr[activeNum])
    }
    function start(){
        var maxnum=(56+award_type)-8
        startNum++
        setActive();
        if(!flag){
            if(startNum<=14){
                clearInterval(Timer);
                speed-=20;
                Timer=setInterval(start,speed);
            }
            if(startNum>14&&startNum<maxnum){
                clearInterval(Timer);
                speed=50;
                Timer=setInterval(start,speed);
            }
            if(startNum>maxnum){
                clearInterval(Timer);
                speed+=120;
                Timer=setInterval(start,speed);
            }
            if( cycle == 7){
                clearInterval(Timer);
                cycle=0;
                startNum=0;
                flag=true;       //触发结束
                Timer=setInterval(start,speed);
            }
        }else{speed+=140;}
        console.log(speed)
        if(flag && activeNum == EndIndex){
            clearInterval(Timer);
            $(".page1_4 span").text(luckdrawnum);
            switch(award_type){
                case 0:
                    doshowyesdiv();
                    $(".page1_9 .pag_test span").text("10元微信红包");
                    $(".page1_9 .pag_img").attr({"src":"../common/images/paper/pg1_5_z0.png"});
                    break;
                case 1:
                    doshowyesdiv();
                    $(".page1_9 .pag_test span").text("11元微信红包");
                    $(".page1_9 .pag_img").attr({"src":"../common/images/paper/pg1_5_z1.png"});
                    break;
                case 2:
                    doshowyesdiv();
                    $(".page1_9 .pag_test span").text("12元微信红包");
                    $(".page1_9 .pag_img").attr({"src":"../common/images/paper/pg1_5_z2.png"});
                    break;
                case 3:
                    doshowyesdiv();
                    $(".page1_9 .pag_test span").text("13元微信红包");
                    $(".page1_9 .pag_img").attr({"src":"../common/images/paper/pg1_5_z3.png"});
                    break;
                case 4:
                    doshowyesdiv();
                    $(".page1_9 .pag_test span").text("14元微信红包");
                    $(".page1_9 .pag_img").attr({"src":"../common/images/paper/pg1_5_z4.png"});
                    break;
                case 5:
                    doshowyesdiv();
                    $(".page1_9 .pag_test span").text("15元微信红包");
                    $(".page1_9 .pag_img").attr({"src":"../common/images/paper/pg1_5_z5.png"});
                    break;
                case 6:
                    doshowyesdiv();
                    $(".page1_9 .pag_test span").text("16元微信红包");
                    $(".page1_9 .pag_img").attr({"src":"../common/images/paper/pg1_5_z6.png"});
                    break;
                case 7:
                    doshowyesdiv();
                    $(".page1_9 .pag_test span").text("17元微信红包");
                    $(".page1_9 .pag_img").attr({"src":"../common/images/paper/pg1_5_z7.png"});
                    break;
            }
        flag=false;
        speed=300;
        }
    }
    function ajaxData(rank){
        clearInterval(Timer);
        flag=false;
        switch(rank){
            case 0:
                EndIndex = rank0;
                break;
            case 1:
                EndIndex = rank1;
                break;
            case 2:
                EndIndex = rank2;
                break;
            case 3:
                EndIndex = rank3;
                break;
            case 4:
                EndIndex = rank4;
                break;
            case 5:
                EndIndex = rank5;
                break;
            case 6:
                EndIndex = rank6;
                break;
            case 7:
                EndIndex = rank7;
                break;
            default:
        }
        Timer = setInterval(start, speed);
    }
    var rawnum=$(".page1_4").html()
    if(rawnum<=0){
        $(".page5_13 img").attr({"src":"../common/images/paper/pg1_5_4.png"})
    }
    function startGo(){
        $(".page5_13").on("click",function (){
            if(luckdrawnum>0){              
                ajaxData(award_type);
                luckdrawnum--;  //抽奖次数减1
                //ajaxData(award_type);    //调试虚拟数据
                //ajax获取后台数据
                /*$.ajax({
                     type : 'post',
                     url : imgUrl + 'Index/Raffle',
                     dataType : 'json',
                     success : function (data)
                     {
                         if(data.award_id == undefined)
                         {
                             if(data.info == '奖品已经被领完!')
                             {
                                 award_type =  0;
                                 ajaxData(award_type);
                             }
                             else{
                                alert(data.info);
                             }
                             //wxData['title'] = "真遗憾，差一点就中奖了";
                             //shareFn(dataConfig);
                         }
                         else
                         {
                             award_type = award_id =  data.award_id;
                             ajaxData(award_type);
                             //wxData['title'] = jiangping[award_id];
                             //shareFn(dataConfig);
                         }
                     }
                 })*/
            if(luckdrawnum==0){
                $(".page5_13 img").attr({"src":"../common/images/paper/pg1_5_4.png"})
            }
            }else{
                alert('已经没有抽奖次数了，明天再来吧！');
            }
        });
    }
    startGo();
    //未中奖显示内容
    function doshownodiv(){
        // $('.page1_9').show();
        // $(".am-dialog-mask").addClass("am-dialog-mask-test")
    }
    //中奖显示内容
    function doshowyesdiv(){
        $('.page1_9').show();
        $(".am-dialog-mask").addClass("am-dialog-mask-test")
    }
    $(".btn_img").bind("click",function(){
        $('.page1_9').hide();
        $(".am-dialog-mask").removeClass("am-dialog-mask-test")
    })
    //初始化音乐，如果musicPath=''，相当于什么都没做
    function initMusic(){
        if(musicPath!=''){
            $('.main').append('<div class="musicicon musicrotate"></div><audio id="media" loop autoplay="autoplay" src="'+musicPath+'"></audio>');
            $('.musicicon').on(touchstart,function(){
                var mySound = $('#media')[0];
                if($(this).hasClass('musicrotate')){
                    mySound.pause();
                    $(this).removeClass('musicrotate');
                }else{
                    mySound.play();
                    $(this).addClass('musicrotate');
                }
            })
        }
    }
})


