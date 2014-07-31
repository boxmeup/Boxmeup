define([
	'angular',
	'app',

	'text!../partials/dashboard.html',
	'text!../partials/user/account.html',
	'text!../partials/container/list.html',
	'text!../partials/container/add.html'
], function(
	angular,
	app,

	dashboardTemplate,
	accountTemplate,
	containerListTemplate,
	containerAddTemplate
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
			.when('/containers/add', {
				controller: 'ContainerSave',
				controllerAs: 'ContSaveCtrl',
				template: containerAddTemplate
			})
			.otherwise({redirectTo: '/dashboard'});
	}]);

});
