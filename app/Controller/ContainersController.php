<?php
App::uses('Sanitize', 'Utility');
class ContainersController extends AppController {

	public $name = 'Containers';

	public $layout = 'app';

	public $_secure = true;

	public function beforeFilter() {
		parent::beforeFilter();
		$this->set('active', 'containers.index');
	}

	public function dashboard() {
		$this->helpers[] = 'Time';
		$this->helpers[] = 'GChart.GChart';
		$total_containers = $this->Container->getTotalContainersPerUser($this->Auth->user('id'));
		$total_container_items = $this->Container->getTotalContainerItemsPerUser($this->Auth->user('id'));
		$total_locations = ClassRegistry::init('Location')->getTotalLocationsPerUser($this->Auth->user('id'));

		// Recent items
		$recent_items = $this->Container->ContainerItem->getRecentItems($this->Auth->user('id'));

		$this->set(compact('total_containers', 'total_container_items', 'total_locations', 'recent_items'));
		$this->set('active', 'containers.dashboard');
		
		// Graph stats
		$container_stats = Set::combine($this->Container->find('all', array(
			'fields' => array('COUNT(id) AS containers', 'DATE(modified) AS timestamp'),
			'conditions' => array(
				'user_id' => $this->Auth->user('id'),
				'modified > ' => date('Y-m-d 23:59:59', strtotime('-1 week'))
			),
			'group' => 'timestamp',
			'order' => 'timestamp',
			'contain' => array()
		)), '{n}.0.timestamp', '{n}.0');
		$container_item_stats = Set::combine($this->Container->ContainerItem->find('all', array(
			'fields' => array('COUNT(ContainerItem.id) as items', 'DATE(ContainerItem.modified) AS timestamp'),
			'conditions' => array(
				'Container.user_id' => $this->Auth->user('id'),
				'ContainerItem.modified > ' => date('Y-m-d 23:59:59', strtotime('-1 week'))
			),
			'group' => 'timestamp',
			'order' => 'timestamp',
			'contain' => array('Container')
		)), '{n}.0.timestamp', '{n}.0');
		for($current = date('Y-m-d', strtotime('-1 week')); $current <= date('Y-m-d'); $current = date('Y-m-d', strtotime("$current +1 day")))
			$graph_data[$current] = array();

		$container_data = Set::merge($graph_data, $container_stats, $container_item_stats);
		ksort($container_data);
		$graph_data = array();
		foreach($container_data as $date => $data)
			$graph_data[] = array($date, isset($data['containers'])? $data['containers'] : 0, isset($data['items']) ? $data['items'] : 0);

		$container_graph = array(
			'labels' => array(
				array('string' => __('Date')),
				array('number' => __('Containers')),
				array('number' => __('Items'))
			),
			'data' => $graph_data,
			'title' => __('Container activity for last 7 days'),
			'type' => 'line',
			'width' => 650,
		);
		$this->set(compact('container_graph'));
		$this->set('active', 'containers.dashboard');
	}

	public function dashboard_graph() {
		$this->redirect('/dashboard');
	}

	public function index() {
		$this->helpers[] = 'Time';
		$control = 'containers.index';
		$containers = $this->Container->getPaginatedContainers($this, $this->Auth->user('id'));
		if(empty($containers) && empty($this->request->params['named']['location'])) {
			$this->Session->setFlash('Start by creating a container.', 'notification/notice');
			$this->redirect(array('action' => 'add'));
		}
		
		// Check the cookie and render the view depending on what was selected
		$container_view = $this->Session->read('Feature.change_view');
		$location_list = ClassRegistry::init('Location')->getLocationList($this->Auth->user('id'), true);
		$this->set(compact('containers', 'control', 'container_view', 'location_list'));
		$this->request->data['Location']['uuid'] = !empty($this->request->params['named']['location']) ? $this->request->params['named']['location'] : null;
		if($container_view === 'list')
			$this->render('index.table');
	}
	
	public function change_view($view) {
		//if($this->RequestHandler->isAjax()) {
		//	Configure::write('debug', 0);
		//}
		$this->Session->write('Feature.change_view', $view == 'list' ? 'list' : 'grid');
		$this->redirect($this->referer());
	}

	public function view($slug=null) {
		$this->helpers[] = 'Time';
		$container = $this->Container->getContainerBySlug($slug, $this->Auth->user('id'));
		if(!empty($container)) {
			$this->verifyUser($container['Container']['id']);
			$this->set('container_slug', $container['Container']['slug']);
			$this->request->data['ContainerItem']['quantity'] = 1;
		}
		$title_for_layout = $container['Container']['name'];
		$container_items = $this->Container->ContainerItem->getPaginatedContainerItems($this, $container['Container']['id']);
		$this->set(compact('container', 'container_items', 'title_for_layout'));
		$this->set('control', 'containers.view');
	}

	public function add() {
		if(!empty($this->request->data)) {
			$this->request->data['Container']['user_id'] = $this->Auth->user('id');
			$results = $this->Container->save($this->request->data);
			if($results) {
				$this->Session->setFlash('Successfully added new container', 'notification/success');
				$page = (int) ceil($this->Container->getTotalContainersPerUser($this->Auth->user('id')) / $this->Container->pagination_limit);
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
		if(!empty($container_uuid))
			$this->verifyUser($container_uuid);
		$name = $this->Container->field('name', array('uuid' => $container_uuid));
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
			$location_list = ClassRegistry::init('Location')->getLocationList($this->Auth->user('id'));
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
