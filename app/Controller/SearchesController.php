<?php
App::uses('Sanitize', 'Utility');
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
		if(!empty($this->request->data)) {
			$this->redirect(array(
				'action' => 'find',
				isset($this->request->data['Search']['query']) ? urlencode($this->request->data['Search']['query']) : ''
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
			$this->request->data['Search']['query'] = $query;
			$this->set('results', $this->ContainerItem->searchContainers($this, $this->Auth->user('id'), urldecode($query)));
		}
		
		$this->set('active', 'container_items.index');
	}

	public function auto_find() {
		$this->view = 'Json';
		$output = array('No results.');
		if (!empty($this->request->query['term'])) {
			$this->ContainerItem->pagination_limit = 10;
			$items = $this->ContainerItem->searchContainers($this, $this->Auth->user('id'), urldecode($this->request->query['term']));
			$output = Set::extract('/ContainerItem/body', $items);
		}
		$this->set('output', $output);
	}
}