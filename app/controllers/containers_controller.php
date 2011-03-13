<?php
class ContainersController extends AppController {

	public $name = 'Containers';

	public $layout = 'app';

	public $_secure = true;

	public function beforeFilter() {
		parent::beforeFilter();
		$this->set('active', 'containers.index');
	}

	public function dashboard() {
		$this->set('active', 'containers.dashboard');
	}

	public function index() {
		$this->paginate = array(
			'conditions' => array(
				'Container.user_id' => $this->Session->read('Auth.User.id')
			),
			'contain' => array(),
			'limit' => 20
		);
		$this->set('containers', $this->paginate('Container'));
		$this->set('controls', 'container_index');
	}

	public function add() {
		if(!empty($this->data)) {
			$this->data['Container']['user_id'] = $this->Session->read('Auth.User.id');
			if($this->Container->save($this->data)) {
				$this->Session->setFlash('Successfully added new container');
				$this->redirect(array('controller' => 'containers', 'action' => 'index'));
			} else {
				$this->Session->setFlash('There was a problem saving your container.');
			}
		}
		$this->set('controls', 'container_add');
	}

}
?>