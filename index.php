<?php get_header();
$img = get_stylesheet_directory_uri().'/assets/img/homepage';
?>
<section class="banner">
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-12">
                    <div class="content">
                        <h1 class="text-white">OC Fireworks:</h1>
                        <img src="<?php echo $img?>/banner_image.png" alt="" class="w-100 d-block d-lg-none">
                        <p class="text-white">Let the Good Times Explode! Light up the fun! Shop OC Fireworks for dazzling displays and unforgettable memories.</p>
                        <a href="<?php echo get_home_url(); ?>/shop/" target="_blank" rel="noopener noreferrer" class="shop_now">
                            SHOP NOW
                            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="17" viewBox="0 0 22 17" fill="none">
                                <path d="M20.867 4.21919C20.6743 3.97491 20.4286 3.77761 20.1485 3.6422C19.8684 3.50678 19.5611 3.43679 19.25 3.4375H5.31644L4.79462 1.21756C4.75912 1.06665 4.67366 0.932168 4.5521 0.835946C4.43054 0.739724 4.28003 0.687411 4.125 0.6875H1.375C1.19266 0.6875 1.0178 0.759933 0.888864 0.888864C0.759933 1.0178 0.6875 1.19266 0.6875 1.375C0.6875 1.55734 0.759933 1.7322 0.888864 1.86114C1.0178 1.99007 1.19266 2.0625 1.375 2.0625H3.5805L6.01081 12.3929C5.4808 12.4363 4.98819 12.6832 4.63632 13.0819C4.28445 13.4806 4.10066 14.0001 4.12352 14.5314C4.14637 15.0627 4.37409 15.5645 4.75891 15.9315C5.14372 16.2986 5.65573 16.5023 6.1875 16.5H17.875C18.0573 16.5 18.2322 16.4276 18.3611 16.2986C18.4901 16.1697 18.5625 15.9948 18.5625 15.8125C18.5625 15.6302 18.4901 15.4553 18.3611 15.3264C18.2322 15.1974 18.0573 15.125 17.875 15.125H6.1875C6.00516 15.125 5.8303 15.0526 5.70136 14.9236C5.57243 14.7947 5.5 14.6198 5.5 14.4375C5.5 14.2552 5.57243 14.0803 5.70136 13.9514C5.8303 13.8224 6.00516 13.75 6.1875 13.75H17.7939C18.2591 13.7512 18.7109 13.5946 19.0755 13.3057C19.4402 13.0169 19.6961 12.6129 19.8014 12.1598L21.2582 5.97231C21.3301 5.66956 21.3323 5.35441 21.2645 5.05069C21.1967 4.74698 21.0608 4.46265 20.867 4.21919Z" fill="#BF2126"/>
                            </svg>
                        </a>
                    </div>
                </div>
                <div class="col-lg-6 d-none d-lg-block">
                    <div class="image">
                        <img src="<?php echo $img?>/banner_image.png" alt="" class="w-100">
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="brands">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <h2 class="text-center">Brand Blast Off</h2>
            <div class="owl-carousel owl-theme p-0" id="brands">
                <?php for($i=1;$i<=10;$i++){ ?>
                    <img src="<?php echo $img; ?>/logo<?php echo $i; ?>.png" alt="" width="186" height="186">
                <?php }?>
            </div>
            <a href="http://" target="_blank" rel="noopener noreferrer" class="view_all red_button">View All</a>
        </div>
    </div>
</section>

