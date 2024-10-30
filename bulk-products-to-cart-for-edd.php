<?php
/**
 * The plugin bootstrap file
 *
 * @link    https://profiles.wordpress.org/himanshud
 * @since   1.0.0
 * @package Bulk_Products_To_Cart_For_Edd
 *
 * @wordpress-plugin
 * Plugin Name:       Bulk Products to Cart for EDD
 * Plugin URI:        https://profiles.wordpress.org/himanshud/
 * Description:       The Bulk Products to Cart for Easy Digital Downloads is an Add-On plugin of the Easy Digital Downloads (EDD) plugin. This powerful plugin allows users to display their products in a sleek and professional table layout with advanced features like bulk add-to-cart, pagination, etc.
 * Version:           1.0.0
 * Author:            Himanshu Dhakan
 * Author URI:        https://profiles.wordpress.org/himanshud
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       bptcfedd
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 */
define( 'BPTCFEDD_VERSION', '1.0.0' );

/**
 * Plugin dir path.
 */
define( 'BPTCFEDD_FILE', __FILE__ );

/**
 * Plugin dir path.
 */
define( 'BPTCFEDD_PLUGIN_DIR_PATH', plugin_dir_path( __FILE__ ) );

/**
 * Plugin dir url.
 */
define( 'BPTCFEDD_PLUGIN_DIR_URL', plugin_dir_url( __FILE__ ) );

/**
 * Includes dir path.
 */
define( 'BPTCFEDD_INC_DIR_PATH', BPTCFEDD_PLUGIN_DIR_PATH . 'includes/' );

/**
 * Admin dir path.
 */
define( 'BPTCFEDD_ADMIN_DIR_PATH', BPTCFEDD_PLUGIN_DIR_PATH . 'admin/' );

/**
 * Admin dir url.
 */
define( 'BPTCFEDD_ADMIN_DIR_URL', BPTCFEDD_PLUGIN_DIR_URL . 'admin/' );

/**
 * Admin template dir path.
 */
define( 'BPTCFEDD_ADMIN_TEMPLATE_PATH', BPTCFEDD_ADMIN_DIR_PATH . 'partials/' );

/**
 * Public dir path.
 */
define( 'BPTCFEDD_PUBLIC_DIR_PATH', BPTCFEDD_PLUGIN_DIR_PATH . 'public/' );

/**
 * Public dir url.
 */
define( 'BPTCFEDD_PUBLIC_DIR_URL', BPTCFEDD_PLUGIN_DIR_URL . 'public/' );

/**
 * Public template dir path.
 */
define( 'BPTCFEDD_PUBLIC_TEMPLATE_PATH', BPTCFEDD_PUBLIC_DIR_PATH . 'partials/' );

/**
 * Public dir path.
 */
define( 'BPTCFEDD_LIBS_DIR_PATH', BPTCFEDD_PLUGIN_DIR_PATH . 'libs/' );

/**
 * Public dir url.
 */
define( 'BPTCFEDD_LIBS_DIR_URL', BPTCFEDD_PLUGIN_DIR_URL . 'libs/' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require BPTCFEDD_INC_DIR_PATH . 'class-bulk-products-to-cart-for-edd.php';

/**
 * Begins execution of the plugin.
 *
 * @since 1.0.0
 */
function bptcfedd_run() {
	$bptcfedd = new Bulk_Products_To_Cart_For_Edd();

	if ( class_exists( 'Easy_Digital_Downloads' ) ) {
		$bptcfedd->run();
	} else {
		$bptcfedd->bptcfedd_deactivate();
	}

}
add_action( 'plugins_loaded', 'bptcfedd_run' );
