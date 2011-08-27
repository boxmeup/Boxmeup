$(document).ready(function() {
	$('#container-selectall').click(function() {
		if($(this).is(':checked')) {
			$('.container-checkbox').attr('checked', 'checked');
		} else {
			$('.container-checkbox').removeAttr('checked');
		}
	});
});