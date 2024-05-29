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
					<?php if ( is_page() ) : ?>
						<!-- Display the page title for regular pages -->
						<h1 class="text-center text-white"><?php wp_title(); ?></h1>
						<?php the_field('banner_content'); ?>
					<?php else : ?>
						<!-- Display the WooCommerce page title for archive pages -->
						<?php if ( apply_filters( 'woocommerce_show_page_title', true ) ) : ?>
							<h1 class="text-center text-white"><?php woocommerce_page_title(); ?></h1>
							<?php woocommerce_taxonomy_archive_description()?>
						<?php endif; ?>
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
				<div class="header">
					<h2 class="red_text text-center"><?php the_field('header'); ?></h2>
				</div>
				<div class="col-xl-3 col-lg-4 d-none d-lg-block">
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
											'taxonomy' => 'brands', // assuming 'product_cat' is the taxonomy for WooCommerce product categories
											'hide_empty' => false, // set to true if you want to hide empty categories
										));

										$counter = 1;

										// Get the current URL
										$current_url = getCurrentUrlarchive();
										
										// Check if categories are found and no errors occurred
										if ($product_categories && !is_wp_error($product_categories)) {
											echo '<ul class="ps-0 mb-0">';
											?>
											<li class="position-relative">
												<input type="radio" name="" id="showAll" <?php echo is_shop() ? "checked" : "" ?>>
												<a href="<?php echo get_home_url(); ?>/shop/" rel="noopener noreferrer" class="stretched-link">
													<span class="name">Show ALl</span>
												</a>
											</li><?php 
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
							
							<div class="accordion-item">
								<h2 class="accordion-header">
									<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#price" aria-expanded="false" aria-controls="price">
										Price
									</button>
								</h2>
								<div id="price" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
									<div class="accordion-body">
										<p class="text-center">$500 is the maximum amount.</p>
										<div class="range-slider">
											<input value="0" min="0" max="50" step="1" type="range">
											<input value="50" min="0" max="50" step="1" type="range">
											<span class="rangeValues"></span>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="d-block d-lg-none">
					<a class="btn btn-primary red_button d-flex align-items-center" data-bs-toggle="offcanvas" href="#offcanvasExample" role="button" aria-controls="offcanvasExample">Menu<svg xmlns="http://www.w3.org/2000/svg" width="21" height="21" viewBox="0 0 21 21" fill="none">
						<g clip-path="url(#clip0_2187_65939)">
							<path d="M17.1654 15.0833C17.4864 15.0835 17.795 15.2071 18.0274 15.4287C18.2597 15.6502 18.3979 15.9526 18.4133 16.2733C18.4287 16.5939 18.3202 16.9082 18.1102 17.151C17.9002 17.3938 17.6049 17.5465 17.2854 17.5775L17.1654 17.5833H3.83203C3.51102 17.5832 3.20237 17.4595 2.97004 17.238C2.73772 17.0165 2.59952 16.714 2.58409 16.3934C2.56867 16.0728 2.67719 15.7585 2.88718 15.5157C3.09716 15.2728 3.39252 15.1201 3.71203 15.0892L3.83203 15.0833H17.1654ZM17.1654 9.24999C17.4969 9.24999 17.8148 9.38169 18.0492 9.61611C18.2837 9.85053 18.4154 10.1685 18.4154 10.5C18.4154 10.8315 18.2837 11.1495 18.0492 11.3839C17.8148 11.6183 17.4969 11.75 17.1654 11.75H3.83203C3.50051 11.75 3.18257 11.6183 2.94815 11.3839C2.71373 11.1495 2.58203 10.8315 2.58203 10.5C2.58203 10.1685 2.71373 9.85053 2.94815 9.61611C3.18257 9.38169 3.50051 9.24999 3.83203 9.24999H17.1654ZM17.1654 3.41666C17.4969 3.41666 17.8148 3.54835 18.0492 3.78277C18.2837 4.01719 18.4154 4.33514 18.4154 4.66666C18.4154 4.99818 18.2837 5.31612 18.0492 5.55054C17.8148 5.78496 17.4969 5.91666 17.1654 5.91666H3.83203C3.50051 5.91666 3.18257 5.78496 2.94815 5.55054C2.71373 5.31612 2.58203 4.99818 2.58203 4.66666C2.58203 4.33514 2.71373 4.01719 2.94815 3.78277C3.18257 3.54835 3.50051 3.41666 3.83203 3.41666H17.1654Z" fill="white"></path>
						</g>
						<defs>
							<clipPath id="clip0_2187_65939">
							<rect width="20" height="20" fill="white" transform="translate(0.5 0.5)"></rect>
							</clipPath>
						</defs>
						</svg>
					</a>
					<div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel" style="top: 32px;">
						<div class="offcanvas-header align-items-center justify-content-between top-0">
							<h5 class="offcanvas-title red_text" id="offcanvasExampleLabel"><?php the_field('header'); ?></h5>
							<button type="button" class="border-0 p-0 m-0 position-relative" data-bs-dismiss="offcanvas" aria-label="Close">
								<img src="http://localhost/ocfireworks/wp-content/themes/ocfireworks/assets/img/homepage/close.png" alt="">
							</button>
						</div>
						<div class="sidebar_filter rounded-0">
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
											function getCurrentUrlarchive1() {
												$scheme = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http';
												$host = $_SERVER['HTTP_HOST'];
												$requestUri = $_SERVER['REQUEST_URI'];
												return $scheme . '://' . $host . $requestUri;
											}

											// Fetch WooCommerce product categories
											$product_categories = get_terms(array(
												'taxonomy' => 'brands', // assuming 'product_cat' is the taxonomy for WooCommerce product categories
												'hide_empty' => false, // set to true if you want to hide empty categories
											));

											$counter = 1;

											// Get the current URL
											$current_url = getCurrentUrlarchive1();
											
											// Check if categories are found and no errors occurred
											if ($product_categories && !is_wp_error($product_categories)) {
												echo '<ul class="ps-0 mb-0">';
												?>
												<li class="position-relative">
													<input type="radio" name="" id="showAll" <?php echo is_shop() ? "checked" : "" ?>>
													<a href="<?php echo get_home_url(); ?>/shop/" rel="noopener noreferrer" class="stretched-link">
														<span class="name">Show ALl</span>
													</a>
												</li><?php 
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
								
								<div class="accordion-item">
									<h2 class="accordion-header">
										<button class="accordion-button collapsed rounded-0" type="button" data-bs-toggle="collapse" data-bs-target="#price" aria-expanded="false" aria-controls="price">
											Price
										</button>
									</h2>
									<div id="price_mobile" class="accordion-collapse collapse rounded-0" data-bs-parent="#accordionExample">
										<div class="accordion-body">
											<p class="text-center">$500 is the maximum amount.</p>
											<div class="range-slider">
												<input value="0" min="0" max="50" step="1" type="range">
												<input value="50" min="0" max="50" step="1" type="range">
												<span class="rangeValues"></span>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-xl-9 col-lg-8 col-md-12 ps-lg-5">
					<div class="product_list">
						<?php
						if (is_page()) {
							// Query random products
							$fourth_of_july_sale = "4th-of-july-fireworks-for-sale";
							$whole_sale_fireworks = "";
							global $paged;
                        	$curpage = $paged ? $paged : 1;
							$args = array(
								'post_type'      => 'product',
								'posts_per_page' => 6,
								'post_status'    => 'publish',
								'orderby'        => 'rand', // Order by random
								'paged' => $paged,
								'tax_query' => array(
									array(
										'taxonomy' => 'product_cat',
										'field' => 'slug',
										'terms' => '4th-of-july-fireworks-for-sale',
									),
								),
							);
							$productLoop = new WP_Query($args);

							if ($productLoop->have_posts()) :
								// Start product loop
								woocommerce_product_loop_start();

								// Loop through random products
								while ($productLoop->have_posts()) : $productLoop->the_post();
									// Load product content template
									wc_get_template_part('content', 'product');
								endwhile;

								// End product loop
								woocommerce_product_loop_end();

								// Reset post data
								wp_reset_postdata();
								?>
								<div class="paging d-flex justify-content-center align-items-center">
									<?php
									$totalPages = $productLoop->max_num_pages;
									echo paginate_links(array(
										'total' => $totalPages,
										'mid_size' => 2
									));
									?>
								</div>
								<?php
							else :
								// No random products found
								do_action('woocommerce_no_products_found');
							endif;
						} else {
							// Display products in the default way
							if (woocommerce_product_loop()) {
								// Hook: woocommerce_before_shop_loop
								do_action('woocommerce_before_shop_loop');

								// Start product loop
								woocommerce_product_loop_start();

								if (wc_get_loop_prop('total')) {
									while (have_posts()) {
										the_post();
										// Hook: woocommerce_shop_loop
										do_action('woocommerce_shop_loop');
										// Load product content template
										wc_get_template_part('content', 'product');
									}
								}

								// End product loop
								woocommerce_product_loop_end();

								// Hook: woocommerce_after_shop_loop
								do_action('woocommerce_after_shop_loop');
							} else {
								// No products found
								do_action('woocommerce_no_products_found');
							}
						}
						?>

						<!-- Hook: woocommerce_after_main_content -->
						<?php do_action('woocommerce_after_main_content'); ?>
					</div>

				</div>
			</div>
		</div>
	</div>
</section>
<?php get_template_part('template/related', 'product');
if (is_page('Spectacular 4th of July OC Fireworks on Sale')):
    get_template_part('categories_landing_page/fourth-of-july'); 
	elseif (is_page('Unlock the Best of Wholesale Fireworks Online with OC Fireworks') || is_product_category('wholesale-fireworks-online')):
	get_template_part('categories_landing_page/whole-sale'); ?>
<?php //elseif():?>
<?php //elseif():?>
<?php endif;?>

<?php echo get_template_part('wishlist_pop_up'); ?>
<?php do_action( 'woocommerce_after_main_content' );

/**
 * Hook: woocommerce_sidebar.
 *
 * @hooked woocommerce_get_sidebar - 10
 */
// do_action( 'woocommerce_sidebar' );

get_footer( 'shop' );
