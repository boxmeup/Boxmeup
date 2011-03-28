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
				$.fancybox({content: 'Error processing request.'});
			}
		});
		return false;
	});

	$('body').delegate('.ui-notification', 'click', function() {
		$(this).slideUp();
	});

	// Search
	var search_default = 'Find an item...';
	var $searchInput = $('#SearchQuery');
	if($searchInput.attr('value').length == 0)
		$searchInput.attr('value', search_default);
	$('body').delegate('#SearchQuery', 'click', function() {
		if($(this).attr('value') === search_default)
			$(this).attr('value', '');
	});
	$('body').delegate('#SearchQuery', 'blur', function() {
		if($(this).attr('value').length == 0)
			$(this).attr('value', search_default);
	});
});