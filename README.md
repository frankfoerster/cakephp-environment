CakePHP 2.x Environment Plugin
==============================

[![Build Status](https://travis-ci.org/frankfoerster/cakephp-environment.svg?branch=master)](https://travis-ci.org/frankfoerster/cakephp-environment)

Manage multiple environments in your CakePHP application that differ in:

- database setup
- configuration settings (Configure)
- custom feature flags

Requirements
------------

- PHP 5.3+
- CakePHP 2.3+

1. What it does
---------------

The Environment plugin hooks into your bootstrap process to initialize the database configuration, configuration parameters and additional custom logic for different environments.

An environment is defined and detected either by a set of domains (e.g. www.domain.com, domain.com, domain.net) and optionally by the absolute app path on a server.

2. Install and use the plugin
-----------------------------

1. Clone || download the project || init the project as submodule in `/app/Plugin/Environment`.
2. Copy the example configuration files from `example/app/Config/Environment` to `app/Config/Environment`
3. Add the following lines to your `app/Config/bootstrap.php`
   
   ```php
   CakePlugin::load('Environment', array('bootstrap' => false, 'routes' => false);
   
   App::uses('Environments', 'Environment.Lib');
   Environments::init();
   ```
4. To enable environment specific database configurations copy the `database.php` file from the example directory to `app/Config/database.php` OR make sure your existing database.php extends from BaseDatabaseConfig, e.g:
   
   ```php
   App::uses('BaseDatabaseConfig', 'Environment.Lib');
   
   class DATABASE_CONFIG extends BaseDatabaseConfig {
       ...
   }
   ```

3. Configuration
----------------

The configuration of your environments is managed with multiple files.

- `config.php` is the global configuration file that is applied to all detected environments.
- `environment.{name}.php` is a single environment file that contains the environment specific `$dbSettings` and `$configure` parameters.

Settings defined in an environment configuration file override the global configuration.
