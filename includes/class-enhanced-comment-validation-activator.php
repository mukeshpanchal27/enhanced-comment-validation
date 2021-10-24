<?php

/**
 * Fired during plugin activation
 *
 * @link       https://mukeshpanchal.com/
 * @since      1.0.0
 *
 * @package    Enhanced_Comment_Validation
 * @subpackage Enhanced_Comment_Validation/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Enhanced_Comment_Validation
 * @subpackage Enhanced_Comment_Validation/includes
 * @author     Mukesh Panchal <mukeshpanchal27@gmail.com>
 */
class Enhanced_Comment_Validation_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function activate() {
		
		$enhanced_comment_validation_settings = get_option( 'enhanced_comment_validation_settings' );
		if ( empty( $enhanced_comment_validation_settings ) ) {
			$default_options = array(
				'_enable_validation' => 'yes',
				'_message_style' => 'style1',
				'_enable_author' => 'yes',
				'_enable_email' => 'yes',
				'_author_message' => __( 'Please enter your name', 'enhanced-comment-validation' ),
				'_email_message' => __( 'Please enter your email', 'enhanced-comment-validation' ),
				'_captcha_version' => 'v2',
			);
			update_option( 'enhanced_comment_validation_settings', $default_options );
		}

	}

}
