<?php
class AppController extends Controller {
	public $components = array(
		'Auth',
		'RequestHandler',
		'Session',
		'Cookie'
	);
	public $helpers = array('Html', 'Form', 'Session', 'Paginator');

	public $availableLanguages = array(
		'eng' => 'English',
		'spa' => 'Spanish',
		'deu' => 'German',
		'jpn' => 'Japanese'
	);

	protected $ssl = array();

	public $_secure = false;

	/**
	 * Should the dialog theme load in mobile operations.
	 *
	 * @var boolean
	 */
	protected $isMobileDialog = false;

	public function beforeFilter() {
		parent::beforeFilter();

		$this->setupAuth();
		$this->checkSsl();
		$user_id = $this->Auth->user('id');
		if(!empty($user_id)) {
			// If a password reset is required, force redirect to reset_password
			$reset_exceptions = array('reset_password', 'logout');
			if($this->Auth->user('reset_password') && !in_array($this->request->action, $reset_exceptions))
				$this->redirect(array('controller' => 'users', 'action' => 'reset_password'));
		}

		// Check for mobile feature for mobile requests
		if($this->isMobile() && !Configure::read('Feature.mobile')) {
			$this->render(null, null, 'mobile_disabled');
		}

		// Determine language preference
		if($this->Cookie->read('language')) {
			Configure::write('Config.language', $this->Cookie->read('language'));
		}
	}

	public function beforeRender() {
		$this->set(array(
			'User' => $this->Auth->user(),
			'Webroot' => $this->request->webroot,
			'Fullwebroot' => FULL_BASE_URL,
			'Here' => $this->request->here,
			'ajaxRequest' => $this->RequestHandler->isAjax()? '1' : '0',
			'message_dismissed' => $this->Cookie->read('message_dismissed' . Configure::read('Message.cookie_suffix')) == 'hide',
			'availableLanguages' => $this->availableLanguages
		));
		
		if(Configure::read('Site.theme')) {
			$this->view = 'Theme';
			$this->theme = Configure::read('Site.theme');
		}

		$this->setupMobile();
	}

	/**
	 * Setup the authentication component.
	 */
	private function setupAuth() {
		Security::setHash(Configure::read('Security.hash'));
		$this->Auth->authenticate = array(
			'Form' => array(
				'scope' => array('User.is_active' => 1),
				'fields' => array('username' => 'email', 'password' => 'password')
			)
		);
		$this->Auth->loginAction = '/login';
		$this->Auth->loginRedirect = '/dashboard';
		$this->Auth->logoutRedirect = '/';
		$this->Auth->authError = 'You must sign in to continue.';
		$this->Auth->flash = array('element' => 'notification/error', 'key' => 'auth', 'params' => array());
		$this->Auth->fields = array(
			'username' => 'email',
			'password' => 'password'
		);

		if($this->isMobile()) {
			$this->Auth->loginRedirect = '/containers';
		}

		if($this->_secure)
			$this->Auth->deny();
		else
			$this->Auth->allow();
	}

	protected function checkSsl() {
		if (!Configure::read('Feature.https_redirect')) {
			return;
		}
		if ($this->request->action == 'logout' || !$this->RequestHandler->isGet()) {
			return;
		}
		if (in_array($this->request->action, $this->ssl)) {
			if (env('https') !== 'on') {
				$redirect = 'https://' . env('SERVER_NAME') . $this->request->here;
				CakeLog::write('debug', 'SSL redirecting to: ' . $redirect);
				$this->redirect($redirect);
			}
		} elseif (env('https') === 'on') {
			$redirect = 'http://' . env('SERVER_NAME') . $this->request->here;
			CakeLog::write('debug', 'NON-SSL redirecting to: ' . $redirect);
			$this->redirect($redirect);
		}
	}

	protected function setupMobile() {
		if($this->isMobile()) {
			$this->theme = Configure::read('Site.mobile_theme') ?
				Configure::read('Site.mobile_theme') :
				'mobile';
			$this->layout = $this->RequestHandler->isAjax() && $this->isMobileDialog ? 'dialog' : 'mobile';
			$this->autoLayout = true;
			$this->autoRender = true;
			$this->set('mobile_page_id', $this->name.$this->request->action);
		}
	}

	/**
	 * Verifies the current user can perform sensitive actions on container.
	 * @deprecated
	 * @param <mixed> $id Can be either integer ID or UUID
	 */
	protected function verifyUser($id, $user_id = null) {
		if(strstr($id, '-') !== false)
			$id = ClassRegistry::init('Container')->getIdByUUID($id);
		if(!ClassRegistry::init('Container')->verifyContainerUser($id, empty($user_id) ? $this->Auth->user('id') : $user_id)) {
			if($this->RequestHandler->isAjax())
				return false;
			$this->Session->setFlash(__('Not authorized to perform actions on this container'), 'notification/error');
			$this->redirect(array(
				'controller' => 'containers',
				'action' => 'index'
			));
		}
		return true;
	}

	protected function verifyUserV2($id, $user_id = null, $type = 'Container') {
		if(strstr($id, '-') !== false) {
			$id = ClassRegistry::init($type)->getIdByUUID($id);
		}
		if(!ClassRegistry::init($type)->verifyUser($id, empty($user_id) ? $this->Auth->user('id') : $user_id)) {
			if($this->RequestHandler->isAjax())
				return false;
			$this->Session->setFlash(__('Not authorized to perform actions on this object.'), 'notification/error');
			$this->redirect(array(
				'controller' => strtolower(Inflector::pluralize($type)),
				'action' => 'index'
			));
		}
		return true;
	}

	/**
	 * Determines if the client is a mobile device.
	 * 
	 * @return <boolean>
	 */
	protected function isMobile() {
		return $this->RequestHandler->isMobile() && !$this->Session->read('mobile_disabled');
	}
}
