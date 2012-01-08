<?php
class ContainerItem extends AppModel {
	public $name = 'ContainerItem';
	public $displayField = 'name';
	public $actsAs = array('Sphinx');
	public $validate = array(
		'container_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				'message' => 'Please select a container.',
			),
		),
		'body' => array(
			'empty' => array(
				'rule' => 'notEmpty',
				'message' => 'Please enter some content for the item.'
			)
		),
		'quantity' => array(
			'empty' => array(
				'rule' => 'notEmpty',
				'message' => 'Please enter a quantity.'
			),
			'numeric' => array(
				'rule' => 'numeric',
				'message' => 'Must be a numeric value.'
			)
		)
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	public $belongsTo = array(
		'Container' => array(
			'className' => 'Container',
			'foreignKey' => 'container_id',
			'conditions' => '',
			'fields' => '',
			'order' => 'Container.created',
            'counterCache' => true
		)
	);
	
	public $pagination_limit = 20;
	
	public function getPaginatedContainerItems(&$controller, $container_uuid) {
		$controller->paginate = array(
			'conditions' => array(
				'ContainerItem.container_id' => $container_uuid,
			),
			'contain' => array(),
			'order' => 'ContainerItem.modified DESC',
			'limit' => $this->pagination_limit
		);
		return $controller->paginate($this);
	}

	public function getContainerSlug($container_uuid) {
		return $this->Container->field('slug', array('uuid' => $container_uuid));
	}
	
	public function getRecentItems($user_id) {
		return $this->find('all', array(
			'limit' => 5,
			'order' => 'ContainerItem.created DESC',
			'contain' => array('Container'),
			'conditions' => array('Container.user_id' => $user_id)
		));
	}
	
	public function getAllItems($user_id) {
		return $this->find('all', array(
			'fields' => array('container_id', 'body', 'quantity', 'created', 'modified'),
			'order' => 'ContainerItem.created ASC',
			'contain' => array('Container.name', 'Container.slug'),
			'conditions' => array('Container.user_id' => $user_id)
		));
	}

	public function getItemByUUID($uuid) {
		return $this->find('first', array(
			'conditions' => array(
				'ContainerItem.uuid' => $uuid
			),
			'contain' => array('Container.id')
		));
	}

	public function searchContainers(&$controller, $user_id, $query) {
		$controller->paginate = array(
			'search' => $query,
			'sphinx' => array(
				'matchMode' => SPH_MATCH_ALL,
				'index' => array('container_items', 'container_items_delta'),
				'sortMode' => array(SPH_SORT_TIME_SEGMENTS => 'created'),
				'filter' => array(array('user_id', $user_id))
			),
			'contain' => array('Container')
		);

		return $controller->paginate($this);
	}
	
	// API Methods
	public function getApiContainerItems($user_id, $conditions = array()) {
		$conditions = array_merge(array('user_id' => $user_id), $conditions);
		return $this->find('all', array(
			'fields' => array('uuid', 'body', 'quantity', 'created', 'modified'),
			'conditions' => $conditions,
			'limit' => 150
		));
	}
}