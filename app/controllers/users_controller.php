<?php
class UsersController extends AppController {

	public $name = 'Users';

	/**
	 * Responsible for registering new users.
	 * Once registered, admins can do more changes and priveledges to this user.
	 */
	public function signup() {
		if(!empty($this->data)) {
			if($this->data['User']['password'] != Security::hash($this->data['User']['confirm_password'], Configure::read('Security.hash'), true))
				$this->Session->setFlash(__('Password confirmation does not match.'));
			else {
				$result = $this->User->save($this->data);
				if($result) {
					$this->Auth->login($result);
					$this->redirect('/');
				} else
					$this->Session->setFlash(__('There was a problem signing you up.', true));
			}
        }
		$this->data['User']['password'] = $this->data['User']['confirm_password'] = '';
	}

	public function login() {
		
	}

	public function logout() {
		$this->Auth->logout();
		$this->redirect('/');
	}

	public function account() {
		
	}

// ADMIN FUNCTION
	
	public function admin_login() {
		$this->render('login');
	}
	
	function admin_index() {
		$this->User->recursive = 0;
		$this->set('users', $this->paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid user', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('user', $this->User->read(null, $id));
	}

	function admin_add() {
		if (!empty($this->data)) {
			$this->User->create();
			if ($this->User->save($this->data)) {
				$this->Session->setFlash(__('The user has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.', true));
			}
		}
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid user', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if(!empty($this->data['User']['new_password']))
				$this->data['User']['password'] = Security::hash($this->data['User']['new_password'], Configure::read('Security.hash'), true);
			if ($this->User->save($this->data)) {
				$this->Session->setFlash(__('The user has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.', true));
			}
		} else {
			$this->data = $this->User->read(null, $id);
		}
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for user', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->User->delete($id)) {
			$this->Session->setFlash(__('User deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('User was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
?>