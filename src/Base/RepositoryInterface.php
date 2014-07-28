<?php

namespace Boxmeup\Web\Base;

use Doctrine\DBAL\Connection;

interface RepositoryInterface
{
	/**
	 * Constructor.
	 *
	 * @param Connection $db Persistent storage connection.
	 * @param array $dependencies Dependent repositories.
	 */
	public function __construct(Connection $db, array $dependencies = []);
}
