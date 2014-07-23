<?php

namespace Boxmeup\Web\Controller;

use Boxmeup\Web\Application;
use Boxmeup\Web\Response\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class UserController
{
	protected $app;

	public function __construct(Application $app) {
		$this->app = $app;
	}

	public function login(Request $request) {
		return $this->app['twig']->render('login.html', [
			'error' => $this->app['security.last_error']($request),
			'last_username' => $this->app['session']->get('_security.last_username'),
		]);
	}

	public function details() {
		return $this->app->json([
			'email' => $this->app->user()->toArray()['email']
		]);
	}
}
