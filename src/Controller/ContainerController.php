<?php

namespace Boxmeup\Web\Controller;

use Boxmeup\Web\Base\ControllerInterface;
use Silex\ControllerProviderInterface;
use Symfony\Component\HttpFoundation\Request;
use Boxmeup\Web\Base\Application;
use Boxmeup\Container\Container;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

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
		$controllers->delete('/{container}/', 'controller.container:remove')->convert('container', 'converter.container:convert');

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
		if ($container['slug']) {
			$original = $this->app['repo.container']->getContainerBySlug($container['slug']);
			$this->checkAuthorization($original);
		}
		$container['user'] = $this->app->user();
		try {
			$this->app['repo.container']->save($container);
		} catch (\LogicException $e) {
			return $this->app->json(['message' => $e->getMessage()], 400);
		}

		return $this->app->json($container->toArray());
	}

	public function remove($container) {
		$this->checkAuthorization($container);
		$this->app['repo.container']->remove($container);

		return $this->app->json(['message' => 'Container removed!']);
	}


	/**
	 * Determines if the authenticated user is authorized for a container.
	 *
	 * @param Container $container
	 * @return void
	 * @throws AccessDeniedHttpException
	 */
	protected function checkAuthorization(Container $container) {
		if ($container['user']['id'] !== $this->app->user()['id']) {
			throw new AccessDeniedHttpException('User not allowed to access this container.');
		}
	}

}
