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

	/**
	 * Save container data.
	 *
	 * @param object container
	 * @return promise
	 */
	Container.prototype.save = function(container) {
		var deferred = this.$q.defer();

		this.$http.post('/app/container/save/', container)
			.success(deferred.resolve)
			.error(deferred.reject);

		return deferred.promise;
	}

	return ['$http', '$q', Container];

});
