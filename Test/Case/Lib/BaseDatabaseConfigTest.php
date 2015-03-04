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
App::uses('BaseDatabaseConfig', 'Environment.Lib');

if (!defined('HTTP_HOST')) {
	define('HTTP_HOST', isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : 'localhost');
}
define('IS_CLI', php_sapi_name() === 'cli' && empty($_SERVER['REMOTE_ADDR']));

/**
 * Class BaseDatabaseConfigTest
 */
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
