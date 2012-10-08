<?php

App::uses('ExceptionRenderer', 'Error');

class ApiExceptionRenderer extends ExceptionRenderer {

	public function error400($error) {
		$this->controller->viewClass = 'Json';
		parent::error400($error);
	}

	public function error500($error) {
		$this->controller->viewClass = 'Json';
		parent::error500($error);
	}
	
}