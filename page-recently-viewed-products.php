<?php get_header(); 
/*Template Name: Recently View Products*/
?>
<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/inc/css/my_account.css">
<?php 
do_action( 'woocommerce_before_account_navigation' );
?>
<section class="my_account">
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="content">
                        <div class="content-container">
                            <div class="woocommerce">
                                <div class="col-lg-3">
                                    <nav class="woocommerce-MyAccount-navigation d-none d-lg-block">
                                        <ul class="mb-0">
                                            <li class="woocommerce-MyAccount-navigation-link woocommerce-MyAccount-navigation-link--edit-account">
                                                <a href="http://localhost/ocfireworks/my-account/edit-account/">
                                                    My Account Page
                                                </a>
                                            </li>
                                            <li class="woocommerce-MyAccount-navigation-link woocommerce-MyAccount-navigation-link--edit-address">
                                                <a href="http://localhost/ocfireworks/my-account/edit-address/">
                                                    Shipping and Billing address
                                                </a>
                                            </li>
                                            <li class="woocommerce-MyAccount-navigation-link is-active woocommerce-MyAccount-navigation-link--recently-viewed">
                                                <a href="http://localhost/ocfireworks/my-account/recently-viewed/">
                                                    Recently Viewed Products
                                                </a>
                                            </li>
                                            <li class="woocommerce-MyAccount-navigation-link woocommerce-MyAccount-navigation-link--dashboard">
                                                <a href="http://localhost/ocfireworks/my-account/">
                                                    Dashboard
                                                </a>
                                            </li>
                                            <li class="woocommerce-MyAccount-navigation-link woocommerce-MyAccount-navigation-link--orders">
                                                <a href="http://localhost/ocfireworks/my-account/orders/">
                                                    Order History
                                                </a>
                                            </li>
                                            <li class="woocommerce-MyAccount-navigation-link woocommerce-MyAccount-navigation-link--downloads">
                                                <a href="http://localhost/ocfireworks/my-account/downloads/">
                                                    Downloads
                                                </a>
                                            </li>
                                            <li class="woocommerce-MyAccount-navigation-link woocommerce-MyAccount-navigation-link--customer-logout">
                                                <a href="http://localhost/ocfireworks/my-account/customer-logout/?_wpnonce=024a62729e">
                                                    Log Out
                                                    <img src="http://localhost/ocfireworks/wp-content/themes/ocfireworks/assets/img/my_account/log_out.png" alt="Log Out">
                                                </a>
                                            </li>
                                        </ul>
                                    </nav>
                                    <div class="d-block d-lg-none">
                                        <a
                                            class="btn btn-primary red_button d-flex align-items-center"
                                            data-bs-toggle="offcanvas"
                                            href="#offcanvasExample"
                                            role="button"
                                            aria-controls="offcanvasExample"
                                        >Menu<svg
                                                xmlns="http://www.w3.org/2000/svg"
                                                width="21"
                                                height="21"
                                                viewBox="0 0 21 21"
                                                fill="none"
                                            >
                                                <g clip-path="url(#clip0_2187_65939)">
                                                    <path d="M17.1654 15.0833C17.4864 15.0835 17.795 15.2071 18.0274 15.4287C18.2597 15.6502 18.3979 15.9526 18.4133 16.2733C18.4287 16.5939 18.3202 16.9082 18.1102 17.151C17.9002 17.3938 17.6049 17.5465 17.2854 17.5775L17.1654 17.5833H3.83203C3.51102 17.5832 3.20237 17.4595 2.97004 17.238C2.73772 17.0165 2.59952 16.714 2.58409 16.3934C2.56867 16.0728 2.67719 15.7585 2.88718 15.5157C3.09716 15.2728 3.39252 15.1201 3.71203 15.0892L3.83203 15.0833H17.1654ZM17.1654 9.24999C17.4969 9.24999 17.8148 9.38169 18.0492 9.61611C18.2837 9.85053 18.4154 10.1685 18.4154 10.5C18.4154 10.8315 18.2837 11.1495 18.0492 11.3839C17.8148 11.6183 17.4969 11.75 17.1654 11.75H3.83203C3.50051 11.75 3.18257 11.6183 2.94815 11.3839C2.71373 11.1495 2.58203 10.8315 2.58203 10.5C2.58203 10.1685 2.71373 9.85053 2.94815 9.61611C3.18257 9.38169 3.50051 9.24999 3.83203 9.24999H17.1654ZM17.1654 3.41666C17.4969 3.41666 17.8148 3.54835 18.0492 3.78277C18.2837 4.01719 18.4154 4.33514 18.4154 4.66666C18.4154 4.99818 18.2837 5.31612 18.0492 5.55054C17.8148 5.78496 17.4969 5.91666 17.1654 5.91666H3.83203C3.50051 5.91666 3.18257 5.78496 2.94815 5.55054C2.71373 5.31612 2.58203 4.99818 2.58203 4.66666C2.58203 4.33514 2.71373 4.01719 2.94815 3.78277C3.18257 3.54835 3.50051 3.41666 3.83203 3.41666H17.1654Z" fill="white"></path>
                                                </g>
                                                <defs>
                                                    <clipPath id="clip0_2187_65939">
                                                        <rect
                                                            width="20"
                                                            height="20"
                                                            fill="white"
                                                            transform="translate(0.5 0.5)"
                                                        ></rect>
                                                    </clipPath>
                                                </defs>
                                            </svg>
                                        </a>
                                        <div
                                            class="offcanvas offcanvas-start"
                                            tabindex="-1"
                                            id="offcanvasExample"
                                            aria-labelledby="offcanvasExampleLabel"
                                            style="top: 32px;"
                                        >
                                            <div class="offcanvas-header align-items-center justify-content-between top-0">
                                                <h5 class="offcanvas-title" id="offcanvasExampleLabel">My Account</h5>
                                                <button
                                                    type="button"
                                                    class="border-0 p-0 m-0 position-relative"
                                                    data-bs-dismiss="offcanvas"
                                                    aria-label="Close"
                                                >
                                                    <img src="http://localhost/ocfireworks/wp-content/themes/ocfireworks/assets/img/homepage/close.png" alt="">
                                                </button>
                                            </div>
                                            <nav class="woocommerce-MyAccount-navigation">
                                                <ul class="mb-0">
                                                    <li class="woocommerce-MyAccount-navigation-link woocommerce-MyAccount-navigation-link--edit-account">
                                                        <a href="http://localhost/ocfireworks/my-account/edit-account/">
                                                            My Account Page
                                                        </a>
                                                    </li>
                                                    <li class="woocommerce-MyAccount-navigation-link woocommerce-MyAccount-navigation-link--edit-address is-active">
                                                        <a href="http://localhost/ocfireworks/my-account/edit-address/">
                                                            Shipping and Billing address
                                                        </a>
                                                    </li>
                                                    <li class="woocommerce-MyAccount-navigation-link woocommerce-MyAccount-navigation-link--recently-viewed">
                                                        <a href="http://localhost/ocfireworks/my-account/recently-viewed/">
                                                            Recently Viewed Products
                                                        </a>
                                                    </li>
                                                    <li class="woocommerce-MyAccount-navigation-link woocommerce-MyAccount-navigation-link--dashboard">
                                                        <a href="http://localhost/ocfireworks/my-account/">
                                                            Dashboard
                                                        </a>
                                                    </li>
                                                    <li class="woocommerce-MyAccount-navigation-link woocommerce-MyAccount-navigation-link--orders">
                                                        <a href="http://localhost/ocfireworks/my-account/orders/">
                                                            Order History
                                                        </a>
                                                    </li>
                                                    <li class="woocommerce-MyAccount-navigation-link woocommerce-MyAccount-navigation-link--downloads">
                                                        <a href="http://localhost/ocfireworks/my-account/downloads/">
                                                            Downloads
                                                        </a>
                                                    </li>
                                                    <li class="woocommerce-MyAccount-navigation-link woocommerce-MyAccount-navigation-link--customer-logout">
                                                        <a href="http://localhost/ocfireworks/my-account/customer-logout/?_wpnonce=024a62729e">
                                                            Log Out
                                                            <img src="http://localhost/ocfireworks/wp-content/themes/ocfireworks/assets/img/my_account/log_out.png" alt="Log Out">
                                                        </a>
                                                    </li>
                                                </ul>
                                            </nav>
                                        </div>
                                    </div>
                                </div>
                                <?php //wc_get_template('myaccount/navigation.php'); ?>
                                <div class="col-lg-9 col-md-12 ps-lg-5">
                                    <?php echo do_shortcode('[recently_viewed_products]'); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php echo get_template_part('video_pop_up'); ?>
<?php get_footer(); ?>