$(document).bind('mobileinit', function() {
	$.extend($.mobile, {
		ajaxEnabled: false
	});
});
if(mobileApp.isAndroid()) {
	BoxmeupAndroid.clearHistory();
}