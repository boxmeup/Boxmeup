define(function() {

	var Container = function($http, $q) {
		this.$http = $http;
		this.$q = $q;
	};

	/**
	 * Get a list of paginated containers.
	 *
	 * @return promise
	 */
	Container.prototype.list = function() {
		var deferred = this.$q.defer();

		this.$http.get('/app/container/')
			.success(deferred.resolve)
			.error(deferred.reject);

		return deferred.promise;
	};

	return ['$http', '$q', Container];

});
