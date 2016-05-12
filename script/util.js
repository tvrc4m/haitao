/**
 * 公共方法
 * Create by LiXiongXiong on 2015/11/13
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
     * 浮层提示
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
                        console.log(tips);
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
         * dialogFn 弹层
         * @param  {[type]} id      [description]
         * @param  {[type]} title   [description]
         * @param  {[type]} content [description]
         * @param  {[type]} touch    是否触发关闭
         * @return {[type]}         [description]
         */
    Util.prototype.dialogFn = function(id, title, content, touch) {
            var diaWrap = '<div class="hj_dialog" id="hj_dialog_' + id + '">\
                            <div class="inner">\
                                <div class="dia_wrap">\
                                    <div class="con_box time_01 fadeDown">\
                                        <div class="ic_close"></div>\
                                        <h3>提示</h3>\
                                        <div class="handler_box"></div>\
                                    </div>\
                                </div>\
                            </div>\
                        </div>';
            $("body").append(diaWrap);
            var $wrapObj = $("#hj_dialog_" + id);
            var $titleObj = $wrapObj.find("h3"),
                $closeObj = $wrapObj.find(".ic_close"),
                $conObj = $wrapObj.find(".handler_box");
            $titleObj.html(title);
            $conObj.html(content);
            $wrapObj.animate({
                "opacity": 1
            }, 800);
            setTimeout(function() {
                $wrapObj.addClass('active');
            }, 100);
            $closeObj.on("tap", function() {
                closeDia();
            })
            if (touch) {
                $wrapObj.on("tap", function(e) {
                    if ($(e.target).parents(".con_box").length == 0) {
                        closeDia();
                    }
                });
            }

            function closeDia() {
                window.isSending = true;
                $closeObj.parents("#hj_dialog_" + id).removeClass("active");
                $closeObj.parents("#hj_dialog_" + id).animate({
                    "opacity": 0
                }, 500);
                setTimeout(function() {
                    $closeObj.parents("#hj_dialog_" + id).remove();
                }, 600);
            }
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
            var hstate = wHis.state,hisLen = wHis.length;
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
                    if(hisLen > 1 || backHref == "/"){
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
                if(hisLen > 1 || backHref == "/"){
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
         * 侧面导航开关
         * @menthod navToggle
         * @param {String} btn 开关按钮
         * @param {String} bwrap 页面盒子
         * @param {String} menu 侧面导航    
         * @returns {object}     
         */
    Util.prototype.navToggle = function(btn, bwrap, menu) {
            var _self = this;
            var moveX, moveY, startX, startY, scaleV, startPageX, startPageY, _status, _thisTranX;
            var isTouch = false;
            $(btn).on("tap", function() {
                mSwitch(btn, bwrap, menu);
            });
            $(bwrap).find("#wrapper").on("tap", function(e) {
                e.stopPropagation();
                _status = $(btn).attr("data-open");
                if (_status == "on") {
                    $(btn).attr("data-open", "off");
                    $(bwrap).removeClass("open");
                    $(menu).removeClass("open");
                }
            });
            $(bwrap).on("swipeRight", function(e) {
                _self.stopPropagation(e);
                $(btn).attr("data-open", "off");
                $(bwrap).removeClass("open");
                $(menu).removeClass("open");
            });
            $(bwrap).on("swipeLeft", function(e) {
                _self.stopPropagation(e);
                $(btn).attr("data-open", "on");
                $(bwrap).addClass("open");
                $(menu).addClass("open");
            });
            // $(bwrap).on("touchstart", function(e) {
            //     var _this = $(this);
            //     _thisTranX = _this.attr("data-X");
            //     _status = $(btn).attr("data-open");
            //     var pos = e.touches[0];
            //     startX = pos.pageX - e.target.parentNode.offsetLeft;
            //     startY = pos.pageY - e.target.parentNode.offsetTop;
            //     startPageX = pos.pageX - startX;
            //     startPageY = pos.pageY - startY;
            // }).on("touchmove", function(e) {
            //     var _this = $(this);
            //     var pos = e.touches[0];
            //     moveX = pos.pageX - startX;
            //     moveY = pos.pageY - startY;
            //     // if (startPageY > moveY) {console.log("上滑");}
            //     // if (startPageY < moveY) {console.log("下滑");}
            //     // if (startPageX > moveX) {console.log("左滑");}
            //     // if (startPageX < moveX) {console.log("右滑");}
            //     //判断横向滚动
            //     // if (Math.abs(startPageY - moveY) > 0) {
            //     //     console.log("1111");
            //     // }
            //     if (_status == "off") {
            //         if (moveX < 0) {
            //             scaleV = 1 - Math.abs(moveX) / 400;
            //             if (scaleV < 0.8) {
            //                 scaleV = 0.8;
            //             }
            //             _this.css('-webkit-transform', 'translateX(' + moveX + 'px) scale(' + scaleV + ')').attr("data-X", moveX);
            //             $(menu).css('-webkit-transform', 'translateX(' + (200 - Math.abs(moveX)) + 'px)');
            //         }
            //         if (moveX <= -150) {
            //             $(btn).attr("data-open", "on");
            //             _this.attr({
            //                 "style": "",
            //                 "data-X": "-200"
            //             }).addClass("open");
            //             $(menu).attr("style", "").addClass("open");
            //         }
            //     }
            // }).on("touchend", function() {
            //     var _this = $(this);
            //     if (_status == "off") {
            //         if (moveX < 0 && moveX > -150) {
            //             moveX = 0;
            //             _this.css('-webkit-transform', 'translateX(0)').attr("data-X", "0");
            //             $(menu).css('-webkit-transform', 'translateX(200px)');
            //         }
            //     }
            // })
            function mSwitch(btn, bwrap, menu) {
                var status = $(btn).attr("data-open");
                if (status == "off") {
                    $(btn).attr("data-open", "on");
                    $(bwrap).addClass("open");
                    $(menu).addClass("open");
                } else {
                    $(btn).attr("data-open", "off");
                    $(bwrap).removeClass("open");
                    $(menu).removeClass("open");
                }
            }
        }
        /**
         * 格式化银行卡号
         * @menthod formatBankcardNo
         * @param {String} bankcard     
         * @returns {String}     
         */
    Util.prototype.formatBankcardNo = function(bankcard) {
            var bcA = bankcard.split(''),
                bc = '',
                j;
            for (var i = 0; i < bcA.length; i++) {
                j = i + 1;
                if (j % 4 == 0) bc += bcA[i] + ' '
                else bc += bcA[i];
            }
            return bc
        }
        /**
         * [ajaxPager description] 分页加载
         * @param  {String}   btn      点击加载按钮
         * @param  {String}   ul       加载列表ul
         * @param  {String}   ajaxUrl  Ajax加载url
         * @param  {String}   method   Ajax 请求方式
         * @param  {Object}   postdata Ajax 提交数据
         * @param  {Function} callback 请求成功后回调
         * @return {[type]}            [description]
         */
    Util.prototype.ajaxPager = function(btn, ul, ajaxUrl, method, postdata, callback,cur,loading) {
            var _self = this,isTap = false,totalNum = $(ul).attr("data-pages");
            var current = 1;
            if(loading == undefined) loading = true;
            if(cur == "0" && totalNum != 0){
                domLoad(1,loading);
            }
            //delegate 函数  rightPaper处加载更多
            $(".scroller").delegate(btn,"tap",function(){
            // $(btn).on("tap", function() {
                isTap = true;
                current++;
                if (current <= totalNum) {
                    if (isTap) {
                        isTap = false;
                        domLoad(current,true);
                    }
                }
            })

            function domLoad(page,isload){
                $(btn).html("正在加载...");
                postdata.page = page;
                $.ajax({
                    url: ajaxUrl,
                    type: method || 'GET',
                    dataType: 'json',
                    data: postdata,
                    beforeSend: function() {
                        isload ? _self.hjLoading("#wrapper") : '';
                    },
                    success: function(data) {
                        if (data != "" && data != undefined) {
                            if (data.statusCode == 200) {
                                var dataList = data.content.data;
                                callback(dataList);
                                $(btn).html("查看更多");
                                isTap = true;
                                if (page == totalNum) $(btn).remove();
                                //刷新IScroll插件
                                setTimeout(function() {
                                    var innerH = Number($("#scrollWrap").find(".scroll_con").height()) + 20;
                                    var scrollH = Number(document.body.clientHeight);
                                    if (innerH < scrollH) {
                                        $("#scrollWrap").height(scrollH + 1);
                                    } else {
                                        $("#scrollWrap").height(innerH);
                                    }
                                    window.scroller.refresh();
                                    window.otherScroller.refresh();
                                }, 800);
                                $("#wrapper").find("a").on("tap", function() {
                                    $(this).trigger("click");
                                })
                                $(".scroller").find("a").on("tap", function() {
                                    $(this).trigger("click");
                                });
                            } else {
                                _self.tipsWarn("加载失败！请稍后刷新再试");
                                $(btn).html("查看更多");
                                isTap = true;
                            }
                        } else {
                            _self.tipsWarn("服务器请求失败，请稍后刷新再试");
                            $(btn).html("查看更多");
                            isTap = true;
                        }
                    },
                    complete: function() {
                        setTimeout(function() {
                            isload ? _self.hjLoadingClose("#loading_box") : '';
                        }, 500);
                    },
                    error: function() {
                        _self.tipsWarn("加载失败！请稍后刷新再试");
                        $(btn).html("查看更多");
                        isTap = true;
                    }
                })
            }
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
            $(load).hide();
            setTimeout(function() {
                $(load).remove();
            }, 500);
        }
        /**
         * 分享
         * @param  {[type]} wrap [description]
         * @return {[type]}      [description]
         */
    // Util.prototype.hjShare = function(wrap,vcode) {
    //         var _self = this;
    //         var ua = _self.UA();
    //         if(ua.mayi){
    //             Android.share(vcode);
    //         }else{
    //             var shareDom = '<div class="hj_share_box" id="share_box"></div>';
    //             $(wrap).append(shareDom);
    //             $("#share_box").show();
    //             $("#share_box").on("tap", function() {
    //                 $(this).animate({
    //                     "opacity": "0"
    //                 }, 800);
    //                 setTimeout(function() {
    //                     $("#share_box").remove();
    //                 }, 800);
    //             })
    //         }
    //     }
        /**
         * 截取字符串
         * @param  {[type]} str   [description]
         * @param  {[type]} start [description]
         * @param  {[type]} end   [description]
         * @return {[type]}       [description]
         */
    Util.prototype.subString = function(str, start, end) {
            str = str.substring(start, end);
            return str;
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
    /**
     * [weixinShare description]
     * @param  {[type]} appid     [description]
     * @param  {[type]} timestamp [description]
     * @param  {[type]} nonceStr  [description]
     * @param  {[type]} signature [description]
     * @param  {[type]} img       [description]
     * @param  {[type]} plink     [description]
     * @param  {[type]} pdesc     [description]
     * @param  {[type]} ptitle    [description]
     * @return {[type]}           [description]
     */
    // Util.prototype.weixinShare = function(appid, timestamp, nonceStr, signature, img, plink, pdesc, ptitle, qtil) {
    //     var wxData = {
    //         "appId": "", // 服务号可以填写appId
    //         "imgUrl": img,
    //         "link": plink,
    //         "desc": pdesc,
    //         "title": ptitle
    //     };
    //     weixin.config({
    //         debug: false,
    //         appId: appid,
    //         timestamp: timestamp,
    //         nonceStr: nonceStr,
    //         signature: signature,
    //         jsApiList: [
    //             // 所有要调用的 API 都要加到这个列表中'checkJsApi',
    //             'onMenuShareTimeline', 'onMenuShareAppMessage', 'onMenuShareQQ', 'onMenuShareWeibo', 'hideMenuItems', 'showMenuItems', 'hideAllNonBaseMenuItem', 'showAllNonBaseMenuItem', 'translateVoice', 'startRecord', 'stopRecord', 'onRecordEnd', 'playVoice', 'pauseVoice', 'stopVoice', 'uploadVoice', 'downloadVoice', 'chooseImage', 'previewImage', 'uploadImage', 'downloadImage', 'getNetworkType', 'openLocation', 'getLocation', 'hideOptionMenu', 'showOptionMenu', 'closeWindow', 'scanQRCode', 'chooseWXPay', 'openProductSpecificView', 'addCard', 'chooseCard', 'openCard'
    //         ]
    //     });
    //     weixin.ready(function() {
    //         //隐藏右上角菜单
    //         // wx.hideOptionMenu();
    //         // 在这里调用 API
    //         var title = wxData.title;
    //         var desc = wxData.desc;
    //         var link = wxData.link;
    //         var imgUrl = wxData.imgUrl;
    //         // 2. 分享接口
    //         // 2.1 监听“分享给朋友”，按钮点击、自定义分享内容及分享结果接口
    //         weixin.onMenuShareAppMessage({
    //             title: title,
    //             desc: desc,
    //             link: link,
    //             imgUrl: imgUrl
    //         });
    //         // 2.2 监听“分享到朋友圈”按钮点击、自定义分享内容及分享结果接口
    //         weixin.onMenuShareTimeline({
    //             title: qtil,
    //             link: link,
    //             imgUrl: imgUrl
    //         });
    //     });
    // }
    // Util.prototype.UA = function() {
    //     var userAgent = navigator.userAgent.toLowerCase();
    //     return {
    //         ipad: /ipad/.test(userAgent),
    //         iphone: /iphone/.test(userAgent),
    //         ipod: /ipod/.test(userAgent),
    //         blackBerry: /blackBerry/.test(userAgent),
    //         android: /android/.test(userAgent),
    //         webos: /webOS/.test(userAgent),
    //         windowsPhone: /Windows Phone/.test(userAgent),
    //         weixin: /micromessenger/.test(userAgent),
    //         mayi: /mayi/.test(userAgent)
    //     };
    // }
    Util.prototype.isPhone = function() {
            if (navigator.userAgent.match(/Android/i) || navigator.userAgent.match(/webOS/i) || navigator.userAgent.match(/iPhone/i) || navigator.userAgent.match(/iPad/i) || navigator.userAgent.match(/iPod/i) || navigator.userAgent.match(/BlackBerry/i) || navigator.userAgent.match(/Windows Phone/i)) {
                return true;
            } else {
                return false;
            }
        }
        /**
         * [CalculateEarnings description]
         * @param {[type]} rmoney [description]
         * @param {[type]} days   [description]
         * @param {[type]} rate   [description]
         */
    Util.prototype.CalculateEarnings = function(rmoney, days, rate) {
            var EarningsNum = rmoney * (rate / 365) * days;
            return EarningsNum;
        }
        /**
         * [CalculateCashNum description]
         * @param {[type]} rmoney [description]
         * @param {[type]} rate   [description]
         */
    Util.prototype.CalculateCashNum = function(rmoney, rate) {
            var cashNum = rmoney * rate;
            return cashNum;
        }
        /**
         * 格式化带“,”号分割的数字
         * @param  {[type]} str [description]
         * @return {[type]}     [description]
         */
    Util.prototype.formatNumber = function(str) {
        str = str.replace(new RegExp(/,/g), '');
        return str
    }
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
         * [countTime description]
         * @param  {[type]} str [description]
         * @param  {[type]} obj [description]
         * @return {[type]}     [description]
         */
    Util.prototype.countTime = function(str, obj, text) {
            var _obj = $(obj);
            _obj.each(function(i) {
                    var _this = $(this);
                    var $start = Number(_this.attr("data-time")),
                        $now = Number(_this.attr("data-now")),
                        $href = _this.attr("data-href"),
                        $iscan = _this.attr("data-iscan"),
                        $status = _this.attr("data-status");
                    var sTimmer;
                    if ($start != "" && $now != "" && $status == "yes") {
                        timeHandler();
                        sTimmer = setInterval(function() {
                            timeHandler();
                        }, 1000);
                    }
                    

                    function timeHandler() {
                        var _countTime, $days, $hours, $minutes, $second;
                        $now += 1000;
                        _countTime = $start - $now;
                        if (_countTime > 0) {
                            $days = Math.floor(_countTime / (1000 * 60 * 60 * 24)),
                                $hours = Math.floor(_countTime / (1000 * 60 * 60) % 24),
                                $minutes = Math.floor(_countTime / (1000 * 60) % 60),
                                $second = Math.floor(_countTime / 1000 % 60);
                            $days = ($days > 0) ? $days + "天" : "";
                            // $hours = ($hours > 0) ? $hours+"小时" : "";
                            $minutes = ($minutes >= 0 && $minutes < 10) ? "0" + $minutes : $minutes;
                            $second = ($second >= 0 && $second < 10) ? "0" + $second : $second;
                            _this.addClass("ing").removeClass("no").html('<span>' + str + '</span>' + $days + $hours + '小时' + $minutes + '分' + $second + '秒');
                        } else {
                            clearInterval(sTimmer);
                            if($href != null || $href != undefined){
                                _this.attr("href",$href);
                            }
                            _this.removeClass("ing").attr({
                                "data-iscan": "yes"
                            }).html(text);
                            _this.parent().siblings().find("input").removeAttr("disabled");
                        }
                    }
                })
                // _start = Number(_obj.attr("data-time")),
                //     _now = Number(_obj.attr("data-now"));
                // if (_start != "" && _now != "") {
                //     timeHandler();
                //     ctimmer = setInterval(function() {
                //         timeHandler();
                //     }, 1000);
                // }
        }
        /**
         * 页面滚动
         * @return {[type]} [description]
         */
    Util.prototype.pScroll = function(swrap, top, up) {
            var _self = this;
            _pullObj = ".pull_down_update";
            $pullH = parseFloat($(".head").height()) + 10;
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
            var _self = this,
                $pullDownObj = $(pullObj),
                $isUpdate = false;
            window.scroller = new IScroll(swrap, {
                probeType: 2,
                mouseWheel: true,
                bindToWrapper: true,
                scrollY: true
            }).on('scroll', function() {
                if (this.y >= pullH) {
                    $isUpdate = true;
                    $(swrap).attr("data-scroll", "on").animate({
                        "top": top + "rem"
                    }, 500);
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
            extendCtrl.on("tap",function() {
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
                        $extendWrap.find(".wrap_til").animate({"top":0.1},200);

                        $extendWrap.show();
                        setExtendOn($extendWrap);
                        $("#header_logo").attr("href", "javascript:void(0);");
                        $("#go_back").attr("href", "javascript:void(0);");
                        _self.otherIscroll("#extend_wrapper");
                    } else {
                        setExtendOff($extendWrap);
                        //安卓 webView bug
                        $extendWrap.find(".wrap_til").css({"top":0});
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
    // Util.prototype.appDown = function(el){
    //     var _self = this;
    //     var androidUrl = "http://fusion.qq.com/cgi-bin/qzapps/unified_jump?appid=42240537";
    //     var ua = _self.UA();
    //     var downDOM = "<div class='m_app_down'><p class='fl'><i class='icon_app'></i><span>蚂蚁在线<br><em>安卓1.0隆重发布</em></span></p><a href='http://fusion.qq.com/cgi-bin/qzapps/unified_jump?appid=42240537' class='fr b_down_btn' id='b_down_btn' onclick=\"dplus.track('点击安卓App下载', {})\">下载App</a><div class='b_close_btn' id='b_close_btn'><b></b></div></div>";
    //     var isShow = _self.getCookie("m_b_down_close");
    //     if(ua.android && !ua.mayi && isShow != "close"){
    //         $(el).append(downDOM);
    //     }
    //     $(el).delegate("#b_close_btn","tap",function(){
    //         $(".m_app_down").remove();
    //         _self.setCookie("m_b_down_close","close",1);
    //     })
    //     $(el).delegate("#b_down_btn","tap",function(){
    //         _self.setCookie("m_b_down_close","close",30);
    //     })
    // }
    /**
         * set cookie, non-comment use
         *
         * @method setCookie, non-comment use, please use setLocalStorage instead
         * @param {String} name
         * @param {String} value
         * @param {Int} day
         */
    Util.prototype.setCookie = function(name, value, day) {
            var Days = day || 30;
            var exp = new Date();
            exp.setTime(exp.getTime() + Days * 24 * 60 * 60 * 1000);
            var theDate = new Date(exp),expiresTime = new Date(theDate.toLocaleDateString());
            document.cookie = name + "=" + escape(value) + ";expires=" + expiresTime;
        }
        /**
         * get cookie, non-comment use
         *
         * @method getCookie, non-comment use, please use getLocalStorage instead
         * @param {String} name
         * @returns {String}
         */
    Util.prototype.getCookie = function(name) {
            var arr = document.cookie.match(new RegExp("(^| )" + name + "=([^;]*)(;|$)"));
            if (arr != null) return unescape(arr[2]);
            return null;
        }
    /**
     * set uuid
     * @param  {Number} len   uuid length
     * @param  {Number} radix radix
     * @return {[type]}       uuid
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