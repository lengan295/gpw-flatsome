(function($){
	$("#sticky-social-box-style-2 .toggle-button").click(function(){
	  if($(this).hasClass("show")){
		$("#sticky-social-box-style-2").css({"width": "0px"});
		$("#sticky-social-box-style-2 .social-item").css({"width": "0px", "visibility": "hidden"});
		$("#sticky-social-box-style-2 .social-item a").css({"width": "0px", "visibility": "hidden"});
		$(this).toggleClass("show");  
		$(this).toggleClass("hide");
	  } else {
		$("#sticky-social-box-style-2").css({"width": "auto"});
		$("#sticky-social-box-style-2 .social-item").css({"width": "30px", "visibility": "visible"});
		$("#sticky-social-box-style-2 .social-item a").css({"width": "30px", "visibility": "visible"});
		$(this).toggleClass("show");  
		$(this).toggleClass("hide");
	  }
	});
})(jQuery);