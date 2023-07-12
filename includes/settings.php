<?php
add_action( 'admin_menu', 'simple_gql_plugin_menu' );

function simple_gql_plugin_menu() {
	add_options_page( 'Simple GraphQL Query Options', 'Simple GQL', 'manage_options', 'simple-gql', 'simple_gql_plugin_options' );
}

function simple_gql_plugin_options() {
	// Only admin can edit.
	if ( !current_user_can( 'manage_options' ) )  {
		wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
	}
	$apitoken = 'zaraza';
	include 'settings.html';
}