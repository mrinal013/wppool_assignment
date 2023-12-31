<?php
namespace Projects\Admin;

use Projects\Admin\CT as CT;
use Projects\Admin\CPT as CPT;
use Projects\Admin\Block as Block;
use Projects\Admin\Gallery as Gallery;
use Projects\Admin\External_URL as External_URL;
use Projects\Admin\REST_API as REST_API;

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Projects
 * @subpackage Projects/Admin
 * @author     Mrinal Haque <mrinalhaque99@gmail.com>
 */

class Admin {

	use CT, CPT, Block, Gallery, External_URL, REST_API;

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

	}

	

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles( $hook ) {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Wp_Admin_Vue_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Wp_Admin_Vue_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */
		global $post;
		if ( $hook == 'post-new.php' || $hook == 'post.php' ) {
			if ( 'projects' === $post->post_type ) {
				wp_enqueue_style( 'project-css', plugin_dir_url( __FILE__ ) . 'assets/css/projects.build.css', array(), $this->version, 'all' );
			}
		}

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts( $hook ) {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Wp_Admin_Vue_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Wp_Admin_Vue_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */
		global $post;
		if ( $hook == 'post-new.php' || $hook == 'post.php' ) {
			if ( 'projects' === $post->post_type ) {
				wp_enqueue_script( 'projects', plugin_dir_url( __FILE__ ) . 'assets/js/projects.build.js', array( 'jquery', 'jquery-ui-core' ), $this->version, true );
			}
		}

	}

}
