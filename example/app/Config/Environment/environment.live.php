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
 * Email live config.
 */
$emailConfig = array(
    'transport' => 'Mail',
    'from' => 'you@localhost'
);

/**
 * Configure settings.
 *
 * Each setting will be loaded via
 * Configure::write(key, value)
 */
$configure = array(
    'debug' => 0
);
