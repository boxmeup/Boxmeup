$(function() {
	$('#ContainerItemViewForm').on('submit', function(e) {
		e.preventDefault();
		var $this = $(this),
			container_uuid = $('#ContainerUuid').attr('value'),
			$quantity = $('#ContainerItemQuantity');
		var data = $this.serialize();
		data.push
		$.ajax({
			type: 'POST',
			url: '/container_items/add/' + container_uuid + '.json',
			data: $this.serialize(),
			success: function(rdata) {
				if ($('.no-items').length > 0) {
					window.location.reload();
				}
				if(rdata.success) {
					boxmeup.clearForm('ContainerItemViewForm');
					$quantity.val('1');
					$.get('/containers/ajax_add/' + rdata.message.id, function(data) {
						$('.item-container').prepend(data);
						$('.new-item').removeClass('new-item').show();
					 });
				} else {
					var errors = rdata.message,
						message = '';
					$.each(errors, function(key, value) {
						message += key + ': ' + value + '<br/>'
					});
					$('#ajax-error')
						.html(message)
						.show();
				}
			},
			complete: function() {
				$('#ContainerItemBody').focus();
			}
		});
	});
});
