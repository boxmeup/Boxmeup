<?php

// Autoloader
require_once APP . 'Vendor/autoload.php';
spl_autoload_unregister(array('App', 'load'));
spl_autoload_register(array('App', 'load'), true, true);

Cache::config('default', array('engine' => 'File'));
Configure::write('Dispatcher.filters', array(
	'AssetDispatcher',
	'CacheDispatcher'
));

App::uses('CakeLog', 'Log');
if (Configure::read('debug') > 0) {
	CakeLog::config('debug', array(
		'engine' => 'FileLog',
		'types' => array('notice', 'info', 'debug'),
		'file' => 'debug',
	));
	App::uses('CakeEventManager', 'Event');
	CakeEventManager::instance()->attach(function(CakeEvent $event) {
		CakePlugin::load('DebugKit');
		$controller = $event->subject();
		$controller->Toolbar = $controller->Components->load('DebugKit.Toolbar', array(
			'autoRun' => false
		));
	}, 'Controller.initialize');
}
CakeLog::config('error', array(
	'engine' => 'FileLog',
	'types' => array('warning', 'error', 'critical', 'alert', 'emergency'),
	'file' => 'error',
));

// Load Plugins
CakePlugin::load('Api', array(
	'bootstrap' => true,
	'routes' => true
));
CakePlugin::load('GChart');
CakePlugin::load('Utility');
CakePlugin::load('Feedback');

// Features
// Site Theme
// Configure::write('Site.theme', 'default');

// Mobile themes
Configure::write('Site.mobile_theme', Configure::read('Env.Site.mobile_theme') ?: 'mobile');
Configure::write('Site.jquery_mobile_theme', Configure::read('Env.Site.jquery_mobile_theme') ?: 'b');

// Analytics
Configure::write('Analytics.tracking_code', Configure::read('Env.Analytics.tracking_code'));

// Feedback plugin
Configure::write('Feedback.github.project', Configure::read('Env.Feedback.github.project') ?: 'cjsaylor/Boxmeup');
Configure::write('Feedback.github.auth_token', Configure::read('Env.Feedback.github.auth_token'));
Configure::write('Feedback.github.labels', array('Feedback'));

// Email Config
Configure::write('Email.mailgun', Configure::read('Env.Email.mailgun'));

// Message
Configure::write('Message.message', Configure::read('Env.Message.message') ?: 'Some user message.');
Configure::write('Message.cookie_suffix', Configure::read('Env.Message.cookie_suffix') ?: '001');

// Feature activation
Configure::write('Feature', Configure::read('Env.Feature'));
