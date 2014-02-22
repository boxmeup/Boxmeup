var boxmeup = {
	dismissMessage: function() {
		$.ajax({
			url: '/users/dismiss_message',
			complete: function() {
				$('.message').slideUp();
			}
		});
	},
	isiPad: function() {
		return navigator.userAgent.match(/iPad/i) != null
	},
	clearForm: function(formId) {
		$(':input','#' + formId)
			.not(':button, :submit, :reset, :hidden')
			.val('')
			.removeAttr('checked')
			.removeAttr('selected');
	},
	displayGotoTop: function(e) {
		if ($(window).scrollTop() > 0) {
			$('.to-top').removeClass('hidden');
		} else {
			$('.to-top').addClass('hidden');
		}
	}
};

$(function() {
	$('body').on('click', '.dismiss', function() {
		boxmeup.dismissMessage();
		return false;
	});

	$(window).on('scroll', boxmeup.displayGotoTop);

	// Search autocomplete
	if (BMU_CLIENT.features.autocomplete) {
		$searchInput = $('#SearchQuery');
		$searchInput.autocomplete({
			source: '/searches/auto_find.json',
			minLength: 2,
			focus: function (event, ui) {
				$searchInput.val(ui.item.label);
				return false;
			},
			select: function (event, ui) {
				$searchInput.val(ui.item.label);
				$('#SearchFindForm').submit();
			}
		});
	}
});
