<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://github.com/devwael
 * @since             1.0.0
 * @package           Tyres
 *
 * @wordpress-plugin
 * Plugin Name:       WC Tyres Search
 * Plugin URI:        https://innoshop.co/
 * Description:       add fields in woocommerce products to display tyre type in search.
 * Version:           1.0.0
 * Author:            Ahmad Wael
 * Author URI:        https://github.com/devwael
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       tyres
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'TYRES_VERSION', '1.0.0' );

spl_autoload_register( 'tyres_autoloader' );
function tyres_autoloader( $class_name ) {
	$classes_dir = realpath( plugin_dir_path( __FILE__ ) ) . DIRECTORY_SEPARATOR . 'includes' . DIRECTORY_SEPARATOR;
	$class_file  = $class_name . '.php';
	$class       = $classes_dir . $class_file;
	if ( file_exists( $class ) ) {
		require_once $class;
	} else {
		return false;
	}
}
/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-tyres-activator.php
 */
function activate_tyres() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-tyres-activator.php';
	Tyres_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-tyres-deactivator.php
 */
function deactivate_tyres() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-tyres-deactivator.php';
	Tyres_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_tyres' );
register_deactivation_hook( __FILE__, 'deactivate_tyres' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-tyres.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_tyres() {

	$plugin = new Tyres();
	$plugin->run();

}
run_tyres();
