<?php
if (class_exists('WooCommerce')) :
    global $product;

    if (is_a($product, 'WC_Product')) {
        $related_products_ids = wc_get_related_products($product->get_id(), 4); // Fetch 4 related products

        if ($related_products_ids) { ?>
            <section class="related_products">
                <div class="wrapper">
                    <div class="container-fluid">
                        <?php woocommerce_product_loop_start(); 
                        $heading = apply_filters('woocommerce_product_related_products_heading', __('Other Products', 'woocommerce'));

                        if ($heading) :
                        ?>
                            <h2 class="text-center"><?php echo esc_html($heading); ?></h2>
                        <?php endif; ?>
                        <?php foreach ($related_products_ids as $related_product_id) :
                            $related_product = wc_get_product($related_product_id);

                            // Ensure the product is valid and visible
                            if (! $related_product || ! $related_product->is_visible()) {
                                continue;
                            }

                            $img_url = get_the_post_thumbnail_url($related_product_id, 'medium');
                            $title = get_the_title($related_product_id);
                            $product_url = get_permalink($related_product_id);
                            $price = $related_product->get_price_html();
                            $video_iframe = get_field('video_iframe', $related_product_id);

                            $data = array(
                                'img_url' => $img_url, // Image URL
                                'title' => $title, // Product title
                                'price' => $price, // Product price
                                'product_url' => $product_url,
                                'product' => $related_product,
                                'product_id' => $related_product_id,
                                'video_iframe' => $video_iframe
                            );

                            ob_start();
                        ?>
                            <div class="col-xxl-3 col-xl-4 col-sm-6 product_column">
                                <?php echo wc_get_template('template/product_content.php', $data); ?>
                            </div>
                        <?php
                            $content = ob_get_clean();
                            echo $content;
                        endforeach; ?>
                        <?php woocommerce_product_loop_end(); ?>
                    </div>
                </div>
            </section>
<?php
        }
    }
endif;
