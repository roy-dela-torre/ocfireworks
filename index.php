<?php get_header();
$img = get_stylesheet_directory_uri() . '/assets/img/homepage';
?>
<section class="banner">
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-12">
                    <div class="content">
                        <h1 class="text-white">OC Fireworks: Let the Good Times Explode!</h1>
                        <img loading="lazy" src="<?php echo $img ?>/banner_image.png" alt="OC Fireworks: Let the Good Times Explode" class="w-100 d-block d-lg-none">
                        <p class="text-white">Light up the fun! Shop OC Fireworks for dazzling displays and unforgettable memories.</p>
                        <a href="<?php echo get_home_url(); ?>/shop/" target="_blank" rel="noopener noreferrer" class="shop_now">
                            SHOP NOW
                            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="17" viewBox="0 0 22 17" fill="none">
                                <path d="M20.867 4.21919C20.6743 3.97491 20.4286 3.77761 20.1485 3.6422C19.8684 3.50678 19.5611 3.43679 19.25 3.4375H5.31644L4.79462 1.21756C4.75912 1.06665 4.67366 0.932168 4.5521 0.835946C4.43054 0.739724 4.28003 0.687411 4.125 0.6875H1.375C1.19266 0.6875 1.0178 0.759933 0.888864 0.888864C0.759933 1.0178 0.6875 1.19266 0.6875 1.375C0.6875 1.55734 0.759933 1.7322 0.888864 1.86114C1.0178 1.99007 1.19266 2.0625 1.375 2.0625H3.5805L6.01081 12.3929C5.4808 12.4363 4.98819 12.6832 4.63632 13.0819C4.28445 13.4806 4.10066 14.0001 4.12352 14.5314C4.14637 15.0627 4.37409 15.5645 4.75891 15.9315C5.14372 16.2986 5.65573 16.5023 6.1875 16.5H17.875C18.0573 16.5 18.2322 16.4276 18.3611 16.2986C18.4901 16.1697 18.5625 15.9948 18.5625 15.8125C18.5625 15.6302 18.4901 15.4553 18.3611 15.3264C18.2322 15.1974 18.0573 15.125 17.875 15.125H6.1875C6.00516 15.125 5.8303 15.0526 5.70136 14.9236C5.57243 14.7947 5.5 14.6198 5.5 14.4375C5.5 14.2552 5.57243 14.0803 5.70136 13.9514C5.8303 13.8224 6.00516 13.75 6.1875 13.75H17.7939C18.2591 13.7512 18.7109 13.5946 19.0755 13.3057C19.4402 13.0169 19.6961 12.6129 19.8014 12.1598L21.2582 5.97231C21.3301 5.66956 21.3323 5.35441 21.2645 5.05069C21.1967 4.74698 21.0608 4.46265 20.867 4.21919Z" fill="#BF2126" />
                            </svg>
                        </a>
                    </div>
                </div>
                <div class="col-lg-6 d-none d-lg-block">
                    <div class="image">
                        <img loading="lazy" src="<?php echo $img ?>/banner_image.png" alt="OC Fireworks: Let the Good Times Explode" class="w-100">
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="brands px-0">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <h2 class="text-center">Brand Blast Off</h2>
            <div class="owl-carousel owl-theme p-0" id="brands">
                <?php for ($i = 1; $i <= 10; $i++) { ?>
                    <img src="<?php echo $img; ?>/logo<?php echo $i; ?>.png" alt="logo<?php echo $i; ?>" width="186" height="186">
                <?php } ?>
            </div>
            <a href="<?php echo get_home_url(); ?>/brands/" target="_blank" rel="noopener noreferrer" class="view_all red_button">View All</a>
        </div>
    </div>
</section>

