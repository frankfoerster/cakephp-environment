<?php
/**
 * Configure settings.
 *
 * Each setting will be merged via
 * Hash::merge(Configure::read(), Hash::expand($configure))
 */
$configure = [
    'debug' => true,

    'Datasources.default' => [
        'host' => 'localhost',
        'username' => 'username',
        'password' => 'secret',
        'database' => 'myapp_staging',
        'prefix' => '',
        'quoteIdentifiers' => true,
    ],

    'Datasources.test' => [
        'host' => 'localhost',
        'username' => 'username',
        'password' => 'secret',
        'database' => 'myapp_staging_test',
        'prefix' => '',
        'quoteIdentifiers' => true,
    ],

    'Email.default' => [
        'transport' => 'default',
        'from' => 'example@example.com'
    ]
];
