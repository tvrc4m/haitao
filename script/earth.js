var Earth=function (config) {
	var defaults={
		shareTitle:'',
		shareLink:"",
		sharePhoto:"",
		shareContent:""
	};
	defaults=$.fn.extend({},defaults,config);
	for(var option in defaults){
        Object.defineProperty(this,option,{value:defaults[option]});
    }
    this.init();
}

Earth.prototype.post = function(url,data,success,before){
	$.ajax({
	 	url: url,
	 	type: 'POST',
	 	dataType: 'json',
	 	data: data,
	 	beforeSend:function () {
	 		typeof(before)=='function' && before();
	 	},
	 	success:function (res) {
	 		success(res);
	 	}
	 }); 
};

Earth.prototype.get = function(url,data,success,before){
	$.ajax({
	 	url: url,
	 	type: 'GET',
	 	dataType: 'json',
	 	data: data,
	 	beforeSend:function () {
	 		typeof(before)=='function' && before();
	 	},
	 	success:function (res) {
	 		success(res);
	 	}
	 }); 
};

Earth.prototype.init = function(){
	var that=this;
 	wx.config({
 		debug:false,
		appId:window.jwx.appId,
		timestamp:window.jwx.timestamp,
		nonceStr:window.jwx.nonceStr,
		signature:window.jwx.signature,
		jsApiList:['chooseImage','previewImage','uploadImage','onMenuShareTimeline','onMenuShareAppMessage','onMenuShareQQ','onMenuShareWeibo','onMenuShareQZone','hideMenuItems','showMenuItems','hideOptionMenu','showOptionMenu'],

	});
	wx.error(function(res){
		that.notice("error");
	});
};

Earth.prototype.choose = function(){
	var that=this;
	wx.ready(function () {
		wx.chooseImage({
			count:1,
			sizeType:['compressed'],
			sourceType:['album','camera'],
			success:function (res) {
				if(res.localIds.length>=1){
					$('.loading_box').show();
					that.upload(res.localIds[0],function (serverId) {
						 that.get("/activity/earth/upload_wx_media",{media_id:serverId},function (res) {
						 	$('.loading_box').hide();
						 	if (res.status==200) {
						 		$("#real_target").attr('src',res.data.path).css('display','block');
						 		// var image=document.getElementById("real_target");
						 		// $("#real_target").css('width',).css('height',image.height);
						 		// that.crop3();
						 	}else{
						 		that.notice(res.message);
						 	}
						 }); 
					})
				}
			},
			fail:function (res) {
				that.notice('选取照片失败');
				console.log(res); 
			}
		});
	})
};

Earth.prototype.upload = function(local_id,success){
	 wx.ready(function () {
	 	wx.uploadImage({
			localId:local_id,
			isShowProgressTips:0,
			success:function(res){
				if(res.serverId){
					success(res.serverId);
					// success("LroHcrgQLzhUbGXU5LtLBHQorKBpNFtSQPv6wNJiNHqslhFW4ldZCX4X1XNqDSPu");			
				}
			}
		});
	 }) 
};

Earth.prototype.save = function(imgdata){
	var that=this;
	that.post("/activity/earth/upload",{imgdata: imgdata},function (res) {
		if(res.status==200){
			$('.loading_box').hide();
			console.log(res);
			document.location.href="/activity/earth/share?pid="+res.data.photo_id;
 			// that.sharePhoto=res.data.path;
 			// that.shareTitle='您已成为第'+res.data.earth_id+'个“地球卫士"';
 			// that.shareLink="";
 			// that.share();
 		}else{
			that.notice(res.message);		
 		}
	})
};

Earth.prototype.crop = function(container){
    container_width=container.width();
	container_height=container.width();
    container_width = 384;//真正制作背景图片的宽
   container_height= 384;//真正制作背景图片的高
  //  console.log(container_width);
 	var canvas,
    left = $('.overlay').offset().left - container.offset().left,
    top =  $('.overlay').offset().top - container.offset().top,
    width = $('.overlay').width(),
    height = $('.overlay').height();
    bgImage=document.getElementById("bg_photo");
    targetImage=document.getElementById("real_target");
    canvas = document.createElement('canvas');
    ctx=canvas.getContext('2d');
    ctx.globalCompositeOperation="source-in";
    canvas.width = container_width;
    canvas.height = container_height;
    height_ratio=container_height/bgImage.height;
    width_ratio=container_width/bgImage.width;
    real_left=$('.overlay').offset().left-$(".real-resize-container").offset().left;
    real_top=$('.overlay').offset().top-$(".real-resize-container").offset().top;
   // console.log(real_left);
   // console.log(real_top);
    console.log(width);
    console.log(height);
    //console.log(left);
   // console.log(top);
     //return false;
   // ctx.drawImage(bgImage, 0, 0, 384, 384);
   // ctx.drawImage(targetImage, real_left, real_top, width, height, left, top, width, height);
    //相对于背景左侧的距离固定72
    //相对于背景上面的距离固定99
    //截取图像的尺寸固定240*214

    //截取页面背景空洞尺寸与真正的背景尺寸空洞比例，应与展示图片截取与真正截取图片比例相等
    ctx.drawImage(targetImage, real_left, real_top, width, height, 72, 99, 240, 214);

    // ctx.drawImage(targetImage,0,0,container_width,container_height,0,0,container_width,container_height)
    // ctx.drawImage(targetImage, real_left, real_top, width, height, left-real_left, top-real_top, width, height);
    ctx.drawImage(bgImage, 0, 0, container_width, container_height);
	var imgdata = canvas.toDataURL("image/png");
	return imgdata;
}

