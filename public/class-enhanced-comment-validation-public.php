<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://mukeshpanchal.com/
 * @since      1.0.0
 *
 * @package    Enhanced_Comment_Validation
 * @subpackage Enhanced_Comment_Validation/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Enhanced_Comment_Validation
 * @subpackage Enhanced_Comment_Validation/public
 * @author     Mukesh Panchal <mukeshpanchal27@gmail.com>
 */
class Enhanced_Comment_Validation_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

		if ( !defined( 'Enhanced_RECAPTCHA_SHOW' ) ) {
			define( 'Enhanced_RECAPTCHA_SHOW', 	'https://www.google.com/recaptcha/api.js?' );
		}
		
	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Enhanced_Comment_Validation_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Enhanced_Comment_Validation_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */
		
		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/enhanced-comment-validation-public.css', array(), $this->version, 'all' );
	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Enhanced_Comment_Validation_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Enhanced_Comment_Validation_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */
		
		
		if( ( is_single() || is_page() ) && comments_open() ) {
			
			$enhanced_comment_validation_settings = get_option( 'enhanced_comment_validation_settings' );
			
			if ( isset( $enhanced_comment_validation_settings['_enable_validation'] ) && 'yes' === $enhanced_comment_validation_settings['_enable_validation'] ) {

				wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/enhanced-comment-validation-public.js', array( 'jquery' ), $this->version, false );

				$_enable_comment = $_comment_message = $_enable_author = $_author_message = $_enable_email = $_email_message = $_enable_website = $_website_message = $_message_style = '';

				if ( isset( $enhanced_comment_validation_settings['_enable_comment'] ) && $enhanced_comment_validation_settings['_enable_comment'] === 'yes' ) {
					$_enable_comment = 'yes';
					if ( isset( $enhanced_comment_validation_settings['_comment_message'] ) && $enhanced_comment_validation_settings['_comment_message'] !== '' ) {
						$_comment_message = $enhanced_comment_validation_settings['_comment_message']; 
					}
				}

				if ( isset( $enhanced_comment_validation_settings['_enable_author'] ) && $enhanced_comment_validation_settings['_enable_author'] === 'yes' ) {
					$_enable_author = 'yes';
					if ( isset( $enhanced_comment_validation_settings['_author_message'] ) && $enhanced_comment_validation_settings['_author_message'] !== '' ) {
						$_author_message = $enhanced_comment_validation_settings['_author_message']; 
					}
				}

				if ( isset( $enhanced_comment_validation_settings['_enable_email'] ) && $enhanced_comment_validation_settings['_enable_email'] === 'yes' ) {
					$_enable_email = 'yes';
					if ( isset( $enhanced_comment_validation_settings['_email_message'] ) && $enhanced_comment_validation_settings['_email_message'] !== '' ) {
						$_email_message = $enhanced_comment_validation_settings['_email_message']; 
					}
				}

				if ( isset( $enhanced_comment_validation_settings['_enable_website'] ) && $enhanced_comment_validation_settings['_enable_website'] === 'yes' ) {
					$_enable_website = 'yes';
					if ( isset( $enhanced_comment_validation_settings['_website_message'] ) && $enhanced_comment_validation_settings['_website_message'] !== '' ) {
						$_website_message = $enhanced_comment_validation_settings['_website_message']; 
					}
				}
				
				/* Check validation style */
				if ( isset( $enhanced_comment_validation_settings['_message_style'] ) && ! empty( $enhanced_comment_validation_settings['_message_style'] ) ) {
					$_message_style = $enhanced_comment_validation_settings['_message_style'];
				}

				wp_localize_script( $this->plugin_name, 'enhanced_comment_form_validation',
					array(
						'_message_style'	=> $_message_style,
						'_enable_comment'	=> $_enable_comment,
						'_comment_message' 	=> $_comment_message,
						'_enable_author'	=> $_enable_author,
						'_author_message' 	=> $_author_message,
						'_enable_email'		=> $_enable_email,
						'_email_message' 	=> $_email_message,
						'_enable_website'	=> $_enable_website,
						'_website_message' 	=> $_website_message
					)
				);
			
				// reCAPTCHA Google script			
				wp_register_script ( 'Enhanced_Comment_Validation_recaptcha_call', Enhanced_RECAPTCHA_SHOW . "onload=Enhanced_RecaptchaCallback&render=explicit", array('jquery'), false, true );
				wp_enqueue_script  ( 'Enhanced_Comment_Validation_recaptcha_call' );
			}
			 
		}
	}

	public function body_classes( $classes ) {
		if( ( is_single() || is_page() ) && comments_open() ) {
			
			$enhanced_comment_validation_settings = get_option( 'enhanced_comment_validation_settings' );
			if ( isset( $enhanced_comment_validation_settings['_enable_validation'] ) && 'yes' === $enhanced_comment_validation_settings['_enable_validation'] ) {
				if ( isset( $enhanced_comment_validation_settings['_message_style'] ) && ! empty( $enhanced_comment_validation_settings['_message_style'] ) ) {
					$classes[] = 'enhanced_comment_validation_'.$enhanced_comment_validation_settings['_message_style'];
				}
			}
		}
		return $classes;
	}

	public function comment_form_fields( $fields ) {
	
		$enhanced_comment_validation_settings = get_option( 'enhanced_comment_validation_settings' );
		if ( isset( $enhanced_comment_validation_settings['_enable_validation'] ) && 'yes' === $enhanced_comment_validation_settings['_enable_validation'] ) {
			
			if ( isset( $enhanced_comment_validation_settings['_enable_captcha'] ) && 'yes' === $enhanced_comment_validation_settings['_enable_captcha'] ) {

				$featured = isset($get_Enhanced_Comment_Validation_form_input['_enable_invisible_captcha']) && $get_Enhanced_Comment_Validation_form_input['_enable_invisible_captcha'] == 1 ? 'invisible' : '';
				if( isset( $get_Enhanced_Comment_Validation_form_input['_enable_captcha'] )  ?  $get_Enhanced_Comment_Validation_form_input['_enable_captcha'] : '' ){
					$fields['captcha'] = '<p>
								<div class="g-recaptcha" id="comment_form_recaptcha"  data-size="'.$featured.'"></div>						
							</p>';
				}
			}
		}
		return $fields;
	}

}
