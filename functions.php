<?php
if ( ! function_exists( 'ocfireworks' ) ) :
    function ocfireworks() {
        add_theme_support( 'post-thumbnails' );
        add_theme_support( 'post-formats',  array ( 'aside', 'gallery', 'quote', 'image', 'video' ) );
        register_nav_menus( array(
            'primary'   => __( 'Primary Menu', 'ocfireworksNavMenu' )
        ) );
        add_theme_support( 'woocommerce' );
        add_theme_support( 'wc-product-gallery-zoom' ); 
        add_theme_support( 'wc-product-gallery-lightbox' ); 
        add_theme_support( 'wc-product-gallery-slider' );
    }
    endif; 
    add_action( 'after_setup_theme', 'ocfireworks' );
    function get_excerpt($limit, $source = null){
        $excerpt = $source == "content" ? get_the_content() : get_the_excerpt();
        $excerpt = preg_replace(" (\[.*?\])",'',$excerpt);
        $excerpt = strip_shortcodes($excerpt);
        $excerpt = strip_tags($excerpt);
        $excerpt = substr($excerpt, 0, $limit);
        $excerpt = substr($excerpt, 0, strripos($excerpt, " "));
        $excerpt = trim(preg_replace( '/\s+/', ' ', $excerpt));
        return $excerpt;
    }

    function registration_form() {
        ob_start();
        ?>
        <form method="post" class="woocommerce-form woocommerce-form-register register">
            <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                <input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="username" id="reg_username" value="<?php if (!empty($_POST['username'])) echo esc_attr($_POST['username']); ?>" required placeholder="Full Name" />
            </p>
            <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                <input type="email" class="woocommerce-Input woocommerce-Input--text input-text" name="email" id="reg_email" placeholder="Email Address" autocomplete="email" value="<?php if (!empty($_POST['email'])) echo esc_attr($_POST['email']); ?>" required />
            </p>
            <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                <span class="password-input"><input type="password" class="woocommerce-Input woocommerce-Input--text input-text" name="password" id="reg_password" autocomplete="new-password" placeholder="Password" required /><span class="show-password-input"></span></span>
            </p>
            <!-- <div class="woocommerce-privacy-policy-text">
                <p>Your personal data will be used to support your experience throughout this website, to manage access to your account, and for other purposes described in our <a href="<?php echo esc_url(get_privacy_policy_url()); ?>" class="woocommerce-privacy-policy-link" target="_blank">privacy policy</a>.</p>
            </div> -->
            <p class="woocommerce-form-row form-row">
                <?php wp_nonce_field('woocommerce-register', 'woocommerce-register-nonce'); ?>
                <button type="submit" class="woocommerce-Button woocommerce-button button woocommerce-form-register__submit" name="register" value="Register">create an account</button>
            </p>
        </form>
        <?php
        return ob_get_clean();
    }
    
    add_shortcode('registration_form', 'registration_form');


//Log in Form
function custom_login_form_shortcode() {
    if (is_user_logged_in()) {
        // If the user is already logged in, display a message or redirect as needed
        return 'You are already logged in.';
    } else {
        // If the user is not logged in, display the custom login form with placeholders and "Remember Me" checkbox
        ob_start();
        ?>
        <form method="post" class="custom-login-form" action="<?php echo esc_url(site_url('wp-login.php', 'login_post')); ?>">
            <p>
                <input type="text" name="log" id="user_login" placeholder="Email" required />
            </p>
            <p>
                <input type="password" name="pwd" id="user_pass" placeholder="Password" required />
            </p>
            <p>
                <input type="submit" name="wp-submit" id="wp-submit" class="black_button w-100" value="Log In" />
            </p>
           <div class="group">
            <p class="login-remember">
                    <label>
                        <input name="rememberme" type="checkbox" id="rememberme" value="forever" class="">
                        <span>Remember Me</span>
                    </label>
                </p>
                <p class="forgot-password">
                    <a href="<?php echo esc_url(wp_lostpassword_url()); ?>">Forgot Password?</a>
                </p>
           </div>
        </form>
        <?php
        return ob_get_clean();
    }
    }
    add_shortcode('custom_login_form', 'custom_login_form_shortcode');
     


