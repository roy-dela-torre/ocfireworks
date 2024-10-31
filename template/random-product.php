<section class="related_products">
    <div class="wrapper">
        <div class="container-fluid">
            <h2 class="text-center">Other Products</h2>
            <div class="row">
                <?php
                global $paged;
                $curpage = $paged ? $paged : 1;
                $args = array(
                    'post_type'      => 'product',
                    'posts_per_page' => 4,
                    'post_status'    => 'publish',
                    'orderby'        => 'rand',
                    'paged' => $paged,
                );
                $productLoop = new WP_Query($args);
                if ($productLoop->have_posts()):
                    while ($productLoop->have_posts()): $productLoop->the_post();
                        $img_url = get_the_post_thumbnail_url(get_the_ID(), 'medium');
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
                        }
                        // Set up data to pass to the template
                        $data = array(
                            'img_url'       => $img_url,     // Image URL
                            'title'         => $title,       // Product title
                            'price'         => $price,       // Product price
                            'product_url'   => $product_url,
                            'product'       => $product,
                            'product_id'    => $product_id,
                            'video_iframe'  => $video_iframe
                        );
                        // Load the template
                        ob_start();
                        ?>
                        <div class="col-xl-3 col-lg-4 col-md-6 product_column">
                            <?php echo wc_get_template('template/product_content.php', $data);?>
                        </div>
                        <?php
                        $content = ob_get_clean();
                        // Output the content
                        echo $content;
                    endwhile; 
                endif; 
                wp_reset_postdata();
                ?>
            </div>
        </div>
    </div>
</section>