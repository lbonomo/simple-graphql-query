<?php
/**
 * Plugin Name:     Simple Graphql Query
 * Plugin URI:      PLUGIN SITE HERE
 * Description:     PLUGIN DESCRIPTION HERE
 * Author:          YOUR NAME HERE
 * Author URI:      YOUR SITE HERE
 * Text Domain:     simple-graphql-query
 * Domain Path:     /languages
 * Version:         0.1.0
 *
 * @package         Simple_Graphql_Query
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

require_once __DIR__ . '/includes/class-simplegqladmin.php';

$settings = new SimpleGQLAdmin();

