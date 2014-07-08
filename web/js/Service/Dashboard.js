define(['lodash'], function(_) {

	var Dashboard = function($q) {
		this.$q = $q;
	};

	/**
	 * Retrieve usage stats.
	 * 
	 * @return promise
	 * @todo implement
	 */
	Dashboard.prototype.stats = function() {
		var deferred = this.$q.defer();
		var data = {
			containers: [2, 10, 80],
			items: [10, 25, 40],
			locations: [1, 5, 20]
		};

		deferred.resolve(data);

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

	return ['$q', Dashboard];

});