<section class="shop_by_categories">
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <h2 class="text-center text-uppercase text-white">Shop by Categories</h2>
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="content d-flex align-items-center justify-content-center position-relative">
                        <img src="<?php echo $img; ?>/Events.jpg" alt="Events">
                        <h3 class="text-center text-white position-absolute">Events</h3>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="content d-flex align-items-center justify-content-center position-relative">
                        <img src="<?php echo $img; ?>/Sky Show.jpg" alt="Sky Show">
                        <h3 class="text-center text-white position-absolute">Sky Show</h3>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="content d-flex align-items-center justify-content-center position-relative">
                        <img src="<?php echo $img; ?>/Ground Effects.jpg" alt="Ground Effects">
                        <h3 class="text-center text-white position-absolute">Ground Effects</h3>
                    </div>
                </div>
                <div class="col-md-6 col-sm-12">
                    <div class="content d-flex align-items-center justify-content-center position-relative">
                        <img src="<?php echo $img; ?>/Novelties.jpg" alt="Novelties">
                        <h3 class="text-center text-white position-absolute">Novelties</h3>
                    </div>
                </div>
                <div class="col-md-6 col-sm-12">
                    <div class="content d-flex align-items-center justify-content-center position-relative">
                        <img src="<?php echo $img; ?>/Supplies.jpg" alt="Supplies">
                        <h3 class="text-center text-white position-absolute">Supplies</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="featured_product">
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="header d-flex align-items-center justify-content-between">
                    <h2>Featured Products</h2>
                    <a href="<?php echo get_home_url(); ?>/product-category/featured-products/" target="_blank" rel="noopener noreferrer" class="view_all red_button">View All</a>
                </div>
                <?php
                $args = array(
                    'post_type' => 'product',
                    'posts_per_page' => 4,
                    'post_status' => 'publish',
                    'order' => 'DESC',
                    'tax_query' => array(
                        array(
                            'taxonomy' => 'product_cat',
                            'field' => 'slug',
                            'terms' => 'featured-products',
                        ),
                    ),
                );
                
                global $product;
                $productLoop = new WP_Query($args);
                if ($productLoop->have_posts()):
                    while ($productLoop->have_posts()): $productLoop->the_post();
                        $featured_image_url = get_the_post_thumbnail_url(get_the_ID(), 'large');
                        $product = wc_get_product(get_the_ID());
                        $product_id = get_the_ID();
                        $video_iframe = get_field('video_iframe', $product_id);
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
                    <div class="col-lg-3 col-md-4 col-sm-6 col-12 product_column">
                        <div class="product_content">
                            <?php if(!empty($video_iframe)):?>
                                <div class="iframe d-none">
                                    <?php echo $video_iframe; ?>
                                </div>
                            <?php endif; ?>
                            <div class="product_image position-relative">
                                <img loading="lazy" src="<?php echo $featured_image_url; ?>" alt="<?php echo get_the_title(); ?>" class="cards">
                                <div class="absolute_button position-absolute <?php echo $product->is_on_sale() ? "" : "justify-content-end" ?>">
                                    <?php if ($product->is_on_sale()): ?>
                                        <span class="sale">Sale</span>
                                    <?php endif; ?>
                                    <?php echo do_shortcode('[yith_wcwl_add_to_wishlist]') ?>
                                </div>
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
                                <h3 class="text-center product_title"><?php echo esc_html(get_the_title()); ?></h3>
                                <div class="product_reviews d-flex align-items-center justify-content-center">
                                    <?php 
                                    $total_reviews = $product->get_review_count();
                                    for ($i = 1; $i <= 5; $i++): ?>
                                        <?php if ($i <= $total_reviews): ?>
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
                                        <span><?php echo number_format($total_reviews, 1); ?></span>
                                    </div>
                                </div>
                                <p class="price"><?php echo $price; ?></p>
                            </div>
                            <div class="add_to_cart">
                                <?php echo do_shortcode('[add_to_cart id="' . $product->get_id() . '"]'); ?>
                            </div>
                        </div>
                    </div>
                <?php endwhile; endif; wp_reset_postdata(); ?>
            </div>
        </div>
    </div>
</section>


