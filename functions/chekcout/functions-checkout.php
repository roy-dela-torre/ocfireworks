<?php
add_action('woocommerce_after_order_notes', 'custom_checkout_order_options');

function custom_checkout_order_options($checkout)
{
    echo '<h3>' . __('Order Options') . '</h3>';
    echo '<div class="woocommerce-checkbox-wrapper custom_checkout_order_options">';

    if (have_rows('order_option')) {
        while (have_rows('order_option')) {
            the_row();
            $title = get_sub_field('title');
            $description = get_sub_field('description');
            $amount = get_sub_field('amount');

            // Format title to lowercase and replace spaces with underscores
            $formatted_title = esc_attr(strtolower(str_replace(' ', '_', $title)));

            // Display each option as a checkbox
?>
            <div class="order-option">
                <input type="checkbox" class="input-checkbox" <?php echo ($title == "None" || $formatted_title == WC()->session->get('selected_shipping_option')) ? 'checked' : ''; ?> value="<?php echo $formatted_title; ?>"
                    name="order_additional_options[]" id="order_additional_options_<?php echo $formatted_title; ?>">
                <label for="order_additional_options_<?php echo $formatted_title; ?>" class="checkbox">
                    <b><?php echo esc_html($title); ?></b>
                    <?php if ($description) {
                        echo '(' . esc_html($description) . ') ';
                    } ?>
                    <b>(+$<?php echo esc_html($amount); ?>)</b>
                </label>
            </div>
    <?php
        }
    } else {
        echo '<p>' . __('No additional services available.') . '</p>';
    }

    echo '</div>';
}



add_action('wp_ajax_update_order_option', 'custom_order_options_update_order_meta');
add_action('wp_ajax_nopriv_update_order_option', 'custom_order_options_update_order_meta');

function custom_order_options_update_order_meta()
{
    if (!empty($_POST['order_additional_options'])) {
        WC()->session->set('order_additional_options', array_map('sanitize_text_field', $_POST['order_additional_options']));
    } else {
        WC()->session->set('order_additional_options', []);
    }
    wp_die();
}



add_action('woocommerce_cart_calculate_fees', 'custom_checkout_add_fees');

