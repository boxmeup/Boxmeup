<?php
App::uses('Sanitize', 'Utility');
class ContainersController extends AppController {

	public $name = 'Containers';

	public $layout = 'app';

	public $_secure = true;

	public $uses = ['Container', 'Location'];

	public function beforeFilter() {
		parent::beforeFilter();
		$this->set('active', 'containers.index');
	}

	public function dashboard() {
		$this->helpers[] = 'Time';
		$total_containers = $this->Container->getTotalContainersPerUser($this->Auth->user('id'));
		$total_container_items = $this->Container->getTotalContainerItemsPerUser($this->Auth->user('id'));
		$total_locations = $this->Location->getTotalLocationsPerUser($this->Auth->user('id'));

		// Recent items
		$recent_items = $this->Container->ContainerItem->getRecentItems($this->Auth->user('id'));

		$this->set(compact('total_containers', 'total_container_items', 'total_locations', 'recent_items'));
		$this->set('active', 'containers.dashboard');
	}

	public function dashboard_graph() {
		$this->redirect('/dashboard');
	}

	public function index() {
		$this->helpers[] = 'Time';
		$control = 'containers.index';
		$this->request->data['Container']['order'] = !empty($this->request->params['named']['sort']) ? $this->request->params['named']['sort'] : '';
		$this->request->data['Container']['direction'] = !empty($this->request->params['named']['direction']) ? $this->request->params['named']['direction'] : '';
		$containers = $this->Container->getPaginatedContainers($this, $this->Auth->user('id'));
		if(empty($containers) && empty($this->request->params['named']['location'])) {
			$this->Session->setFlash('Start by creating a container.', 'notification/notice');
			$this->redirect(array('action' => 'add'));
		}

		// Check the cookie and render the view depending on what was selected
		$location_list = $this->Location->getLocationList($this->Auth->user('id'), true);
		array_unshift($location_list, array('__UNASSIGNED__' => '-- Unassigned --'));
		$this->set(compact('containers', 'control', 'location_list'));
		$this->request->data['Location']['uuid'] = !empty($this->request->params['named']['location']) ? $this->request->params['named']['location'] : null;
	}

	public function change_view($view) {
		$this->Session->write('Feature.change_view', $view == 'list' ? 'list' : 'grid');
		$this->redirect($this->referer());
	}

	public function view($slug=null) {
		$this->helpers[] = 'Time';
		$container = $this->Container->getContainerBySlug($slug);
		if (empty($container)) {
			throw new NotFoundException('Container not found.');
		}
		if ($container['Container']['user_id'] !== $this->Auth->user('id')) {
			throw new ForbiddenException('Not authorized to view this container.');
		}
		$this->set('container_slug', $container['Container']['slug']);
		$this->request->data['ContainerItem']['quantity'] = 1;
		$title_for_layout = $container['Container']['name'];
		$container_items = $this->Container->ContainerItem->getPaginatedContainerItems($this, $container['Container']['id']);
		$this->set(compact('container', 'container_items', 'title_for_layout'));
		$this->set('control', 'containers.view');
	}

	public function add() {
		$location_list = $this->Location->getLocationList($this->Auth->user('id'), true);
		$this->set(array(
			'title_for_layout' => __('Add New Container'),
			'location_list' => $location_list
		));
		if(!empty($this->request->data)) {
			$this->request->data['Container']['user_id'] = $this->Auth->user('id');
			if (!empty($this->request->data['Container']['location_id'])) {
				$this->request->data['Container']['location_id'] = $this->Location->getIdByUUID($this->request->data['Container']['location_id']);
			}
			$this->Container->set($this->request->data);
			$results = $this->Container->save();
			if($results) {
				$this->Session->setFlash('Successfully added new container', 'notification/success');
				$this->redirect(array('controller' => 'containers', 'action' => 'view', $results['Container']['slug']));
			} else {
				$this->Session->setFlash('There was a problem saving your container.', 'notification/error');
			}
		}
	}

	public function ajax_add($container_item_id) {
		$this->helpers[] = 'Time';
		$item = $this->Container->ContainerItem->find('first', array(
			'conditions' => array(
				'ContainerItem.id' => $container_item_id
			),
			'contain' => array()
		));
		$this->set(compact('item'));
	}

