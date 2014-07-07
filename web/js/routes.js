define([
	'angular',
	'app',

	'text!../partials/dashboard.html'
], function(
	angular,
	app,

	dashboardTemplate
) {
	return app.config(['$routeProvider', function($routeProvider) {
		$routeProvider.when('/dashboard', {
			template: dashboardTemplate
		});
		$routeProvider.otherwise({redirectTo: '/dashboard'});
	}]);

});
