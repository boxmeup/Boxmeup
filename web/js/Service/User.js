define(function() {

	var User = function($q, $timeout) {
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
		var data = {
			email: 'test@test.com'
		};

		deferred.resolve(data);

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

	return ['$q', '$timeout', User];

});
