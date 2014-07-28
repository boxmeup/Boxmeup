define(['lodash'], function(_) {

	var types = Object.freeze({
		DANGER: -2,
		WARNING: -1,
		INFO: 0,
		SUCCESS: 1
	});

	var Notification = function($log, $sce) {
		this.$log = $log;
		this.$sce = $sce;
		this.types = types;
		this.messageBus = [];
	};

	/**
	 * Add a message to the bus.
	 *
	 * Setting a persistence of 2 or greater means that the message will
	 * remain to display on different views.
	 *
	 * @param string type
	 * @param string message
	 * @param integer persist How many page transitions should the message persist.
	 * @return void
	 */
	Notification.prototype.add = function(type, message, persist) {
		if (!_.has(types, type)) {
			this.$log.warn('Invalid type: ' + type);
			return;
		}
		persist = persist || 1;
		this.messageBus.push({
			type: type,
			message: this.$sce.trustAsHtml(message),
			persist: persist,
			consumptionCount: 0
		});
	};

	/**
	 * Consume the message bus.
	 *
	 * Returns a copy of the message bus array.
	 *
	 * @return array
	 */
	Notification.prototype.consume = function() {
		return this.messageBus.slice(0);
	};

	/**
	 * Clear all messages from the message bus.
	 *
	 * @param boolean force Force the messages out of the bus right away.
	 * @return void
	 */
	Notification.prototype.clearAll = function(force) {
		var persistent = [];
		if (force) {
			this.messageBus = [];
			return;
		}
		_.forEach(this.messageBus, function(message, index) {

			if(++message.consumptionCount < message.persist) {
				persistent.push(message);
			}
		});
		this.messageBus = persistent;
	};

	return ['$log', '$sce', Notification];

});
