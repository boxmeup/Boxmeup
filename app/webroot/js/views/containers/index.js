$(function() {
	$('#container-filter').on('submit', function(e) {
		e.preventDefault();
		var $order = $('#ContainerOrder'),
			$direction = $('#ContainerDirection'),
			$location = $('#LocationUuid');
		window.location.href = WEBROOT + 
			'containers/index/page:' + _PAGE + 
			'/sort:' + $order.find('option:selected').val() + 
			'/direction:' + $direction.find('option:selected').val() +
			'/location:' + $location.find('option:selected').val();
	});
});
