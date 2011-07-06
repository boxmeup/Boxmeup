<?php
App::import('lib', array('Sanitize'));
class SearchesController extends AppController {

	public $name = 'Searches';

	public $uses = array('Container', 'ContainerItem');

	public $layout = 'app';

	public $_secure = true;

	public function beforeFilter() {
		parent::beforeFilter();
		$this->helpers[] = 'Paginator';
		$this->set('active', 'containers.index');
	}

	public function find($query = null) {
		$this->helpers[] = 'Time';
		if(!empty($this->data)) {
			$this->redirect(array(
				'action' => 'find',
				isset($this->data['Search']['query']) ? urlencode($this->data['Search']['query']) : ''
			));
		}
		if(empty($query)) {
			if(!$this->isMobile()) {
				$this->Session->setFlash('Please specify a search term.', 'notification/notice');
				$this->redirect($this->referer());
			} else {
				$this->set('landed', true);
			}
		} else {
			$this->data['Search']['query'] = $query;
	
			$this->paginate = array(
				'search' => urldecode($query),
				'sphinx' => array(
					'matchMode' => SPH_MATCH_ALL,
					'index' => array('container_items', 'container_items_delta'),
					'sortMode' => array(SPH_SORT_TIME_SEGMENTS => 'created'),
				),
				'contain' => array('Container')
			);
	
			$this->paginate['sphinx']['filter'][] = array('user_id', $this->Auth->user('id'));
			$this->set('results', $this->paginate('ContainerItem'));
		}
		
		$this->set('active', 'container_items.index');
	}
}