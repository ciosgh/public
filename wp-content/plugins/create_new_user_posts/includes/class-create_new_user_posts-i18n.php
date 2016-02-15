<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       http:cios.website
 * @since      1.0.0
 *
 * @package    Create_new_user_posts
 * @subpackage Create_new_user_posts/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Create_new_user_posts
 * @subpackage Create_new_user_posts/includes
 * @author     DNADevs <devs@ciosgrowthhub.com>
 */
class Create_new_user_posts_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'create_new_user_posts',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
