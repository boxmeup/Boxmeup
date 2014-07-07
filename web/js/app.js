define([
	'angular',

	'Service/Dashboard',

	'Controller/Dashboard',

	'angularRoute',
], function (
	angular,

	dashboardService,

	dashboardController
) {
		var app = angular.module('boxmeup', ['ngRoute']);

		app
			.service('dashboard', dashboardService)
			.controller('Dashboard', dashboardController);

		return app;
});
