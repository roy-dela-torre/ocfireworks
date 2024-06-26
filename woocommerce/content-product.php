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
			<div class="group_button_on_hover">
				<div class="view d-flex flex-column align-items-center position-relative">
					<svg xmlns="http://www.w3.org/2000/svg" width="51" height="50" viewBox="0 0 51 50" fill="none">
						<path d="M25.5 31.25C28.9518 31.25 31.75 28.4518 31.75 25C31.75 21.5482 28.9518 18.75 25.5 18.75C22.0482 18.75 19.25 21.5482 19.25 25C19.25 28.4518 22.0482 31.25 25.5 31.25Z" fill="white"/>
						<path d="M48.8436 24.4688C47.0058 19.7151 43.8154 15.6041 39.6667 12.6439C35.518 9.68368 30.5928 8.00402 25.4998 7.8125C20.4069 8.00402 15.4817 9.68368 11.333 12.6439C7.18422 15.6041 3.99382 19.7151 2.15607 24.4688C2.03196 24.812 2.03196 25.188 2.15607 25.5312C3.99382 30.2849 7.18422 34.3959 11.333 37.3561C15.4817 40.3163 20.4069 41.996 25.4998 42.1875C30.5928 41.996 35.518 40.3163 39.6667 37.3561C43.8154 34.3959 47.0058 30.2849 48.8436 25.5312C48.9677 25.188 48.9677 24.812 48.8436 24.4688ZM25.4998 35.1562C23.4911 35.1562 21.5275 34.5606 19.8573 33.4446C18.1871 32.3286 16.8854 30.7424 16.1167 28.8866C15.348 27.0308 15.1468 24.9887 15.5387 23.0186C15.9306 21.0485 16.8979 19.2388 18.3183 17.8184C19.7386 16.3981 21.5483 15.4308 23.5184 15.0389C25.4886 14.647 27.5306 14.8481 29.3865 15.6168C31.2423 16.3856 32.8285 17.6873 33.9444 19.3575C35.0604 21.0277 35.6561 22.9913 35.6561 25C35.6519 27.6923 34.5806 30.2732 32.6768 32.177C30.773 34.0808 28.1922 35.1521 25.4998 35.1562Z" fill="white"/>
					</svg>
					<a href="<?php echo esc_url(get_permalink()); ?>" target="_blank" rel="noopener noreferrer" class="stretched-link view">View</a>
				</div>
				<?php if(!empty($video_iframe)):?>
					<div class="play d-flex flex-column align-items-center">
						<svg xmlns="http://www.w3.org/2000/svg" width="51" height="50" viewBox="0 0 51 50" fill="none">
							<path fill-rule="evenodd" clip-rule="evenodd" d="M14.7318 8C14.0128 7.99929 13.3056 8.18176 12.6767 8.53019C12.0318 8.85891 11.4885 9.35694 11.105 9.9709C10.7216 10.5849 10.5124 11.2916 10.5 12.0153V37.9825C10.5124 38.7062 10.7216 39.413 11.105 40.0269C11.4885 40.6409 12.0318 41.1389 12.6767 41.4676C13.317 41.8233 14.0386 42.0066 14.771 41.9998C15.5034 41.993 16.2214 41.7962 16.855 41.4287L37.8437 28.4464C38.4914 28.1199 39.0357 27.62 39.4159 27.0024C39.7962 26.3847 39.9974 25.6736 39.9971 24.9483C39.9969 24.223 39.7952 23.512 39.4145 22.8946C39.0338 22.2772 38.4892 21.7777 37.8412 21.4517L16.8525 8.56667C16.2078 8.19453 15.4762 7.99906 14.7318 8Z" fill="white"/>
						</svg>
						<span class="play">View</span>
					</div>
				<?php endif; ?>
			</div>
		</div>
		<div class="product_content">
			<h3 class="text-center"><?php echo $product_title; ?></h3>
			<div class="product_reviews d-flex align-items-center justify-content-center">
				<?php 
				$total_reviews = $product->get_review_count();
				for ($i = 1; $i <= 5; $i++): ?>
					<?php if ($i <= $total_reviews): ?>
						<svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 30 30" fill="#FFD600">
							<path d="M10 0.5L12.2451 7.40983H19.5106L13.6327 11.6803L15.8779 18.5902L10 14.3197L4.12215 18.5902L6.36729 11.6803L0.489435 7.40983H7.75486L10 0.5Z"/>
						</svg>
					<?php else: ?>
						<svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 30 30" fill="#A9A9A9">
							<path d="M10 0.5L12.2451 7.40983H19.5106L13.6327 11.6803L15.8779 18.5902L10 14.3197L4.12215 18.5902L6.36729 11.6803L0.489435 7.40983H7.75486L10 0.5Z"/>
						</svg>
					<?php endif; ?>
				<?php endfor; ?>
				<div class="review_summary">
					<span><?php echo number_format($total_reviews, 1); ?></span>
				</div>
			</div>
			<p class="price">
				<?php wc_get_template('loop/price.php'); ?>
			</p>
		</div>
		<div class="add_to_cart">
			<?php echo do_shortcode('[add_to_cart id="' . $product->get_id() . '"]'); ?>
		</div>
	</div>
</div>
