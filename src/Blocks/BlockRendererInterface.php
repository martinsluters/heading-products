<?php
/**
 * BlockRendererInterface class file
 *
 * @package heading-products
 */

declare(strict_types=1);

namespace martinsluters\Challenge\Blocks;

/**
 * Interface BlockRendererInterface
 */
interface BlockRendererInterface {

	/**
	 * Render the block.
	 */
	public function render(): void;
}
