<?php
/**
 * TemplateRenderInterface interface file.
 *
 * @package heading-products
 */

declare(strict_types=1);

namespace martinsluters\Challenge\TemplateEngine;

/**
 * TemplateRenderInterface interface.
 */
interface TemplateRenderInterface {

	/**
	 * Render the template.
	 *
	 * @param string $template_path The path to the template file.
	 * @param array  $data The data to pass to the template.
	 * @return void
	 */
	public function render( string $template_path, array $data ): void;
}
