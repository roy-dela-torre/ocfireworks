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
            <div class="row product mb-4">
                <?php
                // Set up the query
                $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
                $args = array(
                    's' => $s,
                    'paged' => $paged,
                    'posts_per_page' => 4,
                    'post_type' => array('product'), // Search for products and posts
                );
                $search_query = new WP_Query($args);

                // Counter for columns to control layout
                $col_counter = 0;

                // Display the product in the first row
                $product_displayed = false; // To track whether a product has been displayed

                if ($search_query->have_posts()):

                    // First, loop through the results to display only one product in the first row
                    while ($search_query->have_posts()): $search_query->the_post();
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
                                    <div class="group_button_on_hover">
                                        <div class="view d-flex flex-column align-items-center position-relative">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="51" height="50" viewBox="0 0 51 50" fill="none">
                                                <path d="M25.5 31.25C28.9518 31.25 31.75 28.4518 31.75 25C31.75 21.5482 28.9518 18.75 25.5 18.75C22.0482 18.75 19.25 21.5482 19.25 25C19.25 28.4518 22.0482 31.25 25.5 31.25Z" fill="white"/>
                                                <path d="M48.8436 24.4688C47.0058 19.7151 43.8154 15.6041 39.6667 12.6439C35.518 9.68368 30.5928 8.00402 25.4998 7.8125C20.4069 8.00402 15.4817 9.68368 11.333 12.6439C7.18422 15.6041 3.99382 19.7151 2.15607 24.4688C2.03196 24.812 2.03196 25.188 2.15607 25.5312C3.99382 30.2849 7.18422 34.3959 11.333 37.3561C15.4817 40.3163 20.4069 41.996 25.4998 42.1875C30.5928 41.996 35.518 40.3163 39.6667 37.3561C43.8154 34.3959 47.0058 30.2849 48.8436 25.5312C48.9677 25.188 48.9677 24.812 48.8436 24.4688ZM25.4998 35.1562C23.4911 35.1562 21.5275 34.5606 19.8573 33.4446C18.1871 32.3286 16.8854 30.7424 16.1167 28.8866C15.348 27.0308 15.1468 24.9887 15.5387 23.0186C15.9306 21.0485 16.8979 19.2388 18.3183 17.8184C19.7386 16.3981 21.5483 15.4308 23.5184 15.0389C25.4886 14.647 27.5306 14.8481 29.3865 15.6168C31.2423 16.3856 32.8285 17.6873 33.9444 19.3575C35.0604 21.0277 35.6561 22.9913 35.6561 25C35.6519 27.6923 34.5806 30.2732 32.6768 32.177C30.773 34.0808 28.1922 35.1521 25.4998 35.1562Z" fill="white"/>
                                            </svg>
                                            <a href="<?php echo esc_url(get_permalink()); ?>" target="_blank" rel="noopener noreferrer" class="stretched-link view">View</a>
                                        </div>
                                        <div class="play d-flex flex-column align-items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="51" height="50" viewBox="0 0 51 50" fill="none">
                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M14.7318 8C14.0128 7.99929 13.3056 8.18176 12.6767 8.53019C12.0318 8.85891 11.4885 9.35694 11.105 9.9709C10.7216 10.5849 10.5124 11.2916 10.5 12.0153V37.9825C10.5124 38.7062 10.7216 39.413 11.105 40.0269C11.4885 40.6409 12.0318 41.1389 12.6767 41.4676C13.317 41.8233 14.0386 42.0066 14.771 41.9998C15.5034 41.993 16.2214 41.7962 16.855 41.4287L37.8437 28.4464C38.4914 28.1199 39.0357 27.62 39.4159 27.0024C39.7962 26.3847 39.9974 25.6736 39.9971 24.9483C39.9969 24.223 39.7952 23.512 39.4145 22.8946C39.0338 22.2772 38.4892 21.7777 37.8412 21.4517L16.8525 8.56667C16.2078 8.19453 15.4762 7.99906 14.7318 8Z" fill="white"/>
                                            </svg>
                                            <span class="play">View</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="product_main_content">
                                    <h3 class="text-center"><?php echo esc_html(get_the_title()); ?></h3>
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
                                    <a href="<?php echo esc_url($product->add_to_cart_url()); ?>" target="_blank" rel="noopener noreferrer">Add to Cart</a>
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
            <div class="row post">
                <?php
                // Set up the query
                $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
                $args = array(
                    's' => $s,
                    'paged' => $paged,
                    'posts_per_page' => 4,
                    'post_type' => array('post'), // Search for products and posts
                );
                $search_query = new WP_Query($args);

                // Counter for columns to control layout
                $col_counter = 0;

                // Display the product in the first row
                $product_displayed = false; // To track whether a product has been displayed

                if ($search_query->have_posts()):

                    // First, loop through the results to display only one product in the first row
                    while ($search_query->have_posts()): $search_query->the_post();
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
                   <?php  endwhile; ?>
                   <div class="paging d-flex justify-content-center align-items-center">
                        <?php
                        $totalPages = $search_query->max_num_pages;
                        echo paginate_links(array(
                            'total' => $totalPages,
                            'mid_size' => 2
                        ));
                        ?>
                    </div>
                    <?php 
                    // Reset query to restart from the beginning
                    wp_reset_postdata(); ?>
                    <?php
                    wp_reset_postdata();
                endif;
                ?>
            </div>
        </div>
    </div>
</section>
<?php include('wishlist_pop_up.php')?>
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
