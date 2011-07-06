$(document).ready(function() {
	$('.container-item-list-options').hide();
	$('body').delegate('.container-item-list', 'mouseover', function() {
		$(this).find('.container-item-list-options').show();
	});
	$('body').delegate('.container-item-list', 'mouseout', function() {
		$(this).find('.container-item-list-options').hide();
	});
	
	$('#ContainerItemViewForm').bind('submit', function(event) {
		var $this = $(this),
			container_uuid = $('#ContainerUuid').attr('value'),
			$quantity = $('#ContainerItemQuantity');
		$.ajax({
			type: 'POST',
			url: '/api/container_items/add/' + container_uuid + '.json',
			data: $this.serialize(),
			beforeSend: function() {
				boxmeup.hideError('ajax-error');
				$.fancybox.showActivity();
			},
			success: function(rdata) {
				$('.no-items').fadeOut();
				if(rdata.success) {
					boxmeup.clearForm('ContainerItemViewForm');
					$quantity.attr('value', '1');
					$.get('/containers/ajax_add/' + rdata.message.id, function(data) {
						$('#item-container').prepend(data);
						$('.new-item').removeClass('new-item').slideDown();
					 });
				} else {
					var errors = rdata.message,
						message = '';
					$.each(errors, function(key, value) {
						message += key + ': ' + value + '<br/>'
					});
					boxmeup.displayError('<br/>' + message, 'ajax-error');
				}
			},
			complete: function() {
				$('#ContainerItemBody').focus();
				$.fancybox.hideActivity();
			}
		});
		return false;
	});
});