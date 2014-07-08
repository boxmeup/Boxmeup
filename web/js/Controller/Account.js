define(['lodash'], function(_) {

	var Account = function($scope, userService) {
		this.$scope = $scope;
		this.userService = userService;
		this.init();
	};

	Account.prototype.init = function() {
		this.userService.details()
			.then(_.bind(handleDetails, this.$scope));
	};

	/**
	 * @scope $scope
	 */
	var handleDetails = function(details) {
		this.user = details;
	};

	return ['$scope', 'user', Account];

});
