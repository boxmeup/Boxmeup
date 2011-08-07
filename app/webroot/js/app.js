var boxmeup = {
	displayError: function(msg, type) {
		var $notification = $('.' + type),
			$error_msg = $('.ui-error-message');
		$notification.hide();
		$error_msg.html(msg);
		$notification.fadeIn();
	},
	hideError: function(type) {
		$('.' + type).slideUp();
	},
	dismissMessage: function() {
		$.ajax({
			url: '/users/dismiss_message',
			complete: function() {
				$('.message').slideUp();
			}
		});
	},
	clearForm: function(formId) {
		$(':input','#' + formId)
			.not(':button, :submit, :reset, :hidden')
			.val('')
			.removeAttr('checked')
			.removeAttr('selected');
	}
}
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
				$.fancybox({
					content: data,
					overlayShow: true
				});
			},
			error: function(data) {
				$.fancybox({content: 'Error processing request.'});
			},
			complete: function() {
				$('.focus:last').focus();
			}
		});
		return false;
	});

	$('body').delegate('.ui-notification', 'click', function() {
		boxmeup.hideError('ui-notification');
	});
	
	$('body').delegate('.dismiss', 'click', function() {
		boxmeup.dismissMessage();
		return false;
	});
	
	$('.tip-s').tipsy({
		gravity: 's',
		live: true
	});
	$('.tip-n').tipsy({
		gravity: 'n',
		live: true
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

	$('.focus:first').each(function() {
		$(this).removeClass('focus').focus();
	});
});
