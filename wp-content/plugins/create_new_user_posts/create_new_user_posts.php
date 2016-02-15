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
 * @package           Create_new_user_posts
 *
 * @wordpress-plugin
 * Plugin Name:       Business Post Creator
 * Plugin URI:        http://ciosgrowthhub.com
 * Description:       Creates Business Directory post on registration.
 * Version:           1.0.0
 * Author:            DNA Devs
 * Author URI:        http:cios.website
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       create_new_user_posts
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-create_new_user_posts-activator.php
 */
function activate_create_new_user_posts() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-create_new_user_posts-activator.php';
	Create_new_user_posts_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-create_new_user_posts-deactivator.php
 */
function deactivate_create_new_user_posts() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-create_new_user_posts-deactivator.php';
	Create_new_user_posts_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_create_new_user_posts' );
register_deactivation_hook( __FILE__, 'deactivate_create_new_user_posts' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-create_new_user_posts.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_create_new_user_posts() {

	$plugin = new Create_new_user_posts();
	$plugin->run();

}
run_create_new_user_posts();


// Start plugin fuctionality


function create_new_user_posts($user_id){
        if (!$user_id>0)
                return;
        //here we know the user has been created.
        // Create post object

        $my_business_post = array(
             'post_title' => 'business',
             'post_content' => 'This is my post.',
             'post_status' => 'publish',
             'post_author' => $user_id
        );

        // Insert the post into the database
        $business = wp_insert_post( $my_business_post );



        //and if you want to store the post ids in
        //the user meta then simply use update_user_meta
        update_user_meta($user_id,'_business_post',$business);

}


add_action('user_register','create_new_user_posts');
