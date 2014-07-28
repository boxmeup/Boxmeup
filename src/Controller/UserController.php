<?php

namespace Boxmeup\Web\Controller;

use Boxmeup\Web\Base\ControllerInterface;
use Boxmeup\Web\Base\Application;
use Boxmeup\Web\Response\JsonResponse;
use Boxmeup\Web\Transform\UserTransform;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class UserController implements ControllerInterface
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

	public function saveDetails(Request $request) {
		$requestData = json_decode($request->getContent(), true);
		if (!$user = $this->app->user()) {
			$user = new UserTransform($requestData);
		}
		$user['email'] = $requestData['email'];
		if (!empty($requestData['password'])) {
			$user['password'] = $this->app->encodePassword($user, $requestData['password']);
		}

		$this->app['repo.user']->save($user);

		return new Response('User saved.', $user['id'] ? 200 : 201);
	}
}