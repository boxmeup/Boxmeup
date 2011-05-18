<?php
/**
 * Outputs a view into json output.
 *
 * @author cjsaylor
 */
class XmlView extends View {

	public $output;

	private $xml_set;
	
	public function __construct(&$controller, $register = true) {
		parent::__construct($controller, $register);
		$this->output = isset($controller->viewVars['output']) ? $controller->viewVars['output'] : null;
		$this->xml_set = $controller->xml_set;

		if ($register)
			ClassRegistry::addObject('view', $this);
		Configure::write('debug', 0);
	}

	public function render($action = null, $layout = null, $file = null) {
		App::import('Helper', 'Xml');
		$this->Xml = new XmlHelper();
		header("Content-type: text/xml");
		echo $this->Xml->header();
		echo $this->output !== null ? 
			$this->Xml->serialize(array($this->xml_set => $this->output), array('format' => 'tags')) :
			$this->Xml->serialize(array('error' => array('response' => 'No data.')), array('format' => 'tags'));
		die();
	}
    
}
