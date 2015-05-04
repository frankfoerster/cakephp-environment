<?php

/**
 * Server timezone
 */
date_default_timezone_set('Europe/Berlin');

/**
 * Set the application cache prefix here.
 * This is important because multiple apps on the same server should never share the same cache.
 * Avoids Memcache and APC conflicts.
 */
if (!defined('CACHE_PREFIX')) {
    define('CACHE_PREFIX', 'myapp_');
}

/**
 * All available environments are defined here.
 *
 * Structure:
 * ----------
 *
 * [
 *     'live' => [
 *         'domain' => [
 *             'www.example.com',
 *             'example.com',
 *             '...'
 *         ],
 *         'path' => [
 *             'absolute/path/on/server/1',
 *             'absolute/path/on/server/2'
 *         ]
 *     ],
 *     'staging' => [
 *         ...
 *     ],
 *     ...
 * ]
 *
 * Each individual environment must have a custom configuration file,
 * e.g. "app/Config/Environment/environment.live.php".
 *
 * During bootstrap the current environment will be detected automatically.
 *
 * If no environment has been detected then the local configuration
 * from "app/Config/Environment/environment.local.php" will be used.
 */
$availableEnvironments = [
    'staging' => [
        'domain' => [
            'staging.domain.com'
        ],
        //'path' => [] (optional)
    ],
    'live' => [
        'domain' => [
            'www.domain.com',
            'domain.com'
        ],
        //'path' => [] (optional)
    ]
];

/**
 * Configuration settings that will be applied to all environments.
 * These are loaded via Configure::write($configure) and may be overridden in each environment configuration file.
 */
$configure = [
    /**
     * Debug level
     */
    'debug' => false,

    /**
     * A random string used in security hashing methods.
     */
    'Security.salt' => 'M0PolcgZSbCcLXCZ4VOuakptSxDFanUwebgui3bg0ry5bu79MI6f1JwkDz',

    /**
     * A random numeric string (digits only) used to encrypt/decrypt strings.
     */
    'Security.cipherSeed' => '6857524572176864175568803303783041743580347',

    /**
     * The Session name.
     */
    'Session.cookie' => 'myapp',

    /**
     * The Cookie name.
     */
    'Cookie.name' => 'myappC',

    /**
     * Application wide charset encoding
     */
    'App.encoding' => 'UTF-8'
];
