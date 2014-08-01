<?php

namespace Boxmeup\Web\Provider;

use Silex\ServiceProviderInterface;
use Silex\Application;

class RepositoryServiceProvider implements ServiceProviderInterface
{
	const DEFAULT_PREFIX = 'repo.';

	public function register(Application $app) {
		if (!isset($app['repository.prefix'])) {
			$app['repository.prefix'] = static::DEFAULT_PREFIX;
		}
	}

	public function boot(Application $app) {
		$prefix = $app['repository.prefix'];
		foreach ($app['repository.repositories'] as $name => $class) {
			$dependents = [];
			if (is_array($class)) {
				foreach ($class[1] as $dependency) {
					$dependents[$dependency] = $app[$prefix . $dependency];
				}
				$class = $class[0];
			}
			$app[$prefix . $name] = $app->share(function($app) use ($class, $dependents) {
				return new $class($app['db'], $dependents);
			});
		}
	}
}
