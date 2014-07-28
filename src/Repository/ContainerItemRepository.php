<?php

namespace Boxmeup\Web\Repository;

use Boxmeup\Web\Base\RepositoryInterface;
use Doctrine\DBAL\Connection;
use Boxmeup\Web\Transform\UserTransform;
use Boxmeup\Container\ContainerCollection;
use Boxmeup\Container\Container;

class ContainerItemRepository implements RepositoryInterface
{
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

}
