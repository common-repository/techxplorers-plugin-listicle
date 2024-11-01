=== Plugin Name ===
Contributors: techxplorer
Tags: shortcode, plugin, credit, post, page, list
Requires at least: 4.4.2
Tested up to: 4.8
Stable tag: trunk
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Using a shortcode this plugin makes it easy to credit the authors of the plugins used on your site.

== Description ==

The purpose of this plugin is to make it easy to credit the authors of the plugins used on your site.
I created this plugin because I wanted to highlight the plugins that I use on my own website. Additionally I felt that
plugins are under represented. Especially as themes typically contain a link to the authors page in the footer.

**Important Support Notice**
Development of this plugin has ceased, and it is now officially unsupported.
If you are still using this plugin you are strongly encouraged to find an alternative.

The features of the plugin are:

*    Automatically add nofollow to the plugin links
*    Automatically have links open in a new tab/window
*    Filter the list of plugins that are displayed
*    Show plugin icons as part of the list
*    Sort the list of plugins alphabetically by plugin name

The list of plugins can also be styled to make it match your theme.

Original cuter-bear icon by [Scott Johnson](https://twitter.com/scottjohnson).

== Installation ==

1. Upload the plugin files to the `/wp-content/plugins/techxplores-plugin-listicle` directory, or install the plugin through the WordPress plugins screen directly.
1. Activate the plugin through the 'Plugins' screen in WordPress.
1. Update the settings for the plugin.
1. Add the `[txp-plugin-listicle]` shortcode to the page or post where you want the list of plugins to be displayed.

== Frequently Asked Questions ==

= How do I add the list of plugins to a page or post =

Easy. Just add the `[txp-plugin-listicle]` shortcode to the page or post and the rest is done automatically.

= Is it possible to style the list of plugins? =

Yes. The list of plugins is contained in a div tag with the `txp-plugin-listicle` class. Targeting this class with your
custom CSS will let you style the list of plugins.

To help in displaying the list of plugins with icons, a basic CSS file is included by this plugin. There is a setting
which can be used to disable the display of this basic CSS. This makes it easier to style the list using the customisation
functionality available as part of your theme.

= Can I add the nofollow attribute to the links? =

Yes. There is a setting for the plugin that you can turn on to add the `rel="nofollow" attribute.
I prefer to leave this setting off to help promote the plugin authors.
But I respect your ability to add the attribute if you wish.

= Can the links automatically open in a new window? =

Yes. There is a setting for the plugin that you can turn on to add the `target="_blank"` attribute to the links.

= Can I filter the list of plugins that are listed? =

Yes. You can filter the list of plugins on the settings page.

= Can I include the plugin icons in the list? =

Yes. There is a setting that you can enable to do this.

== Changelog ==

= 2.3.2 =

* Confirm compatibility with WordPress 4.8
* Fix code style errors using latest WordPress code style

= 2.3.1 =

* Confirm compatibility with WordPress 4.7
* Various minor bug fixes

= 2.3.0 =

* Fix security related issue when the 'Open links in new tab / window.' option is enabled
* Fix code style errors using latest WordPress code style

= 2.2.1 =

* Improve the way in which the links to plugin icons are determined.
* A full list of fixes is [available here](https://github.com/techxplorer/txp-plugin-listicle/issues?q=is%3Aissue+milestone%3A2.2.1+)

= 2.2.0 =

* Add the ability to sort the list of plugins alphabetically by plugin name
* A full list of fixes is [available here](https://github.com/techxplorer/txp-plugin-listicle/issues?q=is%3Aissue+milestone%3A2.2.0+)

= 2.1.1 =

* Improve determination of plugin slugs for icon retrieval
* A full list of fixes is [available here](https://github.com/techxplorer/txp-plugin-listicle/issues?q=is%3Aissue+milestone%3A2.1.1+)

= 2.1.0 =

* Add ability to display plugin icons as part of the list
* Various minor bug fixes, a full list is [available here](https://github.com/techxplorer/txp-plugin-listicle/issues?q=+is%3Aissue+milestone%3A2.1+)

= 2.0.0 =

* Fully rewritten plugin
* Listed on wordpress.org

= 1.0 =

* Initial simple plugin release

== Upgrade Notice ==

= 2.1.0 =

* To enable the display of plugin icons, enable this setting

= 2.0 =
Update to the plugin version listed on wordpress.org
