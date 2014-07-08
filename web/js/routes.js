define([
	'angular',
	'app',

	'text!../partials/dashboard.html',
	'text!../partials/user/account.html'
], function(
	angular,
	app,

	dashboardTemplate,
	accountTemplate
) {
	return app.config(['$routeProvider', function($routeProvider) {
		$routeProvider.when('/dashboard', {
			controller: 'Dashboard',
			template: dashboardTemplate
		});
		$routeProvider.when('/account', {
			controller: 'Account',
			template: accountTemplate
		});
		$routeProvider.otherwise({redirectTo: '/dashboard'});
	}]);

});
