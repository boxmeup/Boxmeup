define([
	'angular',

	'Service/Dashboard',
	'Service/User',

	'Controller/Dashboard',
	'Controller/Account',

	'Directive/bmuConfirmPassword',

	'angularRoute',
], function (
	angular,

	dashboardService,
	userService,

	dashboardController,
	accountController,

	bmuConfirmPassword
) {
		var app = angular.module('boxmeup', ['ngRoute']);

		app
			// Services
			.service('dashboard', dashboardService)
			.service('user', userService)
			// Controllers
			.controller('Dashboard', dashboardController)
			.controller('Account', accountController)
			// Directives
			.directive('bmuConfirmPassword', bmuConfirmPassword);

		return app;
});
