<?php

namespace Boxmeup\Web\Repository;

use Doctrine\DBAL\Connection;
use Boxmeup\Web\Transform\UserTransform;
use Boxmeup\Web\Exception\NotFoundException;

class UserRepository
{
	/**
	 * Database connection.
	 *
	 * @var Doctrine\DBAL\Connection
	 */
	protected $db;

	/**
	 * Constructor.
	 *
	 * @param Doctrine\Dbal\Connection $db
	 */
	public function __construct(Connection $db) {
		$this->db = $db;
	}

	/**
	 * Retrieve a user by an email address.
	 *
	 * @param  string $email
	 * @return Boxmeup\User\User;
	 */
	public function byEmail($email) {
		$stmt = $this->db->executeQuery(
			'SELECT * FROM users WHERE email = :email',
			compact('email')
		);

		if(!$user = $stmt->fetch()) {
			throw new NotFoundException('User not found by provided email.');
		}

		return new UserTransform($user);
	}

	public function save(UserTransform $user) {
		return $this->{$user['id'] ? 'update' : 'create'}($user);
	}

	protected function create(UserTransform $user) {
		throw new \DomainException('Not implemented yet.');
	}

	protected function update(UserTransform $user) {
		$qb = $this->db->createQueryBuilder();
		$qb
			->update('users')
			->set('email', ':email')
			->set('password', ':password')
			->where('id = :id')
			->setParameter(':email', $user['email'])
			->setParameter(':password', $user['password'])
			->setParameter(':id', $user['id']);

		return $qb->execute();
	}
}
