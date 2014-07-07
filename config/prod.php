<?php

// configure your app for the production environment

$app['twig.path'] = array(dirname(__DIR__) . '/templates');
$app['twig.options'] = array('cache' => '/tmp/bmu_cache_twig');