<section class="shop_by_categories">
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <h2 class="text-center text-uppercase text-white">Shop by Categories</h2>
                <?php
                $category_names = array('Events', 'Sky Show', 'Ground Effects', 'Novelties', 'Supplies');
                $categories = array(); // Initialize an array to store categories
                foreach ($category_names as $name) {
                    $category = get_term_by('name', $name, 'category');
                    if ($category) {
                        $categories[] = $category;
                    }
                }
                $counter = 0; // Initialize counter
                foreach ($categories as $category) {
                    $category_slug = $category->slug;
                    $category_image = get_field('category_image', 'category_' . $category->term_id);
                    if (!$category_image) {
                        $category_image = 'path/to/default/image.jpg'; // Replace with your default image path
                    }
                    $col_class = ($counter < 3) ? 'col-lg-4 col-md-6 col-sm-12' : 'col-md-6 col-sm-12';
                ?>
                    <div class="<?php echo $col_class; ?>">
                        <div class="content d-flex align-items-center justify-content-center position-relative">
                            <img loading="lazy" src="<?php echo esc_url($category_image); ?>" alt="<?php echo esc_attr($category->name); ?>">
                            <h3 class="text-center text-white position-absolute"><?php echo esc_html($category->name); ?></h3>
                            <a href="<?php echo esc_url(get_category_link($category->term_id)); ?>" target="_blank" rel="noopener noreferrer" class="stretched-link"></a>
                        </div>
                    </div>
                <?php
                    $counter++; // Increment counter
                }
                ?>
            </div>
        </div>
    </div>
</section>




<section class="featured_product d-none">
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="header d-flex align-sm-items-center justify-content-between">
                    <h2 class="mb-0">Featured Products</h2>
                    <a href="<?php echo get_home_url(); ?>/product-category/featured-products/" target="_blank" rel="noopener noreferrer" class="view_all red_button">View All</a>
                </div>
                <?php
                $args = array(
                    'post_type' => 'product',
                    'posts_per_page' => 6,
                    'post_status' => 'publish',
                    'order' => 'DESC',
                    'tax_query' => array(
                        array(
                            'taxonomy' => 'product_cat',
                            'field' => 'slug',
                            'terms' => 'featured-products',
                        ),
                    ),
                    'meta_query' => array(
                        array(
                            'key' => '_stock_status',
                            'value' => 'instock',
                        ),
                    ),
                );
                $count = 0;
                global $product;
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
                ?>
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
                        ob_start();
                        ?>
                        <div class="col-lg-3 col-md-4 col-sm-6 col-12 product_column <?php echo $count > 3 ? 'd-block d-lg-none' : '' ?>">
                            <?php echo wc_get_template('template/product_content.php', $data); ?>
                        </div>
                <?php
                        $content = ob_get_clean();
                        // Output the content
                        echo $content;
                        $count += 1;
                    endwhile;
                endif;
                wp_reset_postdata(); ?>
            </div>
        </div>
    </div>
</section>


<section class="special_product pt-0 d-none">
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="header d-flex align-sm-items-center justify-content-between">
                    <h2 class="mb-0">Special products</h2>
                    <a href="<?php echo get_home_url(); ?>/product-category/special-products/" target="_blank" rel="noopener noreferrer" class="view_all red_button">View All</a>
                </div>
                <?php
                $args = array(
                    'post_type' => 'product',
                    'posts_per_page' => 6,
                    'post_status' => 'publish',
                    'order' => 'DESC',
                    'tax_query' => array(
                        array(
                            'taxonomy' => 'product_cat',
                            'field' => 'slug',
                            'terms' => 'special-products',
                        ),
                    ),
                    'meta_query' => array(
                        array(
                            'key' => '_stock_status',
                            'value' => 'instock',
                        ),
                    ),
                );
                $count = 0;
                global $product;
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
                ?>
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
                        ob_start();
                        ?>
                        <div class="col-lg-3 col-md-4 col-sm-6 col-12 product_column <?php echo $count > 3 ? 'd-block d-lg-none' : '' ?>">
                            <?php echo wc_get_template('template/product_content.php', $data); ?>
                        </div>
                <?php
                        $content = ob_get_clean();
                        // Output the content
                        echo $content;
                        $count += 1;
                    endwhile;
                endif;
                wp_reset_postdata(); ?>
            </div>
        </div>
    </div>
