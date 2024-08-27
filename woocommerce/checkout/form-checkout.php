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
                    <?php do_action('woocommerce_checkout_payment_hook') ?>
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
        <div class="note">
            <div class="d-flex">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                    <g clip-path="url(#clip0_1812_65941)">
                        <path d="M11.812 0C5.289 0 0 5.289 0 11.812C0 18.335 5.289 23.625 11.812 23.625C18.335 23.625 23.625 18.335 23.625 11.812C23.625 5.289 18.335 0 11.812 0ZM14.271 18.307C13.663 18.547 13.179 18.729 12.816 18.855C12.454 18.981 12.033 19.044 11.554 19.044C10.818 19.044 10.245 18.864 9.837 18.505C9.429 18.146 9.226 17.691 9.226 17.138C9.226 16.923 9.241 16.703 9.271 16.479C9.302 16.255 9.351 16.003 9.418 15.72L10.179 13.032C10.246 12.774 10.304 12.529 10.35 12.301C10.396 12.071 10.418 11.86 10.418 11.668C10.418 11.326 10.347 11.086 10.206 10.951C10.063 10.816 9.794 10.75 9.393 10.75C9.197 10.75 8.995 10.779 8.788 10.84C8.583 10.903 8.405 10.96 8.259 11.016L8.46 10.188C8.958 9.985 9.435 9.811 9.89 9.667C10.345 9.521 10.775 9.449 11.18 9.449C11.911 9.449 12.475 9.627 12.872 9.979C13.267 10.332 13.466 10.791 13.466 11.355C13.466 11.472 13.452 11.678 13.425 11.972C13.398 12.267 13.347 12.536 13.273 12.783L12.516 15.463C12.454 15.678 12.399 15.924 12.349 16.199C12.3 16.474 12.276 16.684 12.276 16.825C12.276 17.181 12.355 17.424 12.515 17.553C12.673 17.682 12.95 17.747 13.342 17.747C13.527 17.747 13.734 17.714 13.968 17.65C14.2 17.586 14.368 17.529 14.474 17.48L14.271 18.307ZM14.137 7.429C13.784 7.757 13.359 7.921 12.862 7.921C12.366 7.921 11.938 7.757 11.582 7.429C11.228 7.101 11.049 6.702 11.049 6.236C11.049 5.771 11.229 5.371 11.582 5.04C11.938 4.708 12.366 4.543 12.862 4.543C13.359 4.543 13.785 4.708 14.137 5.04C14.49 5.371 14.667 5.771 14.667 6.236C14.667 6.703 14.49 7.101 14.137 7.429Z" fill="#030104" />
                    </g>
                    <defs>
                        <clipPath id="clip0_1812_65941">
                            <rect width="23.625" height="23.625" fill="white" />
                        </clipPath>
                    </defs>
                </svg>
                <p><b>Morem ipsum dolor sit amet consectetur </b></p>
            </div>
            <p>Horem (we do not ship explanations, reminders or warnings) elit. Nunc vulputate libero et velit interdum, ac aliquet odio mattis. Class aptent taciti... <span class="red_text">See More</span></p>
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