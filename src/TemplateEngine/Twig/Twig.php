<?php
/**
 * Singleton Twig class file.
 *
 * @package heading-products
 */

declare(strict_types=1);

namespace martinsluters\Challenge\TemplateEngine\Twig;

use Exception;
use martinsluters\Challenge\PluginData;
use martinsluters\Challenge\Dependencies\Twig\Environment;
use martinsluters\Challenge\Dependencies\Twig\Loader\FilesystemLoader;

/**
 * Singleton class Twig.
 */
class Twig {

	/**
	 * The Twig environment instance.
	 *
	 * @var Environment
	 */
	private static Environment $twig;

	/**
	 * The instance of the class.
	 *
	 * @var Twig|null
	 */
	private static ?Twig $instance = null;

	/**
	 * Prevent the instance from being instantiated using constructor.
	 */
	private function __construct() {}

	/**
	 * Prevent the instance from being cloned.
	 *
	 * @return void
	 */
	private function __clone() {}

	/**
	 * Prevent from being unserialized.
	 *
	 * @return void
	 * @throws Exception Throw new Exception.
	 */
	public function __wakeup() {
		throw new Exception( 'Cannot unserialize singleton' );
	}

	/**
	 * Get the instance of the class.
	 *
	 * @return Environment The Twig environment instance.
	 * @throws Exception Throw new Exception.
	 */
	public static function get_instance(): Environment {
		if ( null === self::$instance ) {
			self::$instance = new self();
			self::init();
			return self::$twig;
		}

		return self::$twig;
	}

	/**
	 * Initialize and define the core functionality of the plugin.
	 *
	 * @return void
	 * @throws Exception Throw new Exception.
	 */
	private static function init() {

		$template_paths = array( PluginData::templates_dir() );

		if ( file_exists( PluginData::theme_templates_dir() ) ) {
			array_unshift( $template_paths, PluginData::theme_templates_dir() );
		}

		$loader     = new FilesystemLoader( $template_paths );
		self::$twig = new Environment(
			$loader,
			array()
		);
	}
}
