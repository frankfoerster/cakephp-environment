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
App::uses('BaseEmailConfig', 'Environment.Lib');

if (!defined('HTTP_HOST')) {
    define('HTTP_HOST', isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : 'localhost');
}
if (!defined('IS_CLI')) {
    define('IS_CLI', php_sapi_name() === 'cli' && empty($_SERVER['REMOTE_ADDR']));
}

/**
 * Class BaseDatabaseConfigTest
 */
class BaseEmailConfigTest extends CakeTestCase
{

    /**
     * @var TEST_EMAIL_CONFIG
     */
    public $Config;

    public function setUp()
    {
        parent::setUp();
        $this->Config = new TEST_EMAIL_CONFIG();
    }

    public function testConfig()
    {
        $this->assertInstanceOf('TEST_EMAIL_CONFIG', $this->Config);
    }

    public function testCurrent()
    {
        $this->assertEquals('local', $this->Config->default['name']);

        // from BaseEmailConfig::_defaults
        $this->assertEquals('utf-8', $this->Config->default['charset']);
        $this->assertEquals('utf-8', $this->Config->default['headerCharset']);

        // test env
        $this->assertEquals('Mail', $this->Config->test['transport']);
        $this->assertEquals('utf-8', $this->Config->test['charset']);
        $this->assertEquals('utf-8', $this->Config->test['headerCharset']);
    }

}

class TEST_EMAIL_CONFIG extends BaseEmailConfig
{

    public $default = array(
        'name' => 'local'
    );

    public $test = array(
        'transport' => 'Mail',
        'merge' => true
    );
}
