<?php

namespace Boxmeup\Web\Provider;

use Silex\ServiceProviderInterface;
use Silex\Application;

class RouteProvider implements ServiceProviderInterface
{
	public function register(Application $app) {
	}

	public function boot(Application $app) {
		foreach ($app['mount.points'] as $uri => $controller) {
			$app->mount($uri, $app[ControllerProvider::DEFAULT_PREFIX . $controller]);
		}
		$this->routeSpecial($app);
	}

	protected function routeSpecial(Application $app) {
		// No-op authentication check endpoint
		$app->post('/app/login_check', function() {});

		$app->get('/', function() use ($app) {
			return $app['twig']->render('landing.html');
		})->bind('landing_page');

		$app->get('/login', 'controller.user:login');
	}
}
