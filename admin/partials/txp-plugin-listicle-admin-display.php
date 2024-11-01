<?php
/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       https://techxplorer.com
 * @since      2.0.0
 *
 * @package    Txp_Plugin_Listicle
 * @subpackage Txp_Plugin_Listicle/admin/partials
 */

?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->
<div class="wrap">

	<h1><?php echo esc_html( get_admin_page_title() ); ?></h1>

	<div id="poststuff">
		<div id="post-body" class="metabox-holder columns-2">
			<!-- Main Content -->
			<div id="post-body-content">
				<div class="meta-box-sortables ui-sortable">
					<div class="postbox">
						<form method="post" name="txp-plugin-listicle" action="options.php">
							<?php settings_fields( $this->plugin_name ); ?>
							<?php $options = $this->validate( get_option( $this->plugin_name ) ); ?>
							<h2><span class="dashicons dashicons-admin-links"></span> <?php esc_html_e( 'Link format settings', 'txp-plugin-listicle' ); ?></h2>
							<div class="inside">
								<ul class="striped">
									<li>
										<!-- Add rel="nofollow" to links -->
										<fieldset>
											<legend class="screen-reader-text"><span><?php esc_html_e( 'Add rel="nofollow" to plugin links.', 'txp-plugin-listicle' ); ?></span></legend>
											<label for="<?php echo esc_html( $this->plugin_name ); ?>-nofollow">
												<input type="checkbox"
													 id="<?php echo esc_html( $this->plugin_name ); ?>-nofollow"
													 name="<?php echo esc_html( $this->plugin_name ); ?>[nofollow]"
													 value="1" <?php checked( $options['nofollow'], 1 ); ?>/>
												<span><?php esc_html_e( 'Add rel="nofollow" to plugin links.', 'txp-plugin-listicle' ); ?></span>
											</label>
										</fieldset>
									</li>
									<li>
										<!-- Open links in new window / tab  -->
										<fieldset>
											<legend class="screen-reader-text"><span><?php esc_html_e( 'Open links in new tab / window.', 'txp-plugin-listicle' ); ?></span></legend>
											<label for="<?php echo esc_html( $this->plugin_name ); ?>-newtab">
												<input type="checkbox"
													 id="<?php echo esc_html( $this->plugin_name ); ?>-newtab"
													 name="<?php echo esc_html( $this->plugin_name ); ?>[newtab]"
													 value="1" <?php checked( $options['newtab'], 1 ); ?>/>
												<span><?php esc_html_e( 'Open links in new tab / window.', 'txp-plugin-listicle' ); ?></span>
											</label>
										</fieldset>
									</li>
									<li>
										<!-- Incude plugin icons -->
										<fieldset>
											<legend class="screen-reader-text"><span><?php esc_html_e( 'Display plugin icons.', 'txp-plugin-listicle' ); ?></span></legend>
											<label for="<?php echo esc_html( $this->plugin_name ); ?>-icons">
												<input type="checkbox"
													 id="<?php echo esc_html( $this->plugin_name ); ?>-icons"
													 name="<?php echo esc_html( $this->plugin_name ); ?>[icons]"
													 value="1" <?php checked( $options['icons'], 1 ); ?>/>
												<span><?php esc_html_e( 'Display plugin icons.', 'txp-plugin-listicle' ); ?></span>
											</label>
										</fieldset>
									</li>
									<li>
										<!-- Disable plugin CSS -->
										<fieldset>
											<legend class="screen-reader-text"><span><?php esc_html_e( 'Disable plugin CSS.', 'txp-plugin-listicle' ); ?></span></legend>
											<label for="<?php echo esc_html( $this->plugin_name ); ?>-css">
												<input type="checkbox"
													 id="<?php echo esc_html( $this->plugin_name ); ?>-css"
													 name="<?php echo esc_html( $this->plugin_name ); ?>[css]"
													 value="1" <?php checked( $options['css'], 1 ); ?>/>
												<span><?php esc_html_e( 'Disable plugin CSS. You will need to add your own using the customisation functionality of your theme.', 'txp-plugin-listicle' ); ?></span>
											</label>
										</fieldset>
									</li>
									<li>
										<!-- Sort plugin list alphabetically -->
										<fieldset>
											<legend class="screen-reader-text"><span><?php esc_html_e( 'Sort plugin list alphabetically.', 'txp-plugin-listicle' ); ?></span></legend>
											<label for="<?php echo esc_html( $this->plugin_name ); ?>-sort">
												<input type="checkbox"
													 id="<?php echo esc_html( $this->plugin_name ); ?>-sort"
													 name="<?php echo esc_html( $this->plugin_name ); ?>[sort]"
													 value="1" <?php checked( $options['sort'], 1 ); ?>/>
												<span><?php esc_html_e( 'Sort plugin list alphabetically, by plugin name.', 'txp-plugin-listicle' ); ?></span>
											</label>
										</fieldset>
									</li>
								</ul>
							</div>
							<h2><span class="dashicons dashicons-filter"></span> <?php esc_html_e( 'Filter plugin list', 'txp-plugin-listicle' ); ?></h2>
							<div class="inside">
								<p><?php esc_html_e( 'Tick the plugins that you do not want to display in the list.', 'txp-plugin-listicle' ); ?></p>
								<ul class="striped">
								<?php
									$plugins = $this->get_active_plugins();

								foreach ( $plugins as $plugin ) :
								?>
								<li>
									<fieldset>
										<legend class="screen-reader-text">
											<span>
												<?php
													// translators: the placeholder is for the name of the plugin.
													printf( esc_html__( 'Hide the %s plugin.', 'txp-plugin-listicle' ), esc_html( $plugin ['Name'] ) );
												?>
											</span>
										</legend>
										<label for="<?php echo esc_html( $this->plugin_name . '-' . $plugin ['Txp_slug'] ); ?>">
											<input type="checkbox"
												 id="<?php echo esc_html( $this->plugin_name . '-' . $plugin ['Txp_slug'] ); ?>"
												 name="<?php echo esc_html( $this->plugin_name . '[' . $plugin ['Txp_slug'] . ']' ); ?>"
												 value="1"
												<?php
													checked( isset( $options[ $plugin['Txp_slug'] ] ) ? $options[ $plugin['Txp_slug'] ] : 0, 1 );
												?>
												/>
												<span>
													<?php
														// translators: the placeholder is for the name of the plugin.
														printf( esc_html__( 'Hide the %s plugin.', 'txp-plugin-listicle' ), esc_html( $plugin ['Name'] ) );
													?>
												</span>
											</label>
										</fieldset>
									</li>
								<?php endforeach; ?>
								</ul>
							</div>
							<div class="inside">
								<?php submit_button( 'Save all changes', 'primary','submit', true ); ?>
							</div>
						</form>
					</div>
				</div>
				<div class="meta-box-sortables ui-sortable">
					<div class="postbox">
						<h2><?php esc_html_e( 'Shortcode instructions', 'txp-plugin-listicle' ); ?></h2>
						<div class="inside">
							<p><?php esc_html_e( 'Use the following shortcode to display the list of active plugins in a post or page.', 'txp-plugin-listicle' ); ?></p>
							<pre>[txp-plugin-listicle]</pre>
						</div>
					</div>
				</div>
			</div>
			<!-- Sidebar -->
			<div id="postbox-container-1" class="postbox-container">
				<div class="metabox-sortables">
					<div class="postbox">
						<h2><span class="dashicons dashicons-info"></span> <?php esc_html_e( 'More information' ); ?></h2>
						<div class="inside">
							<p><?php esc_html_e( 'The purpose of this plugin is to help raise the profile of plugins that are used on your site.', 'txp-plugin-listicle' ); ?></p>
							<p><?php esc_html_e( 'This shows your appreciation for all of the hard work that the authors put into writing and maintaining them.', 'txp-plugin-listicle' ); ?></p>
							<p><?php esc_html_e( 'More information on this plugin is available from the links below.', 'txp-plugin-listicle' ); ?></p>
							<ul class="striped">
								<li><span class="dashicons dashicons-admin-plugins"></span> <a href="https://techxplorer.com/projects/txp-plugin-listicle/"><?php esc_html_e( 'Plugin homepage.', 'txp-plugin-listicle' ); ?></a></li>
								<li><span class="dashicons dashicons-twitter"></span> <a href="https://twitter.com/techxplorer"><?php esc_html_e( 'My Twitter profile.', 'txp-plugin-listicle' ); ?></a></li>
								<li><span class="dashicons dashicons-admin-home"></span> <a href="htps://techxplorer.com/"><?php esc_html_e( 'My website.', 'txp-plugin-listicle' ); ?></a></li>
							</ul>
					</div>
				</div>
			</div>
			<br class="clear">
		</div>
	</div>
</div>
