<?php
class Container extends AppModel {
	var $name = 'Container';
	var $displayField = 'name';
	var $validate = array(
		'category_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'user_Id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'name' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'container_item_count' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $belongsTo = array(
		'Category' => array(
			'className' => 'Category',
			'foreignKey' => 'category_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
                'User' => array(
                    'className' => 'User',
                    'foreignKey' => 'user_id',
                )
	);

	var $hasMany = array(
		'ContainerItem' => array(
			'className' => 'ContainerItem',
			'foreignKey' => 'container_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => 'ContainerItem.modified DESC',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);

	public function getTotalContainersPerUser($user_id) {
		$this->recursive = -1;
		return $this->find('count', array(
			'conditions' => array(
				'Container.user_id' => $user_id
			)
		));
	}

	public function verifyContainerUser($id, $user_id) {
		$this->recursive = -1;
		return $this->find('first', array(
			'fields' => array('id'),
			'conditions' => array('Container.id' => $id, 'Container.user_id' => $user_id)
		));
	}
}
?>