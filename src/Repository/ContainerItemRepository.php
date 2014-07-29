<?php

namespace Boxmeup\Web\Repository;

use Boxmeup\Web\Base\RepositoryInterface;
use Doctrine\DBAL\Connection;
use Boxmeup\Web\Transform\UserTransform;
use Boxmeup\Container\Container;
use Boxmeup\Container\ContainerItem;

class ContainerItemRepository implements RepositoryInterface
{
	const LIMIT_RECENT = 5;
	const LIMIT = 20;

	protected $db;

	protected $repos;

	public function __construct(Connection $db, array $dependentRepos = []) {
		$this->db = $db;
		$this->repos = $dependentRepos;
	}

	/**
	 * Retrieve the total number of containers 
	 *
	 * @param Boxmeup\Web\Transform\UserTransform $user
	 * @return integer
	 */
	public function getTotalItemsByUser(UserTransform $user) {
		$stmt = $this->db->executeQuery(
			'
				select count(*) as total from container_items ci
				inner join containers c on c.id = ci.container_id
				where c.user_id = ?',
			[$user['id']],
			[\PDO::PARAM_INT]
		);
		return $stmt->fetch()['total'];
	}

	/**
	 * Retrieve an generic container of recent items.
	 *
	 * @param Boxmeup\Web\Transform\UserTransform $user
	 * @return Boxmeup\Container\Container
	 */
	public function getRecentItemsByUser(UserTransform $user) {
		$parent = new Container(['name' => 'Recent']);
		$stmt = $this->db->executeQuery(
			'
				select ci.*, c.name as container_name, c.slug as container_slug from container_items ci
				inner join containers c on c.id = ci.container_id
				where c.user_id = ?
				order by ci.modified desc
				limit 0, ?
			',
			[$user['id'], static::LIMIT_RECENT],
			[\PDO::PARAM_INT, \PDO::PARAM_INT]
		);
		foreach ($stmt->fetchAll(\PDO::FETCH_ASSOC) as $item) {
			$item = new ContainerItem($item);
			$item['container'] = new Container([
				'id' => $item['container_id'],
				'slug' => $item['container_slug'],
				'name' => $item['container_name']
			]);
			$parent->add($item);
		}

		return $parent;
	}

}
