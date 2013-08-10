<?php

class UsersController extends ApiAppController {

	public $name = 'Users';

	public $uses = array('User', 'Api.ApiUserApplication');

	public function beforeFilter() {
		$this->ApiAuth->allow('login');
		return parent::beforeFilter();
	}

	public function login() {
		$required = array('email' => true, 'password' => true, 'application' => true);
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
		try {
			$token = $this->ApiUserApplication->getTokenByUserId($user['User']['id'], $this->request->data['application']);
		} catch (NotFoundException $e) {
			// Token doesn't exist, create one
			$token = $this->ApiUserApplication->createApplication($this->request->data['application'], $user['User']['id']);
		}
		$this->jsonOutput(compact('token'));
	}

}
