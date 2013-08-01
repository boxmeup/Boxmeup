$(function() {	
	$('#sort-button').bind('click', function() {
		var $order = $('#order'),
			$direction = $('#direction');
		window.location.href = WEBROOT + 'container_items/index/page:' + _PAGE + '/sort:' + $order.find('option:selected').val() + '/direction:' + $direction.find('option:selected').val();
	});
});
