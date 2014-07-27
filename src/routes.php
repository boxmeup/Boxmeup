<?php

namespace Boxmeup\Web;

// Secured routes
$main = $app['controllers_factory'];
$main->get('/', 'controller.app:index');

// User
$main->get('/user', 'controller.user:details');
$main->post('/user', 'controller.user:saveDetails');
$main->post('/login_check', function() {});

// Container
$main->get('/container', 'controller.container:index');

$app->mount('/app', $main);

// Unsecured routes
$app->get('/', function() use ($app) {
	return $app['twig']->render('landing.html');
})->bind('landing_page');
$app->get('/login', 'controller.user:login');

// Error handling
$app->error('controller.app:error');
