<?php
declare(strict_types=1);

namespace FrankFoerster\Environment\Test\Util;

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

    public static function getEnvironment(): ?string
    {
        $instance = self::getInstance();

        return $instance->_getEnvironment();
    }

    public static function prepareTestEnvironments(): void
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

    public static function setEnv($env): void
    {
        $instance = self::getInstance();
        $instance->_current = $env;
    }
}
