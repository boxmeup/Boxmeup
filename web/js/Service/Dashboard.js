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

	Dashboard.prototype.recent = function() {
		var deferred = this.$q.defer();
		var data = [
			{quantity: 2, body: 'item1', slug: 'item1', container: 'Box1', modified: '2014-01-01 00:00:00'},
			{quantity: 2, body: 'item1', slug: 'item1', container: 'Box1', modified: '2014-01-01 00:00:00'},
			{quantity: 2, body: 'item1', slug: 'item1', container: 'Box1', modified: '2014-01-01 00:00:00'},
			{quantity: 2, body: 'item1', slug: 'item1', container: 'Box1', modified: '2014-01-01 00:00:00'},
			{quantity: 2, body: 'item1', slug: 'item1', container: 'Box1', modified: '2014-01-01 00:00:00'},
		];

		deferred.resolve(data);

		return deferred.promise;
	};

	return ['$http', '$q', Dashboard];

});
