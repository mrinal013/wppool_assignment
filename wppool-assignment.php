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
define( 'PLUGIN_VERSION', '1.0.0' );

function activation() {
	require plugin_dir_path( __FILE__ ) . 'includes/Activator.php';
	Projects\Includes\Activator::activate();
}
function deactivation() {
	require plugin_dir_path( __FILE__ ) . 'includes/Deactivator.php';
	Projects\Includes\Deactivator::deactivate();
}
register_activation_hook( __FILE__, 'activation' );
register_deactivation_hook( __FILE__, 'deactivation' );



function projects_plugin_loaded() {
	if ( ! defined( 'PROJECTS_PLUGIN_LOADED' ) ) {
		require plugin_dir_path( __FILE__ ) . 'includes/Controller.php';
		new Projects\Includes\Controller();
    }
}

add_action( 'plugins_loaded', 'projects_plugin_loaded' );

/**
 * Registers the block using the metadata loaded from the `block.json` file.
 * Behind the scenes, it registers also all assets so they can be enqueued
 * through the block editor in the corresponding context.
 *
 * @see https://developer.wordpress.org/reference/functions/register_block_type/
 */
function create_block_projects_block_init() {

	// Check if this is the intended custom post type
	if ( is_admin() ) {

		global $pagenow;
		$typenow = '';

		if ( 'post-new.php' === $pagenow ) {
			
			if ( isset( $_REQUEST['post_type'] ) && post_type_exists( $_REQUEST['post_type'] ) ) {
				$typenow = $_REQUEST['post_type'];
			}

		} elseif ( 'post.php' === $pagenow ) {

		  	if ( isset( $_GET['post'] ) && isset( $_POST['post_ID'] ) && (int) $_GET['post'] !== (int) $_POST['post_ID'] ) {
			// Do nothing
		  	} elseif ( isset( $_GET['post'] ) ) {
				$post_id = (int) $_GET['post'];
		  	} elseif ( isset( $_POST['post_ID'] ) ) {
				$post_id = (int) $_POST['post_ID'];
		  	}

		  	if ( $post_id ) {
				$post = get_post( $post_id );
				$typenow = $post->post_type;
			}

		}

		if ( 'projects' == $typenow ) {
			// return;
		}

	  }

	add_shortcode( 'projects', 'projects_render_shortcode' );
	register_block_type( __DIR__ . '/projects/build', array(
		'render_callback' => 'projects_render_shortcode'
	) );
}
add_action( 'init', 'create_block_projects_block_init' );

function projects_render_shortcode() {
	$html = '<div id="projects"></div>';
	return $html;
}

function projects_metadata_rest_api( $data, $post, $context ) {
	$project_external_url = get_post_meta( $post->ID, '_project_external_url', true );
	
	if( $project_external_url ) {
		$data->data['project_external_url'] = $project_external_url;
	}
	
	return $data;
	}
	add_filter( 'rest_prepare_projects', 'projects_metadata_rest_api', 10, 3 );