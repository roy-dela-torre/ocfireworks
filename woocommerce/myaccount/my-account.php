<?php

/**
 * My Account page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/my-account.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://woo.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.5.0
 */

defined('ABSPATH') || exit;

/**
 * My Account navigation.
 *
 * @since 2.6.0
 */
do_action('woocommerce_account_navigation'); ?>

<div class="col-lg-9 col-md-12 ps-lg-5">
    <?php
    $current_url = wc_get_page_permalink('myaccount');
    $current_path = str_replace(home_url(), '', esc_url_raw(add_query_arg(null, null)));

    // Check if the current page is the billing or shipping edit page
    if (strpos($current_path, '/edit-address/billing') !== false) {
        // We are on the billing address edit page
    ?>
        <a href="<?php echo get_home_url(); ?>/account/edit-address/" rel="noopener noreferrer" class="red_text back_to_billing_shipping">
            <svg width="26" height="21" viewBox="0 0 26 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M1.99652 8.14898L0.998262 9.15849L0 8.14898L0.998262 7.13946L1.99652 8.14898ZM26 19.5721C26 19.9508 25.8512 20.314 25.5864 20.5818C25.3216 20.8496 24.9625 21 24.588 21C24.2136 21 23.8544 20.8496 23.5896 20.5818C23.3248 20.314 23.1761 19.9508 23.1761 19.5721H26ZM8.05811 16.298L0.998262 9.15849L2.99479 7.13946L10.0546 14.2789L8.05811 16.298ZM0.998262 7.13946L8.05811 0L10.0546 2.01904L2.99479 9.15849L0.998262 7.13946ZM1.99652 6.72109H16.1162V9.57687H1.99652V6.72109ZM26 16.7163V19.5721H23.1761V16.7163H26ZM16.1162 6.72109C18.7376 6.72109 21.2515 7.77415 23.1051 9.64862C24.9587 11.5231 26 14.0654 26 16.7163H23.1761C23.1761 14.8228 22.4323 13.0069 21.1083 11.668C19.7843 10.3291 17.9886 9.57687 16.1162 9.57687V6.72109Z" fill="#BF2126" />
            </svg>
            Shipping and Billing address
        </a>
        <style>
            section.my_account .woocommerce-MyAccount-content {
                margin-top: 0;
            }

            section.my_account a.back_to_billing_shipping {
                display: flex;
                align-items: center;
                gap: 0 16px;
                color: #BF2126;
                font-family: "Roboto Condensed", sans-serif;
                font-size: 18px;
                font-stretch: condensed;
                font-style: normal;
                font-weight: 700;
                line-height: normal;
                text-transform: uppercase;
                margin: 183px 0 20px 0;
            }
            @media (max-width: 991px) {
                section.my_account a.back_to_billing_shipping{
                    margin-top: 0;
                }
            }
        </style>
    <?php
    } elseif (strpos($current_path, '/edit-address/shipping') !== false) {
        // We are on the shipping address edit page
    ?>
        <a href="<?php echo get_home_url(); ?>/account/edit-address/" rel="noopener noreferrer" class="red_text back_to_billing_shipping">
            <svg width="26" height="21" viewBox="0 0 26 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M1.99652 8.14898L0.998262 9.15849L0 8.14898L0.998262 7.13946L1.99652 8.14898ZM26 19.5721C26 19.9508 25.8512 20.314 25.5864 20.5818C25.3216 20.8496 24.9625 21 24.588 21C24.2136 21 23.8544 20.8496 23.5896 20.5818C23.3248 20.314 23.1761 19.9508 23.1761 19.5721H26ZM8.05811 16.298L0.998262 9.15849L2.99479 7.13946L10.0546 14.2789L8.05811 16.298ZM0.998262 7.13946L8.05811 0L10.0546 2.01904L2.99479 9.15849L0.998262 7.13946ZM1.99652 6.72109H16.1162V9.57687H1.99652V6.72109ZM26 16.7163V19.5721H23.1761V16.7163H26ZM16.1162 6.72109C18.7376 6.72109 21.2515 7.77415 23.1051 9.64862C24.9587 11.5231 26 14.0654 26 16.7163H23.1761C23.1761 14.8228 22.4323 13.0069 21.1083 11.668C19.7843 10.3291 17.9886 9.57687 16.1162 9.57687V6.72109Z" fill="#BF2126" />
            </svg>
            Shipping and Billing address
        </a>
        <style>
            section.my_account .woocommerce-MyAccount-content {
                margin-top: 0;
            }

            section.my_account a.back_to_billing_shipping {
                display: flex;
                align-items: center;
                gap: 0 16px;
                color: #BF2126;
                font-family: "Roboto Condensed", sans-serif;
                font-size: 18px;
                font-stretch: condensed;
                font-style: normal;
                font-weight: 700;
                line-height: normal;
                text-transform: uppercase;
                margin: 183px 0 20px 0;
            }

            @media (max-width: 991px) {
                section.my_account a.back_to_billing_shipping{
                    margin-top: 0;
                }
            }
        </style>
    <?php
    } elseif (strpos($current_path, '/account/view-order/') !== false) { ?>
        <a href="<?php echo get_home_url(); ?>/account/orders/" rel="noopener noreferrer" class="red_text font-weight-700 back_to_order_status">
            <svg width="26" height="21" viewBox="0 0 26 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M1.99652 8.14898L0.998262 9.15849L0 8.14898L0.998262 7.13946L1.99652 8.14898ZM26 19.5721C26 19.9508 25.8512 20.314 25.5864 20.5818C25.3216 20.8496 24.9625 21 24.588 21C24.2136 21 23.8544 20.8496 23.5896 20.5818C23.3248 20.314 23.1761 19.9508 23.1761 19.5721H26ZM8.05811 16.298L0.998262 9.15849L2.99479 7.13946L10.0546 14.2789L8.05811 16.298ZM0.998262 7.13946L8.05811 0L10.0546 2.01904L2.99479 9.15849L0.998262 7.13946ZM1.99652 6.72109H16.1162V9.57687H1.99652V6.72109ZM26 16.7163V19.5721H23.1761V16.7163H26ZM16.1162 6.72109C18.7376 6.72109 21.2515 7.77415 23.1051 9.64862C24.9587 11.5231 26 14.0654 26 16.7163H23.1761C23.1761 14.8228 22.4323 13.0069 21.1083 11.668C19.7843 10.3291 17.9886 9.57687 16.1162 9.57687V6.72109Z" fill="#BF2126" />
            </svg>
            Back to Order status
        </a>
        <?php
        // Get the current order ID from the query var (for view-order pages).
        $order_id = get_query_var('order-received') ?: get_query_var('view-order');

        if ($order_id) {
            $order = wc_get_order($order_id); // Get the order object using the order ID.

            // Retrieve order number and date.
            $order_number = $order->get_order_number();
            $order_date = wc_format_datetime($order->get_date_created(), 'F j, Y g:iA');
        ?>

            <p class="order_number">ORDER: <span class="order_numbers"><?php echo esc_html($order_number); ?></span></p>
            <p class="date">Placed on <?php echo esc_html($order_date); ?></p>

        <?php
        } else {
            // Optional: Handle case where order ID isn't found.
            echo '<p>Order not found.</p>';
        }
        ?>

    <?php }
    ?>
    <div class="woocommerce-MyAccount-content <?php echo sanitize_html_class(WC()->query->get_current_endpoint()); ?>">
        <?php
        /**
         * My Account content.
         *
         * @since 2.6.0
         */
        do_action('woocommerce_account_content');
        ?>
    </div>
</div>