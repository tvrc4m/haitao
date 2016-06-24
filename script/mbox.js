function mbox(id){
	GenerateHtml(id);
	btnNo();
}
var GenerateHtml = function (id) {
	var _html = '<div id="mb_box"><div id="mb_con"><img id="code" src="" /></div></div>';
	$("body").append(_html);
	if(id=="shopcode"){
		$("#mb_con img").attr("src","api/share_qrcode.php?type=product&pid=580&rand=8747")
	}
	if(id=="follow"){
		$("#mb_con img").attr("src","image/code.png")
	}
	GenerateCss();
}
var GenerateCss = function () {
	$("#mb_box").css({
		width: '100%',
		height: '100%',
		zIndex: '1',
		position: 'fixed',
		filter: 'Alpha(opacity=60)',
		backgroundColor: 'black',
		top: '0',
		left: '0',
		opacity: '0.6'
	});
	var _widht = document.documentElement.clientWidth; //屏幕宽
	var _height = document.documentElement.clientHeight; //屏幕高
	var boxWidth = $("#mb_con").width();
	var boxHeight = $("#mb_con").height();
	//让提示框居中
	$("#mb_con").css({
		top: (_height - boxHeight) / 2 + "px",
		left: (_widht - boxWidth) / 2 + "px"
	});
}
var btnNo =function(){
	$("body").click(function (e) {
		var e = e || window.event;
		var curEl = e.srcElement || e.target;
		if(curEl.id == "code" || curEl.id == "shopcode"){
			return;
		}else{
			$("#mb_box,#mb_con").remove();
		}
	});
}