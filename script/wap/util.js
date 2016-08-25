/**
 * 公共方法
 * Create by huwei on 2016/6/13
 */
;
define(["require", 'module', "IScroll"], function(require, module, IScroll) {
    /**
     * @class Util
     * @constructor
     */
    function Util() {}
    module.exports = Util;

    /**
     * 活动弹层提示(公共)
     * @method delsWarn
     * @param {String} str 提示信息
     * @param {String} obj1 删除按钮
     * @param {String} obj2 删除元素
    */
    Util.prototype.actsWarn = function(imgsrc) {
        var actsWarn = $("<div class='main-bomb bomb-in'>"+
                "<div class='main-bomb-inner'>"+
                    "<img src='"+imgsrc+"' alt='蚂蚁活动弹框'>"+
                    "<i class='main-bomb-delate'></i>"+
                    "<a href='register.html' class='bomb-content-btn1'></a>"+
                "</div>"+
            "</div>") , dialog_mask=$(".am_dialog_mask");
        function setCookie(objName,objValue,objHours){
            var str = objName + "=" + escape(objValue); 
            if (objHours > 0) {//为0时不设定过期时间，浏览器关闭时cookie自动消失 
                var date = new Date(); 
                var ms = objHours * 3600 * 1000; 
                date.setTime(date.getTime() + ms); 
                str += "; expires=" + date.toGMTString(); 
            } 
                document.cookie = str;
        }
        function getCookie(name){
            var arr,reg=new RegExp("(^| )"+name+"=([^;]*)(;|$)");
            if(arr=document.cookie.match(reg)){
                return unescape(arr[2]);
            }
            else{
                return null;
            }     
        }
        function bombanimate(){
            setCookie("mayi_bomb","mayi_delate","0");
            actsWarn.removeClass("bomb-in")
            actsWarn.addClass("bomb-out")
            dialog_mask.hide();
        }
        if(getCookie("mayi_bomb")!="mayi_delate"){
            $("body").append(actsWarn);
            dialog_mask.show();
        }else{
            actsWarn.hide();
            dialog_mask.hide();
        }
        $(".main-bomb-delate").on("tap",function(){
            bombanimate();
        });
    }
    /**
     * 验证浮层提示
     * @method tipsWarn
     * @param {String} str 提示文字
     * @param {String} time 显示时长
    */
    Util.prototype.tipsWarn = function(str, time) {
        var tipsWrap = $("<div class='alert_tips'><p class='time_01 fadeDown'>" + str + "</p></div>");
        var timenum = time || 2500,
            tips = $(".alert_tips"),
            tips_len = tips.size(),
            num = 0;
        if (tips_len > 0) {
            tips.find("p").html(str);
            clearTimeout(window.timmer);
            num = 0;
            window.timmer = setInterval(function() {
                num += 100;
                if (num > timenum) {
                    tips.removeClass('active');
                    clearInterval(window.timmer);
                    setTimeout(function() {
                        tips.remove();
                    }, 500);
                }
            }, 100);
        } else {
            $("body").append(tipsWrap);
            setTimeout(function() {
                tipsWrap.addClass('active');
            }, 200);
            window.timmer = setInterval(function() {
                num += 100;
                if (num > timenum) {
                    tipsWrap.removeClass('active');
                    clearInterval(window.timmer);
                    setTimeout(function() {
                        tipsWrap.remove();
                    }, 500);
                }
            }, 100);
        }
    }
    /**
     * 操作提示浮层提示
     * @method tipsWarn
     * @param {String} str 提示文字
     * @param {String} time 显示时长
    */
    Util.prototype.operasWarn = function(str, time) {
        var operasWrap = $("<div class='collect_box_content'><p class='time_01 fadeIn'>" + str + "</p></div>");
        var timenum = time || 2500,
            tips = $(".collect_box_content"),
            tips_len = tips.size(),
            num = 0;
        if (tips_len > 0) {
            tips.find("p").html(str);
            clearTimeout(window.timmer);
            num = 0;
            window.timmer = setInterval(function() {
                num += 100;
                if (num > timenum) {
                    tips.removeClass('active');
                    clearInterval(window.timmer);
                    setTimeout(function() {
                        tips.remove();
                    }, 500);
                }
            }, 100);
        } else {
            $("body").append(operasWrap);
            var wid=$(".collect_box_content").width()/2;
            $(".collect_box_content").css({"margin-left":-wid+"px"});
            setTimeout(function() {
                var wid=$(".collect_box_content").width()/2;
                $(".collect_box_content").css({"margin-left":-wid+"px"});
                operasWrap.addClass('active');
            }, 200);
            window.timmer = setInterval(function() {
                num += 100;
                if (num > timenum) {
                    operasWrap.removeClass('active');
                    clearInterval(window.timmer);
                    setTimeout(function() {
                        operasWrap.remove();
                    }, 500);
                }
            }, 100);
        }
    }
    /**
    * 图片延迟加载(公共)
    * @menthod scrollLoading
    * @returns {object}
    */
    Util.prototype.scrollLoading = function(obj) {
        var c = {
            attr: "data-url",
            container: $(window),
            callback: $.noop
        };
        var d = $.extend({}, c);
        d.cache = [];
        $(obj).each(function() {
            var h = this.nodeName.toLowerCase(),
                g = $(this).attr(d.attr);
            var i = {
                obj: $(this),
                tag: h,
                url: g
            };
            d.cache.push(i);
        });
        var f = function(g) {
            if ($.isFunction(d.callback)) {
                d.callback.call(g.get(0))
            }
        };
        var e = function() {
            var g = d.container.height();
            if (d.container.get(0) === window) {
                contop = document.body.scrollTop;
            } else {
                contop = d.container.offset().top
            }
            $.each(d.cache, function(m, n) {
                var p = n.obj,
                    j = n.tag,
                    k = n.url,
                    l, h;
                if (p) {         
                    l = p.offset().top - contop , h = l + p.height();
                    if ((l >= 0 && l < g) || (h > 0 && h <= g)) {
                        if (k) {
                            if (j === "img") {
                                f(p.attr("src", k))
                            } else {
                                p.load(k, {}, function() {
                                    f(p)
                                })
                            }
                        } else {
                            f(p)
                        }
                        n.obj = null
                    }
                }
            })
        };
        e();
        d.container.bind("scroll", e) 
    }
    /**
    * 返回顶部(公共)
    * @menthod scrollTop
    * @menthod obj 返回按钮元素
    * @returns {object}
    */
    Util.prototype.scrollTop = function(btn) {
        function myEvent(obj,ev,fn){
            if(obj.attachEvent){
                obj.attachEvent('on'+ev,fn);
            }else{
                obj.addEventListener(ev,fn,false);
            }
        }
        myEvent(window,'load',function(){
            var oBtn = document.querySelector(btn) , 
                widH = document.documentElement.clientHeight ,
                timer = null ,
                scrollTop;
            window.onscroll=function(){
                scrollTop = document.documentElement.scrollTop||document.body.scrollTop;
                if(scrollTop >= widH){
                    oBtn.style.display = 'block';
                }else{
                    oBtn.style.display = 'none';
                }
                return scrollTop;
            };
            oBtn.onclick=function(){
                clearInterval(timer);
                timer=setInterval(function(){
                    var now = scrollTop , speed = (0-now)/10;
                    speed = speed>0?Math.ceil(speed):Math.floor(speed);
                    if(scrollTop == 0){
                        clearInterval(timer);
                    }
                    document.documentElement.scrollTop = scrollTop+speed;
                    document.body.scrollTop = scrollTop+speed;
                }, 30);
            }
        });
    }
    /**
    * 字符串截取(公共)
    * @menthod scrollTop
    * @menthod obj 返回按钮元素
    */
    Util.prototype.SubString = function(htm,obj,num,txt) {
        function substr(htm,obj,num){
            var value_substr=obj.substr(0,num);
            var pname_len=obj.length;
            var value_substr_len=value_substr.length+1;
            if(pname_len>value_substr_len){
                value_substr=value_substr+"...";                
            }       
            htm.html(value_substr);
        }
        if(obj==""){
            htm.html(txt);
        }
        else{
            substr(htm,obj,num);
        }
    }
    /**
     * 手机号部分隐藏(公共)
    */
    Util.prototype.mobHide = function(obj,htm) {
        obj.each(function(){
            var _this=$(this);
            _this.html(htm.replace(/(\d{3})(\d{4})(\d{4})/,"$1****$3"));
        })
    }
    /**
     * 下拉导航
    */
    Util.prototype.dropDown = function(obj,test) {
        obj.on("tap",function(){
            var _this=$(this);
            _this.find("ul").toggle();
            _this.find("i").toggleClass(test);
            _this.siblings().find("ul").hide();
            _this.siblings().find("i").removeClass(test);
        })
    }
    /**
     * 倒计时
    */
    Util.prototype.countDown = function(obj,date,time,isday) {
        function ShowCountDown(date){ 
            var now = new Date(); 
            var endDate = new Date(date); 
            var leftTime=endDate.getTime()-now.getTime(); 
            if(leftTime<=0){
                clearInterval(timeinterval);
                if(!isday){
                    $(obj).html("<span>00</span>：<span>00</span>：<span>00</span>")
                } else {
                    $(obj).html("<span>00</span>：<span>00</span>：<span>00</span>：<span>00</span>")
                }
                return;
            }
            var leftsecond = parseInt(leftTime/1000); 
            var day1=Math.floor(leftsecond/(60*60*24));
            var hour=Math.floor((leftsecond)/3600); 
            var _hour=Math.floor((leftsecond-day1*24*60*60)/3600);
            var minute=Math.floor((leftsecond-day1*24*60*60-_hour*3600)/60); 
            var second=Math.floor(leftsecond-day1*24*60*60-_hour*3600-minute*60);
            if(!isday){
                var arrTime=[hour,minute,second]; 
                var arrLength=[hour.toString().length,minute.toString().length,second.toString().length];
            } else {
                var arrTime=[day1,_hour,minute,second]; 
                var arrLength=[day1.toString().length,_hour.toString().length,minute.toString().length,second.toString().length]; 
            }
            for(var i=0;i<arrLength.length;i++){
                if(arrLength[i]==1){
                    arrTime[i]="0"+arrTime[i];
                }
            }
            if(!isday){
                $(obj).html(arrTime[0]+"："+arrTime[1]+"："+arrTime[2])
            } else {
                $(obj).html(arrTime[0]+"："+arrTime[1]+"："+arrTime[2]+"："+arrTime[3])
            }
        } 
        var timeinterval =window.setInterval(function(){ShowCountDown(date);}, time); 
    }
    /**
     * tab方法
     * @menthod tab
     * @param {string} nav  滑动导航
     * @param {string} list 滑动的列表
     * @param {string} isMove 背景移动效果
     * @returns {object}
    */
    Util.prototype.tab = function(nav, list, isMove) {
            var wHis = window.history;
            var hstate = wHis.state,
                hisLen = wHis.length;
            var curIndex = hstate ? hstate.curtab : 0,
                curHis = hstate ? hstate.his : -1;
            var $scrollWrap = $("#scrollWrap"),
                $goBack = $("#go_back");
            var backHref = $goBack.attr("data-href");
            $(nav).find(".item").each(function(i) {
                var _this = $(this);
                var _thisW = _this.width();
                stateTab(curIndex, curHis);
                _this.on("tap", function() {
                    // if (isMove) {
                    //     // $(nav).siblings('.nav_bg').animate({
                    //     //     "-webkit-transform": "translateX(" + i * _thisW + "px)",
                    //     //     "transform": "translateX(" + i * _thisW + "px)"
                    //     // }, 300);
                    //     $(nav).siblings('.nav_bg').animate({
                    //         "-webkit-transform": "translateX(" + i * _thisW + "px)",
                    //         "transform": "translateX(" + i * _thisW + "px)"
                    //     }, 0);
                    // }
                    // setTimeout(function() {
                    //     $(nav).find(".focu").removeClass("focu");
                    // }, 200);
                    // setTimeout(function() {
                    //     _this.addClass('focu');
                    // }, 250);
                    curHis--;
                    if (wHis.pushState) {
                        wHis.pushState({
                            curtab: i,
                            his: curHis
                        }, 0, '');
                    }
                    $(nav).find(".focu").removeClass("focu");
                    _this.addClass('focu');
                    $(list).find(".item").eq(i).addClass("cur").siblings().removeClass('cur');
                    if (hisLen > 1 || backHref == "/") {
                        $goBack.attr("href", "javascript:window.history.go(" + curHis + ")");
                    }
                    var innerH = Number($scrollWrap.find(".scroll_con").height()) + 20;
                    var scrollH = Number(document.body.clientHeight);
                    setTimeout(function() {
                        if (innerH < scrollH) {
                            $scrollWrap.height(scrollH + 1);
                        } else {
                            $scrollWrap.height(innerH);
                        }
                        window.scroller.refresh();
                    }, 500);
                })
            })

            function stateTab(state, his) {
                state = state || 0;
                $(nav).find(".item").removeClass("focu").eq(state).addClass('focu');
                $(list).find(".item").eq(state).addClass("cur").siblings().removeClass('cur');
                if (hisLen > 1 || backHref == "/") {
                    $goBack.attr("href", "javascript:window.history.go(" + his + ")")
                }
            }
            window.addEventListener('popstate', function(e) {
                if (history.state) {
                    var state = e.state;
                    stateTab(state.curtab, state.his);
                }
            }, false);
        }
    /**
     * 文字上下滚动效果
     * @menthod textSlide
     * @param {string} list 滚动列表
     * @param {string} time 间隔时间
     * @returns {object}
     */
    Util.prototype.textSlide = function(list, time) {
            var first = $(list).find("li").eq(0).clone();
            $(list).find("ul").append(first);
            var aL = Number($(list).find("li").length),
                ah = $(list).find("li").height();
            var b = 0;
            var timer = null;
            timer = setInterval(function() {
                b++;
                if (b < aL) {
                    if (b == (aL - 1)) {
                        $(list).find("ul").animate({
                            "top": -b * ah + "px"
                        }, 400);
                        setTimeout(function() {
                            $(list).find("ul").css({
                                "top": "0"
                            });
                        }, 500);
                    } else {
                        $(list).find("ul").animate({
                            "top": -b * ah + "px"
                        }, 400);
                    }
                } else {
                    b = 1;
                    $(list).find("ul").animate({
                        "top": -b * ah + "px"
                    }, 400);
                }
            }, time);
        }
    /**
     * Loading显示
     * @param  {[type]} wrap [description]
     * @return {[type]}      [description]
     */
    Util.prototype.hjLoading = function(wrap) {
            var loadingDom = '<div class="loading_box" id="loading_box"></div>';
            $(wrap).append(loadingDom);
            $("#loading_box").show();
        }
    /**
     * Loading close
     * @param  {[type]} load [description]
     * @return {[type]}      [description]
     */
    Util.prototype.hjLoadingClose = function(load) {
              
            setTimeout(function() {
                $(load).remove();
            }, 500);
        }
    Util.prototype.UA = function() {
        var userAgent = navigator.userAgent.toLowerCase();
        alert(userAgent);
        return {
            ipad: /ipad/.test(userAgent),
            iphone: /iphone/.test(userAgent),
            ipod: /ipod/.test(userAgent),
            blackBerry: /blackBerry/.test(userAgent),
            android: /android/.test(userAgent),
            webos: /webOS/.test(userAgent),
            windowsPhone: /Windows Phone/.test(userAgent),
            weixin: /micromessenger/.test(userAgent),
            mayi: /mayi/.test(userAgent)
        };
    }
    Util.prototype.isPhone = function() {
            if (navigator.userAgent.match(/Android/i) || navigator.userAgent.match(/webOS/i) || navigator.userAgent.match(/iPhone/i) || navigator.userAgent.match(/iPad/i) || navigator.userAgent.match(/iPod/i) || navigator.userAgent.match(/BlackBerry/i) || navigator.userAgent.match(/Windows Phone/i)) {
                return true;
            } else {
                return false;
            }
        }
    /**
     * stopPropagation
     * @param  {[type]} e event
     * @return {[type]}   [description]
     */
    Util.prototype.stopPropagation = function(e) {
        e = e || window.event;
        if (e.stopPropagation) { //W3C阻止冒泡方法
            e.stopPropagation();
        } else {
            e.cancelBubble = true; //IE阻止冒泡方法
        }
    };

    Util.prototype.scrollToEle = function() {
        var Request = new Object();
        Request = this.getRequest();
        var obj = Request['scroll'];
        if (obj != "" && obj != undefined) {
            window.scroller.scrollToElement(document.querySelector('#' + obj), 60);
        }
    }
    Util.prototype.getRequest = function() {
        var url = location.search; //获取url中"?"符后的字串
        var theRequest = new Object();
        if (url.indexOf("?") != -1) {
            var str = url.substr(1);
            strs = str.split("&");
            for (var i = 0; i < strs.length; i++) {
                theRequest[strs[i].split("=")[0]] = unescape(strs[i].split("=")[1]);
            }
        }
        return theRequest;
    }
    /**
     * 页面滚动
     * @return {[type]} [description]
     */
    Util.prototype.pScroll = function(swrap, top, up) {
            var _self = this;
            _pullObj = ".pull_down_update";
            $pullH = parseFloat($(".head").height());
            $(swrap).data("up", false);
            var isHasUp = $(swrap).data("up");
            //控制高度不足时页面刷新
            $clientH = document.body.clientHeight;
            $scrollWrap = $(swrap).find("#scrollWrap");
            $scrollWrapHeight = $scrollWrap.height();
            //添加下拉DOM
            if (up && isHasUp == "false") {
                //控制只添加一个Dom
                isHasUp = true;
                //控制高度不足时页面刷新
                if ($scrollWrapHeight <= ($clientH + 1)) {
                    $scrollWrap.height($clientH + 1 + "px");
                }
                $(_pullObj).html("下拉刷新");
                _self.newIScroll(swrap, $pullH, top, _pullObj);
            } else {
                console.log("no no no!!!!!");
                $(_pullObj).empty();
                _self.Iscroll();
            }
            window.isSrollInit = true;
        }
    /**
     * IScroll 事件控制
     * @return {[type]} [description]
     */
    Util.prototype.newIScroll = function(swrap, pullH, top, pullObj) {
            var _self = this , $pullDownObj = $(pullObj) , $isUpdate = false;
            window.scroller = new IScroll(swrap, {
                probeType: 2,
                mouseWheel: false,
                bindToWrapper: true,
                scrollY: true
            }).on('scroll', function() {
                if (this.y >= pullH) {
                    $isUpdate = true;
                    // $(swrap).attr("data-scroll", "on").animate({
                    //     "top": top + "rem"
                    // }, 500);
                    $pullDownObj.html("松开刷新");
                } else if (this.y < 50) {
                    $isUpdate = false;
                    $(swrap).attr("data-scroll", "off").css({
                        "top": "0"
                    });
                    $pullDownObj.html("下拉刷新");
                }
            }).on('scrollEnd', function() {
                if ($isUpdate) {
                    $isUpdate = !$isUpdate;
                    window.location.reload();
                    // _self.loadPage(_self.obj, curHash);
                }
            }).on('refresh', function() {
                console.log("refresh");
            });
        }
    /**
     * 初始化IScroll插件
     */
    Util.prototype.Iscroll = function(obj) {
            var _self = this;
            $(obj).find(".pull_down_update").empty();
            window.scroller = new IScroll(obj, {
                mouseWheel: true,
            });
        }
    /**
     * 初始化IScroll插件
     */
    Util.prototype.otherIscroll = function(obj) {
            $(obj).find(".pull_down_update").empty();
            window.otherScroller = new IScroll(obj, {
                mouseWheel: true,
            });
        }
    Util.prototype.otherIscroll = function(obj) {
        $(obj).find(".pull_down_update").empty();
        window.otherScroller = new IScroll(obj, {
            mouseWheel: true,
        });
    }
    /**
     * 页面内部页效果
     * @param  {[type]} title      [description]
     * @param  {[type]} extendWrap [description]
     * @param  {[type]} content    [description]
     * @return {[type]}            [description]
     */
    Util.prototype.pageRightEffect = function(extendWrap) {
            var _self = this;
            var isTap = true;
            var extendCtrl = $(".extend_swicth"),
                $extendWrap = $(extendWrap);
            extendCtrl.on("tap", function() {
                var _this = $(this);
                var _title = _this.attr("data-title"),
                    _content = _this.attr("data-content");
                var _status = $extendWrap.attr("data-status");
                if (isTap) {
                    isTap = false;
                    if (_status == "off") {
                        var extendWrapContent = $("body").find('#' + _content).html();
                        $extendWrap.find("#extend_wrap_content").html(extendWrapContent);
                        $extendWrap.find("#extend_wrap_title").html(_title);
                        //安卓 webView bug
                        $extendWrap.find(".wrap_til").animate({
                            "top": 0.1
                        }, 200);

                        $extendWrap.show();
                        setExtendOn($extendWrap);
                        $("#header_logo").attr("href", "javascript:void(0);");
                        $("#go_back").attr("href", "javascript:void(0);");
                        _self.otherIscroll("#extend_wrapper");
                    } else {
                        setExtendOff($extendWrap);
                        //安卓 webView bug
                        $extendWrap.find(".wrap_til").css({
                            "top": 0
                        });
                        setTimeout(function() {
                            $("#header_logo").attr("href", "/");
                            $("#go_back").attr("href", "javascript:window.history.go(-1)");
                            $extendWrap.hide();
                        }, 600);
                    }
                    setTimeout(function() {
                        isTap = true;
                    }, 500);
                }
            })

            function setExtendOn(extend) {
                extend.show();
                setTimeout(function() {
                    extend.attr("data-status", "on").addClass('on');
                }, 100);
            }

            function setExtendOff(extend) {
                var _self = this;
                extend.attr({
                    "data-status": "off"
                }).removeClass('on');
            }
        }
    /**
     * [inputFocus description]
     * @param  {[type]} obj    [description]
     * @param  {[type]} height [description]
     * @return {[type]}        [description]
     */
    Util.prototype.inputFocus = function(obj, height) {
        var inputEl = document.querySelector(obj);
        height = height || 200;
        $(obj).on("focus", function() {
            $("#scrollWrap").css({
                "margin-bottom": height + "px"
            });
            window.scroller.refresh();
            window.scroller.scrollTo(0, '-' + height);
            // window.scroller.scrollToElement(inputEl,100);
            setTimeout(function() {
                $("#scrollWrap").css({
                    "margin-bottom": "0"
                });
            }, 800);
        });
        $(obj).on("blur", function() {
            $("#scrollWrap").css({
                "margin-bottom": "0"
            });
            window.scroller.refresh();
        });
    }
    Util.prototype.historyHandler = function(back, str, href) {
            var $back, _his, start, hisStr, slen;
            $back = $(back);
            _his = $back.attr("data-href");
            slen = str.length;
            start = _his.lastIndexOf("/") - slen;
            if (start != -1) {
                hisStr = _his.substr(start, slen);
                if (hisStr == str) {
                    window.location.reload();
                }
            }
        }
    /**
     * [appDown description]
     * @param  {[type]} el [description]
     * @return {[type]}    [description]
     */
    Util.prototype.setUuid = function(len, radix) {
        var CHARS = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz'.split('');    
        var chars = CHARS,
            uuid = [],
            i;
        radix = radix || chars.length;    
        if (len) {      
            for (i = 0; i < len; i++) uuid[i] = chars[0 | Math.random() * radix];    
        } else {      
            var r;      
            uuid[8] = uuid[13] = uuid[18] = uuid[23] = '-';      
            uuid[14] = '4';      
            for (i = 0; i < 36; i++) {        
                if (!uuid[i]) {          
                    r = 0 | Math.random() * 16;          
                    uuid[i] = chars[(i == 19) ? (r & 0x3) | 0x8 : r];        
                }      
            }    
        }     
        return uuid.join('');
    }
})