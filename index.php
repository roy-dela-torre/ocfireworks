<?php get_header();
$img = get_stylesheet_directory_uri().'/assets/img/homepage';
?>
<section class="banner">
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-12">
                    <div class="content">
                        <h1 class="text-white">Yorem ipsum dolor sit amet Lorem isa consectetur </h1>
                        <img src="<?php echo $img?>/banner_image.png" alt="" class="w-100 d-block d-lg-none">
                        <p class="text-white">Borem ipsum dolor sit amet, consectetur adipiscing elit. Nunc vulputate libero et velit interdum, ac aliquet odio mattis. </p>
                        <a href="<?php echo get_home_url(); ?>" target="_blank" rel="noopener noreferrer" class="shop_now">
                            SHOP NOW
                            <img src="<?php echo $img; ?>/cart_red.png" alt="">
                        </a>
                    </div>
                </div>
                <div class="col-lg-6 d-none d-lg-block">
                    <img src="<?php echo $img?>/banner_image.png" alt="" class="w-100">
                </div>
            </div>
        </div>
    </div>
</section>

<section class="brands">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <h2 class="text-center">Yorem ipsum dolor(Brands)</h2>
            <div class="owl-carousel owl-theme p-0" id="brands">
                <?php for($i=1;$i<=10;$i++){ ?>
                    <img src="<?php echo $img; ?>/logo<?php echo $i; ?>.png" alt="">
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
                    <a href="http://" target="_blank" rel="noopener noreferrer" class="view_all red_button">View All</a>
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
                            <div class="product_image position-relative">
                                <img loading="lazy" src="<?php echo $featured_image_url; ?>" alt="<?php echo get_the_title(); ?>" class="cards">
                                <div class="absolute_button position-absolute <?php echo $product->is_on_sale() ? "" : "justify-content-end" ?>">
                                    <?php if ($product->is_on_sale()): ?>
                                        <span class="sale">Sale</span>
                                    <?php endif; ?>
                                    <?php echo do_shortcode('[yith_wcwl_add_to_wishlist]') ?>
                                </div>
                                <a href="<?php echo esc_url(get_permalink()); ?>" target="_blank" rel="noopener noreferrer" class="stretched-link"></a>
                            </div>
                            <div class="product_content">
                                <h3 class="text-center"><?php echo esc_html(get_the_title()); ?></h3>
                                <div class="product_reviews d-flex align-items-center justify-content-center">
                                    <div class="reviews_star">
                                        <img src="<?php echo $img; ?>/star.png" alt="">
                                        <img src="<?php echo $img; ?>/star.png" alt="">
                                        <img src="<?php echo $img; ?>/star.png" alt="">
                                        <img src="<?php echo $img; ?>/star.png" alt="">
                                        <img src="<?php echo $img; ?>/star.png" alt="">
                                    </div>
                                    <div class="review_summary">
                                        <span>0.0</span>
                                    </div>
                                </div>
                                <p class="price"><?php echo $price; ?></p>
                            </div>
                            <div class="add_to_cart">
                                <a href="<?php echo esc_url($product->add_to_cart_url()); ?>" target="_blank" rel="noopener noreferrer">Add to Cart</a>
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
                    <a href="http://" target="_blank" rel="noopener noreferrer" class="view_all red_button">View All</a>
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
                        $counter = 1;
                        $productLoop = new WP_Query($args);
                        if ($productLoop->have_posts()):
                            while ($productLoop->have_posts()) : $productLoop->the_post();
                                $featured_image_url = get_the_post_thumbnail_url(get_the_ID(), 'large');
                                $product = wc_get_product(get_the_ID());
                                $short_description = $product->get_short_description();
                                $product_id = get_the_ID();
                                if ($product) {
                                    if ($product->is_type('variable')) {
                                        $min_variation_price = number_format($product->get_variation_price('min'),2);
                                        $max_variation_price = number_format($product->get_variation_price('max'),2);
                                        $price_range = '₱'.$min_variation_price . ' - ' . '₱'.$max_variation_price;
                                        $price = $price_range;
                                    } 
                                    else {
                                        $price = $product->get_price_html();
                                    }
                                } ?>
                        <div class="col-lg-3 col-md-4 col-sm-6 col-12 product_column">
                            <div class="product_content">
                                <div class="product_image position-relative">
                                    <img loading="lazy" src="<?php echo $featured_image_url; ?>" alt="<?php echo get_the_title(); ?>" class="cards">
                                    <div class="absolute_button position-absolute <?php echo $product->is_on_sale() ? "" : "justify-content-end"?>">
                                        <?php if($product->is_on_sale()):?>
                                            <span class="sale">Sale</span>
                                        <?php endif;?>
                                        <?php echo do_shortcode('[yith_wcwl_add_to_wishlist]')?>
                                    </div>
                                    <a href="<?php echo esc_url(get_permalink()); ?>" target="_blank" rel="noopener noreferrer" class="stretched-link"></a>
                                </div>
                                <div class="product_content">
                                    <h3 class="text-center"><?php echo esc_html(get_the_title()); ?></h3>
                                    <div class="product_reviews d-flex align-items-center justify-content-center">
                                        <div class="reviews_star">
                                            <img src="<?php echo $img; ?>/star.png" alt="">
                                            <img src="<?php echo $img; ?>/star.png" alt="">
                                            <img src="<?php echo $img; ?>/star.png" alt="">
                                            <img src="<?php echo $img; ?>/star.png" alt="">
                                            <img src="<?php echo $img; ?>/star.png" alt="">
                                        </div>
                                        <div class="review_summary">
                                            <span>0.0</span>
                                        </div>
                                    </div>
                                    <p class="price"><?php echo $price; ?></p>
                                </div>
                                <div class="add_to_cart">
                                    <a href="<?php echo esc_url($product->add_to_cart_url()); ?>" target="_blank" rel="noopener noreferrer">Add to Cart</a>
                                </div>
                            </div>
                        </div>
                    <?php $counter +=1; endwhile;
                endif; wp_reset_postdata(); ?>
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
                        <h2>Yorem ipsum dolor sit(About Us)</h2>
                        <img src="<?php echo $img; ?>/Yorem ipsum dolor sit(About Us).jpg" alt="" class="d-block d-lg-none">
                        <p>Borem ipsum dolor sit amet, consectetur adipiscing elit. Nunc vulputate libero et velit interdum, ac aliquet odio mattis. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos.</p>
                        <p>Borem ipsum dolor sit amet, consectetur adipiscing elit. Nunc vulputate libero et velit interdum, ac aliquet odio mattis. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos.</p>
                    </div>
                </div>
                <div class="col-lg-5 d-none d-lg-block">
                    <div class="image d-flex justify-content-end">
                        <img src="<?php echo  $img; ?>/Yorem ipsum dolor sit(About Us).jpg" alt="">
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
                    <h2 class="text-white text-uppercase">Yorem ipsum dolor sit amet(Blogs) </h2>
                    <a href="http://" target="_blank" rel="noopener noreferrer" class="view_all_blogs white_button text-uppercase">View All Blogs</a>
                </div>
                <div class="main_content">
                    <div class="large_content d-flex flex-column">
                        <div class="blog_image">
                            <img src="<?php echo $img; ?>/larg_content.jpg" alt="">
                        </div>
                        <div class="content">
                            <span class="date">February 5, 2024</span>
                            <h3>Borem ipsum dolor sit amet, consectetur elitera...</h3>
                            <p>Norem ipsum dolor sit amet, consectetur adipiscing elit. Nunc vulputate libero et velit interdum.</p>
                            <a href="http://" target="_blank" rel="noopener noreferrer" class="read_more">Read More
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                    <path d="M16 12.0169C15.9981 12.2799 15.9426 12.5397 15.8369 12.7805C15.7312 13.0212 15.5776 13.2378 15.3854 13.4169L9.69722 18.7469C9.50277 18.9204 9.24835 19.0109 8.98827 18.999C8.7282 18.9871 8.48306 18.8737 8.30519 18.6832C8.12732 18.4927 8.0308 18.24 8.03624 17.9791C8.04167 17.7182 8.14864 17.4698 8.3343 17.2869L13.9626 12.0169L8.3343 6.7469C8.23488 6.6582 8.15418 6.5504 8.09695 6.43C8.03972 6.3096 8.00711 6.1789 8.00104 6.0456C7.99497 5.9123 8.01557 5.7792 8.06161 5.654C8.10766 5.5289 8.17823 5.4142 8.26917 5.3168C8.36011 5.2194 8.46957 5.1412 8.59112 5.0868C8.71266 5.0324 8.84383 5.003 8.97691 5.0002C9.10998 4.9974 9.24226 5.0214 9.36597 5.0706C9.48968 5.1198 9.6023 5.1934 9.69722 5.2869L15.3844 10.6129C15.5772 10.7924 15.7313 11.0095 15.8372 11.251C15.9431 11.4925 15.9985 11.7531 16 12.0169Z" fill="#FF0000"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                    <div class="small_content d-flex">
                        <div class="blog_image">
                            <img src="<?php echo $img; ?>/small_content.jpg" alt="">
                        </div>
                        <div class="content">
                            <span class="date">February 5, 2024</span>
                            <h3>Borem ipsum dolor sit amet, consectetur...</h3>
                            <p>Norem ipsum dolor sit amet, consectetur adipiscing elit. Nunc vulputate libero et velit interdum.</p>
                            <a href="http://" target="_blank" rel="noopener noreferrer" class="read_more">Read More
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                    <path d="M16 12.0169C15.9981 12.2799 15.9426 12.5397 15.8369 12.7805C15.7312 13.0212 15.5776 13.2378 15.3854 13.4169L9.69722 18.7469C9.50277 18.9204 9.24835 19.0109 8.98827 18.999C8.7282 18.9871 8.48306 18.8737 8.30519 18.6832C8.12732 18.4927 8.0308 18.24 8.03624 17.9791C8.04167 17.7182 8.14864 17.4698 8.3343 17.2869L13.9626 12.0169L8.3343 6.7469C8.23488 6.6582 8.15418 6.5504 8.09695 6.43C8.03972 6.3096 8.00711 6.1789 8.00104 6.0456C7.99497 5.9123 8.01557 5.7792 8.06161 5.654C8.10766 5.5289 8.17823 5.4142 8.26917 5.3168C8.36011 5.2194 8.46957 5.1412 8.59112 5.0868C8.71266 5.0324 8.84383 5.003 8.97691 5.0002C9.10998 4.9974 9.24226 5.0214 9.36597 5.0706C9.48968 5.1198 9.6023 5.1934 9.69722 5.2869L15.3844 10.6129C15.5772 10.7924 15.7313 11.0095 15.8372 11.251C15.9431 11.4925 15.9985 11.7531 16 12.0169Z" fill="#FF0000"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                    <div class="small_content d-flex">
                        <div class="blog_image">
                            <img src="<?php echo $img; ?>/small_content.jpg" alt="">
                        </div>
                        <div class="content">
                            <span class="date">February 5, 2024</span>
                            <h3>Borem ipsum dolor sit amet, consectetur...</h3>
                            <p>Norem ipsum dolor sit amet, consectetur adipiscing elit. Nunc vulputate libero et velit interdum.</p>
                            <a href="http://" target="_blank" rel="noopener noreferrer" class="read_more">Read More
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                    <path d="M16 12.0169C15.9981 12.2799 15.9426 12.5397 15.8369 12.7805C15.7312 13.0212 15.5776 13.2378 15.3854 13.4169L9.69722 18.7469C9.50277 18.9204 9.24835 19.0109 8.98827 18.999C8.7282 18.9871 8.48306 18.8737 8.30519 18.6832C8.12732 18.4927 8.0308 18.24 8.03624 17.9791C8.04167 17.7182 8.14864 17.4698 8.3343 17.2869L13.9626 12.0169L8.3343 6.7469C8.23488 6.6582 8.15418 6.5504 8.09695 6.43C8.03972 6.3096 8.00711 6.1789 8.00104 6.0456C7.99497 5.9123 8.01557 5.7792 8.06161 5.654C8.10766 5.5289 8.17823 5.4142 8.26917 5.3168C8.36011 5.2194 8.46957 5.1412 8.59112 5.0868C8.71266 5.0324 8.84383 5.003 8.97691 5.0002C9.10998 4.9974 9.24226 5.0214 9.36597 5.0706C9.48968 5.1198 9.6023 5.1934 9.69722 5.2869L15.3844 10.6129C15.5772 10.7924 15.7313 11.0095 15.8372 11.251C15.9431 11.4925 15.9985 11.7531 16 12.0169Z" fill="#FF0000"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="form">
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="content">
                    <div class="main_content">
                        <img src="<?php echo $img; ?>/form_image.jpg" alt="">
                        <div class="form_content">
                            <h2 class="text-white">Horem ipsum dolor</h2>
                            <p class="text-white">Gorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc vulputate libero et velit interdum, ac aliquet odio mattis. </p>
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
                        <h2 class="text-center">Borem ipsum dolor sitame(Client testimonials) </h2>
                        <p class="text-center">Porem ipsum dolor sit amet, consectetur adipiscing elit. Nunc vulputate libero et velit interdum, ac aliquet odio mattis. Class aptent taciti sociosqu ad litora torquent per conubia nostra.</p>
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
                            <h2 class="text-white">Rorem ipsum dolor sit amet adipiscing </h2>
                            <p class="text-white">Gorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc vulputate libero et velit interdum, ac aliquet odio mattis. </p>
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

<!-- Wishlist modal -->
<!-- Button trigger modal -->
<button type="button" class="btn btn-primary wishlist_modal_btn d-none" data-bs-toggle="modal" data-bs-target="#exampleModal" style="visibility: hidden;"></button>

<!-- Modal -->
<div class="product_added_to_wislist">
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <h5 class="text-uppercase">Added to wish list:</h5>
                <div class="product">
                    <img src="" alt="">
                    <div class="product_info">
                        <p class="product_name"></p>
                        <p class="price"></p>
                        <a href="/wishlist/" class="view_wishlist">View wish List</a>
                    </div>
                </div>
                <div class="group_button">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">Browse product</button>
                </div>
            </div>
        </div>
    </div>
</div>
<?php get_footer();?>
<script>
$(document).ready(function() {
    $('.yith-wcwl-wishlistexistsbrowse').hide();
    replaceIcons($('i.yith-wcwl-icon.fa.fa-heart-o'), '<?php echo $img; ?>/add_to_wishlist.png');
    replaceIcons($('section.featured_product .yith-wcwl-add-to-wishlist.exists.wishlist-fragment.on-first-load'), '<?php echo $img; ?>/added_to_wishlist.png');
    replaceIcons($('section.special_product .yith-wcwl-add-to-wishlist.exists.wishlist-fragment.on-first-load'), '<?php echo $img; ?>/added_to_wishlist.png');
    handleProductColumns($('section.featured_product .row .product_column'));
    handleProductColumns($('section.special_product .row .product_column'));
    $('button.btn-close').click(function() {
        console.log('click')
        setTimeout(() => {
            $('section.featured_product a[data-title="Browse wishlist"]').html(`<img src="<?php echo $img; ?>/added_to_wishlist.png" alt="">`)
        }, 1000);
    });

});
function replaceIcons(element, imgUrl) {
    console.log('icon replace')
    element.html(`<img src="${imgUrl}" alt="">`);
}
function handleProductColumns(columns) {
    columns.each(function() {
        $(this).find('.yith-wcwl-add-button img').on('click', function() {
            $('.wishlist_modal_btn').trigger('click');
            updateWishlistModal($(this));
        });
    });
}
function updateWishlistModal(button) {
    var contentContainer = button.closest('.product_content');
    var productName = contentContainer.find('h3.text-center').text();
    var productPrice = contentContainer.find('.price').text();
    var productImage = contentContainer.find('.product_image img').attr('src');
    $('.product_added_to_wislist img').attr('src', productImage);
    $('.product_added_to_wislist p.product_name').text(productName);
    $('.product_added_to_wislist p.price').text(productPrice);
}

</script>