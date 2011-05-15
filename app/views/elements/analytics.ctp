<?php if(Configure::read('debug') === 0) { ?>
<script type="text/javascript">
	var _gaq = _gaq || [];
	_gaq.push(['_setAccount', '<?php echo Configure::read('Analytics.tracking_code'); ?>']);
	_gaq.push(['_trackPageview']);

	$(document).ready(function() {
		$.getScript(('https:' == document.location.protocol ?
			'https://ssl' : 'http://www') +
			'.google-analytics.com/ga.js'
		);
	});
</script>
<?php } ?>