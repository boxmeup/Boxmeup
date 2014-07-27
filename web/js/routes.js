define([
	'angular',
	'app',

	'text!../partials/dashboard.html',
	'text!../partials/user/account.html',
	'text!../partials/container/list.html'
], function(
	angular,
	app,

	dashboardTemplate,
	accountTemplate,
	containerListTemplate
) {
	return app.config(['$routeProvider', function($routeProvider) {
		$routeProvider
			.when('/dashboard', {
				controller: 'Dashboard',
				template: dashboardTemplate
			})
			.when('/account', {
				controller: 'Account',
				controllerAs: 'AcctCtrl',
				template: accountTemplate
			})
			.when('/containers', {
				controller: 'ContainerList',
				controllerAs: 'ContListCtrl',
				template: containerListTemplate
			})
			.otherwise({redirectTo: '/dashboard'});
	}]);

});
