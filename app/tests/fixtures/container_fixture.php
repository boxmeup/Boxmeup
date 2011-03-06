<?php
/* Container Fixture generated on: 2011-03-02 23:11:31 : 1299125491 */
class ContainerFixture extends CakeTestFixture {
	var $name = 'Container';

	var $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'category_id' => array('type' => 'integer', 'null' => false, 'default' => '0', 'key' => 'index'),
		'user_Id' => array('type' => 'integer', 'null' => false, 'default' => '0', 'key' => 'index'),
		'name' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 36, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'slug' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 40, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'container_item_count' => array('type' => 'integer', 'null' => true, 'default' => '0', 'length' => 10),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'modified' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1), 'category' => array('column' => 'category_id', 'unique' => 0), 'user' => array('column' => 'user_Id', 'unique' => 0)),
		'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_swedish_ci', 'engine' => 'InnoDB')
	);

	var $records = array(
		array(
			'id' => 1,
			'category_id' => 1,
			'user_Id' => 1,
			'name' => 'Lorem ipsum dolor sit amet',
			'slug' => 'Lorem ipsum dolor sit amet',
			'container_item_count' => 1,
			'created' => '2011-03-02 23:11:31',
			'modified' => '2011-03-02 23:11:31'
		),
	);
}
?>