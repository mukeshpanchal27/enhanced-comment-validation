<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://mukeshpanchal.com/
 * @since      1.0.0
 *
 * @package    Enhanced_Comment_Validation
 * @subpackage Enhanced_Comment_Validation/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Enhanced_Comment_Validation
 * @subpackage Enhanced_Comment_Validation/includes
 * @author     Mukesh Panchal <mukeshpanchal27@gmail.com>
 */
class Enhanced_Comment_Validation_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'enhanced-comment-validation',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
