<?php
App::import('lib', array('Sanitize'));
class ContainerItemsController extends AppController {

	public $name = 'ContainerItems';

	public $uses = array('Container', 'ContainerItem');

	public $layout = 'app';

	public $_secure = true;

	public function beforeFilter() {
		parent::beforeFilter();
		$this->set('active', 'container_items.index');
	}

	public function index() {
		$this->helpers[] = 'Time';
		$containers = $this->Container->find('list', array(
			'conditions' => array('Container.user_id' => $this->Auth->user('id')),
			'order' => 'Container.name'
		));
		if(empty($containers)) {
			$this->Session->setFlash('Start by creating a container.', 'notification/notice');
			$this->redirect(array('controller' => 'containers', 'action' => 'add'));
		}
		$this->paginate = array(
			'conditions' => array('Container.user_id' => $this->Auth->user('id')),
			'limit' => 25,
			'contain' => array(
				'Container' => array('fields' => array('id', 'name', 'slug'))
			),
			'order' => 'ContainerItem.modified DESC'
		);
		$this->data['order'] = !empty($this->params['named']['sort']) ? $this->params['named']['sort'] : '';
		$this->data['direction'] = !empty($this->params['named']['direction']) ? $this->params['named']['direction'] : '';
		$container_items = $this->paginate('ContainerItem');
		$this->set(compact('containers', 'container_items'));
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
		$this->set('container', array('Container' => array('uuid' => $container_uuid)));
	}

	public function add_item() {
		if(!empty($this->data)) {
			if(!empty($this->data['ContainerItem']['container_id']))
				$this->verifyUser($this->data['ContainerItem']['container_id']);
			if($this->ContainerItem->save($this->data)) {
				$this->Session->setFlash(__('Successfully added new container item.', true), 'notification/success');
				$this->redirect(array('controller' => 'container_items', 'action' => 'index'));
			} else {
				$this->Session->setFlash(__('Error adding new container item.', true), 'notification/error');
			}
		}
		$containers = $this->Container->find('list', array(
			'conditions' => array('Container.user_id' => $this->Auth->user('id')),
			'order' => 'Container.name'
		));
		$this->set(compact('containers'));
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
			$this->data['ContainerItem']['container_id'] = $this->Container->field('id', array('uuid' => $this->data['Container']['uuid']));
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
		$containers = $this->Container->getContainerUuidList($this->Auth->user('id'));
		$this->set('control', 'container_items.edit');
		$this->set(compact('containers'));
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
	
	public function export() {
		if(Configure::read('Feature.bulk_export')) {
			$this->helpers[] = 'Csv';
			$this->layout = false;
			$last_request = $this->Session->read('Feature.bulk_export.last_request');
			if(empty($last_request))
				$this->Session->write('Feature.bulk_export.last_request', date('Y-m-d H:i:s'));
			else if(strtotime($last_request) > strtotime('-1 minute')) {
				$this->Session->setFlash('Bulk exporting is an intense operation.  Please wait another minute before requesting again.', 'notification/notice');
				$this->redirect($this->referer());
			} else {
				$this->Session->delete('Feature.bulk_export.last_request');
			}
			$data = $this->ContainerItem->getAllItems($this->Auth->user('id'));
			if(empty($data)) {
				$this->Session->setFlash('You must create some items before exporting.', 'notification/notice');
				$this->redirect($this->referer());
			}
			$this->set(compact('data'));
		} else {
			$this->Session->setFlash('Bulk export feature has been temporarily disabled.', 'notification/notice');
			$this->redirect($this->referer());
		}
	}
}