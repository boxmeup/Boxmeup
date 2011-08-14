$(document).ready(function() {
	var isiPad = navigator.userAgent.match(/iPad/i) != null;
	if(!isiPad) {
		$('.container-item-list-options').hide();
		$('body').delegate('.container-item-list', 'mouseover', function() {
			$(this).find('.container-item-list-options').show();
		});
		$('body').delegate('.container-item-list', 'mouseout', function() {
			$(this).find('.container-item-list-options').hide();
		});
	}
	
	$('.change-view').bind('click', function() {
		$this = $(this);
		$.fancybox.showActivity();
		$('.app-section').load('/containers/change_view/' + (container_view == 'list' ? 'grid' : 'list'), function() {
			$.fancybox.hideActivity();
			$this.attr('original-title', 'Change to ' + (container_view == 'list' ? 'grid' : 'list') + ' view');
		});
		return false;
	});
});