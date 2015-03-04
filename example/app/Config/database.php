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

/**
 * Database Configuration Class
 */
class DATABASE_CONFIG extends BaseDatabaseConfig {

	/**
	 * These default settings are used for every DB config.
	 * Each individual environment $dbConfig like environment.live.php will be merged with $default.
	 *
	 * @var array
	 */
	public $default = array(
		'datasource' => 'Database/Mysql',
		'persistent' => false,
		'encoding' => 'utf8'
	);

	/**
	 * The test settings.
	 *
	 * @var array
	 */
	public $test = array(
		'merge' => true,
		'prefix' => 'zzz_'
	);

}
