$(document).ready(function() {
	$('body').delegate('a.ui-modal, a.feedback-plugin', 'click', function() {
		$.ajax({
			type: 'GET',
			dataType: 'html',
			cache: false,
			url: $(this).attr('href'),
			beforeSend: function(data) {
				$.fancybox.showActivity();
			},
			success: function(data) {
				$.fancybox(data);
			},
			error: function(data) {
				$.fancybox({content: 'Error processing request.'})
			}
		});
		return false;
	});

	// Language
	$('body').delegate('#change-language', 'change', function() {
		url = $(this).attr('action');
		window.location.href = url + '/' + $('#change-language-locale option:selected').val();
	});
});
