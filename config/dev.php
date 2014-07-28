<?php

use Silex\Provider\MonologServiceProvider;
use Silex\Provider\WebProfilerServiceProvider;
use Boxmeup\Web\Util\Configure;

// include the prod configuration
require __DIR__.'/prod.php';

// enable the debug mode
$app['debug'] = true;

$app->register(new MonologServiceProvider(), array(
    'monolog.logfile' => '/tmp/bmu_debug.log',
));

$app->register(new WebProfilerServiceProvider(), array(
    'profiler.cache_dir' => '/tmp/bmu_profiler.log',
    'web_profiler.debug_toolbar.enable' => Configure::get('Debug.toolbar')
));
