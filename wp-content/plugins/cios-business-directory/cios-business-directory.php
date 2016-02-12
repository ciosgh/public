<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              http:cios.website
 * @since             1.0.0
 * @package           Cios_Business_Directory
 *
 * @wordpress-plugin
 * Plugin Name:       Cios Business Directories
 * Plugin URI:        http://ciosgrowthhub.com
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.0.0
 * Author:            DNADevs
 * Author URI:        http:cios.website
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       cios-business-directory
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-cios-business-directory-activator.php
 */
function activate_cios_business_directory() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-cios-business-directory-activator.php';
	Cios_Business_Directory_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-cios-business-directory-deactivator.php
 */
function deactivate_cios_business_directory() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-cios-business-directory-deactivator.php';
	Cios_Business_Directory_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_cios_business_directory' );
register_deactivation_hook( __FILE__, 'deactivate_cios_business_directory' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-cios-business-directory.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_cios_business_directory() {

	$plugin = new Cios_Business_Directory();
	$plugin->run();

}
run_cios_business_directory();

function my_custom_post_business() {
  $labels = array(
    'name'               => _x( 'businesses', 'post type general name' ),
    'singular_name'      => _x( 'business', 'post type singular name' ),
    'add_new'            => _x( 'Add New', 'business' ),
    'add_new_item'       => __( 'Add New Business' ),
    'edit_item'          => __( 'Edit business' ),
    'new_item'           => __( 'New business' ),
    'all_items'          => __( 'All businesss' ),
    'view_item'          => __( 'View business' ),
    'search_items'       => __( 'Search businesses' ),
    'not_found'          => __( 'No businesses found' ),
    'not_found_in_trash' => __( 'No businesses found in the Trash' ),
    'parent_item_colon'  => '',
    'menu_name'          => 'Businesses'
  );
  $args = array(
    'labels'        => $labels,
    'description'   => 'Holds our businesss and business specific data',
    'public'        => true,
    'menu_position' => 5,
    'supports'      => array( 'title', 'editor', 'thumbnail', 'excerpt', 'comments' ),
    'has_archive'   => true,
  );
  register_post_type( 'business', $args );
}
add_action( 'init', 'my_custom_post_business' );


function my_taxonomies_business() {
  $labels = array(
    'name'              => _x( 'Business Categories', 'taxonomy general name' ),
    'singular_name'     => _x( 'Business Category', 'taxonomy singular name' ),
    'search_items'      => __( 'Search Business Categories' ),
    'all_items'         => __( 'All Business Categories' ),
    'parent_item'       => __( 'Parent Business Category' ),
    'parent_item_colon' => __( 'Parent Business Category:' ),
    'edit_item'         => __( 'Edit Business Category' ),
    'update_item'       => __( 'Update Business Category' ),
    'add_new_item'      => __( 'Add New Business Category' ),
    'new_item_name'     => __( 'New Business Category' ),
    'menu_name'         => __( 'Business Categories' ),
  );
  $args = array(
    'labels' => $labels,
    'hierarchical' => true,
  );
  register_taxonomy( 'business_category', 'business', $args );
}
add_action( 'init', 'my_taxonomies_business', 0 );
