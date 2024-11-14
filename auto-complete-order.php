<?php
/**
 * Plugin Name:       Fast Auto Order Complete
 * Description:       A WooCommerce-based plugin that allows users to auto-complete orders without processing them and removes the processing email notification.
 * Version:           1.0.2
 * Author:            Tareq Monower
 * Author URI:        https://profiles.wordpress.org/tamimh/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       fast-auto-order-complete
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
    die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 */
define( 'FAST_AUTO_ORDER_COMPLETE_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-fast-auto-order-complete-activator.php
 */
function fast_auto_order_complete_activate() {
    // Require the activator class file
    require_once plugin_dir_path( __FILE__ ) . 'includes/class-fast-auto-order-complete-activator.php';
    // Activate the plugin
    Fast_Auto_Order_Complete_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-fast-auto-order-complete-deactivator.php
 */
function fast_auto_order_complete_deactivate() {
    // Require the deactivator class file
    require_once plugin_dir_path( __FILE__ ) . 'includes/class-fast-auto-order-complete-deactivator.php';
    // Deactivate the plugin
    Fast_Auto_Order_Complete_Deactivator::deactivate();
}

// Register the activation and deactivation hooks
register_activation_hook( __FILE__, 'fast_auto_order_complete_activate' );
register_deactivation_hook( __FILE__, 'fast_auto_order_complete_deactivate' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-fast-auto-order-complete.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 */
function run_fast_auto_order_complete() {
    // Create an instance of the Fast_Auto_Order_Complete class
    $plugin = new Fast_Auto_Order_Complete();
    // Run the plugin
    $plugin->run();
}
// Start the plugin
run_fast_auto_order_complete();