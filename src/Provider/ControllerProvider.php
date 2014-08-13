<?php

namespace Boxmeup\Web\Provider;

use Silex\ServiceProviderInterface;
use Silex\Application;

class ControllerProvider implements ServiceProviderInterface
{
    const DEFAULT_PREFIX = 'controller.';

    protected $directorySkip = ['.', '..'];

    public function register(Application $app)
    {
    }

    public function boot(Application $app)
    {
        foreach (scandir($app['controllers.path']) as $controller) {
            if (in_array($controller, $this->directorySkip)) {
                continue;
            }
            $controller = str_replace('.php', '', $controller);
            $slug = strtolower(str_replace('Controller', '', $controller));
            $app[static::DEFAULT_PREFIX . $slug] = $app->share(function () use ($app, $controller) {
                $class = $app['controllers.namespace'] . $controller;

                return new $class($app);
            });
        }
    }
}
