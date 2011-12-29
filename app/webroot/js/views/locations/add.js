$(document).ready(function() {
	var location_url = 'http://maps.googleapis.com/maps/api/staticmap?size=350x350&maptype=roadmap&sensor=false&markers=size:small|color:red|',
		submit_shown = false;
	$('.map-save').hide();
	$('.preview-button').bind('click', function() {
		var address = escape($('#LocationAddress').attr('value'));
		$('.preview-map').attr('src', location_url + address);
		if(!submit_shown) {
			$('.map-save').fadeIn();
			submit_shown = true;
		}
		return false;
	});
	$('.attach-map').bind('click', function() {
		$('.no-map-save, .attach-map').hide();
		$('.location-details').fadeIn();
		return false;
	});
	if($('#LocationAddress').attr('value').length > 0) {
		$('.preview-button').trigger('click');
		$('.no-map-save, .attach-map').hide();
		$('.location-details').show();
	}
});