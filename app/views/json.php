<?php
/**
 * Outputs a view into json output.
 *
 * @author cjsaylor
 */
class JsonView extends View {

	public $output;

	public function __construct(&$controller, $register = true) {
		parent::__construct($controller, $register);
		$this->output = isset($controller->viewVars['output']) ? $controller->viewVars['output'] : null;
		if ($register)
			ClassRegistry::addObject('view', $this);
		Configure::write('debug', 0);
	}

	public function render($action = null, $layout = null, $file = null) {
		header("Content-type: application/json");
		echo !empty($this->output) ? json_encode($this->output) : json_encode(array('error' => array('message' => 'No data.')));
		die();
	}
    
}
