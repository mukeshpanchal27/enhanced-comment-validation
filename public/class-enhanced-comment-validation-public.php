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
		add_filter('comment_form_default_fields', [$this,'Enhanced_Comment_Validation_custom_fields']);
		add_action( 'comment_post', [$this,'Enhanced_Comment_Validation_save_comment_meta_data'] );	

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
		$get_validation_option_style = get_option( 'Enhanced_Comment_Validation_option' );
		$a = isset( $get_validation_option_style['_show_message'] )  ?  $get_validation_option_style['_show_message'] : ''  ;

		if($a === 'show_style' ){
			wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/enhanced-comment-validation-public.css', array(), $this->version, 'all' );
		}
		

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
		
		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/enhanced-comment-validation-public.js', array( 'jquery' ), $this->version, false );
		wp_enqueue_script( 'jquery-validate', plugin_dir_url( __FILE__ ) . 'js/jquery.validate.min.js', array( 'jquery' ), $this->version, false );	
		
		if( is_single() && comments_open() ){
			wp_enqueue_script( 'input-validation', plugin_dir_url( __FILE__ ) . 'js/input-validation.js', array( 'jquery' ), $this->version, false );
		}
		
	

		$get_validation_option = get_option( 'Enhanced_Comment_Validation_option' );
		
		$get_Enhanced_Comment_Validation_form_input=  get_option('Enhanced_Comment_Validation_form_input' );
		
		if(is_single() && comments_open() ) {
		
			$validation_form_array	= array();

			if(isset($get_validation_option['comment_input']) && $get_validation_option['comment_input'] != ''){
				$validation_form_array['comment_input'] = __($get_validation_option['comment_input']); 
			} else {
				$validation_form_array['comment_input'] = __('Please enter your comment.');
				$get_validation_option['comment_input'] = __('Please enter your comment.');
			}

			if(isset($get_validation_option['name_input']) && $get_validation_option['name_input'] != ''){
				$validation_form_array['name_input'] = __($get_validation_option['name_input']); 
			} else {
				$validation_form_array['name_input'] = __('Please enter your name.');
				$get_validation_option['name_input'] = __('Please enter your name.');
			}

			if(isset($get_validation_option['email_input']) && $get_validation_option['email_input'] != ''){
				$validation_form_array['email_input'] = __($get_validation_option['email_input']); 
			} else {
				$validation_form_array['email_input'] = __('Please enter your email address.');
				$get_validation_option['email_input'] = __('Please enter your email address.');
			}
			
			if(isset($get_validation_option['website_input']) && $get_validation_option['website_input'] != ''){
				$validation_form_array['website_input'] = __($get_validation_option['website_input']); 
			} else {
				$validation_form_array['website_input'] = __('Please enter your Url.');
				$get_validation_option['website_input'] = __('Please enter your Url.');
			}
			
			$final_array_data = array_merge($validation_form_array, $get_validation_option,$get_Enhanced_Comment_Validation_form_input);
			
			 
			if( isset( $get_validation_option['_enable'] )  ?  $get_validation_option['_enable'] : '' ):
				wp_localize_script( 'input-validation', 'form_obj', $final_array_data );					
			endif;
			
			// reCAPTCHA Google script			
			wp_register_script ( 'Enhanced_Comment_Validation_recaptcha_call', Enhanced_RECAPTCHA_SHOW . "onload=Enhanced_RecaptchaCallback&render=explicit", array('jquery'), false, true );
			wp_enqueue_script  ( 'Enhanced_Comment_Validation_recaptcha_call' );
			 
		}
	}

	// create custom fields
	public function Enhanced_Comment_Validation_custom_fields($fields) {
	
		$commenter = wp_get_current_commenter();		
		$get_Enhanced_Comment_Validation_form_input=  get_option('Enhanced_Comment_Validation_form_input' );
		
		$featured = isset($get_Enhanced_Comment_Validation_form_input['_enable_invisible_captcha']) && $get_Enhanced_Comment_Validation_form_input['_enable_invisible_captcha'] == 1 ? 'invisible' : '';
	
		// recaptcha
		if( isset( $get_Enhanced_Comment_Validation_form_input['_enable_captcha'] )  ?  $get_Enhanced_Comment_Validation_form_input['_enable_captcha'] : '' ){
			$fields['captcha'] = '<p>
						<div class="g-recaptcha" id="comment_form_recaptcha"  data-size="'.$featured.'"></div>						
					</p>';
		}
		return $fields;
	}

	// save custom field data 
	public function Enhanced_Comment_Validation_save_comment_meta_data( $comment_id ) {
		$get_input = get_option( 'Enhanced_Comment_Validation_form_input' );

		if( isset( $get_input['custom_input'] ) && $get_input['custom_input'] != '' ){
			add_comment_meta( $comment_id, $get_input['custom_input'] , $_POST[ $get_input['custom_input'] ] );
		}
		
	}

}
