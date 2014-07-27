<?php

namespace Boxmeup\Web\Controller;

use Boxmeup\Web\Base\ControllerInterface;
use Boxmeup\Web\Base\Application;
use Boxmeup\Web\Response\JsonResponse;

class ContainerController implements ControllerInterface
{
	protected $app;

	public function __construct(Application $app) {
		$this->app = $app;
	}

	public function index() {
		$results = $this->app['repo.container']->getContainersByUser($this->app->user());
		return $this->app->json([
			'containers' => $results['data']->toArray(),
			'total' => $results['total']
		]);
	}

}
