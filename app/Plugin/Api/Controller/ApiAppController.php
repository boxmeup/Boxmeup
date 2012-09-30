<?php

class ApiAppController extends AppController {

	public $uses = array('Api.ApiUser');

	protected $hmacExempt = array(
		'Users' => 'login'
	);

	public function __construct() {
		Configure::write('Session.start', false);
		parent::__construct();
	}
	
	public function beforeFilter() {
		$this->Auth->allow();
		$this->setView();
		try {
			if(!Configure::read('Feature.api')) {
				throw new Exception('API currently unavailable.', 500);
			} else if ($this->isHmacExempt()) {
				CakeLog::write('debug', 'Request is hmac exempt.');
			} else if($this->ApiUser->isValidRequest($this->parseParams())) {
				$this->api_key = $this->getApiKeyParam();
				$this->user_id = $this->getUserId();
			} else {
				throw new Exception('Invalid HMAC key.', 401);
			}
		} catch (Exception $e) {
			$this->apiError = $e->getMessage();
			$this->apiErrorCode = $e->getCode();
		}
		$this->checkError(true);
	}

	public function beforeRender() {
		$this->checkError();
		if(!$this->isError()) {
			if(empty($this->api_key)) {
				$this->set('output', array(
					'results' => $this->output
				));
			} else {
				$dyn_key = sha1(date('c'));
				$this->set('output', array(
					'results' => $this->output,
					'dyn_key' => $dyn_key,
					'signature' => $this->ApiUser->generateSigniture($this->api_key, $dyn_key)
				));
			}
		}
	}
	
	protected function setView() {
		switch($this->params['url']['ext']) {
			case 'xml':
				$this->view = 'Xml';
				break;
			case 'json':
			default:
				$this->view = 'Json';
		}
	}

	protected function isHmacExempt() {
		return in_array($this->name, array_keys($this->hmacExempt)) && $this->hmacExempt[$this->name] === $this->action;
	}

	protected function isError() {
		return !empty($this->apiError);
	}

	protected function checkError($interrupt = false) {
		if($this->isError()) {
			$this->set('output', array(
				'error' => array(
					'message' => $this->apiError,
					'code' => $this->apiErrorCode
				)
			));
			if($interrupt) {
				$this->render();
				exit();
			}
		}
	}

	protected function setError($code = 404, $message = '') {
		$this->apiError = $message;
		$this->apiErrorCode = $code;
	}

	protected function getUserId() {
		$user_id = $this->ApiUser->getUserId($this->getApiKeyParam());
		if(empty($user_id)) {
			throw new Exception('Invalid api key.', 401);
		}
		return $user_id;
	}

	private function parseParams() {
		$params = $this->RequestHandler->isPost() ?
			$this->params['form'] :
			$this->params['url'];
		unset($params['ext'], $params['url']);
		return $params;
	}

	private function getApiKeyParam() {
		$params = $this->parseParams();
		return !empty($params['api_key']) ?
			$params['api_key'] :
			null;
	}
}