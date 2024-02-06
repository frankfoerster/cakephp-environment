<?php
/**
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
// include autoload from Composer
require dirname(__DIR__) . '/vendor/autoload.php';
// include paths from CakePHP
require dirname(__DIR__) . '/tests/paths.php';
// disable cache to avoid errors on tests
\Cake\Cache\Cache::disable();
