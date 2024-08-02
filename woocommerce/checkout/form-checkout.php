<?php
if (!defined('ABSPATH')) {
    exit;
}

$name = $checkout->get_value('billing_first_name');
$last_name = $checkout->get_value('billing_last_name');
$full_name = $name . ' ' . $last_name;
$phone_number = $checkout->get_value('billing_phone');
$email = $checkout->get_value('billing_email');

$company_name = $checkout->get_value('billing_company');
$country = $checkout->get_value('billing_country');
$address = $checkout->get_value('billing_address_1');
$state = $checkout->get_value('billing_state');
$zip_code = $checkout->get_value('billing_postcode');
$city = $checkout->get_value('billing_city');

do_action('woocommerce_before_checkout_form', $checkout);

if (!$checkout->is_registration_enabled() && $checkout->is_registration_required() && !is_user_logged_in()) {
    echo esc_html(apply_filters('woocommerce_checkout_must_be_logged_in_message', __('You must be logged in to checkout.', 'woocommerce')));
    return;
}

?>

<form name="checkout" method="post" class="row checkout woocommerce-checkout" action="<?php echo esc_url(wc_get_checkout_url()); ?>" enctype="multipart/form-data">

    <div class="col-lg-8">
        <div class="order_detail">
            <?php if ($checkout->get_checkout_fields()) : ?>

                <?php do_action('woocommerce_checkout_before_customer_details'); ?>

                <div class="col2-set" id="customer_details">
                    <div class="woocommerce_checkout_billing">
                        <?php do_action('woocommerce_checkout_billing'); ?>
                    </div>

                    <div class="woocommerce_checkout_shipping">
                        <?php do_action('woocommerce_checkout_shipping'); ?>
                    </div>
                </div>

                <div class="payment_method">
                    <h4>Payment method</h4>
                    <?php do_action( 'woocommerce_checkout_payment_hook' ) ?>
                </div>

                <?php do_action('woocommerce_checkout_after_customer_details'); ?>

            <?php endif; ?>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="order_summary">
            <?php do_action('woocommerce_checkout_before_order_review_heading'); ?>
            <h3 id="order_review_heading" class="red_text"><?php esc_html_e('Cart total:', 'woocommerce'); ?></h3>
            <?php do_action('woocommerce_checkout_before_order_review'); ?>
            <div id="order_review" class="woocommerce-checkout-review-order">
                <?php do_action('woocommerce_checkout_order_review'); ?>
            </div>
            <?php do_action('woocommerce_checkout_after_order_review'); ?>
        </div>
    </div>

    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <?php do_action('woocommerce_checkout_shipping'); ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="save_changes">Save changes</button>
                </div>
            </div>
        </div>
    </div>
</form>

<?php do_action('woocommerce_after_checkout_form', $checkout); ?>

<script>
    jQuery(document).ready(function($) {
        $('form.checkout').on('submit', function(e) {
            var hasErrors = false;

            var billingFields = [
                'billing_first_name',
                'billing_last_name',
                'billing_country',
                'billing_address_1',
                'billing_city',
                'billing_state',
                'billing_postcode',
                'billing_phone',
                'billing_email'
            ];

            billingFields.forEach(function(field) {
                var fieldValue = $('#' + field).val();
                if (!fieldValue) {
                    hasErrors = true;
                    $('#' + field).addClass('woocommerce-invalid woocommerce-invalid-required-field');
                } else {
                    $('#' + field).removeClass('woocommerce-invalid woocommerce-invalid-required-field');
                }
            });

            if (hasErrors) {
                e.preventDefault();
                alert('Please fill in all required billing fields.');
            }
        });
    });
</script>