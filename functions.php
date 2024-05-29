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

// Modify the registration form shortcode
function registration_form() {
    ob_start();
    ?>
    <form method="post" class="woocommerce-form woocommerce-form-register register">
        <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
            <input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="first_name" id="reg_first_name" placeholder="First Name" value="<?php if (!empty($_POST['first_name'])) echo esc_attr($_POST['first_name']); ?>"/>
        </p>
        <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
            <input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="last_name" id="reg_last_name" placeholder="Last Name" value="<?php if (!empty($_POST['last_name'])) echo esc_attr($_POST['last_name']); ?>" />
        </p>
        <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
            <input type="email" class="woocommerce-Input woocommerce-Input--text input-text" name="email" id="reg_email" placeholder="Email Address" autocomplete="email" value="<?php if (!empty($_POST['email'])) echo esc_attr($_POST['email']); ?>" />
        </p>
        <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
            <input type="number" class="woocommerce-Input woocommerce-Input--text input-text" name="billing_phone" id="billing_phone" placeholder="Phone Number" value="<?php if (!empty($_POST['billing_phone'])) echo esc_attr($_POST['billing_phone']); ?>" />
        </p>
        <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
            <input type="password" class="woocommerce-Input woocommerce-Input--text input-text" name="password_1" id="password_1" autocomplete="off" placeholder="Password" />
            <span class="show-password-input"></span>
        </p>
        <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
            <input type="password" class="woocommerce-Input woocommerce-Input--text input-text" name="password_2" id="password_2" autocomplete="off" placeholder="Confirm Password" />
            <span class="show-password-input"></span>
        </p>
        <div class="group">
            <p class="register-remember w-100">
                <label>
                    <input name="rememberme" type="checkbox" id="rememberme" value="forever" class="">
                    <span>Your personal data will be used to support your experience throughout this website, to manage access to your account, and for other purposes described in our <a href="<?php echo get_home_url(); ?>/privacy-policy/" target="_blank" rel="noopener noreferrer">Privacy Policy</a></span>
                </label>
            </p>
        </div>
        <p class="woocommerce-form-row form-row">
            <?php wp_nonce_field('woocommerce-register', 'woocommerce-register-nonce'); ?>
            <button type="submit" class="woocommerce-Button woocommerce-button button woocommerce-form-register__submit" name="register" value="Register"><?php echo is_page('register') ? "Create Account" : "Submit"?></button>
        </p>
        
    </form>
    <?php
    // Display WooCommerce error messages
    return ob_get_clean();
}

add_shortcode('registration_form', 'registration_form');

// Hook into user registration to save first name and last name
function save_extra_user_fields($user_id) {
    if (isset($_POST['first_name'])) {
        update_user_meta($user_id, 'first_name', sanitize_text_field($_POST['first_name']));
    }
    if (isset($_POST['last_name'])) {
        update_user_meta($user_id, 'last_name', sanitize_text_field($_POST['last_name']));
    }
    if (isset($_POST['billing_phone'])) {
        update_user_meta($user_id, 'billing_phone', sanitize_text_field($_POST['billing_phone']));
    }
}
add_action('user_register', 'save_extra_user_fields');




