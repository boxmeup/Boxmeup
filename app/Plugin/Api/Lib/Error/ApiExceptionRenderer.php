<?php

App::uses('ExceptionRenderer', 'Error');

class ApiExceptionRenderer extends ExceptionRenderer {

	public function error400($error) {
		if (Router::currentRoute()->options['plugin']) {
			$this->controller->viewClass = 'Json';
		}
		parent::error400($error);
	}

	public function error500($error) {
		if (Router::currentRoute()->options['plugin']) {
			$this->controller->viewClass = 'Json';
		}
		parent::error500($error);
	}
	
}
