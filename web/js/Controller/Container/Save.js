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
	 */
	ContainerSave.prototype.save = function() {
		var isNew = !!!this.$scope.container.id;
		this.notificationService.clearAll(true);
		this.containerService.save(this.$scope.container)
			.then(_.bind(handleSaveResponse, this, false, isNew))
			['catch'](_.bind(handleSaveResponse, this, true, isNew));
	};

	/**
	 * @scope this
	 */
	var handleSaveResponse = function(isError, isNew, response) {
		if (!isError) {
			this.notificationService.add(
				'SUCCESS', 
				'<strong>Success!</strong> Container successfully ' + (isNew ? 'added' : 'updated')  + '.', isNew ? 2 : null
			);
			if (isNew) {
				this.$location.path('/dashboard');
			}
		} else {
			this.notificationService.add(
				'DANGER',
				'<strong>Error!</strong> ' + response.message
			);
		}
	};

	return ['$scope', '$location', 'container', 'notification', ContainerSave];

});
