<?php
App::import('lib', array('Sanitize'));
class ContainersController extends ApiAppController {

	public $name = 'Containers';

	public $xml_set = 'containers';

	public $uses = array('Container');

	public function index() {
		$conditions = !empty($this->params['url']['slug']) ? array('slug' => $this->params['url']['slug']) : array();
		$this->output = $this->Container->getApiContainers($this->user_id, $conditions);
		if(empty($this->output)) {
			$this->apiError = 'No containers available.';
			$this->apiErrorCode = '404';
		}
	}
}