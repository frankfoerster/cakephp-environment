<?php
/**
 * Copyright (c) Frank Förster (http://frankfoerster.com)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Frank Förster (http://frankfoerster.com)
 * @author Frank Förster <github at frankfoerster.com>
 * @link https://github.com/frankfoerster/cakephp-environment CakePHP Environment Plugin
 * @license http://www.opensource.org/licenses/mit-license.php MIT License
 */
namespace FrankFoerster\Environment\Test\TestCase;

use Cake\Core\Configure;
use Cake\Core\Exception\CakeException;
use Cake\TestSuite\TestCase;
use FrankFoerster\Environment\Environments;
use FrankFoerster\Environment\Test\Util\EnvironmentsTestWrapper;

/**
 * Class EnvironmentsTest
 */
class EnvironmentsTest extends TestCase
{

    public function setUp(): void
    {
        parent::setUp();
    }

    public function tearDown(): void
    {
        Environments::tearDown();
        parent::tearDown();
    }

    public function testConstruct(): void
    {
        $this->assertEquals(ROOT . DS . 'config' . DS . 'Environment', EnvironmentsTestWrapper::getEnvPath());
    }

    public function testGetInstance(): void
    {
        $this->assertInstanceOf('\FrankFoerster\Environment\Environments', Environments::getInstance());
    }

    public function testGetEnvironment(): void
    {
        $_SERVER['HTTP_HOST'] = 'localhost';
        $this->assertEquals('local', EnvironmentsTestWrapper::getEnvironment());

        Environments::tearDown();
        Environments::$forceEnvironment = 'live';
        Environments::init();

        $this->assertEquals('live', EnvironmentsTestWrapper::getEnvironment());
    }

    public function testEnvironmentNotFoundThrowsException(): void
    {
        $this->expectException(CakeException::class);
        Environments::tearDown();
        Environments::$forceEnvironment = 'not_existant_env';
        Environments::init();
    }

    public function testHostEnvironmentDetection(): void
    {
        Environments::tearDown();
        EnvironmentsTestWrapper::prepareTestEnvironments();

        $backup = $_SERVER['HTTP_HOST'] ?? 'localhost';
        $_SERVER['HTTP_HOST'] = 'test.com';
        $this->assertEquals('testing', EnvironmentsTestWrapper::getEnvironment());

        $_SERVER['HTTP_HOST'] = $backup;
    }

    public function testServerNameEnvironmentDetection(): void
    {
        Environments::tearDown();
        EnvironmentsTestWrapper::prepareTestEnvironments();

        $hostBackup = $_SERVER['HTTP_HOST'] ?? 'localhost';
        $serverNameBackup = $_SERVER['SERVER_NAME'] ?? 'localhost';
        $_SERVER['HTTP_HOST'] = null;
        $_SERVER['SERVER_NAME'] = 'test.com';
        $this->assertEquals('testing', EnvironmentsTestWrapper::getEnvironment());

        $_SERVER['HTTP_HOST'] = $hostBackup;
        $_SERVER['SERVER_NAME'] = $serverNameBackup;
    }

    public function testPathEnvironmentDetection(): void
    {
        Environments::tearDown();
        EnvironmentsTestWrapper::prepareTestEnvironments();
        $this->assertEquals('testing', EnvironmentsTestWrapper::getEnvironment());
    }

    public function testEnvironmentLoadsCorrectConfigureSettings(): void
    {
        EnvironmentsTestWrapper::init();
        $db = Configure::read('Datasources.default.database');
        $this->assertEquals('myapp', $db);
    }

    public function testGetCurrentEnvironment(): void
    {
        EnvironmentsTestWrapper::setEnv('current');
        $this->assertEquals('current', EnvironmentsTestWrapper::getCurrentEnvironment());
    }
}
