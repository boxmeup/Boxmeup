$(document).ready(function() {
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