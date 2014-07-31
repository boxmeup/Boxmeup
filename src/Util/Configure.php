<?php

namespace Boxmeup\Web\Util;

class Configure {

	/**
	 * @param string $path
	 */
	public static function get($path) {
		$loc = static::retrieveConfig();
		foreach (explode('.', $path) as $step) {
			$loc = $loc[$step];
		}
		return $loc;
	}

	protected static function retrieveConfig() {
		static $cache = null;

		if ($cache === null) {
			$cache = require __DIR__ . '/../../config/environment.php';
		}

		return $cache;
	}

}
