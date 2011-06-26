<?php

class ApiAppController extends AppController {
	
	public function beforeFilter() {
		parent::beforeFilter();
		if(empty($this->api_key)) {
			$this->api_key = !empty($this->params['url']['api_key']) ? $this->params['url']['api_key'] : '';
		}
		$this->user_id = ClassRegistry::init('Api.ApiUser')->getUserId($this->api_key);
		$this->setView();
	}

	public function beforeRender() {
		parent::beforeRender();
		if(empty($this->api_key))
			$this->set('output', array('error' => array('message' => 'No API Key provided.')));
		else if(empty($this->user_id))
			$this->set('output', array('error' => array('message' => 'Invalid API Key provided.')));
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
}