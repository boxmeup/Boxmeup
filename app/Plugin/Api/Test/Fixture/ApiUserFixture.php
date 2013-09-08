<?php
/**
 * ApiUserFixture
 *
 */
class ApiUserFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
		'user_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'index'),
		'api_key' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 40, 'key' => 'index', 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
		'secret_key' => array('type' => 'string', 'null' => true, 'length' => 40, 'key' => 'index', 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
		'is_active' => array('type' => 'boolean', 'null' => false, 'default' => '1'),
		'created' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'modified' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),
			'user_id' => array('column' => 'user_id', 'unique' => 0),
			'api_key' => array('column' => 'api_key', 'unique' => 0),
			'secret_key' => array('column' => 'secret_key', 'unique' => 0)
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
			'user_id' => '3',
			'api_key' => 'd7504563a2e26a1970384974b44848576ca27b80',
			'secret_key' => 'c6d3085094354055d4a23f20c48a7bcfc2399c9b',
			'is_active' => 1,
			'created' => '2013-08-10 18:45:01',
			'modified' => '2013-08-10 18:45:01'
		),
	);

}
