define(function() {

	var User = function($http, $q, $timeout) {
		this.$http = $http;
		this.$q = $q;
		this.$timeout = $timeout;
	};

	/**
	 * Retrieve account details for an authenticated user.
	 * 
	 * @return promise
	 * @todo implement
	 */
	User.prototype.details = function() {
		var deferred = this.$q.defer();

		this.$http.get('/app/user')
			.success(deferred.resolve)
			.error(deferred.reject);

		return deferred.promise;
	};

	/**
	 * Save a user's information.
	 *
	 * @param object user
	 * @return promise
	 * @todo implement
	 */
	User.prototype.save = function(user) {
		var deferred = this.$q.defer();
		var data = {
			updated: 1
		};

		this.$timeout(function() {
			deferred.resolve(data);
		}, 1000);

		return deferred.promise;
	};

	return ['$http', '$q', '$timeout', User];

});