<section class="special_product pt-0">
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="header d-flex align-items-center justify-content-between">
                    <h2>Special products</h2>
                    <a href="<?php echo get_home_url(); ?>/product-category/special-products/" target="_blank" rel="noopener noreferrer" class="view_all red_button">View All</a>
                </div>
                <?php
                $args = array(
                    'post_type' => 'product',
                    'posts_per_page' => 4,
                    'post_status' => 'publish',
                    'order' => 'DESC',
                    'tax_query' => array(
                        array(
                            'taxonomy' => 'product_cat',
                            'field' => 'slug',
                            'terms' => 'special-products',
                        ),
                    ),
                );
                
                global $product;
                $productLoop = new WP_Query($args);
                if ($productLoop->have_posts()):
                    while ($productLoop->have_posts()): $productLoop->the_post();
                        $featured_image_url = get_the_post_thumbnail_url(get_the_ID(), 'large');
                        $product = wc_get_product(get_the_ID());
                        $product_id = get_the_ID();
                        $video_iframe = get_field('video_iframe', $product_id);
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
                    <div class="col-lg-3 col-md-4 col-sm-6 col-12 product_column">
                        <div class="product_content">
                            <?php if(!empty($video_iframe)):?>
                                <div class="iframe d-none">
                                    <?php echo $video_iframe; ?>
                                </div>
                            <?php endif; ?>
                            <div class="product_image position-relative">
                                <img loading="lazy" src="<?php echo $featured_image_url; ?>" alt="<?php echo get_the_title(); ?>" class="cards">
                                <div class="absolute_button position-absolute <?php echo $product->is_on_sale() ? "" : "justify-content-end" ?>">
                                    <?php if ($product->is_on_sale()): ?>
                                        <span class="sale">Sale</span>
                                    <?php endif; ?>
                                    <?php echo do_shortcode('[yith_wcwl_add_to_wishlist]') ?>
                                </div>
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
                                <h3 class="text-center product_title"><?php echo esc_html(get_the_title()); ?></h3>
                                <div class="product_reviews d-flex align-items-center justify-content-center">
                                    <?php 
                                    $total_reviews = $product->get_review_count();
                                    for ($i = 1; $i <= 5; $i++): ?>
                                        <?php if ($i <= $total_reviews): ?>
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
                                        <span><?php echo number_format($total_reviews, 1); ?></span>
                                    </div>
                                </div>
                                <p class="price"><?php echo $price; ?></p>
                            </div>
                            <div class="add_to_cart">
                                <?php echo do_shortcode('[add_to_cart id="' . $product->get_id() . '"]'); ?>
                            </div>
                        </div>
                    </div>
                <?php endwhile; endif; wp_reset_postdata(); ?>
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
                        <img src="<?php echo $img; ?>/Yorem ipsum dolor sit(About Us).jpg" alt="Lights, Sky & Celebration: About Us" class="d-block d-lg-none">
                        <p>OC Fireworks isn't just another fireworks store, we're your one-stop shop for everything fireworks, both online and in-store! Established in Indiana, USA, we've been lighting up celebrations nationwide with our extensive selection of fireworks and related products.</p>
                        <p>Whether you're a seasoned fireworks enthusiast in South Bend, Mishawaka, or Elkhart looking for the latest and greatest, or a casual celebrator browsing online from anywhere in the US, OC Fireworks has you covered. We offer a vast and ever-changing inventory of fireworks, from classic sparklers and fun fountains to awe-inspiring 500 gram cakes.</p>
                    </div>
                </div>
                <div class="col-lg-5 d-none d-lg-block">
                    <div class="image d-flex justify-content-end">
                        <img src="<?php echo  $img; ?>/Yorem ipsum dolor sit(About Us).jpg" alt="Lights, Sky & Celebration: About Us">
                    </div>
                </div>
                <div class="owl-carousel owl-theme" id="about_us">
                    <div class="item d-flex align-items-center">
                        <img src="<?php echo $img; ?>/Large Selection.png" alt=""><span>Large Selection</span>
                    </div>
                    <div class="item d-flex align-items-center">
                        <img src="<?php echo $img; ?>/Great Prices.png" alt=""><span>Great Prices</span>
                    </div>
                    <div class="item d-flex align-items-center">
                        <img src="<?php echo $img; ?>/high quality.png" alt=""><span>high quality</span>
                    </div>
                    <div class="item d-flex align-items-center">
                        <img src="<?php echo $img; ?>/Large Selection.png" alt=""><span>Large Selection</span>
                    </div>
                    <div class="item d-flex align-items-center">
                        <img src="<?php echo $img; ?>/Great Prices.png" alt=""><span>Great Prices</span>
                    </div>
                    <div class="item d-flex align-items-center">
                        <img src="<?php echo $img; ?>/high quality.png" alt=""><span>high quality</span>
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
                <div class="header d-flex align-items-center justify-content-between">
                    <h2 class="text-white text-uppercase">Sparking Joy with Fireworks</h2>
                    <a href="http://" target="_blank" rel="noopener noreferrer" class="view_all_blogs white_button text-uppercase">View All Blogs</a>
                </div>
                <div class="main_content">
                    <?php
                        global $paged;
                        $curpage = $paged ? $paged : 1;
                        $args = array(
                            'post_type'        => 'post',
                            'posts_per_page'   => 3,
                            'post_status' 	   => 'publish',
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
                                if($large_content == true):?>
                                    <div class="large_content d-flex flex-column" onclick="window.open('<?php echo $link; ?>', '_blank')">
                                        <div class="blog_image">
                                            <img src="<?php echo $img; ?>/larg_content.jpg" alt="">
                                        </div>
                                        <div class="content">
                                            <span class="date"><?php echo $date; ?></span>
                                            <h3><?php echo wp_trim_words($title,7);?></h3>
                                            <p><?php echo wp_trim_words($description,14); ?></p>
                                            <a href="<?php echo $link; ?>" target="_blank" rel="noopener noreferrer" class="read_more">Read More
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                    <path d="M16 12.0169C15.9981 12.2799 15.9426 12.5397 15.8369 12.7805C15.7312 13.0212 15.5776 13.2378 15.3854 13.4169L9.69722 18.7469C9.50277 18.9204 9.24835 19.0109 8.98827 18.999C8.7282 18.9871 8.48306 18.8737 8.30519 18.6832C8.12732 18.4927 8.0308 18.24 8.03624 17.9791C8.04167 17.7182 8.14864 17.4698 8.3343 17.2869L13.9626 12.0169L8.3343 6.7469C8.23488 6.6582 8.15418 6.5504 8.09695 6.43C8.03972 6.3096 8.00711 6.1789 8.00104 6.0456C7.99497 5.9123 8.01557 5.7792 8.06161 5.654C8.10766 5.5289 8.17823 5.4142 8.26917 5.3168C8.36011 5.2194 8.46957 5.1412 8.59112 5.0868C8.71266 5.0324 8.84383 5.003 8.97691 5.0002C9.10998 4.9974 9.24226 5.0214 9.36597 5.0706C9.48968 5.1198 9.6023 5.1934 9.69722 5.2869L15.3844 10.6129C15.5772 10.7924 15.7313 11.0095 15.8372 11.251C15.9431 11.4925 15.9985 11.7531 16 12.0169Z" fill="#FF0000"/>
                                                </svg>
                                            </a>
                                        </div>
                                    </div>
                                <?php else: ?>
                                    <div class="small_content d-flex" onclick="window.open('<?php echo $link; ?>', '_blank')">
                                        <div class="blog_image">
                                            <img src="<?php echo $img; ?>/small_content.jpg" alt="">
                                        </div>
                                        <div class="content">
                                            <span class="date"><?php echo $date; ?></span>
                                            <h3><?php echo wp_trim_words($title,6);?></h3>
                                            <p><?php echo wp_trim_words($description,14); ?></p>
                                            <a href="<?php echo $link; ?>" target="_blank" rel="noopener noreferrer" class="read_more">Read More
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                    <path d="M16 12.0169C15.9981 12.2799 15.9426 12.5397 15.8369 12.7805C15.7312 13.0212 15.5776 13.2378 15.3854 13.4169L9.69722 18.7469C9.50277 18.9204 9.24835 19.0109 8.98827 18.999C8.7282 18.9871 8.48306 18.8737 8.30519 18.6832C8.12732 18.4927 8.0308 18.24 8.03624 17.9791C8.04167 17.7182 8.14864 17.4698 8.3343 17.2869L13.9626 12.0169L8.3343 6.7469C8.23488 6.6582 8.15418 6.5504 8.09695 6.43C8.03972 6.3096 8.00711 6.1789 8.00104 6.0456C7.99497 5.9123 8.01557 5.7792 8.06161 5.654C8.10766 5.5289 8.17823 5.4142 8.26917 5.3168C8.36011 5.2194 8.46957 5.1412 8.59112 5.0868C8.71266 5.0324 8.84383 5.003 8.97691 5.0002C9.10998 4.9974 9.24226 5.0214 9.36597 5.0706C9.48968 5.1198 9.6023 5.1934 9.69722 5.2869L15.3844 10.6129C15.5772 10.7924 15.7313 11.0095 15.8372 11.251C15.9431 11.4925 15.9985 11.7531 16 12.0169Z" fill="#FF0000"/>
                                                </svg>
                                            </a>
                                        </div>
                                    </div>
                                <?php endif;?>
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
                        <img src="<?php echo $img; ?>/form_image.jpg" alt="">
                        <div class="form_content">
                            <h2 class="text-white">Reach Out to Us</h2>
                            <p class="text-white">At OC Fireworks, we're here to help you make your next celebration unforgettable.  Whether you have questions about our products, need help planning your fireworks display, or just want to chat about pyrotechnics, we'd love to hear from you!</p>
                            <?php echo do_shortcode('[contact-form-7 id="0405eec" title="Homepage Contact Form"]')?>
                        </div>
                    </div>
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
                            <?php for($i = 0; $i < 5; $i++) { ?>
                                <img src="<?php echo $img; ?>/star.png" alt="">
                            <?php } ?>
                        </div>
                        <div class="content">
                            <p class="text-center">Torem ipsum dolor sit amet, consectetur adipiscing elit. Nunc vulputate libero et velit interdum, ac aliquet odio mattis. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. </p>
                            <p class="text-center">Curabitur tempus urna at turpis condimentum lobortis. Ut commodo efficitur neque. Ut diam quam, semper iaculis condimentum ac, vestibulum eu nisl.</p>
                        </div>
                        <div class="author d-flex align-items-center">
                            <img src="<?php echo $img; ?>/author.png" alt="">
                            <div class="name">
                                <p class="name">Borem ipsum dolor</p>
                                <p class="position">Borem ipsum dolor</p>
                            </div>
                        </div>
                    </div>
                    <div class="small_content d-flex flex-column">
                        <div class="review d-flex justify-content-center">
                            <?php for($i = 0; $i < 5; $i++) { ?>
                                <img src="<?php echo $img; ?>/star.png" alt="">
                            <?php } ?>
                        </div>
                        <div class="content">
                            <p class="text-center">“Torem ipsum dolor sit amet, consectetur adipiscing elit. Nunc vulputate libero et velit interdum, ac aliquet odio mattis. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos.”</p>
                        </div>
                        <div class="author d-flex align-items-center">
                            <img src="<?php echo $img; ?>/author.png" alt="">
                            <div class="name">
                                <p class="name">Borem ipsum dolor</p>
                                <p class="position">Borem ipsum dolor</p>
                            </div>
                        </div>
                    </div>
                    <div class="small_content d-flex flex-column">
                        <div class="review d-flex justify-content-center">
                            <?php for($i = 0; $i < 5; $i++) { ?>
                                <img src="<?php echo $img; ?>/star.png" alt="">
                            <?php } ?>
                        </div>
                        <div class="content">
                            <p class="text-center">“Torem ipsum dolor sit amet, consectetur adipiscing elit. Nunc vulputate libero et velit interdum, ac aliquet odio mattis. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos.”</p>
                        </div>
                        <div class="author d-flex align-items-center">
                            <img src="<?php echo $img; ?>/author.png" alt="">
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
                            <?php echo do_shortcode('[contact-form-7 id="45c6cd8" title="Homepage News Letter"]')?>
                        </div>
                        <div class="image">
                            <img src="<?php echo $img; ?>/news_letter.jpg" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php echo get_template_part('wishlist_pop_up'); ?>
<?php echo get_template_part('video_pop_up'); ?>
<?php get_footer();?>
<script>
    $(document).ready(function () {
        var iframeHTML;
        function replaceThumbnailWithIframe() {
            if (typeof iframeHTML !== 'undefined') {
                $('.modal-body .video_thumbnail').replaceWith(`<iframe width="560" height="315" src="${iframeHTML}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>`);
            } else {
                console.error('iframeHTML is not defined');
            }
        }
        $('section.special_product .product_column .play, section.featured_product .product_column .play').click(function() {
            iframeHTML = $(this).closest('.product_column').find('.iframe').html();
            console.log(iframeHTML)
            var title = $(this).closest('.product_column').find('h3.product_title').text();
            $('#video_modal #video_modalLabel').text(title);
            $('.video_modal').click();
        });
        $('img.play_button').click(replaceThumbnailWithIframe);
        $('img.play_button').click(function(){
            $(this).hide()
        })

        $('div#video_modal button.btn.btn-secondary').click(function(){
            $('.modal-body iframe').replaceWith(`<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/global/video_thumbnail.jpg" alt="" class="video_thumbnail">`);
            $('img.play_button').show()
        })
    });
</script>