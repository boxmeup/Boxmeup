define(['lodash'], function(_) {

	var Dashboard = function($scope, dashboardService, notificationService) {
		this.$scope = $scope;
		this.dashboardService = dashboardService;
		this.notificationService = notificationService;
		this.init();
	};

	Dashboard.prototype.init = function() {
		this.dashboardService.stats()
			.then(_.bind(handleStats, this.$scope))
			['catch'](_.bind(handleError, this.notificationService, 'stats'));
		this.dashboardService.recent()
			.then(_.bind(handleRecent, this.$scope))
			['catch'](_.bind(handleError, this.notificationService, 'recent items'));
	};

	/**
	 * @scope $scope
	 */
	var handleStats = function(stats) {
		this.stats = stats;
	};

	/**
	 * @scope $scope
	 */
	var handleRecent = function(recent) {
		this.recent = recent;
	};

	/**
	 * @scope notification
	 */
	var handleError = function(type) {
		type = type || 'stats';
		this.add('WARNING', 'Unable to retrieve dashboard ' + type + '.');
	};

	return ['$scope', 'dashboard', 'notification', Dashboard];

});
