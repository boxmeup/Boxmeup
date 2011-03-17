<?php
class ContainerItemsController extends AppController {

	public $name = 'ContainerItems';

	public $uses = array('Container', 'ContainerItem');

	public $layout = 'app';

	public $_secure = true;

	public function beforeFilter() {
		parent::beforeFilter();
		$this->set('active', 'containers.index');
	}

	public function add($container_uuid) {
		$this->verifyUser($container_uuid);
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

	public function edit($item_uuid) {
		if(!empty($this->data)) {
			$this->data['Container'] =  array_pop(Set::extract('/Container/.[:first]', $this->Container->find('first', array(
				'fields' => array('id', 'uuid', 'slug'),
				'conditions' => array('Container.uuid' => $this->data['Container']['uuid']),
				'contain' => array()
			))));
			$this->verifyUser($this->data['Container']['id']);
			$this->data['ContainerItem']['id'] = $this->ContainerItem->field('id', array('uuid' => $this->data['ContainerItem']['uuid']));
			if($this->ContainerItem->save($this->data)) {
				$this->Session->setFlash(__('Container item successfully saved.', true), 'notification/success');
				$this->redirect(array(
					'controller' => 'containers',
					'action' => 'view',
					$this->ContainerItem->getContainerSlug($this->data['Container']['uuid']))
				);
			}
		} else {
			$this->data = $this->ContainerItem->find('first', array(
				'conditions' => array('ContainerItem.uuid' => $item_uuid),
				'contain' => array('Container.uuid', 'Container.slug')
			));
			$this->verifyUser($this->data['Container']['uuid']);
		}
		$this->set('control', 'container_items.edit');
	}

	public function delete($item_uuid) {
		$container_id = $this->ContainerItem->field('container_id', array('uuid' => $item_uuid));
		$this->verifyUser($container_id);
		if($this->ContainerItem->delete($this->ContainerItem->field('id', array('uuid' => $item_uuid))))
			$this->Session->setFlash(__('Successfully deleted item.', true), 'notification/success');
		else
			$this->Session->setflash(__('Error deleting item.', false), 'notification/error');
		$this->redirect(array(
			'controller' => 'containers',
			'action' => 'view',
			$this->Container->field('slug', array('id' => $container_id))
		));
	}

}