<?php
class Container extends AppModel {
	public $name = 'Container';
	public $displayField = 'name';
	public $validate = array(
		'tag_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'user_id' => array(
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
				'message' => 'Please provide a label name for this box.',
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

	public $pagination_limit = 20;

	public $belongsTo = array(
		'Tag' => array(
			'className' => 'Tag',
			'foreignKey' => 'tag_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
		)
	);

	public $hasMany = array(
		'ContainerItem' => array(
			'className' => 'ContainerItem',
			'foreignKey' => 'container_id',
			'dependent' => true,
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

	public function getPaginatedContainers(&$controller, $user_id) {
		$controller->paginate = array(
            'conditions' => array(
                'Container.user_id' => $user_id
            ),
            'contain' => array(),
            'limit' => $this->pagination_limit
        );

		return $controller->paginate($this);
	}
	
	public function getContainerBySlug($slug, $user_id) {
		return $this->find('first', array(
			'conditions' => array(
				'Container.slug' => $slug, 
				'Container.user_id' => $user_id
			),
			'contain' => array(
				'ContainerItem'
			)
		));
	}

	public function getTotalContainersPerUser($user_id) {
		$this->recursive = -1;
		return $this->find('count', array(
			'conditions' => array(
				'Container.user_id' => $user_id
			)
		));
	}

	public function getTotalContainerItemsPerUser($user_id) {
		$this->recursive = -1;
		return $this->field('SUM(container_item_count) AS total_item_count', array('user_id' => $user_id));
	}

	public function verifyContainerUser($id, $user_id) {
		$this->recursive = -1;
		return $this->find('first', array(
			'fields' => array('id'),
			'conditions' => array('Container.id' => $id, 'Container.user_id' => $user_id)
		));
	}

	public function getIdByUUID($uuid) {
		return $this->field('id', array('uuid' => $uuid));
	}
}
?>
