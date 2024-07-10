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
<section class="banner"<?php if (is_tax('brands')) : ?> style="background: url('<?php echo get_stylesheet_directory_uri(); ?>/assets/img/brands/banner.png')no-repeat center center/cover	"<?php endif; ?>>
	<div class="wrapper">
		<div class="container-fluid">
			<div class="row">
				<div class="content">
					<?php if ( is_page() ) : ?>
						<!-- Display the page title for regular pages -->
						<h1 class="text-center text-white"><?php the_field('header'); ?></h1>
						<p class="text-white text-center"><?php the_field('banner_content'); ?></p>
					<?php elseif(is_tax('brands')):?>
						<h1 class="text-center text-white brands"><?php the_field('header'); ?>Borem ipsum dolor sit amet consectetur adipiscing elit</h1>
						<p class="text-white text-center"><?php the_field('banner_content'); ?>Korem ipsum dolor sit amet, consectetur adipiscing elit. Nunc vulputate libero et velit interdum, ac aliquet odio mattis. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Curabitur tempus urna at turpis.</p>
					<?php else : ?>
						<!-- Display the WooCommerce page title for archive pages -->
						<?php if ( apply_filters( 'woocommerce_show_page_title', true ) ) : ?>
							<h1 class="text-center text-white"><?php woocommerce_page_title(); ?></h1>
							<p class="text-white text-center"><?php woocommerce_taxonomy_archive_description()?></p>
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
					<h2 class="red_text text-center"><?php echo is_page() ? the_title() :  woocommerce_page_title() ?></h2>
				</div>
				<div class="col-xl-3 col-lg-4 d-none d-lg-block">
					<div class="sidebar_filter sticky-top">
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
											'taxonomy' => 'brands', // assuming 'brands' is the taxonomy for WooCommerce product categories
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
													<span class="name">Show All</span>
												</a>
											</li>
											<?php 
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

													// Get the ACF field value for the featured image
													$featured_image = get_field('featured_image', 'brands_' . $category->term_id);
													$image_url = $featured_image ? esc_url($featured_image) : get_stylesheet_directory_uri() . '/assets/img/brands/barnds.png';

													?>
													<li class="position-relative">
														<!-- Use the category slug as the ID for the radio button -->
														<input type="radio" name="" id="<?php echo str_replace(' ', '-', strtolower(esc_html($category->name))); ?>" <?php echo $checked; ?>>
														<!-- Add the URL to the href attribute of the anchor tag -->
														<a href="<?php echo esc_url($category_url); ?>" rel="noopener noreferrer" class="stretched-link">
															<span class="name"><?php echo esc_html($category->name); ?></span>
															<img src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_html($category->name); ?>" class="mb-4">
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
										<?php echo do_shortcode('[price_filter]')?>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="d-block d-lg-none">
					<a class="btn btn-primary red_button d-flex align-items-center" data-bs-toggle="offcanvas" href="#offcanvasExample" role="button" aria-controls="offcanvasExample">Filters</a>
					<div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel" style="top: 32px;">
						<div class="offcanvas-header align-items-center justify-content-between top-0">
							<h5 class="offcanvas-title red_text" id="offcanvasExampleLabel"><?php the_field('header'); ?></h5>
							<button type="button" class="border-0 p-0 m-0 position-relative" data-bs-dismiss="offcanvas" aria-label="Close">
								<img src="http://localhost/ocfireworks/wp-content/themes/ocfireworks/assets/img/homepage/close.png" alt="">
							</button>
						</div>
						<div class="sidebar_filter rounded-0">
							<span class="filter">Filters</span>
							<div class="accordion" id="accordionExample_mobile">
								<div class="accordion-item">
									<h5 class="accordion-header">
										<button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#categories" aria-expanded="true" aria-controls="categories">
											Brands
										</button>
									</h5>
									<div id="categories" class="accordion-collapse collapse show" data-bs-parent="#accordionExample_mobile">
										<div class="accordion-body p-0">
											<?php
												function getCurrentUrlarchive1() {
													$scheme = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http';
													$host = $_SERVER['HTTP_HOST'];
													$requestUri = $_SERVER['REQUEST_URI'];
													return $scheme . '://' . $host . $requestUri;
												}

												$product_categories = get_terms(array(
													'taxonomy' => 'brands',
													'hide_empty' => false,
												));

												$counter = 1;
												$current_url = getCurrentUrlarchive1();

												if ($product_categories && !is_wp_error($product_categories)) {
													echo '<ul class="ps-0 mb-0">';
													?>
													<li class="position-relative">
														<input type="radio" name="category" id="showAll" <?php echo is_shop() ? "checked" : "" ?>>
														<a href="<?php echo get_home_url(); ?>/shop/" rel="noopener noreferrer" class="stretched-link">
															<span class="name">Show All</span>
														</a>
													</li><?php 
													foreach ($product_categories as $category) {
														if (esc_html($category->name) === "Uncategorized") {
															continue;
														}

														$category_url = get_term_link($category);

														if (!is_wp_error($category_url)) {
															$checked = ($current_url === $category_url) ? 'checked' : '';
															?>
															<li class="position-relative">
																<input type="radio" name="category" id="<?php echo str_replace(' ', '-', strtolower(esc_html($category->name))); ?>" <?php echo $checked; ?>>
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
									<div id="price" class="accordion-collapse collapse" data-bs-parent="#accordionExample_mobile">
										<div class="accordion-body">
											<?php echo do_shortcode('[price_filter]') ?>
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
							$orderby = isset($_GET['orderby']) ? sanitize_text_field($_GET['orderby']) : 'rand';
        					set_query_var('orderby', $orderby);
							get_template_part('woocommerce/loop/orderby'); 
							$current_page_id = get_the_ID();
							$page_slug = get_post_field('post_name', $current_page_id);
							$taxonomies = get_object_taxonomies('product', 'names');
							$found_taxonomy = '';
							foreach ($taxonomies as $taxonomy) {
								$term = get_term_by('slug', $page_slug, $taxonomy);
								if ($term && !is_wp_error($term)) {
									$found_taxonomy = $taxonomy;
									break;
								}
							}
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
										'taxonomy' => $found_taxonomy,
										'field' => 'slug',
										'terms' => $page_slug,
									),
								),
							);
							$productLoop = new WP_Query($args);

							if ($productLoop->have_posts()) :
								woocommerce_product_loop_start();
								while ($productLoop->have_posts()) : $productLoop->the_post();
									wc_get_template_part('content', 'product');
								endwhile;
								woocommerce_product_loop_end();
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
								do_action('woocommerce_no_products_found');
							endif;
						} else {
							if (woocommerce_product_loop()) {
								do_action('woocommerce_before_shop_loop');
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
								woocommerce_product_loop_end();
								do_action('woocommerce_after_shop_loop');
							} else {
								do_action('woocommerce_no_products_found');
							}
						}
						?>
						<?php do_action('woocommerce_after_main_content'); ?>
					</div>

				</div>
			</div>
		</div>
	</div>
</section>

<?php get_template_part('template/related', 'product');
if(is_page()){
	get_template_part('template/random', 'product');
}
get_template_part('template/page', 'landing');
echo get_template_part('wishlist_pop_up'); 
do_action( 'woocommerce_after_main_content' );
get_footer( 'shop' );