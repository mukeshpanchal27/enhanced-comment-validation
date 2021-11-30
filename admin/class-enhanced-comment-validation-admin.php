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
	 * Plugin update script.
	 *
	 * @since    1.0.1
	 */
	public function enhanced_comment_validation_update_plugin() {

		$enhanced_comment_validation_settings = maybe_unserialize( get_option( 'enhanced_comment_validation_settings', false ) );
		if ( !isset( $enhanced_comment_validation_settings['_captcha_theme'] ) && !empty( $enhanced_comment_validation_settings ) ) {
			$enhanced_comment_validation_settings_new_elements = array();
			$enhanced_comment_validation_settings_new_elements['_captcha_theme'] = 'light';
			$enhanced_comment_validation_settings_new_elements['_captcha_invisible_badge'] = 'bottomright';

			$enhanced_comment_validation_settings_final = array_merge( $enhanced_comment_validation_settings, $enhanced_comment_validation_settings_new_elements );
			update_option( 'enhanced_comment_validation_settings', $enhanced_comment_validation_settings_final );
		}
		
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
		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/enhanced-comment-validation-admin.js', array( 'jquery' ), $this->version, true );

	}

	public function add_plugin_action_links( $actions ) {
		$mylinks = array(
			'<a href="' . admin_url( 'admin.php?page=enhanced-comment-validation' ) . '">'.__( 'Settings', 'enhanced-comment-validation' ).'</a>',
		);
		
		$actions = array_merge( $actions, $mylinks );
		return $actions;
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

			<h1><?php _e( 'Enhanced Comment Validation', 'enhanced-comment-validation' ); ?></h1>

			<div class="enhanced-comment-validation-tabs">
				<?php
					$current_tab = isset( $_GET['tab'] ) ? sanitize_key( $_GET['tab'] ) : '';
					$first_tab_active = !isset( $_GET['tab'] ) ? 'nav-tab-active' : '';
				?>
				<nav class="nav-tab-wrapper  woo-nav-tab-wrapper">
					<a class="nav-link nav-tab <?php echo sanitize_key( $first_tab_active ); ?>" href="<?php echo esc_url( admin_url( 'admin.php?page=enhanced-comment-validation' ) ); ?>">
						<?php _e( 'Settings', 'enhanced-comment-validation' ); ?>
					</a>
					<a class="nav-link nav-tab <?php echo 'google_captcha' === $current_tab ? 'nav-tab-active' : '' ?>" href="<?php echo esc_url( admin_url( 'admin.php?page=enhanced-comment-validation&tab=google_captcha' ) ); ?>">
						<?php _e( 'Google ReCAPTCHA', 'enhanced-comment-validation' ); ?>
					</a>
				</nav>
			</div>

			<form method="post" class="enhanced-comment-validation-form" action="options.php">
				<?php 

					settings_fields( 'enhanced_comment_validation_settings' );	
					$enhanced_comment_validation_settings = get_option( 'enhanced_comment_validation_settings' );
				?>
				<table class="enhanced-comment-validation-captcha<?php echo ( 'google_captcha' !== $current_tab ) ? ' hidden' : ''; ?>">
					<tbody>
						<tr>
							<td>
								<h2><?php _e( 'Authentication', 'enhanced-comment-validation' ); ?></h2>
								<p class="enhanced-comment-validation-captcha-message"><?php 
									printf( 
										__( 'Register your website with Google to get required API keys and enter theme below. %1$sGet the API keys%2$s.' ),
										'<a href="https://www.google.com/recaptcha/admin/create" target="_blank">',
										'</a>'
									);
								?></p>
							</td>
						</tr>
						<tr>
							<td>
								<label class="enhanced-comment-validation-switch">
									<input type="checkbox" class="checkbox" name="enhanced_comment_validation_settings[_enable_captcha]" value="yes"<?php echo ( isset( $enhanced_comment_validation_settings['_enable_captcha'] ) && 'yes' === esc_attr( $enhanced_comment_validation_settings['_enable_captcha'] ) ) ? ' checked="checked"' : ''; ?> />
									<div class="enhanced-comment-validation-slider"></div>
								</label>
								<label for="" class="enhanced-comment-validation-switch-lable">
									<?php _e( 'Enable reCAPTCHA', 'enhanced-comment-validation' ); ?>
								</label>
							</td>
						</tr>
						<tr>
							<td class="enhanced-comment-validation-radio-ul">
								<?php
									$enhanced_comment_validation_hide = $enhanced_comment_validation_captcha_badge_hide = '';
									if ( 'v3' === $enhanced_comment_validation_settings['_captcha_version'] ) {
										$enhanced_comment_validation_hide = ' style="display:none;"';
									}

									if ( 'v3' === $enhanced_comment_validation_settings['_captcha_version'] || ( isset( $enhanced_comment_validation_settings['_enable_invisible_captcha'] ) && 'yes' === $enhanced_comment_validation_settings['_enable_invisible_captcha'] ) ) {
										$enhanced_comment_validation_captcha_badge_hide = ' style=display:block;';
									}
								?>
								<ul class="enhanced-comment-validation-recaptcha-wrapper enhanced-comment-validation-top-space">
									<li class="enhanced-comment-validation-radio-li">
										<input type="radio" class="enhanced-comment-validation-recaptcha-v2 enhanced-comment-validation-radio-button" name="enhanced_comment_validation_settings[_captcha_version]" id="enhanced-comment-validation-recaptcha-v2" value="v2"<?php echo ( isset( $enhanced_comment_validation_settings['_captcha_version'] ) && "v2" === esc_attr( $enhanced_comment_validation_settings['_captcha_version'] ) ) ? ' checked="checked"' : ''; ?> />
										<label for="enhanced-comment-validation-recaptcha-v2" class="enhanced-comment-validation-radio-label"><?php _e( 'reCAPTCHA v2', 'enhanced-comment-validation' ); ?></label>
										<div class="enhanced-comment-validation-radio-check"></div>
									</li>
									<li class="enhanced-comment-validation-center-alignment enhanced-comment-validation-left-space"<?php echo esc_attr( $enhanced_comment_validation_hide ); ?>>
										<label for="" class="enhanced-comment-validation-lable-input-new-commet">
											<?php _e( 'Validation Message', 'enhanced_comment_validation' ); ?>
										</label>
										<input type="text" class=" enhanced-comment-validation-form-input" name="enhanced_comment_validation_settings[_validation_message_v2]" value="<?php echo isset( $enhanced_comment_validation_settings['_validation_message_v2'] ) ? esc_html( $enhanced_comment_validation_settings['_validation_message_v2'] ) : ''; ?>">
									</li>
									<li class="enhanced-comment-validation-left-space"<?php echo esc_attr( $enhanced_comment_validation_hide ); ?>>
										<label class="enhanced-comment-validation-switch">
											<input type="checkbox" class="checkbox enhanced-comment-validation-invisible-captcha-checkbox" name="enhanced_comment_validation_settings[_enable_invisible_captcha]" value="yes"<?php echo ( isset( $enhanced_comment_validation_settings['_enable_invisible_captcha'] ) && 'yes' === esc_attr( $enhanced_comment_validation_settings['_enable_invisible_captcha'] ) ) ? ' checked="checked"' : ''; ?>>
											<div class="enhanced-comment-validation-slider"></div>
										</label>
										<label for="" class="enhanced-comment-validation-switch-lable">
											<?php _e( 'Enable Invisible Captcha', 'enhanced-comment-validation' ); ?>
										</label>
									</li>
									<li class="enhanced-comment-validation-radio-li">
										<input type="radio" class="enhanced-comment-validation-recaptcha-v3 enhanced-comment-validation-radio-button" name="enhanced_comment_validation_settings[_captcha_version]" id="enhanced-comment-validation-recaptcha-v3" value="v3"<?php echo ( isset( $enhanced_comment_validation_settings['_captcha_version'] ) && "v3" === esc_attr( $enhanced_comment_validation_settings['_captcha_version'] ) ) ? ' checked="checked"' : ''; ?> />
										<label for="enhanced-comment-validation-recaptcha-v3" class="enhanced-comment-validation-radio-label"><?php _e( 'reCAPTCHA v3', 'enhanced-comment-validation' ) ?></label>
										<div class="enhanced-comment-validation-radio-check"></div>
									</li>
								</ul>
							</td>
						</tr>
						<tr>
							<td>
								<ul>
									<li class="enhanced-comment-validation-center-alignment">
										<label for="" class="enhanced-comment-validation-lable-input-new-commet">
											<?php _e( 'Site Key', 'enhanced_comment_validation' ); ?>
										</label>
										<input type="text" class="enhanced-comment-validation-lable-input-site-key enhanced-comment-validation-form-input" name="enhanced_comment_validation_settings[_site_key]" value="<?php echo isset( $enhanced_comment_validation_settings['_site_key'] ) ? esc_html( $enhanced_comment_validation_settings['_site_key'] ) : ''; ?>">
									</li>
									<li class="enhanced-comment-validation-center-alignment">
										<label for="" class="enhanced-comment-validation-lable-input-new-commet">
											<?php _e( 'Secret Key', 'enhanced_comment_validation' ); ?>
										</label>
										<input type="text" class="enhanced-comment-validation-lable-input-secret-key enhanced-comment-validation-form-input" name="enhanced_comment_validation_settings[_secret_key]" value="<?php echo isset( $enhanced_comment_validation_settings['_secret_key'] ) ? esc_html( $enhanced_comment_validation_settings['_secret_key'] ) : ''; ?>">
									</li>
								</ul>
							</td>
						</tr>
						<tr>
							<td class="enhanced-comment-validation-radio-ul">
								<ul class="enhanced-comment-validation-top-space">
									<li class="enhanced-comment-validation-title">
										<h2><?php _e( 'Recaptcha Theme', 'enhanced-comment-validation' ); ?></h2>
									</li>
									<li class="enhanced-comment-validation-radio-li enhanced-comment-validation-captcha_theme">
										<input type="radio" class="enhanced-comment-validation-radio-button" name="enhanced_comment_validation_settings[_captcha_theme]" id="enhanced-comment-validation-light-theme" value="light" <?php echo ( isset( $enhanced_comment_validation_settings['_captcha_theme'] ) && "light" === esc_attr( $enhanced_comment_validation_settings['_captcha_theme'] ) ) ? ' checked="checked"' : ''; ?> />
										<label for="enhanced-comment-validation-light-theme" class="enhanced-comment-validation-radio-label"><?php _e( 'Light', 'enhanced-comment-validation' ) ?></label>
										<div class="enhanced-comment-validation-radio-check"></div>
									</li>
									<li class="enhanced-comment-validation-radio-li enhanced-comment-validation-captcha_theme">
										<input type="radio" class="enhanced-comment-validation-radio-button" name="enhanced_comment_validation_settings[_captcha_theme]" id="enhanced-comment-validation-dark-theme" value="dark" <?php echo ( isset( $enhanced_comment_validation_settings['_captcha_theme'] ) && "dark" === esc_attr( $enhanced_comment_validation_settings['_captcha_theme'] ) ) ? ' checked="checked"' : ''; ?> />
										<label for="enhanced-comment-validation-dark-theme" class="enhanced-comment-validation-radio-label"><?php _e( 'Dark', 'enhanced-comment-validation' ) ?></label>
										<div class="enhanced-comment-validation-radio-check"></div>
									</li>
								</ul>
							</td>
						</tr>
						<tr class="enhanced-comment-validation-invisible-captcha_badge hidden" <?php echo esc_attr( $enhanced_comment_validation_captcha_badge_hide ); ?>>
							<td class="enhanced-comment-validation-radio-ul">
								<ul class="enhanced-comment-validation-top-space">
									<li class="enhanced-comment-validation-title-badge ">
										<h2><?php _e( 'Badge Position', 'enhanced-comment-validation' ); ?></h2>
									</li>
									<li class="enhanced-comment-validation-radio-li">
										<input type="radio" class="enhanced-comment-validation-radio-button" name="enhanced_comment_validation_settings[_captcha_invisible_badge]" id="enhanced-comment-validation-invisible-right" value="bottomright" <?php echo ( isset( $enhanced_comment_validation_settings['_captcha_invisible_badge'] ) && "bottomright" === esc_attr( $enhanced_comment_validation_settings['_captcha_invisible_badge'] ) ) ? ' checked="checked"' : ''; ?> />
										<label for="enhanced-comment-validation-invisible-right" class="enhanced-comment-validation-radio-label"><?php _e( 'Bottom Right', 'enhanced-comment-validation' ) ?></label>
										<div class="enhanced-comment-validation-radio-check"></div>
									</li>
									<li class="enhanced-comment-validation-radio-li">
										<input type="radio" class="enhanced-comment-validation-radio-button" name="enhanced_comment_validation_settings[_captcha_invisible_badge]" id="enhanced-comment-validation-invisible-left" value="bottomleft" <?php echo ( isset( $enhanced_comment_validation_settings['_captcha_invisible_badge'] ) && "bottomleft" === esc_attr( $enhanced_comment_validation_settings['_captcha_invisible_badge'] ) ) ? ' checked="checked"' : ''; ?> />
										<label for="enhanced-comment-validation-invisible-left" class="enhanced-comment-validation-radio-label"><?php _e( 'Bottom Left', 'enhanced-comment-validation' ) ?></label>
										<div class="enhanced-comment-validation-radio-check"></div>
									</li>
									<li class="enhanced-comment-validation-radio-li">
										<input type="radio" class="enhanced-comment-validation-radio-button" name="enhanced_comment_validation_settings[_captcha_invisible_badge]" id="enhanced-comment-validation-invisible-inline" value="inline" <?php echo ( isset( $enhanced_comment_validation_settings['_captcha_invisible_badge'] ) && "inline" === esc_attr( $enhanced_comment_validation_settings['_captcha_invisible_badge'] ) ) ? ' checked="checked"' : ''; ?> />
										<label for="enhanced-comment-validation-invisible-inline" class="enhanced-comment-validation-radio-label"><?php _e( 'Inline', 'enhanced-comment-validation' ) ?></label>
										<div class="enhanced-comment-validation-radio-check"></div>
									</li>
								</ul>
							</td>
						</tr>
					</tbody>
				</table>
				<table<?php echo ( 'google_captcha' === $current_tab ) ? ' class="hidden"' : ''; ?>>
					<tbody>
						<tr>
							<td>
								<h2 class="title"><?php _e( 'Comment Validation', 'enhanced-comment-validation' ) ?></h2>
							</td>
						</tr>
						<tr>
							<td>
								<label class="enhanced-comment-validation-switch">
									<input type="checkbox" class="checkbox" name="enhanced_comment_validation_settings[_enable_validation]" value="yes"<?php echo ( isset( $enhanced_comment_validation_settings['_enable_validation'] ) && 'yes' === esc_attr( $enhanced_comment_validation_settings['_enable_validation'] ) ) ? ' checked="checked"' : ''; ?> />
									<div class="enhanced-comment-validation-slider"></div>
								</label>
								<label for="" class="enhanced-comment-validation-switch-lable" ><?php _e( 'Enable Comment Validation', 'enhanced-comment-validation' ); ?></label>
							</td>
						</tr>
						<tr>
							<td>
								<h2 class="title enhanced-comment-validation-top-space"><?php _e( 'Validation Message Style', 'enhanced-comment-validation' ) ?></h2>
							</td>
						</tr>
						<tr>
							<td class="enhanced-comment-validation-radio-ul">
								<ul>
									<li class="enhanced-comment-validation-radio-li">
										<input type="radio" class="enhanced-comment-validation-radio-button" name="enhanced_comment_validation_settings[_message_style]" id="enhanced-comment-validation-style1" value="style1"<?php echo ( isset( $enhanced_comment_validation_settings['_message_style'] ) && "style1" === esc_attr( $enhanced_comment_validation_settings['_message_style'] ) ) ? ' checked="checked"' : ''; ?> />
										<label for="enhanced-comment-validation-style1" class="enhanced-comment-validation-radio-label"><?php _e( 'Border only', 'enhanced-comment-validation' ) ?></label>
										<div class="enhanced-comment-validation-radio-check"></div>
									</li>
									<li class="enhanced-comment-validation-radio-li">
										<input type="radio" class="enhanced-comment-validation-radio-button" name="enhanced_comment_validation_settings[_message_style]" id="enhanced-comment-validation-style2" value="style2"<?php echo ( isset( $enhanced_comment_validation_settings['_message_style'] ) && "style2" === esc_attr( $enhanced_comment_validation_settings['_message_style'] ) ) ? ' checked="checked"' : ''; ?> />
										<label for="enhanced-comment-validation-style2" class="enhanced-comment-validation-radio-label"><?php _e( 'Message only', 'enhanced-comment-validation' ) ?></label>
										<div class="enhanced-comment-validation-radio-check"></div>
									</li>
									<li class="enhanced-comment-validation-radio-li">
										<input type="radio" class="enhanced-comment-validation-radio-button" name="enhanced_comment_validation_settings[_message_style]" id="enhanced-comment-validation-style3" value="style3"<?php echo ( isset( $enhanced_comment_validation_settings['_message_style'] ) && "style3" === esc_attr( $enhanced_comment_validation_settings['_message_style'] ) ) ? ' checked="checked"' : ''; ?> />
										<label for="enhanced-comment-validation-style3" class="enhanced-comment-validation-radio-label"><?php _e( 'Border and Message both', 'enhanced-comment-validation' ) ?></label>
										<div class="enhanced-comment-validation-radio-check"></div>
									</li>
								</ul>
							</td>
						</tr>
						<tr>
							<td>
								<h2 class="title enhanced-comment-validation-top-space"><?php _e( 'Validation and Custom Message', 'enhanced-comment-validation' ) ?></h2>
							</td>
						</tr>
						<tr>
							<td>
								<ul>
									<li class="enhanced-comment-validation-lable-input-switch">
										<label class="enhanced-comment-validation-switch">
											<input type="checkbox" class="checkbox" name="enhanced_comment_validation_settings[_enable_comment]" value="yes"<?php echo ( isset( $enhanced_comment_validation_settings['_enable_comment'] ) && 'yes' === esc_attr( $enhanced_comment_validation_settings['_enable_comment'] ) ) ? ' checked="checked"' : ''; ?>>
											<div class="enhanced-comment-validation-slider"></div>
										</label>
										<label for="" class="enhanced-comment-validation-switch-lable" ><?php _e( 'Enable Comment Validation', 'enhanced-comment-validation' ); ?></label>
									</li>
									<li class="enhanced-comment-validation-input-section">
										<label for="" class="enhanced-comment-validation-lable-input-section"><?php _e( 'Comment', 'enhanced_comment_validation' ); ?></label>
										<input type="text" class="enhanced-comment-validation-form-input" name="enhanced_comment_validation_settings[_comment_message]" placeholder="<?php _e( 'Please enter your comment', 'enhanced_comment_validation' ); ?>" value="<?php echo isset( $enhanced_comment_validation_settings['_comment_message'] ) ? esc_html( $enhanced_comment_validation_settings['_comment_message'] ) : ''; ?>">
									</li>
								</ul>
							</td>
						</tr>
						<tr>
							<td>
								<ul>
									<li class="enhanced-comment-validation-lable-input-switch">
										<label class="enhanced-comment-validation-switch">
											<input type="checkbox" class="checkbox" name="enhanced_comment_validation_settings[_enable_author]" value="yes"<?php echo ( isset( $enhanced_comment_validation_settings['_enable_author'] ) && 'yes' === esc_attr( $enhanced_comment_validation_settings['_enable_author'] ) ) ? ' checked="checked"' : ''; ?>>
											<div class="enhanced-comment-validation-slider"></div>
										</label>
										<label for="" class="enhanced-comment-validation-switch-lable" ><?php _e( 'Enable Name Validation', 'enhanced-comment-validation' ); ?></label>
									</li>
									<li class="enhanced-comment-validation-input-section">
										<label for="" class="enhanced-comment-validation-lable-input-section"><?php _e( 'Name','enhanced_comment_validation' ); ?></label>
										<input type="text" class="enhanced-comment-validation-form-input" name="enhanced_comment_validation_settings[_author_message]" placeholder="<?php _e( 'Enter Name Validation Message', 'enhanced-comment-validation' ); ?>" value="<?php echo isset( $enhanced_comment_validation_settings['_author_message'] ) ? esc_html( $enhanced_comment_validation_settings['_author_message'] ) : ''; ?>">
									</li>
								</ul>
							</td>
						</tr>
						<tr>
							<td>
								<ul>
									<li class="enhanced-comment-validation-lable-input-switch">
										<label class="enhanced-comment-validation-switch">
											<input type="checkbox" class="checkbox" name="enhanced_comment_validation_settings[_enable_email]" value="yes"<?php echo ( isset( $enhanced_comment_validation_settings['_enable_email'] ) && 'yes' === esc_attr( $enhanced_comment_validation_settings['_enable_email'] ) ) ? ' checked="checked"' : ''; ?> />
											<div class="enhanced-comment-validation-slider"></div>
										</label>
										<label for="" class="enhanced-comment-validation-switch-lable"><?php _e( 'Enable Email Validation', 'enhanced-comment-validation' ); ?></label>
									</li>
									<li class="enhanced-comment-validation-input-section">
										<label for="" class="enhanced-comment-validation-lable-input-section"><?php _e( 'Email', 'enhanced_comment_validation' ); ?></label>
										<input type="text" class="enhanced-comment-validation-form-input" name="enhanced_comment_validation_settings[_email_message]" placeholder="<?php _e( 'Enter Email Validation Message', 'enhanced-comment-validation' ); ?>" value="<?php echo isset( $enhanced_comment_validation_settings['_email_message'] ) ? esc_html( $enhanced_comment_validation_settings['_email_message'] ) : ''; ?>" />
									</li>
								</ul>
							</td>
						</tr>
						<tr>
							<td>
								<ul>
									<li class="enhanced-comment-validation-lable-input-switch">
										<label class="enhanced-comment-validation-switch">
											<input type="checkbox" class="checkbox" name="enhanced_comment_validation_settings[_enable_website]" value="yes"<?php echo ( isset( $enhanced_comment_validation_settings['_enable_website'] ) && 'yes' === esc_attr( $enhanced_comment_validation_settings['_enable_website'] ) ) ? ' checked="checked"' : ''; ?> />
											<div class="enhanced-comment-validation-slider"></div>
										</label>
										<label for="" class="enhanced-comment-validation-switch-lable" ><?php _e( 'Enable Website Validation', 'enhanced-comment-validation' ); ?></label>
									</li>
									<li class="enhanced-comment-validation-input-section">
										<label for="" class="enhanced-comment-validation-lable-input-section"><?php _e( 'Website', 'enhanced_comment_validation' ); ?></label>
										<input type="text" class="enhanced-comment-validation-form-input" name="enhanced_comment_validation_settings[_website_message]" placeholder="<?php _e( 'Please enter your website', 'enhanced_comment_validation' ); ?>" value="<?php echo isset( $enhanced_comment_validation_settings['_website_message'] ) ? esc_html( $enhanced_comment_validation_settings['_website_message'] ) : ''; ?>">
									</li>
								</ul>
							</td>
						</tr>
					</tbody>
				</table>
				<?php submit_button( __( 'Save Changes', 'enhanced-comment-validation' ), 'primary large' ); ?>
			</form>
		</div>

	<?php
	}
}
