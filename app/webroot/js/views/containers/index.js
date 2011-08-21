$(document).ready(function() {
	boxmeup.optionHoverSetup();
	boxmeup.optionHide();
	
	$('.change-view').bind('click', function() {
		$this = $(this);
		$.fancybox.showActivity();
		$('.app-section').load('/containers/change_view/' + (container_view == 'list' ? 'grid' : 'list'), function() {
			$.fancybox.hideActivity();
			boxmeup.optionHide();
			$this.attr('original-title', 'Change to ' + (container_view == 'list' ? 'grid' : 'list') + ' view');
		});
		return false;
	});
});