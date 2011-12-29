<?php
App::import('lib', array('Sanitize'));
class LocationsController extends AppController {

	public $name = 'Locations';

	public $layout = 'app';

	public $_secure = true;

	public function beforeFilter() {
		parent::beforeFilter();
		$this->set('active', 'locations.index');
	}
	
	public function index() {
		$this->helpers[] = 'Time';
		$locations = $this->Location->getPaginatedLocations($this, $this->Auth->user('id'));
		if(empty($locations)) {
			$this->Session->setFlash('Start by creating a location.', 'notification/notice');
			$this->redirect(array('action' => 'add'));
		}
		$this->set(compact('locations'));
	}
	
	public function add() {
		if(!empty($this->data)) {
			$this->data['Location']['user_id'] = $this->Auth->user('id');
			$this->data['Location']['is_mappable'] = !empty($this->data['Location']['address']);
			if($this->Location->save($this->data)) {
				$this->Session->setFlash('Successfully added new location', 'notification/success');
				$this->redirect(array('controller' => 'locations', 'action' => 'index'));
			} else {
				$this->Session->setFlash('There was a problem saving your location.', 'notification/error');
			}
		}
	}

	public function edit($location_uuid) {
		$this->verifyUserV2($location_uuid, null, 'Location');
		if(!empty($this->data)) {
			$this->data['Location']['id'] = $this->Location->getIdByUUID($location_uuid);
			$this->data['Location']['is_mappable'] = !empty($this->data['Location']['address']);
			if($this->Location->save($this->data)) {
				$this->Session->setFlash('Successfully updated location.', 'notification/success');
				$this->redirect(array('controller' => 'locations', 'action' => 'index'));
			} else {
				$this->Session->setFlash('Error updating location.', 'notification/error');
			}
		} else {
			$this->data = $this->Location->getLocationByUUID($location_uuid);
		}
		$this->set(compact('location_uuid'));
	}

	public function delete($location_uuid) {
		$this->verifyUserV2($location_uuid, null, 'Location');
		$result = $this->Location->delete($this->Location->getIdByUUID($location_uuid));
		$message = $result ?
			'Successfully deleted location.' :
			'Error deleting location.';
		$this->Session->setFlash($message, 'notification/' . ($result ? 'success' : 'error'));
		$this->redirect(array('controller' => 'locations', 'action' => 'index'));
	}
	
}