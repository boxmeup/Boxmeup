define(function() {

	var User = function($http, $q) {
		this.$http = $http;
		this.$q = $q;
	};

	/**
	 * Retrieve account details for an authenticated user.
	 * 
	 * @return promise
	 */
	User.prototype.details = function() {
		var deferred = this.$q.defer();

		this.$http.get('/app/user/')
			.success(deferred.resolve)
			.error(deferred.reject);

		return deferred.promise;
	};

	/**
	 * Save a user's information.
	 *
	 * @param object user
	 * @return promise
	 */
	User.prototype.save = function(user) {
		var deferred = this.$q.defer();

		this.$http.post('/app/user/', user)
			.success(deferred.resolve)
			.error(deferred.reject);

		return deferred.promise;
	};

	return ['$http', '$q', User];

});