add_filter( 'yith_wcwl_is_wishlist_responsive', '__return_false' );



/* Add Plus and Minus Button for Quantity Input */
add_action('woocommerce_before_quantity_input_field', 'custom_display_quantity_minus');
add_action('woocommerce_after_quantity_input_field', 'custom_display_quantity_plus');

function custom_display_quantity_minus() {
    echo '<button type="button" class="minus">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="21" viewBox="0 0 20 21" fill="none">
            <path d="M15.5 10.4997C15.5 10.7581 15.4305 11.0059 15.3067 11.1886C15.1829 11.3713 15.015 11.474 14.84 11.474H5.16C4.98496 11.474 4.81708 11.3713 4.69331 11.1886C4.56954 11.0059 4.5 10.7581 4.5 10.4997C4.5 10.2413 4.56954 9.99348 4.69331 9.81076C4.81708 9.62804 4.98496 9.52539 5.16 9.52539H14.84C15.015 9.52539 15.1829 9.62804 15.3067 9.81076C15.4305 9.99348 15.5 10.2413 15.5 10.4997Z" fill="white"/>
        </svg>
    </button>';
}

function custom_display_quantity_plus() {
    echo '<button type="button" class="plus">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="21" viewBox="0 0 20 21" fill="none">
            <path d="M14.9993 11.3307H10.8327V15.4974C10.8327 15.7184 10.7449 15.9304 10.5886 16.0866C10.4323 16.2429 10.2204 16.3307 9.99935 16.3307C9.77834 16.3307 9.56637 16.2429 9.41009 16.0866C9.25381 15.9304 9.16602 15.7184 9.16602 15.4974V11.3307H4.99935C4.77834 11.3307 4.56637 11.2429 4.41009 11.0867C4.25381 10.9304 4.16602 10.7184 4.16602 10.4974C4.16602 10.2764 4.25381 10.0644 4.41009 9.90814C4.56637 9.75186 4.77834 9.66406 4.99935 9.66406H9.16602V5.4974C9.16602 5.27638 9.25381 5.06442 9.41009 4.90814C9.56637 4.75186 9.77834 4.66406 9.99935 4.66406C10.2204 4.66406 10.4323 4.75186 10.5886 4.90814C10.7449 5.06442 10.8327 5.27638 10.8327 5.4974V9.66406H14.9993C15.2204 9.66406 15.4323 9.75186 15.5886 9.90814C15.7449 10.0644 15.8327 10.2764 15.8327 10.4974C15.8327 10.7184 15.7449 10.9304 15.5886 11.0867C15.4323 11.2429 15.2204 11.3307 14.9993 11.3307Z" fill="white"/>
        </svg>
    </button>';
}

/* Trigger update quantity script */
add_action('wp_footer', 'custom_add_cart_quantity_plus_minus');

