<?php
/**
 * HeadingProductsRenderer class file.
 *
 * @package heading-products
 */

declare(strict_types=1);

namespace martinsluters\Challenge\Blocks\HeadingProducts;

use martinsluters\Challenge\Blocks\AbstractProductsQuery;
use martinsluters\Challenge\Blocks\AbstractTemplateFileRenderer;
use martinsluters\Challenge\TemplateEngine\TemplateRenderInterface;

/**
 * Concrete Class HeadingProductsRenderer
 */
class HeadingProductsRenderer extends AbstractTemplateFileRenderer {

	/**
	 * The products query instance.
	 *
	 * @var AbstractProductsQuery
	 */
	protected AbstractProductsQuery $products_query;

	/**
	 * Constructor.
	 *
	 * @param AbstractProductsQuery   $products_query The products query instance.
	 * @param TemplateRenderInterface $template_renderer The template renderer engine instance.
	 * @param string                  $template_file_path The template file path.
	 * @param array                   $block_attributes The block attributes.
	 */
	public function __construct( AbstractProductsQuery $products_query, TemplateRenderInterface $template_renderer, string $template_file_path, array $block_attributes ) {
		$this->products_query = $products_query;
		parent::__construct( $template_renderer, $template_file_path, $block_attributes );
	}

	/**
	 * Render the block html.
	 *
	 * @return void
	 */
	public function render(): void {
		$this->init_data();

		// Short circuit if products are already available.
		if ( $this->maybe_short_circuit() ) {
			$this->render_template();
			return;
		}

		$this->inject_product_query_data();

		$this->filter_template_data_before_render();

		$this->render_template();
	}

	/**
	 * Initialize template data.
	 *
	 * @return void
	 */
	protected function init_data() {
		$this->data = array(
			'products'              => array(),
			'heading'               => $this->block_attributes['heading'],
			'headingTagLevel'       => $this->block_attributes['headingTagLevel'],
			'headingTextAlignClass' => $this->block_attributes['textAlign'] ? "has-text-align-{$this->block_attributes['textAlign']}" : '',
			'blockIdentifier'       => $this->block_attributes['blockIdentifier'],
			'noProductsFoundText'   => esc_html__( 'No products found', 'heading-products' ), // Can be added to block editor to be editable.
			'beforeLoopAction'      => apply_filters( 'heading_products_before_loop', '', $this->block_attributes['blockIdentifier'], $this->block_attributes ),
			'afterLoopAction'       => apply_filters( 'heading_products_after_loop', '', $this->block_attributes['blockIdentifier'], $this->block_attributes ),
		);
	}

	/**
	 * Inject product query product data into template data.
	 *
	 * @return void
	 */
	protected function inject_product_query_data() {
		$this->data['products'] = $this->products_query->get_products_query()->get_products();
	}

	/**
	 * Short circuit if products are already available.
	 * They might come somehow else here, we take this into account and make available to extend this.
	 *
	 * @return bool
	 */
	protected function maybe_short_circuit(): bool {

		$products = apply_filters( 'product_blocks_heading_products', null, $this->block_attributes['blockIdentifier'], $this->block_attributes );

		if ( is_null( $products ) ) {
			return false;
		}

		if ( ! is_array( $products ) ) {
			return false;
		}

		$this->data['products'] = $products;
		return true;
	}

	/**
	 * Filter template data before render.
	 *
	 * @return void
	 */
	protected function filter_template_data_before_render() {
		$this->data = apply_filters( 'blocks_template_data_before_heading_products_block_render', $this->data, $this->template_file_path, $this->block_attributes, $this->products_query );
	}
}
