<?php
declare( strict_types=1 );

namespace martinsluters\Challenge\Tests\Unit;

/**
 * Unit Tests Related to booting up the plugin and blocks.
 */
class TestBlockBootstrap extends \WP_UnitTestCase {

	/**
	 * Test that the heading products group block is registered.
	 */
	public function testHeadingProductsGroupBlockIsRegistered() {
		\martinsluters\Challenge\blocks_init();
		$this->assertTrue( ( \WP_Block_Type_Registry::get_instance() )->is_registered( 'challenge/heading-products' ) );
	}
}
