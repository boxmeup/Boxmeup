define(['lodash'], function(_) {

	var Dashboard = function($scope, dashboardService) {
		this.$scope = $scope;
		this.dashboardService = dashboardService;
		this.init();
	};

	Dashboard.prototype.init = function() {
		this.dashboardService.stats()
			.then(_.bind(handleStats, this.$scope));
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

	return ['$scope', 'dashboard', Dashboard];

});
