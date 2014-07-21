<?php

$config = require 'environment.php';

// Twig templates
$app['twig.path'] = array(dirname(__DIR__) . '/templates');
$app['twig.options'] = array('cache' => '/tmp/bmu_cache_twig');

// DB connection
$app['db.options'] = [
	'driver' => 'pdo_mysql',
	'host' => $config['DB']['default']['host'],
	'dbname' => $config['DB']['default']['dbname'],
	'user' => $config['DB']['default']['user'],
	'password' => $config['DB']['default']['password'],
	'charset' => 'utf8'
];

// Session
$app['session.storage.save_path'] = '/tmp/bmu_sessions';
$app['session.storage.options'] = [
	'name' => '_BMU_SESS'
];

// Repositories
$app['repository.repositories'] = [
	'user' => 'Boxmeup\Web\Repository\UserRepository'
];
