<?php

namespace Boxmeup\Web\Controller;

$main = $app['controllers_factory'];

$main->get('/', function () use ($app) {
    return $app['twig']->render('app.html', [
        'debug' => $app['debug']
    ]);
})
->bind('application-main');

$main->post('/login_check', function() use ($app) {
});

$main->get('/test', function() use ($app) {
    return $app->json(['test' => 'foo']);
});

return $main;