	public function edit($container_uuid='') {
		$this->isMobileDialog = true;
		if(!empty($container_uuid))
			$this->verifyUser($container_uuid);
		$name = $this->Container->field('name', array('uuid' => $container_uuid));
		$this->set('title_for_layout', "Edit $name");
		if(!empty($this->request->data)) {
			$this->verifyUser($this->request->data['Container']['uuid']);
			$this->request->data['Container']['id'] = $this->Container->getIdByUUID($this->request->data['Container']['uuid']);
			if($this->Container->save($this->request->data)) {
				$this->Session->setFlash(__('Successfully updated the container.'), 'notification/success');
				$this->redirect($this->referer());
			} else {
				$this->Session->setFlash(__('Unable to update the container.'), 'notification/error');
			}
		} else {
			$location_list = $this->Location->getLocationList($this->Auth->user('id'));
			$this->request->data = $this->Container->find('first', array(
				'conditions' => array('uuid' => $container_uuid),
				'contain' => array()
			));
			$this->request->data['Container']['name'] = $name;
			$this->request->data['Container']['uuid'] = $container_uuid;
			$this->set(compact('location_list'));
		}
	}

	public function delete($container_uuid) {
		if(empty($container_uuid)) {
			$this->Session->setFlash(__('Invalid container ID.'), 'notification/error');
			$this->redirect(array('controller' => 'containers', 'action' => 'index'));
		} else {
			$this->verifyUser($container_uuid);
			if($this->Container->delete($this->Container->getIdByUUID($container_uuid)))
				$this->Session->setFlash(__('Successfully deleted container and all contained items.'), 'notification/success');
			else
				$this->Session->setFlash(__('Error deleting container.'), 'notification/error');
			$this->redirect(array('controller' => 'containers', 'action' => 'index'));
		}
	}

	public function print_label($container_uuid) {
		$this->helpers[] = 'GChart.QR';
		$this->layout = 'print';
		$this->verifyUser($container_uuid);
		$this->set('container', $this->Container->find('first', array(
			'fields' => array('id', 'uuid', 'slug', 'name'),
			'conditions' => array('Container.uuid' => $container_uuid),
			'contain' => array()
		)));
	}

	public function export($container_uuid) {
		$this->helpers[] = 'Csv';
		$this->layout = false;
		$this->verifyUser($container_uuid);
		$data = $this->Container->find('first', array(
			'fields' => array('id', 'uuid', 'slug', 'name'),
			'conditions' => array('Container.uuid' => $container_uuid),
			'contain' => array(
				'ContainerItem.body',
				'ContainerItem.quantity',
				'ContainerItem.created',
				'ContainerItem.modified'
			)
		));
		$this->set(compact('data'));
	}

	public function bulk_print() {
		if(!empty($this->request->data)) {
			$this->helpers[] = 'GChart.QR';
			// Determine if any are checked
			$checked = array_flip($this->request->data['Container']['slug']);
			$unchecked = (boolean) count($checked) == 1 && !isset($checked['1']);
			if($unchecked) {
				$this->Session->setFlash(__('Please select containers to print labels.'), 'notification/error');
				$this->redirect(array('controller' => 'containers', 'action' => 'bulk_print', 'active' => 1));
			}
			$containers = $this->Container->find('all', array(
				'fields' => array('name', 'slug'),
				'conditions' => array(
					'slug' => array_keys(array_filter($this->request->data['Container']['slug']))
				),
				'contain' => array()
			));
			$this->set(compact('containers'));
			$this->layout = 'print';
			$this->render('bulk_print_result');
		} else {
			$this->Container->pagination_limit = 64;
			$control = 'containers.index';
			$containers = $this->Container->getPaginatedContainers($this, $this->Auth->user('id'));
			if(empty($containers)) {
				$this->Session->setFlash('Start by creating a container.', 'notification/notice');
				$this->redirect(array('action' => 'add'));
			}
			$this->set(compact('containers', 'control', 'container_view'));
		}
	}

}
