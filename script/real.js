$(function(){
	$("form").find(".texts").each(function(){
		$(this).bind('input propertychange', function(){
            var val=$(this).val();
            if(val !=""){
                $(this).parent().find(".inp_close").addClass("inp_up");
            }
            else{
                 $(this).parent().find(".inp_close").removeClass("inp_up");
            }           
        }); 
        $(this).bind("focus",function(){
            var val=$(this).val();
            if(val !=""){
                $(this).parent().find(".inp_close").addClass("inp_up");
            }else{
                $(this).parent().find(".inp_close").removeClass("inp_up");
            }
        });
        $(this).bind("blur",function(){
            $(this).parent().find(".inp_close").removeClass("inp_up");
        });  
	});
	$(".inp_close").bind('click', function(){	
		$(this).removeClass("inp_up");
		$(this).prev().val("");
	});	 
});
