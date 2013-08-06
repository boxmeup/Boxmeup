$(function() {

	// Language
	$('body').delegate('#change-language', 'change', function() {
		url = $(this).attr('action');
		window.location.href = url + '/' + $('#change-language-locale option:selected').val();
	});
});
