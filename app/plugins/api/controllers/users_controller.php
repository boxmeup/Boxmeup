<?php

class UsersController extends ApiAppController {

	public $name = 'Users';

	public $xml_set = 'users';

	public $uses = array('User');

	public function login() {
		$required = array('email' => true, 'password' => true);
		if(!$this->RequestHandler->isPost()) {
			$this->setError(405, 'Resource method supports only POST method.');
			return false;
		}
		if(array_intersect_key($required, $this->params['form']) != $required) {
			$this->setError(400, 'Missing required fields.');
		}
		if(!$this->User->verifyLogin($this->params['form']['email'], $this->params['form']['password'])) {
			$this->setError(403, 'Invalid email or password.');
			return false;
		}
		$api_key = $this->ApiUser->getApiKey($this->User->getUserIdByEmail($this->params['form']['email']));
		$secret_key = $this->ApiUser->getSecretKey($api_key);
		$this->output = compact('api_key', 'secret_key');
	}

}