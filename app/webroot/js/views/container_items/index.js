$(document).ready(function() {
	$('.container-item-list-options').hide();
	$('body').delegate('.container-item-list', 'mouseover', function() {
		$(this).find('.container-item-list-options').show();
	});
	$('body').delegate('.container-item-list', 'mouseout', function() {
		$(this).find('.container-item-list-options').hide();
	});
	
	$('#sort-button').bind('click', function() {
		var $order = $('#order'),
			$direction = $('#direction');
		window.location.href = WEBROOT + 'container_items/index/page:' + _PAGE + '/sort:' + $order.find('option:selected').val() + '/direction:' + $direction.find('option:selected').val();
	});
});