<?php
/**
 * Configure settings.
 *
 * Each setting will be merged via
 * @TODO: Stephan
 */
$configure = [
    'debug' => false,

    'Datasources.default' => [
        'host' => 'localhost',
        'login' => 'username',
        'password' => 'secret',
        'database' => 'myapp_live',
        'prefix' => '',
        'quoteIdentifiers' => true,
    ],

    'Datasources.test' => [
        'host' => 'localhost',
        'login' => 'username',
        'password' => 'secret',
        'database' => 'myapp_test',
        'prefix' => '',
        'quoteIdentifiers' => true,
    ],

    'Email.default' => [
        'transport' => 'default',
        'from' => 'example@example.com'
    ]
];
