<?php
class User extends AppModel {
	var $name = 'User';
	var $displayField = 'email';
	var $validate = array(
		'email' => array(
			'email' => array(
				'rule' => array('email'),
				'message' => 'Invalid email address.',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'You must enter an email address.',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'unique' => array(
				'rule' => array('isUnique'),
				'message' => 'Email has already been registered.'
			)
		),
		'password' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'You must specify a password.',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
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

	public function afterSave($created) {
		if($created) {
			ClassRegistry::init('Api.ApiUser')->save(array('ApiUser' => array(
				'user_id' => $this->id,
				'api_key' => Security::hash($this->data['User']['email'], null, true)
			)));
		}
	}
}
