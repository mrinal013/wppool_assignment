<?php

/**
 *
 * @link              https://github.com/mrinal013/wppool_assignment
 * @since             1.0.0
 * @package           WPPOOL_ASSIGNMENT
 *
 * @wordpress-plugin
 * Plugin Name:       Showcase portfolio projects
 * Plugin URI:        https://github.com/mrinal013/wppool_assignment
 * Description:       This plugin will show projects
 * Version:           1.0.0
 * Author:            Mrinal Haque
 * Author URI:        https://www.linkedin.com/in/mrinal-haque/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       projects
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
    header( 'Status: 403 Forbidden' );
	header( 'HTTP/1.1 403 Forbidden' );
	die();
}

/**
 * Define plugin constants
 */
define( 'PLUGIN_MAIN_FILE', __FILE__ );
define( 'WP_ADMIN_VUE_VERSION', '1.0.0' );
define( 'TEXTDOMAIN', 'wp-admin-vue');
define( 'PAGE_SLUG', 'wp-admin-vue');

function activation() {
	require plugin_dir_path( __FILE__ ) . 'includes/Activator.php';
	wpAdminVue\Includes\Activator::activate();
}
function deactivation() {
	require plugin_dir_path( __FILE__ ) . 'includes/Deactivator.php';
	wpAdminVue\Includes\Deactivator::deactivate();
}
register_activation_hook( __FILE__, 'activation' );
register_deactivation_hook( __FILE__, 'deactivation' );

add_action( 'init', function(){
	if ( ! defined( 'WP_Admin_Vue_Plugin_Loaded' ) ) {
		require plugin_dir_path( __FILE__ ) . 'includes/Controller.php';
		new wpAdminVue\Includes\Controller();
    }
});