function custom_add_cart_quantity_plus_minus() {
    if (!is_product() && !is_cart()) return;

    wc_enqueue_js("
      jQuery(document).on('click', 'button.plus, button.minus', function() {

         var qty = jQuery(this).parent().find('.qty');
         var val = parseFloat(qty.val());
         var max = parseFloat(qty.attr('max'));
         var min = parseFloat(qty.attr('min'));
         var step = parseFloat(qty.attr('step'));

         if (jQuery(this).is('.plus')) {
            if (max && (max <= val)) {
               qty.val(max).change();
            } else {
               qty.val(val + step).change();
            }
         } else {
            if (min && (min >= val)) {
               qty.val(min).change();
            } else if (val > 1) {
               qty.val(val - step).change();
            }
         }

         // Trigger cart update after changing quantity
         jQuery('[name=\"update_cart\"]').trigger('click');

      });
    ");
}


/* Trigger cart update when quantity changes */
add_action('wp_footer', 'cart_refresh_update_qty');

function cart_refresh_update_qty()
{
    if (is_cart()) {
        ?>
        <script type="text/javascript">
            let timeout;
            jQuery('div.woocommerce').on('change', 'input.qty', function(){
                if (timeout !== undefined) {
                    clearTimeout(timeout);
                }
                timeout = setTimeout(function() {
                    jQuery("[name='update_cart']").trigger("click"); // trigger cart update
                }, 1000 ); // 1 second
            });

            jQuery('div.woocommerce').on('click', 'button.minus, button.plus', function(){
                jQuery("[name='update_cart']").trigger("click");
            });
        </script>
        <?php
    }
}




remove_action('woocommerce_checkout_order_review', 'woocommerce_checkout_payment', 20 );
add_action('woocommerce_checkout_payment_hook', 'woocommerce_checkout_payment', 10 );

// Product Menu 




function enqueue_custom_admin_css() {
    wp_enqueue_style( 'custom-admin-style', get_stylesheet_directory_uri() . '/style.css' );
}
add_action( 'admin_enqueue_scripts', 'enqueue_custom_admin_css' );


// clear cart function


// update tabs button
add_filter( 'woocommerce_product_tabs', 'update_product_tab_titles' );
function update_product_tab_titles( $tabs ) {
    $tabs['description']['title'] = __( 'overview', 'woocommerce' );
    $tabs['reviews']['title'] = __( 'review', 'woocommerce' );
    return $tabs;
}


add_filter('loop_shop_per_page', 'custom_shop_per_page', 20);

function custom_shop_per_page($cols) {
    return 6; // Change 8 to the desired number of products per page
}



function rc_woocommerce_recently_viewed_products( $atts, $content = null ) {
    // Get shortcode parameters
    extract(shortcode_atts(array(
        "per_page" => '-1'
    ), $atts));
    // Get WooCommerce Global
    global $woocommerce, $post;
    // Get recently viewed product cookies data
    $viewed_products = ! empty( $_COOKIE['woocommerce_recently_viewed'] ) ? (array) explode( '|', $_COOKIE['woocommerce_recently_viewed'] ) : array();
    $viewed_products = array_filter( array_map( 'absint', $viewed_products ) );
    // If no data, quit
    if ( empty( $viewed_products ) )
        return __( 'You have not viewed any product yet!', 'rc_wc_rvp' );
    // Create the object
    ob_start();
    // Get products per page
    if( !isset( $per_page ) ? $number = 5 : $number = $per_page )
    // Create query arguments array
    $query_args = array(
                    'posts_per_page' => $number,
                    'no_found_rows'  => 1,
                    'post_status'    => 'publish',
                    'post_type'      => 'product',
                    'post__in'       => $viewed_products,
                    'orderby'        => 'rand'
                    );
    // Add meta_query to query args
    $query_args['meta_query'] = array();
    // Check products stock status
    $query_args['meta_query'][] = $woocommerce->query->stock_status_meta_query();
    // Create a new query
    $r = new WP_Query($query_args);

    // ----
    if (empty($r)) {
      return __( 'You have not viewed any product yet!', 'rc_wc_rvp' );

    }?>
    
 <?php while ( $r->have_posts() ) : $r->the_post(); 
   $url= wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
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

   <!-- //put your theme html loop here -->
    <div class="col-lg-4 col-md-6 col-sm-12 product_column" >
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
                <p class="price d-flex align-items-center justify-content-center"><?php echo $price; ?></p>
            </div>
            <div class="add_to_cart">
                <?php echo do_shortcode('[add_to_cart id="' . $product->get_id() . '"]'); ?>
            </div>
        </div>
    </div>
<!-- end html loop  -->
<?php endwhile; ?>



    <?php wp_reset_postdata();
    return '<div class="row">' . ob_get_clean() . '</div>';
    // ----
    // Get clean object
    $content .= ob_get_clean();
    // Return whole content
    return $content;
}
// Register the shortcode
add_shortcode("woocommerce_recently_viewed_products", "rc_woocommerce_recently_viewed_products");


// Add Payment Methods tab to My Account navigation
function add_payment_methods_tab( $items ) {
    // Add Payment Methods menu item
    $items['payment-methods'] = __( 'Payment Methods', 'woocommerce' );

    return $items;
}
add_filter( 'woocommerce_account_menu_items', 'add_payment_methods_tab', 10, 1 );

// Define the endpoint for the Payment Methods page
function add_payment_methods_endpoint() {
    add_rewrite_endpoint( 'payment-methods', EP_PAGES );
}
add_action( 'init', 'add_payment_methods_endpoint' );

// Add content for the Payment Methods page
function payment_methods_content() {
    wc_get_template( 'myaccount/payment-methods.php' );
}
add_action( 'woocommerce_account_payment-methods_endpoint', 'payment_methods_content' );






// function add_fireworks_categories() {
//     $categories = array(
//         'Badaboom Fireworks',
//         'Black Cat Fireworks',
//         'Black Scorpion/Chili Fireworks',
//         'Blast Wave Fireworks',
//         'Boomer',
//         'Boomer Fireworks',
//         'Bright Star Fireworks',
//         'Brothers Fireworks',
//         'Cannon Brand',
//         'China Generic',
//         'Cutting Edge Fireworks',
//         'Dominator Fireworks',
//         'Dominator Proline Fireworks',
//         'Dragon Blade Fireworks',
//         'Dragon Slayer Fireworks',
//         'Eastsun Fireworks',
//         'Fathead Fireworks',
//         'Firehawk Fireworks',
//         'Fisherman Pyrotechnics',
//         'Flower King Fireworks',
//         'Fowl Fireworks',
//         'Freedom First Fireworks',
//         'Golden Bear',
//         'Great Grizzly',
//         'Guandu Fireworks',
//         'Happy Family Fireworks',
//         'Hero Pyro',
//         'Hot Shot Brand',
//         'Inked Pyro',
//         'Jetwell',
//         'Keystone Fireworks',
//         'King Bird Fireworks',
//         'Kylin King',
//         'Legend',
//         'Legend Fireworks',
//         'Leopard Fireworks',
//         'Liberty Bell',
//         'Lidu Fireworks Co.',
//         'Link Triad Fireworks',
//         'Machine Made Pyro',
//         'Mad Ox Fireworks',
//         'Magnus Fireworks',
//         'Mean Monkey Fireworks',
//         'Mega Ton Fireworks',
//         'Megabanger',
//         'Miracle Fireworks',
//         'Mixed Brands',
//         'Night Owl Fireworks',
//         'OC Fireworks',
//         'OCFireworks',
//         'OMG Fireworks',
//         'Overstock Central Fireworks',
//         'Powder Keg Fireworks',
//         'Power Blast Fireworks',
//         'Pyro Demon Fireworks',
//         'Pyro Diablo Fireworks',
//         'Pyro Eagle Fireworks',
//         'Pyro High Fireworks',
//         'Pyro King',
//         'Pyro Nation',
//         'Pyro Packed Fireworks',
//         'Raccoon Fireworks',
//         'Red Rhino Fireworks',
//         'Shock Wave',
//         'Shogun',
//         'Shotgun Brand Fireworks',
//         'Showtime Fireworks',
//         'Sky Bacon Fireworks',
//         'Sky Painter Fireworks',
//         'Sky Thunder',
//         'Sunwing Fireworks',
//         'T-Sky Fireworks',
//         'Tannerite',
//         'Time Bandit Fireworks',
//         'Topgun Fireworks',
//         'Wild Dragon Fireworks',
//         'Winda',
//         'Winda Fireworks',
//         'Wise Guy Fireworks',
//         'World Class Fireworks'
//     );

//     foreach ($categories as $category) {
//         wp_insert_term($category, 'product_cat', array(
//             'description' => '',
//             'slug' => sanitize_title($category),
//             'parent' => 0
//         ));
//     }
// }

// add_action('init', 'add_fireworks_categories');



