<?php
/**
 * LocationFixture
 *
 */
class LocationFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
		'user_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'index'),
		'uuid' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 36, 'key' => 'index', 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'name' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 40, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'is_mappable' => array('type' => 'boolean', 'null' => false, 'default' => '0'),
		'address' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 250, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'container_count' => array('type' => 'integer', 'null' => false, 'default' => '0'),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'modified' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),
			'user_id' => array('column' => 'user_id', 'unique' => 0),
			'uuid' => array('column' => 'uuid', 'unique' => 0)
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
			'id' => '4',
			'user_id' => '3',
			'uuid' => '52068a48-5cbc-4750-959c-085d21210046',
			'name' => 'Test Loc 1',
			'is_mappable' => 0,
			'address' => '',
			'container_count' => '0',
			'created' => '2013-08-10 18:45:28',
			'modified' => '2013-08-10 18:45:28'
		),
		array(
			'id' => '5',
			'user_id' => '3',
			'uuid' => '52068a56-7968-40af-a06c-085e21210046',
			'name' => 'Test Loc 2',
			'is_mappable' => 1,
			'address' => '123 Easy St',
			'container_count' => '0',
			'created' => '2013-08-10 18:45:42',
			'modified' => '2013-08-10 18:45:42'
		),
	);

}
