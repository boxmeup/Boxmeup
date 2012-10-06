<?php
/* Feedback Test cases generated on: 2011-03-17 13:25:35 : 1300382735*/
App::import('Model', 'Feedback.Feedback');

class FeedbackTestCase extends CakeTestCase {
	var $fixtures = array('plugin.feedback.feedback');

	function startTest() {
		$this->Feedback =& ClassRegistry::init('Feedback');
	}

	function endTest() {
		unset($this->Feedback);
		ClassRegistry::flush();
	}

}
?>