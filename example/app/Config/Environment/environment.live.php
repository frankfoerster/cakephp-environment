<?php
/**
 * Database live (production) config.
 */

$dbConfig = array(
	'host' => 'localhost',
	'login' => 'username',
	'password' => 'secret',
	'database' => 'myapp',
	'prefix' => ''
);

/**
 * Configure settings.
 *
 * Each setting will be loaded via
 * Configure::write(key, value)
 */

$settings = array(
	'debug' => 0
);
