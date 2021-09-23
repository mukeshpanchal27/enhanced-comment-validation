<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://mukeshpanchal.com/
 * @since      1.0.0
 *
 * @package    Enhanced_Comment_Validation
 * @subpackage Enhanced_Comment_Validation/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Enhanced_Comment_Validation
 * @subpackage Enhanced_Comment_Validation/admin
 * @author     Mukesh Panchal <mukeshpanchal27@gmail.com>
 */
class Enhanced_Comment_Validation_Admin {

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
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;
		register_setting( 'Enhanced_Comment_Validation_settings', 'Enhanced_Comment_Validation_option' ) ;
		register_setting( 'Enhanced_Comment_Validation_form_input_settings', 'Enhanced_Comment_Validation_form_input' ) ;
		
	}

	/**
	 * Register the stylesheets for the admin area.
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

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/enhanced-comment-validation-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
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

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/enhanced-comment-validation-admin.js', array( 'jquery' ), $this->version, false );

	}

	public function Enhanced_Comment_Validation_admin_menu_page() {
		add_menu_page(
			__('Enhanced Comment Validation','Enhanced_Comment_Validation'), 
			'Enhanced Comment Validation',
			'manage_options',
			'Enhanced_Comment_Validation',
			array( $this, 'Enhanced_Comment_Validation_callback' ),
			'dashicons-admin-site'       
		);
	}

	
	
	// admin menu page call back
	function Enhanced_Comment_Validation_callback(){
		?>
		<div class="wrap">

			<h1><?php _e( 'Comment Validation','Enhanced_Comment_Validation' ); ?></h1>

			<div id="tabs">
				<?php
					$current_tab = isset( $_GET['tab'] ) ? $_GET['tab'] : '';
					$first_tab_active = !isset( $_GET['tab'] ) ? ' nav-tab-active' : '';
					$first_tab_active = !isset( $_GET['tab'] ) ? ' nav-tab-active' : '';					
				?>
				<nav class="nav-tab-wrapper  woo-nav-tab-wrapper">

					<a class="nav-link nav-tab<?php echo $first_tab_active; ?>"
						href="<?php echo esc_url( admin_url( 'admin.php?page=Enhanced_Comment_Validation' ) ); ?>"><?php _e( 'Configuration', 'validation' ); ?></a>

					<a class="nav-link nav-tab<?php echo 'google_captcha' === $current_tab ? ' nav-tab-active' : '' ?>"
						href="<?php echo esc_url( admin_url( 'admin.php?page=Enhanced_Comment_Validation&tab=google_captcha' ) ); ?>"><?php _e( 'google captcha', 'validation' ); ?></a>

				</nav>
			</div>

			<form method="post" class="Enhanced-Comment-Validation-form"  action="options.php">

				

				<?php if( $first_tab_active ): 				
					settings_fields( 'Enhanced_Comment_Validation_settings' );					
					$Enhanced_Comment_Validation_option = get_option( 'Enhanced_Comment_Validation_option' );
				?>
					
					<table>
						<tbody>
							
							<tr >
								<td style="border-bottom: 1px solid azure; height: 100px;" >									
									<label class="Enhanced-Comment-Validation-switch">
										<input type="checkbox" class="checkbox"  name="Enhanced_Comment_Validation_option[_enable]" value="1"
											value="1"
											<?php echo ( isset( $Enhanced_Comment_Validation_option['_enable'] ) && ( 1 == $Enhanced_Comment_Validation_option['_enable'] ) ) ? ' checked="checked"' : ''; ?>>
										<div class="Enhanced-Comment-Validation-slider"></div>
									</label>
									<label for="" class="Enhanced-Comment-Validation-switch-lable" ><?php _e( 'Validation Enable', 'Enhanced_Comment_Validation' ); ?></label>
								</td>															
							</tr>							
							
							<td class="Enhanced-Comment-Validation-radio-ul">
								
								<li class="Enhanced-Comment-Validation-radio-li">
									<input type="radio" class="Enhanced-Comment-Validation-radio-button" name="Enhanced_Comment_Validation_option[_show_message]" id="f-show_mess" 
										value = "show_mess" <?php echo ( isset( $Enhanced_Comment_Validation_option['_show_message'] ) && ( "show_mess" == $Enhanced_Comment_Validation_option['_show_message'] ) ) ? ' checked="checked"' : ''; ?>>
									<label for="f-show_mess" class="Enhanced-Comment-Validation-radio-label"><?php _e( 'Show Validation Message Only', 'Enhanced_Comment_Validation' ) ?></label>										
									<div class="Enhanced-Comment-Validation-radio-check"><div class="inside"></div</div>
								</li>
								
								<li class="Enhanced-Comment-Validation-radio-li">
									<input type="radio" class="Enhanced-Comment-Validation-radio-button" name="Enhanced_Comment_Validation_option[_show_message]" id="f-show_style"
										value = "show_style" <?php echo ( isset( $Enhanced_Comment_Validation_option['_show_message'] ) && ( "show_style" == $Enhanced_Comment_Validation_option['_show_message'] ) ) ? ' checked="checked"' : ''; ?>>
									<label for="f-show_style" class="Enhanced-Comment-Validation-radio-label"><?php _e( 'Show Validation Message With Border Style', 'Enhanced_Comment_Validation' ) ?></label>
									<div class="Enhanced-Comment-Validation-radio-check"><div class="inside"></div</div>
								
								</li>
																							
							</td>

							<tr>
								<td >
									<li class="Enhanced-Comment-Validation-input-section">
										<label for="" class="Enhanced-Comment-Validation-lable-input-section"><?php _e( 'Comment','Enhanced_Comment_Validation' ); ?></label>
										<input type="text" class="Enhanced-Comment-Validation-form-input" name="Enhanced_Comment_Validation_option[comment_input]" placeholder="Enter Comment Validation Message"
											value="<?php echo ( isset( $Enhanced_Comment_Validation_option['comment_input'] ) ) ?  $Enhanced_Comment_Validation_option['comment_input'] : ''; ?>">
									</li>

									<li class="Enhanced-Comment-Validation-lable-input-switch">									
										<label class="Enhanced-Comment-Validation-switch">
											<input type="checkbox" class="checkbox"  name="Enhanced_Comment_Validation_option[_comment_input_enable]" value="1"
												value="1"
												<?php echo ( isset( $Enhanced_Comment_Validation_option['_comment_input_enable'] ) && ( 1 == $Enhanced_Comment_Validation_option['_comment_input_enable'] ) ) ? ' checked="checked"' : ''; ?>>
											<div class="Enhanced-Comment-Validation-slider"></div>
										</label>
										<label for="" class="Enhanced-Comment-Validation-switch-lable" ><?php _e( 'Enable Comment Input Validation', 'Enhanced_Comment_Validation' ); ?></label>
									</li>

								</td>
								
								
							</tr>

							<tr>
								<td>
									<li class="Enhanced-Comment-Validation-input-section">
										<label for="" class="Enhanced-Comment-Validation-lable-input-section"><?php _e( 'Name','Enhanced_Comment_Validation' ); ?></label>
										<input type="text" class="Enhanced-Comment-Validation-form-input" name="Enhanced_Comment_Validation_option[name_input]" placeholder="Enter Name Validation Message"
											value="<?php echo ( isset( $Enhanced_Comment_Validation_option['name_input'] ) ) ?  $Enhanced_Comment_Validation_option['name_input'] : ''; ?>">
									</li>
									
									<li class="Enhanced-Comment-Validation-lable-input-switch">									
										<label class="Enhanced-Comment-Validation-switch">
											<input type="checkbox" class="checkbox"  name="Enhanced_Comment_Validation_option[_name_input_enable]" value="1"
												value="1"
												<?php echo ( isset( $Enhanced_Comment_Validation_option['_name_input_enable'] ) && ( 1 == $Enhanced_Comment_Validation_option['_name_input_enable'] ) ) ? ' checked="checked"' : ''; ?>>
											<div class="Enhanced-Comment-Validation-slider"></div>
										</label>
										<label for="" class="Enhanced-Comment-Validation-switch-lable" ><?php _e( 'Enable Name Input Validation', 'Enhanced_Comment_Validation' ); ?></label>
									</li>

								</td>
							</tr>

							<tr>
								<td>
									<li class="Enhanced-Comment-Validation-input-section">
										<label for="" class="Enhanced-Comment-Validation-lable-input-section"><?php _e( 'Email','Enhanced_Comment_Validation' ); ?></label>
										<input type="text" class="Enhanced-Comment-Validation-form-input" name="Enhanced_Comment_Validation_option[email_input]" placeholder="Enter Email Validation Message"
											value="<?php echo ( isset( $Enhanced_Comment_Validation_option['email_input'] ) ) ?  $Enhanced_Comment_Validation_option['email_input'] : ''; ?>">
									</li>

									<li class="Enhanced-Comment-Validation-lable-input-switch">									
										<label class="Enhanced-Comment-Validation-switch">
											<input type="checkbox" class="checkbox"  name="Enhanced_Comment_Validation_option[_email_input_enable]" value="1"
												value="1"
												<?php echo ( isset( $Enhanced_Comment_Validation_option['_email_input_enable'] ) && ( 1 == $Enhanced_Comment_Validation_option['_email_input_enable'] ) ) ? ' checked="checked"' : ''; ?>>
											<div class="Enhanced-Comment-Validation-slider"></div>
										</label>
										<label for="" class="Enhanced-Comment-Validation-switch-lable" ><?php _e( 'Enable Email Input Validation', 'Enhanced_Comment_Validation' ); ?></label>
									</li>

								</td>
							</tr>

							<tr>
								<td>
									<li class="Enhanced-Comment-Validation-input-section">
										<label for="" class="Enhanced-Comment-Validation-lable-input-section"><?php _e( 'Website','Enhanced_Comment_Validation' ); ?></label>
										<input type="text" class="Enhanced-Comment-Validation-form-input" name="Enhanced_Comment_Validation_option[website_input]" placeholder="Enter Website Validation Message"
											value="<?php echo ( isset( $Enhanced_Comment_Validation_option['website_input'] ) ) ?  $Enhanced_Comment_Validation_option['website_input'] : ''; ?>">
									</li>

									<li class="Enhanced-Comment-Validation-lable-input-switch">									
										<label class="Enhanced-Comment-Validation-switch">
											<input type="checkbox" class="checkbox"  name="Enhanced_Comment_Validation_option[_website_input_enable]" value="1"
												value="1"
												<?php echo ( isset( $Enhanced_Comment_Validation_option['_website_input_enable'] ) && ( 1 == $Enhanced_Comment_Validation_option['_website_input_enable'] ) ) ? ' checked="checked"' : ''; ?>>
											<div class="Enhanced-Comment-Validation-slider"></div>
										</label>
										<label for="" class="Enhanced-Comment-Validation-switch-lable" ><?php _e( 'Enable Website Input Validation', 'Enhanced_Comment_Validation' ); ?></label>
									</li>

								</td>
							</tr>

						</tbody>
					</table>

				<?php endif; ?>

				<?php if( 'google_captcha' === $current_tab ? ' nav-tab-active' : ''  ): 
					settings_fields( 'Enhanced_Comment_Validation_form_input_settings' );	
					$Enhanced_Comment_Validation_form_input = get_option( 'Enhanced_Comment_Validation_form_input' );	
				?>

					<table>
						<tbody>
							
							<tr >
								<td  >									
									<label class="Enhanced-Comment-Validation-switch">
										<input type="checkbox" class="checkbox"  name="Enhanced_Comment_Validation_form_input[_enable_captcha]" value="1"
											value="1"
											<?php echo ( isset( $Enhanced_Comment_Validation_form_input['_enable_captcha'] ) && ( 1 == $Enhanced_Comment_Validation_form_input['_enable_captcha'] ) ) ? ' checked="checked"' : ''; ?>>
										<div class="Enhanced-Comment-Validation-slider"></div>
									</label>
									<label for="" class="Enhanced-Comment-Validation-switch-lable" ><?php _e( 'Enable Captcha', 'Enhanced_Comment_Validation' ); ?></label>
								</td>															
							</tr>

							<tr >
								<td style="border-bottom: 1px solid azure; height: 100px;" >									
									<label class="Enhanced-Comment-Validation-switch">
										<input type="checkbox" class="checkbox"  name="Enhanced_Comment_Validation_form_input[_enable_invisible_captcha]" value="1"
											value="1"
											<?php echo ( isset( $Enhanced_Comment_Validation_form_input['_enable_invisible_captcha'] ) && ( 1 == $Enhanced_Comment_Validation_form_input['_enable_invisible_captcha'] ) ) ? ' checked="checked"' : ''; ?>>
										<div class="Enhanced-Comment-Validation-slider"></div>
									</label>
									<label for="" class="Enhanced-Comment-Validation-switch-lable" ><?php _e( 'Enable Invisible Captcha', 'Enhanced_Comment_Validation' ); ?></label>
								</td>															
							</tr>
							
							<tr>
								<td class="Enhanced-Comment-Validation-input-section">
									<label for="" class="Enhanced-Comment-Validation-lable-input-new-commet"> <?php _e( 'Site Key','Enhanced_Comment_Validation' ); ?> </label>
									<input style="width: 30em !important;" type="text" class="Enhanced-Comment-Validation-form-input" name="Enhanced_Comment_Validation_form_input[google_captcha_site_key]" placeholder="Enter Name"
										value="<?php echo ( isset( $Enhanced_Comment_Validation_form_input['google_captcha_site_key'] ) ) ?  $Enhanced_Comment_Validation_form_input['google_captcha_site_key'] : ''; ?>">
								</td>
							</tr>

							<!-- <tr>
								<td class="Enhanced-Comment-Validation-input-section">
									<label for="" class="Enhanced-Comment-Validation-lable-input-new-commet"> <?php _e( 'Secret Key' ,'Enhanced_Comment_Validation'); ?> </label>
									<input style="width: 30em !important;" type="text" class="Enhanced-Comment-Validation-form-input" name="Enhanced_Comment_Validation_form_input[google_captcha_secret_key]" placeholder="Enter Name"
										value="<?php echo ( isset( $Enhanced_Comment_Validation_form_input['google_captcha_secret_key'] ) ) ?  $Enhanced_Comment_Validation_form_input['google_captcha_secret_key'] : ''; ?>">
								</td>
							</tr> -->

						</tbody>
					</table>

				<?php endif; ?>

				<?php submit_button('Save Changes', 'Enhanced-Comment-Validation-form-submit'); ?>
			</form>
		</div>

	<?php
	}
}
