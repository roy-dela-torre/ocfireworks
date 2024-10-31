<?php
if (! function_exists('ocfireworks')) :
    function ocfireworks_setup()
    {
        add_theme_support('post-thumbnails');
        add_theme_support('post-formats', array('aside', 'gallery', 'quote', 'image', 'video'));
        add_theme_support('woocommerce');
        add_theme_support('wc-product-gallery-zoom');
        add_theme_support('wc-product-gallery-lightbox');
        add_theme_support('wc-product-gallery-slider');

        register_nav_menus(array(
            'primary' => __('Primary Menu', 'ocfireworks'),
            'secondary' => __('Secondary Menu', 'ocfireworks'),
        ));
    }
    add_action('after_setup_theme', 'ocfireworks_setup');
endif;
function get_excerpt($limit, $source = null)
{
    $excerpt = $source == "content" ? get_the_content() : get_the_excerpt();
    $excerpt = preg_replace(" (\[.*?\])", '', $excerpt);
    $excerpt = strip_shortcodes($excerpt);
    $excerpt = strip_tags($excerpt);
    $excerpt = substr($excerpt, 0, $limit);
    $excerpt = substr($excerpt, 0, strripos($excerpt, " "));
    $excerpt = trim(preg_replace('/\s+/', ' ', $excerpt));
    return $excerpt;
}


function registration_form()
{
    ob_start();
?>
    <form method="post" class="woocommerce-form woocommerce-form-register register">
        <?php do_action('woocommerce_before_customer_login_form'); ?>
        <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
            <input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="first_name" id="reg_first_name" placeholder="First Name" value="<?php if (!empty($_POST['first_name'])) echo esc_attr($_POST['first_name']); ?>" />
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
                    <input name="rememberme" type="checkbox" id="rememberme" value="forever" class="" />
                    <span>Your personal data will be used to support your experience throughout this website, to manage access to your account, and for other purposes described in our <a href="<?php echo get_home_url(); ?>/privacy-policy/" target="_blank" rel="noopener noreferrer">Privacy Policy</a></span>
                </label>
            </p>
        </div>
        <p class="woocommerce-form-row form-row">
            <?php wp_nonce_field('woocommerce-register', 'woocommerce-register-nonce'); ?>
            <button type="submit" class="woocommerce-Button woocommerce-button button woocommerce-form-register__submit" name="register" value="Register"><?php echo is_page('sign-up') ? "Create Account" : "Submit" ?></button>
        </p>
        <?php do_action('woocommerce_after_customer_login_form'); ?>
    </form>

    <?php
    return ob_get_clean();
}

add_shortcode('registration_form', 'registration_form');

function custom_process_registration()
{
    if ('POST' !== strtoupper($_SERVER['REQUEST_METHOD'])) {
        return;
    }


    $nonce_value = isset($_POST['woocommerce-register-nonce']) ? $_POST['woocommerce-register-nonce'] : '';
    if (!wp_verify_nonce($nonce_value, 'woocommerce-register')) {

        return;
    }


    $first_name = isset($_POST['first_name']) ? sanitize_text_field($_POST['first_name']) : '';
    $last_name = isset($_POST['last_name']) ? sanitize_text_field($_POST['last_name']) : '';
    $email = isset($_POST['email']) ? sanitize_email($_POST['email']) : '';
    $phone = isset($_POST['billing_phone']) ? sanitize_text_field($_POST['billing_phone']) : '';
    $password = isset($_POST['password_1']) ? $_POST['password_1'] : '';
    $password2 = isset($_POST['password_2']) ? $_POST['password_2'] : '';
    $checkbox = isset($_POST['rememberme']) ? sanitize_text_field($_POST['rememberme']) : '';


    echo '<script>console.log("Password 1: ' . $password . '");</script>';
    echo '<script>console.log("Password 2: ' . $password2 . '");</script>';
    echo '<script>console.log("Checkbox: ' . $checkbox . '");</script>';

    if (empty($first_name)) {
        wc_add_notice(__('First name is required.', 'woocommerce'), 'error');
    }

    if (empty($last_name)) {
        wc_add_notice(__('Last name is required.', 'woocommerce'), 'error');
    }

    if (empty($email) || !is_email($email)) {
        wc_add_notice(__('Please provide a valid email address.', 'woocommerce'), 'error');
    }

    if (empty($phone)) {
        wc_add_notice(__('Phone number is required.', 'woocommerce'), 'error');
    }

    if (empty($password)) {
        wc_add_notice(__('Password is required.', 'woocommerce'), 'error');
    }

    if (empty($password2)) {
        wc_add_notice(__('Confirm password is required.', 'woocommerce'), 'error');
    }

    if (!empty($password) && !empty($password2) && $password !== $password2) {
        wc_add_notice(__('Passwords do not match.', 'woocommerce'), 'error');
    }

    if (empty($checkbox)) {
        wc_add_notice(__('You must agree to the terms and conditions.', 'woocommerce'), 'error');
    }

    if (wc_notice_count('error') > 0) {
        return;
    }


    $user_data = array(
        'user_login' => $email,
        'user_email' => $email,
        'user_pass' => $password,
        'first_name' => $first_name,
        'last_name' => $last_name,
    );

    $user_id = wp_insert_user($user_data);

    if (is_wp_error($user_id)) {
        wc_add_notice($user_id->get_error_message(), 'error');
    } else {

        if (!empty($phone)) {
            update_user_meta($user_id, 'billing_phone', $phone);
        }


        wc_set_customer_auth_cookie($user_id);


        $redirect = wc_get_page_permalink('myaccount');
        wp_redirect($redirect);
        exit;
    }
}
add_action('template_redirect', 'custom_process_registration');





