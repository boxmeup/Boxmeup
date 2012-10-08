<?php
class User extends AppModel {
	var $name = 'User';
	var $displayField = 'email';
	var $validate = array(
		'email' => array(
			'email' => array(
				'rule' => array('email'),
				'message' => 'Invalid email address.',
			),
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'You must enter an email address.'
			),
			'unique' => array(
				'rule' => array('isUnique'),
				'message' => 'Email has already been registered.'
			)
		),
		'password' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'You must specify a password.'
			),
			'minLength' => array(
				'rule' => array('minLength', 8),
				'message' => 'Your password must be at least 8 characters long.'
			)
		)
	);

	public $hasMany = array(
		'Container' => array(
			'className' => 'Container',
			'foreignKey' => 'user_id',
			'order' => 'Container.created'
		)
	);

	public function beforeSave($options = array()) {
		if (!empty($this->data['User']['password'])) {
			$this->data['User']['password'] = AuthComponent::password($this->data['User']['password']);
		}
		return true;
	}

	public function afterSave($created) {
		if($created) {
			ClassRegistry::init('Api.ApiUser')->save(array('ApiUser' => array(
				'user_id' => $this->id,
				'api_key' => Security::hash($this->data['User']['email'], null, true),
				'secret_key' => Security::hash($this->data['User']['email'] . date('c'), null, true)
			)));
		}
	}

	public function getUserByEmail($email) {
		return $this->find('first', array(
			'conditions' => array(
				'email' => $email
			),
			'contain' => array()
		));
	}
	
	public function getUserIdByEmail($email) {
		return $this->field('id', array('email' => $email));
	}
	
	public function verifyEmail($email) {
		return $this->find('count', array(
			'conditions' => array(
				'email' => $email
			)
		)) > 0;
	}

	public function verifyLogin($email, $password) {
		return $this->find('count', array(
			'conditions' => array(
				'email' => $email,
				'password' => $this->hashPassword($password)
			),
			'contains' => array()
		)) > 0;
	}
	
	public function resetPassword($email) {
		$user_id = $this->getUserIdByEmail($email);
		$rand_password = $this->genRandomString();
		$result = $this->save(array('User' => array(
			'id' => $user_id,
			'password' => $rand_password,
			'reset_password' => '1'
		)));

		return $result ? $rand_password : false;
	}
	
	public function verifyRecoveryKey($user_id, $key) {
		$hashed_key_on_file = $this->field('password', array('id' => $user_id));
		$hash_key = $this->hashPassword($key);
		return $hashed_key_on_file === $hash_key;
	}
	
	public function hashPassword($password) {
		return AuthComponent::password($password);
	}
	
	private function genRandomString($length = 8) {
		$characters = '0123456789abcdefghijklmnopqrstuvwxyz';
		$string = '';    
		for ($p = 0; $p < $length; $p++)
			$string .= $characters[mt_rand(0, strlen($characters))];
			
		return $string;
	}
}
