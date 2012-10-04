<?php
/* User Test cases generated on: 2011-02-19 18:01:45 : 1298156505*/
App::import('Model', 'User');

class UserTest extends CakeTestCase {
	var $fixtures = array('app.user');

	function startTest() {
		$this->User =& ClassRegistry::init('User');
	}

	function endTest() {
		unset($this->User);
		ClassRegistry::flush();
	}

}
?>