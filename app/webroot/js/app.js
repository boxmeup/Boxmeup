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
	}
}
$(function() {
	$('body').on('click', '.dismiss', function() {
		boxmeup.dismissMessage();
		return false;
	});
	$('body').on('hidden.bs.modal', function (e) {
		$(e.target).removeData('bs.modal')
	});

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
