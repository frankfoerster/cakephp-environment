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
use Cake\Core\Configure;
use Cake\TestSuite\TestCase;
use FrankFoerster\Environment\Environments;

/**
 * Class EnvironmentsTestWrapper
 *
 * Wraps the Environments Lib functionality for testing purposes.
 */
class EnvironmentsTestWrapper extends Environments
{

    public static function getEnvPath()
    {
        $instance = self::getInstance();

        return $instance->_envPath;
    }

    public static function getEnvironment()
    {
        $instance = self::getInstance();

        return $instance->_getEnvironment();
    }

    public static function prepareTestEnvironments()
    {
        $instance = self::getInstance();
        $instance->_environments = [
            'test' => [
                'key' => 'val'
            ],
            'testing' => [
                'domain' => [
                    'test.com'
                ],
                'path' => [
                    APP
                ]
            ]
        ];
    }

    public static function setEnv($env)
    {
        $instance = self::getInstance();
        $instance->_current = $env;
    }
}

/**
 * Class EnvironmentsTest
 */
class EnvironmentsTest extends TestCase
{

    public function setUp()
    {
        parent::setUp();
    }

    public function tearDown()
    {
        Environments::tearDown();
        parent::tearDown();
    }

    public function testConstruct()
    {
        $this->assertEquals(ROOT . DS . 'config' . DS . 'Environment', EnvironmentsTestWrapper::getEnvPath());
    }

    public function testGetInstance()
    {
        $this->assertInstanceOf('\FrankFoerster\Environment\Environments', Environments::getInstance());
    }

    public function testGetEnvironment()
    {
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
    public function testEnvironmentNotFoundThrowsException()
    {
        Environments::tearDown();
        Environments::$forceEnvironment = 'not_existant_env';
        Environments::init();
    }

    public function testHostEnvironmentDetection()
    {
        Environments::tearDown();
        EnvironmentsTestWrapper::prepareTestEnvironments();

        $backup = isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : 'localhost';
        $_SERVER['HTTP_HOST'] = 'test.com';
        $this->assertEquals('testing', EnvironmentsTestWrapper::getEnvironment());

        $_SERVER['HTTP_HOST'] = $backup;
    }

    public function testPathEnvironmentDetection()
    {
        Environments::tearDown();
        EnvironmentsTestWrapper::prepareTestEnvironments();
        $this->assertEquals('testing', EnvironmentsTestWrapper::getEnvironment());
    }

    public function testEnvironmentLoadsCorrectConfigureSettings()
    {
        EnvironmentsTestWrapper::init();
        $db = Configure::read('Datasources.default.database');
        $this->assertEquals('myapp', $db);
    }

    public function testGetCurrentEnvironment()
    {
        EnvironmentsTestWrapper::setEnv('current');
        $this->assertEquals('current', EnvironmentsTestWrapper::getCurrentEnvironment());
    }
}
