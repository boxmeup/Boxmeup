var _gaq = _gaq || [];
_gaq.push(['_setAccount', 'UA-6305561-7']);
_gaq.push(['_trackPageview']);

$(document).ready(function() {
	// Append analytics
	$.getScript(('https:' == document.location.protocol ?
		'https://ssl' : 'http://www') +
		'.google-analytics.com/ga.js');
});