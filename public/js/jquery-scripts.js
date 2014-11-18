jQuery(document).ready(function($) {
	// Animate in-page anchor links
	$("a[href^=#]:not(.inline)").click(function(){
		var $this = $(this),
		target = $this.attr("href"),
		scrollTo;
		if (target.length > 1) {
			if ($(target).length > 0) { // Detect ID = [target]
				scrollTo = $(target).offset().top;
			} else if ($("a[name='" + target.slice(1) + "']").length > 0) { // Detect name = [target]
				scrollTo = $("a[name='" + target.slice(1) + "']").offset().top;
			}
		} else {return;}
		$('body,html').animate({scrollTop: scrollTo}, 500);
		return false;
	});
	
	$(window).scroll(function() {
      if($(".contentAreaPanel").length != 0){    	  
     	if($(document).scrollTop() > $(".contentAreaPanel").offset().top+1){
			$(".leftCol").css("position","fixed");
			$(".leftCol").css("top","0");
		}else{
			$(".leftCol").css("position","absolute");
			$(".leftCol").css("top","");
		}
   	  } 	
	});
});