<?php
class SearchesController extends AppController {

	public $name = 'Searches';

	public $uses = array();

	public $layout = 'app';

	public $_secure = true;

	public function beforeFilter() {
		parent::beforeFilter();
		$this->helpers[] = 'Paginator';
		$this->set('active', 'containers.index');
	}

	public function find() {
		if(!empty($this->data)) {
			$this->redirect(array(
				'action' => 'find',
				isset($this->data['Search']['query']) ? urlencode($this->data['Search']['query']) : '',
				't' => isset($this->data['Search']['category']) ? urlencode($this->data['Search']['category']) : '',
			));
		}
	}
}