<?php

namespace Boxmeup\Web\Provider;

use Silex\ServiceProviderInterface;
use Silex\Application;

class ConverterProvider implements ServiceProviderInterface
{
    const PREFIX = 'converter.';

    public function register(Application $app)
    {
    }

    public function boot(Application $app)
    {
        foreach ($app['converter.converters'] as $converter) {
            $app[static::PREFIX . $converter['prefix']] = $app->share(function () use ($app, $converter) {
                return new $converter['class']($app['repo.' . $converter['repo']]);
            });
        }
    }
}
