CakePHP 3.x Environment Plugin
==============================

[![Build Status](https://travis-ci.org/frankfoerster/cakephp-environment.svg?branch=cake3)](https://travis-ci.org/frankfoerster/cakephp-environment)

Manage multiple environments in your CakePHP application that differ in, e.g.:

- database setup
- configuration settings (Configure)
- custom feature flags

Requirements
------------

- PHP 5.4.16+
- CakePHP 3.x

1. What it does
---------------

The Environment plugin hooks into your bootstrap process to initialize the database configuration, configuration parameters and additional custom logic for different environments.

An environment is defined and detected either by a set of domains (e.g. www.domain.com, domain.com, domain.net) or optionally by the absolute app path on a server (cli).

2. Install and use the plugin
-----------------------------

1. `composer require frankfoerster/cakephp-environment`
2. Copy the example configuration files from `example/config/Environment` to your app `/config/Environment`
3. Add the following lines to your `config/bootstrap.php` file
   
   ```php
   use FrankFoerster\Environment\Environments;
   
   Plugin::load('FrankFoerster/Environment');
   Environments::init();
   ```

Tags ~1.0 are releases for CakePHP 2.x support (master branch).  
Tags ~3.0 are releases for CakePHP 3.x support (cake3 branch).

3. Configuration
----------------

The configuration of your environments is managed with multiple files.

- `config.php` is the global configuration file that is applied to all detected environments.
- `environment.{name}.php` is a single environment file that contains the environment specific `$configure` array

Settings defined in an environment configuration file are deeply merged with the global configuration.
