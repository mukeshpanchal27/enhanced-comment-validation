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
		register_setting( 'enhanced_comment_validation_settings', 'enhanced_comment_validation_settings' ) ;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {
		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/enhanced-comment-validation-admin.css', array(), $this->version, 'all' );
	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {
		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/enhanced-comment-validation-admin.js', array( 'jquery' ), $this->version, false );

	}

	public function enhanced_comment_validation_admin_menu_page() {

		add_menu_page(
			__( 'Enhanced Comment Validation', 'enhanced-comment-validation' ),
			__( 'Enhanced Comment Validation', 'enhanced-comment-validation' ),
			'manage_options',
			'enhanced-comment-validation',
			array( $this, 'enhanced_comment_validation_callback' ),
			'dashicons-shield'
		);
	}

	public function enhanced_comment_validation_callback() {
		?>
		<div class="wrap">

			<h1><?php _e( 'Comment Validation', 'enhanced-comment-validation' ); ?></h1>

			<div class="enhanced-comment-validation-tabs">
				<?php
					$current_tab = isset( $_GET['tab'] ) ? $_GET['tab'] : '';
					$first_tab_active = !isset( $_GET['tab'] ) ? ' nav-tab-active' : '';
				?>
				<nav class="nav-tab-wrapper  woo-nav-tab-wrapper">
					<a class="nav-link nav-tab<?php echo $first_tab_active; ?>" href="<?php echo esc_url( admin_url( 'admin.php?page=enhanced-comment-validation' ) ); ?>">
						<?php _e( 'Settings', 'validation' ); ?>
					</a>
					<a class="nav-link nav-tab<?php echo 'google_captcha' === $current_tab ? ' nav-tab-active' : '' ?>" href="<?php echo esc_url( admin_url( 'admin.php?page=enhanced-comment-validation&tab=google_captcha' ) ); ?>">
						<?php _e( 'Google Captcha', 'validation' ); ?>
					</a>
				</nav>
			</div>

			<form method="post" class="enhanced-comment-validation-form" action="options.php">
				<table>
					<tbody>
					<?php 

						settings_fields( 'enhanced_comment_validation_settings' );	
						$enhanced_comment_validation_settings = get_option( 'enhanced_comment_validation_settings' );

						if( 'google_captcha' === $current_tab ) {
					?>
						<tr>
							<td>
								<label class="enhanced-comment-validation-switch">
									<input type="checkbox" class="checkbox"  name="enhanced_comment_validation_settings[_enable_captcha]" value="yes" <?php echo ( isset( $enhanced_comment_validation_settings['_enable_captcha'] ) && ( 'yes' === $enhanced_comment_validation_settings['_enable_captcha'] ) ) ? ' checked="checked"' : ''; ?> />
									<div class="enhanced-comment-validation-slider"></div>
								</label>
								<label for="" class="enhanced-comment-validation-switch-lable">
									<?php _e( 'Enable Captcha', 'enhanced-comment-validation' ); ?>
								</label>
							</td>
						</tr>
						<tr>
							<td>
								<label class="enhanced-comment-validation-switch">
									<input type="checkbox" class="checkbox"  name="enhanced_comment_validation_settings[_enable_invisible_captcha]" value="yes" <?php echo ( isset( $enhanced_comment_validation_settings['_enable_invisible_captcha'] ) && ( 'yes' === $enhanced_comment_validation_settings['_enable_invisible_captcha'] ) ) ? ' checked="checked"' : ''; ?>>
									<div class="enhanced-comment-validation-slider"></div>
								</label>
								<label for="" class="enhanced-comment-validation-switch-lable">
									<?php _e( 'Enable Invisible Captcha', 'enhanced-comment-validation' ); ?>
								</label>
							</td>
						</tr>
						<tr>
							<td class="enhanced-comment-validation-input-section">
								<label for="" class="enhanced-comment-validation-lable-input-new-commet">
									<?php _e( 'Site Key','enhanced_comment_validation' ); ?>
								</label>
								<input type="text" class="enhanced-comment-validation-form-input" name="enhanced_comment_validation_settings[google_captcha_site_key]" placeholder="Enter Name" value="<?php echo ( isset( $enhanced_comment_validation_settings['google_captcha_site_key'] ) ) ?  $enhanced_comment_validation_settings['google_captcha_site_key'] : ''; ?>">
							</td>
						</tr>

						<!-- <tr>
							<td class="enhanced-comment-validation-input-section">
								<label for="" class="enhanced-comment-validation-lable-input-new-commet"> <?php _e( 'Secret Key' ,'enhanced_comment_validation'); ?> </label>
								<input style="width: 30em !important;" type="text" class="enhanced-comment-validation-form-input" name="enhanced_comment_validation_settings[google_captcha_secret_key]" placeholder="Enter Name"
									value="<?php echo ( isset( $enhanced_comment_validation_settings['google_captcha_secret_key'] ) ) ?  $enhanced_comment_validation_settings['google_captcha_secret_key'] : ''; ?>">
							</td>
						</tr> -->
					<?php 
					} else {
					?>
						<tr>
							<td>
								<label class="enhanced-comment-validation-switch">
									<input type="checkbox" class="checkbox" name="enhanced_comment_validation_settings[_enable_validation]" value="yes" <?php echo ( isset( $enhanced_comment_validation_settings['_enable_validation'] ) && ( 'yes' === $enhanced_comment_validation_settings['_enable_validation'] ) ) ? ' checked="checked"' : ''; ?> />
									<div class="enhanced-comment-validation-slider"></div>
								</label>
								<label for="" class="enhanced-comment-validation-switch-lable" ><?php _e( 'Enable Comment Validation', 'enhanced-comment-validation' ); ?></label>
							</td>
						</tr>
						<tr>
							<td class="enhanced-comment-validation-radio-ul">
								<ul>
									<li class="enhanced-comment-validation-radio-li">
										<input type="radio" class="enhanced-comment-validation-radio-button" name="enhanced_comment_validation_settings[_message_style]" id="enhanced-comment-validation-style1" value="style1" <?php echo ( isset( $enhanced_comment_validation_settings['_message_style'] ) && ( "style1" === $enhanced_comment_validation_settings['_message_style'] ) ) ? ' checked="checked"' : ''; ?> />
										<label for="enhanced-comment-validation-style1" class="enhanced-comment-validation-radio-label"><?php _e( 'Show message and border', 'enhanced-comment-validation' ) ?></label>
										<div class="enhanced-comment-validation-radio-check"></div>
									</li>
									<li class="enhanced-comment-validation-radio-li">
										<input type="radio" class="enhanced-comment-validation-radio-button" name="enhanced_comment_validation_settings[_message_style]" id="enhanced-comment-validation-style2" value="style2" <?php echo ( isset( $enhanced_comment_validation_settings['_message_style'] ) && ( "style2" === $enhanced_comment_validation_settings['_message_style'] ) ) ? ' checked="checked"' : ''; ?> />
										<label for="enhanced-comment-validation-style2" class="enhanced-comment-validation-radio-label"><?php _e( 'Show message only', 'enhanced-comment-validation' ) ?></label>
										<div class="enhanced-comment-validation-radio-check"></div>
									</li>
								</ul>
							</td>
						</tr>
						<tr>
							<td>
								<h2 class="title"><?php _e( 'Other Configuration', 'enhanced-comment-validation' ) ?></h2>
							</td>
						</tr>
						<tr>
							<td>
								<ul>
									<li class="enhanced-comment-validation-lable-input-switch">
										<label class="enhanced-comment-validation-switch">
											<input type="checkbox" class="checkbox"  name="enhanced_comment_validation_settings[_enable_comment]" value="yes" <?php echo ( isset( $enhanced_comment_validation_settings['_enable_comment'] ) && ( 'yes' === $enhanced_comment_validation_settings['_enable_comment'] ) ) ? ' checked="checked"' : ''; ?>>
											<div class="enhanced-comment-validation-slider"></div>
										</label>
										<label for="" class="enhanced-comment-validation-switch-lable" ><?php _e( 'Enable Comment Validation', 'enhanced-comment-validation' ); ?></label>
									</li>
									<li class="enhanced-comment-validation-input-section">
										<label for="" class="enhanced-comment-validation-lable-input-section"><?php _e( 'Comment', 'enhanced_comment_validation' ); ?></label>
										<input type="text" class="enhanced-comment-validation-form-input" name="enhanced_comment_validation_settings[_comment_message]" placeholder="<?php _e( 'Enter Comment Validation Message', 'enhanced_comment_validation' ); ?>" value="<?php echo ( isset( $enhanced_comment_validation_settings['_comment_message'] ) ) ?  $enhanced_comment_validation_settings['_comment_message'] : ''; ?>">
									</li>
								</ul>
							</td>
						</tr>

						<tr>
							<td>
								<ul>
									<li class="enhanced-comment-validation-lable-input-switch">
										<label class="enhanced-comment-validation-switch">
											<input type="checkbox" class="checkbox"  name="enhanced_comment_validation_settings[_enable_name]" value="yes" <?php echo ( isset( $enhanced_comment_validation_settings['_enable_name'] ) && ( 'yes' === $enhanced_comment_validation_settings['_enable_name'] ) ) ? ' checked="checked"' : ''; ?>>
											<div class="enhanced-comment-validation-slider"></div>
										</label>
										<label for="" class="enhanced-comment-validation-switch-lable" ><?php _e( 'Enable Name Validation', 'enhanced-comment-validation' ); ?></label>
									</li>
									<li class="enhanced-comment-validation-input-section">
										<label for="" class="enhanced-comment-validation-lable-input-section"><?php _e( 'Name','enhanced_comment_validation' ); ?></label>
										<input type="text" class="enhanced-comment-validation-form-input" name="enhanced_comment_validation_settings[_name_message]" placeholder="<?php _e( 'Enter Name Validation Message', 'enhanced-comment-validation' ); ?>" value="<?php echo ( isset( $enhanced_comment_validation_settings['_name_message'] ) ) ?  $enhanced_comment_validation_settings['_name_message'] : ''; ?>">
									</li>
								</ul>
							</td>
						</tr>
						<tr>
							<td>
								<ul>
									<li class="enhanced-comment-validation-lable-input-switch">
										<label class="enhanced-comment-validation-switch">
											<input type="checkbox" class="checkbox"  name="enhanced_comment_validation_settings[_enable_email]" value="yes" <?php echo ( isset( $enhanced_comment_validation_settings['_enable_email'] ) && ( 'yes' === $enhanced_comment_validation_settings['_enable_email'] ) ) ? ' checked="checked"' : ''; ?>>
											<div class="enhanced-comment-validation-slider"></div>
										</label>
										<label for="" class="enhanced-comment-validation-switch-lable"><?php _e( 'Enable Email Input Validation', 'enhanced-comment-validation' ); ?></label>
									</li>
									<li class="enhanced-comment-validation-input-section">
										<label for="" class="enhanced-comment-validation-lable-input-section"><?php _e( 'Email','enhanced_comment_validation' ); ?></label>
										<input type="text" class="enhanced-comment-validation-form-input" name="enhanced_comment_validation_settings[_email_message]" placeholder="<?php _e( 'Enter Email Validation Message', 'enhanced-comment-validation' ); ?>" value="<?php echo ( isset( $enhanced_comment_validation_settings['_email_message'] ) ) ?  $enhanced_comment_validation_settings['_email_message'] : ''; ?>">
									</li>
								</ul>
							</td>
						</tr>
						<tr>
							<td>
								<ul>
									<li class="enhanced-comment-validation-lable-input-switch">
										<label class="enhanced-comment-validation-switch">
											<input type="checkbox" class="checkbox"  name="enhanced_comment_validation_settings[_enable_website]" value="yes" <?php echo ( isset( $enhanced_comment_validation_settings['_enable_website'] ) && ( 'yes' === $enhanced_comment_validation_settings['_enable_website'] ) ) ? ' checked="checked"' : ''; ?> />
											<div class="enhanced-comment-validation-slider"></div>
										</label>
										<label for="" class="enhanced-comment-validation-switch-lable" ><?php _e( 'Enable Website Input Validation', 'enhanced-comment-validation' ); ?></label>
									</li>
									<li class="enhanced-comment-validation-input-section">
										<label for="" class="enhanced-comment-validation-lable-input-section"><?php _e( 'Website', 'enhanced_comment_validation' ); ?></label>
										<input type="text" class="enhanced-comment-validation-form-input" name="enhanced_comment_validation_settings[_website_message]" placeholder="<?php _e( 'Enter Website Validation Message', 'enhanced_comment_validation' ); ?>" value="<?php echo ( isset( $enhanced_comment_validation_settings['_website_message'] ) ) ?  $enhanced_comment_validation_settings['_website_message'] : ''; ?>">
									</li>
								</ul>
							</td>
						</tr>
					<?php } ?>
				</tbody>
			</table>
			<?php submit_button( 'Save Changes', 'enhanced-comment-validation' ); ?>
			</form>
		</div>

	<?php
	}
}
