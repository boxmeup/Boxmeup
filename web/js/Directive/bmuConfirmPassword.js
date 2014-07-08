define(function() {

	return function() {
		return {
			require: 'ngModel',
			scope: {
				password: '='
			},
			link: function(scope, el, attrs, ctrl) {
				scope.$watch('password', function(password) {
					if (!password) {
						ctrl.$setValidity('confirm', true);
					}
				});
				ctrl.$parsers.unshift(function(value) {
					ctrl.$setValidity('confirm', value === scope.password);
					return value;
				});
			}
		};
	};

});
