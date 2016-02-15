<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              http://www.ciosgrowthhub.com
 * @since             1.0.0
 * @package           Contact_Administration
 *
 * @wordpress-plugin
 * Plugin Name:       Contact Administration
 * Plugin URI:        http://www.ciosgrowthhub.com/wp-content/plugins/contact-administration
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.0.0
 * Author:            Growth Hub
 * Author URI:        http://www.ciosgrowthhub.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       contact-administration
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-contact-administration-activator.php
 */
function activate_contact_administration() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-contact-administration-activator.php';
	Contact_Administration_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-contact-administration-deactivator.php
 */
function deactivate_contact_administration() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-contact-administration-deactivator.php';
	Contact_Administration_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_contact_administration' );
register_deactivation_hook( __FILE__, 'deactivate_contact_administration' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-contact-administration.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_contact_administration() {

	$plugin = new Contact_Administration();
	$plugin->run();

}
run_contact_administration();

