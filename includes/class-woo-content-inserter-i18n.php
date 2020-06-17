<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://webidextrous.com/
 * @since      1.0.0
 *
 * @package    Woo_Content_Inserter
 * @subpackage Woo_Content_Inserter/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Woo_Content_Inserter
 * @subpackage Woo_Content_Inserter/includes
 * @author     Rob Watson <rob.watson@webidextrous.com>
 */
class Woo_Content_Inserter_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'woo-content-inserter',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
