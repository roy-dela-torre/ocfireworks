<?php


add_filter('yith_wcwl_is_wishlist_responsive', '__return_false');

function enqueue_custom_admin_css()
{
    wp_enqueue_style('custom-admin-style', get_stylesheet_directory_uri() . '/style.css');
}
add_action('admin_enqueue_scripts', 'enqueue_custom_admin_css');

function custom_shop_per_page($cols)
{
    return 6;
}

add_filter('loop_shop_per_page', 'custom_shop_per_page', 20);

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


function remove_prefetch_links()
{
    remove_action('wp_head', 'wp_resource_hints', 2); // This removes all prefetch links.
}
add_action('init', 'remove_prefetch_links');

remove_action('woocommerce_before_checkout_form', 'woocommerce_checkout_coupon_form', 10);

// add_action('pre_get_posts', 'hide_out_of_stock_products_function');

// function hide_out_of_stock_products_function($q)
// {
//     if (! is_admin() && $q->is_main_query() && (is_shop() || is_product_category() || is_product_tag() || is_search())) {
//         $meta_query = (array) $q->get('meta_query');

//         $meta_query[] = array(
//             'key'     => '_stock_status',
//             'value'   => 'outofstock',
//             'compare' => 'NOT IN'
//         );

//         $q->set('meta_query', $meta_query);
//     }
// }


function add_custom_state_mappings($states)
{
    $states['PH']['00'] = 'Metro Manila';
    return $states;
}
add_filter('woocommerce_states', 'add_custom_state_mappings');

function apply_free_shipping_for_orders_above_400($rates)
{
    // Get the cart subtotal
    $cart_total = WC()->cart->subtotal;

    // Check if the cart total is above $400
    if ($cart_total > 499.99) {
        foreach ($rates as $rate_key => $rate) {
            // Set the shipping cost to $0 for each shipping method
            $rates[$rate_key]->cost = 0;

            // Set taxes to 0 if applicable
            if (isset($rates[$rate_key]->taxes) && is_array($rates[$rate_key]->taxes)) {
                foreach ($rates[$rate_key]->taxes as $tax_key => $tax) {
                    $rates[$rate_key]->taxes[$tax_key] = 0;
                }
            }
        }
    }

    return $rates;
}
add_filter('woocommerce_package_rates', 'apply_free_shipping_for_orders_above_400');



// display product in dashboard wihout featured image (filter)

add_action('restrict_manage_posts', 'filter_products_by_featured_image');
function filter_products_by_featured_image()
{
    global $typenow;

    if ($typenow == 'product') {
?>
        <select name="has_featured_image" id="has_featured_image">
            <option value=""><?php _e('All Products', 'textdomain'); ?></option>
            <option value="no_featured_image" <?php selected(isset($_GET['has_featured_image']) && $_GET['has_featured_image'] == 'no_featured_image'); ?>>
                <?php _e('No Featured Image', 'textdomain'); ?>
            </option>
        </select>
<?php
    }
}

add_action('pre_get_posts', 'filter_products_without_featured_image');
function filter_products_without_featured_image($query)
{
    global $pagenow, $typenow;

    if ($typenow == 'product' && $pagenow == 'edit.php' && isset($_GET['has_featured_image']) && $_GET['has_featured_image'] == 'no_featured_image') {
        $query->set('meta_query', array(
            array(
                'key' => '_thumbnail_id',
                'compare' => 'NOT EXISTS'
            )
        ));
    }
}

// checkt duplicated product on product table admin dashboard
// Step 1: Add a custom filter to the WooCommerce product list table
add_action('restrict_manage_posts', 'add_duplicate_products_filter');
function add_duplicate_products_filter()
{
    global $typenow;

    if ($typenow === 'product') {
        echo '<select name="filter_duplicates">';
        echo '<option value="">Show All Products</option>';
        echo '<option value="duplicates"' . selected(isset($_GET['filter_duplicates']) && $_GET['filter_duplicates'] === 'duplicates', true, false) . '>Show Duplicate Products</option>';
        echo '</select>';
    }
}

// Step 2: Modify the WooCommerce product query to show only duplicate products if the filter is selected
add_action('pre_get_posts', 'filter_duplicate_products');
function filter_duplicate_products($query)
{
    global $typenow;

    if ($typenow === 'product' && is_admin() && $query->is_main_query() && isset($_GET['filter_duplicates']) && $_GET['filter_duplicates'] === 'duplicates') {
        $duplicate_skus = get_duplicate_skus();

        if (!empty($duplicate_skus)) {
            $meta_query = array(
                'relation' => 'OR',
            );

            foreach ($duplicate_skus as $sku) {
                $meta_query[] = array(
                    'key'     => '_sku',
                    'value'   => $sku,
                    'compare' => '='
                );
            }

            $query->set('meta_query', $meta_query);
        } else {
            // If there are no duplicates, prevent any results from showing
            $query->set('post__in', array(0));
        }
    }
}

