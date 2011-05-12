$(document).ready(function(){
	$.mobile.ajaxFormsEnabled = false;
	$('.no-ajax').unbind();
	$('body').delegate('.no-ajax', 'click', function() {
		$.mobile.ajaxLinksEnabled = false;
	});
});
