<?php

/**
 * Checkout Form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-checkout.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.5.0
 */

if (! defined('ABSPATH')) {
    exit;
} ?>

<section class="checkout">
    <div class="wrapper">
        <div class="container-fluid">
            <?php do_action('woocommerce_before_checkout_form', $checkout);

            // If checkout registration is disabled and not logged in, the user cannot checkout.
            if (!$checkout->is_registration_enabled() && $checkout->is_registration_required() && !is_user_logged_in()) {
                echo esc_html(apply_filters('woocommerce_checkout_must_be_logged_in_message', __('You must be logged in to checkout.', 'woocommerce')));
                return;
            }
            ?>
            <div class="header">
                <h1 class="red_text mb-0">Checkout</h1>
                <p>Vorem ipsum dolor sit amet consectetur adipiscing elit.</p>
            </div>
            <form name="checkout" method="post" class="checkout woocommerce-checkout row" action="<?php echo esc_url(wc_get_checkout_url()); ?>" enctype="multipart/form-data">
                <div class="col-lg-8 pe-lg-5">
                    <div class="order_detail">
                        <?php if ($checkout->get_checkout_fields()) : ?>

                            <?php do_action('woocommerce_checkout_before_customer_details'); ?>

                            <div class="customer_details_billing" id="customer_details">
                                <div class="billing_form">
                                    <?php do_action('woocommerce_checkout_billing'); ?>
                                </div>

                                <div class="shipping_form">
                                    <?php do_action('woocommerce_checkout_shipping'); ?>
                                </div>
                            </div>

                            <div class="payment_method">
                                <h4>Payment</h4>
                                <?php do_action('woocommerce_checkout_payment_hook') ?>

                            </div>

                            <?php do_action('woocommerce_checkout_after_customer_details'); ?>

                        <?php endif; ?>

                        <?php do_action('woocommerce_checkout_before_order_review_heading'); ?>
                    </div>
                </div>

                <div class="col-lg-4"> <!-- Open the col-lg-4 div here -->
                    <div class="order_summary">
                        <div class="header d-flex align-items-center justify-content-between">
                            <h3 class="text-uppercase red_text mb-0">Cart total:</h3>
                            <a href="<?php echo get_home_url(); ?>/cart/">
                                <svg width="18" height="19" viewBox="0 0 18 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M-0.00195312 14.751V18.501H3.74805L14.808 7.44098L11.058 3.69098L-0.00195312 14.751ZM17.708 4.54098C17.8007 4.44847 17.8743 4.33858 17.9245 4.2176C17.9747 4.09663 18.0005 3.96695 18.0005 3.83598C18.0005 3.70501 17.9747 3.57533 17.9245 3.45436C17.8743 3.33338 17.8007 3.22349 17.708 3.13098L15.368 0.790979C15.2755 0.698276 15.1656 0.624728 15.0447 0.574547C14.9237 0.524365 14.794 0.498535 14.663 0.498535C14.5321 0.498535 14.4024 0.524365 14.2814 0.574547C14.1604 0.624728 14.0506 0.698276 13.958 0.790979L12.128 2.62098L15.878 6.37098L17.708 4.54098Z" fill="#BF2126" />
                                </svg>
                            </a>
                        </div>

                        <?php do_action('woocommerce_checkout_before_order_review'); ?>

                        <div id="order_review" class="woocommerce-checkout-review-order">
                            <?php do_action('woocommerce_checkout_order_review'); ?>
                        </div>
                    </div>

                    <div class="order_summary_notes">
                        <div class="d-flex">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <g clip-path="url(#clip0_7013_67836)">
                                    <path d="M11.812 0C5.289 0 0 5.289 0 11.812C0 18.335 5.289 23.625 11.812 23.625C18.335 23.625 23.625 18.335 23.625 11.812C23.625 5.289 18.335 0 11.812 0ZM14.271 18.307C13.663 18.547 13.179 18.729 12.816 18.855C12.454 18.981 12.033 19.044 11.554 19.044C10.818 19.044 10.245 18.864 9.837 18.505C9.429 18.146 9.226 17.691 9.226 17.138C9.226 16.923 9.241 16.703 9.271 16.479C9.302 16.255 9.351 16.003 9.418 15.72L10.179 13.032C10.246 12.774 10.304 12.529 10.35 12.301C10.396 12.071 10.418 11.86 10.418 11.668C10.418 11.326 10.347 11.086 10.206 10.951C10.063 10.816 9.794 10.75 9.393 10.75C9.197 10.75 8.995 10.779 8.788 10.84C8.583 10.903 8.405 10.96 8.259 11.016L8.46 10.188C8.958 9.985 9.435 9.811 9.89 9.667C10.345 9.521 10.775 9.449 11.18 9.449C11.911 9.449 12.475 9.627 12.872 9.979C13.267 10.332 13.466 10.791 13.466 11.355C13.466 11.472 13.452 11.678 13.425 11.972C13.398 12.267 13.347 12.536 13.273 12.783L12.516 15.463C12.454 15.678 12.399 15.924 12.349 16.199C12.3 16.474 12.276 16.684 12.276 16.825C12.276 17.181 12.355 17.424 12.515 17.553C12.673 17.682 12.95 17.747 13.342 17.747C13.527 17.747 13.734 17.714 13.968 17.65C14.2 17.586 14.368 17.529 14.474 17.48L14.271 18.307ZM14.137 7.429C13.784 7.757 13.359 7.921 12.862 7.921C12.366 7.921 11.938 7.757 11.582 7.429C11.228 7.101 11.049 6.702 11.049 6.236C11.049 5.771 11.229 5.371 11.582 5.04C11.938 4.708 12.366 4.543 12.862 4.543C13.359 4.543 13.785 4.708 14.137 5.04C14.49 5.371 14.667 5.771 14.667 6.236C14.667 6.703 14.49 7.101 14.137 7.429Z" fill="#030104" />
                                </g>
                                <defs>
                                    <clipPath id="clip0_7013_67836">
                                        <rect width="23.625" height="23.625" fill="white" />
                                    </clipPath>
                                </defs>
                            </svg>
                            <span>Morem ipsum dolor sit amet consectetur </span>
                        </div>
                        <p>Horem (we do not ship explanations, reminders or warnings) elit. Nunc vulputate libero et velit interdum, ac aliquet odio mattis. Class aptent taciti... <span class="red_text">See More</span></p>
                    </div>
                </div>
                <?php do_action('woocommerce_checkout_after_order_review'); ?>
            </form>

            <?php do_action('woocommerce_after_checkout_form', $checkout); ?>
        </div>
    </div>
</section>