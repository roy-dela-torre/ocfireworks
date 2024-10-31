<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-single-product.php.
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

/**
 * Hook: woocommerce_before_single_product.
 *
 * @hooked woocommerce_output_all_notices - 10
 */
do_action( 'woocommerce_before_single_product' );

if ( post_password_required() ) {
	echo get_the_password_form(); // WPCS: XSS ok.
	return;
}
?>
<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/inc/css/single_product.css">
<div id="product-<?php the_ID(); ?>" <?php wc_product_class( '', $product ); ?>>

	<section class="single_product">
		<div class="wrapper">
			<div class="container-fluid">
				<div class="row">
					<div class="col-xl-6 col-lg-12">
						<div class="product_image">
							<?php
								if ( function_exists( 'woocommerce_show_product_images' ) ) {
									woocommerce_show_product_images();
								}
							?>
						</div>
					</div>
					<div class="col-xl-6 col-lg-12">
						<div class="summary entry-summary">
							<h1><?php echo the_title(); ?></h1>

							<?php if ( ! wc_review_ratings_enabled() ) {
								return;
							}

							$rating_count = $product->get_rating_count();
							$review_count = $product->get_review_count();
							$average      = $product->get_average_rating();

							if ( $rating_count > 0 ) : ?>

								<div class="product_reviews d-flex align-items-center">
									<?php 
									for ($i = 1; $i <= 5; $i++): ?>
										<?php if ($i <= $review_count): ?>
											<svg xmlns="http://www.w3.org/2000/svg" width="20" height="19" viewBox="0 0 20 19" fill="#FFD600">
												<path d="M10 0.5L12.2451 7.40983H19.5106L13.6327 11.6803L15.8779 18.5902L10 14.3197L4.12215 18.5902L6.36729 11.6803L0.489435 7.40983H7.75486L10 0.5Z"/>
											</svg>
										<?php else: ?>
											<svg xmlns="http://www.w3.org/2000/svg" width="20" height="19" viewBox="0 0 20 19" fill="#A9A9A9">
												<path d="M10 0.5L12.2451 7.40983H19.5106L13.6327 11.6803L15.8779 18.5902L10 14.3197L4.12215 18.5902L6.36729 11.6803L0.489435 7.40983H7.75486L10 0.5Z"/>
											</svg>
										<?php endif; ?>
									<?php endfor; ?>
									<div class="review_summary">
										<span><?php echo number_format($average, 1); ?></span>
									</div>
								</div>
							<?php endif; ?>

							<?php if ( $price_html = $product->get_price_html() ) : ?>
								<span class="price"><?php echo $price_html; ?></span>
							<?php endif; ?>

							<div class="info">
								<div class="d-flex align-items-center">
									<strong class="text-uppercase">Availability:</strong>
									<p></p>
								</div>
								<div class="d-flex align-items-center">
									<strong class="text-uppercase">less Weight:</strong>
									<p></p>
								</div>
								<div class="d-flex align-items-center">
									<strong class="text-uppercase">Shots:</strong>
									<p></p>
								</div>
								<div class="d-flex align-items-center">
									<strong class="text-uppercase">Duration:</strong>
									<p></p>
								</div>
								<div class="d-flex align-items-center">
									<strong class="text-uppercase">Duration Range:</strong>
									<p></p>
								</div>
							</div>
							<?php if ( ! $product->is_purchasable() ) {
									return;
								}

								echo wc_get_stock_html( $product ); // WPCS: XSS ok.

								if ( $product->is_in_stock() ) : ?>

									<?php do_action( 'woocommerce_before_add_to_cart_form' ); ?>

									<form class="cart" action="<?php echo esc_url( apply_filters( 'woocommerce_add_to_cart_form_action', $product->get_permalink() ) ); ?>" method="post" enctype='multipart/form-data'>
										<?php do_action( 'woocommerce_before_add_to_cart_button' ); ?>

										<?php
										do_action( 'woocommerce_before_add_to_cart_quantity' );

										woocommerce_quantity_input(
											array(
												'min_value'   => apply_filters( 'woocommerce_quantity_input_min', $product->get_min_purchase_quantity(), $product ),
												'max_value'   => apply_filters( 'woocommerce_quantity_input_max', $product->get_max_purchase_quantity(), $product ),
												'input_value' => isset( $_POST['quantity'] ) ? wc_stock_amount( wp_unslash( $_POST['quantity'] ) ) : $product->get_min_purchase_quantity(), // WPCS: CSRF ok, input var ok.
											)
										);

										do_action( 'woocommerce_after_add_to_cart_quantity' );
										?>

										<button type="submit" name="add-to-cart" value="<?php echo esc_attr( $product->get_id() ); ?>" class="single_add_to_cart_button buttont alt<?php echo esc_attr( wc_wp_theme_get_element_class_name( 'button' ) ? ' ' . wc_wp_theme_get_element_class_name( 'button' ) : '' ); ?>"><?php echo esc_html( $product->single_add_to_cart_text() ); ?></button>

										<?php do_action( 'woocommerce_after_add_to_cart_button' ); ?>
									</form>

									<?php do_action( 'woocommerce_after_add_to_cart_form' ); ?>

								<?php endif; ?>

							<?php
							/**
							 * Hook: woocommerce_single_product_summary.
							 *
							 * @hooked woocommerce_template_single_title - 5
							 * @hooked woocommerce_template_single_rating - 10
							 * @hooked woocommerce_template_single_price - 10
							 * @hooked woocommerce_template_single_excerpt - 20
							 * @hooked woocommerce_template_single_add_to_cart - 30
							 * @hooked woocommerce_template_single_meta - 40
							 * @hooked woocommerce_template_single_sharing - 50
							 * @hooked WC_Structured_Data::generate_product_data() - 60
							 */
							//do_action( 'woocommerce_single_product_summary' );
							?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- Product Summary -->

	<!-- Product Reviews -->
	<section class="product_reviews pb-0">
		<div class="wrapper">
			<div class="container-fluid">
				<div class="row">
					<?php $product_tabs = apply_filters( 'woocommerce_product_tabs', array() );
					$video_iframe = get_field('video_iframe', get_the_ID());
					if ( ! empty( $product_tabs ) ) : ?>
						<div class="woocommerce-tabs wc-tabs-wrapper">
							<ul class="tabs wc-tabs" role="tablist">
								<?php foreach ( $product_tabs as $key => $product_tab ) : ?>
									<li class="<?php echo esc_attr( $key ); ?>_tab" id="tab-title-<?php echo esc_attr( $key ); ?>" role="tab" aria-controls="tab-<?php echo esc_attr( $key ); ?>">
										<a href="#tab-<?php echo esc_attr( $key ); ?>">
											<?php echo wp_kses_post( apply_filters( 'woocommerce_product_' . $key . '_tab_title', $product_tab['title'], $key ) ); ?>
										</a>
									</li>
								<?php endforeach; ?>
								<li class="custom_tab_tab active" id="tab-title-custom_tab" role="tab" aria-controls="tab-custom_tab">
									<a href="#tab-custom_tab">See fireworks Display</a>
								</li>
							</ul>
							<?php foreach ( $product_tabs as $key => $product_tab ) : ?>
								<div class="woocommerce-Tabs-panel woocommerce-Tabs-panel--<?php echo esc_attr( $key ); ?> panel entry-content wc-tab" id="tab-<?php echo esc_attr( $key ); ?>" role="tabpanel" aria-labelledby="tab-title-<?php echo esc_attr( $key ); ?>">
									<?php
									if ( isset( $product_tab['callback'] ) ) {
										call_user_func( $product_tab['callback'], $key, $product_tab );
									}
									?>
								</div>
							<?php endforeach; ?>
							<div class="woocommerce-Tabs-panel woocommerce-Tabs-panel--custom_tab panel entry-content wc-tab" id="tab-custom_tab" role="tabpanel" aria-labelledby="tab-title-custom_tab" style="">
								<h2>See fireworks Display</h2>
								<div class="videos">
									<div class="row">
										<div class="col-lg-6 col-md-12">
											<div class="youtube_videos">
												<?php if(!empty($video_iframe)):?>
													<div class="iframe">
														
														<iframe width="560" height="315" src="<?php echo $video_iframe; ?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
													</div>
												<?php endif; ?>
											</div>
										</div>
										<div class="col-lg-6 col-md-12">
											<div class="3d_videos">
												<!-- <iframe data-src="https://www.iconasys.com/Downloads/360/multi-purpose-tool-360-view/iframe.html" width="100%" height="500" scrolling="yes" class="iframe-class lazyloaded" frameborder="0" src="https://www.iconasys.com/Downloads/360/multi-purpose-tool-360-view/iframe.html"></iframe>	 -->
													<!-- Use it like any other HTML element -->
												<model-viewer alt="3D image" src="https://d1a370nemizbjq.cloudfront.net/0a08c3a8-c67a-41ea-bfdb-28d0e9894db7.glb" ar ar-modes="webxr scene-viewer quick-look" seamless-poster shadow-intensity="1" camera-controls auto-rotate style="height: 100%;width: 100%;"></model-viewer>

												<!-- Import the component -->
												<script type="module" src="https://unpkg.com/@google/model-viewer/dist/model-viewer.min.js"></script>
											</div>
										</div>
									</div>
								</div>			
							</div>
							<?php do_action( 'woocommerce_product_after_tabs' ); ?>
						</div>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</section>							
	<!-- Product Reviews -->
	
</div>
<!-- Relate Product Section -->
<?php
	if ( function_exists( 'woocommerce_output_related_products' ) ) {
		woocommerce_output_related_products();
	}
?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
<?php do_action( 'woocommerce_after_single_product' ); ?>
<?php echo get_template_part('wishlist_pop_up'); ?>