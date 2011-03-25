<?php
/* Communitcate Test cases generated on: 2011-03-17 13:29:47 : 1300382987*/
App::import('Controller', 'Feedback.Communitcate');

class TestCommunitcateController extends CommunitcateController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class CommunitcateControllerTestCase extends CakeTestCase {
	function startTest() {
		$this->Communitcate =& new TestCommunitcateController();
		$this->Communitcate->constructClasses();
	}

	function endTest() {
		unset($this->Communitcate);
		ClassRegistry::flush();
	}

}
?>