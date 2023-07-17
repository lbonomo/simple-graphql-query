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
/**
 * Option page.
 */
require_once __DIR__ . '/includes/class-simplegqladmin.php';
$settings = new SimpleGQLAdmin();

/**
 * Main function.
 */
function sgql_query($query) {

	// Next, make sure Requests can load internal classes.
	WpOrg\Requests\Autoload::register();

	if ( ! $query ) { die; }

	
	// Get options.
	$apikey      = get_option('simple-gpl-apikey', false);
	$apiendpoint = get_option('simple-gpl-apiendpoint', false);


	$headers = [
		'content-type'  => 'application/json',
	];
	if ( $apikey ) {
		$headers['authorization'] = $apikey;
	}

	$data = wp_json_encode( array(
		'query' => $query
	));

	$request = WpOrg\Requests\Requests::post(
		$apiendpoint, 
		$headers,
		$data,
	);

	// $data =  array( $query, $apikey, $apiendpoint);
	if ( 200 === $request->status_code ) {
		return array(
			'successful' => true,
			'data'       => json_decode($request->body, true),
		);
	} else {
		return array(
			'successful' => false
		);
	}
}