<?php

namespace Boxmeup\Web\Controller;

use Boxmeup\Web\Base\ControllerInterface;
use Boxmeup\Web\Base\Application;
use Boxmeup\Web\Response\JsonResponse;
use Boxmeup\Container\Specification as ContainerSpecification;
use Boxmeup\Location\Specification as LocationSpecification;

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
		$locationSpec = new LocationSpecification();

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

		// Locations
		$stats['locations'] = [
			$this->app['repo.location']->getTotalLocationsByUser($user),
			$locationSpec->getLimit($user)
		];
		$stats['locations'][] = min($stats['locations'][0] / $stats['locations'][1] * 100, 100);

		return $this->app->json($stats);
	}

	public function recent() {
		$collection = $this->app['repo.container_item']->getRecentItemsByUser($this->app->user());

		return $this->app->json($collection->toArray());
	}

}