Earth.prototype.crop2 = function(){
	 var bg_container=$(".resize-container");
	 var photo_container=$(".real-resize-container");
	 var canvas=document.createElement('canvas');
	 canvas.width=bg_container.width();
	 canvas.height=bg_container.height();
	 var ctx=canvas.getContext('2d');
	 // canvas.width=384;
	 // canvas.height=384;
	 var container_width=bg_container.width();
	 var container_height=bg_container.height();
	 var bg_image=document.getElementById("bg_photo");
	 var photo_image=document.getElementById("real_target");
	 overlay_left = $('.overlay').offset().left - bg_container.offset().left;
     overlay_top =  $('.overlay').offset().top - bg_container.offset().top;
     console.log(overlay_left);
     console.log(overlay_top);
     width = $('.overlay').width(),
     height = $('.overlay').height();
     photo_left=$('.overlay').offset().left - photo_container.offset().left;
     photo_top=$('.overlay').offset().top - photo_container.offset().top;
     ctx.drawImage(photo_image, photo_left, photo_top, width, height, overlay_left, overlay_top, width, height);
     ctx.drawImage(bg_image,0,0,container_width, container_height);
     var imgdata = canvas.toDataURL("image/png");
     // return false;
	 return imgdata;
};

Earth.prototype.crop3 = function(){
	 var photo_container=$(".real-resize-container");
	 var photo_image=document.getElementById("real_target");
	 width = $('.overlay').width(),
     height = $('.overlay').height();
     photo_left=$('.overlay').offset().left - photo_container.offset().left;
     photo_top=$('.overlay').offset().top - photo_container.offset().top;
	 var canvas=document.getElementById("overimg");
	 canvas.width=width;
	 canvas.height=height;
	 var ctx=canvas.getContext('2d');
	 ctx.drawImage(photo_image, photo_left, photo_top, width, height, 0, 0, width, height);
	 // var imgdata = canvas.toDataURL("image/png");
	 // var image=document.createElement('img');
	 // image.src=imgdata;
	 // $('.overlay img').attr('src',imgdata);
};

/**
 * 绑定微信分享事件
 * @param  string title   
 * @param  string url     
 * @param  string photo   
 * @param  string content 
 * @return 
 */
Earth.prototype.share = function(title,photo,desc,link,success,cancel){
	var that=this;
	wx.ready(function () {
		var success=function () {
			 that.post("/activity/earth/earth_share",{},function (res) {
			 	  
			 });
		};
		var option={
		 	title:title,
			link:link,
			desc:desc,
			imgUrl:photo,
			success:success,
			cancel:cancel
		}
		// 分享到朋友圈
		wx.onMenuShareTimeline(option);
		// 分享给朋友
		wx.onMenuShareAppMessage(option);
		// 分享到QQ
		// wx.onMenuShareQQ(option);
		// 分享到腾讯微博
		// wx.onMenuShareWeibo(option);
		// 分享到QQ空间
		// wx.onMenuShareQZone(option);

	})
};

Earth.prototype.preview = function(url){
	var that=this;
	// 查看图片大图
	wx.ready(function () {
		wx.previewImage({
			current:url,
			urls:[url],
			success:function (res) {
				 that.post("/activity/earth/earth_save",{},function (res) {
			 	  
				 });
			}
		});
	});
};

Earth.prototype.notice = function(message,time){
	var tipsWrap = $("<div class='alert_tips'><p class='time_01 fadeDown'>" + message + "</p></div>");
    var timenum = time || 2500,
        tips = $(".alert_tips"),
        tips_len = tips.size(),
        num = 0;
    if (tips_len > 0) {
        tips.find("p").html(message);
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
};

