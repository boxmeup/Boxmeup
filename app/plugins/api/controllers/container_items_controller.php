<?php

class ContainerItemsController extends ApiAppController {
	public $name = 'ContainerItems';
	
	public $xml_set = 'containers_items';
	
	public $uses = array('ContainerItem');
	
	public function index() {
		$conditions = !empty($this->params['url']['Container_slug']) ? array('Container.slug' => $this->params['url']['slug']) : array();
		$this->output = $this->ContainerItem->getApiContainerItems($this->user_id, $conditions);
		if(empty($this->output)) {
			$this->setError(404, 'No container items.');
		}
	}
	
	public function add($slug = null) {
		if(!$this->RequestHandler->isPost()) {
			$this->setError(405, 'Resource method supports only POST method.');
			return false;
		}
		$container = $this->ContainerItem->Container->getContainerBySlug($slug, $this->user_id);
		if(empty($container)) {
			$this->setError(404, 'Container not found.');
			return false;
		}
		if(!$this->ContainerItem->Container->verifyUser($container['Container']['id'], $this->user_id)) {
			$this->setError(401, 'Not authorized to edit container.');
			return false;
		}
		$data['ContainerItem']['container_id'] = $container['Container']['id'];
		$data['ContainerItem']['body'] = $this->params['form']['body'];
		$data['ContainerItem']['quantity'] = $this->params['form']['quantity'];
		$this->output = $this->ContainerItem->save($data);
		if(empty($this->output)) {
			$this->setError(400, 'Error adding item to container.');
			return false;
		}
		unset($this->output['ContainerItem']['container_id']);
	}
	
}