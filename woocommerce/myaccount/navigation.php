<?php

/**
 * My Account navigation
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/navigation.php.
 *
 * @see     https://woo.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 2.6.0
 */

if (! defined('ABSPATH')) {
    exit;
}

do_action('woocommerce_before_account_navigation');

$current_user = wp_get_current_user();
$gravatar_url = get_avatar_url($current_user->user_email, array('size' => 150));
?>

<div class="col-lg-3">
    <nav class="woocommerce-MyAccount-navigation d-none d-lg-block sticky-top">
        <div class="profile">
            <div class="image d-flex flex-column align-items-center position-relative">
                <img loading="lazy" src="<?php echo esc_url($gravatar_url); ?>" alt="Profile Image" class="mb-3 profile-image rounded-circle img-fluid" width="100" height="100">
                <p class="name text-center">Hi <?php echo esc_attr($current_user->first_name); ?> <?php echo esc_attr($current_user->last_name); ?></p>
                <a href="https://en.gravatar.com/" target="_blank" rel="noopener noreferrer" class="stretched-link"></a>
            </div>
        </div>
        <ul class="mb-0">
            <?php
            // Define the desired order of menu items
            $menu_order = array(
                'dashboard'         => __('Dashboard', 'woocommerce'),
                'edit-account'      => __('My Account', 'woocommerce'),
                'edit-address'      => __('Shipping and Billing address', 'woocommerce'),
                // 'payment-methods'   => __('Payment Methods', 'woocommerce'),
                'orders'            => __('Order History', 'woocommerce'),
                'recently-viewed'   => __('Recently Viewed', 'woocommerce'), // Added Recently Viewed tab
                // 'order-status'   => __('Order Status', 'woocommerce'),
                'news-letter'       => __('Newsletter', 'woocommerce'),
                'customer-logout'   => __('Log Out', 'woocommerce'),
            );


            // Loop through the menu items in the desired order
            foreach ($menu_order as $endpoint => $label) :
                // Check if the menu item exists
                if (wc_get_endpoint_url($endpoint, '', wc_get_page_permalink('myaccount'))) :
            ?>
                    <li class="<?php echo wc_get_account_menu_item_classes($endpoint); ?>">
                        <a href="<?php echo esc_url(wc_get_account_endpoint_url($endpoint)); ?>">
                            <?php echo esc_html($label); ?>
                            <?php if ($endpoint === 'customer-logout') : ?>
                                <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/my_account/log_out.png" alt="Log Out">
                            <?php endif; ?>
                        </a>
                    </li>
                <?php endif; ?>
            <?php endforeach; ?>
        </ul>
    </nav>
    <div class="d-block d-lg-none">
        <a class="btn btn-primary red_button d-flex align-items-center" data-bs-toggle="offcanvas" href="#offcanvasExample" role="button" aria-controls="offcanvasExample">Menu<svg xmlns="http://www.w3.org/2000/svg" width="21" height="21" viewBox="0 0 21 21" fill="none">
                <g clip-path="url(#clip0_2187_65939)">
                    <path d="M17.1654 15.0833C17.4864 15.0835 17.795 15.2071 18.0274 15.4287C18.2597 15.6502 18.3979 15.9526 18.4133 16.2733C18.4287 16.5939 18.3202 16.9082 18.1102 17.151C17.9002 17.3938 17.6049 17.5465 17.2854 17.5775L17.1654 17.5833H3.83203C3.51102 17.5832 3.20237 17.4595 2.97004 17.238C2.73772 17.0165 2.59952 16.714 2.58409 16.3934C2.56867 16.0728 2.67719 15.7585 2.88718 15.5157C3.09716 15.2728 3.39252 15.1201 3.71203 15.0892L3.83203 15.0833H17.1654ZM17.1654 9.24999C17.4969 9.24999 17.8148 9.38169 18.0492 9.61611C18.2837 9.85053 18.4154 10.1685 18.4154 10.5C18.4154 10.8315 18.2837 11.1495 18.0492 11.3839C17.8148 11.6183 17.4969 11.75 17.1654 11.75H3.83203C3.50051 11.75 3.18257 11.6183 2.94815 11.3839C2.71373 11.1495 2.58203 10.8315 2.58203 10.5C2.58203 10.1685 2.71373 9.85053 2.94815 9.61611C3.18257 9.38169 3.50051 9.24999 3.83203 9.24999H17.1654ZM17.1654 3.41666C17.4969 3.41666 17.8148 3.54835 18.0492 3.78277C18.2837 4.01719 18.4154 4.33514 18.4154 4.66666C18.4154 4.99818 18.2837 5.31612 18.0492 5.55054C17.8148 5.78496 17.4969 5.91666 17.1654 5.91666H3.83203C3.50051 5.91666 3.18257 5.78496 2.94815 5.55054C2.71373 5.31612 2.58203 4.99818 2.58203 4.66666C2.58203 4.33514 2.71373 4.01719 2.94815 3.78277C3.18257 3.54835 3.50051 3.41666 3.83203 3.41666H17.1654Z" fill="white" />
                </g>
                <defs>
                    <clipPath id="clip0_2187_65939">
                        <rect width="20" height="20" fill="white" transform="translate(0.5 0.5)" />
                    </clipPath>
                </defs>
            </svg>
        </a>
        <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel" <?php echo (current_user_can('editor') || current_user_can('administrator')) ? 'style="top: 32px;"' : 'style="top: 0;"'; ?>>
            <div class="offcanvas-header align-items-center justify-content-between top-0">
                <h5 class="offcanvas-title" id="offcanvasExampleLabel">My Account</h5>
                <button type="button" class="border-0 p-0 m-0 position-relative" data-bs-dismiss="offcanvas" aria-label="Close">
                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/homepage/close.png" alt="">
                </button>
            </div>
            <nav class="woocommerce-MyAccount-navigation">
                <ul class="mb-0">
                    <?php
                    // Define the desired order of menu items
                    $menu_order = array(
                        'dashboard'         => __('Dashboard', 'woocommerce'),
                        'edit-account'      => __('My Account', 'woocommerce'),
                        'edit-address'      => __('Shipping and Billing address', 'woocommerce'),
                        // 'payment-methods'   => __('Payment Methods', 'woocommerce'),
                        'orders'            => __('Order History', 'woocommerce'),
                        'recently-viewed'   => __('Recently Viewed', 'woocommerce'), // Added Recently Viewed tab
                        // 'order-status'   => __('Order Status', 'woocommerce'),
                        'news-letter'       => __('Newsletter', 'woocommerce'),
                        'customer-logout'   => __('Log Out', 'woocommerce'),
                    );


                    // Loop through the menu items in the desired order
                    foreach ($menu_order as $endpoint => $label) :
                        // Check if the menu item exists
                        if (wc_get_endpoint_url($endpoint, '', wc_get_page_permalink('myaccount'))) :
                    ?>
                            <li class="<?php echo wc_get_account_menu_item_classes($endpoint); ?>">
                                <a href="<?php echo esc_url(wc_get_account_endpoint_url($endpoint)); ?>">
                                    <?php echo esc_html($label); ?>
                                    <?php if ($endpoint === 'customer-logout') : ?>
                                        <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/my_account/log_out.png" alt="Log Out">
                                    <?php endif; ?>
                                </a>
                            </li>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </ul>
            </nav>
        </div>
    </div>
</div>

<?php do_action('woocommerce_after_account_navigation'); ?>