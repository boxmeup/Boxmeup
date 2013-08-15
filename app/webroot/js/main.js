$(function() {

	var modalTemplate;
	$.get('/js/templates/modal.html', function (data) {
		modalTemplate = _.template(data);
	});

	// Language
	$('body').on('change', '#change-language', function() {
		url = $(this).attr('action');
		window.location.href = url + '/' + $('#change-language-locale option:selected').val();
	});

	// Unregister BS3's default handler to intercept and handle remote handling to suit boxmeup
	$(document).off('click.bs.modal.data-api', '[data-toggle="modal"]');
	$(document).on('click.bs.modal.data-api', '[data-toggle="modal"]', function (e) {
		var $this   = $(this)
		var href    = $this.attr('href')
		var $target = $($this.attr('data-target') || (href && href.replace(/.*(?=#[^\s]+$)/, ''))) //strip for ie7
		var option  = $target.data('modal') ? 'toggle' : $.extend($target.data(), $this.data());

		// Load the content to be used in the modal
		if (!/#/.test(href) && href) {
			$.ajax({
				url: href,
				success: function(data) {
					$target.html(
						modalTemplate({
							content: data
						})
					);
				},
				error: function() {
					$target.html(
						modalTemplate({
							content: 'Unable to load content.'
						})
					);
				}
			});
		}

		e.preventDefault();

		$target
			.modal(option, this)
			.one('hide', function () {
				$this.is(':visible') && $this.focus()
			});
	})

	// Modal cache clear
	$('body').on('hidden.bs.modal', function (e) {
		$(e.target)
			.removeData('bs.modal')
			.find('.modal-body')
				.html('Content loading...');
	});

});
