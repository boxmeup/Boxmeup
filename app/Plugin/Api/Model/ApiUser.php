<?php
class ApiUser extends ApiAppModel {
	var $name = 'ApiUser';
	var $displayField = 'api_key';
	var $validate = array(
		'user_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
			),
			'notempty' => array(
				'rule' => array('notempty'),
			),
		),
		'api_key' => array(
			'notempty' => array(
				'rule' => array('notempty'),
			),
		),
	);
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $belongsTo = array(
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

	/**
	 * Returns the user_id
	 *
	 * @param string $api_key
	 * @return string
	 */
	public function getUserId($api_key) {
		return $this->field('user_id', array('api_key' => $api_key, 'is_active' => 1));
	}

	public function getApiKey($user_id) {
		return $this->field('api_key', array('user_id' => $user_id, 'is_active' => 1));
	}

	public function getSecretKey($api_key) {
		return $this->field('secret_key', array('api_key' => $api_key, 'is_active' => 1));
	}

	public function generateSigniture($api_key, $dyn_key) {
		$secret_key = $this->getSecretKey($api_key);
		return sha1($dyn_key . $secret_key);
	}

	/**
	 * Checks if the request params match a valid HMAC key.
	 *
	 * @param array $params
	 * @throws Exception
	 * @return boolean
	 */
	public function isValidRequest($params) {
		if(empty($params['api_key'])) {
			throw new Exception('Api key required.', 401);
		} else {
			$apiKey = $params['api_key'];
		}
		$secretKey = $this->getSecretKey($apiKey);
		if(empty($secretKey)) {
			throw new Exception('Api key not valid', 401);
		}
		if(empty($params['dyn_key'])) {
			throw new Exception('Dynamic key required.', 401);
		} else {
			$dynKey = $params['dyn_key'];
		}
		if(empty($params['hmac'])) {
			throw new Exception('HMAC encrypted key required.', 401);
		} else {
			$hmac = $params['hmac'];
		}
		unset($params['api_key'], $params['dyn_key'], $params['hmac']);

		// Calculate hmac
		ksort($params);
		$calcHmac = sha1(implode('', $params) . $dynKey . $secretKey);

		return $calcHmac === $hmac;
	}
}