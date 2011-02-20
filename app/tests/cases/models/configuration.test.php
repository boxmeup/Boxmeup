<?php
/* Configuration Test cases generated on: 2011-02-19 21:11:21 : 1298167881*/
App::import('Model', 'Configuration');

class ConfigurationTestCase extends CakeTestCase {
	var $fixtures = array('app.configuration');

	function startTest() {
		$this->Configuration =& ClassRegistry::init('Configuration');
	}

	function endTest() {
		unset($this->Configuration);
		ClassRegistry::flush();
	}

}
?>