require.config({
	baseUrl: '/js',
	paths: {
		angular: '../bower_components/angular/angular.min',
		angularRoute: '../bower_components/angular-route/angular-route.min',
		bootstrap: '../bower_components/bootstrap-sass-official/assets/javascripts/bootstrap',
		jquery: '../bower_components/jquery/dist/jquery.min',
		text: '../bower_components/requirejs-text/text',
		lodash: '../bower_components/lodash/dist/lodash.min'
	},
	shim: {
		'angular' : {'exports' : 'angular'},
		'angularRoute': ['angular'],
		'bootstrap' : ['jquery'],
		'jquery' : {'exports' : '$'}
	},
	priority: [
		"jquery",
		"angular"
	]
});

//http://code.angularjs.org/1.2.1/docs/guide/bootstrap#overview_deferred-bootstrap
window.name = "NG_DEFER_BOOTSTRAP!";

require([
	'angular',
	'app',
	'routes',
	'jquery',
	'bootstrap'
], function(angular, app) {
	angular.element().ready(function() {
		angular.resumeBootstrap([app['name']]);
	});
});
