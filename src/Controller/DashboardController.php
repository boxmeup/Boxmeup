<?php

namespace Boxmeup\Web\Controller;

use Boxmeup\Web\Base\ControllerInterface;
use Boxmeup\Web\Base\Application;
use Boxmeup\Web\Response\JsonResponse;
use Boxmeup\Container\Specification as ContainerSpecification;

class DashboardController implements ControllerInterface
{
	protected $app;

	public function __construct(Application $app) {
		$this->app = $app;
	}

	public function index() {
		$stats = [];
		$user = $this->app->user();
		$containerSpec = new ContainerSpecification();

		// Containers
		$stats['containers'] = [
			$this->app['repo.container']->getTotalContainersByUser($user),
			$containerSpec->getLimit($user)
		];
		$stats['containers'][] = min($stats['containers'][0] / $stats['containers'][1] * 100, 100);

		// Items
		$stats['items'] = [
			$this->app['repo.container_item']->getTotalItemsByUser($user),
			$containerSpec->getItemLimit($user)
		];
		$stats['items'][] = min($stats['items'][0] / $stats['items'][1] * 100, 100);

		// Placeholder
		$stats['locations'] = [1, 5, 20];

		return $this->app->json($stats);
	}

}
