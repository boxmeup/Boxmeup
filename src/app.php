<?php

namespace Boxmeup\Web;

use Silex\Provider\TwigServiceProvider;
use Silex\Provider\UrlGeneratorServiceProvider;
use Silex\Provider\ValidatorServiceProvider;
use Silex\Provider\ServiceControllerServiceProvider;
use Silex\Provider\SecurityServiceProvider;
use Silex\Provider\SessionServiceProvider;
use Silex\Provider\DoctrineServiceProvider;
use Boxmeup\Web\Provider\UserProvider;

class Application extends \Silex\Application {
	use \Silex\Application\SecurityTrait;
}

$app = new Application();
$app->register(new UrlGeneratorServiceProvider());
$app->register(new ValidatorServiceProvider());
$app->register(new ServiceControllerServiceProvider());
$app->register(new TwigServiceProvider());
$app->register(new DoctrineServiceProvider());
$app->register(new SessionServiceProvider());

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
	        	return new UserProvider($app['db']);
	        })
	    ]
    ]
]);

// Mixins
$app->before(function ($request) {
    $request->getSession()->start();
});

return $app;
