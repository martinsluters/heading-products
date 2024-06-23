<?php
/**
 * Abstract class file for products queries in a block.
 *
 * @package heading-products
 */

declare(strict_types=1);

namespace martinsluters\Challenge\Blocks;

/**
 * Abstract class for products queries in a block.
 */
abstract class AbstractProductsQuery {
	/**
	 * The WooCommerce product query instance.
	 *
	 * @var \WC_Product_Query
	 */
	protected \WC_Product_Query $wc_product_query;

	/**
	 * The block attributes.
	 *
	 * @var array
	 */
	protected array $block_attributes;

	/**
	 * Get the products query arguments.
	 *
	 * @return array
	 */
	abstract protected function get_query_arguments(): array;

	/**
	 * Constructor.
	 *
	 * @param \WC_Product_Query $wc_product_query The WooCommerce product query instance.
	 * @param array             $block_attributes The block attributes.
	 */
	public function __construct( \WC_Product_Query $wc_product_query, array $block_attributes ) {
		$this->wc_product_query = $wc_product_query;
		$this->block_attributes = $block_attributes;
	}

	/**
	 * Get the products query.
	 *
	 * @return \WC_Product_Query
	 */
	public function get_products_query(): \WC_Product_Query {
		$this->set_query_arguments();
		return $this->wc_product_query;
	}

	/**
	 * Set the query arguments for the products query.
	 *
	 * @see \WC_Product_Query::set()
	 * @return void
	 */
	private function set_query_arguments() {
		$query_arguments = $this->get_query_arguments();

		if ( empty( $query_arguments ) ) {
			return;
		}

		array_map(
			function ( $key, $value ) {
				$this->wc_product_query->set( $key, $value );
			},
			array_keys( $query_arguments ),
			$query_arguments
		);
	}
}
