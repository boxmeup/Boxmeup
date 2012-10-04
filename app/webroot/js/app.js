var boxmeup = {
	displayError: function(msg, type) {
		var $notification = $('.' + type),
			$error_msg = $('.alert-message .error-msg');
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
	},
	isiPad: function() {
		return navigator.userAgent.match(/iPad/i) != null
	},
	optionHide: function() {
		if(!boxmeup.isiPad())
			$('.container-item-list-options').hide();
	},
	optionHoverSetup: function() {
		if(!boxmeup.isiPad()) {
			$('body').delegate('.container-item-list', 'mouseover', function() {
				$(this).find('.container-item-list-options').show();
			});
			$('body').delegate('.container-item-list', 'mouseout', function() {
				$(this).find('.container-item-list-options').hide();
			});
		}
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

    $('body').delegate('.alert-message .close', 'click', function() {
        $(this).parent().slideUp();
        return false;
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

	// Search autocomplete
	if (BMU_CLIENT.features.autocomplete) {
		$searchInput.autocomplete({
			source: '/searches/auto_find.json',
			minLength: 2,
			focus: function (event, ui) {
				$searchInput.val(ui.item.label);
				return false;
			},
			select: function (event, ui) {
				$searchInput.val(ui.item.label);
				$('#SearchDashboardForm').submit();
				return false;
			}
		});
	}

	$('.focus:first').each(function() {
		$(this).removeClass('focus').focus();
	});

	// Language
	$('body').delegate('#change-language', 'change', function() {
		url = $(this).attr('action');
		window.location.href = url + '/' + $('#change-language-locale option:selected').val();
	});
});
