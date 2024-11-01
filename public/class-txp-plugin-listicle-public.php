<?php
/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://techxplorer.com
 * @since      2.0.0
 *
 * @package    Txp_Plugin_Listicle
 * @subpackage Txp_Plugin_Listicle/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Txp_Plugin_Listicle
 * @subpackage Txp_Plugin_Listicle/public
 * @author     techxplorer <corey@techxplorer.com>
 */
class Txp_Plugin_Listicle_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    2.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    2.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    2.0.0
	 * @param      string $plugin_name       The name of the plugin.
	 * @param      string $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    2.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Txp_Plugin_Listicle_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Txp_Plugin_Listicle_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 *
		 * wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/txp-plugin-listicle-public.css', array(), $this->version, 'all' );
		 */
	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    2.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Txp_Plugin_Listicle_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Txp_Plugin_Listicle_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 *
		 * wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/txp-plugin-listicle-public.js', array( 'jquery' ), $this->version, false );
		 */
	}

	/**
	 * Register the stylesheet for use by the shortcode if necessary
	 *
	 * @since  2.1.0
	 *
	 * @return void
	 */
	public function register_styles() {
		wp_register_style(
			$this->plugin_name,
			plugin_dir_url( __FILE__ ) . 'css/txp-plugin-listicle-public.css',
			array(),
			$this->version,
			'all'
		);
	}

	/**
	 * Replace the shortcode with the list of puglins.
	 *
	 * @since 2.0.0
	 */
	public function do_shortcode() {
		// Replace the shortocde with the list of plugins.
		$plugin_list = get_option( $this->plugin_name . '_cache', false );

		// Get the other plugin options.
		$options = get_option( $this->plugin_name );

		// Load the plugin specific public css.
		if ( isset( $options['css'] ) && empty( $options['css'] ) ) {
			wp_enqueue_style( $this->plugin_name );
		}

		if ( empty( $plugin_list ) ) {
			require_once plugin_dir_path( __FILE__ ) . '../admin/class-txp-plugin-listicle-admin.php';
			$admin = new Txp_Plugin_Listicle_Admin( $this->plugin_name, $this->version );
			$plugin_list = $admin->build_plugin_list();
		}

		return $plugin_list;
	}
}
