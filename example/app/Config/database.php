<?php
App::uses('BaseDatabaseConfig', 'Environment.Lib');

class DATABASE_CONFIG extends BaseDatabaseConfig {

	/**
	 * These default settings are used for every DB config.
	 * Each individual environment $dbConfig like environment.live.php will be merged with $default.
	 *
	 * @var array
	 * @see EnhancedMysql
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
