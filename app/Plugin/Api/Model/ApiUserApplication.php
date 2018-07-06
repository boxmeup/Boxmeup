<?php

class ApiUserApplication extends ApiAppModel {

	public $name = 'ApiUserApplication';

	public $displayField = 'token';

	public $validate = array(
		'user_id' => array(
			'numeric' => array(
				'rule' => array('numeric')
			),
			'notBlank' => array(
				'rule' => array('notBlank')
			)
		),
		'token' => array(
			'notBlank' => array(
				'rule' => array('notBlank')
			)
		)
	);

	public $belongsTo = array(
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

	/**
	 * Creates an access token entry for a user with a given application name.
	 *
	 * @param string $name
	 * @param integer $userId
	 * @return string
	 * @throws InternalErrorException
	 */
	public function createApplication($name, $userId) {
		$token = sha1($userId . time());
		$result = $this->save(array(
			'ApiUserApplication' => array(
				'name' => $name,
				'user_id' => $userId,
				'token' => $token
			)
		));
		if (!$result) {
			throw new InternalErrorException('Unable to create oauth token');
		}
		return $token;
	}

	/**
	 * Retrieve the user's auth token by userId and application name.
	 *
	 * @param integer $userId
	 * @param string $name Application name
	 * @return string
	 * @throws NotFoundException
	 */
	public function getTokenByUserId($userId, $name) {
		$key = $userId . $name . '_auth_token';
		if (!$token = Cache::read($key)) {
			$result = $this->find('first', array(
				'conditions' => array(
					'ApiUserApplication.user_id' => $userId,
					'ApiUserApplication.name' => $name
				),
				'fields' => array('ApiUserApplication.token')
			));
			if (!empty($result['ApiUserApplication']['token'])) {
				$token = $result['ApiUserApplication']['token'];
				Cache::write($key, $token);
			}
		}
		if (empty($token)) {
			throw new NotFoundException('Token does not exist for this user.');
		}
		return $token;
	}

	/**
	 * Get all authenticated applications
	 *
	 * @param integer $userId
	 * @return array
	 */
	public function getAllAuthenticatedApps($userId) {
		$results = $this->find('all', array(
			'conditions' => array(
				'ApiUserApplication.user_id' => $userId
			),
			'contain' => false
		));
		return $results;
	}

	/**
	 * Removes an auth token by ID.
	 *
	 * @param integer $id
	 * @return boolean
	 */
	public function revokeTokenById($id, $userId = null) {
		$application = $this->find('first', array(
			'conditions' => array(
				'ApiUserApplication.id' => $id,
				'ApiUserApplication.user_id' => $userId
			),
			'contain' => array()
		));
		if (empty($application)) {
			return false;
		}
		Cache::delete($application['ApiUserApplication']['token'] . '_auth_token');
		Cache::delete($application['ApiUserApplication']['user_id'] . $application['ApiUserApplication']['name'] . '_auth_token');
		return $this->delete($id);
	}

	/**
	 * Get user information based on auth token.
	 *
	 * @param string $token
	 * @return array
	 */
	public function getUserByToken($token) {
		$key = $token . '_auth_token';
		if (!$user = Cache::read($key)) {
				$result = $this->find('first', array(
				'conditions' => array(
					'ApiUserApplication.token' => $token
				),
				'contain' => array(
					'User' => array(
						'id', 'email', 'uuid'
					)
				)
			));
			if (empty($result['User'])) {
				throw new NotFoundException('Invalid token.');
			}
			$user = $result['User'];
			Cache::write($key, $user);
		}

		return $user;
	}

}
