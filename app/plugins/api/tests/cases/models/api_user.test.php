<?php
/* ApiUser Test cases generated on: 2011-05-17 22:52:15 : 1305687135*/
App::import('Model', 'Api.ApiUser');

class ApiUserTestCase extends CakeTestCase {
	var $fixtures = array('');

	function startTest() {
		$this->ApiUser =& ClassRegistry::init('ApiUser');
	}

	function endTest() {
		unset($this->ApiUser);
		ClassRegistry::flush();
	}

}
?>