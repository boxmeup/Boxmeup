<?php
/**
 * ContainerItemFixture
 *
 */
class ContainerItemFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
		'container_id' => array('type' => 'integer', 'null' => false, 'default' => '0', 'key' => 'index'),
		'uuid' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 36, 'key' => 'index', 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'body' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 100, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'quantity' => array('type' => 'integer', 'null' => false, 'default' => '1'),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'modified' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),
			'container' => array('column' => 'container_id', 'unique' => 0),
			'fk_container_items_containers1' => array('column' => 'container_id', 'unique' => 0),
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
			'id' => '119',
			'container_id' => '40',
			'uuid' => '52068a3c-0d50-40c4-8dca-085621210046',
			'body' => 'Test 1a',
			'quantity' => '1',
			'created' => '2013-08-10 18:45:16',
			'modified' => '2013-08-10 18:45:16'
		),
		array(
			'id' => '120',
			'container_id' => '40',
			'uuid' => '52068a40-6dd4-47ae-bbf9-085821210046',
			'body' => 'Test 1b',
			'quantity' => '1',
			'created' => '2013-08-10 18:45:20',
			'modified' => '2013-08-10 18:45:20'
		),
	);

}
