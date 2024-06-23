<?php
/**
 * Plugin Name:       Heading & Products Block
 * Description:       A custom block that displays heading and products
 * Version:           1.0
 * Requires at least: 6.0
 * Requires PHP:      7.4
 * Author:            Martins Luters
 * Author URI:        https://github.com/martinsluters
 * Developer:         Martins Luters
 * Developer URI:     https://github.com/martinsluters
 * Plugin URI:        https://github.com/martinsluters/heading-products
 * License:           GPL-2.0-or-later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       heading-products
 *
 * @package           heading-products
 */

declare( strict_types=1 );

namespace martinsluters\Challenge;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( file_exists( __DIR__ . '/vendor/autoload.php' ) ) {
	require __DIR__ . '/vendor/autoload.php';
}

/**
 * Bootstraps the plugin.
 *
 * @return void
 */
function bootstrap() {
	// Check plugin's dependencies/requirements.
	if ( ! check_plugin_requirements() ) {
		display_woocommerce_not_active_notice();
		return;
	}

	add_action( 'init', __NAMESPACE__ . '\blocks_init' );
}
add_action( 'plugins_loaded', __NAMESPACE__ . '\bootstrap' );

/**
 * Registers block(s).
 *
 * @return void
 */
function blocks_init() {
	$blocks = array(
		'heading-products/',
	);

	foreach ( $blocks as $block ) {
		register_block_type( plugin_dir_path( __FILE__ ) . 'includes/block-editor/blocks/' . $block );
	}
}

/**
 * Checks plugin requirements. In this case, it checks if WooCommerce is active.
 *
 * @return bool
 */
function check_plugin_requirements(): bool {
	// Check if WooCommerce is active.
	// We can also check for WooCommerce version if needed.
	return defined( 'WC_VERSION' );
}

/**
 * Adds admin notice if WooCommerce is not active.
 *
 * @return void
 */
function display_woocommerce_not_active_notice() {
	add_action( 'admin_notices', __NAMESPACE__ . '\woocommerce_not_active_notice' );
}

/**
 * WooCommerce not active notice.
 *
 * @return void
 */
function woocommerce_not_active_notice() {
	printf( '<div class="notice notice-error"><p>%s</p></div>', esc_html__( 'Heading & Products Block plugin requires WooCommerce plugin to be installed and activated.', 'heading-products' ) );
}
