define(function() {

	return function() {
		return {
			require: 'ngModel',
			scope: {
				password: '='
			},
			link: function(scope, el, attrs, ctrl) {
				scope.$watch('password', function(newPassword) {
					ctrl.$setValidity('confirm', !newPassword || ctrl.$viewValue === newPassword);
				});
				ctrl.$parsers.unshift(function(value) {
					ctrl.$setValidity('confirm', value === scope.password);
					return value;
				});
			}
		};
	};

});
