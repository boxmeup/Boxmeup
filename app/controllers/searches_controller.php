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
			$this->set('results', $this->ContainerItem->searchContainers($this, $this->Auth->user('id'), urldecode($query)));
		}
		
		$this->set('active', 'container_items.index');
	}
}