</section>

<section class="about_us">
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-lg-7 col-md-12">
                    <div class="content">
                        <h2>Lights, Sky & Celebration: About Us</h2>
                        <img loading="lazy" src="<?php echo $img; ?>/Yorem ipsum dolor sit(About Us).jpg" alt="Lights, Sky & Celebration: About Us" class="d-block d-lg-none">
                        <p>OC Fireworks isn't just another fireworks store, we're your one-stop shop for everything fireworks, both online and in-store! Established in Indiana, USA, we've been lighting up celebrations nationwide with our extensive selection of fireworks and related products.</p>
                        <p>Whether you're a seasoned fireworks enthusiast in South Bend, Mishawaka, or Elkhart looking for the latest and greatest, or a casual celebrator browsing online from anywhere in the US, OC Fireworks has you covered. We offer a vast and ever-changing inventory of fireworks, from classic sparklers and fun fountains to awe-inspiring 500-gram cakes.</p>
                        <a href="<?php echo get_home_url(); ?>/about-us/" target="_blank" rel="noopener noreferrer" class="red_button">Learn More</a>
                    </div>
                </div>
                <div class="col-lg-5 d-none d-lg-block">
                    <div class="image d-flex justify-content-end">
                        <img loading="lazy" src="<?php echo  $img; ?>/Yorem ipsum dolor sit(About Us).jpg" alt="Lights, Sky & Celebration: About Us">
                    </div>
                </div>
                <div class="owl-carousel owl-theme" id="about_us">
                    <div class="item d-flex align-items-center justify-content-center">
                        <img loading="lazy" src="<?php echo $img; ?>/Large Selection.png" alt="Large Selection">
                        <h3 class="mb-0 text-uppercase">Large Selection</h3>
                    </div>
                    <div class="item d-flex align-items-center justify-content-center">
                        <img loading="lazy" src="<?php echo $img; ?>/Great Prices.png" alt="Great Prices">
                        <h3 class="mb-0 text-uppercase">Great Prices</h3>
                    </div>
                    <div class="item d-flex align-items-center justify-content-center">
                        <img loading="lazy" src="<?php echo $img; ?>/high quality.png" alt="High quality">
                        <h3 class="mb-0 text-uppercase">High quality</h3>
                    </div>
                    <div class="item d-flex align-items-center justify-content-center">
                        <img loading="lazy" src="<?php echo $img; ?>/Free shipping.png" alt="Free shipping">
                        <h3 class="mb-0 text-uppercase">Free shipping</h3>
                    </div>
                    <div class="item d-flex align-items-center justify-content-center">
                        <img loading="lazy" src="<?php echo $img; ?>/retail.png" alt="Retail">
                        <h3 class="mb-0 text-uppercase">Retail</h3>
                    </div>
                    <div class="item d-flex align-items-center justify-content-center">
                        <img loading="lazy" src="<?php echo $img; ?>/whole sale.png" alt="Whole sale">
                        <h3 class="mb-0 text-uppercase">Whole sale</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="blogs">
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="header d-flex align-sm-items-center justify-content-between">
                    <h2 class="text-white text-uppercase mb-0">Sparking Joy with Fireworks</h2>
                    <a href="<?php echo get_home_url(); ?>/blogs" target="_blank" rel="noopener noreferrer" class="view_all_blogs white_button text-uppercase">View All Blogs</a>
                </div>
                <div class="main_content">
                    <?php
                    global $paged;
                    $curpage = $paged ? $paged : 1;
                    $args = array(
                        'post_type'        => 'post',
                        'posts_per_page'   => 3,
                        'post_status'        => 'publish',
                        'order' => 'ASC',
                        'paged' => $paged,
                    );
                    $large_content = true;
                    $loop = new WP_Query($args);
                    if ($loop->have_posts()):
                        while ($loop->have_posts()) : $loop->the_post();
                            $id = get_the_ID();
                            $date = get_the_date();
                            $title = get_the_title();
                            $description = get_the_excerpt();
                            $link = get_permalink();
                            $img_url = get_the_post_thumbnail_url(get_the_ID(), 'medium');
                            if ($large_content == true): ?>
                                <div class="large_content d-flex flex-column" onclick="window.open('<?php echo $link; ?>', '_blank')">
                                    <div class="blog_image">
                                        <img loading="lazy" src="<?php echo $img_url; ?>" alt="<?php echo $title; ?>">
                                    </div>
                                    <div class="content">
                                        <span class="date"><?php echo $date; ?></span>
                                        <h3><?php echo wp_trim_words($title, 7); ?></h3>
                                        <p><?php echo wp_trim_words($description, 14); ?></p>
                                        <a href="<?php echo $link; ?>" target="_blank" rel="noopener noreferrer" class="read_more">Read More
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                <path d="M16 12.0169C15.9981 12.2799 15.9426 12.5397 15.8369 12.7805C15.7312 13.0212 15.5776 13.2378 15.3854 13.4169L9.69722 18.7469C9.50277 18.9204 9.24835 19.0109 8.98827 18.999C8.7282 18.9871 8.48306 18.8737 8.30519 18.6832C8.12732 18.4927 8.0308 18.24 8.03624 17.9791C8.04167 17.7182 8.14864 17.4698 8.3343 17.2869L13.9626 12.0169L8.3343 6.7469C8.23488 6.6582 8.15418 6.5504 8.09695 6.43C8.03972 6.3096 8.00711 6.1789 8.00104 6.0456C7.99497 5.9123 8.01557 5.7792 8.06161 5.654C8.10766 5.5289 8.17823 5.4142 8.26917 5.3168C8.36011 5.2194 8.46957 5.1412 8.59112 5.0868C8.71266 5.0324 8.84383 5.003 8.97691 5.0002C9.10998 4.9974 9.24226 5.0214 9.36597 5.0706C9.48968 5.1198 9.6023 5.1934 9.69722 5.2869L15.3844 10.6129C15.5772 10.7924 15.7313 11.0095 15.8372 11.251C15.9431 11.4925 15.9985 11.7531 16 12.0169Z" fill="#FF0000" />
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                            <?php else: ?>
                                <div class="small_content d-flex" onclick="window.open('<?php echo $link; ?>', '_blank')">
                                    <div class="blog_image">
                                        <img loading="lazy" src="<?php echo $img_url; ?>" alt="<?php echo $title; ?>">
                                    </div>
                                    <div class="content">
                                        <span class="date"><?php echo $date; ?></span>
                                        <h3><?php echo wp_trim_words($title, 6); ?></h3>
                                        <p><?php echo wp_trim_words($description, 14); ?></p>
                                        <a href="<?php echo $link; ?>" target="_blank" rel="noopener noreferrer" class="read_more">Read More
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                <path d="M16 12.0169C15.9981 12.2799 15.9426 12.5397 15.8369 12.7805C15.7312 13.0212 15.5776 13.2378 15.3854 13.4169L9.69722 18.7469C9.50277 18.9204 9.24835 19.0109 8.98827 18.999C8.7282 18.9871 8.48306 18.8737 8.30519 18.6832C8.12732 18.4927 8.0308 18.24 8.03624 17.9791C8.04167 17.7182 8.14864 17.4698 8.3343 17.2869L13.9626 12.0169L8.3343 6.7469C8.23488 6.6582 8.15418 6.5504 8.09695 6.43C8.03972 6.3096 8.00711 6.1789 8.00104 6.0456C7.99497 5.9123 8.01557 5.7792 8.06161 5.654C8.10766 5.5289 8.17823 5.4142 8.26917 5.3168C8.36011 5.2194 8.46957 5.1412 8.59112 5.0868C8.71266 5.0324 8.84383 5.003 8.97691 5.0002C9.10998 4.9974 9.24226 5.0214 9.36597 5.0706C9.48968 5.1198 9.6023 5.1934 9.69722 5.2869L15.3844 10.6129C15.5772 10.7924 15.7313 11.0095 15.8372 11.251C15.9431 11.4925 15.9985 11.7531 16 12.0169Z" fill="#FF0000" />
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                            <?php endif; ?>
                            <?php $large_content = false; ?>
                        <?php endwhile; ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="reach_out_to_us">
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="content">
                    <div class="main_content">
                        <img loading="lazy" src="<?php echo $img; ?>/form_image.jpg" alt="Reach Out to Us">
                        <div class="form_content">
                            <h2 class="text-white">Reach Out to Us</h2>
                            <p class="text-white">At OC Fireworks, we're here to help you make your next celebration unforgettable. Whether you have questions about our products, need help planning your fireworks display, or just want to chat about pyrotechnics, we'd love to hear from you!</p>
                            <?php echo do_shortcode('[contact-form-7 id="0405eec" title="Homepage Contact Form"]') ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="testemonial d-none">
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="header">
                    <div class="header_content">
                        <h2 class="text-center">What Our Customers Are Saying About OC Fireworks!</h2>
                        <p class="text-center">Here at OC Fireworks, we're passionate about helping you create unforgettable memories with dazzling fireworks displays. But don't just take our word for it! See what some of our happy customers are saying:</p>
                    </div>
                </div>
                <div class="main_content">
                    <?php
                    $args = array(
                        'status' => 'approve', // Only approved comments
                        'post_type' => 'product', // WooCommerce product reviews
                        'number' => 3, // Get up to three reviews
                        'orderby' => 'meta_value_num',
                        'meta_key' => 'rating', // Order by rating
                        'order' => 'DESC'
                    );

                    $comments = get_comments($args);

                    $count = 0;
                    foreach ($comments as $comment) :
                        $count++;
                        if ($count == 1) :
                    ?>
                            <div class="large_content d-flex align-items-center justify-content-center position-relative flex-column">
                                <div class="review d-flex justify-content-center">
                                    <?php for ($i = 0; $i < intval(get_comment_meta($comment->comment_ID, 'rating', true)); $i++) { ?>
                                        <img loading="lazy" src="<?php echo $img; ?>/star.png" alt="">
                                    <?php } ?>
                                </div>
                                <div class="content">
                                    <p class="text-center"><?php echo esc_html($comment->comment_content); ?></p>
                                    <!-- Add additional content fields here if needed -->
                                </div>
                                <div class="author d-flex align-items-center">
                                    <img loading="lazy" src="<?php echo $img; ?>/author.png" alt="">
                                    <div class="name">
                                        <p class="name"><?php echo esc_html($comment->comment_author); ?></p>
                                        <p class="position"><?php echo get_comment_meta($comment->comment_ID, 'title', true); ?></p>
                                    </div>
                                </div>
                            </div>
                        <?php else : ?>
                            <div class="small_content d-flex flex-column">
                                <div class="review d-flex justify-content-center">
                                    <?php for ($i = 0; $i < intval(get_comment_meta($comment->comment_ID, 'rating', true)); $i++) { ?>
                                        <img loading="lazy" src="<?php echo $img; ?>/star.png" alt="">
                                    <?php } ?>
                                </div>
                                <div class="content">
                                    <p class="text-center"><?php echo esc_html($comment->comment_content); ?></p>
                                    <!-- Add additional content fields here if needed -->
                                </div>
                                <div class="author d-flex align-items-center">
                                    <img loading="lazy" src="<?php echo $img; ?>/author.png" alt="">
                                    <div class="name">
                                        <p class="name"><?php echo esc_html($comment->comment_author); ?></p>
                                        <p class="position"><?php echo get_comment_meta($comment->comment_ID, 'title', true); ?></p>
                                    </div>
                                </div>
                            </div>
                    <?php
                        endif;
                    endforeach;
                    ?>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="testemonial">
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="header">
                    <div class="header_content">
                        <h2 class="text-center">What Our Customers Are Saying About OC Fireworks!</h2>
                        <p class="text-center">Here at OC Fireworks, we're passionate about helping you create unforgettable memories with dazzling fireworks displays. But don't just take our word for it! See what some of our happy customers are saying:</p>
                    </div>
                </div>
                <div class="main_content">
                    <div class="large_content d-flex align-items-center justify-content-center position-relative flex-column">
                        <div class="review d-flex justify-content-center">
                            <?php for ($i = 0; $i < 5; $i++) { ?>
                                <img loading="lazy" src="<?php echo $img; ?>/star.png" alt="">
                            <?php } ?>
                        </div>
                        <div class="content">
                            <p class="text-center">Torem ipsum dolor sit amet, consectetur adipiscing elit. Nunc vulputate libero et velit interdum, ac aliquet odio mattis. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. </p>
                            <p class="text-center">Curabitur tempus urna at turpis condimentum lobortis. Ut commodo efficitur neque. Ut diam quam, semper iaculis condimentum ac, vestibulum eu nisl.</p>
                        </div>
                        <div class="author d-flex align-items-center">
                            <img loading="lazy" src="<?php echo $img; ?>/author.png" alt="">
                            <div class="name">
                                <p class="name">Borem ipsum dolor</p>
                                <p class="position">Borem ipsum dolor</p>
                            </div>
                        </div>
                    </div>
                    <div class="small_content d-flex flex-column">
                        <div class="review d-flex justify-content-center">
                            <?php for ($i = 0; $i < 5; $i++) { ?>
                                <img loading="lazy" src="<?php echo $img; ?>/star.png" alt="">
                            <?php } ?>
                        </div>
                        <div class="content">
                            <p class="text-center">“Torem ipsum dolor sit amet, consectetur adipiscing elit. Nunc vulputate libero et velit interdum, ac aliquet odio mattis. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos.”</p>
                        </div>
                        <div class="author d-flex align-items-center">
                            <img loading="lazy" src="<?php echo $img; ?>/author.png" alt="">
                            <div class="name">
                                <p class="name">Borem ipsum dolor</p>
                                <p class="position">Borem ipsum dolor</p>
                            </div>
                        </div>
                    </div>
                    <div class="small_content d-flex flex-column">
                        <div class="review d-flex justify-content-center">
                            <?php for ($i = 0; $i < 5; $i++) { ?>
                                <img loading="lazy" src="<?php echo $img; ?>/star.png" alt="">
                            <?php } ?>
                        </div>
                        <div class="content">
                            <p class="text-center">“Torem ipsum dolor sit amet, consectetur adipiscing elit. Nunc vulputate libero et velit interdum, ac aliquet odio mattis. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos.”</p>
                        </div>
                        <div class="author d-flex align-items-center">
                            <img loading="lazy" src="<?php echo $img; ?>/author.png" alt="">
                            <div class="name">
                                <p class="name">Borem ipsum dolor</p>
                                <p class="position">Borem ipsum dolor</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<section class="news_letter">
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="new_letter_form_content">
                        <div class="content">
                            <h2 class="text-white">Ignite Your Inbox: Sign Up for the OC Fireworks Newsletter!</h2>
                            <p class="text-white">Want to stay up-to-date on the latest and greatest fireworks deals, safety tips, and festive inspiration? Sign up for the OC Fireworks newsletter and get exclusive content delivered straight to your inbox!</p>
                            <?php echo do_shortcode('[contact-form-7 id="45c6cd8" title="Homepage News Letter"]') ?>
                        </div>
                        <div class="image">
                            <img loading="lazy" src="<?php echo $img; ?>/news_letter.jpg" alt="Ignite Your Inbox: Sign Up for the OC Fireworks Newsletter!">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php get_footer(); ?>