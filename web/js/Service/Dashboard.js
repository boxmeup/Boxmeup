define(['lodash'], function(_) {

	var Dashboard = function($http, $q) {
		this.$http = $http;
		this.$q = $q;
	};

	/**
	 * Retrieve usage stats.
	 * 
	 * @return promise
	 */
	Dashboard.prototype.stats = function() {
		var deferred = this.$q.defer();

		this.$http.get('/app/dashboard')
			.success(deferred.resolve)
			.error(deferred.reject);

		return deferred.promise;
	};

	/**
	 * Retreive recent items.
	 *
	 * @return promise
	 */
	Dashboard.prototype.recent = function() {
		var deferred = this.$q.defer();

		this.$http.get('/app/dashboard/recent')
			.success(deferred.resolve)
			.error(deferred.reject);

		return deferred.promise;
	};

	return ['$http', '$q', Dashboard];

});
