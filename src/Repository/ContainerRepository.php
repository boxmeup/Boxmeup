<?php

namespace Boxmeup\Web\Repository;

use Doctrine\DBAL\Connection;
use Boxmeup\Web\Transform\UserTransform;
use Boxmeup\Container\ContainerCollection;
use Boxmeup\Container\Container;

class ContainerRepository
{
	const LIMIT = 20;

	protected $db;

	protected $repos;

	public function __construct(Connection $db, array $dependentRepos = []) {
		$this->db = $db;
		$this->repos = $dependentRepos;
	}

	public function getContainersByUser(UserTransform $user, $offset = 0) {
		$collection = new ContainerCollection();
		$stmt = $this->db->executeQuery(
			'
				select * from containers where user_id = :user_id
				limit :offset, :limit
			',
			[
				'user_id' => $user['id'],
				'offset' => (int)$offset,
				'limit' => static::LIMIT
			],
			[
				'user_id' => \PDO::PARAM_INT,
				'offset' => \PDO::PARAM_INT,
				'limit' => \PDO::PARAM_INT
			]
		);
		foreach ($stmt->fetchAll(\PDO::FETCH_ASSOC) as $container) {
			$collection->add(new Container(array_merge($container, [
				'user' => $user
			])));
		}

		return $collection;
	}

}
