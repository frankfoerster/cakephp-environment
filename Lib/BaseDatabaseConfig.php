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
 * Database Base Config
 *
 * You should define both `environment` and `path` to be able to switch
 * dynamically in CLI mode and normal frontend mode.
 * You can manually switch to a specific environment using Configure::write('Environment.current').
 *
 * It also automatically sets the test environment based on the default settings:
 * If no `test` config is set it will use the default settings except for prefix.
 * You can also define some custom settings and if `merge` is set to `true` in your test config
 * it will then merge with `default` afterwards.
 */
class BaseDatabaseConfig {

	/**
	 * These are the default db config settings.
	 * All other db configs are merged with it.
	 *
	 * @var array
	 */
	protected $_defaults = array(
		'encoding' => 'utf8',
		'persistent' => false,
	);

	/**
	 * Holds the default db config.
	 *
	 * @var array
	 */
	public $default = array();

	/**
	 * Switch between local and live site(s) automatically by domain
	 * or manually by Configure::read('Environment.current').
	 *
	 * If there is no prefix key for the test config it will set the prefix to zzz_ to avoid
	 * accidential collision with the live database if there is different setup.
	 */
	public function __construct() {
		$this->default = array_merge($this->_defaults, $this->default);
		$this->default = array_merge($this->default, Environments::getEnvironmentDbConfig());

		if (!isset($this->test)) {
			$this->test = $this->default;
			if (isset($this->test['prefix'])) {
				unset($this->test['prefix']);
			}
		}
		if (!isset($this->test['prefix'])) {
			$this->test['prefix'] = 'zzz_';
		}
		if (!empty($this->test['merge'])) {
			$this->test = array_merge($this->default, $this->test);
			unset($this->test['merge']);
		}
	}

	/**
	 * Get the current db configuration.
	 *
	 * @return array
	 */
	public function current() {
		return $this->default;
	}

}
