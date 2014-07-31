<?php

namespace Boxmeup\Web\Controller;

use Boxmeup\Web\Base\ControllerInterface;
use Silex\ControllerProviderInterface;
use Boxmeup\Web\Base\Application;

class ContainerController implements ControllerInterface, ControllerProviderInterface
{
	protected $app;

	public function __construct(Application $app) {
		$this->app = $app;
	}

	public function connect(\Silex\Application $app) {
		$controllers = $app['controllers_factory'];
		$controllers->get('/', 'controller.container:index');

		return $controllers;
	}

	public function index() {
		$results = $this->app['repo.container']->getContainersByUser($this->app->user());
		return $this->app->json([
			'containers' => $results['data']->toArray(),
			'total' => $results['total']
		]);
	}

}
