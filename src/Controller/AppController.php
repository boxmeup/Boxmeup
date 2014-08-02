<?php

namespace Boxmeup\Web\Controller;

use Boxmeup\Web\Base\ControllerInterface;
use Silex\ControllerProviderInterface;
use Boxmeup\Web\Base\Application;
use Symfony\Component\HttpFoundation\Response;

class AppController implements ControllerInterface, ControllerProviderInterface
{
	protected $app;

	public function __construct(Application $app) {
		$this->app = $app;
	}

	public function connect(\Silex\Application $app) {
		$controllers = $app['controllers_factory'];
		$controllers->get('/', 'controller.app:index')->bind('application');

		return $controllers;
	}

	public function index() {
		return $this->app['twig']->render('app.html');
	}

	public function error(\Exception $e, $code) {
		if ($this->app['debug']) {
			return;
		}

		// 404.html, or 40x.html, or 4xx.html, or error.html
		$templates = [
			'errors/'.$code.'.html',
			'errors/'.substr($code, 0, 2).'x.html',
			'errors/'.substr($code, 0, 1).'xx.html',
			'errors/default.html',
		];

		return new Response($this->app['twig']->resolveTemplate($templates)->render(array('code' => $code)), $code);
	}
}
