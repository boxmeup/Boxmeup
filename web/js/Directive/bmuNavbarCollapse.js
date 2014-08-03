define(['angular'], function(angular) {

	return ['$window', function($window) {
		return {
			link: function(scope, el) {
				var breakPoint = 991, $$window = angular.element($window);
				scope.navCollapse = true;
				scope.collapse = function() {
					if ($$window.width() > breakPoint) {
						return;
					}
					scope.navCollapse = !scope.navCollapse;
				};
			}
		};
	}];

});
