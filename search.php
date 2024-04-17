<?php
get_header();
global $wp_query;
$s = sanitize_text_field($_GET['s']); // Sanitize the search term
$img = get_stylesheet_directory_uri().'/assets/img/homepage';
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
            <div class="row post mb-4">
                <?php
                // Set up the query
                $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
                $args = array(
                    's' => $s,
                    'paged' => $paged,
                    'posts_per_page' => 4,
                    'post_type' => array('post'), // Search for products and posts
                );
                $query = new WP_Query($args);

                // Counter for columns to control layout
                $col_counter = 0;

                // Display the product in the first row
                $product_displayed = false; // To track whether a product has been displayed

                if ($query->have_posts()):

                    // First, loop through the results to display only one product in the first row
                    while ($query->have_posts()): $query->the_post();
                        $searchID = get_the_ID();
                        $post_type = get_post_type(); ?>
                        <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                            <div class="small_content d-flex">
                                <div class="blog_image">
                                    <img src="<?php echo get_the_post_thumbnail_url($searchID); ?>" alt="" class="w-100">
                                </div>
                                <div class="content">
                                    <span class="date"><?php echo get_the_date(); ?></span>
                                    <h3><?php echo esc_html(get_the_title()); ?></h3>
                                    <p><?php echo wp_trim_words(get_the_excerpt(), 20, '...'); ?></p>
                                    <a href="<?php echo esc_url(get_permalink()); ?>" target="_blank" rel="noopener noreferrer" class="read_more">Read More
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                            <path d="M16 12.0169C15.9981 12.2799 15.9426 12.5397 15.8369 12.7805C15.7312 13.0212 15.5776 13.2378 15.3854 13.4169L9.69722 18.7469C9.50277 18.9204 9.24835 19.0109 8.98827 18.999C8.7282 18.9871 8.48306 18.8737 8.30519 18.6832C8.12732 18.4927 8.0308 18.24 8.03624 17.9791C8.04167 17.7182 8.14864 17.4698 8.3343 17.2869L13.9626 12.0169L8.3343 6.7469C8.23488 6.6582 8.15418 6.5504 8.09695 6.43C8.03972 6.3096 8.00711 6.1789 8.00104 6.0456C7.99497 5.9123 8.01557 5.7792 8.06161 5.654C8.10766 5.5289 8.17823 5.4142 8.26917 5.3168C8.36011 5.2194 8.46957 5.1412 8.59112 5.0868C8.71266 5.0324 8.84383 5.003 8.97691 5.0002C9.10998 4.9974 9.24226 5.0214 9.36597 5.0706C9.48968 5.1198 9.6023 5.1934 9.69722 5.2869L15.3844 10.6129C15.5772 10.7924 15.7313 11.0095 15.8372 11.251C15.9431 11.4925 15.9985 11.7531 16 12.0169Z" fill="#FF0000"></path>
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                   <?php  endwhile;
                    
                    // Reset query to restart from the beginning
                    wp_reset_postdata(); ?>
                    <?php
                    wp_reset_postdata();
                endif;
                ?>
            </div>
            <div class="row product">
                <?php
                // Set up the query
                $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
                $args = array(
                    's' => $s,
                    'paged' => $paged,
                    'posts_per_page' => 4,
                    'post_type' => array('product'), // Search for products and posts
                );
                $query = new WP_Query($args);

                // Counter for columns to control layout
                $col_counter = 0;

                // Display the product in the first row
                $product_displayed = false; // To track whether a product has been displayed

                if ($query->have_posts()):

                    // First, loop through the results to display only one product in the first row
                    while ($query->have_posts()): $query->the_post();
                        $searchID = get_the_ID();
                        $post_type = get_post_type(); 
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
                        } 
                        ?>
                        <div class="col-lg-3 col-md-4 col-sm-6 col-12 product_column">
                            <div class="product_content">
                                <div class="product_image position-relative">
                                    <?php
                                    $image_id = get_post_thumbnail_id($searchID);
                                    if ($image_id) {
                                        $image_url = get_the_post_thumbnail_url($searchID);
                                        ?>
                                        <img src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr(the_title_attribute('echo=0')); ?>" class="img-fluid">
                                        <?php
                                    } else {
                                        // Display a placeholder image if no featured image is available
                                        ?>
                                        <img src="<?php echo get_home_url(); ?>/wp-content/uploads/woocommerce-placeholder.png" alt="Placeholder Image" class="img-fluid">
                                        <?php
                                    }
                                    ?>
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
                   <?php  endwhile;
                    
                    // Reset query to restart from the beginning
                    wp_reset_postdata(); ?>
                    
               
                    <div class="paging d-flex justify-content-center align-items-center">
                        <?php
                        $totalPages = $query->max_num_pages;
                        echo paginate_links(array(
                            'total' => $totalPages,
                            'mid_size' => 2
                        ));
                        ?>
                    </div>
                    <?php
                    wp_reset_postdata();
                endif;
                ?>
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
                    </div>
                </div>
                <div class="group_button">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">Browse product</button>
                    <a href="/wishlist/" class="view_wishlist">View wish List</a>
                </div>
            </div>
        </div>
    </div>
</div>
<?php get_footer(); ?>
<script>
    function setEqualHeightForSection(sectionSelector, secondSelector) {
        var elementsToResize = $(sectionSelector).find(secondSelector);
        var tallestHeight = 0;
        elementsToResize.each(function () {
            var height = $(this).height();
            if (height > tallestHeight) {
                tallestHeight = height;
            }
        });
        elementsToResize.css('height', tallestHeight);
    }
    $(document).ready(function(){
        var next = $('<img>', {
            src: '<?php echo get_stylesheet_directory_uri();?>/assets/img/search/next.png', // Replace with the actual image URL
            alt: 'Next Image' // Add an alt attribute for accessibility
        });
        $('a.next.page-numbers').html(next);
        var prev = $('<img>', {
            src: '<?php echo get_stylesheet_directory_uri();?>/assets/img/search/prev.png', // Replace with the actual image URL
            alt: 'Next Image' // Add an alt attribute for accessibility
        });
        $('a.prev.page-numbers').html(prev);
        $('.yith-wcwl-wishlistexistsbrowse').hide()
        $('i.yith-wcwl-icon.fa.fa-heart-o').html(`<img src="<?php echo $img; ?>/add_to_wishlist.png" alt="">`)

        $('section.searchResults .row.product .product_column').each(function() {
            $(this).find('.yith-wcwl-add-button img').on('click', function() {
                $('.wishlist_modal_btn').trigger('click');
                var contentContainer = $(this).closest('.product_content');
                var productName = contentContainer.find('h3.text-center').text();
                var productPrice = contentContainer.find('.price').text();
                var productImage = contentContainer.find('.product_image img').attr('src');
                console.log('Product Name:', productName);
                console.log('Product Price:', productPrice);
                console.log('Product Image:', productImage);
                $('.product_added_to_wislist img').attr('src', productImage);
                $('.product_added_to_wislist p.product_name').text(productName);
                $('.product_added_to_wislist p.price').text(productPrice);
            });
        });

    })
</script>
