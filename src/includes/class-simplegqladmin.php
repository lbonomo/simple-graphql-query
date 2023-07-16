<?php
/**
 * Setting Class file.
 *
 * @package Simple_Graphql_Query
 */

/**
 * Admin class.
 */
class SimpleGQLAdmin {
	/**
	 * Constructor
	 */
	public function __construct() {
		add_action( 'admin_menu', array( $this, 'simple_gql_menu' ) );
		add_action( 'admin_init', array( $this, 'simple_gql_options' ) );
	}

	/**
	 * Menu - Register.
	 */
	public function simple_gql_menu() {
		add_options_page(
			'Simple GraphQL Query Options',       // page_title.
			'Simple GQL',                         // menu_title.
			'manage_options',                     // capability.
			'simple-gql-settings',                // menu_slug.
			array( $this, 'simple_gql_callback' ) // callback.
		);
	}

	/**
	 * Menu - Callback page.
	 */
	public function simple_gql_callback() {
		if ( ! current_user_can( 'manage_options' ) ) {
			wp_die( 'You do not have sufficient permissions to access this page.' );
		}
		// Only admin can edit.
		
		// $apitoken = 'zaraza';
		// include 'class-simplegqladmin.html';

		echo '<form action="options.php" method="post">';
		do_settings_sections( 'simple-gql-settings' );
		submit_button( 'Grabar' );
		echo '</form>';

	}

	/**
	 * Setings and options.
	 */
	public function simple_gql_options() {

		/**
		 *  Settings Section.
		 */
		add_settings_section(
			'simple-gql-section',                          // ID
			'Simple GraphQL Settings',                     // Title
			array( $this, 'simple_gql_section_callback' ), // Section callback
			'simple-gql-settings',                         // Page
			array()                                        // Args
		);

		/**
		 * API Key.
		 */

		// Setting.
		register_setting(
			'simple-gql-section', // option_group
			'simple-gpl-apikey',  // option_name
		);

		// Field.
		add_settings_field(
			'simple-gpl-apikey',              // ID
			'GraphQL API Key',                // Title
			array( $this, 'input_callback' ), // Callback
			'simple-gql-settings',            // Page
			'simple-gql-section',             // Section
			array(                            // Args
				'label_for'   => 'simple-gpl-apikey',
				'description' => 'GraphQL API Key',
				'class'       => 'regular-text',
			)
		);

		/**
		 * API Endpoing.
		 */
	
		// Setting.
		register_setting(
			'simple-gql-section',     // option_group
			'simple-gpl-apiendpoint', // option_name
		);
	
		// Field.
		add_settings_field(
			'simple-gpl-apiendpoint',         // ID
			'GraphQL API Endpoint',           // Title
			array( $this, 'input_callback' ), // Callback
			'simple-gql-settings',            // Page
			'simple-gql-section',             // Section
			array(                            // Args
				'label_for'   => 'simple-gpl-apiendpoint',
				'description' => 'GraphQL API Endpoint',
				'class'       => 'regular-text',
			)
		);
	}


	/**
	 * Callback
	 */
	public function simple_gql_section_callback() {
		settings_fields( 'simple-gql-section' );
	}

	/**
	 * Funcion Callback del Textarea.
	 *
	 *  @param array $args Settings values.
	 */
	public function input_callback( $args ) {
		$value       = get_option( $args['label_for'] );
		$value       = isset( $value ) ? esc_attr( $value ) : '';
		$name        = $args['label_for'];
		$description = $args['description'];
		$class       = $args['class'];
		$html        = "<input name='$name' type='text' id='$name' class='$class' value='$value'>";
		if ( null !== $description ) {
			$html .= "<p class='description' id='$name-description' >$description</p>"; }

		// Just available a textarea.
		$allowed_html = array(
			'input' => array(
				'id'    => array(),
				'name'  => array(),
				'class' => array(),
				'type'  => array(),
				'value' => array(),
			),
			'p'     => array(
				'id'    => array(),
				'class' => array(),
			),
		);
		echo wp_kses( $html, $allowed_html );
	}

}




