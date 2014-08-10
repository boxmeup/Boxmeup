define(['lodash'], function(_) {

	var actions = Object.freeze({
		REFRESH: 'refresh',
		REDIRECT: 'redirect'
	});

	var ContainerSave = function($scope, $location, $route, containerService, notificationService) {
		this.$scope = $scope;
		this.$location = $location;
		this.$route = $route;
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
	 * Remove a container
	 */
	ContainerSave.prototype.remove = function(slug, action) {
		action = action || actions.REFRESH;
		this.notificationService.clearAll(true);
		this.containerService.remove(slug)
			.then(_.bind(handleRemoveResponse, this, false, action))
			['catch'](_.bind(handleRemoveResponse, this, true, action));
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
				this.$location.path('/containers/view/' + response.slug);
			}
		} else {
			this.notificationService.add(
				'DANGER',
				'<strong>Error!</strong> ' + response.message
			);
		}
	};

	var handleRemoveResponse = function(isError, action, response) {
		if (!isError) {
			this.notificationService.add('SUCCESS', 'Container removed.', 2);
			if (action === actions.REDIRECT) {
				this.$location.path('/containers');
			} else if (action === actions.REFRESH) {
				this.$route.reload();
			}
		} else {
			this.notificationService.add('DANGER', '<strong>Error!</strong> Failed to remove container.');
		}
	};

	return ['$scope', '$location', '$route', 'container', 'notification', ContainerSave];

});
