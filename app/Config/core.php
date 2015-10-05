<?php

	// Load in environment configurations.
	Configure::load('environment');

	Configure::write('debug', Configure::read('Env.debug'));
	Configure::write('Error', array(
		'handler' => 'ErrorHandler::handleError',
		'level' => E_ALL & ~E_DEPRECATED,
		'trace' => true
	));

	Configure::write('Exception', array(
		'handler' => 'ErrorHandler::handleException',
		'renderer' => 'ExceptionRenderer',
		'log' => true
	));
	Configure::write('App.encoding', 'UTF-8');
	//Configure::write('Cache.disable', true);

/**
 * Defines the default error type when using the log() function. Used for
 * differentiating error logging and debugging. Currently PHP supports LOG_DEBUG.
 */
	define('LOG_ERROR', LOG_ERR);

	Configure::write('Session', array(
		'defaults' => 'php',
		'cookie' => 'BOXMEUP',
		'checkAgent' => false,
		'ini' => array(
			'session.cookie_secure' => false
		)
	));

	Configure::write('Security.level', 'medium');
	Configure::write('Security.salt', Configure::read('Env.salt'));
	Configure::write('Security.cipherSeed', Configure::read('Env.cipher'));

	Configure::write('Asset.timestamp', 'force');

/**
 * Pick the caching engine to use.  If APC is enabled use it.
 * If running via cli - apc is disabled by default. ensure it's available and enabled in this case
 *
 * Note: 'default' and other application caches should be configured in app/Config/bootstrap.php.
 *       Please check the comments in boostrap.php for more info on the cache engines available
 *       and their setttings.
 */
$engine = 'File';
if (extension_loaded('apc') && function_exists('apc_dec') && (php_sapi_name() !== 'cli' || ini_get('apc.enable_cli'))) {
	$engine = 'Apc';
}

// In development mode, caches should expire quickly.
$duration = '+999 days';
if (Configure::read('debug') >= 1) {
	$duration = '+10 seconds';
}

// Prefix each application on the same server with a different string, to avoid Memcache and APC conflicts.
$prefix = 'boxmeup_';

/**
 * Configure the cache used for general framework caching.  Path information,
 * object listings, and translation cache files are stored with this configuration.
 */
Cache::config('_cake_core_', array(
	'engine' => $engine,
	'prefix' => $prefix . 'cake_core_',
	'path' => '/tmp/boxmeup/persistent/',
	'serialize' => ($engine === 'File'),
	'duration' => $duration
));

/**
 * Configure the cache for model and datasource caches.  This cache configuration
 * is used to store schema descriptions, and table listings in connections.
 */
Cache::config('_cake_model_', array(
	'engine' => $engine,
	'prefix' => $prefix . 'cake_model_',
	'path' => '/tmp/boxmeup/models/',
	'serialize' => ($engine === 'File'),
	'duration' => $duration
));
