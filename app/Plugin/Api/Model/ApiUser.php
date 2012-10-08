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
}