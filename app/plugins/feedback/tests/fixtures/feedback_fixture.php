<?php
/* Feedback Fixture generated on: 2011-03-17 13:25:05 : 1300382705 */
class FeedbackFixture extends CakeTestFixture {
	var $name = 'Feedback';
	var $table = 'feedback';

	var $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'user_id' => array('type' => 'integer', 'null' => false, 'default' => '0', 'key' => 'index'),
		'user_agent' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 45, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'location_uri' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 45, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'feedback_type' => array('type' => 'string', 'null' => true, 'default' => 'bug', 'length' => 15, 'collate' => 'latin1_swedish_ci', 'comment' => 'Type of feedback: bug or feature', 'charset' => 'latin1'),
		'message' => array('type' => 'text', 'null' => true, 'default' => NULL, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'ip_address' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 40, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => NULL, 'key' => 'index'),
		'modified' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1), 'User' => array('column' => 'user_id', 'unique' => 0), 'time' => array('column' => 'created', 'unique' => 0)),
		'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_swedish_ci', 'engine' => 'InnoDB')
	);

	var $records = array(
		array(
			'id' => 1,
			'user_id' => 1,
			'user_agent' => 'Lorem ipsum dolor sit amet',
			'location_uri' => 'Lorem ipsum dolor sit amet',
			'feedback_type' => 'Lorem ipsum d',
			'message' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
			'ip_address' => 'Lorem ipsum dolor sit amet',
			'created' => '2011-03-17 13:25:05',
			'modified' => '2011-03-17 13:25:05'
		),
	);
}
?>