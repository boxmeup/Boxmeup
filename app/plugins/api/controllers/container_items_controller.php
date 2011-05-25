<?php

class ContainerItemsController extends ApiAppController {
	public $name = 'ContainerItems';
	
	public $xml_set = 'containers_items';
	
	public $uses = array('ContainerItem');
	
	public function index() {
		$conditions = !empty($this->params['url']['Container_slug']) ? array('Container.slug' => $this->params['url']['Container_slug']) : array();
		$output = $this->ContainerItem->getApiContainerItems($this->user_id, $conditions);
		if(empty($output)) {
			$output = array('error' => array('message' => 'No container items.'));
		}
		$this->set(compact('output'));
	}
	
}