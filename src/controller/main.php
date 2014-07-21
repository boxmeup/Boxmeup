<?php

namespace Boxmeup\Web\Controller;

$main = $app['controllers_factory'];

$main->get('/', function () use ($app) {
    return $app['twig']->render('app.html', [
        'debug' => $app['debug']
    ]);
})
->bind('application-main');

$main->post('/login_check', function() {
});

$main->get('/user', function() use ($app) {
	return $app->json([
		'email' => $app->user()->toArray()['email']
	]);
});

$main->get('/test', function() use ($app) {
    return $app->json(['test' => 'foo']);
});

return $main;
