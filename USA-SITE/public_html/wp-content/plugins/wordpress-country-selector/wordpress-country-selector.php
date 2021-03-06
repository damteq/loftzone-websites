<?php

/**
 * The plugin bootstrap file
 *
 *
 * @link              https://welaunch.io
 * @since             1.0.0
 * @package           Wordpress_Country_Selector
 *
 * @wordpress-plugin
 * Plugin Name:       WordPress Country Selector
 * Plugin URI:        https://welaunch.io/plugins/wordpress-country-selector/
 * Description:       Add a Country Selector Popup or Page to your Wordpress Site!
 * Version:           1.6.0
 * Author:            weLaunch
 * Author URI:        https://welaunch.io
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       wordpress-country-selector
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-wordpress-country-selector-activator.php
 */
function activate_Wordpress_Country_Selector() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-wordpress-country-selector-activator.php';
	Wordpress_Country_Selector_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-wordpress-country-selector-deactivator.php
 */
function deactivate_Wordpress_Country_Selector() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-wordpress-country-selector-deactivator.php';
	Wordpress_Country_Selector_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_Wordpress_Country_Selector' );
register_deactivation_hook( __FILE__, 'deactivate_Wordpress_Country_Selector' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-wordpress-country-selector.php';

/**
 * Run the Plugin
 * @author Daniel Barenkamp
 * @version 1.0.0
 * @since   1.0.0
 * @link    https://plugins.db-dzine.com
 */
function run_Wordpress_Country_Selector() {

	$plugin_data = get_plugin_data( __FILE__ );
	$version = $plugin_data['Version'];

	$plugin = new Wordpress_Country_Selector($version);
	$plugin->run();

	return $plugin;

}

include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
if ( is_plugin_active('redux-framework/redux-framework.php') || is_plugin_active('redux-dev-master/redux-framework.php')){
	$Wordpress_Country_Selector = run_Wordpress_Country_Selector();
} else {
	add_action( 'admin_notices', 'run_Wordpress_Country_Selector_Not_Installed' );
}

function run_Wordpress_Country_Selector_Not_Installed()
{
	?>
    <div class="error">
      <p><?php _e( 'Wordpress Country Selector requires the Redux Framework plugin. Please install or activate it before!', 'wordpress-country-selector'); ?></p>
    </div>
    <?php
}