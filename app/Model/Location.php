<?php
class Location extends AppModel {
	public $name = 'Location';
	public $displayField = 'name';
	
	public $pagination_limit = 20;

	public $hasMany = array(
		'Container'
	);

	public function getLocationByUUID($uuid) {
		return $this->find('first', array(
			'conditions' => array(
				'Location.uuid' => $uuid
			)
		));
	}

	public function getPaginatedLocations($controller, $user_id) {
		$controller->paginate = array(
			'conditions' => array(
				'Location.user_id' => $user_id,
			),
			'contain' => array('Container.slug', 'Container.name'),
			'order' => 'Location.modified DESC',
			'limit' => $this->pagination_limit
		);
		return $controller->paginate($this);
	}

	public function getLocationList($user_id, $uuid = false) {
		$results = $uuid ?
			$this->find('list', array(
				'conditions' => compact('user_id'),
				'fields' => array('Location.uuid', 'Location.name')
			)) :
			$this->find('list', array(
				'conditions' => compact('user_id')
			));
		return $results;
	}

	public function getTotalLocationsPerUser($user_id) {
		return $this->find('count', array(
			'conditions' => compact('user_id'),
			'contain' => array()
		));
	}

	public function getIdByUUID($uuid) {
		return $this->field('id', compact('uuid'));
	}

	public function verifyUser($id, $user_id) {
		$location = $this->find('count', array(
			'conditions' => compact('id', 'user_id'),
			'contain' => array()
		));
		return $location > 0;
	}
}