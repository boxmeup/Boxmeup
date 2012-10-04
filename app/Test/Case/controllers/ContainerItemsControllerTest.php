<?php
/* ContainerItems Test cases generated on: 2011-03-15 21:17:21 : 1300238241*/
App::import('Controller', 'ContainerItems');

class TestContainerItemsController extends ContainerItemsController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class ContainerItemsControllerTest extends CakeTestCase {
	var $fixtures = array('app.container_item', 'app.container', 'app.tag', 'app.user');

	function startTest() {
		$this->ContainerItems =& new TestContainerItemsController();
		$this->ContainerItems->constructClasses();
	}

	function endTest() {
		unset($this->ContainerItems);
		ClassRegistry::flush();
	}

}
?>