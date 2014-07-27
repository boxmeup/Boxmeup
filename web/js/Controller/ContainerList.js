define(['lodash'], function(_) {

	var ContainerList = function($scope, containerService, notificationService) {
		this.$scope = $scope;
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
			.then(_.bind(handleList, this.$scope))
			['catch'](_.bind(function() {
				this.add('WARNING', 'Unable to retrieve the list of containers. Please try again.');
			}, this.notificationService));
	};

	/**
	 * Handle list service response.
	 *
	 * @scope $scope
	 */
	var handleList = function(data) {
		console.log(data);
		this.list = data.containers;
		this.total = data.total;
	};

	return ['$scope', 'container', 'notification', ContainerList];

});
