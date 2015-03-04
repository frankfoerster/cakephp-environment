<?php
/**
 * Copyright (c) Frank Förster (http://frankfoerster.com)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Frank Förster (http://frankfoerster.com)
 * @author Frank Förster <frank at frankfoerster.com>
 * @link https://github.com/frankfoerster/cakephp-environment CakePHP Environment Plugin
 * @license http://www.opensource.org/licenses/mit-license.php MIT License
 */
App::uses('Environments', 'Environment.Lib');

/**
 * Class EnvironmentsTestWrapper
 *
 * Wraps the Environments Lib functionality for testing purposes.
 */
class EnvironmentsTestWrapper extends Environments {

	public static function getEnvPath() {
		$instance = self::getInstance();
		return $instance->_envPath;
	}

	public static function getEnvironment() {
		$instance = self::getInstance();
		return $instance->_getEnvironment();
	}

	public static function prepareTestEnvironments() {
		$instance = self::getInstance();
		$instance->_environments = array(
			'test' => array(
				'key' => 'val'
			),
			'testing' => array(
				'domain' => array(
					'test.com'
				),
				'path' => array(
					APP
				)
			)
		);
	}

	public static function getDbConfig($env) {
		self::prepareTestEnvironments();
		self::$forceEnvironment = $env;
		$instance = self::getInstance();
		$instance->_current = $env;
		$instance->_dbConfig[$env] = array(
			'testKey' => 'testVal'
		);
		return self::getEnvironmentDbConfig();
	}

	public static function setEnv($env) {
		$instance = self::getInstance();
		$instance->_current = $env;
	}

}

/**
 * Class EnvironmentsTest
 */
class EnvironmentsTest extends CakeTestCase {

	public function setUp() {

		parent::setUp();
	}

	public function tearDown() {
		Environments::tearDown();

		parent::tearDown();
	}

	public function testConstruct() {
		$this->assertEquals(APP . 'Config' . DS . 'Environment', EnvironmentsTestWrapper::getEnvPath());
	}

	public function testGetInstance() {
		$this->assertInstanceOf('Environments', Environments::getInstance());
	}

	public function testGetEnvironment() {
		$_SERVER['HTTP_HOST'] = 'localhost';
		$this->assertEquals('local', EnvironmentsTestWrapper::getEnvironment());

		Environments::tearDown();
		Environments::$forceEnvironment = 'live';
		Environments::init();

		$this->assertEquals('live', EnvironmentsTestWrapper::getEnvironment());
	}

	/**
	 * @expectedException Exception
	 */
	public function testEnvironmentNotFoundThrowsException() {
		Environments::tearDown();
		Environments::$forceEnvironment = 'not_existant_env';
		Environments::init();
	}

	public function testHostEnvironmentDetection() {
		Environments::tearDown();
		EnvironmentsTestWrapper::prepareTestEnvironments();

		$backup = isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : 'localhost';
		$_SERVER['HTTP_HOST'] = 'test.com';
		$this->assertEquals('testing', EnvironmentsTestWrapper::getEnvironment());

		$_SERVER['HTTP_HOST'] = $backup;
	}

	public function testPathEnvironmentDetection() {
		Environments::tearDown();
		EnvironmentsTestWrapper::prepareTestEnvironments();
		$this->assertEquals('testing', EnvironmentsTestWrapper::getEnvironment());
	}

	public function testEnvironmentLoadsDbConfig() {
		EnvironmentsTestWrapper::init();
		$config = EnvironmentsTestWrapper::getEnvironmentDbConfig();
		$this->assertEquals('localhost', $config['host']);

		EnvironmentsTestWrapper::tearDown();
		$config = EnvironmentsTestWrapper::getDbConfig('test');
		$this->assertEquals('testVal', $config['testKey']);

		EnvironmentsTestWrapper::tearDown();
		$config = EnvironmentsTestWrapper::getDbConfig(null);
		$this->assertEmpty($config);
	}

	public function testGetCurrentEnvironment() {
		EnvironmentsTestWrapper::setEnv('current');
		$this->assertEquals('current', EnvironmentsTestWrapper::getCurrentEnvironment());
	}

}
