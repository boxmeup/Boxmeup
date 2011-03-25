$(document).ready(function() {
	$('.container-item-list-options').hide();
	$('body').delegate('.container-item-list', 'mouseover', function() {
		$(this).find('.container-item-list-options').show();
	});
	$('body').delegate('.container-item-list', 'mouseout', function() {
		$(this).find('.container-item-list-options').hide();
	});
});