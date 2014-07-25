<?php

namespace Boxmeup\Web;

use Boxmeup\Web\Base\Application;
use Silex\Provider\TwigServiceProvider;
use Silex\Provider\UrlGeneratorServiceProvider;
use Silex\Provider\ValidatorServiceProvider;
use Silex\Provider\ServiceControllerServiceProvider;
use Silex\Provider\SecurityServiceProvider;
use Silex\Provider\SessionServiceProvider;
use Silex\Provider\DoctrineServiceProvider;
use Boxmeup\Web\Provider\UserProvider;
use Boxmeup\Web\Provider\RepositoryServiceProvider;
use Boxmeup\Web\Controller\AppController;
use Boxmeup\Web\Controller\UserController;
use Boxmeup\Web\Security\Encoder\LegacyMessageDigestPasswordEncoder;

$app = new Application();
$app->register(new UrlGeneratorServiceProvider());
$app->register(new ValidatorServiceProvider());
$app->register(new ServiceControllerServiceProvider());
$app->register(new TwigServiceProvider());
$app->register(new DoctrineServiceProvider());
$app->register(new SessionServiceProvider());
$app->register(new RepositoryServiceProvider());

// Authentication
$app->register(new SecurityServiceProvider(), [
	'security.firewalls' => [
		'app' => [
			'pattern' => '^/app',
			'form' => [
				'login_path' => '/login',
				'check_path' => '/app/login_check',
				'always_use_default_target_path' => true,
				'default_target_path' => '/app'
			],
			'logout' => ['logout_path' => '/app/logout'],
			'users' => $app->share(function() use ($app) {
				return new UserProvider($app['repo.user']);
			})
		]
	],
	// This is pretty weak. Will create a way to force the user to update their password
	// and then use a stronger encoding.
	'security.encoder.digest' => $app->share(function() {
		// use the sha1 algorithm
		// don't base64 encode the password
		// use only 1 iteration
		return new LegacyMessageDigestPasswordEncoder('sha1', false, 1);
	})
]);

// Controllers
$app['controller.app'] = $app->share(function() use ($app) {
	return new AppController($app);
});
$app['controller.user'] = $app->share(function() use ($app) {
	return new UserController($app);
});

// Mixins
$app->before(function ($request) use ($app) {
	$request->getSession()->start();
	$app['twig']->addGlobal('debug', $app['debug']);
});

include 'routes.php';

return $app;