// Step 3: Helper function to find duplicated SKUs
function get_duplicate_skus()
{
    $args = array(
        'post_type' => 'product',
        'posts_per_page' => -1,
        'fields' => 'ids'
    );

    $product_ids = get_posts($args);
    $skus = [];
    $duplicates = [];

    foreach ($product_ids as $product_id) {
        $sku = get_post_meta($product_id, '_sku', true);
        if ($sku) {
            if (isset($skus[$sku])) {
                $duplicates[$sku] = $sku;
            } else {
                $skus[$sku] = $sku;
            }
        }
    }

    return array_keys($duplicates);
}


// apply discount on new user on checkout page
// Apply 5% discount for new users at checkout
function apply_new_user_discount($cart)
{
    // Check if the user is logged in and if they have made a previous purchase
    if (is_user_logged_in()) {
        $user_id = get_current_user_id();
        $orders = wc_get_orders(array(
            'customer_id' => $user_id,
            'limit' => 1, // Get one order to check if the user is new
        ));

        // If the user has no previous orders, they are considered new
        if (empty($orders)) {
            // Apply a 5% discount
            $discount_percentage = 0.10;
            $discount = $cart->subtotal * $discount_percentage;
            $cart->add_fee(__('New User Discount', 'your-text-domain'), -$discount);
        }
    }
}
add_action('woocommerce_cart_calculate_fees', 'apply_new_user_discount', 20, 1);




// Retrieve restricted product IDs
function get_restricted_products()
{
    static $restricted_products = null;

    if (is_null($restricted_products)) {
        $restricted_products = array();

        // Query for the 'hidden-product' custom post type
        $args = array(
            'post_type'        => 'hidden-product',
            'posts_per_page'   => -1,
            'post_status'      => 'publish',
        );
        $query = new WP_Query($args);

        // Collect product IDs from the 'product_list' ACF Post Object field
        if ($query->have_posts()) {
            while ($query->have_posts()) {
                $query->the_post();
                $product_list = get_field('product_list', get_the_ID());
                if (!empty($product_list)) {
                    foreach ($product_list as $product_id) {
                        $restricted_products[] = (int) $product_id; // Add product ID as integer
                    }
                }
            }
            wp_reset_postdata();
        }
    }

    return $restricted_products;
}

// Hide specific products from search and shop pages based on user role
add_action('woocommerce_product_query', 'restrict_product_by_user_role');
function restrict_product_by_user_role($query)
{
    if (is_admin() || current_user_can('administrator')) {
        return; // Allow admins and backend access
    }

    if (is_user_logged_in() && current_user_can('customer')) {
        $restricted_products = get_restricted_products();

        // Exclude restricted products from the query
        if (!empty($restricted_products)) {
            $query->set('post__not_in', $restricted_products);
        }
    }
}

// Redirect unauthorized users away from restricted single product pages
add_action('template_redirect', 'restrict_single_product_access');
function restrict_single_product_access()
{
    if (is_singular('product') && !current_user_can('administrator')) {
        $restricted_products = get_restricted_products();

        // Redirect if the current product is restricted
        global $post;
        if (in_array($post->ID, $restricted_products) && current_user_can('customer')) {
            wp_redirect(home_url());
            exit;
        }
    }
}


// function hide_products_for_user_roles( $query ) {
//     if ( ! is_admin() && $query->is_main_query() ) {
//         // Check if the user is logged in
//         if ( is_user_logged_in() ) {
//             $user = wp_get_current_user();
//             // Define an array of user roles to hide products for
//             $restricted_roles = array( 'customer', 'dealer', 'supplier' ); // Add roles as needed
//             // Check if the user has one of the restricted roles
//             if ( array_intersect( $restricted_roles, (array) $user->roles ) ) {
//                 // Hide products for users with the restricted roles
//                 $query->set( 'post__in', array(3806) );
//             }
//         } else {
//             // If the user is not logged in, hide all products
//             $query->set( 'post__in', array(3806) );
//         }
//     }
// }
// add_action( 'pre_get_posts', 'hide_products_for_user_roles' );



