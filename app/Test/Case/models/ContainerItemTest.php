<?php
/* ContainerItem Test cases generated on: 2011-03-02 23:15:01 : 1299125701*/
App::import('Model', 'ContainerItem');

class ContainerItemTest extends CakeTestCase {
	var $fixtures = array('app.container_item', 'app.container', 'app.category');

	function startTest() {
		$this->ContainerItem =& ClassRegistry::init('ContainerItem');
	}

	function endTest() {
		unset($this->ContainerItem);
		ClassRegistry::flush();
	}

}
?>