define(function() {

	var Container = function($http, $q) {
		this.$http = $http;
		this.$q = $q;
	}

	/**
	 * Get a list of paginated containers.
	 *
	 * @return promise
	 * @todo implement
	 */
	Container.prototype.list = function() {
		var deferred = this.$q.defer();

		deferred.resolve([
			{
				id: '1',
				user: {},
				location: {},
				name: 'Test Box 1',
				slug: 'test-box-1',
				container_item_count: 0,
				created: '2014-01-01 00:00:00',
				modified: '2014-01-01 00:00:00'
			}
		]);

		return deferred.promise;
	};

	return ['$http', '$q', Container];

});
