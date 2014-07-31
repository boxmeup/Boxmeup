define(['angular'], function(angular) {

	return ['$document', function($document) {
		return {
			link: function(scope, el) {
				var target = el.find('.navbar-collapse');
				el.find('.navbar-collapse a').on('click', function() {
					target.collapse('hide');
				});
			}
		};
	}];

});
