<?php
/**
 * UserFixture
 *
 */
class UserFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
		'email' => array('type' => 'string', 'null' => false, 'length' => 60, 'key' => 'unique', 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'password' => array('type' => 'string', 'null' => false, 'length' => 60, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'uuid' => array('type' => 'string', 'null' => false, 'length' => 36, 'key' => 'index', 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'is_active' => array('type' => 'boolean', 'null' => false, 'default' => '1', 'key' => 'index'),
		'is_admin' => array('type' => 'boolean', 'null' => false, 'default' => '0'),
		'reset_password' => array('type' => 'boolean', 'null' => false, 'default' => '0'),
		'created' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'modified' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),
			'email' => array('column' => 'email', 'unique' => 1),
			'uuid' => array('column' => 'uuid', 'unique' => 0),
			'is_active' => array('column' => 'is_active', 'unique' => 0)
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_unicode_ci', 'engine' => 'InnoDB')
	);

/**
 * Records
 *
 * @var array
 */
	public $records = array(
		array(
			'id' => '3',
			'email' => 'test@test.com',
			'password' => 'c65470601d71b53402c41d709d0803477dd7c3cb',
			'uuid' => '52068a2c-00c4-40ba-baad-085321210046',
			'is_active' => 1,
			'is_admin' => 0,
			'reset_password' => 0,
			'created' => '2013-08-10 18:45:00',
			'modified' => '2013-08-10 18:45:00'
		),
	);

}
