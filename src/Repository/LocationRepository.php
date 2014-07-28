<?php

namespace Boxmeup\Web\Repository;

use Boxmeup\Web\Base\RepositoryInterface;
use Doctrine\DBAL\Connection;
use Boxmeup\Web\Transform\UserTransform;

class LocationRepository implements RepositoryInterface
{
	protected $db;

	protected $repos;

	public function __construct(Connection $db, array $dependentRepos = []) {
		$this->db = $db;
		$this->repos = $dependentRepos;
	}

	/**
	 * Retrieve the total number of locations a user currently has.
	 *
	 * @param Boxmeup\Web\Transform\UserTransform $user
	 * @return integer
	 */
	public function getTotalLocationsByUser(UserTransform $user) {
		return (int)$this->db->executeQuery(
			'select count(*) as total from locations where user_id = ?',
			[$user['id']],
			[\PDO::PARAM_INT]
		)->fetch()['total'];
	}

}
