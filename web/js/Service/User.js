define(function() {

	var User = function($q) {
		this.$q = $q;
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

	return ['$q', User];

});