//Log in Form
function custom_login_form_shortcode() {
    if (is_user_logged_in()) {
        // If the user is already logged in, display a message or redirect as needed
        return 'You are already logged in.';
    } else {
        // If the user is not logged in, display the custom login form with placeholders and "Remember Me" checkbox
        ob_start();
        do_action( 'woocommerce_before_customer_login_form' );
        ?>
        
        <form class="woocommerce-form woocommerce-form-login login" method="post">

            <?php do_action( 'woocommerce_login_form_start' ); ?>

            <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                <!-- <label for="username"><?php esc_html_e( 'Username or email address', 'woocommerce' ); ?>&nbsp;<span class="required">*</span></label> -->
                <input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="username" id="username" autocomplete="username" value="<?php echo ( ! empty( $_POST['username'] ) ) ? esc_attr( wp_unslash( $_POST['username'] ) ) : ''; ?>" placeholder="Email Address" /><?php // @codingStandardsIgnoreLine ?>
            </p>
            <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                <!-- <label for="password"><?php esc_html_e( 'Password', 'woocommerce' ); ?>&nbsp;<span class="required">*</span></label> -->
                <input class="woocommerce-Input woocommerce-Input--text input-text" type="password" name="password" id="password" autocomplete="current-password" placeholder="Password"/>
            </p>

            <?php do_action( 'woocommerce_login_form' ); ?>

            <p class="form-row">
                <?php wp_nonce_field( 'woocommerce-login', 'woocommerce-login-nonce' ); ?>
                <button type="submit" class="black_button woocommerce-button button woocommerce-form-login__submit<?php echo esc_attr( wc_wp_theme_get_element_class_name( 'button' ) ? ' ' . wc_wp_theme_get_element_class_name( 'button' ) : '' ); ?>" name="login" value="<?php esc_attr_e( 'Log in', 'woocommerce' ); ?>"><?php esc_html_e( 'Log in', 'woocommerce' ); ?></button>
            </p>
            <div class="group">
                <p class="login-remember">
                    <label class="woocommerce-form__label woocommerce-form__label-for-checkbox woocommerce-form-login__rememberme d-flex align-items-center">
                        <input class="woocommerce-form__input woocommerce-form__input-checkbox" name="rememberme" type="checkbox" id="rememberme" value="forever" placeholder="Password"/> <span><?php esc_html_e( 'Remember me', 'woocommerce' ); ?></span>
                    </label>
                </p>
                <p class="woocommerce-LostPassword lost_password">
                    <a href="<?php echo esc_url( wp_lostpassword_url() ); ?>"><?php esc_html_e( 'Lost your password?', 'woocommerce' ); ?></a>
                </p>
            </div>
            <p class="text-white text-center">Don’t Have an Account? <strong><a href="<?php echo get_home_url(); ?>/register/" target="_blank" rel="noopener noreferrer">Sign Up</a></strong></p>
            <?php do_action( 'woocommerce_login_form_end' ); ?>
        </form>
        <?php
        do_action( 'woocommerce_after_customer_login_form' );

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



add_action( 'template_redirect', 'bbloomer_track_product_view', 9999 );
 
function bbloomer_track_product_view() {
   if ( ! is_singular( 'product' ) ) return;
   global $post;
   if ( empty( $_COOKIE['bbloomer_recently_viewed'] ) ) {
      $viewed_products = array();
   } else {
      $viewed_products = wp_parse_id_list( (array) explode( '|', wp_unslash( $_COOKIE['bbloomer_recently_viewed'] ) ) );
   }
   $keys = array_flip( $viewed_products );
   if ( isset( $keys[ $post->ID ] ) ) {
      unset( $viewed_products[ $keys[ $post->ID ] ] );
   }
   $viewed_products[] = $post->ID;
   if ( count( $viewed_products ) > 15 ) {
      array_shift( $viewed_products );
   }
   wc_setcookie( 'bbloomer_recently_viewed', implode( '|', $viewed_products ) );
}
 
add_shortcode( 'recently_viewed_products', 'bbloomer_recently_viewed_shortcode' );
  
function bbloomer_recently_viewed_shortcode() {
   $viewed_products = ! empty( $_COOKIE['bbloomer_recently_viewed'] ) ? (array) explode( '|', wp_unslash( $_COOKIE['bbloomer_recently_viewed'] ) ) : array();
   $viewed_products = array_reverse( array_filter( array_map( 'absint', $viewed_products ) ) );
   if ( empty( $viewed_products ) ) return;
   $title = '<h3>Recently Viewed</h3>';
   $product_ids = implode( ",", $viewed_products );
   return $title . do_shortcode("[products ids='$product_ids']");
}








// Function to remove <br> tags from Contact Form 7 forms
function remove_br_from_cf7_form($form) {
    // Remove <br> and <br /> tags
    $form = str_replace('<br>', '', $form);
    $form = str_replace('<br />', '', $form);
    return $form;
}

// Apply the function to the wpcf7_form_elements filter
add_filter('wpcf7_form_elements', 'remove_br_from_cf7_form');




// Register the custom endpoint for recently view products
function add_custom_my_account_endpoint() {
    add_rewrite_endpoint( 'recently-viewed', EP_ROOT | EP_PAGES );
}
add_action( 'init', 'add_custom_my_account_endpoint' );

// Add the Recently Viewed tab to My Account navigation
function add_recently_viewed_tab( $items ) {
    $items['recently-viewed'] = __( 'Recently Viewed Products', 'woocommerce' );
    return $items;
}
add_filter( 'woocommerce_account_menu_items', 'add_recently_viewed_tab', 99 );

// Display content for the Recently Viewed endpoint
function display_recently_viewed_products() {
    echo do_shortcode('[recently_viewed_products]');
}
add_action( 'woocommerce_account_recently-viewed_endpoint', 'display_recently_viewed_products' );