function restrict_add_to_cart_for_roles($passed, $product_id, $quantity)
{
    // Check if the product has the 'proline' tag
    if (has_term('proline', 'product_tag', $product_id)) {
        // Check if the user is logged in
        if (is_user_logged_in()) {
            // Get the current user's roles
            $user = wp_get_current_user();
            $allowed_role = '1.4G PROLINE'; // Set the role that is allowed to purchase

            // Check if the user does NOT have the required role
            if (!in_array($allowed_role, (array) $user->roles)) {
                // Prevent adding the product to the cart
                wc_add_notice(__('You must be a Proline Customer to purchase this product.', 'woocommerce'), 'error');
                return false; // Block the add-to-cart request
            }
        } else {
            // If the user is not logged in (guest), block the add-to-cart request
            wc_add_notice(__('Guests are not allowed to purchase Proline products. Please log in as a Proline Customer.', 'woocommerce'), 'error');
            return false;
        }
    }

    return $passed; // Allow the add-to-cart request if conditions are met
}
add_filter('woocommerce_add_to_cart_validation', 'restrict_add_to_cart_for_roles', 10, 3);





// if(is_single('product')){
//     function fix_product_description_spacing() {
//         $args = array(
//             'post_type'      => 'product',
//             'posts_per_page' => -1,
//         );
//         $products = get_posts($args);
    
//         foreach ($products as $product) {
//             $description = $product->post_content;
    
//             // Add a space after periods if missing
//             $fixed_description = preg_replace('/\.(?!\s|\n)/', '. ', $description);
    
//             // Update the product with the corrected description
//             wp_update_post(array(
//                 'ID'           => $product->ID,
//                 'post_content' => $fixed_description,
//             ));
//         }
//     }
//     add_action('init', 'fix_product_description_spacing');
// }


add_action('init', 'register_custom_order_statuses');

function register_custom_order_statuses() {
    $statuses = [
        'pending' => 'Pending',
        'awaiting-payment' => 'Awaiting Payment',
        'awaiting-fulfillment' => 'Awaiting Fulfillment',
        'printed' => 'Printed',
        'packed' => 'PACKED',
        'partially-shipped' => 'Partially Shipped',
        'completed' => 'Completed',
        'shipped' => 'Shipped',
        'canceled' => 'Canceled',
        'declined' => 'Declined',
        'refunded' => 'Refunded',
        'in-store-pickup' => 'In-Store Pickup',
        'manual-verification-required' => 'Manual Verification Required',
        'partially-refunded' => 'Partially Refunded',
    ];

    foreach ($statuses as $slug => $label) {
        register_post_status('wc-' . $slug, array(
            'label'                     => _x($label, 'Order status', 'textdomain'),
            'public'                    => true,
            'exclude_from_search'       => false,
            'show_in_admin_all_list'    => true,
            'show_in_admin_status_list' => true,
            'label_count'               => _n_noop("$label (%s)", "$label (%s)", 'textdomain'),
        ));
    }
}

add_filter('wc_order_statuses', 'add_custom_order_statuses');

function add_custom_order_statuses($order_statuses) {
    $new_statuses = array();

    // Custom statuses
    $custom_statuses = [
        'wc-pending' => _x('Pending', 'Order status', 'textdomain'),
        'wc-awaiting-payment' => _x('Awaiting Payment', 'Order status', 'textdomain'),
        'wc-awaiting-fulfillment' => _x('Awaiting Fulfillment', 'Order status', 'textdomain'),
        'wc-printed' => _x('Printed', 'Order status', 'textdomain'),
        'wc-packed' => _x('PACKED', 'Order status', 'textdomain'),
        'wc-partially-shipped' => _x('Partially Shipped', 'Order status', 'textdomain'),
        'wc-completed' => _x('Completed', 'Order status', 'textdomain'),
        'wc-shipped' => _x('Shipped', 'Order status', 'textdomain'),
        'wc-canceled' => _x('Canceled', 'Order status', 'textdomain'),
        'wc-declined' => _x('Declined', 'Order status', 'textdomain'),
        'wc-refunded' => _x('Refunded', 'Order status', 'textdomain'),
        'wc-in-store-pickup' => _x('In-Store Pickup', 'Order status', 'textdomain'),
        'wc-manual-verification-required' => _x('Manual Verification Required', 'Order status', 'textdomain'),
        'wc-partially-refunded' => _x('Partially Refunded', 'Order status', 'textdomain'),
    ];

    // Insert custom statuses after 'Processing'
    foreach ($order_statuses as $key => $status) {
        $new_statuses[$key] = $status;

        if ('wc-processing' === $key) {
            $new_statuses = array_merge($new_statuses, $custom_statuses);
        }
    }

    return $new_statuses;
}

