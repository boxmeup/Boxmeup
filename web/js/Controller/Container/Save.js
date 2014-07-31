define(['lodash'], function(_) {

	var ContainerSave = function($scope, $location, containerService, notificationService) {
		this.$scope = $scope;
		this.$location = $location;
		this.containerService = containerService;
		this.notificationService = notificationService;
	};

	/**
	 * Add a new container.
	 *
	 * @todo When adding a new container, redirect the path to view the container.
	 * @todo Hook up service to actually save the contents
	 */
	ContainerSave.prototype.save = function() {
		var isNew = !!!this.$scope.container.id;
		this.notificationService.add('SUCCESS', '<strong>Success!</strong> Container successfully ' + (isNew ? 'added' : 'updated')  + '.', 2);
		if (isNew) {
			this.$location.path('/dashboard');
		}
	};

	return ['$scope', '$location', 'container', 'notification', ContainerSave];

});