function save_extra_user_fields($user_id)
{
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





function custom_login_form_shortcode()
{
    if (is_user_logged_in()) {

        return 'You are already logged in.';
    } else {

        ob_start();
        do_action('woocommerce_before_customer_login_form');
    ?>

        <form class="woocommerce-form woocommerce-form-login login" method="post">

            <?php do_action('woocommerce_login_form_start'); ?>

            <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                <!-- <label for="username"><?php esc_html_e('Username or email address', 'woocommerce'); ?>&nbsp;<span class="required">*</span></label> -->
                <input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="username" id="username" autocomplete="username" value="<?php echo (! empty($_POST['username'])) ? esc_attr(wp_unslash($_POST['username'])) : ''; ?>" placeholder="Email Address" /><?php
                                                                                                                                                                                                                                                                                            ?>
            </p>
            <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                <!-- <label for="password"><?php esc_html_e('Password', 'woocommerce'); ?>&nbsp;<span class="required">*</span></label> -->
                <input class="woocommerce-Input woocommerce-Input--text input-text" type="password" name="password" id="password" autocomplete="current-password" placeholder="Password" />
            </p>

            <?php do_action('woocommerce_login_form'); ?>

            <p class="form-row">
                <?php wp_nonce_field('woocommerce-login', 'woocommerce-login-nonce'); ?>
                <button type="submit" class="black_button woocommerce-button button woocommerce-form-login__submit<?php echo esc_attr(wc_wp_theme_get_element_class_name('button') ? ' ' . wc_wp_theme_get_element_class_name('button') : ''); ?>" name="login" value="<?php esc_attr_e('Log in', 'woocommerce'); ?>"><?php esc_html_e('Log in', 'woocommerce'); ?></button>
            </p>
            <div class="group">
                <p class="login-remember mb-0">
                    <label class="woocommerce-form__label woocommerce-form__label-for-checkbox woocommerce-form-login__rememberme d-flex align-items-center">
                        <input class="woocommerce-form__input woocommerce-form__input-checkbox" name="rememberme" type="checkbox" id="rememberme" value="forever" placeholder="Password" /> <span><?php esc_html_e('Remember me', 'woocommerce'); ?></span>
                    </label>
                </p>
                <p class="woocommerce-LostPassword lost_password">
                    <a href="<?php echo esc_url(wp_lostpassword_url()); ?>"><?php esc_html_e('Lost your password?', 'woocommerce'); ?></a>
                </p>
            </div>
            <p class="text-white text-center">Don’t Have an Account? <strong><a href="<?php echo get_home_url(); ?>/register/" target="_blank" rel="noopener noreferrer">Sign Up</a></strong></p>
            <?php do_action('woocommerce_login_form_end'); ?>
        </form>
    <?php
        do_action('woocommerce_after_customer_login_form');

        return ob_get_clean();
    }
}
add_shortcode('custom_login_form', 'custom_login_form_shortcode');



add_filter('yith_wcwl_is_wishlist_responsive', '__return_false');



/* Add Plus and Minus Button for Quantity Input */
add_action('woocommerce_before_quantity_input_field', 'custom_display_quantity_minus');
add_action('woocommerce_after_quantity_input_field', 'custom_display_quantity_plus');

function custom_display_quantity_minus()
{
    echo '<button type="button" class="minus">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="21" viewBox="0 0 20 21" fill="none">
            <path d="M15.5 10.4997C15.5 10.7581 15.4305 11.0059 15.3067 11.1886C15.1829 11.3713 15.015 11.474 14.84 11.474H5.16C4.98496 11.474 4.81708 11.3713 4.69331 11.1886C4.56954 11.0059 4.5 10.7581 4.5 10.4997C4.5 10.2413 4.56954 9.99348 4.69331 9.81076C4.81708 9.62804 4.98496 9.52539 5.16 9.52539H14.84C15.015 9.52539 15.1829 9.62804 15.3067 9.81076C15.4305 9.99348 15.5 10.2413 15.5 10.4997Z" fill="white"/>
        </svg>
    </button>';
}

function custom_display_quantity_plus()
{
    echo '<button type="button" class="plus">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="21" viewBox="0 0 20 21" fill="none">
            <path d="M14.9993 11.3307H10.8327V15.4974C10.8327 15.7184 10.7449 15.9304 10.5886 16.0866C10.4323 16.2429 10.2204 16.3307 9.99935 16.3307C9.77834 16.3307 9.56637 16.2429 9.41009 16.0866C9.25381 15.9304 9.16602 15.7184 9.16602 15.4974V11.3307H4.99935C4.77834 11.3307 4.56637 11.2429 4.41009 11.0867C4.25381 10.9304 4.16602 10.7184 4.16602 10.4974C4.16602 10.2764 4.25381 10.0644 4.41009 9.90814C4.56637 9.75186 4.77834 9.66406 4.99935 9.66406H9.16602V5.4974C9.16602 5.27638 9.25381 5.06442 9.41009 4.90814C9.56637 4.75186 9.77834 4.66406 9.99935 4.66406C10.2204 4.66406 10.4323 4.75186 10.5886 4.90814C10.7449 5.06442 10.8327 5.27638 10.8327 5.4974V9.66406H14.9993C15.2204 9.66406 15.4323 9.75186 15.5886 9.90814C15.7449 10.0644 15.8327 10.2764 15.8327 10.4974C15.8327 10.7184 15.7449 10.9304 15.5886 11.0867C15.4323 11.2429 15.2204 11.3307 14.9993 11.3307Z" fill="white"/>
        </svg>
    </button>';
}

/* Trigger update quantity script */
add_action('wp_footer', 'custom_add_cart_quantity_plus_minus');

function custom_add_cart_quantity_plus_minus()
{
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
            jQuery('div.woocommerce').on('change', 'input.qty', function() {
                if (timeout !== undefined) {
                    clearTimeout(timeout);
                }
                timeout = setTimeout(function() {
                    jQuery("[name='update_cart']").trigger("click");
                }, 1000);
            });

            jQuery('div.woocommerce').on('click', 'button.minus, button.plus', function() {
                jQuery("[name='update_cart']").trigger("click");
            });
        </script>
    <?php
    }
}




