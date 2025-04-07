<?php
function price_filter_shortcode()
{
    ob_start();
?>
    <div id="price-filter" class="accordion-collapse collapse show">
        <div class="accordion-body">
            <p class="text-center">$500 is the maximum amount.</p>
            <div class="range-slider">
                <input id="min-price" value="0" min="0" max="200" step="1" type="range" />
                <input id="max-price" value="500" min="0" max="200" step="1" type="range" />
                <form action="">
                    <div class="range_input">
                        <div class="minimum">
                            <input type="number" id="min-price-input" value="0" min="0" max="200" />
                        </div>
                        <div class="maximum">
                            <input type="number" id="max-price-input" value="200" min="0" max="200" />
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php
    return ob_get_clean();
}
add_shortcode('price_filter', 'price_filter_shortcode');


function filter_products_by_price()
{

    check_ajax_referer('price_filter_nonce', 'nonce');

    $min_price = isset($_POST['min_price']) ? floatval($_POST['min_price']) : 0;
    $max_price = isset($_POST['max_price']) ? floatval($_POST['max_price']) : 200;

    $args = array(
        'post_type' => 'product',
        'posts_per_page' => 6,
        'meta_query' => array(
            array(
                'key' => '_price',
                'value' => array($min_price, $max_price),
                'compare' => 'BETWEEN',
                'type' => 'DECIMAL',
            ),
        ),
    );

    $query = new WP_Query($args);

    if ($query->have_posts()) {
        woocommerce_product_loop_start();
        while ($query->have_posts()) {
            $query->the_post();


            $img_url = get_the_post_thumbnail_url(get_the_ID(), 'medium');
            $product = wc_get_product(get_the_ID());
            $product_id = get_the_ID();
            $video_iframe = get_field('video_iframe', $product_id);
            $title = get_the_title();
            $product_url = get_the_permalink();
            $price = $product->get_price_html();

            if ($product->is_type('variable')) {
                $min_variation_price = number_format($product->get_variation_price('min'), 2);
                $max_variation_price = number_format($product->get_variation_price('max'), 2);
                $price = '$' . $min_variation_price . ' - ' . '$' . $max_variation_price;
            }

            $data = array(
                'img_url' => $img_url,
                'title' => $title,
                'price' => $price,
                'product_url' => $product_url,
                'product' => $product,
                'product_id' => $product_id,
                'video_iframe' => $video_iframe
            );


            ob_start();
    ?>
            <div class="col-lg-4 col-md-6 product_column">
                <?php echo wc_get_template('template/product_content.php', $data); ?>
            </div>
<?php
            echo ob_get_clean();
        }

        woocommerce_product_loop_end();


        // $totalPages = $query->max_num_pages;
        // echo '<div class="paging d-flex justify-content-center align-items-center">';
        // echo paginate_links(array(
        //     'total' => $totalPages,
        //     'mid_size' => 2
        // ));
        // echo '</div>';
    } else {
        echo '<p>No products found.</p>';
    }

    wp_reset_postdata();
    wp_die();
}
add_action('wp_ajax_filter_products_by_price', 'filter_products_by_price');
add_action('wp_ajax_nopriv_filter_products_by_price', 'filter_products_by_price');


function enqueue_price_filter_scripts()
{
    wp_enqueue_script('price-filter-js', get_template_directory_uri() . '/js/price-filter.js', array('jquery'), null, true);

    wp_localize_script('price-filter-js', 'priceFilter', array(
        'ajaxurl' => admin_url('admin-ajax.php'),
        'nonce' => wp_create_nonce('price_filter_nonce'),
    ));
}
add_action('wp_enqueue_scripts', 'enqueue_price_filter_scripts');
