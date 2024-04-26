<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://woo.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.4.0
 */

defined( 'ABSPATH' ) || exit;

get_header( 'shop' );

/**
 * Hook: woocommerce_before_main_content.
 *
 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
 * @hooked woocommerce_breadcrumb - 20
 * @hooked WC_Structured_Data::generate_website_data() - 30
 */
do_action( 'woocommerce_before_main_content' );
$img = get_stylesheet_directory_uri().'/assets/img/homepage';
?>
<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/inc/css/archive.css">
<section class="banner">
	<div class="wrapper">
		<div class="container-fluid">
			<div class="row">
				<div class="content">
					<?php if ( apply_filters( 'woocommerce_show_page_title', true ) ) : ?>
						<h1 class="text-center text-white"><?php woocommerce_page_title(); ?></h1>
						<?php woocommerce_taxonomy_archive_description()?>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</div>
</section>
<section class="product_main">
	<div class="wrapper">
		<div class="container-fluid">
			<div class="row">
				<div class="col-xl-3 col-lg-4 col-md-12">
					<div class="sidebar_filter">
						<span class="filter">Filters</span>
						<div class="accordion" id="accordionExample">
                            <div class="accordion-item">
                                <h5 class="accordion-header">
									<button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#categores" aria-expanded="true" aria-controls="categores">
										Brands
									</button>
                                </h5>
                                <div id="categores" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
                                    <div class="accordion-body p-0">
									<?php
										// Function to get the current page URL
										function getCurrentUrlarchive() {
											$scheme = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http';
											$host = $_SERVER['HTTP_HOST'];
											$requestUri = $_SERVER['REQUEST_URI'];
											return $scheme . '://' . $host . $requestUri;
										}

										// Fetch WooCommerce product categories
										$product_categories = get_terms(array(
											'taxonomy' => 'product_cat', // assuming 'product_cat' is the taxonomy for WooCommerce product categories
											'hide_empty' => false, // set to true if you want to hide empty categories
										));

										$counter = 1;

										// Get the current URL
										$current_url = getCurrentUrlarchive();

										// Check if categories are found and no errors occurred
										if ($product_categories && !is_wp_error($product_categories)) {
											echo '<ul class="ps-0 mb-0">';
											foreach ($product_categories as $category) {
												// Skip the "Uncategorized" category and move to the next iteration
												if (esc_html($category->name) === "Uncategorized") {
													continue;
												}

												// Get the URL of the current category
												$category_url = get_term_link($category);

												// Check if the URL was successfully retrieved
												if (!is_wp_error($category_url)) {
													// Determine whether to add the checked attribute based on the current URL
													$checked = ($current_url === $category_url) ? 'checked' : '';

													?>
													<li class="position-relative">
														<!-- Use the category slug as the ID for the radio button -->
														<input type="radio" name="" id="<?php echo str_replace(' ', '-', strtolower(esc_html($category->name))); ?>" <?php echo $checked; ?>>
														<!-- Add the URL to the href attribute of the anchor tag -->
														<a href="<?php echo esc_url($category_url); ?>" rel="noopener noreferrer" class="stretched-link">
															<span class="name"><?php echo esc_html($category->name); ?></span>
														</a>
													</li>
													<?php
												}
												$counter += 1;
											}
											echo '</ul>';
										} else {
											echo '<li>No product categories found</li>';
										}
										?>

                                    </div>
                                </div>
                            </div>
						</div>
					</div>
				</div>
				<div class="col-xl-9 col-lg-8 col-md-12">
					<div class="product_list">
					<?php
						if ( woocommerce_product_loop() ) {

							/**
							 * Hook: woocommerce_before_shop_loop.
							 *
							 * @hooked woocommerce_output_all_notices - 10
							 * @hooked woocommerce_result_count - 20
							 * @hooked woocommerce_catalog_ordering - 30
							 */
							do_action( 'woocommerce_before_shop_loop' );

							woocommerce_product_loop_start();

							if ( wc_get_loop_prop( 'total' ) ) {
								while ( have_posts() ) {
									the_post();

									/**
									 * Hook: woocommerce_shop_loop.
									 */
									do_action( 'woocommerce_shop_loop' );

									wc_get_template_part( 'content', 'product' );
								}
							}

							woocommerce_product_loop_end();

							/**
							 * Hook: woocommerce_after_shop_loop.
							 *
							 * @hooked woocommerce_pagination - 10
							 */
							do_action( 'woocommerce_after_shop_loop' );
						} else {
							/**
							 * Hook: woocommerce_no_products_found.
							 *
							 * @hooked wc_no_products_found - 10
							 */
							do_action( 'woocommerce_no_products_found' );
						}

						/**
						 * Hook: woocommerce_after_main_content.
						 *
						 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
						 */
						?>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<?php echo get_template_part('wishlist_pop_up'); ?>
<?php do_action( 'woocommerce_after_main_content' );

/**
 * Hook: woocommerce_sidebar.
 *
 * @hooked woocommerce_get_sidebar - 10
 */
// do_action( 'woocommerce_sidebar' );

get_footer( 'shop' );
