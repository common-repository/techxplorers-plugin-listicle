<?php
/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://techxplorer.com
 * @since      2.0.0
 *
 * @package    Txp_Plugin_Listicle
 * @subpackage Txp_Plugin_Listicle/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      2.0.0
 * @package    Txp_Plugin_Listicle
 * @subpackage Txp_Plugin_Listicle/includes
 * @author     techxplorer <corey@techxplorer.com>
 */
class Txp_Plugin_Listicle_I18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    2.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'txp-plugin-listicle',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}
}
