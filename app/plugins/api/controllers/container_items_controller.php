<?php

class ContainerItemsController extends ApiAppController {
	public $name = 'ContainerItems';
	
	public $xml_set = 'containers_items';
	
	public $uses = array('ContainerItem');
	
	public function index() {
		$conditions = !empty($this->params['url']['Container_slug']) ? array('Container.slug' => $this->params['url']['Container_slug']) : array();
		$this->output = $this->ContainerItem->getApiContainerItems($this->user_id, $conditions);
		if(empty($this->output)) {
			$this->apiError = 'No container items.';
			$this->apiErrorCode = 404;
		}
	}
	
	public function add($container_uuid = null) {
		if($this->verifyUser($container_uuid, $this->user_id)) {
			$container = ClassRegistry::init('Container')->find('first', array(
				'conditions' => array(
					'uuid' => $container_uuid
				),
				'contain' => array()
			));
			if(!empty($this->data) && !empty($container)) {
				$this->data['ContainerItem']['container_id'] = $container['Container']['id'];
				$result = $this->ContainerItem->save($this->data);
				$output = array(
					'success' => $result ? true : false,
					'message' => $result ? array('id' => $this->ContainerItem->id) : $this->ContainerItem->validationErrors
				);
			}
		} else {
			$output = array(
				'success' => false,
				'message' => 'Not authorized to add an item to this container.'
			);
		}
		$this->set(compact('output'));		
	}
	
}