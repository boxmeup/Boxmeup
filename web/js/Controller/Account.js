define(['lodash'], function(_) {

	var Account = function($scope, userService, notificationService) {
		this.$scope = $scope;
		this.userService = userService;
		this.notificationService = notificationService;
		this.init();
	};

	/**
	 * Initialize the controller.
	 *
	 * @return void
	 */
	Account.prototype.init = function() {
		this.$scope.isSubmitting = false;
		this.userService.details()
			.then(_.bind(handleDetails, this.$scope));
	};

	/**
	 * Save account information.
	 *
	 * @return void
	 */
	Account.prototype.update = function() {
		this.$scope.isSubmitting = true;
		this.userService.save(this.$scope.user)
			.then(_.bind(notifyUserChange, this))
			['catch'](_.bind(notifyUserChange, this, false))
			['finally'](_.bind(function() {
				this.isSubmitting = false;
			}, this.$scope));
	};

	/**
	 * @scope $scope
	 */
	var handleDetails = function(details) {
		this.user = details;
	};

	/**
	 * @scope this
	 */
	var notifyUserChange = function(message) {
		this.notificationService.clearAll(true);
		if (!message) {
			this.notificationService.add('DANGER', 'Error saving account details.');
		} else {
			this.notificationService.add('SUCCESS', 'Successfully updated account details.');
		}
	};

	return ['$scope', 'user', 'notification', Account];

});
