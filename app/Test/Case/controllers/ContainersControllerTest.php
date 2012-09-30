<?php
/* Containers Test cases generated on: 2011-03-11 21:08:37 : 1299895717*/
App::import('Controller', 'Containers');

class TestContainersController extends ContainersController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class ContainersControllerTest extends CakeTestCase {
	var $fixtures = array('app.container', 'app.category', 'app.container_item', 'app.user');

	function startTest() {
		$this->Containers =& new TestContainersController();
		$this->Containers->constructClasses();
	}

	function endTest() {
		unset($this->Containers);
		ClassRegistry::flush();
	}

}
?>