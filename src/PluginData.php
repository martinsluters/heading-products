<?php
/**
 * PluginData class file.
 *
 * @package heading-products
 */

declare(strict_types=1);

namespace martinsluters\Challenge;

/**
 * PluginData class.
 * The basic information about this plugin, like its texts (text domain and display name) and file locations.
 */
class PluginData {

	/**
	 * Get this plugin's text domain.
	 *
	 * Must match the plugin's main directory and its main PHP filename.
	 *
	 * @return string
	 */
	public static function plugin_text_domain(): string {
		return 'heading-products';
	}


	/**
	 * Get this plugin's directory path, relative to this file's location.
	 *
	 * @return string
	 */
	public static function plugin_dir_path(): string {
		return trailingslashit( realpath( __DIR__ . DIRECTORY_SEPARATOR . '..' ) );
	}

	/**
	 * Get this plugin's directory URL.
	 *
	 * @return string
	 */
	public static function plugin_dir_url(): string {
		return plugin_dir_url( self::main_plugin_file() );
	}

	/**
	 * Get the base URL of our build directory.
	 *
	 * @return string
	 */
	public static function get_assets_url_base(): string {
		$dist = 'build/';
		return self::plugin_dir_url() . $dist;
	}

	/**
	 * Get this plugin's basename.
	 */
	public static function plugin_basename(): string {
		return plugin_basename( self::main_plugin_file() );
	}

	/**
	 * Get this plugin's template directory
	 *
	 * @return string
	 */
	public static function templates_dir(): string {
		$templates_dir = 'templates/';
		return self::plugin_dir_path() . $templates_dir;
	}

	/**
	 * Get this plugin's theme templates directory
	 * This is where the theme can override the plugin's twig templates.
	 *
	 * @return string
	 */
	public static function theme_templates_dir(): string {
		$templates_dir = self::plugin_text_domain() . '-templates/';
		return trailingslashit( get_stylesheet_directory() ) . $templates_dir;
	}

	/**
	 * Get this plugin's main plugin file.
	 *
	 * @return string
	 */
	private static function main_plugin_file(): string {
		return self::plugin_dir_path() . self::plugin_text_domain() . '.php';
	}
}
