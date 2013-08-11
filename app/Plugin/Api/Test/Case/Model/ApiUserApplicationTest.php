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

	public function testGetAllAuthenticatedApps() {
		$result = $this->ApiUserApplication->getAllAuthenticatedApps('3');
		$this->assertCount(2, $result);
		$expected = array(
			'ApiUserApplication' => array(
				'id' => '1',
				'user_id' => '3',
				'name' => 'Test Fixture App',
				'token' => 'testtoken',
				'created' => null
			)
		);
		$this->assertEquals($expected, $result[0]);
	}

	public function testGetUserByToken() {
		$result = $this->ApiUserApplication->getUserByToken('testtoken');
		$expected = array(
			'id' => '3',
			'email' => 'test@test.com',
			'uuid' => '52068a2c-00c4-40ba-baad-085321210046'
		);
		$this->assertEquals($expected, $result);
	}

	/**
	 * @expectedException NotFoundException
	 * @return void
	 */
	public function testRevokeTokenById() {
		$this->assertTrue($this->ApiUserApplication->revokeTokenById(1));
		$this->ApiUserApplication->getUserByToken('testtoken');
	}

}
