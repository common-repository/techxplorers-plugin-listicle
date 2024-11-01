<?php
/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://techxplorer.com
 * @since             2.0.0
 * @package           Txp_Plugin_Listicle
 *
 * @wordpress-plugin
 * Plugin Name:       Techxplorer's Plugin Listicle
 * Plugin URI:        https://techxplorer.com/
 * Description:       Using a shortcode this plugin makes it easy to credit the authors of plugins used on your site.
 * Version:           2.3.2
 * Author:            techxplorer
 * Author URI:        https://techxplorer.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       txp-plugin-listicle
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-txp-plugin-listicle-activator.php
 */
function activate_txp_plugin_listicle() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-txp-plugin-listicle-activator.php';
	Txp_Plugin_Listicle_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-txp-plugin-listicle-deactivator.php
 */
function deactivate_txp_plugin_listicle() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-txp-plugin-listicle-deactivator.php';
	Txp_Plugin_Listicle_Deactivator::deactivate();
}

/**
 * The code that runs during plugin install.
 */
function uninstall_txp_plugin_listicle() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-txp-plugin-listicle-uninstaller.php';
	Txp_Plugin_Listicle_Uninstaller::uninstall();
}

register_activation_hook( __FILE__, 'activate_txp_plugin_listicle' );
register_deactivation_hook( __FILE__, 'deactivate_txp_plugin_listicle' );
register_uninstall_hook( __FILE__, 'uninstall_txp_plugin_listicle' );


/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-txp-plugin-listicle.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    2.0.0
 */
function run_txp_plugin_listicle() {

	$plugin = new Txp_Plugin_Listicle();
	$plugin->run();

}
run_txp_plugin_listicle();
