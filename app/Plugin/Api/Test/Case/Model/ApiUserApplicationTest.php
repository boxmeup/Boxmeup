<?php
App::uses('ApiUserApplication', 'Api.Model');

/**
 * ApiUserApplication Test Case
 *
 */
class ApiUserApplicationTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'plugin.api.api_user_application',
		'plugin.api.user',
		'plugin.api.container',
		'plugin.api.location',
		'plugin.api.container_item'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->ApiUserApplication = ClassRegistry::init('Api.ApiUserApplication');
		$this->testAppToken = $this->ApiUserApplication->createApplication('Test App', '3');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->ApiUserApplication);
		unset($this->testAppToken);
		Cache::clear();
		parent::tearDown();
	}

/**
 * testCreateApplication method
 *
 * @return void
 */
	public function testCreateApplication() {
		$result = $this->ApiUserApplication->createApplication('Test New App 1', '3');
		$this->assertNotEmpty($result);
		$this->assertEquals($result, $this->ApiUserApplication->createApplication('Test New App 1', '3'));
	}

/**
 * testGetTokenByUserId method
 *
 * @return void
 */
	public function testGetTokenByUserId() {
		$this->assertEquals($this->testAppToken, $this->ApiUserApplication->getTokenByUserId('3', 'Test App'));
	}

}
