define(function() {

	var Container = function($http, $q) {
		this.$http = $http;
		this.$q = $q;
	};

	/**
	 * Get a container by a slug.
	 *
	 * @param string slug
	 * @return promise
	 */
	Container.prototype.get = function(slug) {
		var deferred = this.$q.defer();

		this.$http.get('/app/container/' + slug)
			.success(deferred.resolve)
			.error(deferred.reject);

		return deferred.promise;
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
	};

	/**
	 * Remove a container.
	 *
	 * @param string slug Container slug
	 * @return promise
	 */
	Container.prototype.remove = function(slug) {
		var deferred = this.$q.defer();

		this.$http.delete('/app/container/' + slug + '/')
			.success(deferred.resolve)
			.error(deferred.reject);

		return deferred.promise;
	};

	return ['$http', '$q', Container];

});
