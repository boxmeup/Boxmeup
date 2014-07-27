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

	protected $defaultListOptions = [
		'aggregate' => false
	];

	public function __construct(Connection $db, array $dependentRepos = []) {
		$this->db = $db;
		$this->repos = $dependentRepos;
	}

	/**
	 * Get a paginated container collection.
	 *
	 * The results will contain data which will be an instance of Boxmeup\Container\ContainerCollection
	 * and total which is the total number of containers available.
	 *
	 * @param  Boxmeup\Web\Transform\UserTransform $user
	 * @param  integer $offset
	 * @return array
	 */
	public function getContainersByUser(UserTransform $user, $offset = 0) {
		$collection = new ContainerCollection();
		$stmt = $this->getListStatement();
		$stmt->bindValue(':user_id', $user['id'], \PDO::PARAM_INT);
		$stmt->bindValue(':offset', $offset, \PDO::PARAM_INT);
		$stmt->bindValue(':limit', static::LIMIT, \PDO::PARAM_INT);
		$stmt->execute();

		foreach ($stmt->fetchAll(\PDO::FETCH_ASSOC) as $container) {
			$collection->add(new Container(array_merge($container, [
				'user' => $user
			])));
		}

		return [
			'data' => $collection,
			'total' => $this->getTotalContainersByUser($user)
		];
	}

	/**
	 * Get the total number of containers 
	 * @param  UserTransform $user [description]
	 * @return integer
	 */
	public function getTotalContainersByUser(UserTransform $user) {
		$stmt = $this->getListStatement(['default' => true]);
		$stmt->bindValue(':user_id', $user['id'], \PDO::PARAM_INT);
		$stmt->execute();
		return (int)$stmt->fetch()['total'];
	}

	/**
	 * Prepares a statement for querying a list of containers.
	 *
	 * @param boolean $aggregate Should return the aggregate results
	 * @return Doctrine\DBAL\Statement
	 */
	protected function getListStatement(array $options = []) {
		$sql = 'select %s from containers where user_id = :user_id';
		if (!$options['default']) {
			return $this->db->prepare(sprintf($sql, '*') . ' limit :offset, :limit');
		}
		return $this->db->prepare(sprintf($sql, 'count(*) as total'));
	} 

}
