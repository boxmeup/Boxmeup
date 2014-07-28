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

// Controllers
$app['controllers.path'] = __DIR__ . '/../src/Controller';
$app['controllers.namespace'] = '\Boxmeup\Web\Controller\\';

// Repositories
$app['repository.repositories'] = [
	'user' => 'Boxmeup\Web\Repository\UserRepository',
	'container' => 'Boxmeup\Web\Repository\ContainerRepository',
	'container_item' => 'Boxmeup\Web\Repository\ContainerItemRepository',
	'location' => 'Boxmeup\Web\Repository\LocationRepository'
];
