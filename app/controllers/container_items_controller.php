<?php
class ContainerItemsController extends AppController {

	public $name = 'ContainerItems';

	public $uses = array('Container', 'ContainerItem');

	public function add($container_uuid) {
		$container = $this->Container->find('first', array(
			'conditions' => array(
				'uuid' => $container_uuid
			),
			'contain' => array()
		));
		if(!empty($this->data) && !empty($container)) {
			$this->data['ContainerItem']['container_id'] = $container['Container']['id'];
			if($this->ContainerItem->save($this->data)) {
				$this->Session->setFlash(__('Successfully added new container item.', true), 'notification/success');
				$this->redirect(array('controller' => 'containers', 'action' => 'view', $container['Container']['slug']));
			} else {
				$this->Session->setFlash(__('Error adding new container item.', true), 'notification/error');
			}
		}
	}

}