var mobileApp = {
	initAndroid: function() {
		if(mobileApp.isAndroid()) {
			$('.qr-scan-button')
				.show()
				.bind('click', function() {
					BoxmeupAndroid.qrScan();
				});
		}
	},
	isAndroid: function() {
		return typeof BoxmeupAndroid != 'undefined';
	}
}
$(document).bind('mobileinit', function() {
	$.extend($.mobile, {
		touchOverflowEnabled: true,
		addBackBtn: true,
		defaultPageTransition: 'slide'
	});
});
// Extend pageload event to load any android specific methods
$(document).on('pageload', function() {
	mobileApp.initAndroid();
});

$(document).ready(function(){
	// If we are contained within the android app, attach the QR scanning
	mobileApp.initAndroid();
});
