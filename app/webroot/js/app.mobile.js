$(document).ready(function(){
	$.mobile.ajaxFormsEnabled = false;
	// If we are contained within the android app, attach the QR scanning
	if(BoxmeupAndroid) {
		$('.qr-scan-button')
			.show()
			.bind('click', function() {
				BoxmeupAndroid.qrScan();
			});
	}
});
