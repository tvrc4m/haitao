/*www.sucaijiayuan.com*/
var resizeableImage = function(target,real_target) {
  // Some variable and settings
  var $container,$real_container;
      orig_src = new Image(),
      image_target = target,
      event_state = {},
      constrain = false,
      min_width = 60, // Change as required
      min_height = 60,
      max_width = 800, // Change as required
      max_height = 900,
      resize_canvas = document.createElement('canvas');

  init = function(){

    // When resizing, we will always use this copy of the original as the base
    orig_src.src=real_target.src;

    // Assign the container to a variable
    $container =  $(target).parent('.resize-container');
    $real_container=$(real_target).parent(".real-resize-container");
    // Add events
    $container.on('mousedown touchstart', 'img', startMoving);
    // $('.js-crop').on('click', crop);
  };

  saveEventState = function(e){
    // Save the initial event details and container state
    event_state.container_width = $real_container.width();
    event_state.container_height = $real_container.height();
    event_state.container_left = $real_container.offset().left; 
    event_state.container_top = $real_container.offset().top;
    event_state.mouse_x = (e.clientX || e.pageX || e.originalEvent.touches[0].clientX) + $(window).scrollLeft(); 
    event_state.mouse_y = (e.clientY || e.pageY || e.originalEvent.touches[0].clientY) + $(window).scrollTop();
	
	// This is a fix for mobile safari
	// For some reason it does not allow a direct copy of the touches property
	if(typeof e.originalEvent.touches !== 'undefined'){
		event_state.touches = [];
		$.each(e.originalEvent.touches, function(i, ob){
		  event_state.touches[i] = {};
		  event_state.touches[i].clientX = 0+ob.clientX;
		  event_state.touches[i].clientY = 0+ob.clientY;
		});
	}
    event_state.evnt = e;
  };

  resizeImage = function(width, height){
    // resize_canvas.width = width;
    // resize_canvas.height = height;
    // resize_canvas.getContext('2d').drawImage(orig_src, 0, 0, width, height);   
    // $(image_target).attr('src', resize_canvas.toDataURL("image/jpg"));  
  };

  startMoving = function(e){
    e.preventDefault();
    e.stopPropagation();
    saveEventState(e);
    $(document).on('mousemove touchmove', moving);
    $(document).on('mouseup touchend', endMoving);
  };

  endMoving = function(e){
    e.preventDefault();
    $(document).off('mouseup touchend', endMoving);
    $(document).off('mousemove touchmove', moving);
  };

  moving = function(e){
    var  mouse={}, touches;
    e.preventDefault();
    e.stopPropagation();
    
    touches = e.originalEvent.touches;
    
    mouse.x = (e.clientX || e.pageX || touches[0].clientX) + $(window).scrollLeft(); 
    mouse.y = (e.clientY || e.pageY || touches[0].clientY) + $(window).scrollTop();
    $real_container.offset({
      'left': mouse.x - ( event_state.mouse_x - event_state.container_left ),
      'top': mouse.y - ( event_state.mouse_y - event_state.container_top ) 
    });
    // earth.crop3();
    // Watch for pinch zoom gesture while moving
    if(event_state.touches && event_state.touches.length > 1 && touches.length > 1){
      var width = event_state.container_width, height = event_state.container_height;
      var a = event_state.touches[0].clientX - event_state.touches[1].clientX;
      a = a * a; 
      var b = event_state.touches[0].clientY - event_state.touches[1].clientY;
      b = b * b; 
      var dist1 = Math.sqrt( a + b );
      
      a = e.originalEvent.touches[0].clientX - touches[1].clientX;
      a = a * a; 
      b = e.originalEvent.touches[0].clientY - touches[1].clientY;
      b = b * b; 
      var dist2 = Math.sqrt( a + b );

      var ratio = dist2 /dist1;

      // width = width * ratio;
      // height = height * ratio;
      // To improve performance you might limit how often resizeImage() is called
      resizeImage(width, height);
    }
  };
  init();
};

// Kick everything off with the target image
resizeableImage(document.getElementById("target"),document.getElementById("real_target"));