remove_action('woocommerce_checkout_order_review', 'woocommerce_checkout_payment', 20);
add_action('woocommerce_checkout_payment_hook', 'woocommerce_checkout_payment', 10);






function enqueue_custom_admin_css()
{
    wp_enqueue_style('custom-admin-style', get_stylesheet_directory_uri() . '/style.css');
}
add_action('admin_enqueue_scripts', 'enqueue_custom_admin_css');






add_filter('woocommerce_product_tabs', 'update_product_tab_titles');
function update_product_tab_titles($tabs)
{
    $tabs['description']['title'] = __('overview', 'woocommerce');
    $tabs['reviews']['title'] = __('review', 'woocommerce');
    return $tabs;
}


add_filter('loop_shop_per_page', 'custom_shop_per_page', 20);

function custom_shop_per_page($cols)
{
    return 6;
}



add_action('template_redirect', 'bbloomer_track_product_view', 9999);

function bbloomer_track_product_view()
{
    if (! is_singular('product')) return;
    global $post;
    if (empty($_COOKIE['bbloomer_recently_viewed'])) {
        $viewed_products = array();
    } else {
        $viewed_products = wp_parse_id_list((array) explode('|', wp_unslash($_COOKIE['bbloomer_recently_viewed'])));
    }
    $keys = array_flip($viewed_products);
    if (isset($keys[$post->ID])) {
        unset($viewed_products[$keys[$post->ID]]);
    }
    $viewed_products[] = $post->ID;
    if (count($viewed_products) > 15) {
        array_shift($viewed_products);
    }
    wc_setcookie('bbloomer_recently_viewed', implode('|', $viewed_products));
}

