<?php
/**
 * TwigTemplateRenderAdapter class file.
 *
 * @package heading-products
 */

declare(strict_types=1);

namespace martinsluters\Challenge\TemplateEngine\Twig;

use martinsluters\Challenge\TemplateEngine\TemplateRenderInterface;
use martinsluters\Challenge\Dependencies\Twig\Environment;

/**
 * Class TwigTemplateRenderAdapter.
 */
class TwigTemplateRenderAdapter implements TemplateRenderInterface {

	/**
	 * The Twig environment instance.
	 *
	 * @var Environment
	 */
	private Environment $twig;

	/**
	 * Constructor.
	 *
	 * @param Environment $twig The Twig environment instance.
	 */
	public function __construct( Environment $twig ) {
		$this->twig = $twig;
	}

	/**
	 * Render the template.
	 *
	 * @param string $template_path The path to the template file.
	 * @param array  $data The data to pass to the template.
	 * @return void
	 */
	public function render( string $template_path, array $data ): void {
		try {
			echo $this->twig->render( $template_path, $data ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		} catch ( \Exception $e ) {
			// This can be handled better of course.
			echo $e->getMessage(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		}
	}
}
