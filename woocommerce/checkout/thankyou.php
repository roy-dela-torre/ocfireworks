<?php
/**
 * Thankyou page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/thankyou.php.
 *
 * @see https://woo.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 8.1.0
 *
 * @var WC_Order $order
 */

defined( 'ABSPATH' ) || exit;
?>

<div class="woocommerce-order">

    <?php
    if ( $order ) :

        do_action( 'woocommerce_before_thankyou', $order->get_id() );
        ?>

        <?php if ( $order->has_status( 'failed' ) ) : ?>

            <p class="woocommerce-notice woocommerce-notice--error woocommerce-thankyou-order-failed"><?php esc_html_e( 'Unfortunately your order cannot be processed as the originating bank/merchant has declined your transaction. Please attempt your purchase again.', 'woocommerce' ); ?></p>

            <p class="woocommerce-notice woocommerce-notice--error woocommerce-thankyou-order-failed-actions">
                <a href="<?php echo esc_url( $order->get_checkout_payment_url() ); ?>" class="button pay"><?php esc_html_e( 'Pay', 'woocommerce' ); ?></a>
                <?php if ( is_user_logged_in() ) : ?>
                    <a href="<?php echo esc_url( wc_get_page_permalink( 'myaccount' ) ); ?>" class="button pay"><?php esc_html_e( 'My account', 'woocommerce' ); ?></a>
                <?php endif; ?>
            </p>

        <?php else : ?>

            <?php wc_get_template( 'checkout/order-received.php', array( 'order' => $order ) ); ?>

            <ul class="woocommerce-order-overview woocommerce-thankyou-order-details order_details">

                <li class="woocommerce-order-overview__order order">
                    <?php esc_html_e( 'Order number:', 'woocommerce' ); ?>
                    <strong><?php echo $order->get_order_number(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></strong>
                </li>

                <li class="woocommerce-order-overview__date date">
                    <?php esc_html_e( 'Date:', 'woocommerce' ); ?>
                    <strong><?php echo wc_format_datetime( $order->get_date_created() ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></strong>
                </li>

                <?php if ( is_user_logged_in() && $order->get_user_id() === get_current_user_id() && $order->get_billing_email() ) : ?>
                    <li class="woocommerce-order-overview__email email">
                        <?php esc_html_e( 'Email:', 'woocommerce' ); ?>
                        <strong><?php echo $order->get_billing_email(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></strong>
                    </li>
                <?php endif; ?>

                <li class="woocommerce-order-overview__total total">
                    <?php esc_html_e( 'Total:', 'woocommerce' ); ?>
                    <strong><?php echo $order->get_formatted_order_total(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></strong>
                </li>

                <?php if ( $order->get_payment_method_title() ) : ?>
                    <li class="woocommerce-order-overview__payment-method method">
                        <?php esc_html_e( 'Payment method:', 'woocommerce' ); ?>
                        <strong><?php echo wp_kses_post( $order->get_payment_method_title() ); ?></strong>
                    </li>
                <?php endif; ?>

            </ul>

        <?php endif; ?>

        <?php do_action( 'woocommerce_thankyou_' . $order->get_payment_method(), $order->get_id() ); ?>
        <?php do_action( 'woocommerce_thankyou', $order->get_id() ); ?>

    <?php else : ?>

        <?php wc_get_template( 'checkout/order-received.php', array( 'order' => false ) ); ?>

    <?php endif; ?>

</div>

<?php
$current_user = wp_get_current_user();
if ($order) :
    // Get the Customer ID (User ID)
    $customer_id = $order->get_customer_id(); // Or $order->get_user_id();

    // Get the WP_User Object instance
    $user = $order->get_user();

    // Get the WP_User roles and capabilities
    $user_roles = $user->roles;

    // Get the Customer billing email
    $billing_email  = $order->get_billing_email();

    // Get the Customer billing phone
    $billing_phone  = $order->get_billing_phone();

    // Customer billing information details
    $billing_first_name = $order->get_billing_first_name();
    $billing_last_name  = $order->get_billing_last_name();
    $billing_company    = $order->get_billing_company();
    $billing_address_1  = $order->get_billing_address_1();
    $billing_address_2  = $order->get_billing_address_2();
    $billing_city       = $order->get_billing_city();
    $billing_state      = $order->get_billing_state();
    $billing_postcode   = $order->get_billing_postcode();
    $billing_country    = $order->get_billing_country();

    // Customer shipping information details

    $shipping_first_name = $order->get_shipping_first_name();
    $shipping_last_name  = $order->get_shipping_last_name();
    $shipping_company    = $order->get_shipping_company();
    $shipping_address_1  = $order->get_shipping_address_1();
    $shipping_address_2  = $order->get_shipping_address_2();
    $shipping_city       = $order->get_shipping_city();
    $shipping_state      = $order->get_shipping_state();
    $shipping_postcode   = $order->get_shipping_postcode();
    $shipping_country    = $order->get_shipping_country();
    ?>

    <div class="col-xl-8">
        <div class="content">
            <h1>Thank you <?php echo esc_attr($current_user->first_name); ?> <?php echo esc_attr($current_user->last_name); ?>!</h1>
            <p>Your order number is <span class="order_id"><?php echo $order->get_order_number(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span></p>
            <p>An email will be sent containing information about your purchase. If you have any questions about your purchase, email us at <a href="mailto:sales@ocfireworks.com" class="red_text">sales@ocfireworks.com</a> or call us at <a href="tel:+574-743-8164" class="red_text">574-743-8164</a></p>
        </div>
        <div class="location">
            <iframe class="w-100" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2979.81454097319!2d-86.12738829999999!3d41.6813486!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8816cfced1933acd%3A0xdf1e5c9119ca9b1e!2s13421%20McKinley%20Hwy%2C%20Mishawaka%2C%20IN%2046545%2C%20USA!5e0!3m2!1sen!2sph!4v1713774385763!5m2!1sen!2sph" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
		<h4>Qorem ipsum dolor sit </h4>
        <div class="user_info">
            <div class="user_order_info">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="contact_info">
                            <h4>Contact Details:</h4>
                            <p class="name"><?php echo esc_attr($current_user->first_name); ?> <?php echo esc_attr($current_user->last_name); ?></p>
                            <p class="email"><?php echo esc_html($billing_email); ?></p>
                            <p class="number"><?php echo esc_html($billing_phone); ?></p>
                        </div>
                    </div>
                    <div class="col-lg-6">
                    <div class="shipping_address">
                        <h4>Shipping address</h4>
                        <?php
                        $get_addresses = apply_filters(
                            'woocommerce_my_account_get_addresses',
                            array(
                                // 'billing'  => __( 'Billing address', 'woocommerce' ),
                                'shipping' => __( 'Shipping address', 'woocommerce' ),
                            ),
                            $customer_id
                        );
                        ?>
                        <?php foreach ($get_addresses as $name => $address_title) : ?>
                            <?php
                            $address = wc_get_account_formatted_address($name);
                            ?>

                            <div class="col-md-12 u-column woocommerce-Address">
                                <header class="woocommerce-Address-title title">
                                    <address>
                                        <?php
                                        if ($address) {
                                            // Convert the formatted address string into an array by splitting on <br> tags
                                            $address_parts = explode('<br>', $address);
                                            foreach ($address_parts as $part) {
                                                ?>
                                                <p><?php echo $part; ?></p>
                                                <?php
                                            }
                                        } else {
                                            echo esc_html_e('You have not set up this type of address yet.', 'woocommerce');
                                        }
                                        ?>
                                    </address>
                                </header>
                            </div>


                        <?php endforeach; ?>
                    </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="payment_method">
            <div class="row">
                <div class="col-lg-6">
                    <div class="payment_use">
                        <h4>Payment Method</h4>
                        <p><?php echo wp_kses_post($order->get_payment_method_title()); ?></p>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="billing_address">
                        <h4>Billing address</h4>
                        <p><?php echo esc_html($billing_first_name . ' ' . $billing_last_name); ?></p>
                        <p><?php echo esc_html($billing_company); ?></p>
                        <p><?php echo esc_html($billing_address_1); ?></p>
                        <?php if ($billing_address_2) : ?>
                            <p><?php echo esc_html($billing_address_2); ?></p>
                        <?php endif; ?>
                        <p><?php echo esc_html($billing_city . ', ' . $billing_state . ' ' . $billing_postcode); ?></p>
                        <p><?php echo esc_html($billing_country); ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>
