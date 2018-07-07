<?php
class Container extends AppModel {
	public $name = 'Container';
	public $displayField = 'name';
	public $validate = array(
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
			'notBlank' => array(
				'rule' => array('notBlank'),
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
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
		),
		'Location' => array(
			'className' => 'Location',
			'foreignKey' => 'location_id',
			'counterCache' => true
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

	public function getPaginatedContainers($controller, $user_id) {
		$conditions = array('Container.user_id' => $user_id);
		if(!empty($controller->params['named']['location'])) {
			if ($controller->params['named']['location'] === '__UNASSIGNED__') {
				$conditions['OR'] = array(
					array('Container.location_id' => 0),
					array('Container.location_id' => null)
				);
			} else {
				$conditions['Location.uuid'] = $controller->params['named']['location'];
			}
		}
		$controller->paginate = array(
            'conditions' => $conditions,
            'contain' => array('Location.uuid', 'Location.name'),
            'limit' => $this->pagination_limit
        );

		return $controller->paginate($this);
	}

	public function getContainerBySlug($slug) {
		return $this->find('first', array(
			'conditions' => array(
				'Container.slug' => $slug,
			),
			'contain' => array(
				'ContainerItem',
				'Location'
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

	/**
	 * @deprecated
	 */
	public function verifyContainerUser($id, $user_id) {
		$this->recursive = -1;
		return $this->find('first', array(
			'fields' => array('id'),
			'conditions' => array('Container.id' => $id, 'Container.user_id' => $user_id)
		));
	}

	public function verifyUser($id, $user_id) {
		$this->recursive = -1;
		return $this->find('count', array(
			'condition' => array('Container.id' => $id, 'Container.user_id' => $user_id)
		)) > 0;
	}

	public function getIdByUUID($uuid) {
		return $this->field('id', array('uuid' => $uuid));
	}

	public function getSlugByUUID($uuid) {
		return $this->field('slug', array('uuid' => $uuid));
	}

	public function getContainerUuidList($user_id) {
		return $this->find('list', array(
			'fields' => array('uuid', 'name'),
			'conditions' => array(
				'user_id' => $user_id
			)
		));
	}

	// API functions

	public function getApiContainers($user_id, $conditions = array()) {
		$conditions = array_merge(array('Container.user_id' => $user_id), $conditions);
		$results = $this->find('all', array(
			'fields' => array(
				'uuid', 'name', 'slug', 'container_item_count', 'created', 'modified'
			),
			'conditions' => $conditions,
			'contain' => array('Location.name', 'Location.uuid')
		));
		foreach($results as $key => $result) {
			unset($results[$key]['Location']['id']);
		}

		return $results;
	}
}
