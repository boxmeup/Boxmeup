<?php

namespace Boxmeup\Web\Controller;

use Boxmeup\Web\Base\ControllerInterface;
use Silex\ControllerProviderInterface;
use Symfony\Component\HttpFoundation\Request;
use Boxmeup\Web\Base\Application;
use Boxmeup\Container\Container;

class ContainerController implements ControllerInterface, ControllerProviderInterface
{
	protected $app;

	public function __construct(Application $app) {
		$this->app = $app;
	}

	public function connect(\Silex\Application $app) {
		$controllers = $app['controllers_factory'];
		$controllers->get('/', 'controller.container:index');
		$controllers->post('/save/', 'controller.container:save');

		return $controllers;
	}

	public function index() {
		$results = $this->app['repo.container']->getContainersByUser($this->app->user());
		return $this->app->json([
			'containers' => $results['data']->toArray(),
			'total' => $results['total']
		]);
	}

	public function save(Request $request) {
		if (!is_string($request->getContent())) {
			throw new \InvalidArgumentException();
		}
		$container = new Container(json_decode($request->getContent(), true));
		$container['user'] = $this->app->user();
		try {
			$this->app['repo.container']->save($container);
		} catch (\LogicException $e) {
			return $this->app->json(['message' => $e->getMessage()], 400);
		}

		return $this->app->json($container->toArray());
	}

}
