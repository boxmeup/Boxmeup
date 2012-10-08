<?php

class UsersController extends ApiAppController {

	public $name = 'Users';

	public $uses = array('User');

	public function beforeFilter() {
		$this->ApiAuth->allow('login');
		return parent::beforeFilter();
	}

	public function login() {
		$required = array('email' => true, 'password' => true);
		if(!$this->RequestHandler->isPost()) {
			throw new MethodNotAllowedException();
		}
		if(array_intersect_key($required, $this->request->data) != $required) {
			throw new BadRequestException('Missing required fields.');
		}
		if(!$this->User->verifyLogin($this->request->data['email'], $this->request->data['password'])) {
			throw new ForbiddenException();
		}
		$user = $this->User->getUserByEmail($this->request->data['email']);
		$user = array_intersect_key($user['User'], array('id' => true, 'email' => true, 'uuid' => true));
		$user['api_key'] = $this->ApiUser->getApiKey($user['id']);
		$user['secret_key'] = $this->ApiUser->getSecretKey($user['api_key']);
		$this->jsonOutput($user);
	}

}