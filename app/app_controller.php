<?php
class AppController extends Controller {
	public $view = 'Theme';
	public $theme = 'default';

	public $components = array('Auth', 'RequestHandler', 'Session', 'Cookie', 'Security', 'DebugKit.Toolbar');
	public $helpers = array('Html', 'Form', 'Session');

	public $_secure = false;

	public function beforeFilter() {
		$this->setupConfig();
		$this->setupAuth();
	}

	/**
	 * Read configuration data from the cache or database.
	 */
	private function setupConfig() {
		// Read the configuration from the cache if available
		$cache_key = 'configuration_settings';
		if (!$cache_data = Cache::read($cache_key)) {
			$configuration = ClassRegistry::init('Configuration')->find('all', array(
				'fields' => array('name', 'value')
			));
			Cache::write($cache_key, $configuration, 'short');
		} else {
			$configuration = $cache_data;
		}

		// Loop through the configuration and set the configuration up for each key => value
		foreach($configuration as $config)
			Configure::write($config['Configuration']['name'], $config['Configuration']['value']);
	}

	/**
	 * Setup the authentication component.
	 */
	public function setupAuth() {
		Security::setHash('sha1');

		$this->Auth->userModel = 'User';
		$this->Auth->loginAction = '/login';
		$this->Auth->loginRedirect = '/';
		$this->Auth->logoutRedirect = '/';
		$this->Auth->loginError = 'No username and password was found with that combination';

		$this->Auth->fields = array(
			'username' => 'email',
			'password' => 'password'
		);

		if($this->_secure)
			$this->Auth->deny();
		else
			$this->Auth->allow();

	}
}