add_shortcode('recently_viewed_products', 'bbloomer_recently_viewed_shortcode');

function bbloomer_recently_viewed_shortcode()
{
    $viewed_products = ! empty($_COOKIE['bbloomer_recently_viewed']) ? (array) explode('|', wp_unslash($_COOKIE['bbloomer_recently_viewed'])) : array();
    $viewed_products = array_reverse(array_filter(array_map('absint', $viewed_products)));
    if (empty($viewed_products)) return;
    $title = '<h3>Recently Viewed</h3>';
    $product_ids = implode(",", $viewed_products);
    return $title . do_shortcode("[products ids='$product_ids']");
}



function add_custom_my_account_endpoint()
{
    add_rewrite_endpoint('recently-viewed', EP_ROOT | EP_PAGES);
}
add_action('init', 'add_custom_my_account_endpoint');



function display_recently_viewed_products()
{
    echo do_shortcode('[recently_viewed_products]');
}
add_action('woocommerce_account_recently-viewed_endpoint', 'display_recently_viewed_products');


function add_custom_my_account_endpoint_news_letter()
{
    add_rewrite_endpoint('news-letter', EP_ROOT | EP_PAGES);
}
add_action('init', 'add_custom_my_account_endpoint_news_letter');

function add_custom_query_vars_news_letter($vars)
{
    $vars[] = 'news-letter';
    return $vars;
}
add_filter('query_vars', 'add_custom_query_vars_news_letter');

function custom_my_account_endpoint_news_letter_content()
{
    wc_get_template_part('myaccount/news-letter');
}
add_action('woocommerce_account_news-letter_endpoint', 'custom_my_account_endpoint_news_letter_content');




function add_custom_my_account_endpoint_order_status()
{
    add_rewrite_endpoint('order-status', EP_ROOT | EP_PAGES);
}
add_action('init', 'add_custom_my_account_endpoint_order_status');

function add_custom_query_vars_order_status($vars)
{
    $vars[] = 'order-status';
    return $vars;
}
add_filter('query_vars', 'add_custom_query_vars_order_status');

function custom_my_account_endpoint_order_status_content()
{
    wc_get_template_part('myaccount/order-status');
}
add_action('woocommerce_account_order-status_endpoint', 'custom_my_account_endpoint_order_status_content');






function remove_br_from_cf7_form($form)
{

    $form = str_replace('<br>', '', $form);
    $form = str_replace('<br />', '', $form);
    return $form;
}


add_filter('wpcf7_form_elements', 'remove_br_from_cf7_form');










function add_categories_to_pages()
{
    register_taxonomy_for_object_type('category', 'page');
}
add_action('init', 'add_categories_to_pages');









function populate_page_categories_column($column, $post_id)
{
    if ($column === 'page_categories') {
        $categories = get_the_terms($post_id, 'category');
        if ($categories && !is_wp_error($categories)) {
            $category_names = array();
            foreach ($categories as $category) {
                $category_names[] = esc_html($category->name);
            }
            echo implode(', ', $category_names);
        } else {
            echo __('No Categories', 'textdomain');
        }
    }
}
add_action('manage_pages_custom_column', 'populate_page_categories_column', 10, 2);





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


        $totalPages = $query->max_num_pages;
        echo '<div class="paging d-flex justify-content-center align-items-center">';
        echo paginate_links(array(
            'total' => $totalPages,
            'mid_size' => 2
        ));
        echo '</div>';
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








