<?php
/* Configurations Test cases generated on: 2011-02-19 22:34:36 : 1298172876*/
App::import('Controller', 'Configurations');

class TestConfigurationsController extends ConfigurationsController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class ConfigurationsControllerTest extends CakeTestCase {
	var $fixtures = array('app.configuration');

	function startTest() {
		$this->Configurations =& new TestConfigurationsController();
		$this->Configurations->constructClasses();
	}

	function endTest() {
		unset($this->Configurations);
		ClassRegistry::flush();
	}

	function testAdminIndex() {

	}

	function testAdminView() {

	}

	function testAdminAdd() {

	}

	function testAdminEdit() {

	}

	function testAdminDelete() {

	}

}
?>