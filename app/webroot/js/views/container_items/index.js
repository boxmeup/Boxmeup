$(function() {
	$('#sort-button').on('click', function(e) {
		e.preventDefault();
		var $order = $('#ContainerOrder'),
			$direction = $('#ContainerDirection');
		window.location.href = WEBROOT + 'container_items/index/page:' + _PAGE + '/sort:' + $order.find('option:selected').val() + '/direction:' + $direction.find('option:selected').val();
	});
});
