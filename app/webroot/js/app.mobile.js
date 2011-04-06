$(document).ready(function(){
	$.mobile.ajaxFormsEnabled = false;
	$('body').delegate('.no-ajax', 'click', function() {
		$.mobile.ajaxLinksEnabled = false;
	});
});
