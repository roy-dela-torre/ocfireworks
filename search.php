<?php
get_header();
global $wp_query;
$s = sanitize_text_field($_GET['s']); // Sanitize the search term
$img = get_stylesheet_directory_uri() . '/assets/img/homepage';
?>
<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/inc/css/search.css">
<section class="searchResults">
    <div id="overlay" style="display: none;">
        <div class="cv-spinner">
            <span class="spinner"></span>
        </div>
    </div>
    <div class="container-fluid">
        <div class="wrapper">
            <div class="row">
                <div class="header">
                    <h1 class="text-center">Search Result For “<?php echo esc_html($s); ?>”</h1>
                </div>
            </div>
            <div class="row product mb-4">
                <?php
                // Set up the query
                $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
                $args = array(
                    's' => $s,
                    'paged' => $paged,
                    'posts_per_page' => 8,
                    'post_type' => array('product'), // Search for products and posts
                );
                $search_query = new WP_Query($args);

                // Counter for columns to control layout
                global $product;
                $productLoop = new WP_Query($args);
                if ($productLoop->have_posts()):
                    while ($productLoop->have_posts()): $productLoop->the_post();
                        $img_url = get_the_post_thumbnail_url(get_the_ID(), 'large');
                        $product = wc_get_product(get_the_ID());
                        $product_id = get_the_ID();
                        $video_iframe = get_field('video_iframe', $product_id);
                        $title = get_the_title();
                        // $add_to_cart = '<a href="' . ($product->get_stock_status() === 'outofstock' ? 'javascript:void(0);' : esc_url(wc_get_cart_url() . '?add-to-cart=' . esc_attr($product_id))) . '" target="_blank" class="red_button w-100 text-center">Add to cart</a>';
                        $product_url = get_the_permalink();
                        if ($product) {
                            if ($product->is_type('variable')) {
                                $min_variation_price = number_format($product->get_variation_price('min'), 2);
                                $max_variation_price = number_format($product->get_variation_price('max'), 2);
                                $price_range = '₱' . $min_variation_price . ' - ' . '₱' . $max_variation_price;
                                $price = $price_range;
                            } else {
                                $price = $product->get_price_html();
                            }
                        } ?>
                        <?php
                        // Set up data to pass to the template
                        $data = array(
                            'img_url' => $img_url,     // Image URL
                            'title' => $title, // Product title
                            'price' => $price, // Product price
                            'product_url' => $product_url,
                            'product' => $product,
                            'product_id' => $product_id,
                            'video_iframe' => $video_iframe
                        );
                        // Load the template
                        ob_start(); ?>
                        <div class="col-lg-3 col-md-4 col-sm-6 col-12 product_column">
                            <?php echo wc_get_template('template/product_content.php', $data); ?>
                        </div>
                    <?php
                        $content = ob_get_clean();
                        // Output the content
                        echo $content;
                    endwhile;
                    wp_reset_postdata(); ?>
                <?php wp_reset_postdata();
                endif; ?>
                <div class="paging d-flex justify-content-center align-items-center">
                <?php
                $totalPages = $search_query->max_num_pages;
                echo paginate_links(array(
                    'total' => $totalPages,
                    'mid_size' => 2
                ));
                ?>
            </div>
            </div>
        </div>
    </div>
</section>
<?php include('wishlist_pop_up.php') ?>
<?php get_footer(); ?>