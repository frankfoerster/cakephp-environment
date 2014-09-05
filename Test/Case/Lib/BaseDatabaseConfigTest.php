<?php
App::uses('BaseDatabaseConfig', 'Environment.Lib');
if (!defined('HTTP_HOST')) {
	define('HTTP_HOST', isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : 'localhost');
}
define('IS_CLI', php_sapi_name() === 'cli' && empty($_SERVER['REMOTE_ADDR']));

class BaseDatabaseConfigTest extends CakeTestCase {

	/**
	 * @var TEST_DATABASE_CONFIG
	 */
	public $Config;

	public function setUp() {
		parent::setUp();
		$this->Config = new TEST_DATABASE_CONFIG();
	}

	public function testConfig() {
		$this->assertInstanceOf('TEST_DATABASE_CONFIG', $this->Config);
	}

	public function testCurrent() {
		$this->assertEquals('local', $this->Config->default['name']);

		// from BaseDatabaseConfig::_defaults
		$this->assertEquals('utf8', $this->Config->default['encoding']);

		// test env
		$this->assertEquals('testconfig', $this->Config->test['name']);
		$this->assertEquals('zzz_', $this->Config->test['prefix']);
		$this->assertEquals('utf8', $this->Config->test['encoding']);
	}

}

class TEST_DATABASE_CONFIG extends BaseDatabaseConfig {

	public $default = array(
		'name' => 'local'
	);

	public $test = array(
		'name' => 'testconfig',
		'merge' => true
	);
}
