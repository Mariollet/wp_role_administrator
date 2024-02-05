<?php

/**
 * @package Mariollet
 */
/*
Plugin Name: Custom Roles Administrator
Description: This plugin allows you to manage custom roles and capabilities in WordPress
Version: 1.0.0
Author: Mariollet
Author URI: https://github.com/Mariollet
*/

define('WORDPRESS_ROLES', [
  ['id' => 0, 'value' => 'administrator', 'name' => 'Administrator'],
  ['id' => 1, 'value' => 'editor', 'name' => 'Editor'],
  ['id' => 2, 'value' => 'author', 'name' => 'Author'],
  ['id' => 3, 'value' => 'contributor', 'name' => 'Contributor'],
  ['id' => 4, 'value' => 'subscriber', 'name' => 'Subscriber']
]);

include_once(__DIR__ . '/lib/wp_init.php');
include_once(__DIR__ . '/lib/wp_hook.php');
include_once(__DIR__ . '/lib/wp_ajax.php');