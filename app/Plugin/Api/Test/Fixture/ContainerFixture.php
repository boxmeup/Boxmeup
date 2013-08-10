<?php
/**
 * ContainerFixture
 *
 */
class ContainerFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
		'user_id' => array('type' => 'integer', 'null' => false, 'default' => '0', 'key' => 'index'),
		'location_id' => array('type' => 'integer', 'null' => true, 'default' => '0', 'key' => 'index'),
		'uuid' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 36, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'name' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 36, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'slug' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 40, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'container_item_count' => array('type' => 'integer', 'null' => true, 'default' => '0', 'length' => 10),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'modified' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),
			'user' => array('column' => 'user_id', 'unique' => 0),
			'fk_containers_users' => array('column' => 'user_id', 'unique' => 0),
			'location_id' => array('column' => 'location_id', 'unique' => 0)
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
	);

/**
 * Records
 *
 * @var array
 */
	public $records = array(
		array(
			'id' => '40',
			'user_id' => '3',
			'location_id' => '0',
			'uuid' => '52068a36-5f88-485a-b7f3-085521210046',
			'name' => 'Test 1',
			'slug' => 'test-1',
			'container_item_count' => '2',
			'created' => '2013-08-10 18:45:10',
			'modified' => '2013-08-10 18:45:10'
		),
	);

}