function custom_checkout_add_fees($cart)
{
    if (is_admin() && !defined('DOING_AJAX')) {
        return;
    }

    $selected_options = WC()->session->get('order_additional_options', []);
    $paymentinfo = WC()->session->get('paymentinfo', []);

    // Build payment info if not already set
    if (empty($paymentinfo) && have_rows('order_option')) {
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

    $additional_fee = 0;

    // Calculate total fee for all selected options
    if (!empty($selected_options)) {
        foreach ($selected_options as $option) {
            if (isset($paymentinfo[$option])) {
                $additional_fee += $paymentinfo[$option];
            }
        }
    }

    if ($additional_fee > 0) {
        $cart->add_fee(__('Additional Services', 'woocommerce'), $additional_fee);
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

add_filter('woocommerce_package_rates', 'apply_shipping_method_based_on_total', 10, 2);

function apply_shipping_method_based_on_total($rates, $package)
{
    // Set the minimum and maximum total for the shipping method to be applied
    $minimum_total = 200;
    $maximum_total = 500;
    $current_total = WC()->cart->get_subtotal(); // Get the cart total before taxes and shipping

    // Check if the cart total is between $200 and $500
    if ($current_total > $minimum_total && $current_total <= $maximum_total) {
        // Loop through the rates and set the specific shipping method's cost to zero if conditions are met
        foreach ($rates as $rate_id => $rate) {
            // Specify the method ID for "Haz Mat LTL Truck Freight IN" (replace with actual method ID)
            if ('3' === $rate->get_method_id()) {  // Replace '3' with the actual method ID for "Haz Mat LTL Truck Freight IN"
                $rate->set_cost(50); // Set the shipping cost to $50
                $rate->set_tax(0); // Optionally, set the tax to zero if needed
            }
        }
    } else {
        // Optionally, if the total is not in the range, set the shipping cost to zero
        foreach ($rates as $rate_id => $rate) {
            if ('3' === $rate->get_method_id()) {
                $rate->set_cost(0); // Set the shipping cost to zero when cart total is not in the range
                $rate->set_tax(0);
            }
        }
    }

    return $rates;
}

add_action('woocommerce_after_order_notes', 'custom_checkout_shipping_destination_options', 20);

function custom_checkout_shipping_destination_options($checkout)
{

    echo '<div class="woocommerce-checkbox-wrapper custom_checkout_shipping_destination_options row">';
    echo '<h3>' . __('Shipping Destination Options') . '</h3>'; ?>
    <p>Residential and Commercial No Cost Increase</p>
    <?php
    if (have_rows('shipping_destination')) {
        while (have_rows('shipping_destination')) {
            the_row();
            $title = get_sub_field('title');
            $description = get_sub_field('description');
            $amount = get_sub_field('amount');
            // Format title to lowercase and replace spaces with underscores
            $formatted_title = esc_attr(strtolower(str_replace(' ', '_', $title)));
    ?>

            <div class="<?php echo $title == "Residential" ? "col-lg-12" : "col-lg-6" ?>">
                <div class="shipping-destination-option">
                    <input type="radio" class="input-radio"
                        <?php echo ($title == "Residential" || $formatted_title == WC()->session->get('selected_shipping_option')) ? 'checked' : ''; ?>
                        value="<?php echo $formatted_title; ?>"
                        name="shipping_destination_options[]"
                        id="shipping_destination_options_<?php echo $formatted_title; ?>">

                    <label for="shipping_destination_options_<?php echo $formatted_title; ?>" class="radio">
                        <b><?php echo esc_html($title); ?></b>
                        <?php if ($description) {
                            echo '(' . esc_html($description) . ') ';
                        } ?>
                        <b>(+$<?php echo esc_html($amount); ?>)</b>
                    </label>
                </div>
            </div>
<?php
        }
    } else {
        echo '<p>' . __('No shipping destinations available.') . '</p>';
    }

    echo '</div>';
}
add_action('wp_ajax_update_shipping_destination', 'custom_shipping_destination_update_order_meta');
add_action('wp_ajax_nopriv_update_shipping_destination', 'custom_shipping_destination_update_order_meta');

function custom_shipping_destination_update_order_meta()
{
    if (!empty($_POST['shipping_destination_options'])) {
        WC()->session->set('shipping_destination_options', array_map('sanitize_text_field', $_POST['shipping_destination_options']));
    } else {
        WC()->session->set('shipping_destination_options', []);
    }
    wp_die();
}


add_action('woocommerce_cart_calculate_fees', 'custom_checkout_add_shipping_fees', 20, 1);

function custom_checkout_add_shipping_fees($cart)
{
    if (is_admin() && !defined('DOING_AJAX')) {
        return;
    }

    // Get selected shipping destination options from the session
    $selected_options = WC()->session->get('shipping_destination_options', []);

    // Initialize payment info for shipping destinations
    $paymentinfo = WC()->session->get('shipping_paymentinfo', []);

    // Build payment info if not already set
    if (empty($paymentinfo) && have_rows('shipping_destination')) {
        while (have_rows('shipping_destination')) {
            the_row();
            $title_fee = get_sub_field('title');
            $amount_fee = get_sub_field('amount');

            if ($title_fee && $amount_fee) {
                $formatted_title = esc_attr(strtolower(str_replace(' ', '_', $title_fee)));
                $paymentinfo[$formatted_title] = (float) $amount_fee; // Ensure amount is numeric
            }
        }
        WC()->session->set('shipping_paymentinfo', $paymentinfo); // Save shipping fees in session
    }

    $additional_fee = 0;

    // Calculate total fee for all selected options
    if (!empty($selected_options)) {
        foreach ($selected_options as $option) {
            if (isset($paymentinfo[$option])) {
                $additional_fee += $paymentinfo[$option];
            }
        }
    }

    // Add the fee to the cart if applicable
    if ($additional_fee > 0) {
        $cart->add_fee(__('Shipping Destination Fee', 'woocommerce'), $additional_fee);
    }
}


add_action('woocommerce_cart_calculate_fees', 'set_shipping_to_zero');

function set_shipping_to_zero($cart)
{
    // Check if this is an AJAX request to prevent infinite loops
    if (is_admin() && !defined('DOING_AJAX')) {
        return;
    }

    // Retrieve the custom shipping destination options from the session
    $selected_shipping_destination = WC()->session->get('shipping_destination_options', []);

    // Initialize additional shipping fee variable
    $additional_shipping_fee = 0;

    // If "Residential" or "Dock to Dock" is selected, set shipping to $0
    if (in_array('residential', $selected_shipping_destination) || in_array('dock_to_dock', $selected_shipping_destination)) {
        // Set the additional shipping fee to 0
        $additional_shipping_fee = 0;
    }
    // else {
    //     // If another option is selected, set the fee to 30 (or any other amount you want)
    //     $additional_shipping_fee = 30;
    // }

    // Apply the calculated fee
    if ($additional_shipping_fee > 0) {
        $cart->add_fee(__('Additional Shipping Fee', 'woocommerce'), $additional_shipping_fee);
    }

    // Loop through all the shipping packages and adjust shipping rates if necessary
    foreach (WC()->shipping->get_packages() as $package_index => $package) {
        foreach ($package['rates'] as $rate_id => $rate) {
            if (in_array('dock_to_dock', $selected_shipping_destination)) {
                // If Dock to Dock is selected, set shipping cost to 0
                if ($rate->method_id === 'flat_rate') {
                    $rate->set_cost(0);
                    $rate->set_tax(0);  // Optionally, set tax to zero if needed
                }
            }
        }
    }
}

// Update session when shipping destination options are changed (via AJAX)
add_action('wp_ajax_update_shipping_destination', 'update_shipping_destination_session');
add_action('wp_ajax_nopriv_update_shipping_destination', 'update_shipping_destination_session');

function update_shipping_destination_session()
{
    if (!empty($_POST['shipping_destination_options'])) {
        WC()->session->set('shipping_destination_options', array_map('sanitize_text_field', $_POST['shipping_destination_options']));
    } else {
        WC()->session->set('shipping_destination_options', []);
    }
    wp_die();
}


// addtional fee if product contain tag of hazmat 149.99
// Add an additional fee if the cart contains a product with the tag 'hazmat'
// add_action('woocommerce_cart_calculate_fees', 'add_hazmat_fee');

// function add_hazmat_fee($cart)
// {
//     if (is_admin() || !defined('WC_ABSPATH')) {
//         return;
//     }

//     $hazmat_fee = 149.99; // Fee amount
//     $has_hazmat = false;

//     // Loop through cart items to check for 'hazmat' tag
//     foreach ($cart->get_cart() as $cart_item) {
//         $product_id = $cart_item['product_id'];

//         // Check if the product has the 'hazmat' tag
//         if (has_term('hazmat', 'product_tag', $product_id)) {
//             $has_hazmat = true;
//             break;
//         }
//     }

//     // Add the fee if a product with 'hazmat' tag is found
//     if ($has_hazmat) {
//         $cart->add_fee(__('Hazmat Handling Fee', 'woocommerce'), $hazmat_fee);
//     }
// }



// Add the BOGO discount functionality during cart calculation
function apply_bogo_discount_in_cart_fees($cart)
{
    // Avoid applying the discount multiple times in the same session
    if (is_admin() && !defined('DOING_AJAX')) {
        return;
    }

    // Initialize variables for total discount
    $total_discount = 0;

    // Loop through all cart items
    foreach ($cart->get_cart() as $cart_item_key => $cart_item) {
        $product_id = $cart_item['product_id'];

        // Check if the product is assigned to the 'buy-1-get-1-free' term within the 'special-fireworks' taxonomy
        if (has_term('buy-1-get-1-free', 'special-fireworks', $product_id)) {
            $quantity = $cart_item['quantity'];

            // Calculate how many products are free
            if ($quantity >= 2) {
                $free_products = floor($quantity / 2); // Free products are half of the quantity, rounded down

                // Get the sale price or regular price of the product
                $product_data = $cart_item['data'];
                $price = $product_data->get_sale_price() ? $product_data->get_sale_price() : $product_data->get_regular_price();

                // Calculate the discount amount for the free products
                $discount_amount = $price * $free_products;

                // Add to the total discount
                $total_discount += $discount_amount;
            }
        }
    }

    // Apply the total discount as a negative fee to the cart
    if ($total_discount > 0) {
        $cart->add_fee(
            __('BOGO Discount', 'woocommerce'),
            -$total_discount
        );
    }
}

add_action('woocommerce_cart_calculate_fees', 'apply_bogo_discount_in_cart_fees');



function make_local_pickup_free($rates, $package)
{
    error_log('Shipping rates before modification: ' . print_r($rates, true));

    foreach ($rates as $rate_id => $rate) {
        if (strpos($rate_id, 'pickup_location') !== false) {
            $rates[$rate_id]->cost = 0;

            if (!empty($rates[$rate_id]->taxes)) {
                foreach ($rates[$rate_id]->taxes as $key => $tax) {
                    $rates[$rate_id]->taxes[$key] = 0;
                }
            }
        }
    }

    error_log('Shipping rates after modification: ' . print_r($rates, true));

    return $rates;
}
add_filter('woocommerce_package_rates', 'make_local_pickup_free', 10, 2);


function enqueue_shipping_update_script()
{
    if (is_checkout()) {
        wp_enqueue_script('update-shipping-totals', get_template_directory_uri() . '/js/update-shipping-totals.js', array('jquery'), null, true);
    }
}
add_action('wp_enqueue_scripts', 'enqueue_shipping_update_script');
