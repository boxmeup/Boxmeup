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
			controller: 'Dashboard',
			template: dashboardTemplate
		});
		$routeProvider.otherwise({redirectTo: '/dashboard'});
	}]);

});
