define(['lodash'], function(_) {

	var ContainerList = function($scope, $location, containerService, notificationService) {
		this.$scope = $scope;
		this.$location = $location;
		this.containerService = containerService;
		this.notificationService = notificationService;
		this.init();
	};

	/**
	 * Initialize the controller.
	 *
	 * @return void
	 */
	ContainerList.prototype.init = function() {
		this.containerService.list()
			.then(_.bind(handleList, this))
			['catch'](_.bind(function() {
				this.add('WARNING', 'Unable to retrieve the list of containers. Please try again.');
			}, this.notificationService));
	};

	/**
	 * Handle list service response.
	 *
	 * @scope this
	 */
	var handleList = function(data) {
		if (data.total === 0) {
			this.notificationService.add('INFO', 'Start by creating a container.', 2);
			this.$location.path('/containers/add');
		}
		this.$scope.list = data.containers;
		this.$scope.total = data.total;
	};

	return ['$scope', '$location', 'container', 'notification', ContainerList];

});
