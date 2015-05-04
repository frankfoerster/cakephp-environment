<?php
/**
 * Copyright (c) Frank Förster (http://frankfoerster.com)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Frank Förster (http://frankfoerster.com)
 * @author Frank Förster <frank at frankfoerster.com>
 * @author Stephan Gonder <stephan.gonder at gmx.de>
 * @link https://github.com/frankfoerster/cakephp-environment CakePHP Environment Plugin
 * @license http://www.opensource.org/licenses/mit-license.php MIT License
 */
namespace FrankFoerster\Environment;

use Cake\Core\Configure;
use Cake\Core\Exception\Exception;
use Cake\Utility\Hash;

/**
 * Evironment Loader
 *
 * Load the environment configuration for the current request (based on domain) from
 * APP/Config/Environment/environment.xxx.php where xxx is the environment name.
 *
 * It will automatically set the $default property of the app's database and email configuration
 * depending on the detected environment.
 *
 * In addition all $configure settings from the environment config will be applied via Configure::write($configure).
 */
class Environments
{

    /**
     * This can be set manually to force a specific environment.
     *
     * @var null|string
     */
    public static $forceEnvironment = null;

    /**
     * Holds the current environment name.
     *
     * @var null|string
     */
    protected $_current = null;

    /**
     * The absolute path to the environment configuration directory
     * without trailing slash.
     *
     * @var null|string
     */
    protected $_envPath = null;

    /**
     * Holds the names of all available environments.
     *
     * @var array
     */
    protected $_environments = [];

    /**
     * Holds the singleton instance.
     *
     * @var null|Environments
     */
    protected static $_instance = null;

    /**
     * Constructor
     * Setup the environment path.
     */
    public function __construct()
    {
        $this->_envPath = ROOT . DS . 'config' . DS . 'Environment';
    }

    /**
     * Initialize an Environments singleton with all available environments.
     *
     * [
     *     'live' => [
     *         'domain' => [
     *             'www.example.com',
     *             'simsalabim.de',
     *             '...'
     *         ],
     *         'path' => [
     *             'absolute/path/on/server/1',
     *             'absolute/path/on/server/2'
     *         )
     *     ],
     *     'staging' => [
     *         ...
     *     ],
     *     ...
     * )
     *
     * - initialize an instance
     * - load the global environment config
     * - determine the current environment (in order ->   self::$forceEnvironment > HOST > PATH > local)
     * - load the environment file for the determined environment
     */
    public static function init()
    {
        $instance = self::getInstance();
        $instance->_environments = $instance->_loadEnvironment($instance->_envPath . DS . 'config.php');

        if (!isset($instance->_environments['local'])) {
            $instance->_environments['local'] = [];
        }

        $instance->_current = $instance->_getEnvironment();

        if ($instance->_current !== null && isset($instance->_environments[$instance->_current])) {
            $instance->_loadEnvironment($instance->_envPath . DS . 'environment.' . $instance->_current . '.php');
        }
    }

    /**
     * Get the current environment name.
     *
     * @return null|string
     */
    public static function getCurrentEnvironment()
    {
        $instance = self::getInstance();
        return $instance->_current;
    }

    /**
     * Load the specified environment file.
     *
     * @param string $envFilePath
     * @return array $availableEnvironments
     */
    protected function _loadEnvironment($envFilePath)
    {
        if (file_exists($envFilePath)) {
            include $envFilePath;

            // $configure has to be defined in the included environment file.
            if (isset($configure) && is_array($configure) && !empty($configure)) {
                $config = Hash::merge(Configure::read(), Hash::expand($configure));
                Configure::write($config);
            }

            if (isset($availableEnvironments) && empty($this->_environments)) {
                return $availableEnvironments;
            }
        }
        return [];
    }

    /**
     * Detect the environment and return its name.
     *
     * @return string
     * @throws Exception
     */
    protected function _getEnvironment()
    {
        $environment = self::$forceEnvironment;

        // Check if the environment has been manually set (forced).
        if ($environment !== null) {
            if (!isset($this->_environments[$environment])) {
                throw new Exception('Environment configuration for "' . $environment . '" could not be found.');
            }
        }
        // If no manual setting is available, use "host:port" to decide which config to use.
        if ($environment === null && !empty($_SERVER['HTTP_HOST'])) {
            $host = (string)$_SERVER['HTTP_HOST'];
            foreach ($this->_environments as $env => $envConfig) {
                if (isset($envConfig['domain']) && in_array($host, $envConfig['domain'])) {
                    $environment = $env;
                    break;
                }
            }
        }
        // If there is no host:port match, try "host" only.
        if ($environment === null && !empty($_SERVER['SERVER_NAME'])) {
            $host = (string)$_SERVER['SERVER_NAME'];
            foreach ($this->_environments as $env => $envConfig) {
                if (isset($envConfig['domain']) && in_array($host, $envConfig['domain'])) {
                    $environment = $env;
                    break;
                }
            }
        }
        // If no host matched then try to use the APP path.
        if ($environment === null && ($serverPath = $this->_getRealAppPath())) {
            foreach ($this->_environments as $env => $envConfig) {
                if (isset($envConfig['path']) && in_array($serverPath, $envConfig['path'])) {
                    $environment = $env;
                    break;
                }
            }
        }
        // No environment could be identified -> we are on a dev machine.
        if (!$environment) {
            $environment = 'local';
        }

        return $environment;
    }

    /**
     * Wrapper to get the absolute environment path.
     * Handles symlinks properly, as well.
     *
     * @return string Path
     * @codeCoverageIgnore
     */
    protected function _getRealAppPath()
    {
        $path = realpath(APP);
        if (substr($path, -1, 1) !== DS) {
            $path .= DS;
        }
        return $path;
    }

    /**
     * Get a singleton instance of the Environments class.
     *
     * @return Environments
     */
    public static function getInstance()
    {
        if (static::$_instance === null) {
            static::$_instance = new Environments();
        }
        return static::$_instance;
    }

    /**
     * Reset the singleton instance.
     */
    public static function tearDown()
    {
        static::$_instance = null;
        static::$forceEnvironment = null;
    }
}
