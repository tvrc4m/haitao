var obj;
$('*[data_type="handle_image"]').unbind().each(function(){
	$(this).unbind();
	if($(this).find('img:first').prev().val() != ''){
		$(this).hover(function(){
			obj = $(this).find('*[data_type="handle"]');
			obj.show();
			obj.hover(function(){
				update_index($(this), "999");
			},
			function(){
				update_index($(this), "0");
			});
			update_index($(this), '999');
		},
		function(){
			obj.hide();
			update_index($(this), '0');
		});
	}
});
$('span[data_type="delete_image"]').unbind().click(function(){
	$(this).parents('li')
		.find('img:first').attr('src','image/default/user_admin/loading.gif')
		.end().find('*[data_type="handle"]').hide()
		.end().find('input[type="hidden"]').val('')
		.end().find('img:first').attr('src','image/default/nopicsmall.gif');
		$.getScript("script/product.js");
});
function update_index(obj, index){
    $.each(obj,function(i,n){
        if($(n).css('position') == 'relative'){
           $(n).css('z-index',index);
        }
    });
}