<?php
/**
 * The template for displaying product content within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://woo.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.6.0
 */

defined( 'ABSPATH' ) || exit;

global $product;

// Ensure visibility.
if ( empty( $product ) || ! $product->is_visible() ) {
	return;
}
$img = get_stylesheet_directory_uri().'/assets/img/homepage';
$product_title = get_the_title($product->get_id());
$product_short_description = $product->get_short_description();
$product_link = get_permalink($product->get_id());
?>

<div class="<?php echo is_archive() ? "col-xl-4 col-sm-6 col-12" : "col-lg-3 col-md-4 col-sm-6 col-12"?> product_column">
	<div class="product_content">
		<div class="product_image position-relative">
			<img loading="lazy" src="<?php echo wp_get_attachment_url($product->get_image_id()); ?>" alt="<?php echo get_the_title(); ?>" class="cards">
			<div class="absolute_button position-absolute <?php echo $product->is_on_sale() ? "" : "justify-content-end" ?>">
				<?php if ($product->is_on_sale()): ?>
					<span class="sale">Sale</span>
				<?php endif; ?>
				<?php echo do_shortcode('[yith_wcwl_add_to_wishlist]') ?>
			</div>
			<a href="<?php echo esc_url(get_permalink()); ?>" target="_blank" rel="noopener noreferrer" class="stretched-link"></a>
		</div>
		<div class="product_content">
			<h3 class="text-center"><?php echo $product_title; ?></h3>
			<div class="product_reviews d-flex align-items-center justify-content-center">
				<div class="reviews_star d-flex align-items-center">
					<?php for ($i = 0; $i < 5; $i++): ?>
						<img src="<?php echo $img; ?>/star.png" alt="">
					<?php endfor; ?>
				</div>
				<div class="review_summary">
					<span>0.0</span>
				</div>
			</div>
			<p class="price">
				<?php wc_get_template('loop/price.php'); ?>
			</p>
		</div>
		<div class="add_to_cart">
			<a href="<?php echo esc_url( $product->add_to_cart_url() ); ?>" target="_blank" rel="noopener noreferrer">Add to Cart</a>
		</div>
	</div>
</div>