function fab_business_shop_scripts()
{
    wp_enqueue_script('ic-cart-ajax', get_template_directory_uri() . '/js/mini-cart.js', array('jquery'), '1.0', true);
    wp_localize_script(
        'ic-cart-ajax',
        'my_ajax_object',
        array(
            'ajax_url' => admin_url('admin-ajax.php'),
            'nonce'    => wp_create_nonce('ic-mc-nc'),
        )
    );
}
add_action('wp_enqueue_scripts', 'fab_business_shop_scripts');



add_action('wp_ajax_ic_qty_update', 'ic_qty_update');
add_action('wp_ajax_nopriv_ic_qty_update', 'ic_qty_update');

function ic_qty_update()
{
    $key    = sanitize_text_field($_POST['key']);
    $number = intval(sanitize_text_field($_POST['number']));

    $cart = [
        'count'      => 0,
        'total'      => 0,
        'item_price' => 0,
    ];

    if ($key && $number > 0 && wp_verify_nonce($_POST['security'], 'ic-mc-nc')) {
        WC()->cart->set_quantity($key, $number);
        $items              = WC()->cart->get_cart();
        $cart               = [];
        $cart['count']      = WC()->cart->cart_contents_count;
        $cart['total']      = WC()->cart->get_cart_total();
        $cart['item_price'] = wc_price($items[$key]['line_total']);
    }

    echo json_encode($cart);
    wp_die();
}











function add_custom_state_mappings($states)
{
    $states['PH']['00'] = 'Metro Manila';
    return $states;
}
add_filter('woocommerce_states', 'add_custom_state_mappings');


function dequeue_woocommerce_styles()
{
    if (is_front_page()) {
        wp_dequeue_style('woocommerce-general');
        wp_dequeue_style('woocommerce');
        wp_dequeue_style('woocommerce-layout');
        wp_dequeue_style('woocommerce-smallscreen');
        wp_dequeue_style('select2');
        wp_dequeue_style('wp-block-library-css');
        wp_dequeue_style('jquery-selectBox-css');
        wp_dequeue_style('yith-wcwl-font-awesome-css');
        wp_dequeue_style('woocommerce_prettyPhoto_css-css');
        wp_dequeue_style('yith-wcwl-main-css');
    } elseif (is_account_page()) {
        wp_dequeue_style('woocommerce-layout');
        wp_dequeue_style('woocommerce-general');
        wp_dequeue_style('woocommerce-smallscreen');
        wp_dequeue_style('select2');
    } elseif (is_checkout()) {
        wp_dequeue_style('woocommerce-general');
        wp_dequeue_style('woocommerce');
        wp_dequeue_style('woocommerce-layout');
        wp_dequeue_style('woocommerce-smallscreen');
    }
}
add_action('wp_enqueue_scripts', 'dequeue_woocommerce_styles', 99);


remove_action('woocommerce_before_checkout_form', 'woocommerce_checkout_coupon_form', 10);



add_action('pre_get_posts', 'hide_out_of_stock_products_function');

function hide_out_of_stock_products_function($q)
{
    if (! is_admin() && $q->is_main_query() && (is_shop() || is_product_category() || is_product_tag() || is_search())) {
        $meta_query = (array) $q->get('meta_query');

        $meta_query[] = array(
            'key'     => '_stock_status',
            'value'   => 'outofstock',
            'compare' => 'NOT IN'
        );

        $q->set('meta_query', $meta_query);
    }
}


// order option function in checkout page start

add_action('woocommerce_after_order_notes', 'custom_checkout_order_options');

