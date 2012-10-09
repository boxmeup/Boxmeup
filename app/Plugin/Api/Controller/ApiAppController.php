<?php

class ApiAppController extends AppController {

	public $uses = array('Api.ApiUser');

	public $viewClass = 'Json';

	public $components = array('Api.ApiAuth');

	protected $userId;

	public function jsonOutput($data) {
		$this->set(array('data' => $data, '_serialize' => 'data'));
	}

	public function getUserId() {
		if (empty($this->userId)) {
			$this->userId = $this->ApiUser->getUserId($this->request->data['ApiUser']['api_key']);
		}
		return $this->userId;
	}

}