<?php
/**
 * HeadingProductsQuery class file.
 *
 * @package heading-products
 */

declare(strict_types=1);

namespace martinsluters\Challenge\Blocks\HeadingProducts;

use martinsluters\Challenge\Blocks\AbstractProductsQuery;

/**
 * Class HeadingProductsQuery
 */
class HeadingProductsQuery extends AbstractProductsQuery {

	/**
	 * The default query arguments keys.
	 *
	 * @var array
	 */
	protected array $default_query_arguments_keys = array(
		'orderby',
		'order',
	);

	/**
	 * Get the products query arguments.
	 *
	 * @return array
	 */
	protected function get_query_arguments(): array {
		$query_arguments = array();

		/**
		 * Filter the query arguments, basically checking if the key exists in the block attributes.
		 */
		$active_default_query_arguments = array_filter(
			$this->default_query_arguments_keys,
			function ( $key ) {
				return array_key_exists( $key, $this->block_attributes );
			}
		);

		/**
		 * Map the active default query arguments to the query arguments array.
		 */
		array_map(
			function ( $key ) use ( &$query_arguments ) {
				$query_arguments[ $key ] = $this->block_attributes[ $key ];
			},
			$active_default_query_arguments
		);

		/**
		 * Filter the query arguments.
		 */
		$query_arguments
			= apply_filters(
				'product_blocks_heading_products_query_args',
				$query_arguments,
				$this->block_attributes
			);

		/**
		 * Filter the query arguments, checking if the blockIdentifier key exists in the block attributes.
		 * If it exists, apply the filter for the specific blockIdentifier - specific block.
		 */
		if ( array_key_exists( 'blockIdentifier', $this->block_attributes ) && ! empty( $this->block_attributes['blockIdentifier'] ) ) {
			$query_arguments
				= apply_filters(
					"product_blocks_heading_products_query_args_{$this->block_attributes['blockIdentifier']}",
					$query_arguments,
					$this->block_attributes
				);
		}

		return $query_arguments;
	}
}