function custom_checkout_order_options($checkout)
{
    echo '<h3>' . __('Order option') . '</h3>';
    echo '<div class="woocommerce-radio-wrapper">';
    $first = true;
    if (have_rows('order_option')) {
        while (have_rows('order_option')) {
            the_row();
            $title = get_sub_field('title');
            $description = get_sub_field('description');
            $amount = get_sub_field('amount');

            // Format title to lowercase and replace spaces with underscores
            $formatted_title = esc_attr(strtolower(str_replace(' ', '_', $title)));

            // Display each option
        ?>
            <div class="order-option">
                <input <?php echo $first ? 'checked' : "" ?> type="radio" class="input-checkbox" value="<?php echo $formatted_title; ?>" name="order_additional_options" id="order_additional_options_<?php echo $formatted_title; ?>">
                <label for="order_additional_options_<?php echo $formatted_title; ?>" class="checkbox">
                    <b><?php echo esc_html($title); ?></b>
                    <?php if ($description) {
                        echo '(' . esc_html($description) . ') ';
                    } ?>
                    <b>(+$<?php echo esc_html($amount); ?>)</b>
                </label>
            </div>
    <?php
            $first = false;
        }
    } else {
        echo '<p>' . __('No additional services available.') . '</p>'; // Error message if no options exist
    }

    echo '</div>'; // Closing div for .woocommerce-radio-wrapper
    ?>
<?php
}


add_action('wp_ajax_update_order_option', 'custom_order_options_update_order_meta');
add_action('wp_ajax_nopriv_update_order_option', 'custom_order_options_update_order_meta');

function custom_order_options_update_order_meta()
{
    if (!empty($_POST['order_additional_options'])) {
        WC()->session->set('order_additional_options', sanitize_text_field($_POST['order_additional_options']));
    }
    wp_die();
}


add_action('woocommerce_cart_calculate_fees', 'custom_checkout_add_fees');

function custom_checkout_add_fees($cart)
{

    if (is_admin() && !defined('DOING_AJAX')) {
        return;
    }


    $selected_option = WC()->session->get('order_additional_options');
    $additional_fee = 0;

    $paymentinfo = WC()->session->get('paymentinfo');

    if (!$paymentinfo) {
        $paymentinfo = [];
        if (have_rows('order_option')) {
            while (have_rows('order_option')) {
                the_row();
                $title_fee = get_sub_field('title');
                $amount_fee = get_sub_field('amount');

                if ($title_fee && $amount_fee) {
                    $formatted_title = esc_attr(strtolower(str_replace(' ', '_', $title_fee)));
                    $paymentinfo[$formatted_title] = $amount_fee;
                }
            }
            WC()->session->set('paymentinfo', $paymentinfo);
        }
    }

    error_log("Payment Info: " . print_r($paymentinfo, true));

    // Determine additional fee based on selected option
    if (isset($paymentinfo[$selected_option])) {
        $additional_fee = $paymentinfo[$selected_option];
    } else {
        // Debug: No match found for the selected option
        error_log("No match found for: " . print_r($selected_option, true));
    }

    // Add the fee to the cart if greater than 0
    if ($additional_fee > 0) {
        $cart->add_fee(__('Additional Service', 'woocommerce'), $additional_fee);
    } else {
        // Debug: No additional fee to add
        error_log("No additional fee to add.");
    }
}


// force update currency symbol
add_filter('woocommerce_price_format', 'custom_price_format');
function custom_price_format()
{
    return '%1$s%2$s'; // This ensures the currency symbol comes before the price
}


// HIDE PRODUCT IF NO PRICE
function hide_products_without_price($query)
{
    if (!is_admin() && $query->is_main_query() && (is_shop() || is_product_category() || is_product_tag() || is_search())) {
        $meta_query = $query->get('meta_query') ? $query->get('meta_query') : [];

        // Add condition to hide products without a price
        $meta_query[] = [
            'key'     => '_price',
            'value'   => '',
            'compare' => '!=',  // Select products that have a price
        ];

        $query->set('meta_query', $meta_query);
    }
}
add_action('pre_get_posts', 'hide_products_without_price');



// woocommerce pagination limit its number item
function custom_woocommerce_pagination_args($args)
{
    // Set the maximum number of pagination links displayed.
    $args['end_size'] = 1; // Number of links at the beginning and end.
    $args['mid_size'] = 2; // Number of links on either side of the current page.
    return $args;
}
add_filter('woocommerce_pagination_args', 'custom_woocommerce_pagination_args');
