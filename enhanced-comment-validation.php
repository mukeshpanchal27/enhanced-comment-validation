<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://mukeshpanchal.com/
 * @since             1.0.0
 * @package           Enhanced_Comment_Validation
 *
 * @wordpress-plugin
 * Plugin Name:       Enhanced Comment Validation
 * Description:       Enhanced Comment Validation plugin is an effective security solution that protects your WordPress comment form.
 * Version:           1.0.0
 * Author:            Mukesh Panchal
 * Author URI:        https://mukeshpanchal.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       enhanced-comment-validation
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'ENHANCED_COMMENT_VALIDATION_VERSION', '1.0.0' );
define( 'ENHANCED_COMMENT_VALIDATION_BASENAME', plugin_basename( __FILE__ ) );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-enhanced-comment-validation-activator.php
 */
function activate_enhanced_comment_validation() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-enhanced-comment-validation-activator.php';
	Enhanced_Comment_Validation_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-enhanced-comment-validation-deactivator.php
 */
function deactivate_enhanced_comment_validation() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-enhanced-comment-validation-deactivator.php';
	Enhanced_Comment_Validation_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_enhanced_comment_validation' );
register_deactivation_hook( __FILE__, 'deactivate_enhanced_comment_validation' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-enhanced-comment-validation.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_enhanced_comment_validation() {

	$plugin = new Enhanced_Comment_Validation();
	$plugin->run();

}
run_enhanced_comment_validation();
