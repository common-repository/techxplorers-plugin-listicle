<?php
/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://techxplorer.com
 * @since      2.0.0
 *
 * @package    Txp_Plugin_Listicle
 * @subpackage Txp_Plugin_Listicle/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Txp_Plugin_Listicle
 * @subpackage Txp_Plugin_Listicle/admin
 * @author     techxplorer <corey@techxplorer.com>
 */
class Txp_Plugin_Listicle_Admin {

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
	 * The base template for icon files.
	 *
	 * @since  2.1.0
	 * @access private
	 * @var    string  $icon_uri_templ The template for icon URIs.
	 */
	private $icon_uri_templ = 'http://ps.w.org/%s/assets/icon-128x128.%s';

	/**
	 * The base templates for the URL to icon files.
	 *
	 * @since 2.2.1
	 * @access private
	 * @var array $icon_url_templates The templates for icon URLS.
	 */
	private $icon_url_templates = array(
		'http://ps.w.org/%s/assets/icon.svg',
		'http://ps.w.org/%s/assets/icon-256x256.%s',
		'http://ps.w.org/%s/assets/icon-128x128.%s',
	);

	/**
	 * An array of icon file extensions.
	 *
	 * @since  2.1.0
	 * @access private
	 * @var    array   $icon_uri_exts The file extensions of icon files.
	 */
	private $icon_uri_exts = array( 'png', 'jpg', 'svg' );

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    2.0.0
	 * @param    string $plugin_name  The name of this plugin.
	 * @param    string $version      The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    2.0.0
	 */
	public function enqueue_styles() {

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    2.0.0
	 */
	public function enqueue_scripts() {

	}

	/**
	 * Register the administration menu for this plugin into the WordPress Dashboard
	 *
	 * @since 2.0.0
	 */
	public function add_plugin_admin_menu() {
		add_options_page( "Techxplorer's Plugin Listicle", 'Plugin Listicle', 'manage_options', $this->plugin_name, [ $this, 'display_plugin_setup_page' ] );
	}

	/**
	 * Add a settings action link to the plugins page.
	 *
	 * @param array $links The list of existing links.
	 *
	 * @since 2.0.0
	 */
	public function add_action_links( $links ) {
		$settings_link = array(
			'<a href="' . admin_url( 'options-general.php?page=' . $this->plugin_name ) . '">' . __( 'Settings', 'txp-plugin-listicle' ) . '</a>',
		);

		return array_merge( $settings_link, $links );
	}

	/**
	 * Render the settings page
	 *
	 * @since 2.0.0
	 */
	public function display_plugin_setup_page() {
		include_once( 'partials/txp-plugin-listicle-admin-display.php' );
	}

	/**
	 * Register the setting options
	 *
	 * @since 2.0.0
	 */
	public function options_update() {
		register_setting( $this->plugin_name, $this->plugin_name, array( $this, 'validate' ) );
	}

	/**
	 * Validate the admin settings
	 *
	 * @param array $input The list of input from the settings form.
	 * @since 2.0.0
	 */
	public function validate( $input ) {
		// All checkbox options.
		$valid = array();

		// Link formatting.
		$valid['nofollow'] = ( isset( $input['nofollow'] ) && ! empty( $input['nofollow'] ) ) ? 1 : 0;
		$valid['newtab'] = ( isset( $input['newtab'] ) && ! empty( $input['newtab'] ) ) ? 1 : 0;

		// Include plugin icons.
		$valid['icons'] = ( isset( $input['icons'] ) && ! empty( $input['icons'] ) ) ? 1 : 0;

		// Disable plugin CSS.
		$valid['css'] = ( isset( $input['css'] ) && ! empty( $input['css'] ) ) ? 1 : 0;

		// Sort the plugin list alphabetically.
		$valid['sort'] = ( isset( $input['sort'] ) && ! empty( $input['sort'] ) ) ? 1 : 0;

		// Filtered Plugin List.
		$plugins = $this->get_active_plugins();

		foreach ( $plugins as $plugin ) {
			$slug = $plugin['Txp_slug'];
			$valid[ $slug ] = (isset( $input[ $slug ] ) && ! empty( $input[ $slug ] )) ? 1 : 0;
		}

		// Clear the cache as settings may have changed.
		$this->clear_cache();

		return $valid;
	}

	/**
	 * Get a list of active plugins
	 *
	 * @since  2.0.0
	 * @return array An array containing details of all active plugins.
	 */
	public function get_active_plugins() {
		// Make sure the required WP functionality is available.
		if ( ! function_exists( 'get_plugins' ) ) {
			require_once ABSPATH . 'wp-admin/includes/plugin.php';
		}

		// Get details on all of the plugins.
		$all_plugins = apply_filters( 'all_plugins', get_plugins() );

		// Get a list of active plugins.
		$active_plugins = (array) get_option( 'active_plugins', array() );

		// Filter the list of plugin details to only those which are active.
		$plugins = array();

		foreach ( $active_plugins as $idx ) {
			// Use the plugin title to derive a 'slug'.
			$plugin = $all_plugins [ $idx ];

			// Determine the plugin slug.
			$slug = dirname( $idx );
			if ( '.' !== $slug ) {
				// Use the directory name as the slug.
				$plugin['Txp_slug'] = $slug;
			} else {
				// Otherwise use the sanitized title.
				$plugin['Txp_slug'] = sanitize_title( $plugin['Title'] );
			}

			$plugins[ $idx ] = $plugin;
		}

		return $plugins;
	}

	/**
	 * Generate a link in a safe way taking into account some options
	 *
	 * @since 2.0.0
	 * @param string  $url      The url to link to.
	 * @param string  $text     The text of the link.
	 * @param boolean $nofollow Add the rel="nofollow" attribute.
	 * @param boolean $newtab   Add the target="_blank" attribute.
	 *
	 * @return The html of the link
	 */
	protected function generate_link( $url, $text, $nofollow = false, $newtab = false ) {

		// Build a list of allowed tags and attributes.
		static $allowed = null;

		if ( null === $allowed ) {
			$allowed = array(
				'a' => array(
					'href' => array(),
					'rel' => array(),
					'target' => array(),
				),
			);
		}

		// Check to see if we need to add the attributes.
		if ( ! empty( $nofollow ) ) {
			$nofollow = ' rel="nofollow" ';
		} else {
			$nofollow = ' ';
		}

		if ( ! empty( $newtab ) ) {
			$newtab = ' target="_blank" rel="noopener noreferrer" ';
		} else {
			$newtab = ' ';
		}

		if ( ! empty( $nofollow ) && ! empty( $newtab ) ) {
			$nofollow = ' ';
			$newtab = ' target="_blank" rel="noopener noreferrer nofollow" ';
		}

		// Build the link.
		$link = "<a href=\"{$url}\" {$nofollow} {$newtab}>{$text}</a>.";

		// Play it safe.
		$link = wp_kses( $link, $allowed );

		return $link;
	}

	/**
	 * Generate the HTML to show a plugin icon
	 *
	 * @since 2.1.0
	 * @param string  $plugin_slug The plugin slug to use in the URL to the icon.
	 * @param string  $url         The url to link to.
	 * @param boolean $nofollow    Add the rel="nofollow" attribute.
	 * @param boolean $newtab      Add the target="_blank" attribute.
	 *
	 * @return string The HTML to display the icon, or an empty string on failure.
	 */
	public function generate_icon_link( $plugin_slug, $url, $nofollow = false, $newtab = false ) {

		// Build a list of allowed tags and attributes.
		static $allowed = null;

		if ( null === $allowed ) {
			$allowed = array(
				'a' => array(
					'href' => array(),
					'rel' => array(),
					'target' => array(),
				),
				'img' => array(
					'src' => array(),
					'height' => array(),
					'width' => array(),
				),
				'span' => array(
					'class' => array(),
				),
			);
		}

		// Before we do anything else, check to see if the URI to the icon can be determined.
		$uri = $this->confirm_icon_uri( $plugin_slug );

		if ( empty( $uri ) ) {
			return '';
		} else {
			// Make URI protocol agnostic.
			$uri = substr( $uri, 4 );
		}

		// Check to see if we need to add the attributes.
		if ( ! empty( $nofollow ) ) {
			$nofollow = ' rel="nofollow" ';
		} else {
			$nofollow = ' ';
		}

		if ( ! empty( $newtab ) ) {
			$newtab = ' target="_blank" rel="noopener noreferrer" ';
		} else {
			$newtab = ' ';
		}

		if ( ! empty( $nofollow ) && ! empty( $newtab ) ) {
			$nofollow = ' ';
			$newtab = ' target="_blank" rel="noopener noreferrer nofollow" ';
		}

		// Build the img src tag.
		$img = "<img src=\"{$uri}\" height=\"128px\" width=\"128px\"/>";

		// Build the link.
		$link = "<a href=\"{$url}\" {$nofollow} {$newtab}>{$img}</a>";

		// Finalise the element.
		$span = "<span class=\"alignleft\">$link</span>";

		// Play it safe.
		$span = wp_kses( $span, $allowed );

		return $span;
	}

	/**
	 * Determine the plugin icon uri
	 *
	 * @since 2.1.0
	 * @param string $plugin_slug the slug of the plugin.
	 *
	 * @return mixed null|string The uri for the icon, or null if it cannot be found
	 */
	public function confirm_icon_uri( $plugin_slug ) {

		// Try each of the templates in turn.
		foreach ( $this->icon_url_templates as $icon_uri_templ ) {
			// Try each of the support file types.
			foreach ( $this->icon_uri_exts as $ext ) {
				$uri = sprintf( $icon_uri_templ, $plugin_slug, $ext );

				$result = wp_remote_head( $uri );

				// Bail if something really bad happened.
				if ( is_wp_error( $result ) ) {
					return null;
				} elseif ( wp_remote_retrieve_response_code( $result ) === 200 ) {
					return $uri;
				}
			}
		}

		return null;
	}

	/**
	 * Build the list of plugins for display
	 *
	 * @since 2.0.0
	 *
	 * @return string The HTML to display the list of links
	 */
	public function build_plugin_list() {

		// Use the 'cached' value if available.
		$cache = get_option( $this->plugin_name . '_cache', false );

		if ( ! empty( $cache ) && empty( $bypass ) ) {
			return $cache;
		}

		// Get the required information.
		$active_plugins = $this->get_active_plugins();
		$options = $this->validate( get_option( $this->plugin_name ) );

		if ( isset( $options['nofollow'] ) && ! empty( $options['nofollow'] ) ) {
			$nofollow = true;
		} else {
			$nofollow = false;
		}

		if ( isset( $options['newtab'] ) && ! empty( $options['newtab'] ) ) {
			$newtab = true;
		} else {
			$newtab = false;
		}

		if ( isset( $options['icons'] ) && ! empty( $options['icons'] ) ) {
			$icons = true;
		} else {
			$icons = false;
		}

		// Sort the list of plugins if required.
		if ( isset( $options['sort'] ) && ! empty( $options['sort'] ) ) {
			// Include the required library.
			require_once( __DIR__ . '/class-txp-utils-array.php' );

			$active_plugins = Txp_Utils_Array::sort_array_by_element(
				$active_plugins,
				'Name'
			);
		}

		// Build the HTML.
		$html = "<div class=\"{$this->plugin_name}\"><table>";

		foreach ( $active_plugins as $plugin ) {
			// Is this plugin included?
			if ( isset( $options[ $plugin['Txp_slug'] ] ) && ! empty( $options[ $plugin['Txp_slug'] ] ) ) {
				// This plugin should be skipped.
				continue;
			}

			// Build the plugin link.
			if ( isset( $plugin['PluginURI'] ) ) {
				$plugin_link = $this->generate_link( $plugin['PluginURI'], $plugin['Name'], $nofollow, $newtab );
			} else {
				$plugin_link = wp_kses( $plugin['Name'], array() );
			}

			// Build the author link.
			if ( isset( $plugin['AuthorURI'] ) ) {
				$author_link = $this->generate_link( $plugin['AuthorURI'], $plugin['Author'], $nofollow, $newtab );
			} else {
				$author_link = wp_kses( $plugin['Author'], array() );
			}

			$icon_link = '';

			// Build the icon link.
			if ( true === $icons && isset( $plugin['PluginURI'] ) ) {
				$icon_link = $this->generate_icon_link(
					$plugin['Txp_slug'],
					$plugin['PluginURI'],
					$nofollow,
					$newtab
				);
			} elseif ( true === $icons ) {
				$icon_link = '<!-- No plugin url so no plugin icon -->';
			}

			// Get the rest of the description.
			$description = wp_kses( $plugin['Description'], array() );

			// Build the table row.
			$row = '<tr>';

			if ( true === $icons ) {
				$row .= '<td class="' . $this->plugin_name . '-icon">' . $icon_link . '</td>';
			}

			$row .= '<td class="' . $this->plugin_name . '-descr">';
			$row .= "<p>{$plugin_link}</p>";
			$row .= "<p>{$description}</p>";
			// translators: the placeholder is for the name of the author of the plugin.
			$row .= '<p>' . sprintf( esc_html__( 'By: %s', 'txp-plugin-listicle' ), $author_link ) . '</p>';
			$row .= '</td></tr>';

			$html .= $row;
		} // End foreach().

		$html .= '</table></div>';

		// Do not autoload this option as it can be quite large and we want to play nice.
		update_option( $this->plugin_name . '_cache', $html, false );

		return $html;
	}

	/**
	 * Delete the option that is being used as a cache of the HTML for the list.
	 *
	 * @since 2.0.0
	 */
	public function clear_cache() {
		delete_option( $this->plugin_name . '_cache' );
	}
}
