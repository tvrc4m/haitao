$(function(){
	$("form").find(".texts").each(function(){
		$(this).bind('input propertychange', function(){
		    var val=$(this).val();
			console.log(val)
			if(val !=""){
				$(this).parent().find(".inp_close").addClass("inp_up");
				$(this).bind("focus",function(e){
					e.stopPropagation();
					$(".inp_close").addClass("inp_up");
				});	
				$(this).bind("blur",function(e){
					e.stopPropagation();
					$(".inp_close").removeClass("inp_up");
				});	
			}
			else{
				$(".inp_close").removeClass("inp_up");
			}
			
		}); 
	});
	$(".inp_close").bind('click', function(e){	
		e.stopPropagation();
		$(this).removeClass("inp_up");
		$(this).prev().val("");
	});	 
});
