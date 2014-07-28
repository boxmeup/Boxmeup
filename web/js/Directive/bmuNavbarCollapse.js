define(['angular'], function(angular) {

	return function() {
		return {
			link: function(scope, el) {
				var toggle = el.find('.navbar-toggle');
				el.find('.navbar-collapse a').on('click', function() {
					if (toggle.length && toggle.css('display') !== 'none') {
						toggle.trigger('click');
					}
				});
			}
		};
	};

});
