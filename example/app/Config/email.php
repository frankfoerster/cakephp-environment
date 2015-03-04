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
App::uses('BaseEmailConfig', 'Environment.Lib');

/**
 * Email Configuration Class
 */
class EmailConfig extends BaseEmailConfig {

	/**
	 * These default settings are used for every Email config.
	 * Each individual environment $emailConfig will be merged with $default.
	 *
	 * @var array
	 */
	public $default = array(
		'charset' => 'utf-8',
		'headerCharset' => 'utf-8'
	);

}
