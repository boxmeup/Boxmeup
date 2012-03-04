<?php
class UsersController extends AppController {

	const KEY_LOGIN_TIME = '-1 hours';

	public $name = 'Users';
	
	public $components = array('Email');
	
	public function beforeFilter() {
		$requires_auth = array(
			'account',
			'reset_password',
		);
		if(in_array($this->action, $requires_auth)) {
			$this->_secure = true;
		}
		parent::beforeFilter();
	}

	/**
	 * Responsible for registering new users.
	 * Once registered, admins can do more changes and priveledges to this user.
	 */
	public function signup() {
		if(!empty($this->data)) {
			if(empty($this->data['User']['confirm_password'])) {
				$result = $this->User->save($this->data);
				if($result) {
					$this->Auth->login($result);
					$this->redirect('/');
				} else {
					$this->Session->setFlash(__('There was a problem signing you up.', true), 'notification/error');
				}
			} else {
				$this->Session->setFlash('We think you\'re a bot. :(', 'notification/error');
				$this->redirect('/');
			}
        }
		$this->data['User']['password'] = '';
		$this->data['User']['confirm_password'] = '';
		$this->set('title_for_layout', __('Join Boxmeup', true));
	}

	public function login() {
		$this->set('title_for_layout', 'Login');
	}
	
	public function qr_login($api_key = null, $dyn_key = null, $hmac = null) {
		if(!empty($api_key)) {
			if(strtotime(base64_decode($dyn_key)) > strtotime(static::KEY_LOGIN_TIME)) {
				try {
					if(ClassRegistry::init('Api.ApiUser')->isValidRequest(compact('api_key', 'dyn_key', 'hmac'))) {
						$login_data = $this->User->find('first', array(
							'fields' => array('User.email', 'User.password'),
							'conditions' => array(
								'User.id' => ClassRegistry::init('Api.ApiUser')->getUserId($api_key)
							),
							'contain' => array()
						));
						$this->redirect($this->Auth->login($login_data) ? '/' : '/login');
					} else {
						throw new Exception("QR Code login key is invalid.");
					}
				} catch (Exception $e) {
					$this->Session->setFlash($e->getMessage(), 'notification/error');
					$this->redirect('/login');
				}
			} else {
				$this->Session->setFlash('QR Code authentication expired.', 'notification/error');
				$this->redirect('/login');
			}
		}
		$dyn_key = base64_encode(date('c'));
		$api_key = ClassRegistry::init('Api.ApiUser')->getApiKey($this->Auth->user('id'));
		$hmac = ClassRegistry::init('Api.ApiUser')->generateSigniture($api_key, $dyn_key);
		$this->set(compact('api_key', 'dyn_key', 'hmac'));

		$this->set('title_for_layout', 'Mobile Login');
	}

	public function logout() {
		$this->Auth->logout();
		$this->redirect('/');
	}

	public function account() {
		$this->layout = 'app';
		if(!empty($this->data)) {
			$this->data['User']['id'] = $this->Auth->user('id');
			if($this->data['User']['password'] === Security::hash('', null, true)) {
				unset($this->data['User']['password']);
			}
			if($this->User->save($this->data)) {
				$this->Session->setFlash(__('Successfully updated account settings.', true), 'notification/success');
				$this->redirect(array('action' => 'account'));
			} else {
				$this->Session->setFlash(__('Error updating account settings.', true), 'notification/error');
			}
		} else {
			$this->data['User']['email'] = $this->User->field('email', array('id' => $this->Auth->user('id')));
		}
		$api_key = ClassRegistry::init('Api.ApiUser')->getApiKey($this->Auth->user('id'));
		$secret_key = ClassRegistry::init('Api.ApiUser')->getSecretKey($api_key);
		$this->set(compact('api_key', 'secret_key'));
	}
	
	public function forgot_password() {
		if(!empty($this->data)) {
			if($this->User->verifyEmail($this->data['User']['email'])) {
				$new_password = $this->User->resetPassword($this->data['User']['email']);
				if($new_password) {
					$apiKey = ClassRegistry::init('Api.ApiUser')->getApiKey($this->User->getUserIdByEmail($this->data['User']['email']));
					$secretKey = ClassRegistry::init('Api.ApiUser')->getSecretKey($apiKey);
					$dynKey = base64_encode(date('c'));
					$hash = sha1($dynKey . $secretKey);
					$this->Email->to = $this->data['User']['email'];
					$this->Email->subject = 'Boxmeup Password Recovery';
					$this->Email->replyTo = 'no-reply@boxmeupapp.com';
					$this->Email->from = 'Boxmeup App <no-reply@boxmeupapp.com';
					$this->Email->template = 'forgot_password';
					$this->Email->sendAs = 'text';
					$this->set(array(
						'password' => $new_password,
						'api_key' => $apiKey,
						'dynamic_key' => $dynKey,
						'hash' => $hash
					));
					$this->Email->send();
				}
				$this->Session->setFlash(__('Successfully sent recovery request.', true), 'notification/success');
				$this->redirect('/login');
			} else {
				$this->Session->setFlash(__('Invalid or un-registered email address supplied.', true), 'notification/error');
			}
		}
	}
	
	public function reset_password() {
		if(!empty($this->data)) {
			if($this->User->verifyRecoveryKey($this->Auth->user('id'), $this->data['User']['recovery_key'])) {
				$this->data['User']['id'] = $this->Auth->user('id');
				$this->data['User']['reset_password'] = '0';
				$this->data['User']['password'] = $this->User->hashPassword($this->data['User']['password']);
				$result = $this->User->save($this->data);
				if($result) {
					$this->Session->setFlash(__('Successfully reset password.', true), 'notification/success');
					$this->Auth->login($this->User->read(null, $this->Auth->user('id')));
					$this->redirect('/');
				} else {
					$this->Session->setFlash(__('Error resetting password.', true), 'notification/error');
				}
			} else {
				$this->Session->setFlash(__('Verification key does not match what is on file.', true), 'notification/error');
			}
		}
	}
	
	public function dismiss_message() {
		$this->Cookie->write('message_dismissed' . Configure::read('Message.cookie_suffix'), 'hide', false, date('Y-m-d H:i:s', strtotime('+2 weeks')));
		$this->autoRender = false;
	}

	public function change_language($language = null) {
		if(!empty($language)) {
			$this->Cookie->write('language', $language, false, '1 week');
		}
		$this->redirect($this->referer());
	}
}