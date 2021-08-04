<?php

/**
 * Plugin Name:       HJQS - Mentions légales [FR]
 * Description:       Générateur : Mentions légales / Conditions générales de vente / Politique de confidentialité
 * Version:           1.0.0
 * Author:            Hugo JACQUES
 * Author URI:        https://hugojqs.fr
 * Text Domain:       hjqs-mentions-legales
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
define( 'HJQS_MENTIONS_LEGALES_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-hjqs-mentions-legales-activator.php
 */
function activate_hjqs_mentions_legales() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-hjqs-mentions-legales-activator.php';
	Hjqs_Mentions_Legales_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-hjqs-mentions-legales-deactivator.php
 */
function deactivate_hjqs_mentions_legales() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-hjqs-mentions-legales-deactivator.php';
	Hjqs_Mentions_Legales_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_hjqs_mentions_legales' );
register_deactivation_hook( __FILE__, 'deactivate_hjqs_mentions_legales' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-hjqs-mentions-legales.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_hjqs_mentions_legales() {

	$plugin = new Hjqs_Mentions_Legales();
	$plugin->run();

}
run_hjqs_mentions_legales();
