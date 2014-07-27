define([
	'angular',
	'lodash',

	'Service/Notification',
	'Service/Dashboard',
	'Service/User',
	'Service/Container',

	'Controller/Dashboard',
	'Controller/Account',
	'Controller/ContainerList',

	'Directive/bmuConfirmPassword',
	'Directive/bmuNavbarCollapse',

	'angularRoute',
], function (
	angular,
	_,

	notificationService,
	dashboardService,
	userService,
	containerService,

	dashboardController,
	accountController,
	containerListController,

	bmuConfirmPassword,
	bmuNavbarCollapse
) {
		var app = angular.module('boxmeup', ['ngRoute']);

		app
			// Services
			.service('notification', notificationService)
			.service('dashboard', dashboardService)
			.service('user', userService)
			.service('container', containerService)
			// Controllers
			.controller('Dashboard', dashboardController)
			.controller('Account', accountController)
			.controller('ContainerList', containerListController)
			// Directives
			.directive('bmuNavbarCollapse', bmuNavbarCollapse)
			.directive('bmuConfirmPassword', bmuConfirmPassword);

		app.run(['$rootScope', 'notification', function($rootScope, notifier) {
			$rootScope.$on('$routeChangeStart', function() {
				notifier.clearAll.call(notifier);
			});
			$rootScope.notifyConsume = _.bind(notifier.consume, notifier);
		}]);

		return app;
});
