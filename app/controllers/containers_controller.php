<?php
App::import('lib', array('Sanitize'));
class ContainersController extends AppController {

	public $name = 'Containers';

	public $layout = 'app';

	public $_secure = true;

	public $_container_page_limit = 20;

	public function beforeFilter() {
		parent::beforeFilter();
		$this->set('active', 'containers.index');
	}

	public function dashboard() {
		$total_containers = $this->Container->getTotalContainersPerUser($this->Auth->user('id'));
		$total_container_items = $this->Container->getTotalContainerItemsPerUser($this->Auth->user('id'));
		$this->set(compact('total_containers', 'total_container_items'));
		$this->set('active', 'containers.dashboard');
	}

	public function index() {
		$this->paginate = array(
			'conditions' => array(
				'Container.user_id' => $this->Session->read('Auth.User.id')
			),
			'contain' => array(),
			'limit' => $this->_container_page_limit
		);
		$this->set('containers', $this->paginate('Container'));
		$this->set('control', 'containers.index');
	}

	public function view($slug=null) {
		$container = $this->Container->find('first', array(
			'conditions' => array(
				'Container.slug' => $slug, 'Container.user_id' => $this->Auth->user('id')
			),
			'contain' => array(
				'ContainerItem'
			)
		));
		if(!empty($container)) {
			$this->verifyUser($container['Container']['id']);
			$this->set('container_slug', $container['Container']['slug']);
		}
		$this->set('container', $container);
		$this->set('control', 'containers.view');
	}

	public function add() {
		if(!empty($this->data)) {
			$this->data['Container']['user_id'] = $this->Session->read('Auth.User.id');
			$results = $this->Container->save($this->data);
			if($results) {
				$this->Session->setFlash('Successfully added new container', 'notification/success');
				$page = (int) ceil($this->Container->getTotalContainersPerUser($this->Session->read('Auth.User.id')) / $this->_container_page_limit);
				$this->redirect(array('controller' => 'containers', 'action' => 'view', $results['Container']['slug']));
			} else {
				$this->Session->setFlash('There was a problem saving your container.', 'notification/error');
			}
		}
		$this->set('control', 'containers.add');
	}

	public function delete($container_uuid) {
		if(empty($container_uuid)) {
			$this->Session->setFlash(__('Invalid container ID.', true), 'notification/error');
			$this->redirect(array('controller' => 'containers', 'action' => 'index'));
		} else {
			$this->verifyUser($container_uuid);
			if($this->Container->delete($this->Container->getIdByUUID($container_uuid)))
				$this->Session->setFlash(__('Successfully deleted container and all contained items.', true), 'notification/success');
			else
				$this->Session->setFlash(__('Error deleting container.', true), 'notification/error');
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

}
?>