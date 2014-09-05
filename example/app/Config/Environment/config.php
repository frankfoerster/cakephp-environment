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
 * array(
 *     'live' => array(
 *         'domain' => array(
 *             'www.example.com',
 *             'example.com',
 *             '...'
 *         ),
 *         'path' => array(
 *             'absolute/path/on/server/1',
 *             'absolute/path/on/server/2'
 *         )
 *     ),
 *     'staging' => array(
 *         ...
 *     ),
 *     ...
 * )
 *
 * Each individual environment must have a custom configuration file,
 * e.g. "app/Config/Environment/environment.live.php".
 *
 * During bootstrap the current environment will be detected automatically.
 *
 * If no environment has been detected then the local configuration
 * from "app/Config/Environment/environment.local.php" will be used.
 */
$availableEnvironments = array(
	'staging' => array(
		'domain' => array(
			'staging.domain.com'
		),
		//'path' => array() (optional)
	),
	'live' => array(
		'domain' => array(
			'www.domain.com',
			'domain.com'
		),
		//'path' => array() (optional)
	)
);

/**
 * Configuration settings that will be applied to all environments.
 * These are loaded via Configure::write($configure) and may be overridden in each environment configuration file.
 */
$configure = array(
	/**
	 * Debug level
	 */
	'debug' => 0,

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
	'App.encoding' => 'UTF-8',

	/**
	 * Enable cache view prefixes.
	 *
	 * If set it will be prepended to the cache name for view file caching. This is
	 * helpful if you deploy the same application via multiple subdomains and languages,
	 * for instance. Each version can then have its own view cache namespace.
	 * Note: The final cache file name will then be `prefix_cachefilename`.
	 */
	'Cache.viewPrefix' => CACHE_PREFIX,

	/**
	 * To configure CakePHP *not* to use mod_rewrite and to
	 * use CakePHP pretty URLs, remove these .htaccess
	 * files:
	 *
	 * /.htaccess
	 * /app/.htaccess
	 * /app/webroot/.htaccess
	 *
	 * And uncomment the App.baseUrl below. But keep in mind
	 * that plugin assets such as images, CSS and JavaScript files
	 * will not work without URL rewriting!
	 * To work around this issue you should either symlink or copy
	 * the plugin assets into you app's webroot directory. This is
	 * recommended even when you are using mod_rewrite. Handling static
	 * assets through the Dispatcher is incredibly inefficient and
	 * included primarily as a development convenience - and
	 * thus not recommended for production applications.
	 */
	//'App.baseUrl' => env('SCRIPT_NAME'),

	/**
	 * To configure CakePHP to use a particular domain URL
	 * for any URL generation inside the application, set the following
	 * configuration variable to the http(s) address to your domain. This
	 * will override the automatic detection of full base URL and can be
	 * useful when generating links from the CLI (e.g. sending emails)
	 */
	//'App.fullBaseUrl' => 'http://example.com',

	/**
	 * Web path to the public images directory under webroot.
	 * If not set defaults to 'img/'
	 */
	//'App.imageBaseUrl' => 'img/',

	/**
	 * Web path to the CSS files directory under webroot.
	 * If not set defaults to 'css/'
	 */
	//'App.cssBaseUrl' => 'css/',

	/**
	 * Web path to the js files directory under webroot.
	 * If not set defaults to 'js/'
	 */
	//'App.jsBaseUrl' => 'js/',

	/**
	 * Uncomment the define below to use CakePHP prefix routes.
	 *
	 * The value of the define determines the names of the routes
	 * and their associated controller actions:
	 *
	 * Set to an array of prefixes you want to use in your application. Use for
	 * admin or other prefixed routes.
	 *
	 * 	Routing.prefixes = array('admin', 'manager');
	 *
	 * Enables:
	 *	`admin_index()` and `/admin/controller/index`
	 *	`manager_index()` and `/manager/controller/index`
	 *
	 */
	//'Routing.prefixes' => array('admin'),

	/**
	 * Turn off all caching application-wide.
	 *
	 */
	//'Cache.disable' => true,

	/**
	 * Enable cache checking.
	 *
	 * If set to true, for view caching you must still use the controller
	 * public $cacheAction inside your controllers to define caching settings.
	 * You can either set it controller-wide by setting public $cacheAction = true,
	 * or in each action using $this->cacheAction = true.
	 *
	 */
	//'Cache.check' => true,

	/**
	 * Session configuration.
	 *
	 * Contains an array of settings to use for session configuration. The defaults key is
	 * used to define a default preset to use for sessions, any settings declared here will override
	 * the settings of the default config.
	 *
	 * ## Options
	 *
	 * - `Session.cookie` - The name of the cookie to use. Defaults to 'CAKEPHP'
	 * - `Session.timeout` - The number of minutes you want sessions to live for. This timeout is handled by CakePHP
	 * - `Session.cookieTimeout` - The number of minutes you want session cookies to live for.
	 * - `Session.checkAgent` - Do you want the user agent to be checked when starting sessions? You might want to set the
	 *    value to false, when dealing with older versions of IE, Chrome Frame or certain web-browsing devices and AJAX
	 * - `Session.defaults` - The default configuration set to use as a basis for your session.
	 *    There are four builtins: php, cake, cache, database.
	 * - `Session.handler` - Can be used to enable a custom session handler. Expects an array of callables,
	 *    that can be used with `session_save_handler`. Using this option will automatically add `session.save_handler`
	 *    to the ini array.
	 * - `Session.autoRegenerate` - Enabling this setting, turns on automatic renewal of sessions, and
	 *    sessionids that change frequently. See CakeSession::$requestCountdown.
	 * - `Session.ini` - An associative array of additional ini values to set.
	 *
	 * The built in defaults are:
	 *
	 * - 'php' - Uses settings defined in your php.ini.
	 * - 'cake' - Saves session files in CakePHP's /tmp directory.
	 * - 'database' - Uses CakePHP's database sessions.
	 * - 'cache' - Use the Cache class to save sessions.
	 *
	 * To define a custom session handler, save it at /app/Model/Datasource/Session/<name>.php.
	 * Make sure the class implements `CakeSessionHandlerInterface` and set Session.handler to <name>
	 *
	 * To use database sessions, run the app/Config/Schema/sessions.php schema using
	 * the cake shell command: cake schema create Sessions
	 *
	 */
	'Session.defaults' => 'php'

	/**
	 * Apply timestamps with the last modified time to static assets (js, css, images).
	 * Will append a query string parameter containing the time the file was modified. This is
	 * useful for invalidating browser caches.
	 *
	 * Set to `true` to apply timestamps when debug > 0. Set to 'force' to always enable
	 * timestamping regardless of debug value.
	 */
	//'Asset.timestamp' => false,

	/**
	 * Compress CSS output by removing comments, whitespace, repeating tags, etc.
	 * This requires a/var/cache directory to be writable by the web server for caching.
	 * and /vendors/csspp/csspp.php
	 *
	 * To use, prefix the CSS link URL with '/ccss/' instead of '/css/' or use HtmlHelper::css().
	 */
	//'Asset.filter.css' => 'css.php',

	/**
	 * Plug in your own custom JavaScript compressor by dropping a script in your webroot to handle the
	 * output, and setting the config below to the name of the script.
	 *
	 * To use, prefix your JavaScript link URLs with '/cjs/' instead of '/js/' or use JsHelper::link().
	 */
	//'Asset.filter.js' => 'custom_javascript_output_filter.php',

	/**
	 * The class name and database used in CakePHP's
	 * access control lists.
	 */
	//'Acl.classname', 'DbAcl');
	//'Acl.database', 'default');
);