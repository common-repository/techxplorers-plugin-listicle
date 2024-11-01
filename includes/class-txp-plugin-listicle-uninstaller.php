<?php
/**
 * Fired during plugin uninstallation.
 *
 * This class defines all code necessary to run during the plugin's uninstallation..
 *
 * @since      2.0.0
 * @package    Txp_Plugin_Listicle
 * @subpackage Txp_Plugin_Listicle/includes
 * @author     techxplorer <corey@techxplorer.com>
 */

/**
 * A Utility class to cleanup when this plugin is uninstalled.
 *
 * @since      2.0.0
 * @package    Txp_Plugin_Listicle
 * @subpackage Txp_Plugin_Listicle/includes
 * @author     techxplorer <corey@techxplorer.com>
 */
class Txp_Plugin_Listicle_Uninstaller {

	/**
	 * Uninstall the plugin.
	 *
	 * Clean up during uninstall by removing settings, options, etc.
	 *
	 * @since    2.0.0
	 */
	public static function uninstall() {
		// Delete the plugin settings and 'cache' option.
		delete_option( 'txp-plugin-listicle' );
		delete_option( 'txp-plugin-listicle_cache' );
	}
}
