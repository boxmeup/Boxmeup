<?php

class ApiAppController extends AppController {

	public $uses = array('Api.ApiUser');

	public $viewClass = 'Json';

	public $components = array('Api.ApiAuth');

	public function jsonOutput($data) {
		$this->set(array('data' => $data, '_serialize' => 'data'));
	}

}