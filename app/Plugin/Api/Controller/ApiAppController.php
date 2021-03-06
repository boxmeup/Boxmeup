<?php

class ApiAppController extends AppController {

	public $uses = array('Api.ApiUser', 'Api.ApiUserApplication');

	public $viewClass = 'Json';

	public $components = array('Api.ApiAuth');

	protected $userId;

	public function beforeFilter() {
		// Turn off application redirects for https
		Configure::write('Feature.https_redirect', false);
		parent::beforeFilter();
		if (!Configure::read('Feature.api')) {
			throw new NotImplementedException('API is currently unavailable.', 503);
		}
	}

	public function jsonOutput($data) {
		$this->set(array('data' => $data, '_serialize' => 'data'));
	}

	public function getUserId() {
		return $this->request->data['User']['id'];
	}

}
