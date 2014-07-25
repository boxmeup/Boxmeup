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
	 * Retrieve a user by an ID.
	 *
	 * @param  string $id
	 * @return Boxmeup\Web\Transform\UserTransform
	 * @throws Boxmeup\Web\Exception\NotFoundException
	 */
	public function byId($id) {
		try {
			return $this->byEmailOrId($id);
		} catch (NotFoundException $e) {
			throw new NotFoundException('User not found by provided ID.');
		}
	}

	/**
	 * Retrieve a user by an email address.
	 *
	 * @param  string $email
	 * @return Boxmeup\Web\Transform\UserTransform
	 * @throws Boxmeup\Web\Exception\NotFoundException
	 */
	public function byEmail($email) {
		try {
			return $this->byEmailOrId($email);
		} catch (NotFoundException $e) {
			throw new NotFoundException('User not found by provided email.');
		}
	}

	/**
	 * Persist a user to storage.
	 *
	 * @param Boxmeup\Web\Transform\UserTransform $user
	 * @return mixed
	 */
	public function save(UserTransform $user) {
		return $this->{$user['id'] ? 'update' : 'create'}($user);
	}

	/**
	 * Retrieve a user based on email or ID.
	 *
	 * @param string $value
	 * @return Boxmeup\Web\Transform\UserTransform
	 * @throws Boxmeup\Web\Exception\NotFoundException
	 */
	protected function byEmailOrId($value) {
		$stmt = $this->db->executeQuery(
			'SELECT * FROM users WHERE id = :value OR email = :value',
			compact('value')
		);

		if(!$user = $stmt->fetch()) {
			throw new NotFoundException('User not found by provided email or ID.');
		}

		return new UserTransform($user);
	}

	/**
	 * Create a new user.
	 *
	 * @param Boxmeup\Web\Transform\UserTransform $user
	 * @return mixed
	 */
	protected function create(UserTransform $user) {
		throw new \DomainException('Not implemented yet.');
	}

	/**
	 * Update a user.
	 *
	 * @param UserTransform $user
	 * @return mixed
	 */
	protected function update(UserTransform $user) {
		$qb = $this->db->createQueryBuilder();
		$qb
			->update('users')
			->where('id = :id')
			->setParameter(':id', $user['id']);
		foreach ($user->getUpdatableFields() as $field) {
			$qb
				->set($field, ':' . $field)
				->setParameter(':' . $field, $user[$field]);
		}
		$qb->setParameter(':modified', date('Y-m-d H:i:s'));

		return $qb->execute();
	}
}
