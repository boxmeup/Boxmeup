$(document).ready(function() {
	$('#container-selectall').click(function() {
		$('.container-checkbox').attr('checked', $(this).is(':checked') ? 'checked' : '');
	});
});