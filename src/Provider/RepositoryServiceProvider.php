<?php

namespace Boxmeup\Web\Provider;

use Silex\ServiceProviderInterface;
use Silex\Application;

class RepositoryServiceProvider implements ServiceProviderInterface
{
	public function register(Application $app) {
		if (!isset($app['repository.prefix'])) {
			$app['repository.prefix'] = 'repo.';
		}
	}

	public function boot(Application $app) {
		foreach ($app['repository.repositories'] as $name => $class) {
			$app[$app['repository.prefix'] . $name] = $app->share(function($app) use ($class) {
				return new $class($app['db']);
			});
		}
	}
}
