$(function() {
	var location_url = 'http://maps.googleapis.com/maps/api/staticmap?size=350x350&maptype=roadmap&sensor=false&markers=size:small|color:red|',
		submit_shown = false;
	$('.preview-button').on('click', function(e) {
		e.preventDefault();
		var address = escape($('#LocationAddress').val());
		$('.preview-map').attr('src', location_url + address);
		if(!submit_shown) {
			$('.map-save').fadeIn();
			submit_shown = true;
		}
	});
	$('.attach-map').on('click', function(e) {
		e.preventDefault();
		$('.no-map-save, .attach-map').hide();
		$('.location-details').fadeIn();
	});
	$('.map-save').hide();
	if($('#LocationAddress').val().length > 0) {
		$('.preview-button').trigger('click');
		$('.no-map-save, .attach-map').hide();
		$('.location-details').show();
	}
});
