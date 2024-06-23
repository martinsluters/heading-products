<?php
/**
 * AbstractTemplateFileRenderer class file
 *
 * @package heading-products
 */

declare(strict_types=1);

namespace martinsluters\Challenge\Blocks;

use martinsluters\Challenge\TemplateEngine\TemplateRenderInterface;

/**
 * Class AbstractTemplateFileRenderer
 */
abstract class AbstractTemplateFileRenderer implements BlockRendererInterface {

	/**
	 * The template renderer instance.
	 *
	 * @var TemplateRenderInterface
	 */
	private TemplateRenderInterface $template_renderer;

	/**
	 * The template file path.
	 *
	 * @var string
	 */
	protected string $template_file_path;

	/**
	 * The data to pass to the template.
	 *
	 * @var array
	 */
	protected array $data = array();

	/**
	 * The block attributes.
	 *
	 * @var array
	 */
	protected array $block_attributes;

	/**
	 * Constructor.
	 *
	 * @param TemplateRenderInterface $template_renderer The template renderer engine.
	 * @param string                  $template_file_path The template file path.
	 * @param array                   $block_attributes The block attributes.
	 */
	public function __construct( TemplateRenderInterface $template_renderer, string $template_file_path, array $block_attributes ) {
		$this->template_file_path = $template_file_path;
		$this->block_attributes   = $block_attributes;
		$this->template_renderer  = $template_renderer;
	}

	/**
	 * Render template with data.
	 *
	 * @return void
	 */
	protected function render_template() {
		$this->data = apply_filters( 'blocks_template_data_before_template_file_render', $this->data, $this->template_file_path, $this->block_attributes );
		$this->template_renderer->render( $this->template_file_path, $this->data );
	}
}
