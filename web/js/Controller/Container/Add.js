define(function() {

	var Add = function($scope) {
		this.$scope = $scope;
		this.$scope.item = {
			quantity: 1
		};
	};

	return ['$scope', Add];

});
