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
			['catch'](_.bind(handleError, this.notificationService));
		this.dashboardService.recent()
			.then(_.bind(handleRecent, this.$scope));
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
	var handleError = function() {
		this.add('WARNING', 'Unable to retrieve dashboard stats.');
	}

	return ['$scope', 'dashboard', 'notification', Dashboard];

});
