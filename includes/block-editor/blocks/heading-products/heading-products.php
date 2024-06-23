<?php
/**
 * Main Heading & Products block render file.
 *
 * @package heading-products
 */

/**
 * Some of the below bits should be moved to a more appropriate place. Ideally, a container with lazy loading.
 * Maybe a factory for easier instantiation of the classes.
 * For simplicity for this simple plugin, I will leave them here.
 */
$template_path             = 'heading-products-grid.twig';
$twig                      = martinsluters\Challenge\TemplateEngine\Twig\Twig::get_instance();
$template_renderer         = new martinsluters\Challenge\TemplateEngine\Twig\TwigTemplateRenderAdapter( $twig );
$wc_products_query         = new WC_Product_Query();
$heading_products_query    = new martinsluters\Challenge\Blocks\HeadingProducts\HeadingProductsQuery( $wc_products_query, $attributes );
$heading_products_renderer = new martinsluters\Challenge\Blocks\HeadingProducts\HeadingProductsRenderer( $heading_products_query, $template_renderer, $template_path, $attributes );
$heading_products_renderer->render();
