<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

$name = $checkout->get_value('billing_first_name');
$last_name = $checkout->get_value('billing_last_name');
$full_name = $name.' '.$last_name;
$phone_number = $checkout->get_value('billing_phone');
$email = $checkout->get_value('billing_email');

$company_name = $checkout->get_value('billing_company');
$country = $checkout->get_value('billing_country');
$address = $checkout->get_value('billing_address_1');
$state = $checkout->get_value('billing_state');
$zip_code = $checkout->get_value('billing_postcode');
$city = $checkout->get_value('billing_city');

do_action( 'woocommerce_before_checkout_form', $checkout );

if ( ! $checkout->is_registration_enabled() && $checkout->is_registration_required() && ! is_user_logged_in() ) {
    echo esc_html( apply_filters( 'woocommerce_checkout_must_be_logged_in_message', __( 'You must be logged in to checkout.', 'woocommerce' ) ) );
    return;
}

?>

<form name="checkout" method="post" class="row checkout woocommerce-checkout" action="<?php echo esc_url( wc_get_checkout_url() ); ?>" enctype="multipart/form-data">

    <div class="col-lg-8">
        <div class="order_detail">
            <?php if ( $checkout->get_checkout_fields() ) : ?>

            <?php do_action( 'woocommerce_checkout_before_customer_details' ); ?>

            <div class="customer_details" id="customer_details">
                <div class="customer_detail">
                    <h3>Customer</h3>
                    <div class="customer_detail_content">
                        <p class="name"><?php echo $full_name; ?></p>
                        <p class="email"><?php echo $email; ?></p>
                        <p class="phone_number"><?php echo $phone_number; ?></p>
                    </div>
                </div>
                <div class="shipping_address d-flex flex-column">
                    <h3>Shipping address</h3>
                    <div class="shipping_address_detail">
                        <p class="company_name"><?php echo $company_name; ?></p>
                        <p class="country"><?php echo $country; ?></p>
                        <p class="city"><?php echo $city; ?></p>
                        <p class="state"><?php echo $state; ?></p>
                        <p class="zip_code"><?php echo $zip_code; ?></p>
                    </div>
                </div>
                <button class="use_different_address" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                        <path d="M18 12.998H13V17.998C13 18.2633 12.8946 18.5176 12.7071 18.7052C12.5196 18.8927 12.2652 18.998 12 18.998C11.7348 18.998 11.4804 18.8927 11.2929 18.7052C11.1054 18.5176 11 18.2633 11 17.998V12.998H6C5.73478 12.998 5.48043 12.8927 5.29289 12.7052C5.10536 12.5176 5 12.2633 5 11.998C5 11.7328 5.10536 11.4785 5.29289 11.2909C5.48043 11.1034 5.73478 10.998 6 10.998H11V5.99805C11 5.73283 11.1054 5.47848 11.2929 5.29094C11.4804 5.1034 11.7348 4.99805 12 4.99805C12.2652 4.99805 12.5196 5.1034 12.7071 5.29094C12.8946 5.47848 13 5.73283 13 5.99805V10.998H18C18.2652 10.998 18.5196 11.1034 18.7071 11.2909C18.8946 11.4785 19 11.7328 19 11.998C19 12.2633 18.8946 12.5176 18.7071 12.7052C18.5196 12.8927 18.2652 12.998 18 12.998Z" fill="black"/>
                    </svg>
                    USE A different ADDRESS
                </button>
                <div class="payment_method">
                    <h4>Payment method</h4>
                    <?php do_action( 'woocommerce_checkout_payment_hook' ) ?>
                </div>
            </div>

            <?php do_action( 'woocommerce_checkout_after_customer_details' ); ?>

            <?php endif; ?>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="order_summary">
            <?php do_action( 'woocommerce_checkout_before_order_review_heading' ); ?>
            <h3 id="order_review_heading"><?php esc_html_e( 'Subtotal:', 'woocommerce' ); ?></h3>
            <?php do_action( 'woocommerce_checkout_before_order_review' ); ?>
            <div id="order_review" class="woocommerce-checkout-review-order">
                <?php do_action( 'woocommerce_checkout_order_review' ); ?>
            </div>
            <?php do_action( 'woocommerce_checkout_after_order_review' ); ?>
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
                    <?php do_action( 'woocommerce_checkout_shipping' ); ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="save_changes">Save changes</button>
                </div>
            </div>
        </div>
    </div>
</form>

<?php do_action( 'woocommerce_after_checkout_form', $checkout ); ?>

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
            var fieldValue = $('#'+field).val();
            if (!fieldValue) {
                hasErrors = true;
                $('#'+field).addClass('woocommerce-invalid woocommerce-invalid-required-field');
            } else {
                $('#'+field).removeClass('woocommerce-invalid woocommerce-invalid-required-field');
            }
        });

        if (hasErrors) {
            e.preventDefault();
            alert('Please fill in all required billing fields.');
        }
    });
});
</script>
