define([
	'angular',
	'app',

	'text!../partials/dashboard.html',
	'text!../partials/user/account.html',
	'text!../partials/container/list.html',
	'text!../partials/container/add.html',
	'text!../partials/container/view.html'
], function(
	angular,
	app,

	dashboardTemplate,
	accountTemplate,
	containerListTemplate,
	containerAddTemplate,
	containerViewTemplate
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
			.when('/containers/view/:slug', {
				template: containerViewTemplate
			})
			.otherwise({redirectTo: '/dashboard'});
	}]);

});
